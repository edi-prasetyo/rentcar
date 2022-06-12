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
        $this->load->model('saldo_model');
        $this->load->model('topup_model');
        $this->load->model('kota_model');
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
        $driver = $this->user_model->get_allkurir($limit, $start, $search);
        // var_dump($driver);
        // die;

        $data = [
            'title'                 => 'Data Driver',
            'driver'             => $driver,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/driver/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    // Create Driver
    public function create()
    {
        $listkota = $this->kota_model->get_allkota();
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
                'listkota'      => $listkota,
                'content'       => 'admin/driver/create'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $email = $this->input->post('email', true);
            $user_code = random_int(1000, 9999);

            $user_phone = $this->input->post('user_phone');
            $phone = str_replace(' ', '', $user_phone);
            $phone = str_replace('-', '', $user_phone);

            // Ubah 0 menjadi 62
            // kadang ada penulisan no hp 0811 239 345
            $phone = str_replace(" ", "", $phone);
            // kadang ada penulisan no hp (0274) 778787
            $phone = str_replace("(", "", $phone);
            // kadang ada penulisan no hp (0274) 778787
            $phone = str_replace(")", "", $phone);
            // kadang ada penulisan no hp 0811.239.345
            $phone = str_replace(".", "", $phone);

            // cek apakah no hp mengandung karakter + dan 0-9
            if (!preg_match('/[^+0-9]/', trim($phone))) {
                // cek apakah no hp karakter 1-3 adalah +62
                if (substr(trim($phone), 0, 3) == '62') {
                    $hp = trim($phone);
                }
                // cek apakah no hp karakter 1 adalah 0
                elseif (substr(trim($phone), 0, 1) == '0') {
                    $hp = '62' . substr(trim($phone), 1);
                }
            }


            $data = [
                'user_create'   => $this->session->userdata('id'),
                'user_title'    => $this->input->post('user_title'),
                'name'          => htmlspecialchars($this->input->post('name', true)),
                'email'         => htmlspecialchars($email),
                'user_code'     => $user_code,
                'user_phone'    => $hp,
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
    // Update Driver
    public function update($id)
    {
        $driver = $this->user_model->detail_driver($id);
        // var_dump($driver);
        // die;
        $listkota = $this->kota_model->get_allkota();
        $this->form_validation->set_rules(
            'name',
            'Nama',
            'required|trim',
            ['required' => 'nama harus di isi']
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
                'listkota'      => $listkota,
                'driver'        => $driver,
                'content'       => 'admin/driver/update'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $email = $this->input->post('email', true);
            $user_code = random_int(1000, 9999);

            $user_phone = $this->input->post('user_phone');
            $phone = str_replace(' ', '', $user_phone);
            $phone = str_replace('-', '', $user_phone);

            // Ubah 0 menjadi 62
            // kadang ada penulisan no hp 0811 239 345
            $phone = str_replace(" ", "", $phone);
            // kadang ada penulisan no hp (0274) 778787
            $phone = str_replace("(", "", $phone);
            // kadang ada penulisan no hp (0274) 778787
            $phone = str_replace(")", "", $phone);
            // kadang ada penulisan no hp 0811.239.345
            $phone = str_replace(".", "", $phone);

            // cek apakah no hp mengandung karakter + dan 0-9
            if (!preg_match('/[^+0-9]/', trim($phone))) {
                // cek apakah no hp karakter 1-3 adalah +62
                if (substr(trim($phone), 0, 3) == '62') {
                    $hp = trim($phone);
                }
                // cek apakah no hp karakter 1 adalah 0
                elseif (substr(trim($phone), 0, 1) == '0') {
                    $hp = '62' . substr(trim($phone), 1);
                }
            }
            $data = [
                'id'             => $id,
                'name'          => htmlspecialchars($this->input->post('name', true)),
                'email'         => htmlspecialchars($email),
                'user_phone'    => $hp,
                'user_address'  => $this->input->post('user_address'),
                'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id'       => 5,
                'is_active'     => 1,
                'is_locked'     => 1,
                'date_updated'  => date('Y-m-d H:i:s')
            ];
            $this->db->update('user', $data);
            $this->session->set_flashdata('message', 'Selamat Anda berhasil mendaftar, silahkan Aktivasi akun');
            redirect('admin/driver');
        }
    }
    // Detail Main Agen
    public function detail($id)
    {

        $driver = $this->user_model->detail($id);
        $data = [
            'title'                 => 'Detail Driver',
            'driver'                => $driver,
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

        $driver = $this->user_model->detail($id);

        $data = [
            'title'                 => 'Saldo Driver',
            'driver'               => $driver,
            'content'               => 'admin/driver/saldo'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function tambah_saldo($id)
    {
        $user_type = $this->session->userdata('id');
        $driver = $this->user_model->detail($id);
        $driver_id = $driver->id;

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
                'driver'               => $driver,
                'content'               => 'admin/driver/saldo'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {


            $pemasukan               = $this->input->post('pemasukan');
            $fix_pemasukan          = preg_replace('/\D/', '', $pemasukan);

            // $pemasukan = $this->input->post('pemasukan');
            // $total_saldo = $driver->saldo_driver + $pemasukan;
            $total_saldo = (int)$driver->saldo_driver + (int)$fix_pemasukan;

            $code_topup = date('dmY') . strtoupper(random_string('alnum', 5));
            $keterangan = $this->input->post('keterangan');

            $data  = [
                'user_id'                   => $id,
                'pemasukan'                 => $fix_pemasukan,
                'keterangan'                => $code_topup,
                'reason'                    => $keterangan,
                'transaksi'                 => 0,
                'pengeluaran'               => 0,
                'total_saldo'               => $total_saldo,
                'user_type'                 => $user_type,
                'date_created'              => date('Y-m-d H:i:s')
            ];
            $this->saldo_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            $this->update_saldo_driver($total_saldo, $driver_id);
            $this->topup_manual($id, $keterangan, $code_topup, $fix_pemasukan);
            redirect(base_url('admin/driver'), 'refresh');
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
        $driver = $this->user_model->detail($id);
        $driver_id = $driver->id;

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
                'driver'               => $driver,
                'content'               => 'admin/driver/saldo'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $pengeluaran               = $this->input->post('pengeluaran');
            $fix_pengeluaran          = preg_replace('/\D/', '', $pengeluaran);

            // $pengeluaran = $this->input->post('pengeluaran');
            $total_saldo = (int)$driver->saldo_driver - (int)$fix_pengeluaran;

            $data  = [
                'user_id'                   => $id,
                'pemasukan'                 => 0,
                'keterangan'                => 'top up manual',
                'reason'                    => $this->input->post('keterangan'),
                'transaksi'                 => 0,
                'pengeluaran'               => $fix_pengeluaran,
                'total_saldo'               => $total_saldo,
                'user_type'                 => $user_type,
                'date_created'              => date('Y-m-d H:i:s')
            ];
            $this->saldo_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            $this->update_saldo_driver($total_saldo, $driver_id);
            redirect(base_url('admin/driver'), 'refresh');
        }
    }

    public function update_saldo_driver($total_saldo, $driver_id)
    {
        $data = [
            'id'                => $driver_id,
            'saldo_driver'   => $total_saldo,

        ];
        $this->user_model->update($data);
    }
}
