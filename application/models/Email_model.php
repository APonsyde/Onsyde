<?php

class Email_model extends CI_Model {

	public function send_forgot_password_code($name, $email, $code)
	{
        $data['data'] = array(
			'name' => $name,
			'code' => $code
		);
		$data['_view'] = 'reset-password-code';
        $data['title'] = PROJECT_NAME.' - Reset Password Code';
        $html = $this->load->view('email/layout', $data, true);
        return $this->sendmail->sendTo([$email => $name], "Reset Password Code", $html);
	}

	public function send_registration_email($name, $email, $password = null)
	{
		$data['data'] = array(
			'name' => $name,
			'email' => $email,
			'password' => $password
		);
		$data['_view'] = 'registration';
        $data['title'] = PROJECT_NAME.' Registration';
        $html = $this->load->view('email/layout', $data, true);
        return $this->send_mail->send_to([$email => $name], PROJECT_NAME." Registration", $html);
	}

}