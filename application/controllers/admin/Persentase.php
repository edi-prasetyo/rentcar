<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Persentase extends CI_Controller
{
  //Load Data Konfigurasi
  public function __construct()
  {
    parent::__construct();
    $this->load->model('persentase_model');
  }
  public function index()
  {
    $persentase                       = $this->persentase_model->get_persentase();
    $data                       = [
      'title'                   => 'Seting Persentase',
      'persentase'                    => $persentase,
      'content'                 => 'admin/persentase/index'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  public function update($id)
  {
    $persentase = $this->persentase_model->detail_persentase($id);
    $this->form_validation->set_rules(
      'potong_saldo',
      'Potong Saldo',
      'required',
      array('required'            => '%s Harus Diisi')
    );
    if ($this->form_validation->run() === FALSE) {
      $data = [
        'title'                   => 'Update Persentase',
        'persentase'                    => $persentase,
        'content'                 => 'admin/persentase/update'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    } else {
      $data = [
        'id'                      => $id,
        'user_id'                 => $this->session->userdata('id'),
        'potong_saldo'            => $this->input->post('potong_saldo'),
        'date_updated'            => date('Y-m-d H:i:s')
      ];
      $this->persentase_model->update($data);
      $this->session->set_flashdata('message', 'Data telah di ubah');
      redirect(base_url('admin/persentase'), 'refresh');
    }
  }
}
