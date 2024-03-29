<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mobil extends CI_Controller
{
  //load data
  public function __construct()
  {
    parent::__construct();
    $this->load->model('mobil_model');
    $this->load->model('hourly_model');
    $this->load->model('daily_model');
    $this->load->model('kota_model');
    $this->load->model('dropoff_model');
    $this->load->model('airport_model');
    $this->load->model('ketentuan_model');
    $this->load->model('paket_model');
  }
  //listing data mobil
  public function index()
  {
    $mobil = $this->mobil_model->get_all();
    $data = array(
      'title'     => 'Data mobil (' . count($mobil) . ')',
      'mobil'     => $mobil,
      'content'       => 'admin/mobil/index_mobil'
    );
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }


  //Tambah mobil
  public function create()
  {

    //Validasi
    $valid = $this->form_validation;

    $valid->set_rules(
      'mobil_name',
      'Nama mobil',
      'required',
      array('required'      => '%s harus dicontent')
    );

    if ($valid->run()) {

      $config['upload_path']              = './assets/img/mobil/';
      $config['allowed_types']            = 'gif|jpg|png|jpeg|webp';
      $config['max_size']                 = 5000000000000; //Dalam Kilobyte
      $config['max_width']                = 5000000000000; //Lebar (pixel)
      $config['max_height']               = 5000000000000; //tinggi (pixel)
      $config['remove_spaces']            = TRUE;
      $config['encrypt_name']             = TRUE;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('mobil_gambar')) {

        //End Validasi
        $data = array(
          'title'         => 'Tambah mobil',
          'error_upload'  => $this->upload->display_errors(),
          'content'           => 'admin/mobil/create_mobil'
        );
        $this->load->view('admin/layout/wrapp', $data, FALSE);
        //Masuk Database

      } else {


        $upload_data    = array('uploads'  => $this->upload->data());
        $config['image_library']    = 'gd2';
        $config['source_image']     = './assets/img/mobil/' . $upload_data['uploads']['file_name'];
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['width']            = 300;
        $config['height']           = 300;
        $config['thumb_marker']     = '';
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();

        $slugcode = random_string('numeric', 5);
        $mobil_slug  = url_title($this->input->post('mobil_name'), 'dash', TRUE);
        $data  = array(
          'user_id'             => $this->session->userdata('id'),
          'merek_id'            => $this->input->post('merek_id'),
          'mobil_slug'          => $slugcode . '-' . $mobil_slug,
          'mobil_name'          => $this->input->post('mobil_name'),
          'mobil_desc'          => $this->input->post('mobil_desc'),
          'mobil_status'        => $this->input->post('mobil_status'),
          'mobil_penumpang'     => $this->input->post('mobil_penumpang'),
          'mobil_bagasi'        => $this->input->post('mobil_bagasi'),
          'mobil_transmisi'     => $this->input->post('mobil_transmisi'),
          'mobil_bbm'           => $this->input->post('mobil_bbm'),
          'mobil_tahun'         => $this->input->post('mobil_tahun'),
          'mobil_harga'         => $this->input->post('mobil_harga'),
          'mobil_gambar'        => $upload_data['uploads']['file_name'],
          'image_url'           => base_url('assets/img/mobil/' . $upload_data['uploads']['file_name']),
          'mobil_keywords'      => $this->input->post('mobil_keywords'),
          'date_created'        => date('Y-m-d H:i:s')
        );
        $this->mobil_model->create($data);
        $this->session->set_flashdata('sukses', 'Data telah ditambahkan');
        redirect(base_url('admin/mobil'), 'refresh');
      }
    }
    //End Masuk Database
    $data = array(
      'title'             => 'Tambah mobil',
      'content'           => 'admin/mobil/create_mobil'
    );
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  //Edit mobil
  public function update($id)
  {
    $mobil        = $this->mobil_model->detail_mobil($id);
    //Validasi
    $valid = $this->form_validation;

    $valid->set_rules(
      'mobil_name',
      'Nama mobil',
      'required',
      array('required'      => '%s harus di Isi')
    );


    if ($valid->run()) {
      //Kalau nggak Ganti gambar
      if (!empty($_FILES['mobil_gambar']['name'])) {

        $config['upload_path']          = './assets/img/mobil/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|webp';
        $config['max_size']             = 500000000000; //Dalam Kilobyte
        $config['max_width']            = 500000000000; //Lebar (pixel)
        $config['max_height']           = 500000000000; //tinggi (pixel)
        $config['remove_spaces']            = TRUE;
        $config['encrypt_name']             = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('mobil_gambar')) {

          //End Validasi
          $data = array(
            'title'         => 'Update Data mobil',
            'mobil'         => $mobil,
            'error_upload'  => $this->upload->display_errors(),
            'content'           => 'admin/mobil/update_mobil'
          );
          $this->load->view('admin/layout/wrapp', $data, FALSE);

          //Masuk Database

        } else {

          //Proses Manipulasi Gambar
          $upload_data    = array('uploads'  => $this->upload->data());
          //Gambar Asli dcontentmpan di folder assets/upload/Car
          //lalu gambar Asli di copy untuk versi mini size ke folder assets/upload/car/thumbs

          $config['image_library']    = 'gd2';
          $config['source_image']     = './assets/img/mobil/' . $upload_data['uploads']['file_name'];
          //Gambar Versi Kecil dipindahkan
          // $config['new_image']        = './assets/upload/car/thumbs/'.$upload_data['uploads']['file_name'];
          $config['create_thumb']     = TRUE;
          $config['maintain_ratio']   = TRUE;
          $config['width']            = 300;
          $config['height']           = 300;
          $config['thumb_marker']     = '';

          $this->load->library('image_lib', $config);

          $this->image_lib->resize();


          $i     = $this->input;

          // Hapus Gambar Lama Jika Ada upload gambar baru
          if ($mobil->mobil_gambar != "") {
            unlink('./assets/img/mobil/' . $mobil->mobil_gambar);
          }
          //End Hapus Gambar
          $data  = array(
            'id'                => $id,
            'user_id'           => $this->session->userdata('id'),
            'mobil_name'          => $i->post('mobil_name'),
            'mobil_desc'          => $i->post('mobil_desc'),
            'mobil_status'        => $i->post('mobil_status'),
            'mobil_penumpang'     => $i->post('mobil_penumpang'),
            'mobil_bagasi'        => $i->post('mobil_bagasi'),
            'mobil_transmisi'     => $i->post('mobil_transmisi'),
            'mobil_bbm'           => $i->post('mobil_bbm'),
            'mobil_tahun'         => $i->post('mobil_tahun'),
            'mobil_harga'         => $i->post('mobil_harga'),
            'mobil_gambar'        => $upload_data['uploads']['file_name'],
            'image_url'           => base_url('assets/img/mobil/' . $upload_data['uploads']['file_name']),
            'mobil_keywords'      => $i->post('mobil_keywords'),
            'date_updated'        => date('Y-m-d H:i:s')
          );
          $this->mobil_model->update($data);
          $this->session->set_flashdata('sukses', 'Data telah Diedit');
          redirect(base_url('admin/mobil'), 'refresh');
        }
      } else {
        //Update mobil Tanpa Ganti Gambar
        $i     = $this->input;
        // Hapus Gambar Lama Jika ada upload gambar baru
        if ($mobil->mobil_gambar != "")
          $data  = array(
            'id'                => $id,
            'user_id'           => $this->session->userdata('id'),
            'mobil_name'          => $i->post('mobil_name'),
            'mobil_desc'          => $i->post('mobil_desc'),
            'mobil_status'        => $i->post('mobil_status'),
            'mobil_penumpang'     => $i->post('mobil_penumpang'),
            'mobil_bagasi'        => $i->post('mobil_bagasi'),
            'mobil_transmisi'     => $i->post('mobil_transmisi'),
            'mobil_bbm'           => $i->post('mobil_bbm'),
            'mobil_tahun'         => $i->post('mobil_tahun'),
            'mobil_harga'         => $i->post('mobil_harga'),
            'mobil_keywords'      => $i->post('mobil_keywords'),
            'date_updated'        => time()
          );
        $this->mobil_model->update($data);
        $this->session->set_flashdata('sukses', 'Data telah Diedit');
        redirect(base_url('admin/mobil'), 'refresh');
      }
    }
    //End Masuk Database
    $data = array(
      'title'         => 'Edit mobil',
      'mobil'         => $mobil,
      'content'           => 'admin/mobil/update_mobil'
    );
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  //delete
  public function delete($mobil_id)
  {
    //Proteksi delete
    is_login();

    $mobil = $this->mobil_model->detail_mobil($mobil_id);
    //Hapus gambar
    if ($mobil->mobil_gambar != "") {
      unlink('./assets/img/mobil/' . $mobil->mobil_gambar);
    }
    //End Hapus Gambar
    $data = array('id'   => $mobil->id);
    $this->mobil_model->delete($data);
    $this->session->set_flashdata('sukses', 'Data telah di Hapus');
    redirect(base_url('admin/mobil'), 'refresh');
  }


  // Paket Per Jam
  public function hourly($mobil_id)
  {
    $kota       = $this->kota_model->get_allkota();

    $data = [
      'title'       => 'Paket Harian',
      'kota'        => $kota,
      'mobil_id'    => $mobil_id,
      'content'     => 'admin/hourly/index'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function create_hourly($mobil_id = false, $kota_id = false)
  {

    $mobil      = $this->mobil_model->detail_mobil($mobil_id);
    $kota       = $this->kota_model->detail($kota_id);
    $paket_hourly = $this->paket_model->paket_hourly($mobil_id, $kota_id);
    $ketentuan        = $this->ketentuan_model->get_ketentuan();

    // var_dump($kota->kota_name, $mobil->mobil_name);
    // die;


    $this->form_validation->set_rules(
      'paket_name',
      'Nama Paket',
      'required',
      [
        'required'                        => 'Nama Paket harus di isi',
      ]
    );
    if ($this->form_validation->run() == false) {

      //End Validasi
      $data = [
        'title'                         => 'Tambah Paket ' . $mobil->mobil_name,
        'kota'                          => $kota,
        'mobil'                         => $mobil,
        'paket_hourly'                  => $paket_hourly,
        'ketentuan'                     => $ketentuan,
        'content'                       => 'admin/hourly/create'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
      //Masuk Database
    } else {
      $data  = [
        'mobil_id'                      => $mobil->id,
        'kota_id'                       => $kota->id,
        'ketentuan_id'                        => $this->input->post('ketentuan_id'),
        'paket_name'                          => $this->input->post('paket_name'),
        'paket_type'                          => 'Hourly',
        'paket_price'                         => $this->input->post('paket_price'),
        'paket_point'                         => $this->input->post('paket_point'),
        'paket_status'                        => $this->input->post('paket_status'),
        'paket_desc'                          => $this->input->post('paket_desc'),
        'created_at'                  => date('Y-m-d H:i:s')
      ];
      $this->paket_model->create($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success">Data Produk telah ditambahkan</div>');
      redirect($_SERVER['HTTP_REFERER']);
    }

    //End Masuk Database
    $data = [
      'title'                             => 'Tambah Paket ' . $mobil->mobil_name,
      'mobil'                             => $mobil,
      'ketentuan'                     => $ketentuan,
      'content'                           => 'admin/daily/create'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  // Paket Harian
  public function daily($mobil_id)
  {
    $kota       = $this->kota_model->get_allkota();
    $mobil      = $this->mobil_model->detail_mobil($mobil_id);
    $data = [
      'title'       => 'Paket Harian',
      'kota'        => $kota,
      'mobil_id'    => $mobil_id,
      'mobil'       => $mobil,
      'content'     => 'admin/daily/index'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function create_daily($mobil_id = false, $kota_id = false)
  {

    $mobil            = $this->mobil_model->detail_mobil($mobil_id);
    $kota             = $this->kota_model->detail($kota_id);
    $paket_daily      = $this->paket_model->paket_daily($mobil_id, $kota_id);
    $ketentuan        = $this->ketentuan_model->get_ketentuan();
    // var_dump($kota->id, $mobil->id);
    // die;


    $this->form_validation->set_rules(
      'paket_price',
      'Harga Paket',
      'required',
      [
        'required'                        => 'Harga Paket harus di isi',
      ]
    );
    if ($this->form_validation->run() == false) {

      //End Validasi
      $data = [
        'title'                         => 'Tambah Paket ' . $mobil->mobil_name,
        'kota'                          => $kota,
        'mobil'                         => $mobil,
        'ketentuan'                     => $ketentuan,
        'paket_daily'                   => $paket_daily,
        'content'                       => 'admin/daily/create'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
      //Masuk Database
    } else {
      $data  = [
        'mobil_id'                            => $mobil->id,
        'kota_id'                             => $kota->id,
        'ketentuan_id'                        => $this->input->post('ketentuan_id'),
        'paket_name'                          => $this->input->post('paket_name'),
        'paket_type'                          => 'Daily',
        'paket_price'                         => $this->input->post('paket_price'),
        'paket_point'                         => $this->input->post('paket_point'),
        'paket_status'                        => $this->input->post('paket_status'),
        'paket_desc'                          => $this->input->post('paket_desc'),
        'created_at'                          => date('Y-m-d H:i:s')
      ];
      $this->paket_model->create($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success">Data Produk telah ditambahkan</div>');
      redirect($_SERVER['HTTP_REFERER']);
    }

    //End Masuk Database
    $data = [
      'title'                             => 'Tambah Paket ' . $mobil->mobil_name,
      'mobil'                             => $mobil,
      'ketentuan'                         => $ketentuan,
      'content'                           => 'admin/daily/create'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  public function delete_paket($id)
  {

    $paket = $this->paket_model->detail_paket($id);
    //End Hapus Gambar
    $data = array('id'   => $paket->id);
    $this->paket_model->delete($data);
    $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');

    redirect($_SERVER['HTTP_REFERER']);
  }

  public function update_paket($id)
  {
    $paket = $this->paket_model->detail_paket($id);
    $this->form_validation->set_rules(
      'paket_price',
      'Harga Paket',
      'required',
      [
        'required'                        => 'Nama Paket harus di isi',
      ]
    );
    if ($this->form_validation->run() == false) {

      //End Validasi
      $data = [
        'title'                         => 'Update Paket ',
        'paket'                         => $paket,
        'content'                       => 'admin/daily/update_paket'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
      //Masuk Database
    } else {
      $data  = [
        'id'                                  => $id,
        'paket_name'                         => $this->input->post('paket_name'),
        'paket_price'                         => $this->input->post('paket_price'),
        'paket_point'                         => $this->input->post('paket_point'),
        'paket_desc'                          => $this->input->post('paket_desc'),
        'updated_at'                          => date('Y-m-d H:i:s')
      ];
      $this->paket_model->update($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah diubah</div>');
      redirect($_SERVER['HTTP_REFERER']);
    }
  }

  // Drop Off
  public function dropoff($mobil_id)
  {
    $kota       = $this->kota_model->get_allkota();
    $mobil      = $this->mobil_model->detail_mobil($mobil_id);
    $paket_dropoff = $this->dropoff_model->paket_dropoff($mobil_id);
    $data = [
      'title'       => 'Paket dropoff',
      // 'kota'        => $kota,
      'paket_dropoff' => $paket_dropoff,
      'mobil_id'    => $mobil_id,
      'mobil'       => $mobil,
      'kota'        => $kota,
      'content'     => 'admin/dropoff/index'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function create_dropoff($mobil_id = false, $kota_id = false)
  {

    $mobil            = $this->mobil_model->detail_mobil($mobil_id);
    $listkota         = $this->kota_model->get_allkota();
    $kota             = $this->kota_model->detail($kota_id);
    $dropoff          = $this->dropoff_model->dropoff_mobil($mobil_id, $kota_id);
    $ketentuan        = $this->ketentuan_model->get_ketentuan();

    // var_dump($kota->id, $mobil->id);
    // die;


    $this->form_validation->set_rules(
      'paket_price',
      'Harga Paket',
      'required',
      [
        'required'                        => 'Harga Paket harus di isi',
      ]
    );
    if ($this->form_validation->run() == false) {

      //End Validasi
      $data = [
        'title'                         => 'Tambah Paket ' . $mobil->mobil_name,
        'listkota'                      => $listkota,
        'kota'                          => $kota,
        'mobil'                         => $mobil,
        'ketentuan'                     => $ketentuan,
        'dropoff'                       => $dropoff,
        'content'                       => 'admin/dropoff/create'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
      //Masuk Database
    } else {

      $kota_asal = $kota->id;
      $kota_tujuan = $this->input->post('kota_tujuan');

      $data  = [
        'mobil_id'                            => $mobil->id,
        'kota_asal'                           => $kota_asal,
        'kota_tujuan'                         => $kota_tujuan,
        'ketentuan_id'                        => $this->input->post('paket_name'),
        'ketentuan_id'                        => $this->input->post('ketentuan_id'),
        'paket_type'                          => 'Drop Off',
        'paket_price'                         => $this->input->post('paket_price'),
        'paket_point'                         => $this->input->post('paket_point'),
        'paket_status'                        => $this->input->post('paket_status'),
        'paket_desc'                          => $this->input->post('paket_desc'),
        'created_at'                          => date('Y-m-d H:i:s')
      ];
      $insert_id = $this->dropoff_model->create($data);
      $this->update_nama_kota($kota_asal, $kota_tujuan, $insert_id);
      $this->session->set_flashdata('message', '<div class="alert alert-success">Data Produk telah ditambahkan</div>');
      redirect(base_url('admin/mobil/create_dropoff/' . $mobil_id . '/' . $kota_id), 'refresh');
    }

    //End Masuk Database
    $data = [
      'title'                             => 'Tambah Paket ' . $mobil->mobil_name,
      'kota'                              => $kota,
      'mobil'                             => $mobil,
      'ketentuan'                         => $ketentuan,
      'content'                           => 'admin/dropoff/create'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function update_paket_dropoff($id)
  {
    $paket = $this->dropoff_model->detail_paket($id);
    $this->form_validation->set_rules(
      'paket_price',
      'Harga Paket',
      'required',
      [
        'required'                        => 'Nama Paket harus di isi',
      ]
    );
    if ($this->form_validation->run() == false) {

      //End Validasi
      $data = [
        'title'                         => 'Update Paket ',
        'paket'                         => $paket,
        'content'                       => 'admin/dropoff/update_paket'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
      //Masuk Database
    } else {
      $data  = [
        'id'                                  => $id,
        'paket_name'                         => $this->input->post('paket_name'),
        'paket_price'                         => $this->input->post('paket_price'),
        'paket_point'                         => $this->input->post('paket_point'),
        'paket_desc'                          => $this->input->post('paket_desc'),
        'updated_at'                          => date('Y-m-d H:i:s')
      ];
      $this->dropoff_model->update($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah diubah</div>');
      redirect($_SERVER['HTTP_REFERER']);
    }
  }


  public function update_nama_kota($kota_asal, $kota_tujuan, $insert_id)
  {
    $kota_asal = $this->kota_model->get_kota_asal($kota_asal);
    $kota_tujuan = $this->kota_model->get_kota_tujuan($kota_tujuan);

    $data  = [
      'id'                                  => $insert_id,
      'kota_asal_name'                         => $kota_asal->kota_name,
      'kota_tujuan_name'                         => $kota_tujuan->kota_name,
      'paket_name'                    => $kota_asal->kota_name . '-' . $kota_tujuan->kota_name,
      'updated_at'                          => date('Y-m-d H:i:s')
    ];
    $this->dropoff_model->update($data);
  }
  public function delete_dropoff($id)
  {
    //Proteksi delete
    is_login();

    $paket = $this->dropoff_model->detail_paket($id);
    // var_dump($paket);
    // die;
    //End Hapus Gambar
    $data = array('id'   => $paket->id);
    $this->dropoff_model->delete($data);
    $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');
    redirect($_SERVER['HTTP_REFERER']);
  }

  // Drop Off
  public function airport($mobil_id)
  {
    // $kota         = $this->kota_model->get_allkota();
    $airport       = $this->airport_model->get_allairport();
    $mobil      = $this->mobil_model->detail_mobil($mobil_id);
    $paket_airport = $this->airport_model->paket_airport($mobil_id);
    $data = [
      'title'       => 'Paket Airport',
      // 'kota'        => $kota,
      'paket_airport' => $paket_airport,
      'mobil_id'    => $mobil_id,
      'mobil'       => $mobil,
      'airport'        => $airport,
      'content'     => 'admin/airport/index_airport'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function create_airport($mobil_id = false, $airport_id = false)
  {

    $mobil            = $this->mobil_model->detail_mobil($mobil_id);
    $listkota         = $this->kota_model->get_allkota();
    $airport          = $this->airport_model->detail($airport_id);

    $paket_airport    = $this->airport_model->airport_mobil($mobil_id, $airport_id);
    $ketentuan        = $this->ketentuan_model->get_ketentuan();

    // var_dump($paket_airport);
    // die;


    $this->form_validation->set_rules(
      'paket_price',
      'Harga Paket',
      'required',
      [
        'required'                        => 'Harga Paket harus di isi',
      ]
    );
    if ($this->form_validation->run() == false) {

      //End Validasi
      $data = [
        'title'                         => 'Tambah Paket ' . $mobil->mobil_name,
        'listkota'                      => $listkota,
        'airport'                          => $airport,
        'mobil'                         => $mobil,
        'ketentuan'                     => $ketentuan,
        'paket_airport'                       => $paket_airport,
        'content'                       => 'admin/airport/create_airport'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
      //Masuk Database
    } else {

      $kota_tujuan = $this->input->post('kota_tujuan');

      $data  = [
        'mobil_id'                            => $mobil->id,
        'kota_id'                           => $this->input->post('kota_id'),
        'airport_id'                           => $airport_id,
        'kota_tujuan'                             => $kota_tujuan,
        'ketentuan_id'                        => $this->input->post('ketentuan_id'),
        'paket_type'                          => 'Airport',
        'paket_name'                          => $this->input->post('paket_name'),
        'paket_price'                         => $this->input->post('paket_price'),
        'paket_point'                         => $this->input->post('paket_point'),
        'paket_status'                        => $this->input->post('paket_status'),
        'paket_desc'                          => $this->input->post('paket_desc'),
        'created_at'                          => date('Y-m-d H:i:s')
      ];
      $this->airport_model->create_paket($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success">Data Produk telah ditambahkan</div>');
      redirect(base_url('admin/mobil/create_airport/' . $mobil_id . '/' . $airport_id), 'refresh');
    }

    //End Masuk Database
    $data = [
      'title'                             => 'Tambah Paket ' . $mobil->mobil_name,
      'airport'                              => $airport,
      'mobil'                             => $mobil,
      'ketentuan'                         => $ketentuan,
      'content'                           => 'admin/airport/create_airport'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function update_paket_airport($id)
  {
    $paket = $this->paket_model->detail_paket($id);
    $this->form_validation->set_rules(
      'paket_price',
      'Harga Paket',
      'required',
      [
        'required'                        => 'Nama Paket harus di isi',
      ]
    );
    if ($this->form_validation->run() == false) {

      //End Validasi
      $data = [
        'title'                         => 'Update Paket ',
        'paket'                         => $paket,
        'content'                       => 'admin/airport/update_paket'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
      //Masuk Database
    } else {
      $data  = [
        'id'                                  => $id,
        'paket_name'                         => $this->input->post('paket_name'),
        'paket_price'                         => $this->input->post('paket_price'),
        'paket_point'                         => $this->input->post('paket_point'),
        'paket_desc'                          => $this->input->post('paket_desc'),
        'updated_at'                          => date('Y-m-d H:i:s')
      ];
      $this->airport_model->update_paket($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah diubah</div>');
      redirect($_SERVER['HTTP_REFERER']);
    }
  }

  public function delete_airport($id)
  {
    //Proteksi delete
    is_login();

    $paket = $this->airport_model->detail_paket($id);
    //End Hapus Gambar
    $data = array('id'   => $paket->id);
    $this->airport_model->delete_paket($data);
    $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');
    redirect($_SERVER['HTTP_REFERER']);
  }
}
