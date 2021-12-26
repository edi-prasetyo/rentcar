<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('main_model');
    }

    public function index()
    {
        $user_id       = $this->session->userdata('id');
        $profile = $this->user_model->user_detail($user_id);
        $data = [
            'title'                 => 'Profile Saya',
            'profile'               => $profile,
            'content'               => 'driver/profile/index'
        ];
        $this->load->view('driver/layout/wrapp', $data, FALSE);
    }

    // Change Password
    public function password()
    {
        $id = $this->session->userdata('id');
        $profile = $this->user_model->detail($id);

        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'required'      => 'Password harus Di isi',
                'matches'         => 'Password tidak sama',
                'min_length'     => 'Password Min 3 karakter'
            ]
        );
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            // End Listing Berita dengan paginasi
            $data = array(
                'title'             => 'Ubah Password',
                'profile'           => $profile,
                'content'           => 'driver/profile/password'
            );
            $this->load->view('driver/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'id'                => $id,
                'password'          => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Password telah di Update</div>');
            redirect(base_url('driver/profile'), 'refresh');
        }
    }
}
