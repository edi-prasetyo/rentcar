<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Topup_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_alltopup()
    {
        $this->db->select('*');
        $this->db->from('topup');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function create($data)
    {
        $this->db->insert('topup', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function last_topup($id)
    {
        $this->db->select('topup.*, user.name, user_code, user.user_phone, user.email');
        $this->db->from('topup');
        // join
        $this->db->join('user', 'user.id = topup.user_id', 'LEFT');
        // End Join
        $this->db->where('topup.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function new_topup()
    {
        $this->db->select('*');
        $this->db->from('topup');
        // $this->db->join('user', 'user.id = topup.user_id', 'LEFT');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result();
    }

    // ------------------ Top Up Pending ----------------//
    public function get_topup($limit, $start)
    {
        $this->db->select('topup.*, user.name, user_code');
        $this->db->from('topup');
        // join
        $this->db->join('user', 'user.id = topup.user_id', 'LEFT');
        // End Join
        $this->db->where('topup.status_bayar', 'Pending');
        $this->db->order_by('topup.id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    //Total
    public function total_row()
    {
        $this->db->select('topup.*, user.name');
        $this->db->from('topup');
        // Join
        $this->db->join('user', 'user.id = topup.user_id', 'LEFT');
        //End Join
        $this->db->where('topup.status_bayar', 'Pending');
        $this->db->order_by('topup.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // ---------------- End Top Up Pending ----------------//

    // ------------------ Top Up Sukses ----------------//
    public function get_topup_sukses($limit, $start, $code_topup, $date_created, $nama_driver)
    {
        $this->db->select('topup.*, user.name, user_code');
        $this->db->from('topup');
        // join
        $this->db->join('user', 'user.id = topup.user_id', 'LEFT');
        // End Join
        $this->db->where('topup.status_bayar', 'Success');
        $this->db->like('topup.code_topup', $code_topup);
        $this->db->like('topup.date_created', $date_created);
        $this->db->like('name', $nama_driver);
        $this->db->order_by('topup.id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    //Total
    public function total_row_sukses($code_topup, $date_created, $nama_driver)
    {
        $this->db->select('topup.*, user.name');
        $this->db->from('topup');
        // Join
        $this->db->join('user', 'user.id = topup.user_id', 'LEFT');
        //End Join
        $this->db->where('topup.status_bayar', 'Success');
        $this->db->like('topup.code_topup', $code_topup);
        $this->db->like('topup.date_created', $date_created);
        $this->db->like('name', $nama_driver);
        $this->db->order_by('topup.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // ---------------- End Top Up Sukses ----------------//

    // ------------------ Top Up Batal ----------------//
    public function get_topup_batal($limit, $start, $code_topup,  $date_created, $nama_counter)
    {
        $this->db->select('topup.*, user.name, user_code');
        $this->db->from('topup');
        // join
        $this->db->join('user', 'user.id = topup.user_id', 'LEFT');
        // End Join
        $this->db->where('topup.status_bayar', 'Decline');
        $this->db->like('code_topup', $code_topup);
        $this->db->like('topup.code_topup', $code_topup);
        $this->db->like('topup.date_created', $date_created);
        $this->db->like('name', $nama_counter);
        $this->db->order_by('topup.id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    //Total
    public function total_row_batal($code_topup, $date_created, $nama_counter)
    {
        $this->db->select('topup.*, user.name');
        $this->db->from('topup');
        // Join
        $this->db->join('user', 'user.id = topup.user_id', 'LEFT');
        //End Join
        $this->db->where('topup.status_bayar', 'Decline');
        $this->db->like('code_topup', $code_topup);
        $this->db->like('topup.code_topup', $code_topup);
        $this->db->like('topup.date_created', $date_created);
        $this->db->like('name', $nama_counter);
        $this->db->order_by('topup.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // ---------------- End Top Up Batal ----------------//

    // PENJUMLAHAN
    //Total Top Up Masuk
    public function total_topup()
    {
        $this->db->select_sum('nominal');
        $this->db->where('status_bayar', 'Success');
        $query = $this->db->get('topup');
        if ($query->num_rows() > 0) {
            return $query->row()->nominal;
        } else {
            return 0;
        }
    }

    // Riwayat Top up Driver
    public function get_riwayat_topup_driver($limit, $start, $user_id)
    {
        $this->db->select('topup.*, user.name, user_code');
        $this->db->from('topup');
        // join
        $this->db->join('user', 'user.id = topup.user_id', 'LEFT');
        // End Join
        $this->db->where('user_id', $user_id);
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }


    //Total Top Up Driver
    public function get_row_driver($user_id)
    {
        $this->db->select('topup.*, user.name');
        $this->db->from('topup');
        // Join
        $this->db->join('user', 'user.id = topup.user_id', 'LEFT');
        //End Join
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Detail Top Up
    public function detail_topup($id)
    {
        $this->db->select('topup.*, user.name, user_code, user.user_phone, user.email');
        $this->db->from('topup');
        // join
        $this->db->join('user', 'user.id = topup.user_id', 'LEFT');
        // End Join
        $this->db->where(['topup.id' => $id]);
        $query = $this->db->get();
        return $query->row();
    }
    // Detail Top Up Konfirmasi
    public function detail_topup_konfirmasi($id)
    {
        $this->db->select('topup.*, user.name, user_code, user.user_phone, user.email');
        $this->db->from('topup');
        // join
        $this->db->join('user', 'user.id = topup.user_id', 'LEFT');
        // End Join
        $this->db->where(['topup.id' => $id]);
        $query = $this->db->get();
        return $query->row();
    }

    // Topup User
    public function get_my_topup($user_id)
    {
        $this->db->select('*');
        $this->db->from('topup');
        $this->db->where(['user_id' => $user_id, 'status_bayar' => 'Pending']);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
    // Update Data
    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('topup', $data);
    }
}
