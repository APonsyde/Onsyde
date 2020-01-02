<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package         Weddingsutra
 * @subpackage      API
 * @category        Player
 * @author          Yohhan Dalvi
 */
class Sport extends ApiController 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Player_model');
        $this->load->model('Sport_model');
        $this->load->model('Device_model');
    }

    public function listing_get()
    {
    	$data['sports'] = $this->Sport_model->get_all_sports();

        $response = [
            'success' => true,
            'message' => '',
            'data' => $data
        ];

        $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
    }

}