<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turf extends ManagerController 
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
		$data['turfs'] = $this->Turf_model->get_all_turfs(ROWS_PER_LISTING, $offset, $filters);
		$data['count'] = $this->Turf_model->count_all_turfs($filters);
		$data['total'] = $this->Turf_model->count_all_turfs();
		$data['inactive'] = $this->Turf_model->count_all_turfs(['inactive' => 1]);
		$data['pagination'] = pagination(site_url('manager/turf/listing'), $data['count'], ROWS_PER_LISTING);

		$data['tab'] = 'turfs';
		$data['title'] = 'Turf Listing';
		$data['_view'] = 'manager/turf/listing';
		$this->load->view('manager/layout/basetemplate', $data);
	}

	public function create()
	{
		$this->authenticate(current_url());

		$this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
		$this->form_validation->set_rules('latitude', 'Latitude', 'required|xss_clean');
		$this->form_validation->set_rules('longitude', 'Longitude', 'required|xss_clean');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');
		$this->form_validation->set_rules('alternate_number', 'Alternate number', 'xss_clean');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

        if($this->form_validation->run())
        {
        	$data = $this->input->post();
        	$data['manager_id'] = $this->manager['id'];

            $result = $this->Turf_model->add($data);

            if($result)
            {
                $this->session->set_flashdata('success_message', 'Turf has been created');
                redirect('manager/turf/edit/'.$result);
                exit;
            }
            else
            {
                $this->session->set_flashdata('error_message', 'Some error occured while creating the turf');
                redirect('manager/turf/create');
                exit;
            }
        }
        else
        {
			$data['tab'] = 'turfs';
			$data['title'] = 'Create Turf';
			$data['_view'] = 'manager/turf/create';
			$this->load->view('manager/layout/basetemplate', $data);
		}
	}

}
