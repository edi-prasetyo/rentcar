<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mobil_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  //listing Mobil
  public function get_all()
  {
    $this->db->select('mobil.*, user.name');
    $this->db->from('mobil');
    // Join
    $this->db->join('user', 'user.id = mobil.user_id', 'LEFT');
    //End Join

    $this->db->order_by('mobil.mobil_harga', 'ASC');

    $query = $this->db->get();
    return $query->result();
  }
  //listing Mobil
  public function get_mobil()
  {
    $this->db->select('mobil.*, user.name');
    $this->db->from('mobil');
    // Join
    $this->db->join('user', 'user.id = mobil.user_id', 'LEFT');
    //End Join
    $this->db->where(['mobil_status' => 'Aktif']);
    $this->db->order_by('mobil.mobil_harga', 'ASC');

    $query = $this->db->get();
    return $query->result();
  }
  //Mobil Populer
  public function mobil_populer()
  {
    $this->db->select('mobil.*, user.name');
    $this->db->from('mobil');
    // Join
    $this->db->join('user', 'user.id = mobil.user_id', 'LEFT');
    //End Join
    $this->db->where(['mobil_status' => 'Aktif']);
    $this->db->order_by('mobil.id', 'DESC');
    $this->db->limit(4);
    $query = $this->db->get();
    return $query->result();
  }


  //listing Mobil Home
  public function home()
  {
    $this->db->select('mobil.*, user.name');
    $this->db->from('mobil');
    $this->db->join('user', 'user.id = mobil.user_id', 'LEFT');
    //End Join
    $this->db->where(array('mobil_status'     =>  'Aktif'));
    $this->db->order_by('mobil_harga', 'ASC');
    $this->db->limit(3);
    $query = $this->db->get();
    return $query->result();
  }

  //listing Mobil Sidebar
  public function sidebar()
  {
    $this->db->select('mobil.*, user.name');
    $this->db->from('mobil');
    // Join
    $this->db->join('user', 'user.id = mobil.user_id', 'LEFT');
    //End Join
    $this->db->where(array('mobil_status'     =>  'Aktif'));
    $this->db->order_by('mobil_harga', 'ASC');
    $this->db->limit(12);
    $query = $this->db->get();
    return $query->result();
  }

  //listing Mobil Main Page
  public function mobil($limit, $start)
  {
    $this->db->select('mobil.*, user.name');
    $this->db->from('mobil');
    // Join
    $this->db->join('user', 'user.id = mobil.user_id', 'LEFT');
    //End Join
    $this->db->where(array('mobil_status'     =>  'Aktif'));
    $this->db->order_by('mobil_harga', 'ASC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }

  //Total Mobil Main Page
  public function total()
  {
    $this->db->select('mobil.*, user.name');
    $this->db->from('mobil');
    // Join
    $this->db->join('user', 'user.id = mobil.user_id', 'LEFT');
    //End Join
    $this->db->where(array('mobil_status'     =>  'Aktif'));
    $this->db->order_by('mobil.is', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }



  //Read Mobil
  public function read($mobil_slug)
  {
    $this->db->select('mobil.*, user.name');
    $this->db->from('mobil');
    // Join
    $this->db->join('user', 'user.id = mobil.user_id', 'LEFT');
    //End Join
    $this->db->where(array(
      'mobil_status'           =>  'Aktif',
      'mobil.mobil_slug'        =>  $mobil_slug
    ));
    $query = $this->db->get();
    return $query->row();
  }


  //Detail Mobil
  public function detail_mobil($mobil_id)
  {
    $this->db->select('*');
    $this->db->from('mobil');
    $this->db->where('mobil.id', $mobil_id);
    $this->db->order_by('mobil.id', 'DESC');
    $query = $this->db->get();
    return $query->row();
  }
  //Detail Mobil
  public function detail_encrypt($mobil_id)
  {
    $this->db->select('*');
    $this->db->from('mobil');
    $this->db->where('md5(id)', $mobil_id);
    $this->db->order_by('mobil.id', 'DESC');
    $query = $this->db->get();
    return $query->row();
  }
  //tambah / Insert Data
  public function create($data)
  {
    $this->db->insert('mobil', $data);
  }

  //Edit Data
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('mobil', $data);
  }

  //Delete Data
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('mobil', $data);
  }
}
