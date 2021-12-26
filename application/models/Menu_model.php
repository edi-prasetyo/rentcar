<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_menu()
  {
    $this->db->select('*');
    $this->db->from('menu');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function detail_menu($id)
  {
    $this->db->select('*');
    $this->db->from('menu');
    $this->db->where('id', $id);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->row();
  }
  //Insert Data
  public function create($data)
  {
    $this->db->insert('menu', $data);
  }
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('menu', $data);
  }
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('menu', $data);
  }
}
