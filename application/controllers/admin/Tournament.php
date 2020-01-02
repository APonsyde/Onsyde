<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tournament extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tournament_model');
		$this->load->model('Player_model');
		$this->load->model('Sport_model');
		$this->load->model('Ground_model');
		$this->load->model('Upload_model');
		$this->load->model('Team_model');
	}

	public function listing() 
	{
		$this->authenticate(current_url());

		$filters = $this->input->get(); 

		$offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
		$data['tournaments'] = $this->Tournament_model->get_all_tournaments(ROWS_PER_LISTING, $offset, $filters);
		$data['count'] = $this->Tournament_model->count_all_tournaments($filters);
		$data['total'] = $this->Tournament_model->count_all_tournaments();
		$data['inactive'] = $this->Tournament_model->count_all_tournaments(['inactive' => 1]);
		$data['pagination'] = pagination(site_url('tournament/listing'), $data['count'], ROWS_PER_LISTING);


		$data['tab'] = 'tournaments';
		$data['title'] = 'Tournament Listing';
		$data['_view'] = 'admin/tournament/listing';
		$this->load->view('admin/layout/basetemplate', $data);
	}

	public function images($id = 0)
	{
		$this->authenticate(current_url());

		$data['tournament'] = $this->Tournament_model->get_tournament_by_id($id);

		if(empty($data['tournament']))
		{
			$this->session->set_flashdata('error_message', 'tournament not found');
			redirect('tournament/listing');
			exit;
		}

		$data['tournament_images'] = $this->Tournament_model->get_tournament_images($id);

		$data['tab'] = 'tournaments';
		$data['title'] = 'Upload Tournament Images';
		$data['_view'] = 'admin/tournament/images';
		$this->load->view('admin/layout/basetemplate', $data);
	}



	public function detailing($id = 0)

	{
		$this->authenticate(current_url());

		$data['tournament'] = $this->Tournament_model->get_tournament_by_id($id);

		$this->form_validation->set_rules('detailing', 'Detailing', 'xss_clean');
		$this->form_validation->set_rules('name', 'Name', 'xss_clean');

		if($this->form_validation->run())
		{

			$data = $this->input->post();

			$result = $this->Tournament_model->update($id, ['detailing' => $data['detailing']]);
			$data['tournament_id'] = $id;
			$this->Tournament_model->add_rules($id, $data['rules']);

			if($result)
			{

			
				$this->session->set_flashdata('success_message', 'Tournament updated successfully');
				redirect('tournament/detailing/'.$id);
				exit;
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Some error occured while updating the tournament');
				redirect('tournament/listing');
				exit;
			}
		}
		else
		{
			$data['sports'] = $this->Sport_model->get_all_sports();
			$data['rules'] = $this->Sport_model->get_all_sport_rules(['sport_id' => $data['tournament']['sports_id']]);
			$data['tournament_rules'] = $this->Tournament_model->get_tournament_rules($id);

			$data['tab'] = 'tournaments';
			$data['title'] = 'add detailing to tournament';
			$data['_view'] = 'admin/tournament/detailing';
			$this->load->view('admin/layout/basetemplate', $data);
		}
	}

	public function create_team($id = 0)

	{
		$this->authenticate(current_url());

		$data['tournament'] = $this->Tournament_model->get_tournament_by_id($id);

		$this->form_validation->set_rules('name', 'Team Name', 'required|xss_clean');
		$this->form_validation->set_rules('player_id', 'Player', 'xss_clean');

		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if($this->form_validation->run())
		{

			$data = $this->input->post();
			$result = $this->Team_model->add(['tournament_id' => $id, 'name' => $data['name']]);
			$data['tournament_id'] = $id;
			
			// $this->Team_model->add_team_player(['tournament_team_id' => $result, 'player_id' => $id]);
			$this->Team_model->add_team_player($id, $result, $data['players']);

			if($result)
			{ 
				$this->session->set_flashdata('success_message', 'Team added successfully');
				redirect('tournament/teams/'.$result);

				exit;
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Some error occured while adding the tournament');
				redirect('tournament/listing');
				exit;
			}
		}
		else
		{

			$data['tournament'] = $this->Tournament_model->get_tournament_by_id($id);
			$data['players'] = $this->Team_model->get_all_individual_players(['tournament_id' => $id]);

			$data['tab'] = 'tournaments';
			$data['title'] = 'Create Teams in Tournaments';
			$data['_view'] = 'admin/tournament/create_team';
			$this->load->view('admin/layout/basetemplate', $data);
		}
	}



	public function teams($id = 0)
	{
		$this->authenticate(current_url());

		$data['tournament'] = $this->Tournament_model->get_tournament_by_id($id);
		$data['tournament_teams'] = $this->Team_model->get_all_tournament_teams(null, null, ['tournament_id' => $id]);
		$data['tournament_team_player'] = $this->Team_model->get_all_tournament_teams(null, null, ['tournament_id' => $id]);

		$data['tab'] = 'tournaments';
		$data['title'] = 'Team listings of tournament';
		$data['_view'] = 'admin/tournament/teams';
		$this->load->view('admin/layout/basetemplate', $data);
	}

	public function players($id = 0)
	{
		$this->authenticate(current_url());

		$data['tournament'] = $this->Tournament_model->get_tournament_by_id($id);
		$data['individual_players'] = $this->Team_model->get_all_individual_players(['tournament_id' => $id]);

		$data['tab'] = 'tournaments';
		$data['title'] = 'Team listings of tournament';
		$data['_view'] = 'admin/tournament/players';
		$this->load->view('admin/layout/basetemplate', $data);
	}

	public function team_player($id = 0)

	{
		$this->authenticate(current_url());

		$data['tournament'] = $this->Tournament_model->get_tournament_by_id($id);
		$data['players'] = $this->Player_model->get_all_players($id);
		$data['tournament_teams'] = $this->Team_model->get_all_tournament_teams($id);
		$data['tournament_team_players'] = $this->Team_model->get_all_tournament_team_players(null, null, ['tournament_team_id' => $id]);

		$data['tab'] = 'tournaments';
		$data['title'] = 'Team listings of tournament';
		$data['_view'] = 'admin/tournament/team_player';
		$this->load->view('admin/layout/basetemplate', $data);
	}

	public function sort()

	{
		$this->authenticate(current_url());

		$filters['sort'] = 'sort=asc';
		$data['tournaments'] = $this->Tournament_model->get_all_tournaments(null, null, $filters);

		$data['tab'] = 'tournaments';
		$data['title'] = 'Sort Tournaments';
		$data['_view'] = 'admin/tournament/sort';
		$this->load->view('admin/layout/basetemplate', $data);
	}


	public function add()

	{
		$this->authenticate(current_url());

		$this->form_validation->set_rules('tournament_name', 'Tournament Name', 'required|xss_clean');
		$this->form_validation->set_rules('sports_id', 'Sport', 'required|xss_clean');
		$this->form_validation->set_rules('ground_id', 'Ground', 'required|xss_clean');
		$this->form_validation->set_rules('total_team', 'Total Team', 'required|xss_clean');
		$this->form_validation->set_rules('person_per_team', 'Person per team', 'required|xss_clean');
		$this->form_validation->set_rules('valid_from_date', 'From Date', 'required');
		$this->form_validation->set_rules('valid_to_date', 'To Date', 'required');


		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if($this->form_validation->run())
		{
			$data = $this->input->post();
			$result = $this->Tournament_model->add($data);

			if($result)
			{ 
				$this->session->set_flashdata('success_message', 'Tournament added successfully');
				redirect('tournament/detailing/'.$result);

				exit;
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Some error occured while adding the tournament');
				redirect('tournament/listing');
				exit;
			}
		}
		else
		{
			$data['sports'] = $this->Sport_model->get_all_sports();
			$data['grounds'] = $this->Ground_model->get_all_grounds();

			$data['tab'] = 'tournaments';
			$data['title'] = 'Add Tournament';
			$data['_view'] = 'admin/tournament/add';
			$this->load->view('admin/layout/basetemplate', $data);
		}
	}

	public function edit($id = 0)
	{
		$this->authenticate(current_url());

		$data['tournament'] = $this->Tournament_model->get_tournament_by_id($id);

		if(empty($data['tournament']))
		{
			$this->session->set_flashdata('error_message', 'Tournament not found');
			redirect('tournament/listing');
			exit;
		}

		$this->form_validation->set_rules('tournament_name', 'Tournament Name', 'required|xss_clean');
		$this->form_validation->set_rules('sports_id', 'Sport Name', 'required|xss_clean');
		$this->form_validation->set_rules('ground_id', 'Ground Name', 'required|xss_clean');
		$this->form_validation->set_rules('total_team', 'Total Team', 'required|xss_clean');
		$this->form_validation->set_rules('person_per_team', 'Person per team', 'required|xss_clean');
		$this->form_validation->set_rules('valid_from_date', 'From Date', 'required');
		$this->form_validation->set_rules('valid_to_date', 'To Date', 'required');


		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if($this->form_validation->run())
		{
			$data = $this->input->post();
			$result = $this->Tournament_model->update($id, $data);

			if($result)
			{
				$this->session->set_flashdata('success_message', 'Tournament updated successfully');
				redirect('tournament/listing');
				exit;
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Some error occured while updating the tournament');
				redirect('tournament/listing');
				exit;
			}
		}
		else
		{
			$data['sports'] = $this->Sport_model->get_all_sports();
			$data['grounds'] = $this->Ground_model->get_all_grounds();


			$data['tab'] = 'tournaments';
			$data['title'] = 'Edit Tournament';
			$data['_view'] = 'admin/tournament/edit';
			$this->load->view('admin/layout/basetemplate', $data);
		}
	}


