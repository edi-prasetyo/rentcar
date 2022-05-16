<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  //List Semua Promo dengan Limit Pagination
  public function get_promo($limit, $start)
  {
    $this->db->select('*');
    $this->db->from('promo');
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  public function promo_home()
  {
    $this->db->select('*');
    $this->db->from('promo');
    $this->db->limit(2);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function promo_sidebar()
  {
    $this->db->select('*');
    $this->db->from('promo');
    $this->db->limit(1);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  //Total Promo Main Page
  public function total_row()
  {
    $this->db->select('*');
    $this->db->from('promo');
    $this->db->where(['is_active'     =>  1]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  //Total Detail promo
  public function promo_detail($id)
  {
    $this->db->select('*');
    $this->db->from('promo');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  // Insert data promo ke database
  public function create($data)
  {
    $this->db->insert('promo', $data);
  }
  //Update Data promo ke database
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('promo', $data);
  }
  //Hapus Data Dari Database
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('promo', $data);
  }
  // Data Promo yang di tampilkan di Front End
  //listing Promo Main Page
  public function promo($limit, $start)
  {
    $this->db->select('*');
    $this->db->from('promo');
    $this->db->where(['is_active'     =>  1]);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  //Total Promo Main Page
  public function total()
  {
    $this->db->select('*');
    $this->db->from('promo');
    $this->db->where(['is_active'     =>  1]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  //Read Promo
  public function read($promo_slug)
  {
    $this->db->select('*');
    $this->db->from('promo');
    $this->db->where(['is_active'     =>  1]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->row();
  }
}
