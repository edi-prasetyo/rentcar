<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ketentuan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ketentuan_model');
        $this->load->library('pagination');
    }
    public function index()
    {
        $ketentuan = $this->ketentuan_model->get_ketentuan();
        $data = [
            'title'                     => 'Manajemen Ketentuan',
            'ketentuan'                 => $ketentuan,
            'content'                   => 'admin/ketentuan/index_ketentuan'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function create()
    {
        $this->form_validation->set_rules(
            'ketentuan_name',
            'Nama Ketentuan',
            'required',
            [
                'required'                => 'Nama Ketentuan harus di isi',
            ]
        );

        if ($this->form_validation->run() == false) {
            $data = [
                'title'                   => "Create ketentuan",
                'content'                 => 'admin/ketentuan/create_ketentuan'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'ketentuan_name'           => $this->input->post('ketentuan_name'),
                'ketentuan_desc'                     => $this->input->post('ketentuan_desc'),
                'created_at'            => date('Y-m-d H:i:s')
            ];
            $this->ketentuan_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('admin/ketentuan'), 'refresh');
        }
    }
    public function update($id)
    {
        $ketentuan = $this->ketentuan_model->detail_ketentuan($id);
        $this->form_validation->set_rules(
            'ketentuan_name',
            'Nama Ketentuan',
            'required',
            [
                'required'                => 'Nama Ketentuan harus di isi',
            ]
        );
        if ($this->form_validation->run() == false) {
            $data = [
                'title'                   => "Create ketentuan",
                'ketentuan'               => $ketentuan,
                'content'                 => 'admin/ketentuan/update_ketentuan'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'id'                        => $id,
                'ketentuan_name'            => $this->input->post('ketentuan_name'),
                'ketentuan_desc'            => $this->input->post('ketentuan_desc'),
                'created_at'                => date('Y-m-d H:i:s')
            ];
            $this->ketentuan_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di ubah');
            redirect(base_url('admin/ketentuan'), 'refresh');
        }
    }
    public function delete($id)
    {
        is_login();
        $ketentuan = $this->ketentuan_model->detail_ketentuan($id);
        $data = array('id'   => $ketentuan->id);
        $this->ketentuan_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/ketentuan'), 'refresh');
    }
}
