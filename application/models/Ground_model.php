<?php

class Ground_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('grounds', $data);
		return $this->db->insert_id();
	}

	public function update($id, $data)
	{
		return $this->db->update('grounds', $data, array('id' => $id));
	}

	public function update_batch($data, $col) 
	{
		return $this->db->update_batch('grounds', $data, $col);
	}

	public function count_all_grounds($params = null)
	{
		$this->_set_filters($params);

		$this->db->where('g.deleted', 0);
		return $this->db->count_all_results('grounds g');
	}

	public function get_all_grounds($limit = 0, $offset = 0, $params = null)
	{
		if($limit)
			$this->db->limit($limit, $offset);

		if(!empty($params['select']))
			$this->db->select($params['select']);
		else
			$this->db->select('g.*');

		$this->_set_filters($params);

		$this->db->from('grounds g');
		$this->db->group_by('g.id');
		$this->db->where('g.deleted', 0);


		if(isset($params['sort'])) {
			$ord_data = explode(',', $params['sort']);
			if(count($ord_data) == 1) {
				$ord = explode('=', $ord_data[0]);
				if (isset($ord[0]) && isset($ord[1])) {
					$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'g.'.$ord[0];
					$this->db->order_by($ord0, $ord[1]);
				}
			} else {
				foreach ($ord_data as $key => $value) {
					$ord = explode('=', $value);
					if (isset($ord[0]) && isset($ord[1])) {
						$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'g.'.$ord[0];
						$this->db->order_by($ord0, $ord[1]);
					}
				}
			}
		} else {
			$this->db->order_by('g.id', 'DESC');
		}

		return $this->db->get()->result_array();
	}

	public function get_ground_by_id($id)
	{
		$this->db->select('g.*');
		$this->db->from('grounds g');
		$this->db->where('g.deleted', 0);
		$this->db->group_by('g.id');
		$this->db->where('g.id', $id);
		return $this->db->get()->row_array();
	}

	private function _set_filters($params = null)
	{
		if(isset($params['include_ids'])) {
			if(!empty($params['include_ids']))
				$this->db->where_in('g.id', $params['include_ids']);
			else
				$this->db->where_in('g.id', [0]);
		}

		if(!empty($params['exclude_ids']))
			$this->db->where_not_in('g.id', $params['exclude_ids']);

		if(!empty($params['search'])) {
			$this->db->group_start();
			$this->db->like('g.id', $params['search'], 'both');
			$this->db->or_like('g.ground_name', $params['search'], 'both');
			$this->db->or_like('g.pincode', $params['search'], 'both');
			$this->db->group_end();
		} 

		if(isset($params['inactive']) && is_numeric($params['inactive']))
			$this->db->where('g.inactive', $params['inactive']);


	}


}