<?php

class Turf_model extends CI_Model 
{

	public function add($data)
	{
		$this->db->insert('turfs', $data);
		return $this->db->insert_id();
	}
 
	public function update($id, $data)
	{
		return $this->db->update('turfs', $data, array('id' => $id));
	}

	public function update_batch($data, $col) 
	{
		return $this->db->update_batch('turfs', $data, $col);
	}

	public function get_all_turfs($limit=0, $offset=0)
	{
		if($limit)
			$this->db->limit($limit, $offset);
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