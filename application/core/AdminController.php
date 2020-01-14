<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package         Onsyde
 * @subpackage      Admin
 * @category        AdminController
 * @author          Yohhan Dalvi
 */
class AdminController extends BaseController {

	public $admin;

	public function __construct()
	{
		// main constructor
		parent::__construct();

		if($this->session->userdata('admin_id'))
		{
			$this->load->model('Admin_model');
			$admin = $this->Admin_model->get_admin_by_id($this->session->userdata('admin_id'));

			$this->admin = [
				'id' => $admin['id'],
				'username' => $admin['username'],
				'email' => $admin['email']
			];
		}
	}

	public function authenticate($redirect_to = null, $check_permission = true)
	{
		if($this->admin['id']) {
			return TRUE;
		} else {
			if(is_null($redirect_to)) {
				$url = site_url();
			} else {
				$url = site_url('admin?redirect_to='.urlencode($redirect_to));
			}
			redirect($url);
		}
	}

}