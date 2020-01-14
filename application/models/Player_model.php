<?php

class Player_model extends CI_Model {

	public function login($mobile, $password)
	{
		$this->db->select('id, full_name');
		$this->db->where('mobile', $mobile);
		$this->db->where('password', $password);
		$player = $this->db->get('players')->row_array();

		if(!empty($player))
		{
			$this->set_player_session(['player_id' => $player['id']]);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function set_player_session($player_data)
	{
		if(!empty($player_data))
		{
			foreach ($player_data as $key => $value)
			{
				$this->session->set_userdata($key, $value);
			}
		}
	}

	public function add($data)
	{
		$this->db->insert('players', $data);
		return $this->db->insert_id();
	}

	public function update($id, $data)
	{
		return $this->db->update('players', $data, array('id' => $id));
	}

	public function get_player_by_id($id)
	{
		$this->db->select('p.*');
		$this->db->from('players p');
		$this->db->where('p.id', $id);
		return $this->db->get()->row_array();
	}

	public function get_player_by_params($params)
	{
		if(isset($params['forgot_password_key']))
			$this->db->where('p.forgot_password_key', $params['forgot_password_key']);

		if(isset($params['email']))
			$this->db->where('p.email', $params['email']);

		if(isset($params['mobile']))
			$this->db->where('p.mobile', $params['mobile']);

		$this->db->select('p.*');
		$this->db->from('players p');
		return $this->db->get()->row_array();
	}
}