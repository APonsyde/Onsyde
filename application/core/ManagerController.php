<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package         Onsyde
 * @subpackage      Manager
 * @category        ManagerController
 * @author          Yohhan Dalvi
 */

class ManagerController extends BaseController {

	public $manager;

	public function __construct()
	{
		// main constructor
		parent::__construct();

		if($this->session->userdata('manager_id'))
			$this->manager['id'] = $this->session->userdata('manager_id');

		if($this->session->userdata('manager_name'))
			$this->manager['name'] = $this->session->userdata('manager_name');

		$this->set_vars();
	}

	public function set_vars()
	{
		$vars = [];
		$this->load->vars($vars);
	}

	public function authenticate($redirect_to = null, $check_permission = true)
	{
		if($this->manager['id']) {
			return TRUE;
		} else {
			if(is_null($redirect_to)) {
				$url = site_url();
			} else {
				$url = site_url('manager?redirect_to='.urlencode($redirect_to));
			}
			redirect($url);
		}
	}

}