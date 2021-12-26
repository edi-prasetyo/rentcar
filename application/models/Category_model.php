<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_category()
  {
    $this->db->select('*');
    $this->db->from('category');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function detail_category($id)
  {
    $this->db->select('*');
    $this->db->from('category');
    $this->db->where('id', $id);
    $this->db->order_by('id');
    $query = $this->db->get();
    return $query->row();
  }
  //Read Berita
  public function read($category_slug)
  {
    $this->db->select('*');
    $this->db->from('category');
    $this->db->where(array(
      'category.category_slug'      =>  $category_slug
    ));
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->row();
  }
  public function create($data)
  {
    $this->db->insert('category', $data);
  }
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('category', $data);
  }
  //Delete Data
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('category', $data);
  }
}
