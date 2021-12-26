<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daily_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_daily()
  {
    $this->db->select('*');
    $this->db->from('daily');
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function car_daily()
  {
    $this->db->select('*');
    $this->db->from('daily');
    $this->db->where('id', 1);
    $query = $this->db->get();
    return $query->row();
  }
  //Total Berita Main Page
  public function total_row()
  {
    $this->db->select('*');
    $this->db->from('daily');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function daily_detail($id)
  {
    $this->db->select('*');
    $this->db->from('daily');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function detail($paket_id)
  {
    $this->db->select('*');
    $this->db->from('daily');
    $this->db->where('id', $paket_id);
    $query = $this->db->get();
    return $query->row();
  }
  public function create($data)
  {
    $this->db->insert('daily', $data);
  }
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('daily', $data);
  }
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('daily', $data);
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
    $this->db->from('daily');
    $this->db->where(['mobil_id' => $mobil_id, 'kota_id' => $kota_id]);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  // FONT END
  public function search_city($kota_id)
  {
    $this->db->select('daily.*, mobil.mobil_name, mobil.mobil_gambar, mobil.mobil_penumpang, mobil.mobil_bagasi, kota.kota_name');
    $this->db->from('daily');
    // Joion
    $this->db->join('mobil', 'mobil.id = daily.mobil_id', 'LEFT');
    $this->db->join('kota', 'kota.id = daily.kota_id', 'LEFT');
    $this->db->where('md5(kota_id)', $kota_id);
    $this->db->order_by('daily.id', 'ASC');
    $this->db->group_by('daily.mobil_id');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_paket($kota_id, $mobil_id)
  {
    $this->db->select('daily.*, mobil.mobil_name, mobil.mobil_gambar, mobil.mobil_penumpang, mobil.mobil_bagasi, kota.kota_name');
    $this->db->from('daily');
    $this->db->join('mobil', 'mobil.id = daily.mobil_id', 'LEFT');
    $this->db->join('kota', 'kota.id = daily.kota_id', 'LEFT');
    $this->db->where(['md5(kota_id)' => $kota_id, 'md5(mobil_id)' => $mobil_id]);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
}
