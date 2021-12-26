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
    }
    public function index()
    {
        $kota = $this->kota_model->get_allkota();
        $data = [
            'title'         => 'Halaman Home',
            'kota'          => $kota,
            'content'       => 'front/home/index'
        ];
        $this->load->view('front/layout/wrapp', $data);
    }
}
