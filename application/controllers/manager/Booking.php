<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends ManagerController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Turf_model');
        $this->load->model('Email_model');
        $this->load->model('Player_model');
        $this->load->model('Booking_model');
    }

    public function index()
    {
        $this->authenticate();

        $filters = $this->input->get();
        $filters['manager_id'] = $this->manager['id'];
        $data['bookings'] = $this->Booking_model->get_all_bookings(null, null, $filters);

        $data['turfs'] = $this->Turf_model->get_all_turfs(null, null, ['manager_id' => $this->manager['id']]);

        $data['tab'] = 'bookings';
        $data['title'] = 'List turf bookings';
        $data['_view'] = 'manager/booking/index';
        $this->load->view('manager/layout/basetemplate', $data);
    }

    public function new()
    {
        $this->authenticate();

        $data['player'] = $this->Player_model->get_player_by_params(['mobile' => $this->input->post('mobile')]);

        $this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');
        $this->form_validation->set_rules('full_name', 'Name', 'required|xss_clean');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

        if($this->form_validation->run())
        {
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
                redirect('manager/booking/create/'.TURF_SLOT_GROUPED.'/'.$player_id);
                exit;
            }
            else
            {
                $this->session->set_flashdata('error_message', 'Some error occured while creating a new booking');
                redirect('manager/booking/new');
                exit;
            }
        }
        else
        {
            $data['tab'] = 'booking_new';
            $data['title'] = 'Create new booking';
            $data['_view'] = 'manager/booking/new';
            $this->load->view('manager/layout/basetemplate', $data);
        }
    }

    public function create($slot_selection_type = TURF_SLOT_GROUPED, $id = 0)
    {
        if(!in_array($slot_selection_type, [TURF_SLOT_INDIVIDUAL, TURF_SLOT_GROUPED]))
        {
            redirect('manager/booking/create/'.TURF_SLOT_GROUPED.'/'.$id);
            exit;
        }

        $player = $this->Player_model->get_player_by_id($id);

        if(!empty($player))
        {
            if($_POST)
            {
                $date = ($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');
                $slots = $this->input->post('slot');

                if(empty($slots))
                {
                    $this->session->set_flashdata('error_message', 'Please select atleast one slot to book');
                    redirect('manager/booking/create/'.TURF_SLOT_GROUPED.'/'.$id.'?date='.$date);
                    exit;
                }
                else
                {
                    $turf = $this->Turf_model->get_turf_by_id($this->input->post('turf_id'));

                    if(!empty($turf))
                    {
                        $slots_info = $this->Turf_model->get_turf_slots_info($slots);

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
                            'player_id' => $id,
                            'turf_id' => $this->input->post('turf_id'),
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

                            $this->session->set_flashdata('success_message', 'Booking has been confirmed');
                            redirect('manager/bookings');
                            exit;
                        }
                        else
                        {
                            $this->session->set_flashdata('error_message', 'Some error occured while confirming the booking');
                            redirect('manager/booking/create/'.TURF_SLOT_GROUPED.'/'.$id.'?date='.$date);
                            exit;
                        }
                    }
                    else
                    {
                        $this->session->set_flashdata('error_message', 'Turf not found');
                        redirect('manager/booking/create/'.TURF_SLOT_GROUPED.'/'.$id.'?date='.$date);
                        exit;
                    }
                }
            }
            else
            {
                $data['slot_selection_type'] = $slot_selection_type;
                $data['player'] = $player;

                $data['turfs'] = $this->Turf_model->get_all_turfs(null, null, ['manager_id' => $this->manager['id'], 'inactive' => 0]);

                $date = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m-d');
                $timestamp = strtotime($date);
                $day = date('l', $timestamp);

                foreach ($data['turfs'] as $key => $turf)
                {
                    $data['turfs'][$key]['slots'] = $this->Turf_model->get_all_turf_slots($turf['id'], $day);
                    $data['turfs'][$key]['booked_slots'] = $this->Turf_model->get_all_turf_booked_slots($turf['id'], $day, $date);
                    $data['turfs'][$key]['images'] = $this->Turf_model->get_turf_images($turf['id']);
                }

                $data['tab'] = 'booking_new';
                $data['title'] = 'Create new booking';
                $data['_view'] = 'manager/booking/create';
                $this->load->view('manager/layout/basetemplate', $data);
            }
        }
        else
        {
            $this->session->set_flashdata('error_message', 'Player not found');
            redirect('manager/booking/new');
            exit;
        }
    }

    public function cancel($id = 0)
    {
        $this->authenticate(current_url());

        $booking = $this->Booking_model->get_booking_by_id($id);

        if(!empty($booking) && $booking['manager_id'] = $this->manager['id'])
        {
            if($booking['player_cancellation'])
            {
                $this->Booking_model->update($booking['id'], ['status' => 'cancelled']);

                $this->session->set_flashdata('success_message', 'You have cancelled this booking');
                redirect('manager/bookings');
                exit;
            }
            else
            {
                $this->session->set_flashdata('error_message', 'This booking cannot be cancelled');
                redirect('manager/bookings');
                exit;
            }
        }
        else
        {
            $this->session->set_flashdata('error_message', 'Booking not found');
            redirect('manager/bookings');
            exit;
        }
    }
}