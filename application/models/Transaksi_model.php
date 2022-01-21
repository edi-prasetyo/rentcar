<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
  //load database
  /*
  *MODEL COUNTER
  *MODEL DRIVER
  */
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_alltransaksi()
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_chart_transaksi()
  {
    $this->db->select('transaksi.*, COUNT(transaksi.id) AS total');
    $this->db->from('transaksi');
    $this->db->group_by('DATE(date_created)');
    $this->db->order_by('DATE(date_created)', 'DESC');
    $this->db->limit(7);
    $query = $this->db->get();
    return $query->result();
  }
  public function count_chart_transaksi()
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $query = $this->db->get();
    return $query->result();
  }
  public function new_transaksi()
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    // $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->order_by('id', 'DESC');
    $this->db->limit(3);
    $query = $this->db->get();
    return $query->result();
  }



  public function get_transaksi($limit, $start)
  {

    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    // End Join
    $this->db->order_by('transaksi.id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }

  public function detail_driver($driver_id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where('transaksi.driver_id', $driver_id);
    $query = $this->db->get();
    return $query->row();
  }
  //Total Row
  public function total_row()
  {

    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function get_mytransaksi($id, $limit, $start)
  {
    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->where('transaksi.user_id', $id);
    $this->db->order_by('transaksi.id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  //Total Row
  public function total_row_mytransaksi($id)
  {

    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->where('transaksi.user_id', $id);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  //Total Transaksi Unread
  public function transaksi_unread()
  {

    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where('transaksi.status_read', 0);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }


  public function detail($id)
  {
    $this->db->select('transaksi.*, product.product_name, user.name, user.user_address, user.user_phone');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->join('product', 'product.id = transaksi.product_id', 'LEFT');
    //End Join
    $this->db->where('transaksi.id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function transaksi_detail_driver($id)
  {
    $this->db->select('transaksi.*, product.product_name, user.name, user.user_address, user.user_phone');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.driver_id', 'LEFT');
    $this->db->join('product', 'product.id = transaksi.product_id', 'LEFT');
    //End Join
    $this->db->where('transaksi.id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function transaksi_detail_drivermyaccount($id)
  {
    $this->db->select('transaksi.*, product.product_name, user.name, user.user_address, user.user_phone');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.driver_id', 'LEFT');
    $this->db->join('product', 'product.id = transaksi.product_id', 'LEFT');
    //End Join
    $this->db->where('md5(transaksi.id)', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function transaksi_detail($id)
  {
    $this->db->select('transaksi.*, user.user_code, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->where('transaksi.id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function detail_transaksi_saya($user_id, $id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where('transaksi.user_id', $user_id);
    $this->db->where('md5(transaksi.id)', $id);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->row();
  }
  //Kirim Data Berita ke database
  public function create($data)
  {
    $this->db->insert('transaksi', $data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  public function create_log($data)
  {
    $this->db->insert('transaksi_log', $data);
  }
  public function last_transaksi($insert_id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where('id', $insert_id);
    $this->db->order_by('id');
    $query = $this->db->get();
    return $query->row();
  }

  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('transaksi', $data);
  }

  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('transaksi', $data);
  }

  public function transaksi($limit, $start)
  {
    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->where(['transaksi.transaksi_status'     =>  'Aktif']);
    $this->db->order_by('transaksi.id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }

  public function total()
  {
    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // PENJUMLAHAN
  //Total Transaksi Masuk
  public function get_total_omset_transaksi()
  {
    $this->db->select_sum('total_price');
    $this->db->where('status', 1);
    $query = $this->db->get('transaksi');
    if ($query->num_rows() > 0) {
      return $query->row()->total_price;
    } else {
      return 0;
    }
  }
  public function total_omset_transaksi_counter($user_id)
  {
    $this->db->select_sum('total_price');
    $this->db->where(['status' => 1, 'user_id' => $user_id]);
    $query = $this->db->get('transaksi');
    if ($query->num_rows() > 0) {
      return $query->row()->total_price;
    } else {
      return 0;
    }
  }

  // MODEL COUNTER
  public function get_transaksi_counter($user_id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where(['transaksi.user_id' => $user_id]);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function detail_counter($id, $user_id)
  {
    $this->db->select('transaksi.*, user.name, user.user_phone, product.product_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->join('product', 'product.id = transaksi.product_id', 'LEFT');
    //End Join
    $this->db->where(['transaksi.id' => $id, 'transaksi.user_id' => $user_id]);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_alltransaksi_counter($user_id, $limit, $start, $search_kota, $resi)
  {
    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->where('transaksi.user_id', $user_id);
    $this->db->order_by('transaksi.id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }

  public function get_riwayat_counter($limit, $start, $user_id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where(['transaksi.user_id' => $user_id]);
    $this->db->limit($limit, $start);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function get_allriwayat_counter($user_id)
  {
    $this->db->select('transaksi.*, COUNT(transaksi.id) AS total');
    $this->db->from('transaksi');
    $this->db->where(['transaksi.user_id' => $user_id]);
    $this->db->group_by('DATE(date_created)');
    $this->db->order_by('DATE(date_created)', 'DESC');
    $this->db->limit(12);
    $query = $this->db->get();
    return $query->result();
  }
  public function count_allriwayat_counter($user_id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where(['user_id' => $user_id]);
    $query = $this->db->get();
    return $query->result();
  }


  public function get_row_counter($user_id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where(['transaksi.user_id' => $user_id]);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // MODEL DRIVER

  public function transaksi_driver($user_id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where(['driver_id' => $user_id, 'stage' => 2]);
    // $this->db->limit(1);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function transaksi_driver_onroad($user_id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where(['driver_id' => $user_id, 'stage' => 3]);
    $this->db->limit(1);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_allriwayat_driver($user_id)
  {
    $this->db->select('transaksi.*, COUNT(transaksi.id) AS total');
    $this->db->from('transaksi');
    $this->db->where(['transaksi.user_id' => $user_id]);
    $this->db->group_by('DATE(date_created)');
    $this->db->order_by('DATE(date_created)', 'ASC');
    $this->db->limit(12);
    $query = $this->db->get();
    return $query->result();
  }
  public function count_allriwayat_driver($user_id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where(['transaksi.user_id' => $user_id]);
    $query = $this->db->get();
    return $query->result();
  }
  public function get_riwayat_driver($limit, $start, $user_id)
  {
    $this->db->select('transaksi.*,  user.user_address');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->where(['transaksi.driver_id' => $user_id]);
    $this->db->limit($limit, $start);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_transaksi_driver($user_id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where(['transaksi.user_id' => $user_id]);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_row_driver($user_id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where(['transaksi.driver_id' => $user_id]);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function save_batch($data)
  {
    return $this->db->insert_batch('transaksi_driver', $data);
  }
}
