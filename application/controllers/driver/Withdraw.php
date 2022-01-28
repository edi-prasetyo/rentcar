<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Withdraw extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('user_model');
        $this->load->model('nilaitopup_model');
        $this->load->model('withdraw_model');
        $this->load->model('saldo_model');
        $this->load->model('bank_model');
    }
    public function index()
    {
        $code_withdraw = date('dmY') . strtoupper(random_string('alnum', 5));

        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);
        $endap = 50000;
        $nominal_withdraw = $user->saldo_driver - $endap;

        $my_withdraw = $this->withdraw_model->get_my_withdraw($user_id);
        $my_withdraw_success = $this->withdraw_model->get_my_withdraw_success($user_id);

        $this->form_validation->set_rules(
            'keterangan',
            'Keterangan',
            'required',
            array(
                'required'                        => 'Anda Harus Memilih %s Top Up',
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                     => 'Tarik Saldo',
                'my_withdraw'               => $my_withdraw,
                'my_withdraw_success'       => $my_withdraw_success,
                'content'                   => 'driver/withdraw/index'
            ];
            $this->load->view('driver/layout/wrapp', $data, FALSE);
        } else {

            $data  = [
                'user_id'                   => $this->session->userdata('id'),
                'code_withdraw'             => $code_withdraw,
                'nominal_withdraw'          => $nominal_withdraw,
                'keterangan'                => $this->input->post('keterangan'),
                'status_withdraw'           => 'Pending',
                'status_read'               => 0,
                'date_created'              => date('Y-m-d H:i:s')
            ];
            $insert_id = $this->withdraw_model->create($data);
            // Update Data Saldo MainAgen
            $this->update_saldo_driver($nominal_withdraw, $user);
            $this->create_laporan($nominal_withdraw, $code_withdraw);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('driver/withdraw/success/' . $insert_id), 'refresh');
        }
    }
    public function update_saldo_driver($nominal_withdraw, $user)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);

        $sisa_saldo = $user->saldo_driver - $nominal_withdraw;

        $data = [
            'id'                        => $user_id,
            'saldo_driver'            => $sisa_saldo,
        ];
        $this->user_model->update($data);
    }
    public function create_laporan($nominal_withdraw, $code_withdraw)
    {
        $user_id = $this->session->userdata('id');
        $data = [
            'user_id'       => $user_id,
            'pemasukan'     => 0,
            'transaksi'     => 0,
            'pengeluaran'   => $nominal_withdraw,
            'total_saldo'   => 0,
            'keterangan'    => 'Tarik Saldo',
            'reason'        => 'Tarik Saldo ID Penarikan : ' . $code_withdraw,
            'user_type'     => 'Driver',
            'date_created'  => date('Y-m-d H:i:s')
        ];
        $this->saldo_model->create($data);
    }
    public function success($insert_id)
    {
        $user                               = $this->session->userdata('id');
        $bank                               = $this->bank_model->get_allbank();
        $last_withdraw                      = $this->withdraw_model->last_withdraw($insert_id, $user);

        if ($last_withdraw->user_id == $user) {
            $data = [
                'title'                      => 'Withdraw',
                'last_withdraw'              => $last_withdraw,
                'bank'                       => $bank,
                'content'                    => 'driver/withdraw/success'
            ];
            $this->load->view('driver/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('driver/404'), 'refresh');
        }
    }

    // Riwayat
    public function riwayat()
    {
        $user_id = $this->session->userdata('id');

        $config['base_url']         = base_url('driver/withdraw/riwayat/index');
        $config['total_rows']       = count($this->withdraw_model->total_row_my_withdraw($user_id));
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

        $my_withdraw = $this->withdraw_model->get_allmy_withdraw($user_id, $limit, $start);
        $data = [
            'title'                 => 'Riwayat Withdraw',
            'my_withdraw'           => $my_withdraw,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'driver/withdraw/riwayat'
        ];
        $this->load->view('driver/layout/wrapp', $data, FALSE);
    }
    public function detail($id)
    {
        $user_id                               = $this->session->userdata('id');
        $bank                               = $this->bank_model->get_allbank();
        $withdraw                           = $this->withdraw_model->detail_withdraw($id);

        if ($withdraw->user_id == $user_id) {
            $data = [
                'title'                         => 'Withdraw',
                'withdraw'                      => $withdraw,
                'bank'                          => $bank,
                'content'                       => 'driver/withdraw/detail'
            ];
            $this->load->view('driver/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('driver/404'), 'refresh');
        }
    }
}
