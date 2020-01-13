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
                redirect('player/bookings');
                exit;
            }
            else
            {
                $this->session->set_flashdata('error_message', 'This booking cannot be cancelled');
                redirect('player/bookings');
                exit;
            }
        }
        else
        {
            $this->session->set_flashdata('error_message', 'Booking not found');
            redirect('player/bookings');
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