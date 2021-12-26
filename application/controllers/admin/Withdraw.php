<?php
defined('BASEPATH') or exit('No direct script access allowed');

class withdraw extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('withdraw_model');
        $this->load->model('user_model');
        $this->load->model('saldo_model');
    }
    //listing data withdraw Pending
    public function index()
    {

        $config['base_url']         = base_url('admin/withdraw/index/');
        $config['total_rows']       = count($this->withdraw_model->total_row());
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
        $withdraw = $this->withdraw_model->get_withdraw($limit, $start);
        $data = [
            'title'                 => 'Data Withdraw',
            'withdraw'                 => $withdraw,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/withdraw/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //listing data withdraw Sukses
    public function sukses()
    {

        $list_mainagen = $this->user_model->get_all_mainagen_active();
        $nama_mainagen = $this->input->post('nama_mainagen');
        $date_created   = $this->input->post('date_created');
        $code_withdraw  = $this->input->post('code_withdraw');

        $config['base_url']         = base_url('admin/withdraw/sukses/index/');
        $config['total_rows']       = count($this->withdraw_model->total_row_sukses($nama_mainagen, $date_created, $code_withdraw));
        $config['per_page']         = 10;
        $config['uri_segment']      = 5;

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
        $start                      = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);
        $withdraw = $this->withdraw_model->get_withdraw_sukses($limit, $start, $nama_mainagen, $date_created, $code_withdraw);
        $data = [
            'title'                 => 'Data Withdraw',
            'withdraw'              => $withdraw,
            'list_mainagen'         => $list_mainagen,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/withdraw/sukses'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    // Aprove
    public function detail($id)
    {
        $withdraw = $this->withdraw_model->detail_withdraw($id);

        $this->form_validation->set_rules(
            'status_withdraw',
            'Status Withdraw',
            'required',
            [
                'required'                        => 'Nama Penerima harus di isi',
            ]
        );

        if ($this->form_validation->run()) {
            $config['upload_path']              = './assets/img/struk/';
            $config['allowed_types']            = 'gif|jpg|png|jpeg';
            $config['max_size']                 = 500000; //Dalam Kilobyte
            $config['max_width']                = 500000; //Lebar (pixel)
            $config['max_height']               = 500000; //tinggi (pixel)
            $config['remove_spaces']            = TRUE;
            $config['encrypt_name']             = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto_struk')) {
                //End Validasi
                $data = [
                    'title'                         => 'Detail Withdraw',
                    'withdraw'                      => $withdraw,
                    'error_upload'                  => $this->upload->display_errors(),
                    'content'                       => 'admin/withdraw/detail'
                ];
                $this->load->view('admin/layout/wrapp', $data, FALSE);
                //Masuk Database
            } else {
                //Proses Manipulasi Gambar
                $upload_data    = array('uploads'  => $this->upload->data());

                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/struk/' . $upload_data['uploads']['file_name'];
                //Gambar Versi Kecil dipindahkan
                // $config['new_image']        = './assets/img/transaksi/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 500;
                $config['height']           = 500;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                // var_dump($tambah_saldo);
                // die;

                $data = [
                    'id'                            => $id,
                    'status_withdraw'               => $this->input->post('status_withdraw'),
                    'foto_struk'                    => $upload_data['uploads']['file_name'],
                ];
                $this->withdraw_model->update($data);
                $this->session->set_flashdata('message', 'Data telah di Update');
                redirect(base_url('admin/withdraw'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'                             => 'Data Penerima',
            'withdraw'                          => $withdraw,
            'content'                           => 'admin/withdraw/detail'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    // Decline
    public function decline($id)
    {
    }
}
