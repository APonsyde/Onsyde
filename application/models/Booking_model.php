<?php

class Booking_model extends CI_Model 
{
	public function update($id, $data)
	{
		return $this->db->update('bookings', $data, array('id' => $id));
	}

	public function book($booking_data, $slots)
	{
		$booking_data['booking_key'] = strtoupper(random_string('alnum', 12));
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
			$this->db->select('t.*, b.id, b.booking_key, b.booking_date, b.time_slot, b.amount, b.status, IF(b.booking_date > DATE(CURRENT_DATE()), 1, 0) as player_cancellation, p.full_name as player, p.mobile as player_mobile');

		$this->db->from('bookings b');
		$this->db->join('turfs t', 't.id = b.turf_id', 'inner');
		$this->db->join('players p', 'p.id = b.player_id', 'inner');
		$this->db->group_by('b.id');
		return $this->db->get()->result_array();
	}

	public function get_booking_by_id($id)
	{
		$this->db->select('t.*, b.id, b.booking_key, b.player_id, b.booking_date, b.time_slot, b.amount, b.status, IF(b.booking_date > DATE(CURRENT_DATE()), 1, 0) as player_cancellation, p.full_name as player, p.mobile as player_mobile');
		$this->db->from('bookings b');
		$this->db->join('turfs t', 't.id = b.turf_id', 'inner');
		$this->db->join('players p', 'p.id = b.player_id', 'inner');
		$this->db->where('b.id', $id);
		return $this->db->get()->row_array();
	}

	public function add_invite($invite_data)
	{
		$invite_data['invite_key'] = strtoupper(random_string('alnum', 12));
		$this->db->insert('booking_invites', $invite_data);
		return $this->db->insert_id();
	}

	public function update_invite($id, $invite_data)
	{
		return $this->db->update('booking_invites', $invite_data, array('id' => $id));
	}

	public function delete_invite($id)
	{
		return $this->db->delete('booking_invites', array('id' => $id));
	}

	public function get_booking_by_params($params)
	{
		if(isset($params['booking_key']))
			$this->db->where('b.booking_key', $params['booking_key']);

		$this->db->select('t.*, b.id, b.booking_key, b.player_id, b.booking_date, b.time_slot, b.amount, b.status, IF(b.booking_date > DATE(CURRENT_DATE()), 1, 0) as player_cancellation, p.full_name as player, p.mobile as player_mobile');
		$this->db->from('bookings b');
		$this->db->join('turfs t', 't.id = b.turf_id', 'inner');
		$this->db->join('players p', 'p.id = b.player_id', 'inner');
		return $this->db->get()->row_array();
	}

	public function get_booking_invite_by_params($params)
	{
		if(!empty($params['invite_key']))
			$this->db->where('bi.invite_key', $params['invite_key']);

		if(!empty($params['id']))
			$this->db->where('bi.id', $params['id']);

		if(!empty($params['booking_id']))
			$this->db->where('bi.booking_id', $params['booking_id']);

		if(!empty($params['mobile']))
			$this->db->where('bi.mobile', $params['mobile']);

		$this->db->select('t.*, b.id, b.booking_key, b.player_id, b.booking_date, b.time_slot, b.amount, b.status, bi.id as invited_id, bi.invite_key, bi.name as invited_name, bi.mobile as invited_mobile, bi.status as invited_status, bi.invited_by, , p.full_name as invited_by_player');
		$this->db->from('bookings b');
		$this->db->join('turfs t', 't.id = b.turf_id', 'inner');
		$this->db->join('booking_invites bi', 'b.id = bi.booking_id', 'inner');
		$this->db->join('players p', 'p.id = bi.invited_by', 'inner');
		return $this->db->get()->row_array();
	}

	public function get_all_booking_players($limit = 0, $offset = 0, $params = null)
	{
		if($limit)
			$this->db->limit($limit, $offset);

		if(isset($params['sort'])) {
			$ord_data = explode(',', $params['sort']);
			if(count($ord_data) == 1) {
				$ord = explode('=', $ord_data[0]);
				if (isset($ord[0]) && isset($ord[1])) {
					$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'p.'.$ord[0];
					$this->db->order_by($ord0, $ord[1]);
				}
			} else {
				foreach ($ord_data as $key => $value) {
					$ord = explode('=', $value);
					if (isset($ord[0]) && isset($ord[1])) {
						$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'p.'.$ord[0];
						$this->db->order_by($ord0, $ord[1]);
					}
				}
			}
		} else {
			$this->db->order_by('p.id', 'DESC');
		}

		if(!empty($params['select']))
			$this->db->select($params['select']);
		else
			$this->db->select('p.*');

		if(!empty($params['turf_id']))
			$this->db->where('b.turf_id', $params['turf_id']);

		if(!empty($params['status']))
			$this->db->where('b.status', $params['status']);

		$this->db->from('bookings b');
		$this->db->join('turfs t', 't.id = b.turf_id', 'inner');
		$this->db->join('players p', 'p.id = b.player_id', 'inner');
		$this->db->group_by('p.id');
		return $this->db->get()->result_array();
	}

