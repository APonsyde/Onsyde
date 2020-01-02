<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* @package         Sports
* @subpackage      API
* @category        Player
* @author          Yohhan Dalvi
*/
class Team extends ApiController 
{

	function __construct()
	{
// Construct the parent class
		parent::__construct();
		$this->load->model('Player_model');
		$this->load->model('Email_model');
		$this->load->model('Device_model');
		$this->load->model('Tournament_model');
		$this->load->model('Team_model');
	}

	public function listing_post()
	{
		if($this->authenticate_token())
        {
			$teams = $this->Team_model->get_all_tournament_teams($this->input->post('tournament_id'));

			foreach ($teams as $key => $team)
			{
				$teams[$key]['logo'] = base_url('resources/front/images/logos/'.$team['logo']);
			}

			$response = [
				'success' => true,
				'message' => '',
				'data' => [
					'teams' => $teams
				]
			];

			$this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
		}
	}

	public function add_post()
	{
		if($this->authenticate_token())
        {
			$this->form_validation->set_rules('name', 'Team Name', 'required|xss_clean');
			$this->form_validation->set_rules('player_id', 'Player ID', 'required|xss_clean');
			$this->form_validation->set_rules('tournament_id', 'Tournament ID', 'required|xss_clean');

			$this->form_validation->set_message('required', '%s is required');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');


			if($this->form_validation->run())
			{
				$data = $this->input->post();
				$result = $this->Team_model->add(['name' => $data['name']]);
				$this->Team_model->add_team_player(['tournament_team_id' => $result, 'player_id' => $data['player_id']]);

				if($result)
				{ 
					$response = [
						'success' => true,
						'message' => 'Team added successfully'
					];
					$this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
				}
				else
				{
					$response = [
						'success' => false,
						'message' => 'Some error occured while adding the Team'
					];

					$this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
				}
			}
			else
			{
				$this->return_form_errors($this->form_validation->error_array());
			}
		}
	}

	public function edit_post()
	{
		if($this->authenticate_token())
        {
			$this->form_validation->set_rules('name', 'Team Name', 'required|xss_clean');

			$this->form_validation->set_message('required', '%s is required');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

			if($this->form_validation->run())
			{
				$data = $this->input->post();
				unset($data['tournament_team_id']);

				$result = $this->Team_model->update($this->input->post('tournament_team_id'), $data);

				if($result)
				{ 
					$response = [
						'success' => true,
						'message' => 'Team updated successfully'

					];
					$this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
				}
				else
				{
					$response = [
						'success' => false,
						'message' => 'Some error occured while updating the Team'
					];

					$this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
				}
			}
			else
			{
				$this->return_form_errors($this->form_validation->error_array());
			}
		}
	}

	public function player_listing_post()
	{
		if($this->authenticate_token())
        {
			$this->form_validation->set_rules('tournament_team_id', 'Tournament Team Id', 'required|xss_clean');

			$this->form_validation->set_message('required', '%s is required');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

			if($this->form_validation->run())
			{
				$data = $this->input->post();
				$players = $this->Team_model->get_all_tournament_team_players($this->input->post('id'));

				$response = [
					'success' => true,
					'message' => '',
					'data' => $players
				];

				$this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
			}
			else
			{
				$this->return_form_errors($this->form_validation->error_array());
			}
		}
	}

}

