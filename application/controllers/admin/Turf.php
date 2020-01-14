<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turf extends AdminController 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Turf_model');
	}

	public function listing()
	{
		$this->authenticate(current_url());

		$filters = $this->input->get();

		$offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
		$data['turfs'] = $this->Turf_model->get_all_turfs(null, null, $filters);
		$data['count'] = $this->Turf_model->count_all_turfs($filters);
		$data['total'] = $this->Turf_model->count_all_turfs();
		$data['inactive'] = $this->Turf_model->count_all_turfs(['inactive' => 1]);
		$data['pagination'] = pagination(site_url('admin/turf/listing'), $data['count'], ROWS_PER_LISTING);

		$date = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m-d');
		$timestamp = strtotime($date);
		$day = date('l', $timestamp);

		foreach ($data['turfs'] as $key => $turf)
		{
        	$data['turfs'][$key]['slots'] = $this->Turf_model->get_all_turf_slots($turf['id'], $day);
        	$data['turfs'][$key]['booked_slots'] = $this->Turf_model->get_all_turf_booked_slots($turf['id'], $day, $date);
		}

		$data['tab'] = 'turfs';
		$data['subtab'] = 'list';
		$data['title'] = 'Turf Listing';
		$data['_view'] = 'admin/turf/listing';
		$this->load->view('admin/layout/basetemplate', $data);
	}

	public function status($id = 0)
	{
		$this->authenticate(current_url());

		$data['turf'] = $this->Turf_model->get_turf_by_id($id);

		if(!empty($data['turf']))
		{
			$inactive = !$data['turf']['inactive'];
			$result = $this->Turf_model->update($id, ['inactive' => $inactive]);

			if($result)
			{
				$this->session->set_flashdata('success_message', 'Turf status updated successfully');
	            redirect('admin/turf/listing');
	            exit;
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Some error occured while updating the status');
	            redirect('admin/turf/listing');
	            exit;
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Turf not found');
            redirect('admin/turf/listing');
            exit;
		}
	}
}
