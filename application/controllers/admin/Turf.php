<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turf extends AdminController 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Turf_model');
		$this->load->model('Sort_model');
	}

	public function listing()
	{
		$this->authenticate(current_url());

		$filters = $this->input->get();

		$offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
		$data['turfs'] = $this->Turf_model->get_all_turfs(ROWS_PER_LISTING, $offset, $filters);
		$data['count'] = $this->Turf_model->count_all_turfs($filters);
		$data['total'] = $this->Turf_model->count_all_turfs();
		$data['inactive'] = $this->Turf_model->count_all_turfs(['inactive' => 1]);
		$data['pagination'] = pagination(site_url('turf/listing'), $data['count'], ROWS_PER_LISTING);

		$data['tab'] = 'turfs';
		$data['title'] = 'Turf Listing';
		$data['_view'] = 'admin/turf/listing';
		$this->load->view('admin/layout/basetemplate', $data);
	}
}
