<?php

class Turf_model extends CI_Model 
{

	public function add($data)
	{
		$this->db->insert('turfs', $data);
		return $this->db->insert_id();
	}

	public function add_slots($turf_id, $intervals)
	{
		$slots = [];
		$days = get_days();

		foreach ($days as $key => $day)
		{
			foreach ($intervals as $key => $time)
			{
				$slots[] = [
					'turf_id' => $turf_id,
					'day' => $day,
					'time' => $time,
				];
			}
		}

		return $this->db->insert_batch('turf_slots', $slots);
	}
 
	public function update($id, $data)
	{
		return $this->db->update('turfs', $data, array('id' => $id));
	}

	public function update_batch($data, $col) 
	{
		return $this->db->update_batch('turfs', $data, $col);
	}

	public function update_slots_batch($data, $col) 
	{
		return $this->db->update_batch('turf_slots', $data, $col);
	}

	public function get_turf_by_id($id)
	{
		$this->db->select('t.*');
		$this->db->from('turfs t');
		$this->db->where('t.id', $id);
		return $this->db->get()->row_array();
	}

	public function get_all_turf_slots($id, $day)
	{
		$this->db->select('ts.*');
		$this->db->from('turf_slots ts');
		$this->db->where('ts.turf_id', $id);
		$this->db->where('ts.day', $day);
		return $this->db->get()->result_array();
	}

	public function get_all_turfs($limit = 0, $offset = 0, $params = null)
	{
		if($limit)
			$this->db->limit($limit, $offset);

		$this->_set_filters($params);

		if(isset($params['sort'])) {
			$ord_data = explode(',', $params['sort']);
			if(count($ord_data) == 1) {
				$ord = explode('=', $ord_data[0]);
				if (isset($ord[0]) && isset($ord[1])) {
					$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 't.'.$ord[0];
					$this->db->order_by($ord0, $ord[1]);
				}
			} else {
				foreach ($ord_data as $key => $value) {
					$ord = explode('=', $value);
					if (isset($ord[0]) && isset($ord[1])) {
						$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 't.'.$ord[0];
						$this->db->order_by($ord0, $ord[1]);
					}
				}
			}
		} else {
			$this->db->order_by('t.id', 'DESC');
		}

		if(!empty($params['select']))
			$this->db->select($params['select']);
		else
			$this->db->select('t.*');

		$this->db->from('turfs t');

		$this->db->group_by('t.id');
		$this->db->where('t.deleted', 0);
		return $this->db->get()->result_array();
	}

	public function get_turf_images($id)
	{
		$this->db->select('ti.*');
		$this->db->from('turf_images ti');
		$this->db->group_by('ti.id');
		return $this->db->get()->result_array();
	}

	public function count_all_turfs($params = 0)
	{
		$this->_set_filters($params);

		$this->db->where('t.deleted', 0);
		return $this->db->count_all_results('turfs t');
	}

	private function _set_filters($params = null)
	{
		if(isset($params['include_ids'])) {
			if(!empty($params['include_ids']))
				$this->db->where_in('t.id', $params['include_ids']);
			else
				$this->db->where_in('t.id', [0]);
		}

		if(!empty($params['exclude_ids']))
			$this->db->where_not_in('t.id', $params['exclude_ids']);

		if(!empty($params['search'])) {
			$this->db->group_start();
			$this->db->like('t.id', $params['search'], 'both');
			$this->db->or_like('t.turf_name', $params['search'], 'both');
			$this->db->or_like('t.pincode', $params['search'], 'both');
			$this->db->group_end();
		} 

		if(isset($params['inactive']) && is_numeric($params['inactive']))
			$this->db->where('t.inactive', $params['inactive']);
	}

}