<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sport extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Sport_model');
		// $this->load->model('Sort_model');

	}


	public function listing()
	{ 
		$this->authenticate(current_url());

		$filters = $this->input->get();

		$offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
		$data['sports'] = $this->Sport_model->get_all_sports(ROWS_PER_LISTING, $offset, $filters);
		$data['count'] = $this->Sport_model->count_all_sports($filters);
		$data['total'] = $this->Sport_model->count_all_sports();
		$data['inactive'] = $this->Sport_model->count_all_sports(['inactive' => 1]);
		$data['pagination'] = pagination(site_url('sport/listing'), $data['count'], ROWS_PER_LISTING);

		$data['tab'] = 'sport';
		$data['title'] = 'Sport Listing';
		$data['_view'] = 'admin/sport/listing';
		$this->load->view('admin/layout/basetemplate', $data);
	}


	public function add()
	{
		$this->authenticate(current_url());

		$this->form_validation->set_rules('sport_name', 'Sport Name', 'required|xss_clean');

		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if($this->form_validation->run())
		{
			$data = $this->input->post();
// $data['sort'] = $this->Sort_model->get_new_sort_number(['table' => 'sports']);
			$result = $this->Sport_model->add($data);

			if($result)
			{
				$this->session->set_flashdata('success_message', 'Sport added successfully');
				redirect('sport/sport_skill_set/'. $result);
				exit;
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Some error occured while adding the Sport');
				redirect('sport/listing');
				exit;
			}
		}
		else
		{
			$data['tab'] = 'sport';
			$data['title'] = 'Add sports';
			$data['_view'] = 'admin/sport/add';
			$this->load->view('admin/layout/basetemplate', $data);
		}
	}

	public function edit($id = 0)
	{
		$this->authenticate(current_url());

		$data['sport'] = $this->Sport_model->get_sport_by_id($id);

		if(empty($data['sport']))
		{
			$this->session->set_flashdata('error_message', 'Sports not found');
			redirect('sport/listing');
			exit;
		}

		$this->form_validation->set_rules('sport_name', 'Sport Name', 'required|xss_clean');

		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if($this->form_validation->run())
		{
			$data = $this->input->post();
			$result = $this->Sport_model->update($id, $data);

			if($result)
			{
				$this->session->set_flashdata('success_message', 'Sport updated successfully');
				redirect('sport/listing');
				exit;
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Some error occured while updating the sport');
				redirect('sport/listing');
				exit;
			}
		}
		else
		{
			$data['tab'] = 'sport';
			$data['title'] = 'Edit Sport';
			$data['_view'] = 'admin/sport/edit';
			$this->load->view('admin/layout/basetemplate', $data);
		}
	}

	public function rules($id = 0)
	{

		$this->authenticate(current_url());

		$data['sport'] = $this->Sport_model->get_sport_by_id($id);

		if(empty($data['sport']))
		{
			$this->session->set_flashdata('error_message', 'Rules set not found');
			redirect('Sport/listing');
			exit;
		}

		$this->form_validation->set_rules('name', 'Name', 'xss_clean');

		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if($this->form_validation->run())
		{
			$data = $this->input->post();
			$data['sport_id'] = $id;
 			$result = $this->Sport_model->add_rules($data);

			if($result)
			{
				$this->session->set_flashdata('success_message', 'Rules updated successfully');
				redirect('sport/rules/'.$id);
				exit;
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Some error occured while updating sport rules');
				redirect('sport/rules/'.$id);
				exit;
			}
		}
		else
		{
			$data['rules'] = $this->Sport_model->get_all_sport_rules(['sport_id' => $id]);

			$data['tab'] = 'sport';
			$data['title'] = 'Update sport rules';
			$data['_view'] = 'admin/sport/rules';
			$this->load->view('admin/layout/basetemplate', $data);
		}
	}


	public function sport_skill_set($id = 0)
	{

		$this->authenticate(current_url());

		$data['sport'] = $this->Sport_model->get_sport_by_id($id);

		if(empty($data['sport']))
		{
			$this->session->set_flashdata('error_message', 'Skill set not found');
			redirect('Sport/listing');
			exit;
		}

		$this->form_validation->set_rules('skill_set_name', 'Skill set name', 'xss_clean');

		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if($this->form_validation->run())
		{
			$data = $this->input->post();
			$data['sport_id'] = $id;
 			$result = $this->Sport_model->add_skill($data);

			if($result)
			{
				$this->session->set_flashdata('success_message', 'Sport skill set updated successfully');
				redirect('sport/sport_skill_set/'.$id);
				exit;
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Some error occured while updating the skill set');
				redirect('sport/sport_skill_set/'.$id);
				exit;
			}
		}
		else
		{
			$data['skills'] = $this->Sport_model->get_all_sport_skills(null, null, ['sport_id' => $id]);

			$data['tab'] = 'sport';
			$data['title'] = 'Update sport skill set';
			$data['_view'] = 'admin/sport/sport_skill_set';
			$this->load->view('admin/layout/basetemplate', $data);
		}
	}

	public function delete_sport_skill_set($id = 0)

	{
		$this->authenticate(current_url());

		$data['skill_set'] = $this->Sport_model->get_sport_skill_set_by_id($id);

		if(empty($data['skill_set']))
		{
			$this->session->set_flashdata('error_message', 'Skill Set not found');
			redirect('sport/edit/'.$id);
			exit;
		}

		$result = $this->Sport_model->delete_skill_set($id);

		if($result)
		{
			$this->session->set_flashdata('success_message', 'Skill Set deleted successfully');
			redirect('sport/sport_skill_set/'.$data['skill_set']['sport_id']);
			exit;
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Some error occured while deleting the Skill Set');
			redirect('sport/sport_skill_set/'.$data['skill_set']['sport_id']);
			exit;
		}


	}

	public function delete_sport_rule($id = 0)

	{
		$this->authenticate(current_url());

		$data['rules'] = $this->Sport_model->get_sport_rules_by_id($id);

		if(empty($data['rules']))
		{
			$this->session->set_flashdata('error_message', 'Rules not found');
			redirect('sport/edit/'.$id);
			exit;
		}

		$result = $this->Sport_model->delete_rules($id);

		if($result)
		{
			$this->session->set_flashdata('success_message', 'Rules deleted successfully');
			redirect('sport/rules/'.$data['rules']['sport_id']);
			exit;
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Some error occured while deleting the Sport rules');
			redirect('sport/rules/'.$data['rules']['sport_id']);
			exit;
		}


	}

	public function images($id = 0)
	{
		$this->authenticate(current_url());

		$data['sport'] = $this->Sport_model->get_sport_by_id($id);

		if(empty($data['sport']))
		{
			$this->session->set_flashdata('error_message', 'Sport not found');
			redirect('sport/listing');
			exit;
		}

		$data['sport_images'] = $this->Sport_model->get_sport_images($id);

		$data['tab'] = 'sports';
		$data['title'] = 'Upload Sports Images';
		$data['_view'] = 'admin/sport/images';
		$this->load->view('admin/layout/basetemplate', $data);
	}



	public function delete($id = 0)
	{
		$this->authenticate(current_url());

		$data['sport'] = $this->Sport_model->get_sport_by_id($id);

		if(empty($data['sport']))
		{
			$this->session->set_flashdata('error_message', 'Sport not found');
			redirect('sport/listing');
			exit;
		}

		$result = $this->Sport_model->update($id, array('deleted' => 1));

		if($result)
		{
			$this->session->set_flashdata('success_message', 'Sport deleted successfully');
			redirect('sport/listing');
			exit;
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Some error occured while deleting the Sport');
			redirect('sport/listing');
			exit;
		}
	}
}
