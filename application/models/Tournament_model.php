<?php

class Tournament_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('tournaments', $data);
		return $this->db->insert_id();
	}

	public function add_rules($tournament_id, $rules)
	{
		$this->db->delete('tournament_rules', ['tournament_id' => $tournament_id]);

		foreach ($rules as $key => $rule) {
			if(isset($rule['checked'])) {
				$data = [
					'tournament_id' => $tournament_id,
					'sport_rule_id' => $key,
					'value' => !empty($rule['value']) ? json_encode($rule['value']) : null
				];
				$this->db->insert('tournament_rules', $data);
			}
		}

		return TRUE;
	}

	public function update_rules($id, $data)
	{
		
		return $this->db->update('tournament_rules', $data, array('id' => $id));
	}

	public function update($id, $data)
	{
		return $this->db->update('tournaments', $data, array('id' => $id));
	}

	public function update_batch($data, $col) 
	{
		return $this->db->update_batch('tournaments', $data, $col);
	}

	
	public function get_all_tournaments($limit = 0, $offset = 0, $params = null)
	{  
		if($limit)
			$this->db->limit($limit, $offset);

		$this->_set_filters($params);

		if(!empty($params['select']))
			$this->db->select($params['select']);
		else
			$this->db->select('t.*, s.sport_name as sport, g.ground_name as ground, ti.image');

		$this->db->from('tournaments t');
		$this->db->join('sports s', 's.id = t.sports_id', 'left');
		$this->db->join('grounds g', 'g.id = t.ground_id', 'left');
		$this->db->join('tournament_images ti', 't.id = ti.tournament_id', 'left');


		$this->db->group_by('t.id');
		$this->db->where('t.deleted', 0);

		if(!empty($params['search'])) {
			$this->db->group_start();
			$this->db->like('t.tournament_name', $params['search'], 'both');
			// $this->db->or_like('c.email', $params['search'], 'both');
			// $this->db->or_like('c.id', $params['search'], 'both');
			// $this->db->or_like('c.mobile', $params['search'], 'both');
			$this->db->group_end();
		}

 
		if(isset($params['sort'])) {
			$ord_data = explode(',', $params['sort']);
			if(count($ord_data) == 1) {
				$ord = explode('=', $ord_data[0]);
				if (isset($ord[0]) && isset($ord[1])) {
					$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 't.'.$ord[0];
					$this->db->order_by($ord0, $ord[1]);
				}
			} else {
				foreach ($ord_data as $key => $value) {
					$ord = explode('=', $value);
					if (isset($ord[0]) && isset($ord[1])) {
						$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 't.'.$ord[0];
						$this->db->order_by($ord0, $ord[1]);
					}
				}
			}
		} else {
			$this->db->order_by('t.id', 'DESC');
		}

		return $this->db->get()->result_array();
	}

	public function get_tournament_by_id($id)
	{
		$this->db->select('t.*, s.sport_name as sport, g.ground_name as ground, ti.image');
		$this->db->from('tournaments t');
		$this->db->join('sports s', 's.id = t.sports_id', 'left');
		$this->db->join('grounds g', 'g.id = t.ground_id', 'left');
		$this->db->join('tournament_images ti', 't.id = ti.tournament_id', 'left');
		$this->db->where('t.deleted', 0);
		$this->db->where('t.id', $id);
		return $this->db->get()->row_array();
	} 

	public function get_tournament_images($id)
    {
        $this->db->select('ti.*');
        $this->db->from('tournament_images ti');
        $this->db->where('ti.deleted', 0);
        $this->db->where('ti.tournament_id', $id);
        $this->db->order_by('ti.sort');
        return $this->db->get()->result_array();
    }

    public function get_tournament_rules($id)
    {
        $this->db->select('tr.*');
        $this->db->from('tournament_rules tr');
        $this->db->where('tr.deleted', 0);
        $this->db->where('tr.tournament_id', $id);
        //$this->db->order_by('tr.sort');
        return $this->db->get()->result_array();
    }

    	


	public function get_tournament_by_params($params)
	{
		$this->db->select('p.*, p.price as old_price, CASE WHEN p.has_discount = 1 AND p.discount_type = "percent" THEN round((p.price - (p.price * p.discount_value/100)), 2) WHEN p.has_discount = 1 AND p.discount_type = "amount" THEN round(p.price - p.discount_value, 2) ELSE p.price END as price, c.name as category');
		$this->db->from('tournaments p');
		$this->db->where('p.deleted', 0);
		return $this->db->get()->row_array();
	}

	public function count_all_tournaments($params = null)
	{
		$this->_set_filters($params);

		$this->db->where('t.deleted', 0);
		return $this->db->count_all_results('tournaments t');
	}

	public function get_tournament_registered_slots($id, $per_team = 0)
	{
		$sql = "SELECT COUNT(tt.id) as total_teams FROM tournament_teams tt WHERE tt.tournament_id = ?";
		$teams = $this->db->query($sql, [$id])->row_array();

		$sql = "SELECT COUNT(tip.id) as total_players FROM tournament_invited_players tip WHERE tip.tournament_id = ?";
		$players = $this->db->query($sql, [$id])->row_array();

		return ($teams['total_teams'] * $per_team) + $players['total_players'];
	}

	private function _set_filters($params = null)
	{
		if(isset($params['include_ids'])) {
			if(!empty($params['include_ids']))
				$this->db->where_in('t.id', $params['include_ids']);
			else
				$this->db->where_in('t.id', [0]);
		}

		if(!empty($params['exclude_ids']))
			$this->db->where_not_in('t.id', $params['exclude_ids']);

		if(!empty($params['search'])) {
			$this->db->group_start();
			$this->db->like('t.id', $params['search'], 'both');
			$this->db->or_like('t.tournament_name', $params['search'], 'both');
			$this->db->group_end();
		}

		if(isset($params['inactive']) && is_numeric($params['inactive']))
			$this->db->where('t.inactive', $params['inactive']);
	}
}