<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_meta()
  {
    $query = $this->db->get('pengaturan_email');
    return $query->row();
  }

  public function email_register()
  {
    $this->db->select('*');
    $this->db->from('pengaturan_email');
    $this->db->where('id', 1);
    $query = $this->db->get();
    return $query->row();
  }
  public function email_order()
  {
    $this->db->select('*');
    $this->db->from('pengaturan_email');
    $this->db->where('id', 2);
    $query = $this->db->get();
    return $query->row();
  }
  public function detail_pengaturan($id)
  {
    $this->db->select('*');
    $this->db->from('pengaturan_email');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('pengaturan_email', $data);
  }
  public function get_payment()
  {
    $this->db->select('*');
    $this->db->from('payment_method');
    $query = $this->db->get();
    return $query->result();
  }
  public function show_payment()
  {
    $this->db->select('*');
    $this->db->from('payment_method');
    $this->db->where('is_active', true);
    $query = $this->db->get();
    return $query->result();
  }
  public function update_payment($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('payment_method', $data);
  }
}
