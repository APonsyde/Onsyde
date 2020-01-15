<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends FrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Turf_model');
        $this->load->model('Email_model');
        $this->load->model('Booking_model');
    }

    public function home()
    {
        $data['tab'] = 'home';
        $data['title'] = 'Home';
        $data['_view'] = 'front/page/home';
        $this->load->view('front/layout/basetemplate', $data);
    }

    public function find_a_turf($slot_selection_type = TURF_SLOT_INDIVIDUAL)
    {
        if(!in_array($slot_selection_type, [TURF_SLOT_INDIVIDUAL, TURF_SLOT_GROUPED]))
        {
            redirect('find-a-turf/'.TURF_SLOT_INDIVIDUAL);
            exit;
        }

        if($_POST)
        {
            $date = ($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');
            $slots = $this->input->post('slot');

            if(empty($slots))
            {
                $this->session->set_flashdata('error_message', 'Please select atleast one slot to book');
                redirect('find-a-turf/'.$slot_selection_type.'?date='.$date);
                exit;
            }
            else
            {
                if($this->player['id'])
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
                            'player_id' => $this->player['id'],
                            'turf_id' => $this->input->post('turf_id'),
                            'amount' => $amount,
                            'time_slot' => $time_slot
                        ];

                        $this->Booking_model->book($data, $slots_info);

                        if(!empty($this->player['email']))
                        {
                            $users = [$this->player];
                            $subject = PROJECT_NAME.' - Booking Confirmed!';
                            $message = 'Your booking for '.$turf['name'].' has been confirmed for the time slot(s) '.$time_slot.' totalling Rs '.$amount.' /-.';

                            $this->Email_model->notify($users, $subject, $message);
                        }

                        if(!empty($this->player['mobile']))
                        {
                            $message = 'Your booking for '.$turf['name'].' has been confirmed for the time slot(s) '.$time_slot.' totalling Rs '.$amount.' /-.';
                            sms("+91".$this->player['mobile'], $message);
                        }

                        redirect('booking/success');
                        exit;
                    }
                    else
                    {
                        $this->session->set_flashdata('error_message', 'Turf not found');
                        redirect('find-a-turf/'.$slot_selection_type.'?date='.$date);
                        exit;
                    }
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Please login / register to continue');
                    redirect('player');
                    exit;
                }
            }
        }
        else
        {
            $data['slot_selection_type'] = $slot_selection_type;

            $data['turfs'] = $this->Turf_model->get_all_turfs(null, null, ['inactive' => 0]);

            $date = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m-d');
            $timestamp = strtotime($date);
            $day = date('l', $timestamp);

            foreach ($data['turfs'] as $key => $turf)
            {
                $data['turfs'][$key]['slots'] = $this->Turf_model->get_all_turf_slots($turf['id'], $day);
                $data['turfs'][$key]['booked_slots'] = $this->Turf_model->get_all_turf_booked_slots($turf['id'], $day, $date);
                $data['turfs'][$key]['images'] = $this->Turf_model->get_turf_images($turf['id']);
            }

            $data['tab'] = 'home';
            $data['title'] = 'Home';
            $data['_view'] = 'front/page/find-a-turf';
            $this->load->view('front/layout/basetemplate', $data);
        }
    }

    public function how_it_works()
    {
        $data['tab'] = 'how_it_works';
        $data['title'] = 'How it works';
        $data['_view'] = 'front/page/how-it-works';
        $this->load->view('front/layout/basetemplate', $data);
    }
}