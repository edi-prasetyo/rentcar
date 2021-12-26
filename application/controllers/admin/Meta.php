<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meta extends CI_Controller
{
  //Load Data Konfigurasi
  public function __construct()
  {
    parent::__construct();
    $this->load->model('meta_model');
  }
  public function index()
  {
    $meta                       = $this->meta_model->get_meta();
    $data                       = [
      'title'                   => 'Profile Web',
      'meta'                    => $meta,
      'content'                 => 'admin/meta/index_meta'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  public function update($id)
  {
    $meta = $this->meta_model->detail_meta($id);
    $this->form_validation->set_rules(
      'title',
      'Judul Web',
      'required',
      array('required'            => '%s Harus Diisi')
    );
    if ($this->form_validation->run() === FALSE) {
      $data = [
        'title'                   => 'Update Profile Web',
        'meta'                    => $meta,
        'content'                 => 'admin/meta/update_meta'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    } else {
      $data = [
        'id'                      => $meta->id,
        'user_id'                 => $this->session->userdata('id'),
        'title'                   => $this->input->post('title'),
        'tagline'                 => $this->input->post('tagline'),
        'description'             => $this->input->post('description'),
        'keywords'                => $this->input->post('keywords'),
        'google_meta'             => $this->input->post('google_meta'),
        'bing_meta'               => $this->input->post('bing_meta'),
        'google_analytics'        => $this->input->post('google_analytics'),
        'google_tag'              => $this->input->post('google_tag'),
        'email'                   => $this->input->post('email'),
        'telepon'                 => $this->input->post('telepon'),
        'whatsapp'                => $this->input->post('whatsapp'),
        'alamat'                  => $this->input->post('alamat'),
        'link'                    => $this->input->post('link'),
        'map'                     => $this->input->post('map'),
        'facebook'                => $this->input->post('facebook'),
        'instagram'               => $this->input->post('instagram'),
        'youtube'                 => $this->input->post('youtube'),
        'twitter'                 => $this->input->post('twitter'),
        'date_updated'            => date('Y-m-d H:i:s')
      ];
      $this->meta_model->update($data);
      $this->session->set_flashdata('message', 'Data telah di ubah');
      redirect(base_url('admin/meta'), 'refresh');
    }
  }
  public function logo()
  {
    $meta = $this->meta_model->get_meta();
    //Validasi
    $this->form_validation->set_rules(
      'id',
      'Nama Perusahaan',
      'required',
      array('required'              => '%s Harus Diisi')
    );
    if ($this->form_validation->run()) {
      $config['upload_path']        = './assets/img/logo/';
      $config['allowed_types']      = 'gif|jpg|png|jpeg|svg';
      $config['max_size']           = 500000000; //Dalam Kilobyte
      $config['max_width']          = 500000000; //Lebar (pixel)
      $config['max_height']         = 500000000; //tinggi (pixel)
      $config['remove_spaces']            = TRUE;
      $config['encrypt_name']             = TRUE;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('logo')) {
        //End Validasi
        $data = [
          'title'                   => 'Update Logo',
          'meta'                    => $meta,
          'error'                   => $this->upload->display_errors(),
          'content'                 => 'admin/meta/upload_logo'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
        //Masuk Database
      } else {
        //Proses Manipulasi Gambar
        $upload_data    = array('uploads'  => $this->upload->data());
        //Gambar Asli disimpan di folder assets/upload/image
        //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs
        $config['image_library']    = 'gd2';
        $config['source_image']     = './assets/img/logo/' . $upload_data['uploads']['file_name'];
        //Gambar Versi Kecil dipindahkan
        $config['new_image']        = './assets/img/logo/thumbs/' . $upload_data['uploads']['file_name'];
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['width']            = 500;
        $config['height']           = 500;
        $config['thumb_marker']     = '';
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        // Hapus Gambar Lama Jika Ada upload gambar baru
        if ($meta->logo != "") {
          unlink('./assets/img/logo/' . $meta->logo);
          unlink('./assets/img/logo/thumbs/' . $meta->logo);
        }
        $data  = [
          'id'                      => $meta->id,
          'user_id'                 => $this->session->userdata('id'),
          'logo'                    => $upload_data['uploads']['file_name']
        ];
        $this->meta_model->update($data);
        $this->session->set_flashdata('message', 'Data telah diubah');
        redirect(base_url('admin/meta'), 'refresh');
      }
    }
    //End Masuk Database
    $data = [
      'title'                       => 'Logo Website',
      'meta'                        => $meta,
      'content'                     => 'admin/meta/upload_logo'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  public function favicon()
  {
    $meta = $this->meta_model->get_meta();
    //Validasi
    $this->form_validation->set_rules(
      'id',
      'Nama Perusahaan',
      'required',
      array('required'              => '%s Harus Diisi')
    );
    if ($this->form_validation->run()) {

      $config['upload_path']         = './assets/img/logo/';
      $config['allowed_types']       = 'gif|jpg|png|jpeg|svg';
      $config['max_size']            = 500000000; //Dalam Kilobyte
      $config['max_width']           = 500000000; //Lebar (pixel)
      $config['max_height']          = 500000000; //tinggi (pixel)
      $config['remove_spaces']            = TRUE;
      $config['encrypt_name']             = TRUE;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('favicon')) {
        //End Validasi
        $data = [
          'title'                     => 'Update Favicon',
          'meta'                      => $meta,
          'error'                     => $this->upload->display_errors(),
          'content'                   => 'admin/meta/upload_favicon'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
        //Masuk Database
      } else {
        //Proses Manipulasi Gambar
        $upload_data    = array('uploads'  => $this->upload->data());
        //Gambar Asli disimpan di folder assets/upload/image
        //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs
        $config['image_library']      = 'gd2';
        $config['source_image']       = './assets/img/logo/' . $upload_data['uploads']['file_name'];
        //Gambar Versi Kecil dipindahkan
        $config['new_image']          = './assets/img/logo/thumbs/' . $upload_data['uploads']['file_name'];
        $config['create_thumb']       = TRUE;
        $config['maintain_ratio']     = TRUE;
        $config['width']              = 200;
        $config['height']             = 200;
        $config['thumb_marker']       = '';
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        // Hapus Gambar Lama Jika Ada upload gambar baru
        if ($meta->favicon != "") {
          unlink('./assets/img/logo/' . $meta->favicon);
          unlink('./assets/img/logo/thumbs/' . $meta->favicon);
        }
        $data  = [
          'id'                        => $meta->id,
          'user_id'                   => $this->session->userdata('id'),
          'favicon'                   => $upload_data['uploads']['file_name']
        ];
        $this->meta_model->update($data);
        $this->session->set_flashdata('message', 'Data telah diubah');
        redirect(base_url('admin/meta'), 'refresh');
      }
    }
    //End Masuk Database
    $data = [
      'title'                         => 'Favicon Website',
      'meta'                          => $meta,
      'content'                       => 'admin/meta/upload_favicon'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
}
