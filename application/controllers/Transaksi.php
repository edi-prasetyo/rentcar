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
        $this->load->model('bank_model');
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
                'kode_transaksi',
                'Kode Transaksi',
                'required',
                [
                    'required'         => 'Kode Transaksi',
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
                        'content'         => 'mobile/transaksi/index'
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
        $kode_transaksi             = $this->input->post('kode_transaksi');
        $email                      = $this->input->post('email');
        $transaksi           = $this->transaksi_model->cek_transaksi($kode_transaksi, $email);
        $bank                       = $this->bank_model->get_allbank();

        $detail_transaksi = $this->db->get_where('transaksi', ['kode_transaksi' => $kode_transaksi])->row_array();
        $transakai_email = $this->db->get_where('transaksi', ['passenger_email' => $email])->row_array();
        if (empty($detail_transaksi)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Kode Transaksi Tidak ada</div> ');
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
                    'transaksi'          => $transaksi,
                    'bank'                      => $bank,
                    'content'                   => 'front/transaksi/detail'
                );
                $this->load->view('front/layout/wrapp', $data, FALSE);
            } else {
                // Mobile View
                $data = array(
                    'title'                     => 'Transaksi',
                    'deskripsi'                 => 'Deskripsi',
                    'keywords'                  => 'Transaksi Angelita Rentcar',
                    'transaksi'          => $transaksi,
                    'bank'                      => $bank,
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
