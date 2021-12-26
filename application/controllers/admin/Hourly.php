<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hourly extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('hourly_model');
        $this->load->model('mobil_model');
        $this->load->library('pagination');
    }
    //listing data hourly
    public function index()
    {
        $config['base_url']                   = base_url('admin/hourly/index/');
        $config['total_rows']                 = count($this->hourly_model->total_row());
        $config['per_page']                   = 8;
        $config['uri_segment']                = 4;

        $config['first_link']                 = 'First';
        $config['last_link']                  = 'Last';
        $config['next_link']                  = 'Next';
        $config['prev_link']                  = 'Prev';
        $config['full_tag_open']              = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']             = '</ul></nav></div>';
        $config['num_tag_open']               = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']              = '</span></li>';
        $config['cur_tag_open']               = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']              = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']              = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']            = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']              = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']            = '</span>Next</li>';
        $config['first_tag_open']             = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close']           = '</span></li>';
        $config['last_tag_open']              = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']            = '</span></li>';
        //Limit dan Start
        $limit                                = $config['per_page'];
        $start                                = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);
        $hourly = $this->hourly_model->get_hourly($limit, $start);
        $data = [
            'title'                             => 'Seting Harga',
            'hourly'                          => $hourly,
            'pagination'                        => $this->pagination->create_links(),
            'content'                           => 'admin/hourly/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Create New hourly
    public function create()
    {
        $this->form_validation->set_rules(
            'hourly_name',
            'Nama produk',
            'required',
            [
                'required'                        => 'Nama produk harus di isi',
            ]
        );
        if ($this->form_validation->run() == false) {

            //End Validasi
            $data = [
                'title'                         => 'Tambah Produk',
                'content'                       => 'admin/hourly/create_hourly'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {
            $data  = [
                'vehicle_id'                      => $this->input->post('vehicle_id'),
                'paket'                         => $this->input->post('paket'),
                'price'                         => $this->input->post('price'),
                'status'                        => $this->input->post('status'),
                'date_created'                  => date('Y-m-d H:i:s')
            ];
            $this->hourly_model->create($data);
            $this->session->set_flashdata('message', 'Data Produk telah ditambahkan');
            redirect(base_url('admin/hourly'), 'refresh');
        }

        //End Masuk Database
        $data = [
            'title'                             => 'Tambah Produk',
            'content'                           => 'admin/hourly/create_hourly'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    public function Update($id)
    {
        $hourly = $this->hourly_model->hourly_detail($id);
        $this->form_validation->set_rules(
            'hourly_name',
            'Nama Product',
            'required|trim',
            ['required' => 'nama harus di isi']
        );
        if ($this->form_validation->run() == false) {
            $data = [
                'title'             => 'Update Counter',
                'hourly'           => $hourly,
                'content'           => 'admin/hourly/update_hourly'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $data = [
                'id'              => $id,
                'hourly_name'    => $this->input->post('hourly_name'),
                'start_price'     => $this->input->post('start_price'),
                'price'           => $this->input->post('price'),
                'hourly_status'  => $this->input->post('hourly_status'),
                'date_updated'    => date('Y-m-d H:i:s')
            ];
            $this->hourly_model->update($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil di Update</div>');
            redirect('admin/hourly');
        }
    }
    //delete
    public function delete($id)
    {
        //Proteksi delete
        is_login();
        $hourly                               = $this->hourly_model->hourly_detail($id);
        //Hapus gambar
        if ($hourly->hourly_img != "") {
            unlink('./assets/img/hourly/' . $hourly->hourly_img);
            // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
        }
        //End Hapus Gambar
        $data = ['id'                           => $hourly->id];
        $this->hourly_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
