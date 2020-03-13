<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Turf_model');
        $this->load->model('Email_model');
        $this->load->model('Player_model');
        $this->load->model('Booking_model');
    }

    public function listing_post()
    {
        if($this->authenticate_token())
        {
            $filters = [];
            $filters['manager_id'] = $this->manager['id'];

            if(in_array($this->input->post('status'), ['booked', 'cancelled']))
                $filters['status'] = $this->input->post('status');

            if($this->input->post('turf_id'))
                $filters['turf_id'] = $this->input->post('turf_id');

            if($this->input->post('date'))
                $filters['booking_date'] = $this->input->post('date');

            $data['bookings'] = $this->Booking_model->get_all_bookings(null, null, $filters);

            $response = [
                'success' => true,
                'message' => '',
                'data' => $data
            ];

            $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
        }
    }

    public function new_post()
    {
        if($this->authenticate_token())
        {
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');
            $this->form_validation->set_rules('full_name', 'Name', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s is required');
            $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

            if($this->form_validation->run())
            {
                $data['player'] = $this->Player_model->get_player_by_params(['mobile' => $this->input->post('mobile')]);

                if(empty($data['player']))
                {
                    $data = $this->input->post();
                    $data['inactive'] = 1;
                    $player_id = $this->Player_model->add($data);
                }
                else
                {
                    $this->Player_model->update($data['player']['id'], $this->input->post());
                    $player_id = $data['player']['id'];
                }

                if($player_id)
                {
                    $response = [
                        'success' => true,
                        'message' => 'Player data fetched',
                        'data' => [
                            'player_id' => $player_id
                        ]
                    ];

                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
                else
                {
                    $response = [
                        'success' => false,
                        'message' => 'Some error occured while creating a new booking'
                    ];

                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->return_form_errors($this->form_validation->error_array());
            }
        }
    }

    public function turfs_post()
    {
        if($this->authenticate_token())
        {
            $data['turfs'] = $this->Turf_model->get_all_turfs(null, null, ['manager_id' => $this->manager['id'], 'inactive' => 0]);

            $date = ($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');
            $timestamp = strtotime($date);
            $day = date('l', $timestamp);

            foreach ($data['turfs'] as $key => $turf)
            {
                $slots = $this->Turf_model->get_all_turf_slots($turf['id'], $day);
                $booked_slots = $this->Turf_model->get_all_turf_booked_slots($turf['id'], $day, $date);

                foreach ($slots as $skey => $slot)
                {
                    $slots[$skey]['time'] = $slot['time'] . " - " . date("h:i a", strtotime('+30 minutes', strtotime($slot['time'])));

                    $booked = 0;
                    foreach ($booked_slots as $booked_slot)
                    { 
                        if($booked_slot['id'] == $slot['id'])
                        {
                            $booked = 1;
                            break;
                        }
                    }

                    $slots[$skey]['booked'] = $booked;
                }

                $data['turfs'][$key]['slots'] = $slots;
            }

            $response = [
                'success' => true,
                'message' => 'Turf data fetched',
                'data' => $data
            ];

            $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
        }
    }

    public function create_post()
    {
        if($this->authenticate_token())
        {
            $this->form_validation->set_rules('player_id', 'Player', 'required|xss_clean');
            $this->form_validation->set_rules('turf_id', 'Turf', 'required|xss_clean');
            $this->form_validation->set_rules('slots', 'Slots', 'required|xss_clean');
            $this->form_validation->set_rules('slot_selection_type', 'Slot selection type', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s is required');
            $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

            if($this->form_validation->run())
            {
                $player = $this->Player_model->get_player_by_id($this->input->post('player_id'));

                if(!empty($player))
                {
                    $turf = $this->Turf_model->get_turf_by_id($this->input->post('turf_id'));

                    if(!empty($turf))
                    {
                        $date = ($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');
                        $slots = explode(",", $this->input->post('slots'));
                        $slot_selection_type = $this->input->post('slot_selection_type');

                        $slots_info = $this->Turf_model->get_turf_slots_info($slots);

                        if(!empty($slots_info))
                        {
                            $amount = 0;
                            $time_slot = null;

                            if($slot_selection_type == TURF_SLOT_INDIVIDUAL)
                            {
                                $prev_slot = null;

                                foreach ($slots_info as $key => $slot)
                                {
                                    if($key == 0)
                                    {
                                        $time_slot .= $slot['time'];
                                    }
                                    else
                                    {
                                        $prev_slot_end_time = date("h:i a", strtotime('+30 minutes', strtotime($prev_slot['time'])));

                                        if($prev_slot_end_time !== $slot['time'])
                                        {
                                            $time_slot .= " - ".$prev_slot_end_time.", ".$slot['time'];
                                        }
                                    }

                                    $prev_slot = $slot;
                                }
                            }
                            else
                            {
                                $first = $slots_info[0];
                                $time_slot = $first['time'];
                            }

                            $last = end($slots_info);
                            $time_slot .=  " - " . date("h:i a", strtotime('+30 minutes', strtotime($last['time'])));

                            foreach ($slots_info as $key => $slot)
                            {
                                $amount += $slot['price'];
                            }

                            $data = [
                                'booking_date' => $date,
                                'player_id' => $player['id'],
                                'turf_id' => $turf['id'],
                                'amount' => $amount,
                                'time_slot' => $time_slot
                            ];

                            $result = $this->Booking_model->book($data, $slots_info);

                            if($result)
                            {
                                $booking = $this->Booking_model->get_booking_by_id($result);

                                if(!empty($player['email']))
                                {
                                    $users = [
                                        [
                                            'name' => $player['full_name'],
                                            'email' => $player['email']
                                        ]
                                    ];

                                    $subject = PROJECT_NAME.' - Booking Confirmed!';
                                    $message = 'Your booking for '.$turf['name'].' has been confirmed for the time slot(s) '.$time_slot.' totalling Rs '.$amount.' /-.';

                                    if($player['inactive'])
                                    {
                                        $message .= '<br><br>Please activate your account by logging onto <a href="'.site_url().'">onsyde</a>.';
                                    }

                                    $this->Email_model->send_booking_confirmation_mail($player['full_name'], $player['email'], $turf['name'], $booking['booking_key']. $time_slot, $amount);
                                }

                                if(!empty($player['mobile']))
                                {
                                    $message = 'Your booking for '.$turf['name'].' has been confirmed for the time slot(s) '.$time_slot.' totalling Rs '.$amount.' /-.';

                                    if($player['inactive'])
                                    {
                                        $message .= ' Please activate your account by logging onto '.site_url().'.';
                                    }

                                    sms("+91".$player['mobile'], $message);
                                }

                                $message = 'You have a new booking for '.$turf['name'].' for the time slot(s) '.$time_slot.' totalling Rs '.$amount.' /-.';
                                sms("+91".$turf['contact_mobile'], $message);

                                $response = [
                                    'success' => true,
                                    'message' => 'Booking has been confirmed'
                                ];

                                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                            }
                            else
                            {
                                $response = [
                                    'success' => false,
                                    'message' => 'Some error occured while confirming the booking'
                                ];

                                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                            }
                        }
                        else
                        {
                            $response = [
                                'success' => false,
                                'message' => 'Empty slot booking not allowed'
                            ];

                            $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                        }
                    }
                    else
                    {
                        $response = [
                            'success' => false,
                            'message' => 'Turf not found'
                        ];

                        $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                    }
                }
                else
                {
                    $response = [
                        'success' => false,
                        'message' => 'Player not found'
                    ];

                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->return_form_errors($this->form_validation->error_array());
            }
        }
    }
}