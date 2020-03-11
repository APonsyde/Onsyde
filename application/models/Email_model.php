<?php

class Email_model extends CI_Model {

	public function send_contact_mail($name, $email, $subject, $message)
	{
        $data['data'] = array(
			'name' => $name,
			'email' => $email,
			'subject' => $subject,
			'message' => $message
		);
		$data['_view'] = 'contact';
        $data['title'] = PROJECT_NAME.' Contact Mail';
        $html = $this->load->view('email/layout', $data, true);
        return $this->send_mail->send_to(EMAIL_ADMIN, PROJECT_NAME." Contact Mail", $html);
	}

	public function send_demo_mail($mobile)
	{
        $data['data'] = array(
			'mobile' => $mobile,
		);
		$data['_view'] = 'demo';
        $data['title'] = PROJECT_NAME.' Request Demo Mail';
        $html = $this->load->view('email/layout', $data, true);
        return $this->send_mail->send_to(array('alastair@onsyde.in' => 'Onsyde Admin'), PROJECT_NAME." Request Demo Mail", $html);
	}

	public function send_forgot_password_code($name, $email, $code)
	{
        $data['data'] = array(
			'name' => $name,
			'code' => $code
		);
		$data['_view'] = 'reset-password-code';
        $data['title'] = PROJECT_NAME.' - Reset Password Code';
        $html = $this->load->view('email/layout', $data, true);
        return $this->send_mail->send_to([$email => $name], PROJECT_NAME." - Reset Password Code", $html);
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
        return $this->send_mail->send_to([$email => $name], PROJECT_NAME." - Registration", $html);
	}

	public function notify($users, $subject, $message)
	{
		$data = [];
		$data['_view'] = 'notify';
        $data['title'] = $subject;
		$data['message'] = $message;

        if(!empty($users))
        {
        	foreach ($users as $user)
        	{
        		$data['data']['name'] = $user['name'];
        		$data['data']['message'] = $message;
        		$html = $this->load->view('email/layout', $data, true);
        		$this->send_mail->send_to([$user['email'] => $user['name']], $subject, $html);
        	}
        }
	}
}