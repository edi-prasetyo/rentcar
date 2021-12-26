<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Provinsi_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //listing Pendaftaran
    public function get_allprovinsi()
    {
        $this->db->select('*');
        $this->db->from('provinsi');
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
    public function get_provinsi($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('provinsi');
        $this->db->limit($limit, $start);
        $this->db->order_by('provinsi_name', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('provinsi');
        $this->db->order_by('provinsi_name', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }


    public function detail_provinsi($id)
    {
        $this->db->select('*');
        $this->db->from('provinsi');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function detail($provinsi_id)
    {
        $this->db->select('*');
        $this->db->from('provinsi');
        $this->db->where('id', $provinsi_id);
        $query = $this->db->get();
        return $query->row();
    }
    public function list_kota($provinsi_id)
    {
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where('provinsi_id', $provinsi_id);
        $this->db->order_by('kota.id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    // Create
    public function create($data)
    {
        $this->db->insert('provinsi', $data);
    }
    // Update
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('provinsi', $data);
    }
    //
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('provinsi', $data);
    }
}
