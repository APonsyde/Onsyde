<?php

class Player_model extends CI_Model {

	public function add($data)

	{

		$this->db->insert('players', $data);
		 return $this->db->insert_id();

	}

	public function add_player_skills($data)

	{
		$this->db->insert('player_sports', ['sports_id' => $data['sports_id'], 'player_id' => $data['player_id']]);
		$id = $this->db->insert_id();

		if(!empty($data['skills']))
		{
			foreach ($data['skills'] as $key => $skill_id)
			{
				$this->db->insert('player_sport_skill', ['player_sport_id' => $id, 'sport_skill_set_id' => $skill_id]);
			}
		}

		return $id;
	}

	// public function get_all_team_players()
	// {
	// 	$this->db->from('tournament_team_player ttp');
	// 	$this->db->join('sport_skill_set ss', 'ss.id = pss.sport_skill_set_id', 'left');
	// 	$this->db->join('sport_skill_set ss', 'ss.id = pss.sport_skill_set_id', 'left');

	// }

	

	public function update_by_params($data)
	{
	}

	public function update_player_skills($data)

	{
		$sql = "DELETE t1 FROM player_sport_skill t1
			JOIN player_sports t2 ON t1.player_sport_id = t2.id
			WHERE t2.player_id = ?";

		$this->db->query($sql, array($data['player_id']));

		if(!empty($data['player_sport_skills']))
		{
			foreach ($data['player_sport_skills'] as $key => $player_sport_skills)
			{
				foreach ($player_sport_skills as $skill_id)
				{
					$this->db->insert('player_sport_skill', ['player_sport_id' => $key, 'sport_skill_set_id' => $skill_id]);
				}
			}
		}

		return true;

	}

	public function update($id, $data)

	{
		return $this->db->update('players', $data, array('id' => $id));
	}

	public function update_player_by_params($params, $data)
	{
		if(isset($params['account'])) {
			$this->db->where('c.email', $params['account']);
			$this->db->or_where('c.mobile', $params['account']);
		}

		return $this->db->update('players c', $data);
	}

	public function update_batch($data, $col)

	{
		return $this->db->update_batch('players', $data, $col);
	}


	public function get_all_player_sports_skills($id, $limit = 0, $offset = 0)

	{
		if($limit)
			$this->db->limit($limit, $offset);

		if(!empty($params['select']))
			$this->db->select($params['select']);
		else
			$this->db->select('pss.*, ss.skill_set_name as skill_set');	

		$this->db->where('ps.player_id', $id);

		$this->db->from('player_sport_skill pss');
		$this->db->join('sport_skill_set ss', 'ss.id = pss.sport_skill_set_id', 'left');
		$this->db->join('player_sports ps', 'ps.id = pss.player_sport_id', 'left');

		if(isset($params['sort'])) {
			$ord_data = explode(',', $params['sort']);
			if(count($ord_data) == 1) {
				$ord = explode('=', $ord_data[0]);
				if (isset($ord[0]) && isset($ord[1])) {
					$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'pss.'.$ord[0];
					$this->db->order_by($ord0, $ord[1]);
				}
			} else {
				foreach ($ord_data as $key => $value) {
					$ord = explode('=', $value);
					if (isset($ord[0]) && isset($ord[1])) {
						$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'pss.'.$ord[0];
						$this->db->order_by($ord0, $ord[1]);
					}
				}
			}
		} 
		else 
		{
			$this->db->order_by('pss.id', 'DESC');
		}

		return $this->db->get()->result_array();


	}

	public function get_all_player_sports($id, $limit = 0, $offset = 0)

	{
		if($limit)
			$this->db->limit($limit, $offset);

		if(!empty($params['select']))
			$this->db->select($params['select']);
		else
			$this->db->select('ps.*, s.sport_name as sport');

		$this->db->where('ps.player_id', $id);

		$this->db->from('player_sports ps');
		$this->db->join('sports s', 's.id = ps.sports_id', 'left');


		if(isset($params['sort'])) {
			$ord_data = explode(',', $params['sort']);
			if(count($ord_data) == 1) {
				$ord = explode('=', $ord_data[0]);
				if (isset($ord[0]) && isset($ord[1])) {
					$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'ps.'.$ord[0];
					$this->db->order_by($ord0, $ord[1]);
				}
			} else {
				foreach ($ord_data as $key => $value) {
					$ord = explode('=', $value);
					if (isset($ord[0]) && isset($ord[1])) {
						$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'ps.'.$ord[0];
						$this->db->order_by($ord0, $ord[1]);
					}
				}
			}
		} 
		else 
		{
			$this->db->order_by('ps.id', 'DESC');
		}

		return $this->db->get()->result_array();
	}




	public function get_all_players($limit = 0, $offset = 0, $params = null)

