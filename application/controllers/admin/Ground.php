<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ground extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Ground_model');
		$this->load->model('Sort_model');

	}


	public function listing()
	{
		$this->authenticate(current_url());

		$filters = $this->input->get();

		$offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
		$data['grounds'] = $this->Ground_model->get_all_grounds(ROWS_PER_LISTING, $offset, $filters);
		$data['count'] = $this->Ground_model->count_all_grounds($filters);
		$data['total'] = $this->Ground_model->count_all_grounds();
		$data['inactive'] = $this->Ground_model->count_all_grounds(['inactive' => 1]);
		$data['pagination'] = pagination(site_url('ground/listing'), $data['count'], ROWS_PER_LISTING);

		$data['tab'] = 'ground';
		$data['title'] = 'Ground Listing';
		$data['_view'] = 'admin/ground/listing';
		$this->load->view('admin/layout/basetemplate', $data);
	}


	public function add()
	{
		$this->authenticate(current_url());

		$this->form_validation->set_rules('ground_name', 'Ground Name', 'required|xss_clean');
		$this->form_validation->set_rules('pincode', ' Pincode', 'required|xss_clean');
		$this->form_validation->set_rules('latitude', 'Latitude', 'required|xss_clean');
		$this->form_validation->set_rules('longitude', 'Longitude', 'required|xss_clean');


		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if($this->form_validation->run())
		{
			$data = $this->input->post();
// $data['sort'] = $this->Sort_model->get_new_sort_number(['table' => 'grounds']);
			$result = $this->Ground_model->add($data);

			if($result)
			{
				$this->session->set_flashdata('success_message', 'Ground added successfully');
				redirect('ground/edit/'. $result);
				exit;
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Some error occured while adding the ground');
				redirect('ground/listing');
				exit;
			}
		}
		else
		{
			$data['tab'] = 'ground';
			$data['title'] = 'Add Grounds';
			$data['_view'] = 'admin/ground/add';
			$this->load->view('admin/layout/basetemplate', $data);
		}
	}

	public function edit($id = 0)
	{
		$this->authenticate(current_url());

		$data['ground'] = $this->Ground_model->get_ground_by_id($id);

		if(empty($data['ground']))
		{
			$this->session->set_flashdata('error_message', 'Grounds not found');
			redirect('ground/listing');
			exit;
		}

		$this->form_validation->set_rules('ground_name', 'Ground Name', 'required|xss_clean');
		$this->form_validation->set_rules('pincode', 'Pincode', 'required|xss_clean');
		$this->form_validation->set_rules('latitude', 'Latitude', 'required|xss_clean');
		$this->form_validation->set_rules('longitude', 'Longitude', 'required|xss_clean');
		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if($this->form_validation->run())
		{
			$data = $this->input->post();
			$result = $this->Ground_model->update($id, $data);

			if($result)
			{
				$this->session->set_flashdata('success_message', 'Ground updated successfully');
				redirect('ground/listing');
				exit;
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Some error occured while updating the ground');
				redirect('ground/listing');
				exit;
			}
		}
		else
		{
			$data['tab'] = 'ground';
			$data['title'] = 'Edit Ground';
			$data['_view'] = 'admin/ground/edit';
			$this->load->view('admin/layout/basetemplate', $data);
		}
	}

	public function delete($id = 0)
	{
		$this->authenticate(current_url());

		$data['ground'] = $this->Ground_model->get_ground_by_id($id);

		if(empty($data['ground']))
		{
			$this->session->set_flashdata('error_message', 'Ground not found');
			redirect('grounds/listing');
			exit;
		}

		$result = $this->Ground_model->update($id, array('deleted' => 1));

		if($result)
		{
			$this->session->set_flashdata('success_message', 'Ground deleted successfully');
			redirect('ground/listing');
			exit;
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Some error occured while deleting the Ground');
			redirect('ground/listing');
			exit;
		}
	}
}
