<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Email_model');
        $this->load->model('Turf_model');
        $this->load->model('Booking_model');
        $this->load->model('Manager_model');
    }

    public function index()
    {
        if($this->admin['id'])
        {
            redirect('admin/dashboard');
            exit;
        }

        $this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|md5');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

        if($this->form_validation->run())
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $result = $this->Admin_model->login($username, $password);

            if($result)
            {
                $this->session->set_flashdata('success_message', 'Logged in successfully');
                redirect('admin/dashboard');
                exit;
            }
            else
            {
                $this->session->set_flashdata('error_message', 'Invalid login credentials');
                redirect('admin');
                exit;
            }
        }
        else
        {
            $data['title'] = 'Login to your account';
            $this->load->view('admin/user/index', $data);
        }
    }

    public function dashboard()
    {
        $this->authenticate(current_url());

        $filters = $this->input->get();
        $data['all_turfs'] = $this->Turf_model->get_all_turfs(null, null, ['select' => 't.id, t.name']);
        $data['all_managers'] = $this->Manager_model->get_all_managers(null, null, ['select' => 'm.id, m.company_name']);
        $data['turfs'] = $this->Turf_model->get_all_turfs(null, null, $filters);

        $date = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m-d');
        $timestamp = strtotime($date);
        $day = date('l', $timestamp);

        $params = [];
        $params['from_date'] =  ($this->input->get('from_date')) ? $this->input->get('from_date') : date('Y-m-')."01";
        $params['to_date'] =  ($this->input->get('to_date')) ? $this->input->get('to_date') : date('Y-m-d');
        $params['today'] = $date;

        foreach ($data['turfs'] as $key => $turf)
        {
            $data['turfs'][$key]['report'] = $this->Booking_model->get_booking_data($turf['id'], $params);
            $data['turfs'][$key]['slots'] = $this->Turf_model->get_all_turf_slots($turf['id'], $day);
            $data['turfs'][$key]['booked_slots'] = $this->Turf_model->get_all_turf_booked_slots($turf['id'], $day, $date);
            $data['turfs'][$key]['recent_bookings'] = $this->Booking_model->get_all_bookings(null, null, ['turf_id' => $turf['id'], 'booking_date' => $date]);
            $data['turfs'][$key]['cancelled_bookings'] = $this->Booking_model->get_all_bookings(null, null, ['turf_id' => $turf['id'], 'status' => TURF_STATUS_CANCELLED, 'booking_date' => $date]);
        }

        $data['date'] = $params;

        $data['tab'] = 'dashboard';
        $data['title'] = 'View dashboard activity';
        $data['_view'] = 'admin/user/dashboard';
        $this->load->view('admin/layout/basetemplate', $data);
    }

    public function report()
    {
        $this->authenticate(current_url());

        $filters = $this->input->get();
        $data['all_turfs'] = $this->Turf_model->get_all_turfs(null, null, ['select' => 't.id, t.name']);
        $data['all_managers'] = $this->Manager_model->get_all_managers(null, null, ['select' => 'm.id, m.company_name']);
        $data['turfs'] = $this->Turf_model->get_all_turfs(null, null, $filters);

        $date = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m-d');
        $timestamp = strtotime($date);
        $day = date('l', $timestamp);

        $params = [];
        $params['from_date'] =  ($this->input->get('from_date')) ? $this->input->get('from_date') : date('Y-m-')."01";
        $params['to_date'] =  ($this->input->get('to_date')) ? $this->input->get('to_date') : date('Y-m-d');
        $params['today'] = $date;

        $data['report'] = $this->Booking_model->get_booking_data(null, $params);

        foreach ($data['turfs'] as $key => $turf)
        {
            $data['turfs'][$key]['report'] = $this->Booking_model->get_booking_data($turf['id'], $params);
            $data['turfs'][$key]['recent_bookings'] = $this->Booking_model->get_all_bookings(5, null, ['turf_id' => $turf['id'], 'booking_date' => $date]);
            $data['turfs'][$key]['cancelled_bookings'] = $this->Booking_model->get_all_bookings(5, null, ['turf_id' => $turf['id'], 'status' => TURF_STATUS_CANCELLED, 'booking_date' => $date]);
        }

        $data['date'] = $params;

        $data['tab'] = 'report';
        $data['title'] = 'View dashboard reports';
        $data['_view'] = 'admin/user/report';
        $this->load->view('admin/layout/basetemplate', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect();
        exit;
    }

    public function forgot_password()
    {
        if($this->admin['id'])
        {
            redirect('admin/dashboard');
            exit;
        }

        $this->form_validation->set_rules('username', 'Username', 'required|xss_clean');

        $this->form_validation->set_error_delimiters('<div class="text-danger p-2">', '</div>');

        if($this->form_validation->run())
        {
            $admin = $this->Admin_model->get_admin_by_params(['email' => $this->input->post('email')]);

            if(!empty($admin))
            {
                $otp = otp();
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