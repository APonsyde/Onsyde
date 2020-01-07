<?php

class Manager_model extends CI_Model {

	public function login($mobile, $password)
	{
		$this->db->select('id, company_name');
		$this->db->where('mobile', $mobile);
		$this->db->where('password', $password);
		$manager = $this->db->get('managers')->row_array();

		if(!empty($manager))
		{
			$this->set_manager_session(['manager_id' => $manager['id'], 'manager_name' => $manager['company_name']]);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function set_manager_session($manager_data)
	{
		if(!empty($manager_data))
		{
			foreach ($manager_data as $key => $value)
			{
				$this->session->set_userdata($key, $value);
			}
		}
	}

	public function add($data)
	{
		return $this->db->insert('managers', $data);
	}

	public function update($id, $data)
	{
		return $this->db->update('managers', $data, array('id' => $id));
	}

	public function get_manager_by_id($id)
	{
		$this->db->select('m.*');
		$this->db->from('managers m');
		$this->db->where('m.id', $id);
		return $this->db->get()->row_array();
	}

	public function get_manager_by_params($params)
	{
		if(isset($params['forgot_password_key']))
			$this->db->where('m.forgot_password_key', $params['forgot_password_key']);

		if(isset($params['email']))
			$this->db->where('m.email', $params['email']);

		if(isset($params['mobile']))
			$this->db->where('m.mobile', $params['mobile']);

		$this->db->select('m.*');
		$this->db->from('managers m');
		return $this->db->get()->row_array();
	}
}