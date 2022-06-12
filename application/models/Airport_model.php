<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Airport_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allairport()
    {
        $this->db->select('*');
        $this->db->from('airport');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_airport($limit, $start)
    {
        $this->db->select('airport.*,kota.kota_name');
        $this->db->from('airport');
        // Join
        $this->db->join('kota', 'kota.id = airport.kota_id', 'LEFT');
        // End Join
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('airport');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function detail($airport_id)
    {
        $this->db->select('*');
        $this->db->from('airport');
        $this->db->where('id', $airport_id);
        $query = $this->db->get();
        return $query->row();
    }
    public function detail_airport($id)
    {
        $this->db->select('*');
        $this->db->from('airport');
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
    public function detail_paket($id)
    {
        $this->db->select('*');
        $this->db->from('paket_airport');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function paket_airport($mobil_id)
    {
        $this->db->select('paket_airport.*, mobil.mobil_name, kota.kota_name');
        $this->db->from('paket_airport');
        // Join
        $this->db->join('mobil', 'mobil.id = paket_airport.mobil_id', 'LEFT');
        $this->db->join('kota', 'kota.id = paket_airport.kota_id', 'LEFT');
        // End Join
        $this->db->where('mobil_id', $mobil_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function airport_mobil($mobil_id, $airport_id)
    {
        $this->db->select('paket_airport.*, mobil.mobil_name, kota.kota_name, airport.airport_name');
        $this->db->from('paket_airport');
        // Join
        $this->db->join('mobil', 'mobil.id = paket_airport.mobil_id', 'LEFT');
        $this->db->join('kota', 'kota.id = paket_airport.kota_tujuan', 'LEFT');
        $this->db->join('airport', 'airport.id = paket_airport.airport_id', 'LEFT');
        // End Join
        $this->db->where(['mobil_id' => $mobil_id, 'airport_id' => $airport_id]);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    //Detail paket
    public function airport_detail($airport_id, $kota_tujuan)
    {
        $this->db->select('paket_airport.*, ketentuan.ketentuan_desc');
        $this->db->from('paket_airport');
        // Join
        $this->db->join('ketentuan', 'ketentuan.id = paket_airport.ketentuan_id', 'LEFT');
        // End Join
        $this->db->where(['md5(airport_id)' => $airport_id, 'md5(kota_tujuan)' => $kota_tujuan]);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->row();
    }
    public function search_city($airport_id, $kota_id)
    {
        $this->db->select('paket_airport.*, mobil.mobil_name, mobil.mobil_gambar, mobil.mobil_penumpang, mobil.mobil_bagasi');
        $this->db->from('paket_airport');
        // Joion
        $this->db->join('mobil', 'mobil.id = paket_airport.mobil_id', 'LEFT');
        $this->db->where('md5(airport_id)', $airport_id);
        $this->db->where('md5(kota_tujuan)', $kota_id);
        $this->db->order_by('paket_airport.id', 'ASC');
        $this->db->group_by('paket_airport.mobil_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function airport_encrypt($airport_id)
    {
        $this->db->select('*');
        $this->db->from('airport');
        $this->db->where('md5(id)', $airport_id);
        $query = $this->db->get();
        return $query->row();
    }

    // Create
    public function create_paket($data)
    {
        $this->db->insert('paket_airport', $data);
    }
    // Create
    public function create($data)
    {
        $this->db->insert('airport', $data);
    }
    // Update
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('airport', $data);
    }
    //
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('airport', $data);
    }
    //Delete Data
    public function delete_paket($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('paket_airport', $data);
    }
}
