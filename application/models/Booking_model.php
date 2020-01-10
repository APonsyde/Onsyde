<?php

class Booking_model extends CI_Model 
{

	public function book($booking_data, $slots)
	{
		$this->db->insert('bookings', $booking_data);
		$booking_id = $this->db->insert_id();

		if(!empty($slots))
		{
			$booking_slots = [];

			foreach ($slots as $key => $slot)
			{
				$booking_slots[] = [
					'booking_id' => $booking_id,
					'turf_slot_id' => $slot['id'],
					'slot_amount' => $slot['price']
				];
			}

			$this->db->insert_batch('booking_slots', $booking_slots);
		}

		return $booking_id;
	}

	public function get_all_bookings($limit = 0, $offset = 0, $params = null)
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
			$this->db->select('t.*, b.id, b.booking_date, b.time_slot, b.amount, p.full_name as player, p.mobile as player_mobile');

		$this->db->from('bookings b');
		$this->db->join('turfs t', 't.id = b.turf_id', 'inner');
		$this->db->join('players p', 'p.id = b.player_id', 'inner');
		$this->db->group_by('b.id');
		return $this->db->get()->result_array();
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

		if(!empty($params['player_id']))
			$this->db->where('b.player_id', $params['player_id']);

		if(!empty($params['turf_id']))
			$this->db->where('b.turf_id', $params['turf_id']);

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