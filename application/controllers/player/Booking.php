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
}