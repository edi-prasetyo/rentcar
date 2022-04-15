<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dropoff_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  //listing Paket
  public function get_paket()
  {
    $this->db->select('*');
    $this->db->from('paket_dropoff');
    $this->db->order_by('paket_name', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function detail($paket_id)
  {
    $this->db->select('paket_dropoff.*, ketentuan.ketentuan_desc');
    $this->db->from('paket_dropoff');
    $this->db->join('ketentuan', 'ketentuan.id = paket.ketentuan_id', 'LEFT');
    $this->db->where('paket_dropoff.id', $paket_id);
    $query = $this->db->get();
    return $query->row();
  }

  //Detail paket
  public function detail_paket($id)
  {
    $this->db->select('*');
    $this->db->from('paket_dropoff');
    $this->db->where('id', $id);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->row();
  }

  //Detail paket
  public function dropoff_detail($kota_asal, $kota_tujuan)
  {
    $this->db->select('paket_dropoff.*, ketentuan.ketentuan_desc');
    $this->db->from('paket_dropoff');
    // Join
    $this->db->join('ketentuan', 'ketentuan.id = paket_dropoff.ketentuan_id', 'LEFT');
    // End Join
    $this->db->where(['md5(kota_asal)' => $kota_asal, 'md5(kota_tujuan)' => $kota_tujuan]);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->row();
  }

  public function listpaket($mobil_id)
  {
    $this->db->select('*');
    $this->db->from('paket_dropoff');
    $this->db->where('mobil_id', $mobil_id);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }

  public function paket_dropoff($mobil_id)
  {
    $this->db->select('paket_dropoff.*, mobil.mobil_name, kota.kota_name');
    $this->db->from('paket_dropoff');
    // Join
    $this->db->join('mobil', 'mobil.id = paket_dropoff.mobil_id', 'LEFT');
    $this->db->join('kota', 'kota.id = paket_dropoff.kota_tujuan', 'LEFT');
    // End Join
    $this->db->where('mobil_id', $mobil_id);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function dropoff_mobil($mobil_id, $kota_id)
  {
    $this->db->select('paket_dropoff.*, mobil.mobil_name, kota.kota_name');
    $this->db->from('paket_dropoff');
    // Join
    $this->db->join('mobil', 'mobil.id = paket_dropoff.mobil_id', 'LEFT');
    $this->db->join('kota', 'kota.id = paket_dropoff.kota_tujuan', 'LEFT');
    // End Join
    $this->db->where(['mobil_id' => $mobil_id, 'kota_asal' => $kota_id]);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_paket_daily($kota_id, $mobil_id)
  {
    $this->db->select('paket_dropoff.*, mobil.mobil_name, mobil.mobil_gambar, mobil.mobil_penumpang, mobil.mobil_bagasi, kota.kota_name');
    $this->db->from('paket_dropoff');
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
    $this->db->from('paket_dropoff');
    $this->db->where(['mobil_id'  => $mobil_id, 'kota_id' => $kota_id, 'paket_type'  => 'Hourly']);
    $this->db->order_by('paket_name', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_paket_hourly($kota_id, $mobil_id)
  {
    $this->db->select('paket_dropoff.*, mobil.mobil_name, mobil.mobil_gambar, mobil.mobil_penumpang, mobil.mobil_bagasi, kota.kota_name');
    $this->db->from('paket_dropoff');
    $this->db->join('mobil', 'mobil.id = paket.mobil_id', 'LEFT');
    $this->db->join('kota', 'kota.id = paket.kota_id', 'LEFT');
    $this->db->where(['md5(kota_id)' => $kota_id, 'md5(mobil_id)' => $mobil_id, 'paket_type'  => 'Hourly']);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }

  public function search_city($kota_asal, $kota_tujuan)
  {
    $this->db->select('paket_dropoff.*, mobil.mobil_name, mobil.mobil_gambar, mobil.mobil_penumpang, mobil.mobil_bagasi, kota.kota_name');
    $this->db->from('paket_dropoff');
    // Joion
    $this->db->join('mobil', 'mobil.id = paket_dropoff.mobil_id', 'LEFT');
    $this->db->join('kota', 'kota.id = paket_dropoff.kota_asal', 'LEFT');
    $this->db->where('md5(kota_asal)', $kota_asal);
    $this->db->where('md5(kota_tujuan)', $kota_tujuan);
    $this->db->order_by('paket_dropoff.id', 'ASC');
    $this->db->group_by('paket_dropoff.mobil_id');
    $query = $this->db->get();
    return $query->result();
  }

  //tambah / Insert Data
  public function create($data)
  {
    $this->db->insert('paket_dropoff', $data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }

  //Edit Data
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('paket_dropoff', $data);
  }

  //Delete Data
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('paket_dropoff', $data);
  }
}
