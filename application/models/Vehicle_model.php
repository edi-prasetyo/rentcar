<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vehicle_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_vehicle()
  {
    $this->db->select('*');
    $this->db->from('vehicle');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function detail_vehicle($id)
  {
    $this->db->select('*');
    $this->db->from('vehicle');
    $this->db->where('id', $id);
    $this->db->order_by('id');
    $query = $this->db->get();
    return $query->row();
  }
  //Read Berita
  public function read($vehicle_slug)
  {
    $this->db->select('*');
    $this->db->from('vehicle');
    $this->db->where(array(
      'vehicle.vehicle_slug'      =>  $vehicle_slug
    ));
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->row();
  }
  public function create($data)
  {
    $this->db->insert('vehicle', $data);
  }
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('vehicle', $data);
  }
  //Delete Data
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('vehicle', $data);
  }
}
