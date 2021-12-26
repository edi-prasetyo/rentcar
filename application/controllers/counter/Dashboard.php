<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('meta_model');
    $this->load->model('transaksi_model');
  }
  public function index()
  {
    $user_id = $this->session->userdata('id');
    $alltransaksi_counter           = $this->transaksi_model->get_allriwayat_counter($user_id);
    $count_alltransaksi_counter     = $this->transaksi_model->count_allriwayat_counter($user_id);

    $data = array(
      'title'                       => 'Dashboard',
      'deskripsi'                   => 'Halaman Dashboard',
      'keywords'                    => '',
      'alltransaksi_counter'        => $alltransaksi_counter,
      'count_alltransaksi_counter'  => $count_alltransaksi_counter,
      'content'                     => 'counter/dashboard/dashboard'
    );
    $this->load->view('counter/layout/wrapp', $data, FALSE);
  }
}
