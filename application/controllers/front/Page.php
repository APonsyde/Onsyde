<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends FrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Blog_model');
        $this->load->model('Podcast_model');
        $this->load->model('Turf_model');
        $this->load->model('Email_model');
        $this->load->model('Booking_model');
    }

    public function home()
    {
        $data['blogs'] = $this->Blog_model->get_all_blogs(4, null, ['inactive' => 0]);
        $data['podcasts'] = $this->Podcast_model->get_all_podcasts(null, null, ['inactive' => 0]);

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

                        $result = $this->Booking_model->book($data, $slots_info);

                        if($result)
                        {
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

                            $message = 'You have a new booking for '.$turf['name'].' for the time slot(s) '.$time_slot.' totalling Rs '.$amount.' /-.';
                            sms("+91".$turf['contact_mobile'], $message);

                            $booking = $this->Booking_model->get_booking_by_id($result);
                            redirect('booking/success/'.$booking['booking_key']);
                            exit;
                        }
                        else
                        {
                            $this->session->set_flashdata('error_message', 'Some error occured while confirming the booking');
                            redirect('find-a-turf/'.$slot_selection_type.'?date='.$date);
                            exit;
                        }
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

            $filters = $this->input->get();
            $filter['inactive'] = 0;

            $data['turfs'] = $this->Turf_model->get_all_turfs(null, null, $filters);

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

    public function about_us()
    {
        $data['tab'] = 'about_us';
        $data['title'] = 'About us';
        $data['_view'] = 'front/page/about-us';
        $this->load->view('front/layout/basetemplate', $data);
    }

    public function privacy()
    {
        $data['tab'] = 'privacy';
        $data['title'] = 'Privacy';
        $data['_view'] = 'front/page/privacy';
        $this->load->view('front/layout/basetemplate', $data);
    }

    public function terms()
    {
        $data['tab'] = 'terms';
        $data['title'] = 'Terms & Conditions';
        $data['_view'] = 'front/page/terms';
        $this->load->view('front/layout/basetemplate', $data);
    }

    public function contact_us()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
        $this->form_validation->set_rules('subject', 'Subject', 'required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'required|xss_clean');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if($this->form_validation->run())
        {
            $data = $this->input->post();
            $result = $this->Email_model->send_contact_mail($data['name'], $data['email'], $data['subject'], $data['message']);

            if($result)
            {
                $this->session->set_flashdata('success_message', 'Thank you for contacting us / we will revert back in 24-48 hours.');
                redirect('contact-us');
                exit;
            }
            else
            {
                $this->session->set_flashdata('error_message', 'Some error occured while contacting the team');
                redirect('contact-us');
                exit;
            }
        }
        else
        {
            $data['tab'] = 'contact_us';
            $data['title'] = 'Contact us';
            $data['_view'] = 'front/page/contact-us';
            $this->load->view('front/layout/basetemplate', $data);
        }
    }

    public function podcast()
    {
        $data['podcasts'] = $this->Podcast_model->get_all_podcasts(null, null, ['inactive' => 0]);

        $data['tab'] = 'podcast';
        $data['title'] = 'Podcast';
        $data['_view'] = 'front/page/podcast';
        $this->load->view('front/layout/basetemplate', $data);
    }

    public function blogs()
    {
        $data['blogs'] = $this->Blog_model->get_all_blogs(null, null, ['inactive' => 0]);

        $data['tab'] = 'blogs';
        $data['title'] = 'Blogs';
        $data['_view'] = 'front/page/blogs';
        $this->load->view('front/layout/basetemplate', $data);
    }

    public function blog($id = 0)
    {
        $data['blog'] = $this->Blog_model->get_blog_by_id($id);

        if(empty($data['blog']))
        {
            $this->session->set_flashdata('error_message', 'Blog not found');
            redirect('blogs');
            exit;
        }

        $data['tab'] = 'blogs';
        $data['title'] = $data['blog']['title'];
        $data['_view'] = 'front/page/blog';
        $this->load->view('front/layout/basetemplate', $data);
    }
}