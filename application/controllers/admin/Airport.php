<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Airport extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('airport_model');
        $this->load->model('kota_model');
        $this->load->model('ketentuan_model');
    }
    //Index Kota
    public function index()
    {
        $config['base_url']         = base_url('admin/airport/index/');
        $config['total_rows']       = count($this->airport_model->total_row());
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
        $airport = $this->airport_model->get_airport($limit, $start);


        $data = [
            'title'                             => 'bandara',
            'airport'                              => $airport,
            'pagination'                        => $this->pagination->create_links(),
            'content'                           => 'admin/airport/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function create()
    {
        $ketentuan = $this->ketentuan_model->get_ketentuan();
        $listkota = $this->kota_model->get_allkota();
        $this->form_validation->set_rules(
            'airport_name',
            'Nama Bandara',
            'required',
            [
                'required'                        => 'Nama Bandara harus di isi',
            ]
        );
        if ($this->form_validation->run() == false) {

            //End Validasi
            $data = [
                'title'                         => 'Tambah Bandara',
                'ketentuan'                     => $ketentuan,
                'listkota'                     => $listkota,
                'content'                       => 'admin/airport/create'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {
            $data  = [
                'kota_id'                       => $this->input->post('kota_id'),
                'airport_name'                  => $this->input->post('airport_name'),
                'airport_code'                  => $this->input->post('airport_code'),
                'created_at'                    => date('Y-m-d H:i:s')
            ];
            $this->airport_model->create($data);
            $this->session->set_flashdata('message', 'Data Produk telah ditambahkan');
            redirect(base_url('admin/airport'), 'refresh');
        }
    }
    public function update($id)
    {
        $ketentuan = $this->ketentuan_model->get_ketentuan();
        $listkota = $this->kota_model->get_allkota();
        $airport = $this->airport_model->detail_airport($id);
        // var_dump($airport);
        // die;

        $this->form_validation->set_rules(
            'airport_name',
            'Nama Bandara',
            'required',
            [
                'required'                        => 'Nama Bandara harus di isi',
            ]
        );
        if ($this->form_validation->run() == false) {

            //End Validasi
            $data = [
                'title'                     => 'Tambah Bandara',
                'ketentuan'                 => $ketentuan,
                'listkota'                  => $listkota,
                'airport'                   => $airport,
                'content'                   => 'admin/airport/update'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {
            $data  = [
                'id'                        => $id,
                'kota_id'                   => $this->input->post('kota_id'),
                'airport_name'              => $this->input->post('airport_name'),
                'airport_code'              => $this->input->post('airport_code'),
                'created_at'                => date('Y-m-d H:i:s')
            ];
            $this->airport_model->update($data);
            $this->session->set_flashdata('message', 'Data Produk telah di Update');
            redirect(base_url('admin/airport'), 'refresh');
        }
    }
    //delete Airport
    public function delete($id)
    {
        //Proteksi delete
        is_login();
        $airport = $this->airport_model->detail_airport($id);
        $data = ['id'   => $airport->id];
        $this->airport_model->delete($data);
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
