<?php

class Sport_model extends CI_Model {


    public function add($data)

    {
        $this->db->insert('sports', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)

    {
        return $this->db->update('sports', $data, array('id' => $id));
    }

    public function add_skill($data)

    {
        $this->db->insert('sport_skill_set', $data);
        return $this->db->insert_id();
    }

    public function add_rules($data)

    {
        $this->db->insert('sport_rules', $data);
        return $this->db->insert_id();
    }

    public function get_sport_images($id)
    {
        $this->db->select('si.*');
        $this->db->from('sport_images si');
        $this->db->where('si.deleted', 0);
        $this->db->where('si.sport_id', $id);
        $this->db->order_by('si.sort');
        return $this->db->get()->result_array();
    }

    public function get_all_sports($limit = 0, $offset = 0, $params = null)

    {
        if($limit)
            $this->db->limit($limit, $offset);

        if(!empty($params['exclude_ids']))
            $this->db->where_not_in('s.id', $params['exclude_ids']);

        // if(!empty($params['select']))
        //     $this->db->select($params['select'], 'aaa');
        // else
            $this->db->select('s.*, si.image' );

        $this->_set_filters($params);

        $this->db->from('sports s');
        $this->db->group_by('s.id');
        $this->db->where('s.deleted', 0);
        $this->db->join('sport_images si', 's.id = si.sport_id', 'left');

        if(isset($params['sort'])) {
            $ord_data = explode(',', $params['sort']);
            if(count($ord_data) == 1) {
                $ord = explode('=', $ord_data[0]);
                if (isset($ord[0]) && isset($ord[1])) {
                    $ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 's.'.$ord[0];
                    $this->db->order_by($ord0, $ord[1]);
                }
            } else {
                foreach ($ord_data as $key => $value) {
                    $ord = explode('=', $value);
                    if (isset($ord[0]) && isset($ord[1])) {
                        $ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 's.'.$ord[0];
                        $this->db->order_by($ord0, $ord[1]);
                    }
                }
            }
        } else {
            $this->db->order_by('s.id', 'DESC');
        }

        return $this->db->get()->result_array();
    }

    public function get_all_sport_skills($limit = 0, $offset = 0, $params = null)

    {
        if($limit)
            $this->db->limit($limit, $offset);

        if(!empty($params['select']))
            $this->db->select($params['select']);
        else
            $this->db->select('ss.*');

        if(!empty($params['sport_id']))
            $this->db->where('ss.sport_id', $params['sport_id']);

        $this->db->from('sport_skill_set ss');
        $this->db->group_by('ss.id');

        if(isset($params['sort'])) {
            $ord_data = explode(',', $params['sort']);
            if(count($ord_data) == 1) {
                $ord = explode('=', $ord_data[0]);
                if (isset($ord[0]) && isset($ord[1])) {
                    $ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'ss.'.$ord[0];
                    $this->db->order_by($ord0, $ord[1]);
                }
            } else {
                foreach ($ord_data as $key => $value) {
                    $ord = explode('=', $value);
                    if (isset($ord[0]) && isset($ord[1])) {
                        $ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'ss.'.$ord[0];
                        $this->db->order_by($ord0, $ord[1]);
                    }
                }
            }
        } else {
            $this->db->order_by('ss.id', 'DESC');
        }

        return $this->db->get()->result_array();
    }

    public function get_all_sport_rules($params = null)
    {
        if(!empty($params['select']))
            $this->db->select($params['select']);
        else
            $this->db->select('sr.*');

        if(!empty($params['sport_id']))
            $this->db->where('sr.sport_id', $params['sport_id']);

        $this->db->from('sport_rules sr');
        $this->db->group_by('sr.id');

        if(isset($params['sort'])) {
            $ord_data = explode(',', $params['sort']);
            if(count($ord_data) == 1) {
                $ord = explode('=', $ord_data[0]);
                if (isset($ord[0]) && isset($ord[1])) {
                    $ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'sr.'.$ord[0];
                    $this->db->order_by($ord0, $ord[1]);
                }
            } else {
                foreach ($ord_data as $key => $value) {
                    $ord = explode('=', $value);
                    if (isset($ord[0]) && isset($ord[1])) {
                        $ord0 = (strpos($ord[0], ".") !== false) ? $ord[0] : 'sr.'.$ord[0];
                        $this->db->order_by($ord0, $ord[1]);
                    }
                }
            }
        } else {
            $this->db->order_by('sr.id', 'DESC');
        }

        return $this->db->get()->result_array();
    }




    public function count_all_sports($params = null)

    {
        $this->_set_filters($params);

        $this->db->where('s.deleted', 0);
        return $this->db->count_all_results('sports s');
    }    


    public function get_sport_by_id($id)
    {
        $this->db->select('s.*', 'si.image');
        $this->db->from('sports s');
        $this->db->where('s.deleted', 0);
        $this->db->group_by('s.id');
        $this->db->where('s.id', $id);
        $this->db->join('sport_images si', 's.id = si.sport_id', 'left');
        return $this->db->get()->row_array();
    }

    public function get_sport_skill_set_by_id($id)

    {

        $this->db->select('sss.*');
        $this->db->from('sport_skill_set sss');
        $this->db->where('sss.deleted', 0);
        $this->db->where('sss.id', $id);
        return $this->db->get()->row_array();


    }

    public function get_sport_rules_by_id($id)

    {

        $this->db->select('sr.*');
        $this->db->from('sport_rules sr');
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.id', $id);
        return $this->db->get()->row_array();


    }

    public function delete_skill_set($id)

    {

        return $this->db->delete('sport_skill_set', ['id' => $id]);


    }

    public function delete_rules($id)

    {

        return $this->db->delete('sport_rules', ['id' => $id]);


    }



    private function _set_filters($params = null)

    {
        if(isset($params['include_ids'])) {
            if(!empty($params['include_ids']))
                $this->db->where_in('s.id', $params['include_ids']);
            else
                $this->db->where_in('s.id', [0]);
        }

        if(!empty($params['exclude_ids']))
            $this->db->where_not_in('s.id', $params['exclude_ids']);

        if(!empty($params['search'])) {
            $this->db->group_start();
            $this->db->like('s.id', $params['search'], 'both');
            $this->db->or_like('s.sport_name', $params['search'], 'both');
            $this->db->group_end();
        } 

        if(isset($params['inactive']) && is_numeric($params['inactive']))
            $this->db->where('s.inactive', $params['inactive']);


    }

}