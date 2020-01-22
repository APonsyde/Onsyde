<?php

class Manager_model extends CI_Model {

	public function login($mobile, $password)
	{
		$this->db->select('id, company_name');
		$this->db->where('mobile', $mobile);
		$this->db->where('password', $password);
		$this->db->where('inactive', 0);
		$manager = $this->db->get('managers')->row_array();

		if(!empty($manager))
		{
			$this->set_manager_session(['manager_id' => $manager['id']]);
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

		if(isset($params['password']))
			$this->db->where('m.password', $params['password']);

		if(isset($params['api_token']))
			$this->db->where('md.api_token', $params['api_token']);

		$this->db->select('m.*');
		$this->db->from('managers m');
		$this->db->join('manager_devices md', 'md.manager_id = m.id', 'left');
		return $this->db->get()->row_array();
	}

	public function get_all_managers($limit = 0, $offset = 0, $params = null)
	{
		if($limit)
			$this->db->limit($limit, $offset);

		$this->_set_filters($params);

		if(isset($params['sort'])) {
			$ord_data = explode(',', $params['sort']);
			if(count($ord_data) == 1) {
				$ord = explode('=', $ord_data[0]);
				if (isset($ord[0]) && isset($ord[1])) {
					$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'm.'.$ord[0];
					$this->db->order_by($ord0, $ord[1]);
				}
			} else {
				foreach ($ord_data as $key => $value) {
					$ord = explode('=', $value);
					if (isset($ord[0]) && isset($ord[1])) {
						$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'm.'.$ord[0];
						$this->db->order_by($ord0, $ord[1]);
					}
				}
			}
		} else {
			$this->db->order_by('m.id', 'DESC');
		}

		if(!empty($params['select']))
			$this->db->select($params['select']);
		else
			$this->db->select('m.*');

		$this->db->from('managers m');

		$this->db->group_by('m.id');
		$this->db->where('m.deleted', 0);
		return $this->db->get()->result_array();
	}

	public function count_all_managers($params = 0)
	{
		$this->_set_filters($params);

		$this->db->where('m.deleted', 0);
		return $this->db->count_all_results('managers m');
	}

	public function generate_manager_token($manager_id, $device_identifier = null, $registration_token = null)
	{
		$api_token = random_string('alnum', 20);
		$this->db->insert('manager_devices', array('manager_id' => $manager_id, 'api_token' => $api_token, 'device_identifier' => $device_identifier, 'registration_token' => $registration_token));
		return $api_token;
	}

	private function _set_filters($params = null)
	{
		if(isset($params['include_ids'])) {
			if(!empty($params['include_ids']))
				$this->db->where_in('m.id', $params['include_ids']);
			else
				$this->db->where_in('m.id', [0]);
		}

		if(!empty($params['exclude_ids']))
			$this->db->where_not_in('m.id', $params['exclude_ids']);

		if(!empty($params['search'])) {
			$this->db->group_start();
			$this->db->like('m.id', $params['search'], 'both');
			$this->db->or_like('m.company_name', $params['search'], 'both');
			$this->db->or_like('m.contact_person', $params['search'], 'both');
			$this->db->or_like('m.email', $params['search'], 'both');
			$this->db->group_end();
		} 

		if(isset($params['inactive']) && is_numeric($params['inactive']))
			$this->db->where('m.inactive', $params['inactive']);
	}
}