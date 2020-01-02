<?php

class User_model extends CI_Model {

	public function login($username, $password)
	{
		$this->db->select('id, username');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$admin = $this->db->get('users')->row_array();

		if(!empty($admin))
		{
			$this->set_user_session(['user_id' => $admin['id'], 'user_username' => $admin['username']]);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function set_user_session($user_data)
	{
		if(!empty($user_data))
		{
			foreach ($user_data as $key => $value)
			{
				$this->session->set_userdata($key, $value);
			}
		}
	}

	public function update($id, $data)
	{
		return $this->db->update('users', $data, array('id' => $id));
	}

	public function get_user_by_params($params)
	{
		if(isset($params['forgot_password_key']))
			$this->db->where('u.forgot_password_key', $params['forgot_password_key']);

		if(isset($params['email']))
			$this->db->where('u.email', $params['email']);

		if(isset($params['username']))
			$this->db->where('u.username', $params['username']);

		$this->db->select('u.*, CONCAT_WS(" ", u.first_name, u.last_name) as full_name');
		$this->db->from('users u');
		return $this->db->get()->row_array();
	}
}