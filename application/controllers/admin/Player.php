<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Player extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Sport_model');
		$this->load->model('Player_model');

	} 

	public function listing()
	{
		$this->authenticate(current_url());

		$filters = $this->input->get();

		$offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
		$data['players'] = $this->Player_model->get_all_players(ROWS_PER_LISTING, $offset, $filters);
		$data['count'] = $this->Player_model->count_all_players($filters);
		$data['total'] = $this->Player_model->count_all_players();
		$data['inactive'] = $this->Player_model->count_all_players(['inactive' => 1]);
		$data['pagination'] = pagination(site_url('player/listing'), $data['count'], ROWS_PER_LISTING);

		$data['tab'] = 'players';
		$data['title'] = 'Player Listing';
		$data['_view'] = 'admin/player/listing';
		$this->load->view('admin/layout/basetemplate', $data);
	}

	public function add()
	{
		$this->authenticate(current_url());

		$this->form_validation->set_rules('first_name', 'First name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last name', 'required|xss_clean');
		$this->form_validation->set_rules('username', 'User name', '|xss_clean');

		$this->form_validation->set_rules('email', 'Email', 'valid_email|check_field[players,email,deleted|0]|xss_clean');
		$this->form_validation->set_rules('mobile', 'Mobile', 'check_field[players,mobile,deleted|0]|xss_clean');
		$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'xss_clean');
		$this->form_validation->set_rules('gender', 'Gender', 'xss_clean');
		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_message('valid_email', '%s is invalid');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if($this->form_validation->run())

		{
			$random_password = random_string('alnum', 12);

			$data = $this->input->post();
			$data['full_name'] = $data['first_name'] . " " . $data['last_name'];
			$data['password'] = md5($random_password);
			$result = $this->Player_model->add($data);

			if($result)

			{
// $this->Email_model->send_registration_email($data['full_name'], $data['email'], $random_password);

				$this->session->set_flashdata('success_message', 'Players added successfully');
				redirect('player/sport/'.$result);

				exit;
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Some error occured while adding the player');
				redirect('player/listing');
				exit;
			}
		}

		else

		{

			$data['tab'] = 'players';
			$data['title'] = 'Add Player';
			$data['_view'] = 'admin/player/add';
			$this->load->view('admin/layout/basetemplate', $data);
		}
	}

	public function edit($id = 0)

	{
		$this->authenticate(current_url());

		$data['player'] = $this->Player_model->get_player_by_id($id);

		if(empty($data['player']))
		{
			$this->session->set_flashdata('error_message', 'Player not found');
			redirect('player/listing');
			exit;
		}

		$this->form_validation->set_rules('first_name', 'First name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last name', 'required|xss_clean');
		$this->form_validation->set_rules('username', 'User name', 'xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|check_field[players,email,deleted|0&id !=|'.$id.']|xss_clean');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required|check_field[players,mobile,deleted|0&id !=|'.$id.']|xss_clean');
		$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'xss_clean');
		$this->form_validation->set_rules('gender', 'Gender', 'xss_clean');

		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_message('valid_email', '%s is invalid');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if($this->form_validation->run())
		{
			$data = $this->input->post();
			$data['full_name'] = $data['first_name'] . " " . $data['last_name'];
			$result = $this->Player_model->update($id, $data);

			if($result)
			{
				$this->session->set_flashdata('success_message', 'Player updated successfully');
				redirect('player/listing');
				exit;
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Some error occured while updating the player');
				redirect('player/edit/'.$id);
				exit;
			}
		}
		else
		{

			$data['tab'] = 'players';
			$data['title'] = 'Edit Player';
			$data['_view'] = 'admin/player/edit';
			$this->load->view('admin/layout/basetemplate', $data);
		}
	}

	public function sport($id = 0)
	{
		$this->authenticate(current_url());
		$data['player'] = $this->Player_model->get_player_by_id($id);

		if(empty($data['player']))
		{
			$this->session->set_flashdata('error_message', 'Player not found');
			redirect('player/listing');
			exit;
		}

		if($this->input->post('type') == 'edit')
		{
			$this->form_validation->set_rules('type', 'Type', 'required|xss_clean');
		}
		else
		{
			$this->form_validation->set_rules('sports_id', 'Sport', 'required|xss_clean');
			$this->form_validation->set_rules('skill_set_name', 'skill set name', 'xss_clean');
		}

		if($this->form_validation->run())
		{
			$data = $this->input->post();
			$data['player_id'] = $id;

			if($this->input->post('type') == 'edit')
			{
				$result = $this->Player_model->update_player_skills($data);
			}
			else
			{
				$result = $this->Player_model->add_player_skills($data);
			}

			if($result)
			{
				$this->session->set_flashdata('success_message', 'Sport skill set updated successfully');
				redirect('player/sport/'.$id);
				exit;
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Some error occured while updating the skill set');
				redirect('player/sport/'.$id);
				exit;
			}
		}
		else
		{
			$player_sport_ids = [];
			$data['player_sports'] = $this->Player_model->get_all_player_sports($id);

			foreach ($data['player_sports'] as $key => $sport)
			{
				$player_sport_ids[] = $sport['sports_id'];

				$data['player_sports'][$key]['skills'] = $this->Sport_model->get_all_sport_skills(null, null, ['sport_id' => $sport['sports_id']]);
			}

			$data['sports'] = $this->Sport_model->get_all_sports(null, null, ['exclude_ids' => $player_sport_ids]);

			foreach ($data['sports'] as $key => $sport)
			{
				$data['sports'][$key]['skills'] = $this->Sport_model->get_all_sport_skills(null, null, ['sport_id' => $sport['id']]);
			}


			$data['player_sport_skill'] = $this->Player_model->get_all_player_sports_skills($id);

			$data['tab'] = 'players';
			$data['title'] = 'Edit sport';
			$data['_view'] = 'admin/player/sport';
			$this->load->view('admin/layout/basetemplate', $data);
		}
	}


	public function delete_sport($id = 0)

	{
		$this->authenticate(current_url());

		$data['player_sport'] = $this->Player_model->get_player_sport_by_id($id);

		if(empty($data['player_sport']))
		{
			$this->session->set_flashdata('error_message', 'Player not found');
			redirect('player/listing');
			exit;
		}

		$result = $this->Player_model->delete_player_sport($id);

		if($result)
		{
			$this->session->set_flashdata('success_message', 'Player deleted successfully');
			redirect('player/sport/'.$data['player_sport']['player_id']);
			exit;
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Some error occured while deleting the player');
			redirect('player/sport/'.$data['player_sport']['player_id']);
			exit;
		}
	}


	public function orders($id = 0)

	{
		$this->authenticate(current_url());

		$data['player'] = $this->Player_model->get_player_by_id($id);

		if(empty($data['customer']))
		{
			$this->session->set_flashdata('error_message', 'Player not found');
			redirect('player/listing');
			exit;
		}

		$data['orders'] = $this->Order_model->get_all_orders(null, null, ['player_id' => $id]);

		$data['tab'] = 'players';
		$data['title'] = 'View Player Orders';
		$data['_view'] = 'admin/player/orders';
		$this->load->view('admin/layout/basetemplate', $data);
	}


	public function delete($id = 0)

	{
		$this->authenticate(current_url());

		$data['player'] = $this->Player_model->get_player_by_id($id);

		if(empty($data['player']))
		{
			$this->session->set_flashdata('error_message', 'Player not found');
			redirect('player/listing');
			exit;
		}

		$result = $this->Player_model->update($id, array('deleted' => 1));

		if($result)
		{
			$this->session->set_flashdata('success_message', 'Player deleted successfully');
			redirect('player/listing');
			exit;
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Some error occured while deleting the player');
			redirect('player/listing');
			exit;
		}
	}
}
