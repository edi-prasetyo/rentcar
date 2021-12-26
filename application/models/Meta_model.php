<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meta_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_meta()
  {
    $query = $this->db->get('meta');
    return $query->row();
  }
  public function detail_meta($id)
  {
    $this->db->select('*');
    $this->db->from('meta');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('meta', $data);
  }
}
