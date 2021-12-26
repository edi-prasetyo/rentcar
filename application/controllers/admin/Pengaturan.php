<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{
    //Load Data Konfigurasi
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pengaturan_model');
    }
    public function index()
    {
        $email_register                = $this->pengaturan_model->email_register();
        $email_order                   = $this->pengaturan_model->email_order();

        $data    = [
            'title'                   => 'Pengaturan Email',
            'email_register'              => $email_register,
            'email_order'              => $email_order,
            'content'                 => 'admin/pengaturan/index_pengaturan'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    public function update($id)
    {
        $pengaturan = $this->pengaturan_model->detail_pengaturan($id);
        $this->form_validation->set_rules(
            'name',
            'Nama',
            'required',
            array('required'            => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                   => 'Update Pengaturan',
                'pengaturan'                    => $pengaturan,
                'content'                 => 'admin/pengaturan/update_pengaturan'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'id'                      => $pengaturan->id,
                'name'                   => $this->input->post('name'),
                'cc_email'             => $this->input->post('cc_email'),
                'protocol'                 => $this->input->post('protocol'),
                'smtp_host'             => $this->input->post('smtp_host'),
                'smtp_port'                => $this->input->post('smtp_port'),
                'smtp_user'             => $this->input->post('smtp_user'),
                'smtp_pass'               => $this->input->post('smtp_pass'),
                'date_updated'            => time()
            ];
            $this->pengaturan_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di ubah');
            redirect(base_url('admin/pengaturan'), 'refresh');
        }
    }
}
