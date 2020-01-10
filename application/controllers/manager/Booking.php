<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends ManagerController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Booking_model');
    }

    public function index()
    {
        $this->authenticate();

        $data['bookings'] = $this->Booking_model->get_all_bookings();

        $data['tab'] = 'bookings';
        $data['title'] = 'List turf bookings';
        $data['_view'] = 'manager/booking/index';
        $this->load->view('manager/layout/basetemplate', $data);
    }
}