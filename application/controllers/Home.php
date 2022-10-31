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
        $this->load->model('berita_model');
        $this->load->model('promo_model');
        $this->load->model('point_model');
    }


    public function index()
    {

        $featured = $this->galery_model->featured();
        
        $kota = $this->kota_model->get_allkota();
        // $my_point = $this->
        if (!$this->agent->is_mobile()) {
            // Desktop View
            $product            = $this->product_model->get_product();
            $data = [
                'title'         => 'Halaman Home',
                'kota'          => $kota,
                'product'       => $product,
                'featured'      => $featured,
               
                'content'       => 'front/home/index'
            ];
            $this->load->view('front/layout/wrapp', $data);
        } else {
            // Mobile View

            $user_id = $this->session->userdata('id');
            $total_pointku = $this->point_model->total_user_point($user_id);
            // var_dump($total_pointku);
            // die;
            $mobile_slider      = $this->galery_model->featured();
            $product            = $this->product_model->get_product();
            $berita_home     = $this->berita_model->berita_home();
            $promo_home         = $this->promo_model->promo_home();

            $data = [
                'title'             => 'Halaman Home',
                'kota'              => $kota,
                'mobile_slider'     => $mobile_slider,
                'berita_home'       => $berita_home,
                'promo_home'        => $promo_home,
                'product'           => $product,
                'total_pointku'   => $total_pointku,
                'content'           => 'mobile/home/index'
            ];
            $this->load->view('mobile/layout/wrapp', $data);
        }
    }
}
