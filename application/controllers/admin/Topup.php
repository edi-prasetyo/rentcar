<?php
defined('BASEPATH') or exit('No direct script access allowed');

class topup extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('topup_model');
        $this->load->model('user_model');
        $this->load->model('saldo_model');
    }
    //listing data topup
    public function index()
    {

        $config['base_url']         = base_url('admin/topup/index/');
        $config['total_rows']       = count($this->topup_model->total_row());
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
        $topup = $this->topup_model->get_topup($limit, $start);
        $data = [
            'title'                 => 'Data Topup',
            'topup'                 => $topup,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/topup/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //listing data topup Sukses
    public function sukses()
    {
        $list_driver = $this->user_model->get_alldriver_active();
        $code_topup = $this->input->post('code_topup');
        $date_created = $this->input->post('date_created');
        $nama_driver = $this->input->post('nama_driver');


        $config['base_url']         = base_url('admin/topup/sukses/index/');
        $config['total_rows']       = count($this->topup_model->total_row_sukses($code_topup, $date_created, $nama_driver));
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
        $topup = $this->topup_model->get_topup_sukses($limit, $start, $code_topup, $date_created, $nama_driver);
        $data = [
            'title'                 => 'Data Topup',
            'topup'                 => $topup,
            'list_driver'          => $list_driver,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/topup/sukses'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    //listing data topup Batal
    public function batal()
    {
        $list_driver = $this->user_model->get_alldriver_active();
        $code_topup = $this->input->post('code_topup');
        $date_created = $this->input->post('date_created');
        $nama_driver = $this->input->post('nama_driver');

        $config['base_url']         = base_url('admin/topup/batal/index/');
        $config['total_rows']       = count($this->topup_model->total_row_batal($code_topup, $date_created, $nama_driver));
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
        $topup = $this->topup_model->get_topup_batal($limit, $start, $code_topup, $date_created, $nama_driver);
        $data = [
            'title'                 => 'Data Topup',
            'topup'                 => $topup,
            'list_driver'          => $list_driver,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/topup/batal'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    public function detail($id)
    {
        $topup = $this->topup_model->detail_topup($id);
        // var_dump($topup);
        // die;
        $data = [
            'title'                 => 'Detail Topup',
            'topup'             => $topup,
            'content'               => 'admin/topup/detail'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Aprove
    public function aprove($id)
    {
        $topup = $this->topup_model->detail_topup($id);
        $nominal = $topup->nominal;
        $driver_id = $topup->user_id;

        $driver_detail = $this->user_model->detail($driver_id);
        $saldo_driver = $driver_detail->saldo_driver;

        $tambah_saldo = $nominal + $saldo_driver;

        // var_dump($tambah_saldo);
        // die;

        $data = [

            'id'                => $driver_id,
            'saldo_driver'   => $tambah_saldo,

        ];
        $this->user_model->update($data);
        $this->update_topup($driver_id, $id);
        $this->create_saldo_topup($driver_id, $nominal, $tambah_saldo, $topup);
        $this->session->set_flashdata('message', 'Data telah di Update');
        redirect(base_url('admin/topup'), 'refresh');
    }
    // Create Saldo Topup
    public function create_saldo_topup($driver_id, $nominal, $tambah_saldo, $topup)
    {
        $data = [
            'user_id'               => $driver_id,
            'pemasukan'             => $nominal,
            'transaksi'             => 0,
            'pengeluaran'           => 0,
            'total_saldo'           => $tambah_saldo,
            'user_type'             => 'Driver',
            'keterangan'            => 'Top Up Saldo',
            'reason'                => 'Top Up saldo Kode Topup ' . $topup->code_topup,
            'date_created'          => date('Y-m-d H:i:s')

        ];
        $this->saldo_model->create($data);
    }
    // Update Top Up
    public function update_topup($driver_id, $id)
    {
        $user_id =  $this->session->userdata('id');
        $user_detail = $this->user_model->user_detail($user_id);
        $nama_user = $user_detail->name;

        $data = [
            'id'                    => $id,
            'user_id'               => $driver_id,
            'user_proccess'         => $user_id,
            'topup_reason'          => ' Aproved By ' . $nama_user,
            'status_bayar'          => 'Success',
            'date_updated'          => date('Y-m-d H:i:s')
        ];
        $this->topup_model->update($data);
    }
    // Decline
    public function decline($id)
    {
        $topup          = $this->topup_model->detail_topup($id);
        $user_id        = $this->session->userdata('id');
        $user           = $this->user_model->user_detail($user_id);
        $user_proccess  = $user->name;

        $this->form_validation->set_rules(
            'topup_reason',
            'Reason',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                             => 'Top Up Decline',
                'topup'                             => $topup,
                'content'                           => 'admin/topup/decline'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'id'                => $id,
                'status_bayar'      => 'Decline',
                'user_proccess'     => $user_proccess,
                'topup_reason'      => $this->input->post('topup_reason'),
                'date_updated'      => date('Y-m-d H:i:s')
            ];
            $this->topup_model->update($data);
            $this->session->set_flashdata('message', 'Top Up Decline');
            redirect(base_url('admin/topup'), 'refresh');
        }
    }
}
