<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo extends CI_Controller
{
  //load data
  public function __construct()
  {
    parent::__construct();
    $this->load->model('promo_model');
    $this->load->model('category_model');
    $this->load->library('pagination');
  }
  //listing data promo
  public function index()
  {
    $config['base_url']         = base_url('admin/promo/index/');
    $config['total_rows']       = count($this->promo_model->total_row());
    $config['per_page']         = 5;
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
    $promo = $this->promo_model->get_promo($limit, $start);
    $data = [
      'title'                   => 'Data Promo',
      'promo'                  => $promo,
      'pagination'              => $this->pagination->create_links(),
      'content'                 => 'admin/promo/index_promo'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  //Create New Promo
  public function create()
  {
    $category = $this->category_model->get_category();
    $this->form_validation->set_rules(
      'name',
      'Nama Promo',
      'required',
      [
        'required'              => 'Judul Promo harus di isi',
      ]
    );

    if ($this->form_validation->run()) {

      $config['upload_path']     = './assets/img/promo/';
      $config['allowed_types']   = 'gif|jpg|png|jpeg';
      $config['max_size']        = 50000000; //Dalam Kilobyte
      $config['max_width']       = 50000000; //Lebar (pixel)
      $config['max_height']      = 50000000; //tinggi (pixel)
      $config['remove_spaces']            = TRUE;
      $config['encrypt_name']             = TRUE;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('image')) {
        //End Validasi
        $data = [
          'title'                 => 'Tambah Promo',
          'error_upload'          => $this->upload->display_errors(),
          'content'               => 'admin/promo/create_promo'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
        //Masuk Database
      } else {
        $upload_data    = array('uploads'  => $this->upload->data());

        $config['image_library']    = 'gd2';
        $config['source_image']     = './assets/img/promo/' . $upload_data['uploads']['file_name'];
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['width']            = 1000;
        $config['height']           = 1000;
        $config['thumb_marker']     = '';
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $slugcode = random_string('numeric', 5);
        $promo_slug  = url_title($this->input->post('name'), 'dash', TRUE);
        $data  = [
          'promo_slug'            => $slugcode . '-' . $promo_slug,
          'name'                  => $this->input->post('name'),
          'description'           => $this->input->post('description'),
          'image'                 => $upload_data['uploads']['file_name'],
          'image_url'             => base_url('assets/img/promo/' . $upload_data['uploads']['file_name']),
          'is_active'             => $this->input->post('is_active'),
          'price'                 => $this->input->post('price'),
          'expired_at'            => $this->input->post('expired_at'),
          'created_at'            => date('Y-m-d H:i:s'),
        ];
        $this->promo_model->create($data);
        $this->session->set_flashdata('message', 'Data Promo telah ditambahkan');
        redirect(base_url('admin/promo'), 'refresh');
      }
    }
    //End Masuk Database
    $data = [
      'title'                       => 'Tambah Promo',
      'content'                     => 'admin/promo/create_promo'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  //Edit Promo
  public function Update($id)
  {
    $promo = $this->promo_model->promo_detail($id);
    //Validasi
    $category = $this->category_model->get_category();
    //Validasi
    $valid = $this->form_validation;
    $valid->set_rules(
      'name',
      'Nama Promo',
      'required',
      ['required'                   => '%s harus diisi']
    );

    if ($valid->run()) {
      //Kalau nggak Ganti gambar
      if (!empty($_FILES['image']['name'])) {

        $config['upload_path']       = './assets/img/promo/';
        $config['allowed_types']     = 'gif|jpg|png|jpeg';
        $config['max_size']          = 5000000; //Dalam Kilobyte
        $config['max_width']         = 5000000; //Lebar (pixel)
        $config['max_height']        = 5000000; //tinggi (pixel)
        $config['remove_spaces']            = TRUE;
        $config['encrypt_name']             = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')) {
          //End Validasi
          $data = [
            'title'                   => 'Edit Promo',
            'category'                => $category,
            'promo'                  => $promo,
            'error_upload'            => $this->upload->display_errors(),
            'content'                 => 'admin/promo/update_promo'
          ];
          $this->load->view('admin/layout/wrapp', $data, FALSE);
          //Masuk Database
        } else {
          //Proses Manipulasi Gambar
          $upload_data    = array('uploads'  => $this->upload->data());
          $config['image_library']    = 'gd2';
          $config['source_image']     = './assets/img/promo/' . $upload_data['uploads']['file_name'];
          $config['create_thumb']     = TRUE;
          $config['maintain_ratio']   = TRUE;
          $config['width']            = 1000;
          $config['height']           = 1000;
          $config['thumb_marker']     = '';
          $this->load->library('image_lib', $config);
          $this->image_lib->resize();
          // Hapus Gambar Lama Jika Ada upload gambar baru
          if ($promo->image != "") {
            unlink('./assets/img/promo/' . $promo->image);
            // unlink('./assets/img/promo/thumbs/' . $promo->image);
          }
          //End Hapus Gambar
          $data  = [
            'id'                      => $id,
            'name'            => $this->input->post('name'),
            'description'             => $this->input->post('description'),
            'image'                   => $upload_data['uploads']['file_name'],
            'image_url'               => base_url('assets/img/promo/' . $upload_data['uploads']['file_name']),
            'is_active'             => $this->input->post('is_active'),
            'price'                 => $this->input->post('price'),
            'expired_at'            => $this->input->post('expired_at'),
            'updated_at'            => date('Y-m-d H:i:s'),
          ];
          $this->promo_model->update($data);
          $this->session->set_flashdata('message', 'Data telah di Update');
          redirect(base_url('admin/promo'), 'refresh');
        }
      } else {
        //Update Promo Tanpa Ganti Gambar
        // Hapus Gambar Lama Jika ada upload gambar baru
        if ($promo->image != "")
          $data  = [
            'id'                      => $id,
            'name'            => $this->input->post('name'),
            'description'             => $this->input->post('description'),

            'is_active'             => $this->input->post('is_active'),
            'price'                 => $this->input->post('price'),
            'expired_at'            => $this->input->post('expired_at'),
            'updated_at'            => date('Y-m-d H:i:s'),
          ];
        $this->promo_model->update($data);
        $this->session->set_flashdata('message', 'Data telah di Update');
        redirect(base_url('admin/promo'), 'refresh');
      }
    }
    //End Masuk Database
    $data = [
      'title'                         => 'Update Promo',
      'category'                      => $category,
      'promo'                        => $promo,
      'content'                       => 'admin/promo/update_promo'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  //delete
  public function delete($id)
  {
    //Proteksi delete
    is_login();
    $promo = $this->promo_model->promo_detail($id);
    //Hapus gambar
    if ($promo->image != "") {
      unlink('./assets/img/promo/' . $promo->image);
      // unlink('./assets/img/promo/thumbs/' . $promo->image);
    }
    //End Hapus Gambar
    $data = ['id'                   => $promo->id];
    $this->promo_model->delete($data);
    $this->session->set_flashdata('message', 'Data telah di Hapus');
    redirect($_SERVER['HTTP_REFERER']);
  }
}
