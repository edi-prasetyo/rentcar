<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kota_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allkota()
    {
        $this->db->select('kota.*, provinsi_name');
        $this->db->from('kota');
        // join
        $this->db->join('provinsi', 'provinsi.id = kota.provinsi_id', 'LEFT');
        // End Join
        $this->db->order_by('provinsi.provinsi_name', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_array_kota($provinsi_id)
    {

        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where(['provinsi_id' => $provinsi_id]);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_kota_asal($kota_asal)
    {

        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where('id', $kota_asal);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_kota_tujuan($kota_tujuan)
    {

        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where('id', $kota_tujuan);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_kota($limit, $start)
    {
        $this->db->select('kota.*, provinsi_name');
        $this->db->from('kota');
        // join
        $this->db->join('provinsi', 'provinsi.id = kota.provinsi_id', 'LEFT');
        // End Join
        $this->db->limit($limit, $start);
        $this->db->order_by('provinsi.provinsi_name', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->order_by('kota_name', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function detail($kota_id)
    {
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where('id', $kota_id);
        $query = $this->db->get();
        return $query->row();
    }
    public function detail_kota($id)
    {
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function detail_encrypt($kota_id)
    {
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where('md5(id)', $kota_id);
        $query = $this->db->get();
        return $query->row();
    }
    public function kota_asal_encrypt($kota_asal)
    {
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where('md5(id)', $kota_asal);
        $query = $this->db->get();
        return $query->row();
    }
    public function kota_tujuan_encrypt($kota_tujuan)
    {
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where('md5(id)', $kota_tujuan);
        $query = $this->db->get();
        return $query->row();
    }

    public function kota_by_provinsi($provinsi_id)
    {
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where(['id', $provinsi_id]);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Create
    public function create($data)
    {
        $this->db->insert('kota', $data);
    }
    // Update
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('kota', $data);
    }
    //
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('kota', $data);
    }
    public function delete_kota($id)
    {
        $this->db->where(['provinsi_id' => $id]);
        $this->db->delete(['kota']);
    }
}
