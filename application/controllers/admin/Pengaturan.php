<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{
    //Load Data Konfigurasi
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pengaturan_model');
        $this->load->model('meta_model');
    }
    public function index()
    {
        $id = 1;
        $detail_version = $this->pengaturan_model->detail_version($id);

        $email_register                = $this->pengaturan_model->email_register();
        $email_order                   = $this->pengaturan_model->email_order();
        $payment_method = $this->pengaturan_model->get_payment();
        $meta = $this->meta_model->get_meta();


        $data    = [
            'title'                   => 'Pengaturan',
            'email_register'              => $email_register,
            'email_order'              => $email_order,
            'payment_method'            => $payment_method,
            'meta'                      => $meta,
            'detail_version'        => $detail_version,
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
    public function active_payment($id)
    {
        $data = [
            'id'                      => $id,
            'is_active'                   => 1,
        ];
        $this->pengaturan_model->update_payment($data);
        $this->session->set_flashdata('message', 'Data telah di ubah');
        redirect(base_url('admin/pengaturan'), 'refresh');
    }
    public function inactive_payment($id)
    {
        $data = [
            'id'                      => $id,
            'is_active'                   => 0,
        ];
        $this->pengaturan_model->update_payment($data);
        $this->session->set_flashdata('message', 'Data telah di ubah');
        redirect(base_url('admin/pengaturan'), 'refresh');
    }
    public function whatsapp_api($id)
    {
        $meta = $this->meta_model->get_meta();
        $this->form_validation->set_rules(
            'whatsapp_api',
            'whatsapp api',
            'required',
            array('required'            => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                   => 'Update Pengaturan',
                'meta'                  => $meta,
                'content'                 => 'admin/pengaturan/index_pengaturan'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $data = [
                'id'                      => $id,
                'whatsapp_api'            => $this->input->post('whatsapp_api'),
            ];
            $this->pengaturan_model->update_whatsapp($data);
            $this->session->set_flashdata('message', 'Data telah diubah');
            redirect($_SERVER['HTTP_REFERER']);
            // redirect(base_url('admin/pengaturan/whatsapp_api/' . $id), 'refresh');
        }
    }

    public function versi()
    {

        $id = 1;
        $version = $this->pengaturan_model->version();
        $detail_version = $this->pengaturan_model->detail_version($id);

        $this->form_validation->set_rules(
            'name',
            'nama',
            'required',
            array('required'            => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                   => 'Update Pengaturan',
                'version'                  => $version,
                'detail_version'        => $detail_version,
                'content'                 => 'admin/pengaturan/index_pengaturan'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $data = [
                'id'                      => $id,
                'name'            => $this->input->post('name'),
                'version'            => $this->input->post('version'),
                'updated_at'            => date('Y-m-d H:i:s'),
            ];
            $this->pengaturan_model->update_version($data);
            $this->session->set_flashdata('message', 'Data telah diubah');
            redirect($_SERVER['HTTP_REFERER']);
            // redirect(base_url('admin/pengaturan/whatsapp_api/' . $id), 'refresh');
        }
    }
}
