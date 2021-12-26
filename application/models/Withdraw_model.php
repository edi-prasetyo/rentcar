<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Withdraw_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allwithdraw()
    {
        $this->db->select('*');
        $this->db->from('withdraw');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function create($data)
    {
        $this->db->insert('withdraw', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function last_withdraw($id)
    {
        $this->db->select('withdraw.*, user.name, user_code, user.user_phone, user.email');
        $this->db->from('withdraw');
        // join
        $this->db->join('user', 'user.id = withdraw.user_id', 'LEFT');
        // End Join
        $this->db->where('withdraw.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function new_withdraw()
    {
        $this->db->select('*');
        $this->db->from('withdraw');
        // $this->db->join('user', 'user.id = withdraw.user_id', 'LEFT');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result();
    }

    // -------------- Withdraw Pending ---------------//
    public function get_withdraw($limit, $start)
    {
        $this->db->select('withdraw.*, kota.kota_name, user.name, user_code');
        $this->db->from('withdraw');
        // join 3 table
        $this->db->join('user', 'user.id = withdraw.user_id', 'LEFT');
        $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
        // end join 3 table
        $this->db->where('status_withdraw', 'Pending');
        $this->db->order_by('withdraw.id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    //Total Berita Main Page
    public function total_row()
    {
        $this->db->select('withdraw.*, kota.kota_name, user.name');
        $this->db->from('withdraw');
        // join 3 table
        $this->db->join('user', 'user.id = withdraw.user_id', 'LEFT');
        $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
        // end join 3 table
        $this->db->where('status_withdraw', 'Pending');
        $this->db->order_by('withdraw.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // -------------- End Withdraw Pending ---------------//

    // -------------- Withdraw Sukses ---------------//
    public function get_withdraw_sukses($limit, $start, $nama_mainagen, $date_created, $code_withdraw)
    {
        $this->db->select('withdraw.*, kota.kota_name, user.name, user_code');
        $this->db->from('withdraw');
        // join 3 table
        $this->db->join('user', 'user.id = withdraw.user_id', 'LEFT');
        $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
        // end join 3 table
        $this->db->where('status_withdraw', 'Success');
        $this->db->like('user.name', $nama_mainagen);
        $this->db->like('withdraw.date_created', $date_created);
        $this->db->like('withdraw.code_withdraw', $code_withdraw);
        $this->db->order_by('withdraw.id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    //Total Berita Main Page
    public function total_row_sukses($nama_mainagen, $date_created, $code_withdraw)
    {
        $this->db->select('withdraw.*, kota.kota_name, user.name');
        $this->db->from('withdraw');
        // join 3 table
        $this->db->join('user', 'user.id = withdraw.user_id', 'LEFT');
        $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
        // end join 3 table
        $this->db->where('status_withdraw', 'Success');
        $this->db->like('user.name', $nama_mainagen);
        $this->db->like('withdraw.date_created', $date_created);
        $this->db->like('withdraw.code_withdraw', $code_withdraw);
        $this->db->order_by('withdraw.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // -------------- End Withdraw Pending ---------------//

    // Detail Top Up
    public function detail_withdraw($id)
    {
        $this->db->select('withdraw.*, kota.kota_name, user.kota_id, user.name, user_code, user.user_phone, user.email,user.bank_name,user.bank_number, user.bank_account, user.bank_branch');
        $this->db->from('withdraw');
        // join 3 table
        $this->db->join('user', 'user.id = withdraw.user_id', 'LEFT');
        $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
        // end join 3 table
        $this->db->where(['withdraw.id' => $id]);
        $query = $this->db->get();
        return $query->row();
    }
    // Detail Top Up Konfirmasi
    public function detail_withdraw_konfirmasi($id)
    {
        $this->db->select('withdraw.*, user.name, user_code, user.user_phone, user.email');
        $this->db->from('withdraw');
        // join
        $this->db->join('user', 'user.id = withdraw.user_id', 'LEFT');
        // End Join
        $this->db->where(['withdraw.id' => $id]);
        $query = $this->db->get();
        return $query->row();
    }

    // Withdraw User
    public function get_my_withdraw($user_id)
    {
        $this->db->select('*');
        $this->db->from('withdraw');
        $this->db->where(['user_id' => $user_id, 'status_withdraw' => 'Pending']);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
    // Withdraw User
    public function get_my_withdraw_success($user_id)
    {
        $this->db->select('*');
        $this->db->from('withdraw');
        $this->db->where(['user_id' => $user_id, 'status_withdraw' => 'Success']);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
    // All Withdraw User
    public function get_allmy_withdraw($user_id, $limit, $start)
    {
        $this->db->select('*');
        $this->db->from('withdraw');
        $this->db->where(['user_id' => $user_id]);
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    //Total Berita Main Page
    public function total_row_my_withdraw()
    {
        $this->db->select('withdraw.*, user.name');
        $this->db->from('withdraw');
        // Join
        $this->db->join('user', 'user.id = withdraw.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // Update Data
    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('withdraw', $data);
    }
}
