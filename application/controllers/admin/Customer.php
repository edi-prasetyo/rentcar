<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('user_model');
        $this->load->model('main_model');
        $this->load->model('saldo_model');
        $this->load->model('topup_model');
        $this->load->model('point_model');
    }
    public function index()
    {


        $search             = $this->input->post('search');
        $search_email       = $this->input->post('search_email');
        $search_kota        = $this->input->post('search_kota');


        $config['base_url']         = base_url('admin/customer/index/');
        $config['total_rows']       = count($this->user_model->total_row_customer($search, $search_email, $search_kota));
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
        $customer = $this->user_model->get_customer($limit, $start, $search, $search_email, $search_kota);
        $point = $this->point_model->all();

        // var_dump($customer);
        // die;

        $data = [
            'title'                 => 'Data Customer',
            'customer'               => $customer,
            // 'user_point'            => $user_point,
            'point'                 => $point,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/customer/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    public function index_point()
    {


        $search             = $this->input->post('search');
        $search_email       = $this->input->post('search_email');
        $search_kota        = $this->input->post('search_kota');


        $config['base_url']         = base_url('admin/customer/index_point/');
        $config['total_rows']       = count($this->user_model->total_row_customer($search, $search_email, $search_kota));
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
        $customer_point = $this->user_model->get_customer_point($limit, $start, $search, $search_email, $search_kota);

        // var_dump($customer);
        // die;

        $data = [
            'title'                 => 'Data Customer',
            'customer_point'               => $customer_point,
            // 'user_point'            => $user_point,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/customer/index_point'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    // Create
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
                'title'         => 'Add Customer',
                'content'       => 'admin/customer/create'
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
                'role_id'       => 6,
                'is_active'     => 0,
                'is_locked'     => 0,
                'date_created'  => date('Y-m-d H:i:s')
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', 'Selamat Anda berhasil mendaftar, silahkan Aktivasi akun');
            redirect('admin/customer');
        }
    }
    // Update
    public function update($id)
    {
        $user = $this->user_model->detail($id);
        $this->form_validation->set_rules(
            'name',
            'Nama',
            'required|trim',
            ['required' => 'nama harus di isi']
        );
        if ($this->form_validation->run() == false) {
            $data = [
                'title'         => 'Update Customer',
                'user'          => $user,
                'content'       => 'admin/customer/update'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $data = [
                'id'            => $id,
                'name'          => htmlspecialchars($this->input->post('name', true)),
                'user_phone'    => $this->input->post('user_phone'),
                'user_address'  => $this->input->post('user_address'),
                'email'         => $this->input->post('email'),
                'date_updated'  => date('Y-m-d H:i:s')
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', 'Data Berhasil di Update');
            redirect('admin/customer');
        }
    }
    // Update Password
    public function update_password($id)
    {
        $user = $this->user_model->detail($id);
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
                'title'         => 'Update Password',
                'user'          => $user,
                'content'       => 'admin/customer/update_password'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'id'                => $id,
                'password'          => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', 'Data Berhasil di Update');
            redirect('admin/customer');
        }
    }
    // Detail Customer
    public function detail($id)
    {

        $customer = $this->user_model->detail($id);

        $data = [
            'title'                 => 'Detail Customer',
            'customer'               => $customer,
            'content'               => 'admin/customer/detail'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function point($id)
    {
        $customer = $this->user_model->detail($id);
        $user_id = $customer->id;
        $customer_point = $this->point_model->total_user_point($user_id);
        // var_dump($customer_point);
        // die;

        $data = [
            'title'                 => 'Point Customer',
            'customer'        => $customer_point,
            'content'               => 'admin/customer/point'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    public function laporan_saldo($id)
    {
        $customer = $this->user_model->detail($id);
        $user_id = $customer->id;
        // var_dump($customer->email);
        // die;

        $config['base_url']         = base_url('admin/customer/laporan_saldo/' . $id . '/index');
        $config['total_rows']       = count($this->saldo_model->get_row_saldo_customer($user_id));
        $config['per_page']         = 10;
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
        $saldo_customer = $this->saldo_model->get_saldo_customer($user_id, $limit, $start);
        // var_dump($saldo_customer);
        // die;

        $data = [
            'title'                 => 'Laporan Saldo Customer ',
            'customer'               => $customer,
            'saldo_customer'         => $saldo_customer,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/customer/laporan'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    public function transaksi($id)
    {
        $search_kota                = $this->input->post('kota_tujuan');
        $resi                = $this->input->post('resi');
        // $search                     = $this->input->post('search');
        // $search_email               = $this->input->post('search_email');


        $customer = $this->user_model->detail($id);
        $user_id = $customer->id;
        // var_dump($customer->email);
        // die;

        $config['base_url']         = base_url('admin/customer/transaksi/' . $id . '/index');
        $config['total_rows']       = count($this->transaksi_model->get_row_saldo_customer($user_id, $search_kota, $resi));
        $config['per_page']         = 10;
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
        $transaksi_customer  = $this->transaksi_model->get_alltransaksi_customer($user_id, $limit, $start, $search_kota, $resi);
        $total_omset        = $this->transaksi_model->total_omset_transaksi_customer($user_id);
        // var_dump($saldo_customer);
        // die;

        $data = [
            'title'                 => 'Laporan Transaksi Customer ',
            'customer'               => $customer,
            'total_rows'            => $config['total_rows'],
            'total_omset'           => $total_omset,
            'transaksi_customer'         => $transaksi_customer,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/customer/transaksi'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    // Activated
    public function activated($id)
    {
        $user_detail =  $this->user_model->detail($id);
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
            'is_locked'             => 0,
        ];
        $this->user_model->update($data);
        $this->session->set_flashdata('message', 'User Telah di banned');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
