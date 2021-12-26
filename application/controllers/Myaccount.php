<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Myaccount extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('pengaturan_model');
        $this->load->model('kota_model');
        $this->load->model('daily_model');
        $this->load->model('mobil_model');
        $this->load->model('user_model');
        $this->load->model('point_model');
        $user_id = $this->session->userdata('id');
        if ($user_id == null) {
            redirect('auth');
        }
    }
    public function index()
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->detail($user_id);
        $total_pointku = $this->point_model->total_user_point($user_id);
        $data = [
            'title'         => 'My Account',
            'user'          => $user,
            'total_pointku' => $total_pointku,
            'content'       => 'front/myaccount/index'
        ];
        $this->load->view('front/layout/wrapp', $data);
    }
    public function point()
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->detail($user_id);
        $point = $this->point_model->user_point($user_id);
        $total_pointku = $this->point_model->total_user_point($user_id);
        // var_dump($total_pointku);
        // die;
        $data = [
            'title'         => 'My Account',
            'user'          => $user,
            'point'         => $point,
            'total_pointku'   => $total_pointku,
            'content'       => 'front/myaccount/point'
        ];
        $this->load->view('front/layout/wrapp', $data);
    }
    public function transaksi()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->detail($id);

        $config['base_url']         = base_url('myaccount/transaksi/index/');
        $config['total_rows']       = count($this->transaksi_model->total_row());
        $config['per_page']         = 10;
        $config['uri_segment']      = 4;
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
        $limit                      = $config['per_page'];
        $start                      = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
        $this->pagination->initialize($config);

        $transaksi_saya = $this->transaksi_model->get_mytransaksi($id, $limit, $start);
        $data = [
            'title'                 => 'My Account',
            'user'                  => $user,
            'transaksi_saya'        => $transaksi_saya,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'front/myaccount/transaksi'
        ];
        $this->load->view('front/layout/wrapp', $data);
    }

    public function detail_transaksi($id)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->detail($user_id);
        $detail_transaksi_saya = $this->transaksi_model->detail_transaksi_saya($user_id, $id);
        $data = [
            'title'                 => 'My Account',
            'user'                  => $user,
            'detail_transaksi'      => $detail_transaksi_saya,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'front/myaccount/detail_transaksi'
        ];
        $this->load->view('front/layout/wrapp', $data);
    }
}
