<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Myaccount extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('pengaturan_model');
        $this->load->model('kota_model');
        $this->load->model('daily_model');
        $this->load->model('mobil_model');
        $this->load->model('user_model');
        $this->load->model('point_model');
        $this->load->model('bank_model');

        $user_id = $this->session->userdata('id');
        if ($user_id == null) {
            redirect('auth');
        }
    }
    public function index()
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->detail($user_id);
        $total_pointku = $this->point_model->total_user_point($user_id);

        if (!$this->agent->is_mobile()) {
            // Desktop View
            $data = [
                'title'         => 'My Account',
                'user'          => $user,
                'total_pointku' => $total_pointku,
                'content'       => 'front/myaccount/index'
            ];
            $this->load->view('front/layout/wrapp', $data);
        } else {
            // Mobile View
            $data = [
                'title'         => 'My Account',
                'user'          => $user,
                'total_pointku' => $total_pointku,
                'content'       => 'mobile/myaccount/index'
            ];
            $this->load->view('mobile/layout/wrapp', $data);
        }
    }
    public function point()
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->detail($user_id);
        $point = $this->point_model->user_point($user_id);
        $total_pointku = $this->point_model->total_user_point($user_id);
        if (!$this->agent->is_mobile()) {
            // Desktop View
            $data = [
                'title'         => 'My Point',
                'user'          => $user,
                'point'         => $point,
                'total_pointku'   => $total_pointku,
                'content'       => 'front/myaccount/point'
            ];
            $this->load->view('front/layout/wrapp', $data);
        } else {
            // Mobile View
            $data = [
                'title'         => 'My Point',
                'user'          => $user,
                'point'         => $point,
                'total_pointku'   => $total_pointku,
                'content'       => 'mobile/myaccount/point'
            ];
            $this->load->view('mobile/layout/wrapp', $data);
        }
    }
    public function transaksi()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->detail($id);

        $config['base_url']         = base_url('myaccount/transaksi/index/');
        $config['total_rows']       = count($this->transaksi_model->total_row());
        $config['per_page']         = 5;
        $config['uri_segment']      = 4;
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
        $limit                      = $config['per_page'];
        $start                      = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
        $this->pagination->initialize($config);

        $transaksi_saya = $this->transaksi_model->get_mytransaksi($id, $limit, $start);

        if (!$this->agent->is_mobile()) {
            // Desktop View
            $data = [
                'title'                 => 'My Transaction',
                'user'                  => $user,
                'transaksi_saya'        => $transaksi_saya,
                'pagination'            => $this->pagination->create_links(),
                'content'               => 'front/myaccount/transaksi'
            ];
            $this->load->view('front/layout/wrapp', $data);
        } else {
            $data = [
                'title'                 => 'My Transaction',
                'user'                  => $user,
                'transaksi_saya'        => $transaksi_saya,
                'pagination'            => $this->pagination->create_links(),
                'content'               => 'mobile/myaccount/transaksi'
            ];
            $this->load->view('mobile/layout/wrapp', $data);
        }
    }

    public function detail_transaksi($id)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->detail($user_id);
        $detail_transaksi_saya = $this->transaksi_model->detail_transaksi_saya($user_id, $id);
        $transaksi_driver = $this->transaksi_model->transaksi_detail_drivermyaccount($id);

        $bank = $this->bank_model->get_allbank();

        if (!$this->agent->is_mobile()) {
            // Desktop View
            $data = [
                'title'                 => 'Detail Transaksi',
                'user'                  => $user,
                'detail_transaksi'      => $detail_transaksi_saya,
                'transaksi_driver'      => $transaksi_driver,
                'bank'                  => $bank,
                'pagination'            => $this->pagination->create_links(),
                'content'               => 'front/myaccount/detail_transaksi'
            ];
            $this->load->view('front/layout/wrapp', $data);
        } else {
            // Mobile View
            $data = [
                'title'                 => 'Detail Transaksi',
                'user'                  => $user,
                'detail_transaksi'      => $detail_transaksi_saya,
                'transaksi_driver'      => $transaksi_driver,
                'bank'                  => $bank,
                'pagination'            => $this->pagination->create_links(),
                'content'               => 'mobile/myaccount/detail_transaksi'
            ];
            $this->load->view('mobile/layout/wrapp', $data);
        }
    }
    // Update Profile
    public function update_profile()
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->detail($user_id);
        // var_dump($user);
        // die;
        $this->form_validation->set_rules(
            'name',
            'Nama',
            'required',
            array('required'                  => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            //End Validasi
            if (!$this->agent->is_mobile()) {
                // Desktop View
                $data = [
                    'title'                         => 'Edit Profile',
                    'user'                          => $user,
                    'content'                       => 'front/myaccount/update'
                ];
                $this->load->view('front/layout/wrapp', $data, FALSE);
                //Masuk Database
            } else {
                $data = [
                    'title'                         => 'Edit Profile',
                    'user'                          => $user,
                    'content'                       => 'mobile/myaccount/update'
                ];
                $this->load->view('mobile/layout/wrapp', $data, FALSE);
            }
        } else {
            $data  = [
                'id'                            => $user_id,
                'name'                          => $this->input->post('name'),
                'email'                         => $this->input->post('email'),
                'user_phone'                    => $this->input->post('user_phone'),
                'user_address'                  => $this->input->post('user_address'),
                'date_updated'                  => date('Y-m-d H:i:s')
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di Update');
            redirect(base_url('myaccount/index'), 'refresh');
        }
    }
    // Update Password
    public function update_password()
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->detail($user_id);
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
            if (!$this->agent->is_mobile()) {
                // Desktop View
                $data = [
                    'title'         => 'Update Password',
                    'user'          => $user,
                    'content'       => 'front/myaccount/update_password'
                ];
                $this->load->view('front/layout/wrapp', $data, FALSE);
            } else {
                $data = [
                    'title'         => 'Update Password',
                    'user'          => $user,
                    'content'       => 'mobile/myaccount/update_password'
                ];
                $this->load->view('mobile/layout/wrapp', $data, FALSE);
            }
        } else {
            $data = [
                'id'                => $user_id,
                'password'          => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', 'Data Berhasil di Update');
            redirect('myaccount/index');
        }
    }
}
