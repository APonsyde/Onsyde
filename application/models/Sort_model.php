<?php

class Sort_model extends CI_Model {

	public function change_order($table, $data)
	{
		$sort = [];

		if(!empty($data))
		{
			foreach ($data as $key => $id)
			{
				$sort[] = [
					'id' => $id,
					'sort' => $key + 1
				];
			}

			$this->db->update_batch($table, $sort, 'id');
		}

		return TRUE;
	}

	public function get_new_sort_number($params)
	{
		if(isset($params['column']) && isset($params['value']))
			$this->db->where($params['column'], $params['value']);

		$this->db->select('MAX(sort) as sort');
		$data = $this->db->get($params['table'])->row_array();

		if(empty($data))
			return 1;
		else
			return $data['sort'] + 1;
	}
}