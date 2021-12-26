<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  //Load Model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('meta_model');
  }
  //main page - Berita
  public function index()
  {
    $driver_id = $this->session->userdata('id');
    $transaksi_driver               = $this->transaksi_model->transaksi_driver($driver_id);
    $transaksi_driver_onroad               = $this->transaksi_model->transaksi_driver_onroad($driver_id);
    $alltransaksi_driver         = $this->transaksi_model->get_allriwayat_driver($driver_id);
    $count_alltransaksi_driver   = $this->transaksi_model->count_allriwayat_driver($driver_id);

    // End Listing Berita dengan paginasi
    $data = array(
      'title'                     => 'Dashboard',
      'deskripsi'                 => 'Halaman Dashboard',
      'keywords'                  => '',
      'alltransaksi_driver'       => $alltransaksi_driver,
      'count_alltransaksi_driver' => $count_alltransaksi_driver,
      'transaksi_driver'          => $transaksi_driver,
      'transaksi_driver_onroad'   => $transaksi_driver_onroad,
      'content'                   => 'driver/dashboard/dashboard'
    );
    $this->load->view('driver/layout/wrapp', $data, FALSE);
  }
}

/* End of file About.php */
/* Location: ./application/controllers/About.php */
