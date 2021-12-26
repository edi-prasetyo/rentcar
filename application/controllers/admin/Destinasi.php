<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Destinasi extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('destinasi_model');
        $this->load->model('kota_model');
    }
    //Index Destinasi
    public function index()
    {
        $list_kota = $this->kota_model->get_allkota();

        $config['base_url']         = base_url('admin/destinasi/index/');
        $config['total_rows']       = count($this->destinasi_model->total_row());
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
        $destinasi = $this->destinasi_model->get_destinasi($limit, $start);

        //Validasi
        $this->form_validation->set_rules(
            'destinasi_name',
            'Destinasi',
            'required|is_unique[destinasi.destinasi_name]',
            array(
                'required'                          => '%s Harus Diisi',
                'is_unique'                         => '%s <strong>' . $this->input->post('destinasi_name') .
                    '</strong> Sudah Tersedia!'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Data Destinasi',
                'destinasi'             => $destinasi,
                'list_kota'             => $list_kota,
                'pagination'            => $this->pagination->create_links(),
                'content'               => 'admin/destinasi/index'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data  = [
                'user_id'                           => $this->session->userdata('id'),
                'kota_asal'                         => $this->input->post('kota_asal'),
                'kota_tujuan'                       => $this->input->post('kota_tujuan'),
                'date_created'                      => date('Y-m-d H:i:s')
            ];
            $this->destinasi_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('admin/destinasi'), 'refresh');
        }
    }
    //Update
    public function update($id)
    {
        $destinasi = $this->destinasi_model->detail_destinasi($id);

        //Validasi
        $this->form_validation->set_rules(
            'destinasi_name',
            'Nama Kategori',
            'required',
            array('required'                  => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            //End Validasi
            $data = [
                'title'                         => 'Edit kategori Berita',
                'destinasi'                      => $destinasi,
                'content'                       => 'admin/destinasi/update_destinasi'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {
            $data  = [
                'id'                            => $id,
                'user_id'                         => $this->session->userdata('id'),
                'destinasi_name'                 => $this->input->post('destinasi_name'),
                'date_updated'                  => date('Y-m-d H:i:s')
            ];
            $this->destinasi_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di Update');
            redirect(base_url('admin/destinasi'), 'refresh');
        }
        //End Masuk Database
    }
    //delete Destinasi
    public function delete($id)
    {
        //Proteksi delete
        is_login();
        $destinasi = $this->destinasi_model->detail_destinasi($id);
        $data = ['id'   => $destinasi->id];
        $this->destinasi_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/destinasi'), 'refresh');
    }

    public function view($id)
    {
        $destinasi = $this->destinasi_model->detail_destinasi($id);
        $data = [
            'title'                         => 'Data Kota',
            'destinasi'                      => $destinasi,
            'content'                       => 'admin/destinasi/view_destinasi'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    //Kota
    public function kota($destinasi_id)
    {
        $destinasi       = $this->destinasi_model->detail($destinasi_id);
        $kota           = $this->destinasi_model->list_kota($destinasi_id);

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
                'destinasi'          => $destinasi,
                'kota'              => $kota,
                'destinasi_id'       => $destinasi_id,
                'content'           => 'admin/destinasi/kota'
            );
            $this->load->view('admin/layout/wrapp', $data, FALSE);

            //Masuk Database

        } else {
            $data  = array(
                'destinasi_id'           => $destinasi_id,
                'user_id'               => $this->session->userdata('id'),
                'kota_name'             => $this->input->post('kota_name'),
                'date_created'          => date('Y-m-d H:i:s')
            );
            $this->kota_model->create($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable fade show"><button class="close" data-dismiss="alert" aria-label="Close">×</button> Data telah ditambahkan</div>');
            redirect(base_url('admin/destinasi/kota/' . $destinasi_id), 'refresh');
        }

        //End Masuk Database
        $data = array(
            'title'             => 'Tambah Kota',
            'destinasi'          => $destinasi,
            'kota'              => $kota,
            'destinasi_id'       => $destinasi_id,
            'content'           => 'admin/destinasi/kota'
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
                'content'                       => 'admin/destinasi/update_kota'
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
