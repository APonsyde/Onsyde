<?php

class Email_model extends CI_Model {

	public function send_forgot_password_code($name, $email, $code)
	{
        $data['data'] = array(
			'name' => $name,
			'code' => $code
		);
		$data['_view'] = 'reset-password-code';
        $data['title'] = 'Reset Password Code';
        $html = $this->load->view('email/layout', $data, true);
        return $this->sendmail->sendTo([$email => $name], "Reset Password Code", $html);
	}

}
