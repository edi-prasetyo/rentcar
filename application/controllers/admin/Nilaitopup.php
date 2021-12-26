<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilaitopup extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nilaitopup_model');
    }
    //Index Nilaitopup
    public function index()
    {
        $nilai_topup = $this->nilaitopup_model->get_nilai_topup();
        //Validasi
        $this->form_validation->set_rules(
            'nilai_topup',
            'Nominal Top Up',
            'required',
            ['required'                        => '%s Harus Diisi',]

        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                           => 'Nilai topup',
                'nilai_topup'                        => $nilai_topup,
                'content'                         => 'admin/nilai_topup/index'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data  = [
                'nilai_topup'                   => $this->input->post('nilai_topup'),
                'date_created'                    => date('Y-m-d H:i:s')
            ];
            $this->nilaitopup_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('admin/nilaitopup'), 'refresh');
        }
    }
    //Update
    public function update($id)
    {
        $nilai_topup = $this->nilaitopup_model->detail_nilai_topup($id);
        //Validasi
        $this->form_validation->set_rules(
            'nilai_topup',
            'Nominal',
            'required',
            array('required'                  => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            //End Validasi
            $data = [
                'title'                         => 'Edit Nilai Topup',
                'nilai_topup'                      => $nilai_topup,
                'content'                       => 'admin/nilai_topup/update'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {
            $data  = [
                'id'                            => $id,
                'nilai_topup'                 => $this->input->post('nilai_topup'),
                'date_updated'                  => date('Y-m-d H:i:s')
            ];
            $this->nilaitopup_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di Update');
            redirect(base_url('admin/nilaitopup'), 'refresh');
        }
        //End Masuk Database
    }
    //delete Nilaitopup
    public function delete($id)
    {
        //Proteksi delete
        is_login();
        $nilai_topup = $this->nilaitopup_model->detail_nilai_topup($id);
        $data = ['id'   => $nilai_topup->id];
        $this->nilaitopup_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/nilaitopup'), 'refresh');
    }
}
