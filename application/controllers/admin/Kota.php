<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kota extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('kota_model');
        $this->load->model('product_model');
        $this->load->model('tarif_model');
    }
    //Index Kota
    public function index()
    {
        $config['base_url']         = base_url('admin/kota/index/');
        $config['total_rows']       = count($this->kota_model->total_row());
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
        $kota = $this->kota_model->get_kota($limit, $start);


        $data = [
            'title'                             => 'Kota Artikel',
            'kota'                              => $kota,
            'pagination'                        => $this->pagination->create_links(),
            'content'                           => 'admin/kota/index_kota'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Destinasi Tujuan
    public function tujuan($id)
    {
        $list_kota = $this->kota_model->get_allkota();
        $kota = $this->kota_model->detail_kota($id);
        $kota_name = $kota->kota_name;

        $config['base_url']         = base_url('admin/kota/tujuan/' . $id . '/index');
        $config['total_rows']       = count($this->destinasi_model->total_row($kota_name));
        $config['per_page']         = 20;
        $config['uri_segment']      = 6;

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
        $start                      = ($this->uri->segment(6)) ? ($this->uri->segment(6)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);

        $destinasi = $this->destinasi_model->get_destinasi($limit, $start, $kota_name);

        //Validasi
        $this->form_validation->set_rules('kota_asal', 'Kota Tujuan sudah ada', 'callback_check_kota'); // call callback function
        $this->form_validation->set_message('check_kota', 'Kota Tujuan sudah ada.');
        $this->form_validation->set_rules('kota_tujuan', 'kota tujuan', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Data Provinsi',
                'kota'                  => $kota,
                'list_kota'             => $list_kota,
                'destinasi'             => $destinasi,
                'pagination'            => $this->pagination->create_links(),
                'content'               => 'admin/kota/tujuan'
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
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah ditambahkan</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    function check_kota()
    {
        $kota_asal = $this->input->post('kota_asal'); // get fiest name
        $kota_tujuan = $this->input->post('kota_tujuan'); // get last name
        $this->db->select('id');
        $this->db->from('destinasi');
        $this->db->where('kota_asal', $kota_asal);
        $this->db->where('kota_tujuan', $kota_tujuan);
        $query = $this->db->get();
        $num = $query->num_rows();
        if ($num > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function tarif($id)
    {
        $destinasi = $this->destinasi_model->detail_destinasi($id);
        $destinasi_id = $destinasi->id;
        // var_dump($destinasi->kota_asal);
        // die;
        $product = $this->product_model->get_product();
        $tarif = $this->tarif_model->detail_tarif_destinasi($destinasi_id);
        // var_dump($tarif);
        // die;

        // Get Insert From Field
        $harga      = $this->input->post('harga');
        $harga_awal_2 = $this->input->post('harga_awal_2');
        $harga_2      = $this->input->post('harga_2');

        $this->form_validation->set_rules(
            'harga',
            'Harga',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                             => 'Tarif',
                'destinasi'                         => $destinasi,
                'tarif'                             => $tarif,
                'product'                           => $product,
                'content'                           => 'admin/kota/tarif'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {


            $data  =
                [
                    'user_id'                           => $this->session->userdata('id'),
                    'destinasi_id'                      => $id,
                    'product_id'                        => 1,
                    'harga_awal'                        => $this->input->post('harga_awal'),
                    'harga'                             => $harga,
                    'date_created'                      => date('Y-m-d H:i:s')
                ];
            $this->tarif_model->create($data);
            $this->tarif_2($harga_awal_2, $harga_2, $id);
            $this->tarif_destinasi($id,  $harga, $harga_2);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function tarif_2($harga_awal_2, $harga_2, $id)
    {
        $data  =
            [
                'user_id'                           => $this->session->userdata('id'),
                'destinasi_id'                      => $id,
                'product_id'                        => 2,
                'harga_awal'                        => $harga_awal_2,
                'harga'                             => $harga_2,
                'date_created'                      => date('Y-m-d H:i:s')
            ];
        $this->tarif_model->create($data);
    }

    public function tarif_destinasi($id,  $harga, $harga_2)
    {
        $data  =
            [
                'id'                                => $id,
                'express'                           => $harga,
                'cargo'                             => $harga_2,
                'date_updated'                      => date('Y-m-d H:i:s')
            ];
        $this->destinasi_model->update($data);
    }
    public function delete_tarif()
    {
        $id_tarif = $this->input->post('id_tarif');
        // var_dump($id_tarif);
        // die;
        //Proteksi delete
        is_login();

        $this->tarif_model->delete($id_tarif);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
