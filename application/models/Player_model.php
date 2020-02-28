<?php

class Player_model extends CI_Model {

	public function login($mobile, $password)
	{
		$this->db->select('id, full_name');
		$this->db->where('mobile', $mobile);
		$this->db->where('password', $password);
		$this->db->where('inactive', 0);
		$player = $this->db->get('players')->row_array();

		if(!empty($player))
		{
			$this->set_player_session(['player_id' => $player['id'], 'player_name' => $player['full_name']]);
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

	public function get_all_players($limit = 0, $offset = 0, $params = null)
	{
		if($limit)
			$this->db->limit($limit, $offset);

		$this->_set_filters($params);

		if(isset($params['sort'])) {
			$ord_data = explode(',', $params['sort']);
			if(count($ord_data) == 1) {
				$ord = explode('=', $ord_data[0]);
				if (isset($ord[0]) && isset($ord[1])) {
					$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'p.'.$ord[0];
					$this->db->order_by($ord0, $ord[1]);
				}
			} else {
				foreach ($ord_data as $key => $value) {
					$ord = explode('=', $value);
					if (isset($ord[0]) && isset($ord[1])) {
						$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'p.'.$ord[0];
						$this->db->order_by($ord0, $ord[1]);
					}
				}
			}
		} else {
			$this->db->order_by('p.id', 'DESC');
		}

		if(!empty($params['select']))
			$this->db->select($params['select']);
		else
			$this->db->select('p.*');

		$this->db->from('players p');

		$this->db->group_by('p.id');
		$this->db->where('p.deleted', 0);
		return $this->db->get()->result_array();
	}

	public function count_all_players($params = 0)
	{
		$this->_set_filters($params);

		$this->db->where('p.deleted', 0);
		return $this->db->count_all_results('players p');
	}

	public function get_player_name_from_mobile($mobile)
	{
		$name = null;

		$player = $this->db->get_where('players', ['mobile' => $mobile])->row_array();

		if(empty($player) || is_null($player['full_name']))
		{
			$invited_player = $this->db->get_where('booking_invites', ['mobile' => $mobile])->row_array();

			if(!empty($invited_player))
			{
				$name = $invited_player['name'];
			}
		}
		else
		{
			$name = $player['full_name'];
		}

		return $name;

	}

	private function _set_filters($params = null)
	{
		if(isset($params['include_ids'])) {
			if(!empty($params['include_ids']))
				$this->db->where_in('p.id', $params['include_ids']);
			else
				$this->db->where_in('p.id', [0]);
		}

		if(!empty($params['exclude_ids']))
			$this->db->where_not_in('p.id', $params['exclude_ids']);

		if(!empty($params['search'])) {
			$this->db->group_start();
			// $this->db->like('p.id', $params['search'], 'both');
			$this->db->like('p.full_name', $params['search'], 'both');
			$this->db->or_like('p.mobile', $params['search'], 'both');
			// $this->db->or_like('p.email', $params['search'], 'both');
			$this->db->group_end();
		} 

		if(isset($params['inactive']) && is_numeric($params['inactive']))
			$this->db->where('p.inactive', $params['inactive']);
	}
}