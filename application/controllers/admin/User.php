<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('main_model');
  }
  public function index()
  {
    $list_user = $this->user_model->get_admin();
    $data = [
      'title'                 => 'Data User',
      'list_user'             => $list_user,
      'content'               => 'admin/user/index_user'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  //Detail User
  public function detail($id)
  {
    $user_detail =  $this->user_model->detail($id);
    $data = [
      'title'                 => 'Data User',
      'user_detail'           => $user_detail,
      'content'               => 'admin/user/detail_user'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
}
