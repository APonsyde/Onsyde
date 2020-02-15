<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends ManagerController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Turf_model');
        $this->load->model('Email_model');
        $this->load->model('Booking_model');
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

        if($this->input->post())
            $_POST['otp'] = implode("", $this->input->post('code'));

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
                    $this->session->set_flashdata('error_message', 'Invalid credentials / account has been locked by the admin');
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
                    $this->Email_model->send_registration_email($data['company_name'], $data['email']);
                    $this->Manager_model->set_manager_session(['manager_id' => $manager['id'], 'manager_name' => $data['company_name']]);
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

        $filters = $this->input->get();
        $filters['manager_id'] = $this->manager['id'];

        $offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
        $data['turfs'] = $this->Turf_model->get_all_turfs(null, null, $filters);

        $date = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m-d');
        $timestamp = strtotime($date);
        $day = date('l', $timestamp);

        foreach ($data['turfs'] as $key => $turf)
        {
            $data['turfs'][$key]['slots'] = $this->Turf_model->get_all_turf_slots($turf['id'], $day);
            $data['turfs'][$key]['booked_slots'] = $this->Turf_model->get_all_turf_booked_slots($turf['id'], $day, $date);
            $data['turfs'][$key]['recent_bookings'] = $this->Booking_model->get_all_bookings(5, null, ['turf_id' => $turf['id']]);
            $data['turfs'][$key]['cancelled_bookings'] = $this->Booking_model->get_all_bookings(5, null, ['turf_id' => $turf['id'], 'status' => TURF_STATUS_CANCELLED]);
        }

        $data['tab'] = 'dashboard';
        $data['title'] = 'View your dashboard activity';
        $data['_view'] = 'manager/user/dashboard';
        $this->load->view('front/layout/basetemplate', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect();
        exit;
    }

    public function forgot_password()
    {
        if($this->manager['id'])
        {
            redirect('manager/dashboard');
            exit;
        }

        $this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');

        $this->form_validation->set_error_delimiters('<div class="text-danger p-2">', '</div>');

        if($this->form_validation->run())
        {
            $manager = $this->Manager_model->get_manager_by_params(['mobile' => $this->input->post('mobile')]);

            if(!empty($manager))
            {
                $otp = random_string('numeric', 6);
                $message = "Your OTP is ".$otp;
                sms("+91".$manager['mobile'], $message);

                $data = [
                    'forgot_password_key' => $otp
                ];

                $result = $this->Manager_model->update($manager['id'], $data);

                if($result)
                {
                    $this->session->set_flashdata('success_message', 'Reset password code has been sent to your number');
                    redirect('manager/reset-password?mobile='.$manager['mobile']);
                    exit;
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Some error occured while sending the reset password code');
                    redirect('manager/forgot-password');
                    exit;
                }
            }
            else
            {
                $this->session->set_flashdata('error_message', 'This mobile is not registered with us');
                redirect('manager/forgot-password');
                exit;
            }
        }
        else
        {
            $data['title'] = 'Forgot Password';
            $this->load->view('manager/user/forgot-password', $data);
        }
    }

    public function reset_password()
    {
        if($this->manager['id'])
        {
            redirect('manager/dashboard');
            exit;
        }

        $account = $this->Manager_model->get_manager_by_params(['mobile' => $this->input->get('mobile')]);

        if(!empty($account))
        {
            $this->form_validation->set_rules('otp', 'OTP', 'required|min_length[6]');
            $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
            $this->form_validation->set_rules('retype_password', 'confirm password', 'required|min_length[6]|matches[password]');

            $this->form_validation->set_error_delimiters('<div class="text-danger p-2">', '</div>');

            if($this->form_validation->run())
            {
                $manager = $this->Manager_model->get_manager_by_params(['mobile' => $this->input->get('mobile'), 'forgot_password_key' => $this->input->post('otp')]);

                if(!empty($manager))
                {
                    $data = [
                        'forgot_password_key' => null,
                        'password' => md5($this->input->post('password'))
                    ];

                    $result = $this->Manager_model->update($manager['id'], $data);

                    if($result)
                    {
                        $this->session->set_flashdata('success_message', 'Password has been updated successfully');
                        redirect('manager');
                        exit;
                    }
                    else
                    {
                        $this->session->set_flashdata('error_message', 'Some error occured while resetting the password');
                        redirect('manager/forgot-password');
                        exit;
                    }
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Invalid OTP entered');
                    redirect('manager/reset-password?mobile='.$account['mobile']);
                    exit;
                }
            }
            else
            {
                $data['title'] = 'Reset Password';
                $this->load->view('manager/user/reset-password', $data);
            }
        }
        else
        {
            redirect('manager');
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
            $this->load->view('front/layout/basetemplate', $data);
        }
    }
}