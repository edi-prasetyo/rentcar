<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('string');
        $this->load->model('meta_model');
        $this->load->model('main_model');
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('persentase_model');
        $this->load->model('user_model');
        $this->load->model('saldo_model');
        $this->load->model('point_model');
    }
    //Index
    public function index()
    {
        $user_id = $this->session->userdata('id');
        // var_dump($user_id);
        // die;
        $transaksi  = $this->transaksi_model->get_transaksi_driver($user_id);
        // End Listing Berita dengan paginasi
        $data = array(
            'title'         => 'Dashboard',
            'deskripsi'     => 'Halaman Dashboard',
            'keywords'      => '',
            'transaksi'     => $transaksi,
            'content'       => 'driver/transaksi/index'
        );
        $this->load->view('driver/layout/wrapp', $data, FALSE);
    }

    public function terima($id)
    {
        $transaksi = $this->transaksi_model->detail($id);
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);
        $driver_name = $user->name;

        is_login();
        $data = [
            'id'                => $id,
            'driver_name'       => $driver_name,
            'stage'             => 3,
        ];
        $this->transaksi_model->update($data);
        $this->dalam_perjalanan($id);
        $this->potong_saldo_driver($transaksi);
        $this->session->set_flashdata('message', 'Order di terima');
        redirect($_SERVER['HTTP_REFERER']);
    }

    // Potong Saldo Driver
    public function potong_saldo_driver($transaksi)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);

        $persentase = $this->persentase_model->get_persentase();
        $pemotongan = $persentase->potong_saldo;

        $potong_saldo = ($pemotongan / 100) * $transaksi->total_price;
        $saldo_driver = $user->saldo_driver - $potong_saldo;

        $data = [
            'id'                => $user_id,
            'saldo_driver'      => $saldo_driver,
        ];
        $this->user_model->update($data);
        $this->create_saldo_driver($user_id, $potong_saldo, $transaksi, $saldo_driver);
    }
    // Create Riwayat Saldo Driver
    public function create_saldo_driver($user_id, $potong_saldo, $transaksi, $saldo_driver)
    {
        $data = [
            'user_id'       => $user_id,
            'pemasukan'     => 0,
            'pengeluaran'   => $potong_saldo,
            'transaksi'     => $transaksi->total_price,
            'keterangan'    => $transaksi->order_id,
            'total_saldo'   => $saldo_driver,
            'user_type'     => $user_id,
            'date_created'                      => date('Y-m-d H:i:s')
        ];
        $this->saldo_model->create($data);
    }

    public function dalam_perjalanan($id)
    {
        is_login();
        $data = [
            'id'                => $id,
            'status'             => 'Dalam Pengantaran',
        ];
        $this->transaksi_model->update($data);
    }
    public function tolak($id)
    {
        is_login();
        $user_id = $this->session->userdata('id');
        $driver_detail = $this->user_model->user_detail($user_id);
        $driver_name = $driver_detail->name;
        $data = [
            'id'                => $id,
            'driver_name'       => $driver_name,
            'stage'             => 5,
        ];
        $this->transaksi_model->update($data);
        $this->update_status_driver($user_id);
        $this->order_ditolak($id);
        $this->session->set_flashdata('message', 'Anda telah menolak Order');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function order_ditolak($id)
    {
        is_login();
        $data = [
            'id'                => $id,
            'status'             => 'Ditolak Pengemudi',
        ];
        $this->transaksi_model->update($data);
    }

    // Sampai Ke tujuan
    public function finish($id)
    {

        $user_id = $this->session->userdata('id');
        is_login();
        $data = [
            'id'                => $id,
            'stage'             => 4,
        ];
        $this->transaksi_model->update($data);
        $this->selesai_order($id);
        $this->update_status_driver($user_id);
        $this->add_point_customer($id);
        $this->session->set_flashdata('message', 'Anda telah Menyelesaikan Order');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function add_point_customer($id)
    {
        $date           = date("Y-m-d");
        $transaksi = $this->transaksi_model->transaksi_detail($id);
        $data = [
            'user_id'       => $transaksi->user_id,
            'product_id'    => $transaksi->product_id,
            'order_id'      => $transaksi->order_id,
            'nominal_point' => $transaksi->order_point,
            'point_status'  => 1,
            'expired'       => date("Y-m-d", strtotime("$date +3 month"))
        ];
        $this->point_model->create($data);
    }
    public function selesai_order($id)
    {
        is_login();
        $data = [
            'id'                => $id,
            'status'             => 'Selesai',
        ];
        $this->transaksi_model->update($data);
    }

    public function update_status_driver($user_id)
    {
        $data = [
            'id'                => $user_id,
            'status'             => 0,
        ];
        $this->user_model->update($data);
    }
    public function riwayat()
    {
        $user_id = $this->session->userdata('id');

        $config['base_url']         = base_url('driver/transaksi/riwayat/index/');
        $config['total_rows']       = count($this->transaksi_model->get_row_driver($user_id));
        $config['per_page']         = 5;
        $config['uri_segment']      = 5;

        //Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        //Limit dan Start
        $limit                      = $config['per_page'];
        $start                      = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);
        $transaksi = $this->transaksi_model->get_riwayat_driver($limit, $start, $user_id);
        $data = [
            'title'                 => 'Data Transaksi',
            'transaksi'             => $transaksi,
            'search'                => '',
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'driver/transaksi/riwayat'
        ];
        $this->load->view('driver/layout/wrapp', $data, FALSE);
    }
    public function detail($id)
    {
        $transaksi = $this->transaksi_model->detail($id);
        $data = [
            'title'                 => 'Data Transaksi',
            'transaksi'             => $transaksi,
            'content'               => 'driver/transaksi/detail'
        ];
        $this->load->view('driver/layout/wrapp', $data, FALSE);
    }
}
