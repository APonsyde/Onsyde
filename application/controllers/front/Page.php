<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends FrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Turf_model');
    }

    public function home()
    {
        $data['turfs'] = $this->Turf_model->get_all_turfs();

        $date = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m-d');
        $timestamp = strtotime($date);
        $day = date('l', $timestamp);

        foreach ($data['turfs'] as $key => $turf)
        {
            $data['turfs'][$key]['slots'] = $this->Turf_model->get_all_turf_slots($turf['id'], $day);
            $data['turfs'][$key]['booked_slots'] = $this->Turf_model->get_all_turf_booked_slots($turf['id'], $day, $date);
        }

        $data['tab'] = 'home';
        $data['title'] = 'Home';
        $data['_view'] = 'front/page/home';
        $this->load->view('front/layout/basetemplate', $data);
    }

    public function how_it_works()
    {
        $data['tab'] = 'how_it_works';
        $data['title'] = 'How it works';
        $data['_view'] = 'front/page/how-it-works';
        $this->load->view('front/layout/basetemplate', $data);
    }
}