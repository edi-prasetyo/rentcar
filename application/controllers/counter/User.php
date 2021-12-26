<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('provinsi_model');
        $this->load->model('main_model');
    }
    public function index()
    {
        $my_counter = $this->user_model->get_counterByAgen();
        $data = [
            'title'                 => 'Data Counter Saya',
            'my_counter'             => $my_counter,
            'content'               => 'counter/user/index_user'
        ];
        $this->load->view('counter/layout/wrapp', $data, FALSE);
    }
}
