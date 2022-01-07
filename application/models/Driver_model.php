<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  // Model for Admin
  public function get_all()
  {
    $this->db->select('*');
    $this->db->from('driver');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }


  // Counter Aktif
  public function get_alldriver_active()
  {
    $this->db->select('*');
    $this->db->from('driver');
    $this->db->where(['is_active' => 1, 'is_locked' => 1]);
    $this->db->order_by('driver.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_alldriver($limit, $start, $search, $search_email, $search_kota)
  {
    $this->db->select('*');
    $this->db->from('driver');
    $this->db->like('driver_name', $search);
    $this->db->like('email', $search_email);
    $this->db->like('kota_id', $search_kota);
    $this->db->limit($limit, $start);
    $this->db->order_by('driver.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function total_row_driver($search)
  {
    $this->db->select('*');
    $this->db->from('driver');
    $this->db->like('driver_name', $search);
    $this->db->order_by('driver.id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }

  public function driver_detail($driver_id)
  {
    $this->db->select('*');
    $this->db->from('driver');
    $this->db->where(
      ['driver.id'    => $driver_id]
    );
    $query = $this->db->get();
    return $query->row();
  }
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('driver', $data);
  }
  // Product User Read
  public function detail($id)
  {
    $this->db->select('*');
    $this->db->from('driver');
    $this->db->where('driver.id', $id);
    $query = $this->db->get();
    return $query->row();
  }
}
