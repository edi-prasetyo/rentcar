<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Provinsi extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('provinsi_model');
        $this->load->model('kota_model');
    }
    //Index Provinsi
    public function index()
    {

        $config['base_url']         = base_url('admin/provinsi/index/');
        $config['total_rows']       = count($this->provinsi_model->total_row());
        $config['per_page']         = 10;
        $config['uri_segment']      = 4;

        //Membuat Style pagination untuk BootStrap v4
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
        //Limit dan Start
        $limit                      = $config['per_page'];
        $start                      = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);
        $provinsi = $this->provinsi_model->get_provinsi($limit, $start);

        //Validasi
        $this->form_validation->set_rules(
            'provinsi_name',
            'Provinsi',
            'required|is_unique[provinsi.provinsi_name]',
            array(
                'required'                        => '%s Harus Diisi',
                'is_unique'                        => '%s <strong>' . $this->input->post('provinsi_name') .
                    '</strong> Sudah Tersedia!'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Data Provinsi',
                'provinsi'             => $provinsi,
                'pagination'            => $this->pagination->create_links(),
                'content'               => 'admin/provinsi/index_provinsi'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data  = [
                'user_id'                         => $this->session->userdata('id'),
                'provinsi_name'                   => $this->input->post('provinsi_name'),
                'date_created'                    => date('Y-m-d H:i:s')
            ];
            $this->provinsi_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('admin/provinsi'), 'refresh');
        }
    }
    //Update
    public function update($id)
    {
        $provinsi = $this->provinsi_model->detail_provinsi($id);

        //Validasi
        $this->form_validation->set_rules(
            'provinsi_name',
            'Nama Kategori',
            'required',
            array('required'                  => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            //End Validasi
            $data = [
                'title'                         => 'Edit kategori Berita',
                'provinsi'                      => $provinsi,
                'content'                       => 'admin/provinsi/update_provinsi'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {
            $data  = [
                'id'                            => $id,
                'user_id'                         => $this->session->userdata('id'),
                'provinsi_name'                 => $this->input->post('provinsi_name'),
                'date_updated'                  => date('Y-m-d H:i:s')
            ];
            $this->provinsi_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di Update');
            redirect(base_url('admin/provinsi'), 'refresh');
        }
        //End Masuk Database
    }
    //delete Provinsi
    public function delete($id)
    {
        //Proteksi delete
        is_login();
        $provinsi = $this->provinsi_model->detail_provinsi($id);

        $data = ['id'   => $provinsi->id];
        $this->provinsi_model->delete($data);
        $this->delete_kota($id);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/provinsi'), 'refresh');
    }

    public function delete_kota($id)
    {
        // $provinsi_id = $this->kota_model->get_array_kota($id);
        // var_dump($kota_id);
        // die;
        $this->kota_model->delete_kota($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Hapus</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function view($id)
    {
        $provinsi = $this->provinsi_model->detail_provinsi($id);
        $data = [
            'title'                         => 'Data Kota',
            'provinsi'                      => $provinsi,
            'content'                       => 'admin/provinsi/view_provinsi'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    //Kota
    public function kota($provinsi_id)
    {
        $provinsi       = $this->provinsi_model->detail($provinsi_id);
        $kota           = $this->provinsi_model->list_kota($provinsi_id);

        //Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'kota_name',
            'Nama Kota',
            'required|is_unique[kota.kota_name]',

            array(
                'required'      => '%s harus diisi',
                'is_unique'                        => '%s <strong>' . $this->input->post('kota_name') .
                    '</strong> Sudah Tersedia!'
            )
        );


        if ($valid->run() === FALSE) {
            //End Validasi
            $data = array(
                'title'             => 'Tambah Kota',
                'provinsi'          => $provinsi,
                'kota'              => $kota,
                'provinsi_id'       => $provinsi_id,
                'content'           => 'admin/provinsi/kota'
            );
            $this->load->view('admin/layout/wrapp', $data, FALSE);

            //Masuk Database

        } else {
            $data  = array(
                'provinsi_id'           => $provinsi_id,
                'user_id'               => $this->session->userdata('id'),
                'kota_name'             => $this->input->post('kota_name'),
                'date_created'          => date('Y-m-d H:i:s')
            );
            $this->kota_model->create($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable fade show"><button class="close" data-dismiss="alert" aria-label="Close">×</button> Data telah ditambahkan</div>');
            redirect(base_url('admin/provinsi/kota/' . $provinsi_id), 'refresh');
        }

        //End Masuk Database
        $data = array(
            'title'             => 'Tambah Kota',
            'provinsi'          => $provinsi,
            'kota'              => $kota,
            'provinsi_id'       => $provinsi_id,
            'content'           => 'admin/provinsi/kota'
        );
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function update_kota($id)
    {
        $kota = $this->kota_model->detail_kota($id);

        //Validasi
        $this->form_validation->set_rules(
            'kota_name',
            'Nama Kota',
            'required',
            array('required'                  => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            //End Validasi
            $data = [
                'title'                         => 'Edit Kota',
                'kota'                          => $kota,
                'content'                       => 'admin/provinsi/update_kota'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {
            $data  = [
                'id'                            => $id,
                'user_id'                       => $this->session->userdata('id'),
                'kota_name'                     => $this->input->post('kota_name'),
                'date_updated'                  => date('Y-m-d H:i:s')
            ];
            $this->kota_model->update($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable fade show"><button class="close" data-dismiss="alert" aria-label="Close">×</button> Data telah di Update</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        //End Masuk Database
    }
}
