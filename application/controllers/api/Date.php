<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package         Onsyde
 * @subpackage      API
 * @category        Date
 * @author          Yohhan Dalvi
 */
class Date extends ApiController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function listing_get()
    {
        if($this->authenticate_token())
        {
            $upcoming_days = [];
            $days = get_upcoming_days();

            foreach ($days as $key => $value)
            {
                $upcoming_days[] = [
                    'index' => $key,
                    'date' => $value,
                    'year' => date("Y", strtotime($key)),
                    'month' => date("M", strtotime($key)),
                    'day' => date("d", strtotime($key))
                ];
            }

            $response = [
                'success' => true,
                'message' => '',
                'data' => [
                    'dates' => $upcoming_days
                ]
            ];

            $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
        }
    }
}