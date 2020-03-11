<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends FrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Email_model');
        $this->load->model('Player_model');
        $this->load->model('Booking_model');
        $this->load->model('Turf_model');
    }

    public function index()
    {
        if($this->player['id'])
        {
            redirect();
            exit;
        }

        $this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

        if($this->form_validation->run())
        {
            $player = $this->Player_model->get_player_by_params(['mobile' => $this->input->post('mobile')]);

            if(empty($player) || $player['inactive'])
            {
                $otp = otp();

                $data = [
                    'inactive' => 1,
                    'mobile' => $this->input->post('mobile'),
                    'otp' => $otp
                ];

                $message = "Your OTP is ".$otp;
                sms("+91".$data['mobile'], $message);

                if(empty($player))
                {
                    $result = $this->Player_model->add($data);
                }
                else
                {
                    $result = $this->Player_model->update($player['id'], $data);
                }

                $this->session->set_flashdata('success_message', 'OTP has been sent to your mobile number');
                redirect('player/otp?mobile='.$data['mobile']);
                exit;
            }
            else
            {
                redirect('player/password?mobile='.$player['mobile']);
                exit;
            }
        }
        else
        {
            $data['title'] = 'Login to your account';
            $this->load->view('player/user/index', $data);
        }
    }

    public function otp()
    {
        if($this->player['id'])
        {
            redirect();
            exit;
        }

        if($this->input->post())
            $_POST['otp'] = implode("", $this->input->post('code'));

        $this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');
        $this->form_validation->set_rules('otp', 'OTP', 'required|xss_clean');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

        if($this->form_validation->run())
        {
            $player = $this->Player_model->get_player_by_params(['mobile' => $this->input->post('mobile')]);

            if(empty($player))
            {
                $this->session->set_flashdata('error_message', 'Account does not exist');
                redirect('player');
                exit;
            }
            else
            {
                if($player['otp'] == $this->input->post('otp'))
                {
                    redirect('player/register?mobile='.$player['mobile'].'&otp='.$player['otp']);
                    exit;
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Invalid OTP');
                    redirect('player/otp?mobile='.$player['mobile']);
                    exit;
                }
            }
        }
        else
        {
            $data['title'] = 'Verify your mobile number';
            $this->load->view('player/user/otp', $data);
        }
    }

    public function password()
    {
        if($this->player['id'])
        {
            redirect();
            exit;
        }

        $this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|md5|xss_clean');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

        if($this->form_validation->run())
        {
            $player = $this->Player_model->get_player_by_params(['mobile' => $this->input->post('mobile')]);

            if(empty($player))
            {
                $this->session->set_flashdata('error_message', 'Account does not exist');
                redirect('player');
                exit;
            }
            else
            {
                $result = $this->Player_model->login($this->input->post('mobile'), $this->input->post('password'));

                if($result)
                {
                    if($this->session->userdata('booking_data'))
                    {
                        $this->_continue_booking();
                    }
                    else
                    {
                        $this->session->set_flashdata('success_message', 'Logged in successfully');
                        redirect();
                        exit;
                    }
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Invalid credentials');
                    redirect('player/password?mobile='.$player['mobile']);
                    exit;
                }
            }
        }
        else
        {
            $data['title'] = 'Verify your password';
            $this->load->view('player/user/password', $data);
        }
    }

    public function register()
    {
        if($this->player['id'])
        {
            redirect();
            exit;
        }

        $data['name'] = $this->Player_model->get_player_name_from_mobile($this->input->get('mobile'));

        $this->form_validation->set_rules('full_name', 'Name', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|check_field[players,email,deleted|0]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|xss_clean');
        $this->form_validation->set_rules('retype_password', 'Retype password', 'required|min_length[6]|matches[password]|xss_clean');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('valid_email', '%s is invalid');
        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

        if($this->form_validation->run())
        {
            $player = $this->Player_model->get_player_by_params(['mobile' => $this->input->post('mobile'), 'otp' => $this->input->post('otp')]);

            if(!empty($player) && empty($player['full_name']))
            {
                $data = [
                    'full_name' => $this->input->post('full_name'),
                    'email' => $this->input->post('email'),
                    'password' => md5($this->input->post('password')),
                    'inactive' => 0,
                    'otp' => null
                ];

                $result = $this->Player_model->update($player['id'], $data);

                if($result)
                {
                    $this->Email_model->send_registration_email($data['full_name'], $data['email']);
                    $this->Player_model->set_player_session(['player_id' => $player['id'], 'player_name' => $data['full_name']]);

                    if($this->session->userdata('booking_data'))
                    {
                        $this->_continue_booking();
                    }
                    else
                    {
                        redirect('player/profile#preferences');
                        exit;
                    }
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Some error occured while registering the account');
                    redirect('player/register');
                    exit;
                }
            }
            else
            {
                if($player['inactive'])
                {
                    $this->session->set_flashdata('error_message', 'Mobile number could not be verified');
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Please login to continue');
                }

                redirect('player');
                exit;
            }
        }
        else
        {
            $data['title'] = 'Create your account';
            $this->load->view('player/user/register', $data);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect();
        exit;
    }

    public function forgot_password()
    {
        if($this->player['id'])
        {
            redirect();
            exit;
        }

        $this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');

        $this->form_validation->set_error_delimiters('<div class="text-danger p-2">', '</div>');

        if($this->form_validation->run())
        {
            $player = $this->Player_model->get_player_by_params(['mobile' => $this->input->post('mobile')]);

            if(!empty($player))
            {
                $otp = otp();
                $message = "Your OTP is ".$otp;
                sms("+91".$player['mobile'], $message);

                $data = [
                    'forgot_password_key' => $otp
                ];

                $result = $this->Player_model->update($player['id'], $data);

                if($result)
                {
                    $this->session->set_flashdata('success_message', 'Reset password code has been sent to your number');
                    redirect('player/reset-password?mobile='.$player['mobile']);
                    exit;
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Some error occured while sending the reset password code');
                    redirect('player/forgot-password');
                    exit;
                }
            }
            else
            {
                $this->session->set_flashdata('error_message', 'This mobile is not registered with us');
                redirect('player/forgot-password');
                exit;
            }
        }
        else
        {
            $data['title'] = 'Forgot Password';
            $this->load->view('player/user/forgot-password', $data);
        }
    }

    public function reset_password()
    {
        if($this->player['id'])
        {
            redirect();
            exit;
        }

        $account = $this->Player_model->get_player_by_params(['mobile' => $this->input->get('mobile')]);

        if(!empty($account))
        {
            $this->form_validation->set_rules('otp', 'OTP', 'required|min_length[6]');
            $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
            $this->form_validation->set_rules('retype_password', 'confirm password', 'required|min_length[6]|matches[password]');

            $this->form_validation->set_error_delimiters('<div class="text-danger p-2">', '</div>');

            if($this->form_validation->run())
            {
                $player = $this->Player_model->get_player_by_params(['mobile' => $this->input->get('mobile'), 'forgot_password_key' => $this->input->post('otp')]);

                if(!empty($player))
                {
                    $data = [
                        'forgot_password_key' => null,
                        'password' => md5($this->input->post('password'))
                    ];

                    $result = $this->Player_model->update($player['id'], $data);

                    if($result)
                    {
                        $this->session->set_flashdata('success_message', 'Password has been updated successfully');
                        redirect('player');
                        exit;
                    }
                    else
                    {
                        $this->session->set_flashdata('error_message', 'Some error occured while resetting the password');
                        redirect('player/forgot-password');
                        exit;
                    }
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Invalid OTP entered');
                    redirect('player/reset-password?mobile='.$account['mobile']);
                    exit;
                }
            }
            else
            {
                $data['title'] = 'Reset Password';
                $this->load->view('player/user/reset-password', $data);
            }
        }
        else
        {
            redirect('player');
            exit;
        }
    }

    public function profile()
    {
        $this->authenticate(current_url());

        $this->form_validation->set_rules('full_name', 'Company name', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|check_field[players,email,deleted|0&id !=|'.$this->player['id'].']|xss_clean');

        if(trim($this->input->post('password')) !== "")
        {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|xss_clean');
            $this->form_validation->set_rules('retype_password', 'Retype password', 'required|min_length[6]|matches[password]|xss_clean');
        }

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('valid_email', '%s is invalid');
        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

        if($this->form_validation->run())
        {
            $data = $this->input->post();
            unset($data['password']);
            unset($data['retype_password']);

            $data['play_in_locations'] = json_encode([
                $data['location_1'],
                $data['location_2'],
                $data['location_3'],
            ]);

            unset($data['location_1']);
            unset($data['location_2']);
            unset($data['location_3']);

            if(trim($this->input->post('password')) !== "")
            {
                $data['password'] = md5($this->input->post('password'));
            }

            $result = $this->Player_model->update($this->player['id'], $data);

            if($result)
            {
                $this->session->set_flashdata('success_message', 'Profile updated successfully');
                redirect('player/profile');
                exit;
            }
            else
            {
                $this->session->set_flashdata('error_message', 'Some error occured while updating the profile details');
                redirect('player/profile');
                exit;
            }
        }
        else
        {
            $data['player'] = $this->Player_model->get_player_by_id($this->player['id']);

            $data['title'] = 'Profile';
            $data['_view'] = 'player/user/profile';
            $this->load->view('front/layout/basetemplate', $data);
        }
    }

    private function _continue_booking()
    {
        $_POST = json_decode($this->session->userdata('booking_data'), true);
        $this->session->unset_userdata('booking_data');

        $date = ($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');
        $slots = $this->input->post('slot');
        $slot_selection_type = TURF_SLOT_GROUPED;

        $player = $this->Player_model->get_player_by_id($this->session->userdata('player_id'));

        $this->player = [
            'id' => $player['id'],
            'name' => $player['full_name'],
            'email' => $player['email'],
            'mobile' => $player['mobile']
        ];

        $turf = $this->Turf_model->get_turf_by_id($this->input->post('turf_id'));

        if(!empty($turf))
        {
            $slots_info = $this->Turf_model->get_turf_slots_info($slots);

            $amount = 0;
            $time_slot = null;

            if($slot_selection_type == TURF_SLOT_INDIVIDUAL)
            {
                $prev_slot = null;

                foreach ($slots_info as $key => $slot)
                {
                    if($key == 0)
                    {
                        $time_slot .= $slot['time'];
                    }
                    else
                    {
                        $prev_slot_end_time = date("h:i a", strtotime('+30 minutes', strtotime($prev_slot['time'])));

                        if($prev_slot_end_time !== $slot['time'])
                        {
                            $time_slot .= " - ".$prev_slot_end_time.", ".$slot['time'];
                        }
                    }

                    $prev_slot = $slot;
                }
            }
            else
            {
                $first = $slots_info[0];
                $time_slot = $first['time'];
            }

            $last = end($slots_info);
            $time_slot .=  " - " . date("h:i a", strtotime('+30 minutes', strtotime($last['time'])));

            foreach ($slots_info as $key => $slot)
            {
                $amount += $slot['price'];
            }

            $data = [
                'booking_date' => $date,
                'player_id' => $this->player['id'],
                'turf_id' => $this->input->post('turf_id'),
                'amount' => $amount,
                'time_slot' => $time_slot
            ];

            $result = $this->Booking_model->book($data, $slots_info);

            if($result)
            {
                if(!empty($this->player['email']))
                {
                    $users = [$this->player];
                    $subject = PROJECT_NAME.' - Booking Confirmed!';
                    $message = 'Your booking for '.$turf['name'].' has been confirmed for the time slot(s) '.$time_slot.' totalling Rs '.$amount.' /-.';

                    $this->Email_model->notify($users, $subject, $message);
                }

                if(!empty($this->player['mobile']))
                {
                    $message = 'Your booking for '.$turf['name'].' has been confirmed for the time slot(s) '.$time_slot.' totalling Rs '.$amount.' /-.';
                    sms("+91".$this->player['mobile'], $message);
                }

                $message = 'You have a new booking for '.$turf['name'].' for the time slot(s) '.$time_slot.' totalling Rs '.$amount.' /-.';
                sms("+91".$turf['contact_mobile'], $message);

                $booking = $this->Booking_model->get_booking_by_id($result);
                redirect('booking/success/'.$booking['booking_key']);
                exit;
            }
            else
            {
                $this->session->set_flashdata('error_message', 'Some error occured while confirming the booking');
                redirect('find-a-turf/'.$slot_selection_type.'?date='.$date);
                exit;
            }
        }
        else
        {
            $this->session->set_flashdata('error_message', 'Turf not found');
            redirect('find-a-turf/'.$slot_selection_type.'?date='.$date);
            exit;
        }
    }
}