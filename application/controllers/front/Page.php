<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends FrontController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
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