<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends ManagerController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Email_model');
        $this->load->model('Manager_model');

    }

    public function index()
    {
        if($this->manager['id'])
        {
            redirect('manager/dashboard');
            exit;
        }

        $this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

        if($this->form_validation->run())
        {
            $manager = $this->Manager_model->get_manager_by_params(['mobile' => $this->input->post('mobile')]);

            if(empty($manager) || empty($manager['company_name']))
            {
                $otp = random_string('numeric', 6);

                $data = [
                    'mobile' => $this->input->post('mobile'),
                    'otp' => $otp
                ];

                if(empty($manager))
                {
                    $result = $this->Manager_model->add($data);
                }
                else
                {
                    $result = $this->Manager_model->update($manager['id'], $data);
                }

                $this->session->set_flashdata('success_message', 'OTP has been sent to your mobile number');
                redirect('manager/otp?mobile='.$data['mobile']);
                exit;
            }
            else
            {
                redirect('manager/password?mobile='.$manager['mobile']);
                exit;
            }
        }
        else
        {
            $data['title'] = 'Login to your account';
            $this->load->view('manager/user/index', $data);
        }
    }

    public function otp()
    {
        if($this->manager['id'])
        {
            redirect('manager/dashboard');
            exit;
        }

        $this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');
        $this->form_validation->set_rules('otp', 'OTP', 'required|xss_clean');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

        if($this->form_validation->run())
        {
            $manager = $this->Manager_model->get_manager_by_params(['mobile' => $this->input->post('mobile')]);

            if(empty($manager))
            {
                $this->session->set_flashdata('error_message', 'Account does not exist');
                redirect('manager');
                exit;
            }
            else
            {
                if($manager['otp'] == $this->input->post('otp'))
                {
                    redirect('manager/register?mobile='.$manager['mobile'].'&otp='.$manager['otp']);
                    exit;
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Invalid OTP');
                    redirect('manager/otp?mobile='.$manager['mobile']);
                    exit;
                }
            }
        }
        else
        {
            $data['title'] = 'Verify your mobile number';
            $this->load->view('manager/user/otp', $data);
        }
    }

    public function password()
    {
        if($this->manager['id'])
        {
            redirect('manager/dashboard');
            exit;
        }

        $this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|md5|xss_clean');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

        if($this->form_validation->run())
        {
            $manager = $this->Manager_model->get_manager_by_params(['mobile' => $this->input->post('mobile')]);

            if(empty($manager))
            {
                $this->session->set_flashdata('error_message', 'Account does not exist');
                redirect('manager');
                exit;
            }
            else
            {
                $result = $this->Manager_model->login($this->input->post('mobile'), $this->input->post('password'));

                if($result)
                {
                    $this->session->set_flashdata('success_message', 'Logged in successfully');
                    redirect('manager/dashboard');
                    exit;
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Invalid password');
                    redirect('manager/password?mobile='.$manager['mobile']);
                    exit;
                }
            }
        }
        else
        {
            $data['title'] = 'Verify your password';
            $this->load->view('manager/user/password', $data);
        }
    }

    public function register()
    {
        if($this->manager['id'])
        {
            redirect('manager/dashboard');
            exit;
        }

        $this->form_validation->set_rules('company_name', 'Company name', 'required|xss_clean');
        $this->form_validation->set_rules('contact_person', 'Contact person', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|check_field[managers,email,deleted|0]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|xss_clean');
        $this->form_validation->set_rules('retype_password', 'Retype password', 'required|min_length[6]|matches[password]|xss_clean');

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
                    // $this->Email_model->send_registration_email($data['company_name'], $data['email']);
                    $this->Manager_model->set_user_session(['manager_id' => $result, 'manager_name' => $data['company_name']]);
                    redirect('manager/dashboard');
                    exit;
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Some error occured while registering the account');
                    redirect('manager/register');
                    exit;
                }
            }
            else
            {
                if(empty($manager['company_name']))
                {
                    $this->session->set_flashdata('error_message', 'Mobile number could not be verified');
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Please login to continue');
                }

                redirect('manager');
                exit;
            }
        }
        else
        {
            $data['title'] = 'Create your account';
            $this->load->view('manager/user/register', $data);
        }
    }

    public function dashboard()
    {
        $this->authenticate(current_url());

        $data['tab'] = 'dashboard';
        $data['title'] = 'View your dashboard activity';
        $data['_view'] = 'manager/user/dashboard';
        $this->load->view('manager/layout/basetemplate', $data);
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
            redirect('my-account');
            exit;
        }

        $this->form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean');

        $this->form_validation->set_error_delimiters('<div class="text-danger p-2">', '</div>');

        if($this->form_validation->run())
        {
            $player = $this->Player_model->get_player_by_params(['email' => $this->input->post('email')]);

            if(!empty($player))
            {
                $forgot_password_key = random_string('alnum', 16);
                $this->Email_model->send_forgot_password_link($player['full_name'], $player['email'], $forgot_password_key);

                $data = [
                    'forgot_password_key' => $forgot_password_key
                ];

                $result = $this->Player_model->update($player['id'], $data);

                if($result)
                {
                    $this->session->set_flashdata('success_message', 'Reset password mail has been sent to your email');
                    redirect('forgot-password');
                    exit;
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Some error occured while sending the reset password mail');
                    redirect('forgot-password');
                    exit;
                }
            }
            else
            {
                $this->session->set_flashdata('error_message', 'This email is not registered with us');
                redirect('forgot-password');
                exit;
            }
        }
        else
        {
            $data['title'] = 'Forgot Password';
            $data['_view'] = 'front/player/forgot-password';
            $this->load->view('front/layout/basetemplate', $data);
        }
    }

    public function reset_password()
    {
        if($this->player['id'])
        {
            redirect('my-account');
            exit;
        }

        $player = $this->Player_model->get_player_by_params(['forgot_password_key' => $this->input->post('key')]);

        if(!empty($player))
        {
            $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
            $this->form_validation->set_rules('retype_password', 'confirm password', 'required|min_length[6]|matches[password]');

            $this->form_validation->set_error_delimiters('<div class="text-danger p-2">', '</div>');

            if($this->form_validation->run())
            {
                $data = [
                    'forgot_password_key' => null,
                    'password' => md5($this->input->post('password'))
                ];

                $result = $this->Player_model->update($player['id'], $data);

                if($result)
                {
                    $this->session->set_flashdata('success_message', 'Password has been updated successfully');
                    redirect('account');
                    exit;
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Some error occured while resetting the password');
                    redirect('forgot-password');
                    exit;
                }
            }
            else
            {
                $data['title'] = 'Reset Password';
                $data['_view'] = 'front/player/reset-password';
                $this->load->view('front/layout/basetemplate', $data);
            }
        }
        else
        {
            redirect();
            exit;
        }
    }

    public function profile()
    {
        $this->authenticate(current_url());

        $this->form_validation->set_rules('company_name', 'Company name', 'required|xss_clean');
        $this->form_validation->set_rules('contact_person', 'Contact person', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|check_field[managers,email,deleted|0&id !=|'.$this->manager['id'].']|xss_clean');

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
                $this->session->set_flashdata('success_message', 'Account details updated successfully');
                redirect('manager/profile');
                exit;
            }
            else
            {
                $this->session->set_flashdata('error_message', 'Some error occured while updating the account details');
                redirect('manager/profile');
                exit;
            }
        }
        else
        {
            $data['manager'] = $this->Manager_model->get_manager_by_id($this->manager['id']);

            $data['title'] = 'Profile';
            $data['_view'] = 'manager/user/profile';
            $this->load->view('manager/layout/basetemplate', $data);
        }
    }
}