<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Player extends AdminController 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Player_model');
	}

	public function listing()
	{
		$this->authenticate(current_url());

		$filters = $this->input->get();

		$offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
		$data['players'] = $this->Player_model->get_all_players(null, null, $filters);
		$data['count'] = $this->Player_model->count_all_players($filters);
		$data['total'] = $this->Player_model->count_all_players();
		$data['inactive'] = $this->Player_model->count_all_players(['inactive' => 1]);
		$data['pagination'] = pagination(site_url('admin/player/listing'), $data['count'], ROWS_PER_LISTING);

		$data['tab'] = 'players';
		$data['subtab'] = 'list';
		$data['title'] = 'Player Listing';
		$data['_view'] = 'admin/player/listing';
		$this->load->view('admin/layout/basetemplate', $data);
	}

	public function view($id = 0)
	{
		$this->authenticate(current_url());

		$data['player'] = $this->Player_model->get_player_by_id($id);

		if(!empty($data['player']))
		{
			$data['tab'] = 'players';
			$data['subtab'] = 'list';
			$data['title'] = 'Player Listing';
			$data['_view'] = 'admin/player/view';
			$this->load->view('admin/layout/basetemplate', $data);
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Player not found');
            redirect('admin/player/listing');
            exit;
		}
	}
}
