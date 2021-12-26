<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('user_model');
        $this->load->model('main_model');
    }
    public function index()
    {
        $search = $this->input->post('search');

        $config['base_url']         = base_url('admin/driver/index/');
        $config['total_rows']       = count($this->user_model->total_row_allkurir($search));
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
        $main_agen = $this->user_model->get_allkurir($limit, $start, $search);
        // var_dump($main_agen);
        // die;

        $data = [
            'title'                 => 'Data Driver',
            'main_agen'             => $main_agen,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/driver/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    // Create Driver
    public function create()
    {
        $this->form_validation->set_rules(
            'name',
            'Nama',
            'required|trim',
            ['required' => 'nama harus di isi']
        );

        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[user.email]',
            [
                'required'     => 'Email Harus diisi',
                'valid_email'   => 'Email Harus Valid',
                'is_unique'    => 'Email Sudah ada, Gunakan Email lain'
            ]
        );
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'matches'     => 'Password tidak sama',
                'min_length'   => 'Password Min 3 karakter'
            ]
        );
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data = [
                'title'         => 'Add Driver',
                'content'       => 'admin/driver/create'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $email = $this->input->post('email', true);
            $user_code = random_int(1000, 9999);
            $data = [
                'user_create'   => $this->session->userdata('id'),
                'user_title'    => $this->input->post('user_title'),
                'name'          => htmlspecialchars($this->input->post('name', true)),
                'email'         => htmlspecialchars($email),
                'user_code'     => $user_code,
                'user_phone'    => $this->input->post('user_phone'),
                'user_address'  => $this->input->post('user_address'),
                'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id'       => 5,
                'is_active'     => 0,
                'is_locked'     => 0,
                'date_created'  => date('Y-m-d H:i:s')
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', 'Selamat Anda berhasil mendaftar, silahkan Aktivasi akun');
            redirect('admin/driver');
        }
    }
    // Detail Main Agen
    public function detail($id)
    {

        $main_agen = $this->user_model->detail($id);
        $data = [
            'title'                 => 'Detail Driver',
            'main_agen'             => $main_agen,
            'content'               => 'admin/driver/detail'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Activated
    public function activated($id)
    {

        // var_dump($user_code);
        // die;
        is_login();
        $data = [
            'id'                    => $id,
            'is_active'             => 1,
            'is_locked'             => 1,
        ];
        $this->user_model->update($data);
        $this->session->set_flashdata('message', 'User Telah di Aktifkan');
        redirect($_SERVER['HTTP_REFERER']);
    }
    // Banned Acount
    public function banned($id)
    {
        is_login();
        $data = [
            'id'                    => $id,
            'is_active'             => 0,
        ];
        $this->user_model->update($data);
        $this->session->set_flashdata('message', 'User Telah di banned');
        redirect($_SERVER['HTTP_REFERER']);
    }
    // Saldo Manual
    public function saldo($id)
    {

        $counter = $this->user_model->detail($id);

        $data = [
            'title'                 => 'Saldo Counter',
            'counter'               => $counter,
            'content'               => 'admin/counter/saldo'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function tambah_saldo($id)
    {
        $user_type = $this->session->userdata('id');
        $counter = $this->user_model->detail($id);
        $counter_id = $counter->id;

        $this->form_validation->set_rules(
            'keterangan',
            'Keterangan',
            'required',
            array(
                'required'                        => '%s Harus Diisi',
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Saldo Counter',
                'counter'               => $counter,
                'content'               => 'admin/counter/saldo'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {


            $pemasukan               = $this->input->post('pemasukan');
            $fix_pemasukan          = preg_replace('/\D/', '', $pemasukan);

            // $pemasukan = $this->input->post('pemasukan');
            // $total_saldo = $counter->deposit_counter + $pemasukan;
            $total_saldo = (int)$counter->deposit_counter + (int)$fix_pemasukan;

            $code_topup = date('dmY') . strtoupper(random_string('alnum', 5));
            $keterangan = $this->input->post('keterangan');

            $data  = [
                'user_id'                   => $id,
                'pemasukan'                 => $fix_pemasukan,
                'keterangan'                => $keterangan . ' - ' . $code_topup,
                'transaksi'                 => 0,
                'asuransi'                  => 0,
                'pengeluaran'               => 0,
                'total_saldo'               => $total_saldo,
                'user_type'                 => $user_type,
                'date_created'              => date('Y-m-d H:i:s')
            ];
            $this->saldo_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            $this->update_saldo_counter($total_saldo, $counter_id);
            $this->topup_manual($id, $keterangan, $code_topup, $fix_pemasukan);
            redirect(base_url('admin/counter'), 'refresh');
        }
    }
    public function topup_manual($id, $keterangan, $code_topup, $fix_pemasukan)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);

        $data  = [
            'user_id'                   => $id,
            'code_topup'                => $code_topup,
            'nominal'                   => $fix_pemasukan,
            'keterangan'                => $keterangan,
            'status_bayar'              => 'Success',
            'topup_reason'              => 'TopUp Manual by ' . $user->name,
            'user_proccess'             => $this->session->userdata('id'),
            'status_read'               => 0,
            'date_created'              => date('Y-m-d H:i:s')
        ];
        $this->topup_model->create($data);
    }

    public function potong_saldo($id)
    {

        $user_type = $this->session->userdata('id');
        $counter = $this->user_model->detail($id);
        $counter_id = $counter->id;

        $this->form_validation->set_rules(
            'keterangan',
            'Keterangan',
            'required',
            array(
                'required'                        => '%s Harus Diisi',
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Saldo Counter',
                'counter'               => $counter,
                'content'               => 'admin/counter/saldo'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $pengeluaran               = $this->input->post('pengeluaran');
            $fix_pengeluaran          = preg_replace('/\D/', '', $pengeluaran);

            // $pengeluaran = $this->input->post('pengeluaran');
            $total_saldo = (int)$counter->deposit_counter - (int)$fix_pengeluaran;

            $data  = [
                'user_id'                   => $id,
                'pemasukan'                 => 0,
                'keterangan'                => $this->input->post('keterangan'),
                'transaksi'                 => 0,
                'asuransi'                  => 0,
                'pengeluaran'               => $fix_pengeluaran,
                'total_saldo'               => $total_saldo,
                'user_type'                 => $user_type,
                'date_created'              => date('Y-m-d H:i:s')
            ];
            $this->saldo_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            $this->update_saldo_counter($total_saldo, $counter_id);
            redirect(base_url('admin/counter'), 'refresh');
        }
    }

    public function update_saldo_counter($total_saldo, $counter_id)
    {
        $data = [
            'id'                => $counter_id,
            'deposit_counter'   => $total_saldo,

        ];
        $this->user_model->update($data);
    }
}
