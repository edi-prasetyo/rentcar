<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Point_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function all()
    {
        $this->db->select('*');
        $this->db->from('point');
        $this->db->where([
            'point_status'  => 1,
            'expired >='    => date('Y-m-d')

        ]);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            //record exists - hence fetch the row              
            return $query->result();
        } else {
            //Record do not exists
        }
    }
    public function get_all($user_id)
    {
        $this->db->select('*');
        $this->db->from('point');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function user_point($user_id)
    {
        $this->db->select('*');
        $this->db->from('point');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('point.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function total_user_point($user_id)
    {
        $this->db->select_sum('nominal_point');
        $this->db->where([
            'user_id'       => $user_id,
            'point_status'  => 1,
            'expired >='    => date('Y-m-d')
        ]);
        $result = $this->db->get('point')->row();
        return $result;
    }
    public function create($data)
    {
        $this->db->insert('point', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('bank', $data);
    }
}
