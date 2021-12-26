<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilaitopup_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_nilai_topup()
  {
    $this->db->select('*');
    $this->db->from('nilai_topup');
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function detail_nilai_topup($id)
  {
    $this->db->select('*');
    $this->db->from('nilai_topup');
    $this->db->where('id', $id);
    $this->db->order_by('id');
    $query = $this->db->get();
    return $query->row();
  }
  //Read Berita
  public function read($nilai_topup_slug)
  {
    $this->db->select('*');
    $this->db->from('nilai_topup');
    $this->db->where(array(
      'nilai_topup.nilai_topup_slug'      =>  $nilai_topup_slug
    ));
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->row();
  }
  public function create($data)
  {
    $this->db->insert('nilai_topup', $data);
  }
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('nilai_topup', $data);
  }
  //Delete Data
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('nilai_topup', $data);
  }
}
