<?php

class Device_model extends CI_Model {

	public function update_by_api_token($token, $data)
	{
		return $this->db->update('manager_devices', $data, ['api_token' => $token]);
	}

	public function delete_by_api_token($token)
	{
		return $this->db->delete('manager_devices', ['api_token' => $token]);
	}
}