// private function upload()
//    {
//        $config['upload_path']          = FCPATH.'uploads/tournaments/';
//        $config['allowed_types']        = 'gif|jpg|png|jpeg';
//        $config['encrypt_name']         = TRUE;
//        $config['file_ext_tolower']     = TRUE;

//        if(!is_dir($config['upload_path']))
//        {
//            mkdir($config['upload_path'], 0777, true);
//            mkdir($config['upload_path'].'thumb/', 0777, true);
//        }

//        $this->load->library('upload', $config);

//        if(!$this->upload->do_upload('image'))
//        {
//            $response = [
//                'success' => FALSE,
//                'message' => $this->upload->display_errors()
//            ];
//        }
//        else
//        {
//            $data = $this->upload->data();
//            $thumbnail = $this->Upload_model->thumbnail($data['full_path'], $config['upload_path'].'thumb/');

//            $response = [
//                'success' => TRUE,
//                'message' => 'Uploaded successfully',
//                'data' => [
//                    'file_name' => $data['file_name']
//                ]
//            ];
//        }

//        return $response;
//    }

// public function file_check($post, $params)
// {
//     $data = json_decode($params);

//     if(isset($data[2]) && $data[2] == false)
//     {
//         return TRUE;
//     }

//     $allowed_mime_type_arr = get_allowed_formats($data[1]);
//     $mime = get_mime_by_extension($_FILES[$data[0]]['name']);

//     if(isset($_FILES[$data[0]]['name']) && $_FILES[$data[0]]['name']!= "")
//     {
//         if(in_array($mime, $allowed_mime_type_arr))
//         {
//             return TRUE;
//         }
//         else
//         {
//             $this->form_validation->set_message('file_check', 'Please select only gif/jpg/png file');
//             return FALSE;
//         }
//     }

//     return TRUE;
// }

	public function delete($id = 0)
	{
		$this->authenticate(current_url());

		$data['tournament'] = $this->Tournament_model->get_tournament_by_id($id);

		if(empty($data['tournament']))
		{
			$this->session->set_flashdata('error_message', 'Tournament not found');
			redirect('tournament/listing');
			exit;
		}

		$result = $this->Tournament_model->update($id, array('deleted' => 1));

		if($result)
		{
			$this->session->set_flashdata('success_message', 'Tournament deleted successfully');
			redirect('tournament/listing');
			exit;
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Some error occured while deleting the Tournament');
			redirect('tournament/listing');
			exit;
		}
	}
}
