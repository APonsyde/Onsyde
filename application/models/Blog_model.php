<?php

class Blog_model extends CI_Model {

	public function add($data)
	{
		return $this->db->insert('blogs', $data);
	}

	public function update($id, $data)
	{
		return $this->db->update('blogs', $data, array('id' => $id));
	}

	public function get_blog_by_id($id)
	{
		$this->db->select('b.*');
		$this->db->from('blogs b');
		$this->db->where('b.id', $id);
		return $this->db->get()->row_array();
	}

	public function get_all_blogs($limit = 0, $offset = 0, $params = null)
	{
		if($limit)
			$this->db->limit($limit, $offset);

		$this->_set_filters($params);

		if(isset($params['sort'])) {
			$ord_data = explode(',', $params['sort']);
			if(count($ord_data) == 1) {
				$ord = explode('=', $ord_data[0]);
				if (isset($ord[0]) && isset($ord[1])) {
					$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'b.'.$ord[0];
					$this->db->order_by($ord0, $ord[1]);
				}
			} else {
				foreach ($ord_data as $key => $value) {
					$ord = explode('=', $value);
					if (isset($ord[0]) && isset($ord[1])) {
						$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'b.'.$ord[0];
						$this->db->order_by($ord0, $ord[1]);
					}
				}
			}
		} else {
			$this->db->order_by('b.id', 'DESC');
		}

		if(!empty($params['select']))
			$this->db->select($params['select']);
		else
			$this->db->select('b.*');

		$this->db->from('blogs b');

		$this->db->group_by('b.id');
		$this->db->where('b.deleted', 0);
		return $this->db->get()->result_array();
	}

	public function count_all_blogs($params = 0)
	{
		$this->_set_filters($params);

		$this->db->where('b.deleted', 0);
		return $this->db->count_all_results('blogs b');
	}

	private function _set_filters($params = null)
	{
		if(isset($params['include_ids'])) {
			if(!empty($params['include_ids']))
				$this->db->where_in('b.id', $params['include_ids']);
			else
				$this->db->where_in('b.id', [0]);
		}

		if(!empty($params['exclude_ids']))
			$this->db->where_not_in('b.id', $params['exclude_ids']);

		if(!empty($params['search'])) {
			$this->db->group_start();
			$this->db->like('b.id', $params['search'], 'both');
			$this->db->or_like('b.title', $params['search'], 'both');
			$this->db->group_end();
		} 

		if(isset($params['inactive']) && is_numeric($params['inactive']))
			$this->db->where('b.inactive', $params['inactive']);
	}
}