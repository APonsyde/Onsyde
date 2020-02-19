<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends AdminController 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Manager_model');
	}

	public function listing()
	{
		$this->authenticate(current_url());

		$filters = $this->input->get();

		$offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
		$data['managers'] = $this->Manager_model->get_all_managers(null, null, $filters);
		$data['count'] = $this->Manager_model->count_all_managers($filters);
		$data['total'] = $this->Manager_model->count_all_managers();
		$data['inactive'] = $this->Manager_model->count_all_managers(['inactive' => 1]);
		$data['pagination'] = pagination(site_url('admin/manager/listing'), $data['count'], ROWS_PER_LISTING);

		$data['tab'] = 'managers';
		$data['subtab'] = 'list';
		$data['title'] = 'Manager Listing';
		$data['_view'] = 'admin/manager/listing';
		$this->load->view('front/layout/basetemplate', $data);
	}

	public function status($id = 0)
	{
		$this->authenticate(current_url());

		$data['manager'] = $this->Manager_model->get_manager_by_id($id);

		if(!empty($data['manager']))
		{
			$inactive = !$data['manager']['inactive'];
			$result = $this->Manager_model->update($id, ['inactive' => $inactive]);

			if($result)
			{
				$this->session->set_flashdata('success_message', 'Manager status updated successfully');
	            redirect('admin/manager/listing');
	            exit;
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Some error occured while updating the status');
	            redirect('admin/manager/listing');
	            exit;
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Manager not found');
            redirect('admin/manager/listing');
            exit;
		}
	}
}
