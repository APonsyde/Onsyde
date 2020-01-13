<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package         Onsyde
 * @subpackage      Front
 * @category        FrontController
 * @author          Yohhan Dalvi
 */

class FrontController extends BaseController {

	public $player;

	public function __construct()
	{
		// main constructor
		parent::__construct();

		if($this->session->userdata('player_id'))
		{
			$this->load->model('Player_model');
			$player = $this->Player_model->get_player_by_id($this->session->userdata('player_id'));

			$this->player = [
				'id' => $player['id'],
				'name' => $player['full_name'],
				'email' => $player['email']
			];
		}

		$this->set_vars();
	}

	public function set_vars()
	{
		$vars = [];
		$this->load->vars($vars);
	}

	public function authenticate($redirect_to = null, $check_permission = true)
	{
		if($this->player['id']) {
			return TRUE;
		} else {
			if(is_null($redirect_to)) {
				$url = site_url();
			} else {
				$url = site_url('player?redirect_to='.urlencode($redirect_to));
			}
			redirect($url);
		}
	}

}