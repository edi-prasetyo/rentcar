<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hourly_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_hourly()
  {
    $this->db->select('*');
    $this->db->from('hourly');
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function car_hourly()
  {
    $this->db->select('*');
    $this->db->from('hourly');
    $this->db->where('id', 1);
    $query = $this->db->get();
    return $query->row();
  }
  //Total Berita Main Page
  public function total_row()
  {
    $this->db->select('*');
    $this->db->from('hourly');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function hourly_detail($id)
  {
    $this->db->select('*');
    $this->db->from('hourly');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function detail($paket_id)
  {
    $this->db->select('*');
    $this->db->from('hourly');
    $this->db->where('id', $paket_id);
    $query = $this->db->get();
    return $query->row();
  }
  public function create($data)
  {
    $this->db->insert('hourly', $data);
  }
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('hourly', $data);
  }
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('hourly', $data);
  }
  public function listpaket($mobil_id)
  {
    $this->db->select('*');
    $this->db->from('hourly');
    $this->db->where('mobil_id', $mobil_id);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function paket_hourly($mobil_id, $kota_id)
  {
    $this->db->select('*');
    $this->db->from('hourly');
    $this->db->where(['mobil_id' => $mobil_id, 'kota_id' => $kota_id]);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }

  // FONT END
  public function search_city($kota_id)
  {
    $this->db->select('hourly.*, mobil.mobil_name, mobil.mobil_gambar, mobil.mobil_penumpang, mobil.mobil_bagasi, kota.kota_name');
    $this->db->from('hourly');
    // Joion
    $this->db->join('mobil', 'mobil.id = hourly.mobil_id', 'LEFT');
    $this->db->join('kota', 'kota.id = hourly.kota_id', 'LEFT');
    $this->db->where('md5(kota_id)', $kota_id);
    $this->db->order_by('hourly.id', 'ASC');
    $this->db->group_by('hourly.mobil_id');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_paket($kota_id, $mobil_id)
  {
    $this->db->select('hourly.*, mobil.mobil_name, mobil.mobil_gambar, mobil.mobil_penumpang, mobil.mobil_bagasi, kota.kota_name');
    $this->db->from('hourly');
    $this->db->join('mobil', 'mobil.id = hourly.mobil_id', 'LEFT');
    $this->db->join('kota', 'kota.id = hourly.kota_id', 'LEFT');
    $this->db->where(['md5(kota_id)' => $kota_id, 'md5(mobil_id)' => $mobil_id]);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
}
