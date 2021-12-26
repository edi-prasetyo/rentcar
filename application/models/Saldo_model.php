<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Saldo_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allsaldo()
    {
        $this->db->select('*');
        $this->db->from('saldo');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function create($data)
    {
        $this->db->insert('saldo', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }


    public function get_saldo($limit, $start)
    {
        $this->db->select('saldo.*, user.name, user_code');
        $this->db->from('saldo');
        // join
        $this->db->join('user', 'user.id = saldo.user_id', 'LEFT');
        // End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_saldo_counter($user_id, $limit, $start)
    {
        $this->db->select('saldo.*, user.name, user_code');
        $this->db->from('saldo');
        // join
        $this->db->join('user', 'user.id = saldo.user_id', 'LEFT');
        // End Join
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_saldo_mainagen($user_id, $limit, $start)
    {
        $this->db->select('saldo.*, user.name, user_code');
        $this->db->from('saldo');
        // join
        $this->db->join('user', 'user.id = saldo.user_id', 'LEFT');
        // End Join
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_my_saldo($user_id, $limit, $start)
    {
        $this->db->select('saldo.*, user.name, user_code');
        $this->db->from('saldo');
        // join
        $this->db->join('user', 'user.id = saldo.user_id', 'LEFT');
        // End Join
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_row_mysaldo_mainagen($user_id)
    {
        $this->db->select('saldo.*, user.name, user_code');
        $this->db->from('saldo');
        // join
        $this->db->join('user', 'user.id = saldo.user_id', 'LEFT');
        // End Join
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    //Total Berita Main Page
    public function total_row()
    {
        $this->db->select('saldo.*, user.name');
        $this->db->from('saldo');
        // Join
        $this->db->join('user', 'user.id = saldo.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_row_saldo_counter($user_id)
    {
        $this->db->select('*');
        $this->db->from('saldo');
        // Join

        //End Join
        $this->db->where(['user_id' => $user_id]);

        $this->db->order_by('saldo.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }


    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('saldo', $data);
    }
}
