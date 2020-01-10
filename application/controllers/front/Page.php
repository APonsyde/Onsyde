<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends FrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Turf_model');
        $this->load->model('Booking_model');
    }

    public function home()
    {
        $data['tab'] = 'home';
        $data['title'] = 'Home';
        $data['_view'] = 'front/page/home';
        $this->load->view('front/layout/basetemplate', $data);
    }

    public function find_a_turf()
    {
        if($_POST)
        {
            $date = ($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');
            $slots = $this->input->post('slot');

            if(empty($slots))
            {
                $this->session->set_flashdata('error_message', 'Please select atleast one slot to book');
                redirect('find-a-turf?date='.$date);
                exit;
            }
            else
            {
                if($this->player['id'])
                {
                    $slots_info = $this->Turf_model->get_turf_slots_info($slots);

                    $first = $slots_info[0];
                    $last = end($slots_info);

                    $amount = 0;

                    $time_slot = $first['time'] . " - " . date("h:i a", strtotime('+30 minutes', strtotime($last['time'])));

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
                    redirect('booking/success');
                    exit;
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
            $data['turfs'] = $this->Turf_model->get_all_turfs();

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