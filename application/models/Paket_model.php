<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  //listing Paket
  public function get_paket_jakarta()
  {
    $this->db->select('*');
    $this->db->from('paket');
    $this->db->order_by('paket_name', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_paket()
  {
    $this->db->select('*');
    $this->db->from('paket');
    $this->db->order_by('paket_name', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function detail($paket_id)
  {
    $this->db->select('paket.*, ketentuan.ketentuan_desc');
    $this->db->from('paket');
    $this->db->join('ketentuan', 'ketentuan.id = paket.ketentuan_id', 'LEFT');
    $this->db->where('paket.id', $paket_id);
    $query = $this->db->get();
    return $query->row();
  }

  //Detail paket
  public function detail_paket($id)
  {
    $this->db->select('*');
    $this->db->from('paket');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  //Read paket
  public function read($slug_paket)
  {
    $this->db->select('*');
    $this->db->from('paket');
    $this->db->where('slug_paket', $slug_paket);
    $this->db->order_by('id');
    $query = $this->db->get();
    return $query->row();
  }

  public function listpaket($mobil_id)
  {
    $this->db->select('*');
    $this->db->from('daily');
    $this->db->where('mobil_id', $mobil_id);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }

  public function paket_daily($mobil_id, $kota_id)
  {
    $this->db->select('*');
    $this->db->from('paket');
    $this->db->where(['mobil_id'  => $mobil_id, 'kota_id' => $kota_id, 'paket_type'  => 'Daily']);
    $this->db->order_by('paket_name', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_paket_daily($kota_id, $mobil_id)
  {
    $this->db->select('paket.*, mobil.mobil_name, mobil.mobil_gambar, mobil.mobil_penumpang, mobil.mobil_bagasi, kota.kota_name');
    $this->db->from('paket');
    $this->db->join('mobil', 'mobil.id = paket.mobil_id', 'LEFT');
    $this->db->join('kota', 'kota.id = paket.kota_id', 'LEFT');
    $this->db->where(['md5(kota_id)' => $kota_id, 'md5(mobil_id)' => $mobil_id, 'paket_type'  => 'Daily']);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function paket_hourly($mobil_id, $kota_id)
  {
    $this->db->select('*');
    $this->db->from('paket');
    $this->db->where(['mobil_id'  => $mobil_id, 'kota_id' => $kota_id, 'paket_type'  => 'Hourly']);
    $this->db->order_by('paket_name', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_paket_hourly($kota_id, $mobil_id)
  {
    $this->db->select('paket.*, mobil.mobil_name, mobil.mobil_gambar, mobil.mobil_penumpang, mobil.mobil_bagasi, kota.kota_name');
    $this->db->from('paket');
    $this->db->join('mobil', 'mobil.id = paket.mobil_id', 'LEFT');
    $this->db->join('kota', 'kota.id = paket.kota_id', 'LEFT');
    $this->db->where(['md5(kota_id)' => $kota_id, 'md5(mobil_id)' => $mobil_id, 'paket_type'  => 'Hourly']);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }

  public function search_city($kota_id)
  {
    $this->db->select('paket.*, mobil.mobil_name, mobil.mobil_gambar, mobil.mobil_penumpang, mobil.mobil_bagasi, kota.kota_name');
    $this->db->from('paket');
    // Joion
    $this->db->join('mobil', 'mobil.id = paket.mobil_id', 'LEFT');
    $this->db->join('kota', 'kota.id = paket.kota_id', 'LEFT');
    $this->db->where('md5(kota_id)', $kota_id);
    $this->db->order_by('paket.id', 'ASC');
    $this->db->group_by('paket.mobil_id');
    $query = $this->db->get();
    return $query->result();
  }

  //tambah / Insert Data
  public function create($data)
  {
    $this->db->insert('paket', $data);
  }

  //Edit Data
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('paket', $data);
  }

  //Delete Data
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('paket', $data);
  }
}
