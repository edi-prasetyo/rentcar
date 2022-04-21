<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_product()
  {
    $this->db->select('*');
    $this->db->from('product');
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function car_product()
  {
    $this->db->select('*');
    $this->db->from('product');
    $this->db->where('id', 1);
    $query = $this->db->get();
    return $query->row();
  }
  //Total Berita Main Page
  public function total_row()
  {
    $this->db->select('*');
    $this->db->from('product');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function product_detail($id)
  {
    $this->db->select('*');
    $this->db->from('product');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function create($data)
  {
    $this->db->insert('product', $data);
  }
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('product', $data);
  }
  //Hapus Data Dari Database
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('product', $data);
  }
}
