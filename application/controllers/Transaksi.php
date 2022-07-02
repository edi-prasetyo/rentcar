<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    /**
     * Development By Edi Prasetyo
     * edikomputer@gmail.com
     * 0812 3333 5523
     * https://edikomputer.com
     * https://grahastudio.com
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi_model');
    }
    public function index()
    {
        if ($this->session->userdata('id')) {
            redirect(base_url('myaccount/transaksi'), 'refresh');
        } else {
            $this->form_validation->set_rules(
                'email',
                'Email',
                'required|trim|valid_email',
                [
                    'required'         => 'Email harus di isi',
                    'valid_email'     => 'Format email Tidak sesuai'
                ]
            );
            $this->form_validation->set_rules(
                'order_id',
                'ID Order',
                'required',
                [
                    'required'         => 'ID Order',
                ]
            );
            if ($this->form_validation->run() == false) {
                if (!$this->agent->is_mobile()) {
                    // Desktop View
                    $data = [
                        'title'       => 'Cek Pesanan',
                        'deskripsi'   => 'Cek Pesanan Rental Mobil',
                        'keywords'    => 'Transaksi',
                        'content'         => 'front/transaksi/index'
                    ];
                    $this->load->view('front/layout/wrapp', $data, FALSE);
                } else {
                    // Mobile View
                    $data = [
                        'title'       => 'Cek Pesanan',
                        'deskripsi'   => 'Cek Pesanan Rental Mobil',
                        'keywords'    => 'Transaksi',
                        'content'     => 'mobile/transaksi/index'
                    ];
                    $this->load->view('mobile/layout/wrapp', $data, FALSE);
                }
            } else {
                $this->detail();
            }
        }
    }
    public function detail()
    {
        $order_id                    = $this->input->post('order_id');
        $email                      = $this->input->post('email');
        $detail_transaksi                  = $this->transaksi_model->cek_transaksi($order_id, $email);



        $transaksi = $this->db->get_where('transaksi', ['order_id' => $order_id])->row_array();
        $transakai_email = $this->db->get_where('transaksi', ['passenger_email' => $email])->row_array();
        // var_dump($transaksi);
        // die;

        if (empty($transaksi)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Order ID Tidak ada</div> ');
            redirect('transaksi');
        } elseif (empty($transakai_email)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Email Tidak ada</div> ');
            redirect('transaksi');
        } else {

            if (!$this->agent->is_mobile()) {
                // Desktop View
                $data = array(
                    'title'                     => 'Transaksi',
                    'deskripsi'                 => 'Deskripsi',
                    'keywords'                  => 'Transaksi Angelita Rentcar',
                    'transaksi'                 => $transaksi,
                    'content'                   => 'front/transaksi/detail'
                );
                $this->load->view('front/layout/wrapp', $data, FALSE);
            } else {
                // Mobile View
                $data = array(
                    'title'                     => 'Transaksi',
                    'deskripsi'                 => 'Deskripsi',
                    'keywords'                  => 'Transaksi Angelita Rentcar',
                    'transaksi'                 => $transaksi,
                    'content'                   => 'mobile/transaksi/detail'
                );
                $this->load->view('mobile/layout/wrapp', $data, FALSE);
            }
        }
    }


    public function sukses($insert_id)
    {
        $transaksi = $this->transaksi_model->sukses_transaksi($insert_id);

        if (!$this->agent->is_mobile()) {
            // Desktop View
            $data = array(
                'title'                 => 'Konfirmasi transaksi',
                'deskripsi'             => 'Deskripsi',
                'keywords'              => 'Transaksi',
                'transaksi'             => $transaksi,
                'content'               => 'front/transaksi/sukses'
            );
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            // Mobile View
            $data = array(
                'title'                 => 'Konfirmasi transaksi',
                'deskripsi'             => 'Deskripsi',
                'keywords'              => 'Transaksi',
                'transaksi'             => $transaksi,
                'content'               => 'mobile/transaksi/sukses'
            );
            $this->load->view('mobile/layout/wrapp', $data, FALSE);
        }
    }
}
