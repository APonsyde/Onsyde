<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends AdminController { 

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
// $this->load->model('Email_model');
    }

    public function index()
    {
        if($this->user['id'])
        {
            redirect('admin/dashboard');
            exit;
        }

        $this->form_validation->set_rules('username', 'username', 'required|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'required|md5');

        $this->form_validation->set_error_delimiters('<div class="text-danger p-2">', '</div>');

        if($this->form_validation->run())
        {
            $result = $this->User_model->login($this->input->post('username'), $this->input->post('password'));

            if($result)
            {
                $this->session->set_flashdata('success_message', 'Logged in successfully');

                if($this->input->get('redirect_to'))
                    redirect($this->input->get('redirect_to'));
                else
                    redirect('admin/dashboard');

                exit;
            }
            else
            {
                $this->session->set_flashdata('error_message', 'Invalid username / password');
                redirect('admin');
                exit;
            }
        }
        else
        {
            $data['title'] = 'Login';
            $this->load->view('admin/user/login', $data);
        }
    }

    public function dashboard()
    {
        $this->authenticate(current_url());

        $data['tab'] = 'dashboard';
        $data['title'] = 'Dashboard';
        $data['_view'] = 'admin/user/dashboard';
        $this->load->view('admin/layout/basetemplate', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin');
        exit;
    }

    public function forgot_password()
    {
        if($this->user['id'])
        {
            redirect('admin/dashboard');
            exit;
        }

        $this->form_validation->set_rules('username', 'username', 'required|xss_clean');

        $this->form_validation->set_error_delimiters('<div class="text-danger p-2">', '</div>');

        if($this->form_validation->run())
        {
            $user = $this->User_model->get_user_by_params(['username' => $this->input->post('username')]);

            if(!empty($user))
            {
                $forgot_password_key = random_string('alnum', 16);
                $this->Email_model->send_admin_forgot_password_link($user['full_name'], $user['email'], $forgot_password_key);

                $data = [
                    'forgot_password_key' => $forgot_password_key
                ];

                $result = $this->User_model->update($user['id'], $data);

                if($result)
                {
                    $this->session->set_flashdata('success_message', 'Reset password mail has been sent to your email');
                    redirect('admin/forgot-password');
                    exit;
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Some error occured while sending the reset password mail');
                    redirect('admin/forgot-password');
                    exit;
                }
            }
            else
            {
                $this->session->set_flashdata('error_message', 'This username is not registered');
                redirect('admin/forgot-password');
                exit;
            }
        }
        else
        {
            $data['title'] = 'Forgot Password';
            $this->load->view('admin/user/forgot-password', $data);
        }
    }

    public function reset_password()
    {
        if($this->user['id'])
        {
            redirect('admin/dashboard');
            exit;
        }

        $user = $this->User_model->get_user_by_params(['forgot_password_key' => $this->input->post('key')]);

        if(!empty($user))
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

                $result = $this->User_model->update($player['id'], $data);

                if($result)
                {
                    $this->session->set_flashdata('success_message', 'Password has been updated successfully');
                    redirect('admin');
                    exit;
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Some error occured while resetting the password');
                    redirect('admin/forgot-password');
                    exit;
                }
            }
            else
            {
                $data['title'] = 'Reset Password';
                $this->load->view('admin/user/reset-password', $data);
            }
        }
        else
        {
            redirect('admin');
            exit;
        }
    }
}
