<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('pengaturan_model');
        $this->load->model('user_model');
        $this->load->model('kota_model');
        $this->load->model('galery_model');
        $this->load->model('product_model');
    }
    // public function index()
    // {
    //     $kota = $this->kota_model->get_allkota();
    //     $product = $this->product_model->get_product();

    //     $data = [
    //         'title'         => 'Halaman Home',
    //         'kota'          => $kota,
    //         'product'       => $product,
    //         'content'       => 'front/home/index'
    //     ];
    //     $this->load->view('front/layout/wrapp', $data);
    // }



    // Mobile View

    public function index()
    {
        $kota = $this->kota_model->get_allkota();
        if (!$this->agent->is_mobile()) {
            // Desktop View
            $product            = $this->product_model->get_product();
            $data = [
                'title'         => 'Halaman Home',
                'kota'          => $kota,
                'product'           => $product,
                'content'       => 'front/home/index'
            ];
            $this->load->view('front/layout/wrapp', $data);
        } else {
            // Mobile View

            $mobile_slider      = $this->galery_model->featured();
            $product            = $this->product_model->get_product();

            $data = [
                'title'             => 'Halaman Home',
                'kota'              => $kota,
                'mobile_slider'     => $mobile_slider,
                'product'           => $product,
                'content'           => 'mobile/home/index'
            ];
            $this->load->view('mobile/layout/wrapp', $data);
        }
    }
}