	{
		if($limit)
			$this->db->limit($limit, $offset);

		if(isset($params['inactive']) && is_numeric($params['inactive']))
			$this->db->where('c.inactive', $params['inactive']);

		if(!empty($params['exclude_ids']))
			$this->db->where_not_in('c.id', $params['exclude_ids']);

		if(!empty($params['select']))
			$this->db->select($params['select']);
		else
			$this->db->select('c.*, s.sport_name as sport');

		if(!empty($params['search'])) {
			$this->db->group_start();
			$this->db->like('c.full_name', $params['search'], 'both');
			$this->db->or_like('c.email', $params['search'], 'both');
			$this->db->or_like('c.id', $params['search'], 'both');
			$this->db->or_like('c.mobile', $params['search'], 'both');
			$this->db->group_end();
		}

		$this->db->from('players c');
		$this->db->join('sports s', 's.id = c.sports_id', 'left');

		$this->db->where('c.deleted', 0);

		if(isset($params['sort'])) {
			$ord_data = explode(',', $params['sort']);
			if(count($ord_data) == 1) {
				$ord = explode('=', $ord_data[0]);
				if (isset($ord[0]) && isset($ord[1])) {
					$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'c.'.$ord[0];
					$this->db->order_by($ord0, $ord[1]);
				}
			} else {
				foreach ($ord_data as $key => $value) {
					$ord = explode('=', $value);
					if (isset($ord[0]) && isset($ord[1])) {
						$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'c.'.$ord[0];
						$this->db->order_by($ord0, $ord[1]);
					}
				}
			}
		} 
		else 
		{
			$this->db->order_by('c.id', 'DESC');
		}
		return $this->db->get()->result_array();
	}

	public function get_player_by_id($id)

	{
		$this->db->select('c.*, s.sport_name as sport');
		$this->db->from('players c');
		$this->db->join('sports s', 's.id = c.sports_id', 'left');
		$this->db->where('c.deleted', 0);
		$this->db->where('c.id', $id);
		$this->db->group_by('c.id');
		return $this->db->get()->row_array();
	}

	public function get_player_by_params($params)

	{
		if(isset($params['forgot_password_key']))
			$this->db->where('c.forgot_password_key', $params['forgot_password_key']);

		if(isset($params['mobile']))
			$this->db->where('c.mobile', $params['mobile']);

		if(isset($params['account'])) {
			$this->db->where('c.email', $params['account']);
			$this->db->or_where('c.mobile', $params['account']);
		}

		$this->db->from('players c');
		$this->db->where('c.deleted', 0);
		return $this->db->get()->row_array();
	}

	public function count_all_players($params = null)

	{
		if(isset($params['inactive']) && is_numeric($params['inactive']))
			$this->db->where('c.inactive', $params['inactive']);

		if(!empty($params['exclude_ids']))
			$this->db->where_not_in('c.id', $params['exclude_ids']);

		if(!empty($params['search'])) {
			$this->db->group_start();
			$this->db->like('c.full_name', $params['search'], 'both');
			$this->db->or_like('c.email', $params['search'], 'both');
			$this->db->or_like('c.id', $params['search'], 'both');
			$this->db->or_like('c.mobile', $params['search'], 'both');
			$this->db->group_end();
		}

		$this->db->where('c.deleted', 0);
		return $this->db->count_all_results('players c');
	}

	public function login($mobile, $password)

	{
		$this->db->select('id, mobile');
		$this->db->where('mobile', $mobile);
		$this->db->where('password', $password);
		$player = $this->db->get('players')->row_array();

		if(!empty($player))
		{
			// $this->set_user_session(['player_id' => $player['id'], 'player_mobile' => $player['mobile']]);
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

	public function get_player_sport_by_id($id)

	{
		$this->db->select('ps.*, s.sport_name as sport');
		$this->db->where('ps.id', $id);
		$this->db->from('player_sports ps');
		$this->db->join('sports s', 's.id = ps.sports_id', 'left');
		return $this->db->get()->row_array();
	}

	public function generate_player_token($player_id)
	{
		$api_token = random_string('alnum', 20);
		$this->db->insert('player_devices', array('player_id' => $player_id, 'api_token' => $api_token));
		return $api_token;
	}

	public function registerPlayer($post)
    {
        $player = array(
            'title' => @$post['title'],
            'first_name' => $post['first_name'],
            'last_name' => $post['last_name'],
            'phone' => $post['phone'],
            'email' => $post['email'],
            'password' => md5($post['pass']),
            'date_of_birth' => @date("Y-m-d", @strtotime($post['date_of_birth'])),
            'gender' => @$post['gender'],
            'has_installed_app' => 0,
            'is_active' => 1,
            'registration_latitude' => @$post['registration_latitude'],
            'registration_longitude' => @$post['registration_longitude'],
            'device' => json_encode(array(
                'platform' => $this->agent->platform(),
                'mobile' => $this->agent->mobile(),
                'browser' => $this->agent->browser().' '.$this->agent->version()
            ))
        );
        $this->db->insert('players', $player);

        // send account registration email
        $this->send_player_register_email($player);

        return $this->db->insert_id();
    }

    public function send_player_register_email($player)
    {
        // send account registration email
        $data['_view'] = 'player-register';
        $data['title'] = 'Account Registration';
        $data['player'] = $player;
        $html = $this->load->view('templates/pz/email/layout', $data, true);
        $this->sendmail->sendTo(array($player['email'] => $player['first_name'] . ' ' . $player['last_name']), "Sports Account Registration", $html);
    }

	public function delete_player_sport($id)

	{
		$this->db->delete('player_sport_skill', ['player_sport_id' => $id]);
		$this->db->delete('player_sports', ['id' => $id]);
		return true;
	}

}