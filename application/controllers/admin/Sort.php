<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sort extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Sort_model');
	}

	public function index()
	{
		$table = $this->input->get('table');
		$response = $this->Sort_model->change_order($table, $this->input->post('data'));
		echo json_encode(['success' => true, 'message' => 'Sorting completed successfully']);
		exit;
	}
}