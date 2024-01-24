<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  // Model for Admin
  public function get_all()
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_admin()
  {
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where('role_id', 1);
    $this->db->or_where('role_id', 2);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }



  // Kurir
  public function get_driver()
  {
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where('role_id', 5);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_allkurir($limit, $start, $search)
  {
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    // $this->db->like('name', $search);
    $this->db->where('role_id', 5);
    $this->db->limit($limit, $start);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function total_row_allkurir($search)
  {
    $this->db->select('*');
    $this->db->from('user');
    // $this->db->like('name', $search);
    $this->db->where('role_id', 5);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  // Counter
  public function get_allcounter()
  {
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where('role_id', 5);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  // Counter Aktif
  public function get_alldriver_active()
  {
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where(['role_id' => 5, 'is_active' => 1, 'is_locked' => 1]);
    $this->db->order_by('user.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_counter($limit, $start, $search, $search_email, $search_kota)
  {
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where('role_id', 4);
    // $this->db->like('name', $search);
    // $this->db->like('email', $search_email);
    $this->db->limit($limit, $start);
    $this->db->order_by('user.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_customer($limit, $start, $search, $search_email, $search_kota)
  {
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');

    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // $this->db->join('point', 'user.id = point.user_id');

    $this->db->where('role_id', 6);
    $this->db->limit($limit, $start);
    $this->db->order_by('user.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function get_customer_point($limit, $start, $search, $search_email, $search_kota)
  {
    $this->db->select('user.*, user.name, user.id,
    user_role.role,
    sum(point.nominal_point) as nominal_point');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('point', 'user.id = point.user_id');
    // $this->db->group_by('user.id');
    // End Join
    $this->db->where([
      'role_id' => 6,
      'point_status'  => 1,
      'expired >='    => date('Y-m-d')

    ]);
    // $this->db->like('name', $search);
    // $this->db->like('email', $search_email);
    $this->db->limit($limit, $start);
    $this->db->group_by('user.id');
    $this->db->order_by('user.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  // public function get_customer_point()
  // {
  //   $this->db->select('*');
  //   $this->db->from('point');
  //   $this->db->where('user_id', $user_id);
  //   $this->db->order_by('id', 'DESC');
  //   $query = $this->db->get();
  //   return $query->result();
  // }
  public function total_row_counter($search, $search_email, $search_kota)
  {
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where('user.role_id', 5);
    // $this->db->like('name', $search);
    // $this->db->like('email', $search_email);
    $this->db->order_by('user.id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function total_row_customer($search, $search_email, $search_kota)
  {
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where('user.role_id', 6);
    // $this->db->like('name', $search);
    // $this->db->like('email', $search_email);
    $this->db->order_by('user.id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_kurir($user_id, $kota_id)
  {
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where(['id_agen' => $user_id, 'role_id' => 7, 'kota_id' => $kota_id]);
    $this->db->or_where('role_id', 6);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function user_detail($user_id)
  {
    $this->db->select('user.*, user.name, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where(
      ['user.id'    => $user_id]
    );
    $query = $this->db->get();
    return $query->row();
  }
  public function create($data)
  {
    $this->db->insert('user', $data);
  }
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('user', $data);
  }
  public function request_password($data)
  {
    $this->db->where('user_phone', $data['user_phone']);
    $this->db->update('user', $data);
  }
  // Product User Read
  public function detail($id)
  {
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where('user.id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function detail_driver($driver_id)
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('user.id', $driver_id);
    $query = $this->db->get();
    return $query->row();
  }
  public function detail_counter($counter_id)
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('user.id', $counter_id);
    $query = $this->db->get();
    return $query->row();
  }
  public function detail_customer($customer_id)
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('user.id', $customer_id);
    $query = $this->db->get();
    return $query->row();
  }
  public function pilih_driver()
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where([
      'role_id'     => 5,
      'is_active'   => 1,
      'is_locked'   => 1,
      // 'kota_id'     => $kota_id,
      // 'daily'       => 1,
      // 'dropoff'     => 1,
      // 'airport'     => 1,
    ]);
    $this->db->order_by('user.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
}
