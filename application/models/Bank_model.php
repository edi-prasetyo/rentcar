<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allbank()
    {
        $this->db->select('*');
        $this->db->from('bank');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_bank($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('bank');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    //Total Bank Main Page
    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('bank');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function bank_detail($id)
    {
        $this->db->select('*');
        $this->db->from('bank');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //Kirim Data Bank ke database
    public function create($data)
    {
        $this->db->insert('bank', $data);
    }
    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('bank', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('bank', $data);
    }

    // Data Bank yang di tampilkan di Front End

    //listing Bank Main Page
    public function bank($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('bank');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    //Total Bank Main Page
    public function total()
    {
        $this->db->select('*');
        $this->db->from('bank');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
