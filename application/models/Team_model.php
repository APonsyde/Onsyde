<?php

class Team_model extends CI_Model 
{

	public function add($data)
	{
		$this->db->insert('tournament_teams', $data);
		return $this->db->insert_id();
	}

	public function add_individual_players($data)
	{
		$this->db->insert('tournament_invited_players', $data);
		return $this->db->insert_id();
	}

	public function add_team_player($tournament_id, $tournament_team_id, $players)
	{
		
		

		foreach ($players as $key => $player) {
			$this->db->delete('tournament_invited_players', ['tournament_id' => $tournament_id, 'player_id' => $key]);
			$data = [
				'tournament_team_id' => $tournament_team_id,
				'player_id' => $key
			];
			$this->db->insert('tournament_team_player', $data);
		}

		return TRUE;

	}

	public function update_team_player($id, $data)
	{
		
		return $this->db->update('tournament_team_player', $data, array('id' => $id));
	}

	public function update($id, $data)
	{
		return $this->db->update('tournament_teams', $data, array('id' => $id));

	}

	public function get_tournament_team_players_by_id($id)
	{
		$this->db->select('ttp.*');
		$this->db->from('tournament_team_player ttp');
		$this->db->where('ttp.id', $id);
		return $this->db->get()->row_array();
	}

	public function get_all_tournament_teams($limit = 0, $offset = 0, $params = null)
	{
		// echo $id;
		// exit;
		if($limit)
            $this->db->limit($limit, $offset);

        if(!empty($params['select']))
            $this->db->select($params['select']);
        else
            $this->db->select('tt.*');

        if(!empty($params['tournament_id']))
            $this->db->where('tt.tournament_id', $params['tournament_id']);

		$this->db->from('tournament_teams tt');
		//$this->db->join('players p', 'p.id = tt.players_id', 'left');
		//$this->db->join('tournament_team_player ttp', 'ttp.id = tt.tournament_team_player_id', 'left');
		//$this->db->join('tournament t', 't.id = tt.tournament_id', 'left');
		//$this->db->where('tt.tournament_id', $id);
		$this->db->group_by('tt.id');

		return $this->db->get()->result_array();
	}

	public function get_all_tournament_team_players($limit = 0, $offset = 0, $params = null)
	{

		if($limit)
            $this->db->limit($limit, $offset);

        if(!empty($params['select']))
            $this->db->select($params['select']);
        else
            $this->db->select('ttp.*');

        if(!empty($params['tournament_team_id']))
            $this->db->where('ttp.tournament_team_id', $params['tournament_team_id']);

		$this->db->from('tournament_team_player ttp');
		//$this->db->where('ttp.tournament_team_id', $id);
		$this->db->group_by('ttp.id');

		return $this->db->get()->result_array();
	}


	public function get_all_individual_players( $params = null)
	{

		
        if(!empty($params['select']))
            $this->db->select($params['select']);
        else
            $this->db->select('tip.*, p.full_name as name');

         if(!empty($params['tournament_id']))
            $this->db->where('tip.tournament_id', $params['tournament_id']);

		$this->db->from('tournament_invited_players tip');
		$this->db->join('players p', 'p.id = tip.player_id', 'left');
		//$this->db->where('ttp.tournament_team_id', $id);
		$this->db->group_by('tip.id');

		return $this->db->get()->result_array();
	}

	public function get_individual_players_by_id($id)
	{
		$this->db->select('tip.*');
		$this->db->from('tournament_invited_players tip');
		$this->db->where('tip.deleted', 0);
		$this->db->where('tip.id', $id);
		return $this->db->get()->row_array();
	} 



}