<?php

class Device_model extends CI_Model {

	public function add($data)
	{
		$this->db->delete('player_devices', ['imei' => $data['imei']]);
		$data['created_on'] = date('Y-m-d H:i:s');
		return $this->db->insert('player_devices', $data);
	}

	public function remove($data)
	{
		$this->db->delete('player_devices', $data);
		return $this->db->affected_rows();
	}

	public function update_by_api_token($token, $data)
	{
		return $this->db->update('player_devices', $data, ['api_token' => $token]);
	}

	public function delete_by_api_token($token)
	{
		return $this->db->delete('player_devices', ['api_token' => $token]);
	}
}