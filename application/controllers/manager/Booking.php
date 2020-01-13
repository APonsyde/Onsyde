<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends ManagerController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Turf_model');
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
}