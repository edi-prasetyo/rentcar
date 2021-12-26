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
            'content'               => 'admin/profile/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Update Data
    public function update()
    {

        $id       = $this->session->userdata('id');
        $profile = $this->user_model->detail($id);

        //Validasi
        $valid = $this->form_validation;
        $valid->set_rules(
            'name',
            'Nama',
            'required',
            ['required'                         => '%s harus diisi']
        );
        if ($valid->run()) {
            //Kalau nggak Ganti gambar
            if (!empty($_FILES['user_image']['name'])) {
                $config['upload_path']            = './assets/img/avatars/';
                $config['allowed_types']          = 'gif|jpg|png|jpeg';
                $config['max_size']               = 50000000; //Dalam Kilobyte
                $config['max_width']              = 50000000; //Lebar (pixel)
                $config['max_height']             = 50000000; //tinggi (pixel)
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('user_image')) {
                    //End Validasi
                    $data = [
                        'title'                       => 'Update Profile',
                        'profile'                       => $profile,
                        'error_upload'                => $this->upload->display_errors(),
                        'content'                     => 'admin/profile/update'
                    ];
                    $this->load->view('admin/layout/wrapp', $data, FALSE);
                    //Masuk Database
                } else {
                    //Proses Manipulasi Gambar
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Gambar Asli disimpan di folder assets/upload/image
                    //lalu gambar Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs
                    $config['image_library']        = 'gd2';
                    $config['source_image']         = './assets/img/avatars/' . $upload_data['uploads']['file_name'];
                    //Gambar Versi Kecil dipindahkan
                    // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']         = TRUE;
                    $config['maintain_ratio']       = TRUE;
                    $config['width']                = 70;
                    $config['height']               = 70;
                    $config['thumb_marker']         = '';
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    // Hapus Gambar Lama Jika Ada upload gambar baru
                    if ($profile->user_image != "") {
                        unlink('./assets/img/avatars/' . $profile->user_image);
                        // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
                    }
                    //End Hapus Gambar

                    $data  = [
                        'id'                            => $id,
                        'name'                          => $this->input->post('name'),
                        'user_address'                          => $this->input->post('user_address'),
                        'user_phone'                          => $this->input->post('user_phone'),
                        'user_image'                   => $upload_data['uploads']['file_name'],
                        'date_updated'                  => date('Y-m-d H:i:s')
                    ];
                    $this->user_model->update($data);
                    $this->session->set_flashdata('message', 'Data telah di Update');
                    redirect(base_url('admin/profile'), 'refresh');
                }
            } else {
                //Update Berita Tanpa Ganti Gambar
                // Hapus Gambar Lama Jika ada upload gambar baru

                if ($profile->user_image != "")
                    $data  = [
                        'id'                                => $id,
                        'name'                              => $this->input->post('name'),
                        'user_address'                          => $this->input->post('user_address'),
                        'user_phone'                          => $this->input->post('user_phone'),
                        'date_updated'                      => date('Y-m-d H:i:s')
                    ];
                $this->user_model->update($data);
                $this->session->set_flashdata('message', 'Data telah di Update');
                redirect(base_url('admin/profile'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'                               => 'Update Profile',
            'profile'                            => $profile,
            'content'                             => 'admin/profile/update'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
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
                'title'       => 'Ubah Password',
                'profile'        => $profile,
                'content'     => 'admin/profile/password'
            );
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'id'                => $id,
                'password'          => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', 'Password telah di Update');
            redirect(base_url('admin/profile'), 'refresh');
        }
    }
}
