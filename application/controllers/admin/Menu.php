<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('menu_model');
    $this->load->library('pagination');
  }
  public function index()
  {
    $list_menu = $this->menu_model->get_menu();
    $data = [
      'title'                     => 'Manajemen Menu',
      'list_menu'                 => $list_menu,
      'content'                   => 'admin/menu/index_menu'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  public function create()
  {
    $this->form_validation->set_rules(
      'nama_menu_ind',
      'Nama Menu Indonesia',
      'required',
      [
        'required'                => 'Nama Menu Indonesia Email harus di isi',
      ]
    );
    $this->form_validation->set_rules(
      'url',
      'Url',
      'required',
      [
        'required'                => 'Url Harus di isi',
      ]
    );
    if ($this->form_validation->run() == false) {
      $data = [
        'title'                   => "Create menu",
        'content'                 => 'admin/menu/create_menu'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    } else {
      $data = [
        'nama_menu_ind'           => $this->input->post('nama_menu_ind'),
        'url'                     => $this->input->post('url'),
        'urutan'                  => $this->input->post('urutan'),
        'date_created'            => date('Y-m-d H:i:s')
      ];
      $this->menu_model->create($data);
      $this->session->set_flashdata('message', 'Data telah ditambahkan');
      redirect(base_url('admin/menu'), 'refresh');
    }
  }
  public function update($id)
  {
    $menu = $this->menu_model->detail_menu($id);
    $this->form_validation->set_rules(
      'nama_menu_ind',
      'Nama Menu Indonesia',
      'required',
      [
        'required'                => 'Nama Menu Indonesia Email harus di isi',
      ]
    );
    if ($this->form_validation->run() == false) {
      $data = [
        'title'                   => "Create menu",
        'menu'                    => $menu,
        'content'                 => 'admin/menu/update_menu'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    } else {
      $data = [
        'id'                      => $id,
        'nama_menu_ind'           => $this->input->post('nama_menu_ind'),
        'url'                     => $this->input->post('url'),
        'urutan'                  => $this->input->post('urutan'),
        'date_updated'            => date('Y-m-d H:i:s')
      ];
      $this->menu_model->update($data);
      $this->session->set_flashdata('message', 'Data telah di ubah');
      redirect(base_url('admin/menu'), 'refresh');
    }
  }
  public function delete($id)
  {
    is_login();
    $menu = $this->menu_model->detail_menu($id);
    $data = array('id'   => $menu->id);
    $this->menu_model->delete($data);
    $this->session->set_flashdata('message', 'Data telah di Hapus');
    redirect(base_url('admin/menu'), 'refresh');
  }
}
