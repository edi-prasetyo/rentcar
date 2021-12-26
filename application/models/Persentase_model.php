<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Persentase_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_persentase()
  {
    $query = $this->db->get('persentase');
    return $query->row();
  }
  public function detail_persentase($id)
  {
    $this->db->select('*');
    $this->db->from('persentase');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('persentase', $data);
  }
}
