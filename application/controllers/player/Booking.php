<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends FrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Booking_model');
    }

    public function index()
    {
        $this->authenticate();

        $data['bookings'] = $this->Booking_model->get_all_bookings(null, null, ['player_id' => $this->player['id']]);

        $data['tab'] = 'player';
        $data['title'] = 'My bookings';
        $data['_view'] = 'player/booking/index';
        $this->load->view('front/layout/basetemplate', $data);
    }

    public function view($booking_key = null)
    {
        $this->authenticate(current_url());

        $data['booking'] = $this->Booking_model->get_booking_by_params(['booking_key' => $booking_key]);

        if(!empty($data['booking']) && $data['booking']['player_id'] = $this->player['id'])
        {
            $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s is required');
            $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

            if($this->form_validation->run())
            {
                $invite_data = $this->input->post();
                $invite_data['booking_id'] = $data['booking']['id'];
                $invite_data['invited_by'] = $this->player['id'];
                $result = $this->Booking_model->add_invite($invite_data);

                if($result)
                {
                    $this->session->set_flashdata('success_message', 'Invitation sent successfully');
                    redirect('booking/view/'.$booking_key);
                    exit;
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Error occured while sending the invitation');
                    redirect('booking/view/'.$booking_key);
                    exit;
                }
            }
            else
            {
                $data['invited_players'] = $this->Booking_model->get_all_booking_invited_players(null, null, ['booking_id' => $data['booking']['id']]);

                $exclude_mobiles = [];

                if(!empty($data['invited_players']))
                {
                    foreach ($data['invited_players'] as $key => $invited_player)
                    {
                        $exclude_mobiles[] = $invited_player['mobile'];
                    }
                }

                $data['recent_players'] = $this->Booking_model->get_all_booking_recent_players(null, null, ['exclude_mobiles' => $exclude_mobiles, 'invited_by' => $this->player['id']]);

                $data['tab'] = 'player';
                $data['title'] = 'View booking';
                $data['_view'] = 'player/booking/view';
                $this->load->view('front/layout/basetemplate', $data);
            }
        }
        else
        {
            $this->session->set_flashdata('error_message', 'Booking not found');
            redirect('bookings');
            exit;
        }
    }

    public function invite($invite_key = null)
    {
        $this->authenticate(current_url());

        $data['invite'] = $this->Booking_model->get_booking_invite_by_params(['invite_key' => $invite_key]);

        if(!empty($data['invite']))
        {
            $this->form_validation->set_rules('status', 'Status', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s is required');
            $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

            if($this->form_validation->run())
            {
                $invite_data = $this->input->post();
                $result = $this->Booking_model->update_invite($data['invite']['invited_id'], $invite_data);

                if($result)
                {
                    $this->session->set_flashdata('success_message', 'Invitation status updated');
                    redirect('booking/invite/'.$invite_key);
                    exit;
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Error occured while updating the invitation status');
                    redirect('booking/invite/'.$invite_key);
                    exit;
                }
            }
            else
            {
                $data['tab'] = 'player';
                $data['title'] = 'View booking invite';
                $data['_view'] = 'player/booking/invite';
                $this->load->view('front/layout/basetemplate', $data);
            }
        }
        else
        {
            $this->session->set_flashdata('error_message', 'Invalid invitation');
            redirect();
            exit;
        }
    }

    public function cancel($id = 0)
    {
        $this->authenticate(current_url());

        $booking = $this->Booking_model->get_booking_by_id($id);

        if(!empty($booking) && $booking['player_id'] = $this->player['id'])
        {
            if($booking['player_cancellation'])
            {
                $this->Booking_model->update($booking['id'], ['status' => 'cancelled']);

                $this->session->set_flashdata('success_message', 'You have cancelled this booking');
                redirect('bookings');
                exit;
            }
            else
            {
                $this->session->set_flashdata('error_message', 'This booking cannot be cancelled');
                redirect('bookings');
                exit;
            }
        }
        else
        {
            $this->session->set_flashdata('error_message', 'Booking not found');
            redirect('bookings');
            exit;
        }
    }

    public function success()
    {
        $this->authenticate();

        $data['tab'] = 'player';
        $data['title'] = 'Thank you';
        $data['_view'] = 'player/booking/success';
        $this->load->view('front/layout/basetemplate', $data);
    }
}