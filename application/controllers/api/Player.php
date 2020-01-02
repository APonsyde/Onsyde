<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* @package         Weddingsutra
* @subpackage      API
* @category        Player
* @author          Yohhan Dalvi
*/
class Player extends ApiController {

    function __construct()
    {
// Construct the parent class
        parent::__construct();
        $this->load->model('Player_model');
        $this->load->model('Email_model');
        $this->load->model('Device_model');
        $this->load->model('Sport_model');
    }

    public function register_post()
    {
        $this->form_validation->set_rules('full_name', 'Full name', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('type', 'Type', 'required');

        $this->form_validation->set_message('required', '%s is required.');
        $this->form_validation->set_message('validate_date', '%s should be a valid future date.');

        if($this->form_validation->run())
        {
            $player_data = $this->input->post();
            $player_name = explode(" ", $player_data['full_name']);
            $player_data['account'] = 1;
            $player_data['first_name'] = $player_name[0];
            $player_data['last_name'] = isset($player_name[1]) ? $player_name[1] : '';
            unset($player_data['type']);
            $player_data['password'] = md5($player_data['password']);

            $account = ($this->input->post('type') == 'mobile') ? $this->input->post('mobile') : $this->input->post('email');
            $result = $this->Player_model->update_player_by_params(['account' => $account], $player_data);


            if($result)
            {
                $player = $this->Player_model->get_player_by_params(array('account' => $account));

                if($this->input->post('type') == 'mobile') 
                {
                    $response = [
                        'success' => true,
                        'message' => 'Registered successfully',
                        'data' => [
                            'token' => $this->Player_model->generate_player_token($player['id']),
                            'name' => $player['first_name'],
                        ]
                    ];

                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
                }
                else
                {
                    $otp = random_string('numeric', 4);

                    $this->_send_otp($player['mobile'], $otp);

                    $data = [
                        'otp' => $otp
                    ];

                    $this->Player_model->update($player['id'], $data);

                    $response = [
                        'success' => true,
                        'message' => 'Player exists, verify otp',
                        'data' => [
                            'otp' => 1
                        ]
                    ];

                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $response = [
                    'success' => false,
                    'message' => 'Some error occured while registering'
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
        }
        else
        {
            $this->return_form_errors($this->form_validation->error_array());
        }
    }

    public function view_post()
    {

        $this->form_validation->set_rules('player_id', 'Player', 'required|xss_clean');

        $this->form_validation->set_message('required', '%s is required.');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if($this->form_validation->run())
        {
            $data = $this->input->post();

            $result = $this->Player_model->get_player_by_id($this->input->post('player_id'), $data);
            if($result)
            { 
                $response = [
                    'success' => true,
                    'message' => 'Player detailing',
                    'data' => $result

                ];
                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
            }
            else
            {
                $data = [
                    'success' => false,
                    'message' => 'Player not found'

                ];

                $this->response($data, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }

        }
        else
        {
            $this->return_form_errors($this->form_validation->error_array());
        }
    }


    public function sports_get()
    {
        $data['sport'] = $this->Sport_model->get_all_sports();

        $response = [
            'success' => true,
            'message' => '',
            'data' => $data
        ];

        $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);

    }

    public function add_sports_post()
    {
        $data['sport'] = $this->Sport_model->get_all_sports();

        $this->form_validation->set_rules('sports_id', 'Sport', 'required|xss_clean');
        if($this->form_validation->run())
        {
            $data = $this->input->post();
            $data['player_id'] = $id;

            if($result)
            {
                $response = [
                    'success' => true,
                    'message' => 'Player detailing',
                    'data' => $result

                ];
                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
            }
            else
            {
                $data = [
                    'success' => false,
                    'message' => 'Player not found'

                ];

                $this->response($data, \Restserver\Libraries\REST_Controller::HTTP_OK);
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

    $this->form_validation->set_message('required', '%s is required.');

    if($this->form_validation->run())
    {
        $result = $this->Player_model->login($this->input->post('mobile'), $this->input->post('password'));

        if($result)
        {
            $player = $this->Player_model->get_player_by_params(['account' => $this->input->post('mobile')]);

            $response = [
                'success' => true,
                'message' => 'Logged in successfully',
                'data' => [
                    'token' => $this->Player_model->generate_player_token($player['id']),
                    'name' => $player['first_name']
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

public function login_check_post()
{
    $this->form_validation->set_rules('account', 'Account', 'required');
    $this->form_validation->set_rules('type', 'Type', 'required');

    $this->form_validation->set_message('required', '%s is required.');

    if($this->form_validation->run())
    {
        $player = $this->Player_model->get_player_by_params(array('account' => $this->input->post('account')));

        if(!empty($player))
        {
            if($this->input->post('type') == 'mobile') 
            {
                if($player['verified'] && $player['account'])
                {
                    $response = [
                        'success' => true,
                        'message' => 'Player exists, login with password',
                        'data' => [
                            'password' => 1
                        ]
                    ];

                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
                else
                {
                    $otp = random_string('numeric', 4);
                    $this->_send_otp($player['mobile'], $otp);

                    $data = [
                        'otp' => $otp
                    ];

                    $this->Player_model->update($player['id'], $data);

                    $response = [
                        'success' => true,
                        'message' => 'Player exists, first verify with otp',
                        'data' => [
                            'otp' => 1
                        ]
                    ];

                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
            }
            else
            {
                if($player['verified'] && $player['account'])
                {
                    $response = [
                        'success' => true,
                        'message' => 'Player exists, logged in successfully',
                        'data' => [
                            'token' => $this->Player_model->generate_player_token($player['id']),
                            'name' => $player['first_name'],
                        ]
                    ];

                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
                else
                {
                    $response = [
                        'success' => true,
                        'message' => 'Player exists, register',
                        'data' => [
                            'register' => 1
                        ]
                    ];

                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
            }
        }
        else
        {
            if($this->input->post('type') == 'mobile') 
            {
                $otp = random_string('numeric', 4);
                $this->_send_otp($this->input->post('account'), $otp);

                $data = [
                    'mobile' => $this->input->post('account'),
                    'otp' => $otp
                ];

                $this->Player_model->add($data);

                $response = [
                    'success' => true,
                    'message' => 'Player does not exist, otp',
                    'data' => [
                        'otp' => 1
                    ]
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
            else
            {
                $data = [
                    'email' => $this->input->post('account')
                ];

                $this->Player_model->add($data);

                $response = [
                    'success' => true,
                    'message' => 'Player does not exist , register',
                    'data' => [
                        'register' => 1
                    ]
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
        }
    }
    else
    {
        $this->return_form_errors($this->form_validation->error_array());
    }
}

public function otp_post()
{   
    $this->form_validation->set_rules('account', 'Account', 'required');
    $this->form_validation->set_rules('type', 'Type', 'required');
    $this->form_validation->set_rules('otp', 'Otp', 'required');

    $this->form_validation->set_message('required', '%s is required.');

    if($this->form_validation->run())
    {
        $player = $this->Player_model->get_player_by_params(array('account' => $this->input->post('account')));


        if(!empty($player))
        {
            if($this->input->post('type') == 'mobile') 
            {   
                if($player['otp'] == $this->input->post('otp'))
                {
                    $data = [
                        'verified' => 1
                    ];

                    $this->Player_model->update($player['id'], $data);

                    $response = [
                        'success' => true,
                        'message' => 'Player exists, register',
                        'data' => [
                            'register' => 1
                        ]
                    ];

                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
                else
                {
                    $response = [
                        'success' => false,
                        'message' => 'Invalid OTP entered'
                    ];
                }
            }
            else
            {
                if($player['otp'] == $this->input->post('otp'))
                {
                    $data = [
                        'verified' => 1
                    ];

                    $this->Player_model->update($player['id'], $data);

                    $response = [
                        'success' => true,
                        'message' => 'Player exists, logged in successfully',
                        'data' => [
                            'token' => $this->Player_model->generate_player_token($player['id']),
                            'name' => $player['first_name'],
                        ]
                    ];

                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
                else
                {
                    $response = [
                        'success' => false,
                        'message' => 'Invalid OTP entered'
                    ];
                }
            }
        }
        else
        {
            $response = [
                'success' => false,
                'message' => 'Player does not exist'
            ];
        }
        $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
    }
    else
    {
        $this->return_form_errors($this->form_validation->error_array());
    }
}

public function resend_otp_post()
{
    $this->form_validation->set_rules('account', 'Account', 'required');
    $this->form_validation->set_message('required', '%s is required.');

    if($this->form_validation->run())
    {
        $player = $this->Player_model->get_player_by_params(array('account' => $this->input->post('account')));

        if(!empty($player))
        {
            $otp = random_string('numeric', 4);
            $this->_send_otp($player['mobile'], $otp);

            $data = [
                'otp' => $otp
            ];

            $this->Player_model->update($player['id'], $data);

            $response = [
                'success' => true,
                'message' => 'Player exists, otp',
                'data' => [
                    'otp' => 1
                ]
            ];

            $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);

        }
        else
        {
            $response = [
                'success' => false,
                'message' => 'Player does not exist'
            ];
        }
        $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
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

public function forgot_password_post()
{
    $this->form_validation->set_rules('mobile', 'Mobile', 'required');

    $this->form_validation->set_message('required', '%s is required.');
    $this->form_validation->set_message('exist', '%s is not registered with us.');

    if($this->form_validation->run())
    {
        $player = $this->Player_model->get_player_by_params(['mobile' => $this->input->post('mobile')]);
        $otp = random_string('numeric', 4);
        $this->_send_otp($player['mobile'], $otp);
        $result = $this->Player_model->update($player['id'], ['forgot_password_key' => $otp]);

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
                'message' => 'Some error occured while sending the reset password otp'
            ];

            $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
        }
    }
    else
    {
        $this->return_form_errors($this->form_validation->error_array());
    }
}

public function change_password_post()
{

    $this->form_validation->set_rules('mobile', 'Mobile', 'required');
    $this->form_validation->set_rules('otp', 'OTP', 'required|min_length[4]|is_numeric');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|md5');

    $this->form_validation->set_message('required', '%s is required.');
    $this->form_validation->set_message('exist', '%s is not registered with us.');

    if($this->form_validation->run())
    {
        $player = $this->Player_model->get_player_by_params(['mobile' => $this->input->post('mobile')]);

        if($player['forgot_password_key'] == $this->input->post('otp'))
        {
            $result = $this->Player_model->update($player['id'], ['forgot_password_key' => null, 'password' => $this->input->post('password')]);

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
                'message' => 'Invalid reset password otp'
            ];

            $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
        }
    }
    else
    {
        $this->return_form_errors($this->form_validation->error_array());
    }
}

public function device_post()
{
    if($this->authenticate_token())
    {
        $this->form_validation->set_rules('registration_token', 'Registration token', 'required');
        $this->form_validation->set_rules('imei', 'IMEI', 'required');

        $this->form_validation->set_message('required', '%s is required.');

        if($this->form_validation->run())
        {
            $data = [
                'registration_token' => $this->input->post('registration_token'),
                'imei' => $this->input->post('imei')
            ];

            $result = $this->Device_model->update_by_api_token($this->token, $data);

            if($result)
            {
                $response = [
                    'success' => true,
                    'message' => 'Device added successfully'
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
            else
            {
                $response = [
                    'success' => false,
                    'message' => 'Some error occured while adding the device'
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

public function device_get()
{
    if($this->authenticate_token())
    {
        if(trim($this->input->get('imei')))
        {
            $data = [
                'player_id' => $this->player['id'],
                'imei' => $this->input->get('imei')
            ];

            $result = $this->Device_model->remove($data);

            if($result)
            {
                $response = [
                    'success' => true,
                    'message' => 'Device removed successfully'
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
            else
            {
                $response = [
                    'success' => false,
                    'message' => 'Device not found'
                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
            }
        }
        else
        {
            $response = [
                'success' => false,
                'message' => 'Error',
                'errors' => [
                    [
                        'field' => "imei",
                        'message' => "IMEI is required."
                    ]
                ]
            ];

            $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
        }
    }
}

private function uploadImage()
{
    if($this->input->post('image'))
    {
        $image = $this->input->post('image');
        $file_name = time() . '_' . rand(0000, 1111) . '.' . get_file_extension($image);
        $path = FCPATH . 'uploads/players/profile/' . $file_name;

        if(base64_to_image($image, $path)) {
            return $file_name;
        }
    }

    return null;
}



public function facebookCallback()
{
    if($this->facebook->is_authenticated())
{// Player logged in, get player details

    $player = $this->facebook->request('get', '/me?fields=id,name,email');
    if(!isset($player['error']) && !empty($player['email']))
    {
        $player = $this->db->get_where('players', array('email' => $player['email']))->row_array();
        if(!empty($player)) 
        {
            if($player['is_active'] == 1) {
                $this->player_id = $player['id'];
            } 
            else 
            {
                $this->session->set_flashdata('error', 'Sports account is disabled, please contact admin');
                redirect('account');
                exit;
            }
        } else 
        {
            $name = explode(" ", $player['name']);

            $data = array(
                'first_name' => $name[0],
                'last_name' => $name[1],
                'phone' => '',
                'email' => $player['email'],
                'pass' => rand(0000000000,1111111111),
                'registration_latitude' => '',
                'registration_longitude' => ''
            );

            $this->player_id = $this->Public_model->registerPlayer($data);
        }

        $_SESSION['logged_player'] = $this->player_id; 
        redirect(LANG_URL);
    }
}

$this->session->set_flashdata('error', 'Facebook account not setup / email not verified');
redirect('account');
exit;
}


private function _send_otp($mobile, $otp)
{  
    $message = "Your OTP is ".$otp;
    sms("+91".$mobile, $message);
}


}
