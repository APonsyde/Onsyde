<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

/**
 * @package         Onsyde
 * @subpackage      API
 * @category        ApiController
 * @author          Yohhan Dalvi
 */
class ApiController extends \Restserver\Libraries\REST_Controller {

	protected $token;
	protected $manager;

	function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Manager_model');

        $this->set_api_token();
    }

    private function set_api_token()
    {
    	$request_headers = $this->input->request_headers();

    	if(isset($request_headers['token']))
    	{
    		$manager = $this->Manager_model->get_manager_by_params(array('api_token' => $request_headers['token']));

    		if(!empty($manager))
    		{
	    		$this->token = $request_headers['token'];
	    		$this->manager = $manager;
	    	}
	    }
    }

    protected function authenticate_token()
    {
    	if(is_null($this->token))
    	{
	    	$response = [
				'success' => false,
				'message' => '0.0.1'
			];

			return $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
		}
		else
		{
			return true;
		}
    }

	protected function return_form_errors($form_errors)
	{
        $errors = [];

        foreach ($form_errors as $field => $message) {
            $errors[] = array(
                'field' => $field,
                'message' => $message
            );
        }

        $response = [
            'success' => false,
            'message' => 'Error',
            'errors' => $errors
        ];

        $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
	}
}