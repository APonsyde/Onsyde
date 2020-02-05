<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package         Onsyde
 * @subpackage      API
 * @category        Manager
 * @author          Yohhan Dalvi
 */
class Manager extends ApiController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Turf_model');
        $this->load->model('Email_model');
        $this->load->model('Device_model');
        $this->load->model('Booking_model');
        $this->load->model('Manager_model');
    }

    public function login_check_post()
    {
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');

        $this->form_validation->set_message('required', '%s is required.');

        if($this->form_validation->run())
        {
            $manager = $this->Manager_model->get_manager_by_params(array('mobile' => $this->input->post('mobile')));

            if(empty($manager) || empty($manager['company_name']))
            {
                $otp = random_string('numeric', 6);

                $data = [
                    'mobile' => $this->input->post('mobile'),
                    'otp' => $otp
                ];

                $message = "Your OTP is ".$otp;
                sms("+91".$manager['mobile'], $message);

                if(empty($manager))
                {
                    $result = $this->Manager_model->add($data);
                }
                else
                {
                    $result = $this->Manager_model->update($manager['id'], $data);
                }

                $response = [
                    'success' => true,
                    'message' => 'OTP has been sent to your mobile number',
                    'data' => [
                    	'otp' => 1
                    ]
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
            else
            {
                $response = [
                    'success' => true,
                    'message' => 'Manager exists',
                    'data' => [
                        'login' => 1
                    ]
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
        }
        else
        {
            $this->return_form_errors($this->form_validation->error_array());
        }
    }

    public function login_post()
    {
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|md5');
        $this->form_validation->set_rules('device_identifier', 'Device', 'required');
        $this->form_validation->set_rules('registration_token', 'Registration token', 'required');

        $this->form_validation->set_message('required', '%s is required.');

        if($this->form_validation->run())
        {
            $manager = $this->Manager_model->get_manager_by_params(['mobile' => $this->input->post('mobile'), 'password' => $this->input->post('password')]);

            if(!empty($manager))
            {
            	$token = $this->Manager_model->generate_manager_token($manager['id'], $this->input->post('device_identifier'), $this->input->post('registration_token'));

                $response = [
                    'success' => true,
                    'message' => 'Logged in successfully',
                    'data' => [
                        'token' => $token,
                        'name' => $manager['company_name']
                    ]
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
            }
            else
            {
                $response = [
                    'success' => false,
                    'message' => 'Invalid mobile or password'
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
        }
        else
        {
            $this->return_form_errors($this->form_validation->error_array());
        }
    }

    public function register_otp_post()
    {
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('otp', 'OTP', 'required');

        $this->form_validation->set_message('required', '%s is required.');

        if($this->form_validation->run())
        {
            $manager = $this->Manager_model->get_manager_by_params(array('mobile' => $this->input->post('mobile')));

            if(!empty($manager))
            {
            	if($manager['otp'] == $this->input->post('otp'))
            	{
	                $response = [
	                    'success' => true,
	                    'message' => 'OTP verified successfully'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
	            }
	            else
	            {
	            	$response = [
	                    'success' => false,
	                    'message' => 'Invalid OTP entered'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
	            }
            }
            else
            {
                $response = [
                    'success' => false,
                    'message' => 'Unauthorized access'
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
        }
        else
        {
            $this->return_form_errors($this->form_validation->error_array());
        }
    }

    public function register_post()
    {
    	$this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('otp', 'OTP', 'required');
    	$this->form_validation->set_rules('company_name', 'Company name', 'required|xss_clean');
        $this->form_validation->set_rules('contact_person', 'Contact person', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|check_field[managers,email,deleted|0]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|xss_clean');
        $this->form_validation->set_rules('device_identifier', 'Device', 'required');
        $this->form_validation->set_rules('registration_token', 'Registration token', 'required');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('valid_email', '%s is invalid');
        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

        if($this->form_validation->run())
        {
            $manager = $this->Manager_model->get_manager_by_params(['mobile' => $this->input->post('mobile'), 'otp' => $this->input->post('otp')]);

            if(!empty($manager) && empty($manager['company_name']))
            {
                $data = [
                    'company_name' => $this->input->post('company_name'),
                    'contact_person' => $this->input->post('contact_person'),
                    'email' => $this->input->post('email'),
                    'password' => md5($this->input->post('password')),
                    'otp' => null
                ];

                $result = $this->Manager_model->update($manager['id'], $data);

                if($result)
                {
                    $this->Email_model->send_registration_email($data['company_name'], $data['email']);

                    $token = $this->Manager_model->generate_manager_token($result, $this->input->post('device_identifier'), $this->input->post('registration_token'));

	                $response = [
	                    'success' => true,
	                    'message' => 'Registered successfully',
	                    'data' => [
	                        'token' => $token,
	                        'name' => $data['company_name']
	                    ]
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
                }
                else
                {
                	$response = [
	                    'success' => false,
	                    'message' => 'Some error occured while registering the account'
	                ];

                	$this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
            }
            else
            {
            	if(empty($manager['company_name']))
                {
                   $message = 'Mobile number could not be verified';
                }
                else
                {
                   $message = 'Please login to continue';
                }

            	$response = [
                    'success' => false,
                    'message' => $message
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
        }
        else
        {
            $this->return_form_errors($this->form_validation->error_array());
        }
    }

    public function logout_get()
    {
        if($this->authenticate_token())
        {
            $result = $this->Device_model->delete_by_api_token($this->token);

            if($result)
            {
                $response = [
                    'success' => true,
                    'message' => 'Logged out successfully'
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
            }
            else
            {
                $response = [
                    'success' => false,
                    'message' => 'Some error occured while logging out'
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
        }
    }

    public function profile_get()
    {
        if($this->authenticate_token())
        {
            $manager = $this->Manager_model->get_manager_by_id($this->manager['id']);

            if(!empty($manager))
            {
                $data = [
                    'success' => true,
                    'data' => [
                        'profile' => [
                        	'id' => $manager['id'],
                        	'company_name' => $manager['company_name'],
                        	'contact_person' => $manager['contact_person'],
                        	'mobile' => $manager['mobile'],
                        	'email' => $manager['email']
                        ]
                    ]
                ];

                $this->set_response($data, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
            else
            {
                $data = [
                    'success' => false,
                    'message' => 'Some error occured while fetching your profile'
                ];

                $this->set_response($data, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
        }
    }

    public function profile_post()
    {
        if($this->authenticate_token())
        {
            $this->form_validation->set_rules('company_name', 'Company name', 'required|xss_clean');
	        $this->form_validation->set_rules('contact_person', 'Contact person', 'required|xss_clean');
	        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|check_field[managers,email,deleted|0&id !=|'.$this->manager['id'].']|xss_clean');

	        if(trim($this->input->post('password')) !== "")
	        {
	            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|xss_clean');
	        }

	        $this->form_validation->set_message('required', '%s is required');
	        $this->form_validation->set_message('valid_email', '%s is invalid');
	        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

            if($this->form_validation->run())
            {
                $data = [
	                'company_name' => $this->input->post('company_name'),
	                'contact_person' => $this->input->post('contact_person'),
	                'email' => $this->input->post('email')
	            ];

	            if(trim($this->input->post('password')) !== "")
	            {
	                $data['password'] = md5($this->input->post('password'));
	            }

                $result = $this->Manager_model->update($this->manager['id'], $data);

                if($result)
                {
                    $manager = $this->Manager_model->get_manager_by_id($this->manager['id']);

                    $response = [
                        'success' => true,
                        'message' => 'Profile updated successfully',
                        'data' => [
                            'profile' => [
                            	'id' => $manager['id'],
                            	'company_name' => $manager['company_name'],
                            	'contact_person' => $manager['contact_person'],
                            	'mobile' => $manager['mobile'],
                            	'email' => $manager['email']
                            ]
                        ]
                    ];

                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
                else
                {
                    $response = [
                        'success' => false,
                        'message' => 'Some error occured while updating profile'
                    ];

                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->return_form_errors($this->form_validation->error_array());
            }
        }
    }

    public function forgot_password_post()
    {
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');

        $this->form_validation->set_message('required', '%s is required.');

        if($this->form_validation->run())
        {
            $manager = $this->Manager_model->get_manager_by_params(array('mobile' => $this->input->post('mobile')));

            if(!empty($manager))
            {
	            $otp = random_string('numeric', 6);
	            $message = "Your reset password OTP is ".$otp;
                sms("+91".$manager['mobile'], $message);

	            $result = $this->Manager_model->update($manager['id'], ['forgot_password_key' => $reset_password_code]);

	            if($result)
	            {
	                $response = [
	                    'success' => true,
	                    'message' => 'Reset password otp has been sent successfully'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
	            }
	            else
	            {
	                $response = [
	                    'success' => false,
	                    'message' => 'Some error occured while sending the reset password code'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
	            }
	        }
	        else
	        {
	        	$response = [
                    'success' => false,
                    'message' => 'Unauthorized access'
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
	        }
        }
        else
        {
            $this->return_form_errors($this->form_validation->error_array());
        }
    }

    public function forgot_password_otp_post()
    {
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('otp', 'OTP', 'required');

        $this->form_validation->set_message('required', '%s is required.');

        if($this->form_validation->run())
        {
            $manager = $this->Manager_model->get_manager_by_params(array('mobile' => $this->input->post('mobile')));

            if(!empty($manager))
            {
            	if($manager['forgot_password_key'] == $this->input->post('otp'))
            	{
	                $response = [
	                    'success' => true,
	                    'message' => 'OTP verified successfully'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
	            }
	            else
	            {
	            	$response = [
	                    'success' => false,
	                    'message' => 'Invalid OTP entered'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
	            }
            }
            else
            {
                $response = [
                    'success' => false,
                    'message' => 'Unauthorized access'
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
        }
        else
        {
            $this->return_form_errors($this->form_validation->error_array());
        }
    }

    public function reset_password_post()
    {
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('otp', 'OTP', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|md5');

        $this->form_validation->set_message('required', '%s is required.');

        if($this->form_validation->run())
        {
            $manager = $this->Manager_model->get_manager_by_params(array('mobile' => $this->input->post('mobile')));

            if(!empty($manager))
            {
	            if($manager['forgot_password_key'] == $this->input->post('otp'))
	            {
	                $result = $this->Manager_model->update($manager['id'], ['forgot_password_key' => null, 'password' => $this->input->post('password')]);

	                if($result)
	                {
	                    $response = [
	                        'success' => true,
	                        'message' => 'Password has been updated successfully'
	                    ];

	                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
	                }
	                else
	                {
	                    $response = [
	                        'success' => false,
	                        'message' => 'Some error occured while updating the password'
	                    ];

	                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
	                }
	            }
	            else
	            {
	                $response = [
	                    'success' => false,
	                    'message' => 'Invalid OTP entered'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
	            }
            }
            else
            {
                $response = [
                    'success' => false,
                    'message' => 'Unauthorized access'
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
        }
        else
        {
            $this->return_form_errors($this->form_validation->error_array());
        }
    }

    public function dashboard_post()
    {
        if($this->authenticate_token())
        {
            $filters = [];
            $filters['manager_id'] = $this->manager['id'];

            $data['turfs'] = $this->Turf_model->get_all_turfs(null, null, $filters);

            $date = ($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');
            $timestamp = strtotime($date);
            $day = date('l', $timestamp);

            foreach ($data['turfs'] as $key => $turf)
            {
                $total_booked = (count($turf['slots'])) ? ceil((count($turf['booked_slots'])/count($turf['slots']))*100) : 0;
                $data['turfs'][$key]['total_booked'] = $total_booked;

                $slots = $this->Turf_model->get_all_turf_slots($turf['id'], $day);
                $booked_slots = $this->Turf_model->get_all_turf_booked_slots($turf['id'], $day, $date);

                foreach ($slots as $skey => $slot)
                {
                    $slots[$skey]['time'] = $slot['time'] . " - " . date("h:i a", strtotime('+30 minutes', strtotime($slot['time'])));

                    $booked = 0;
                    foreach ($booked_slots as $booked_slot)
                    {
                        if($booked_slot['id'] == $slot['id'])
                        {
                            $booked = 1;
                            break;
                        }
                    }

                    $slots[$skey]['booked'] = $booked;
                }

                $data['turfs'][$key]['slots'] = $slots;
                $data['turfs'][$key]['recent_bookings'] = $this->Booking_model->get_all_bookings(5, null, ['turf_id' => $turf['id']]);
                $data['turfs'][$key]['cancelled_bookings'] = $this->Booking_model->get_all_bookings(5, null, ['turf_id' => $turf['id'], 'status' => TURF_STATUS_CANCELLED]);
            }

            $response = [
                'success' => true,
                'message' => '',
                'data' => $data
            ];

            $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
        }
    }
}