	public function get_all_booking_invited_players($limit = 0, $offset = 0, $params = null)
	{
		if($limit)
			$this->db->limit($limit, $offset);

		if(isset($params['sort'])) {
			$ord_data = explode(',', $params['sort']);
			if(count($ord_data) == 1) {
				$ord = explode('=', $ord_data[0]);
				if (isset($ord[0]) && isset($ord[1])) {
					$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'bi.'.$ord[0];
					$this->db->order_by($ord0, $ord[1]);
				}
			} else {
				foreach ($ord_data as $key => $value) {
					$ord = explode('=', $value);
					if (isset($ord[0]) && isset($ord[1])) {
						$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'bi.'.$ord[0];
						$this->db->order_by($ord0, $ord[1]);
					}
				}
			}
		} else {
			$this->db->order_by('bi.id', 'DESC');
		}

		if(!empty($params['select']))
			$this->db->select($params['select']);
		else
			$this->db->select('bi.*');

		if(!empty($params['booking_id']))
			$this->db->where('bi.booking_id', $params['booking_id']);

		if(!empty($params['invited_by']))
			$this->db->where('bi.invited_by', $params['invited_by']);

		$this->db->from('bookings b');
		$this->db->join('turfs t', 't.id = b.turf_id', 'inner');
		$this->db->join('booking_invites bi', 'b.id = bi.booking_id', 'inner');
		$this->db->group_by('bi.mobile');
		return $this->db->get()->result_array();
	}

	public function get_all_booking_recent_players($limit = 0, $offset = 0, $params = null)
	{
		if($limit)
			$this->db->limit($limit, $offset);

		if(isset($params['sort'])) {
			$ord_data = explode(',', $params['sort']);
			if(count($ord_data) == 1) {
				$ord = explode('=', $ord_data[0]);
				if (isset($ord[0]) && isset($ord[1])) {
					$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'bi.'.$ord[0];
					$this->db->order_by($ord0, $ord[1]);
				}
			} else {
				foreach ($ord_data as $key => $value) {
					$ord = explode('=', $value);
					if (isset($ord[0]) && isset($ord[1])) {
						$ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'bi.'.$ord[0];
						$this->db->order_by($ord0, $ord[1]);
					}
				}
			}
		} else {
			$this->db->order_by('bi.id', 'DESC');
		}

		if(!empty($params['select']))
			$this->db->select($params['select']);
		else
			$this->db->select('bi.*');

		if(!empty($params['booking_id']))
			$this->db->where('bi.booking_id', $params['booking_id']);

		if(!empty($params['invited_by']))
			$this->db->where('bi.invited_by', $params['invited_by']);

		if(!empty($params['exclude_mobiles']))
			$this->db->where_not_in('bi.mobile', $params['exclude_mobiles']);

		$this->db->from('bookings b');
		$this->db->join('turfs t', 't.id = b.turf_id', 'inner');
		$this->db->join('booking_invites bi', 'b.id = bi.booking_id', 'inner');
		$this->db->group_by('bi.mobile');
		return $this->db->get()->result_array();
	}

	public function get_booking_data($turf_id = null, $params = null)
	{
		$turf_condition = null;

		if($turf_id !== null)
			$turf_condition = " AND b.turf_id = ".$turf_id;

		$today =  !empty($params['today']) ? $params['today'] : date('Y-m-d');
		$from_date =  !empty($params['from_date']) ? $params['from_date'] : date('Y-m-d');
		$to_date =  !empty($params['to_date']) ? $params['to_date'] : date('Y-m-d');

		$sql = "SELECT IFNULL(COUNT(bs.id), 0) as todays_bookings FROM booking_slots bs INNER JOIN bookings b ON b.id = bs.booking_id WHERE booking_date = ? AND b.status = ? ".$turf_condition.";";
		$data1 = $this->db->query($sql, [$today, TURF_STATUS_BOOKED])->row_array();

		$sql = "SELECT IFNULL(SUM(bs.slot_amount), 0) as todays_earnings FROM booking_slots bs INNER JOIN bookings b ON b.id = bs.booking_id WHERE booking_date = ? AND b.status = ? ".$turf_condition.";";
		$data2 = $this->db->query($sql, [$today, TURF_STATUS_BOOKED])->row_array();

		$sql = "SELECT IFNULL(COUNT(bs.id), 0) as todays_bookings FROM booking_slots bs INNER JOIN bookings b ON b.id = bs.booking_id WHERE booking_date >= CAST(? AS DATE) AND booking_date <= CAST(? AS DATE) AND b.status = ? ".$turf_condition.";";
		$data3 = $this->db->query($sql, [$from_date, $to_date, TURF_STATUS_BOOKED])->row_array();

		$sql = "SELECT IFNULL(SUM(bs.slot_amount), 0) as todays_earnings FROM booking_slots bs INNER JOIN bookings b ON b.id = bs.booking_id WHERE booking_date >= CAST(? AS DATE) AND booking_date <= CAST(? AS DATE) AND b.status = ? ".$turf_condition.";";
		$data4 = $this->db->query($sql, [$from_date, $to_date, TURF_STATUS_BOOKED])->row_array();

		$return = [
			'todays_bookings' => $data1['todays_bookings'],
			'todays_earnings' => $data2['todays_earnings'],
			'custom_bookings' => $data3['todays_bookings'],
			'custom_earnings' => $data4['todays_earnings']
		];

		return $return;
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

		if(!empty($params['manager_id']))
			$this->db->where('t.manager_id', $params['manager_id']);

		if(!empty($params['player_id']))
			$this->db->where('b.player_id', $params['player_id']);

		if(!empty($params['turf_id']))
			$this->db->where('b.turf_id', $params['turf_id']);

		if(!empty($params['status']))
			$this->db->where('b.status', $params['status']);

		if(!empty($params['booking_date']))
			$this->db->where('b.booking_date', $params['booking_date']);

		if(!empty($params['from_booking_date']))
			$this->db->where('b.booking_date >=', $params['from_booking_date']);

		if(!empty($params['to_booking_date']))
			$this->db->where('b.booking_date <=', $params['to_booking_date']);

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