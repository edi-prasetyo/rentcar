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
  // Create User
  public function create()
  {
    $this->form_validation->set_rules(
      'name',
      'Nama',
      'required|trim',
      ['required' => 'nama harus di isi']
    );

    $this->form_validation->set_rules(
      'email',
      'Email',
      'required|trim|valid_email|is_unique[user.email]',
      [
        'required'     => 'Email Harus diisi',
        'valid_email'   => 'Email Harus Valid',
        'is_unique'    => 'Email Sudah ada, Gunakan Email lain'
      ]
    );
    $this->form_validation->set_rules(
      'password1',
      'Password',
      'required|trim|min_length[3]|matches[password2]',
      [
        'matches'     => 'Password tidak sama',
        'min_length'   => 'Password Min 3 karakter'
      ]
    );
    $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');

    if ($this->form_validation->run() == false) {
      $data = [
        'title'         => 'Tambah Admin',
        'content'       => 'admin/user/create'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    } else {

      $email = $this->input->post('email', true);
      $user_code = random_int(1000, 9999);
      $data = [
        'user_create'   => $this->session->userdata('id'),
        'user_title'    => $this->input->post('user_title'),
        'name'          => htmlspecialchars($this->input->post('name', true)),
        'email'         => htmlspecialchars($email),
        'user_code'     => $user_code,
        'user_phone'    => $this->input->post('user_phone'),
        'user_address'  => $this->input->post('user_address'),
        'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id'       => 2,
        'is_active'     => 1,
        'is_locked'     => 1,
        'date_created'  => date('Y-m-d H:i:s')
      ];
      $this->db->insert('user', $data);
      $this->session->set_flashdata('message', 'Selamat Anda berhasil mendaftar, silahkan Aktivasi akun');
      redirect('admin/user');
    }
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
