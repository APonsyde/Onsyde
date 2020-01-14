<?php

class Admin_model extends CI_Model {

	public function login($username, $password)
	{
		$this->db->select('id, username');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$admin = $this->db->get('users')->row_array();

		if(!empty($admin))
		{
			$this->set_admin_session(['admin_id' => $admin['id']]);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function set_admin_session($admin_data)
	{
		if(!empty($admin_data))
		{
			foreach ($admin_data as $key => $value)
			{
				$this->session->set_userdata($key, $value);
			}
		}
	}

	public function update($id, $data)
	{
		return $this->db->update('users', $data, array('id' => $id));
	}

	public function get_admin_by_params($params)
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

	public function get_admin_by_id($id)
	{
		$this->db->select('u.*');
		$this->db->from('users u');
		$this->db->where('u.id', $id);
		return $this->db->get()->row_array();
	}
}