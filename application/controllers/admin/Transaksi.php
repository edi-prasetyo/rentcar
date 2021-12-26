<?php
defined('BASEPATH') or exit('No direct script access allowed');

class transaksi extends CI_Controller
{
  //load data
  public function __construct()
  {
    parent::__construct();
    $this->load->library('pagination');
    $this->load->model('transaksi_model');
    $this->load->model('main_model');
    $this->load->model('bank_model');
    $this->load->model('meta_model');
  }

  //INDEX TRANSAKSI BELUM DI AMBIL ************************************************************************************/
  public function index()
  {

    $config['base_url']         = base_url('admin/transaksi/index/');
    $config['total_rows']       = count($this->transaksi_model->total_row());
    $config['per_page']         = 10;
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
    $transaksi = $this->transaksi_model->get_transaksi($limit, $start);

    $data = [
      'title'                 => 'Data Transaksi',
      'transaksi'             => $transaksi,
      'pagination'            => $this->pagination->create_links(),
      'content'               => 'admin/transaksi/index_transaksi'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  //END INDEX TRANSAKSI BELUM DI AMBIL ************************************************************************************/

  //INDEX TRANSAKSI PROSES ***********************************************************************************************/
  public function proses()
  {

    $config['base_url']         = base_url('admin/transaksi/proses/index/');
    $config['total_rows']       = count($this->transaksi_model->total_row_proses());
    $config['per_page']         = 10;
    $config['uri_segment']      = 5;
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
    $start                      = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
    $this->pagination->initialize($config);
    $transaksi = $this->transaksi_model->get_transaksi_proses($limit, $start);
    $data = [
      'title'                 => 'Data Transaksi',
      'transaksi'             => $transaksi,
      'pagination'            => $this->pagination->create_links(),
      'content'               => 'admin/transaksi/proses_transaksi'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  //END INDEX TRANSAKSI PROSES *******************************************************************************************/

  //INDEX TRANSAKSI SELESAI ***********************************************************************************************/
  public function selesai()
  {

    $main_agen = $this->user_model->get_allcounter();
    $config['base_url']         = base_url('admin/transaksi/selesai/index/');
    $config['total_rows']       = count($this->transaksi_model->total_row_selesai());
    $config['per_page']         = 10;
    $config['uri_segment']      = 5;
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
    $start                      = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
    $this->pagination->initialize($config);
    $transaksi = $this->transaksi_model->get_transaksi_selesai($limit, $start);
    $data = [
      'title'                 => 'Data Transaksi',
      'transaksi'             => $transaksi,
      'main_agen'             => $main_agen,
      'pagination'            => $this->pagination->create_links(),
      'content'               => 'admin/transaksi/selesai_transaksi'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  //END INDEX TRANSAKSI SELESAI *******************************************************************************************/

  //INDEX TRANSAKSI BATAL ***********************************************************************************************/
  public function batal()
  {
    $main_agen = $this->user_model->get_allcounter();
    $config['base_url']         = base_url('admin/transaksi/batal/index/');
    $config['total_rows']       = count($this->transaksi_model->total_row_batal());
    $config['per_page']         = 10;
    $config['uri_segment']      = 5;
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
    $start                      = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
    $this->pagination->initialize($config);
    $transaksi = $this->transaksi_model->get_transaksi_batal($limit, $start);
    $data = [
      'title'                 => 'Data Transaksi',
      'transaksi'             => $transaksi,
      'main_agen'             => $main_agen,
      'pagination'            => $this->pagination->create_links(),
      'content'               => 'admin/transaksi/batal_transaksi'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  //END INDEX TRANSAKSI BATAL *******************************************************************************************/

  public function cari($rowno = 0)
  {
    $main_agen = $this->user_model->get_allcounter();
    // Search text
    $search_text = "";
    if ($this->input->post('submit') != NULL) {
      $search_text = $this->input->post('search');
      $this->session->set_userdata(array("search" => $search_text));
    } else {
      if ($this->session->userdata('search') != NULL) {
        $search_text = $this->session->userdata('search');
      }
    }
    // Row per page
    $rowperpage = 10;
    // Row position
    if ($rowno != 0) {
      $rowno = ($rowno - 1) * $rowperpage;
    }

    // All records count
    $allcount = $this->transaksi_model->getrecordCount_admin($search_text);

    // Get records
    $result = $this->transaksi_model->getData_admin($rowno, $rowperpage, $search_text);

    // Pagination Configuration
    $config['base_url'] = base_url() . 'admin/transaksi/cari';
    $config['use_page_numbers'] = TRUE;
    $config['total_rows'] = $allcount;
    $config['per_page'] = $rowperpage;

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

    // Initialize
    $this->pagination->initialize($config);

    // $data['pagination'] = $this->pagination->create_links();
    // $data['result'] = $users_record;
    // $data['row'] = $rowno;
    // $data['search'] = $search_text;
    // var_dump($result);
    // die;

    $data = [
      'title'             => 'Transaksi',
      'deskripsi'         => 'Pencarian',
      'keywords'          => 'Pencarian',
      'pagination'        => $this->pagination->create_links(),
      'transaksi'         => $result,
      'row'               => $rowno,
      'search'            => $search_text,
      'main_agen'         => $main_agen,
      'content'           => 'admin/transaksi/cari_transaksi'

    ];
    // Load view
    $this->load->view('admin/layout/wrapp', $data);
  }

  public function detail($id)
  {
    $transaksi = $this->transaksi_model->detail($id);
    $bank       = $this->bank_model->get_allbank();
    // var_dump($transaksi);
    // die;
    $data = [
      'title'                 => 'Detail Transaksi',
      'transaksi'             => $transaksi,
      'bank'                  => $bank,
      'content'               => 'admin/transaksi/detail'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
    $this->update_satus_read($id);
  }
  public function update_satus_read($id)
  {

    $transaksi = $this->transaksi_model->detail($id);
    //End Hapus Gambar
    $data = [
      'id'               => $transaksi->id,
      'status_read'     => 1,
    ];
    $this->transaksi_model->update($data);
  }
  public function invoice($id)
  {
    $transaksi = $this->transaksi_model->detail($id);
    $bank       = $this->bank_model->get_allbank();
    $meta = $this->meta_model->get_meta();
    // var_dump($transaksi);
    // die;
    $data = [
      'title'                 => 'Detail Transaksi',
      'transaksi'             => $transaksi,
      'bank'                  => $bank,
      'meta'                  => $meta,
      // 'content'               => 'admin/transaksi/invoice'
    ];
    $this->load->view('admin/transaksi/invoice', $data, FALSE);
  }

  //delete
  public function delete($id)
  {
    //Proteksi delete
    is_login();
    $transaksi = $this->transaksi_model->product_detail($id);
    //Hapus gambar
    if ($transaksi->product_img != "") {
      unlink('./assets/img/product/' . $transaksi->product_img);
      // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
    }
    //End Hapus Gambar
    $data = ['id'               => $transaksi->id];
    $this->transaksi_model->delete($data);
    $this->session->set_flashdata('message', 'Data telah di Hapus');
    redirect($_SERVER['HTTP_REFERER']);
  }


  // Cancel Transaksi
  public function cancel($id)
  {
    // $user = $this->session->userdata('id');
    $transaksi = $this->transaksi_model->detail($id);
    if ($transaksi->stage == 1) {
      //Proteksi delete
      is_login();
      $data = [
        'id'                        => $id,
        'stage'                     => 10,
      ];
      $this->transaksi_model->update($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable fade show" > Data Telah di Batalkan <button class="close" data-dismiss="alert" aria-label="Close">×</button></div>');
      redirect(base_url('admin/transaksi'), 'refresh');
    } else {
      redirect('admin/404');
    }
  }

  public function select_alldriver($id)
  {
    $transaksi = $this->transaksi_model->detail($id);
    $kota_id = $transaksi->kota_id;
    $driver = $this->user_model->pilih_driver($kota_id);

    var_dump(
      $driver->id
    );
    die;

    $transaksi_id = $id; // Ambil data nis dan masukkan ke variabel nis
    $driver_id = $driver->id; // Ambil data nama dan masukkan ke variabel nama
    $status = 0; // Ambil data telp dan masukkan ke variabel telp
    $create_by = $this->session->userdata('id'); // Ambil data alamat dan masukkan ke variabel alamat

    $data = array();


    $index = 0; // Set index array awal dengan 0
    foreach ($transaksi as $transaksi) { // Kita buat perulangan berdasarkan nis sampai data terakhir
      array_push($data, array(
        'transaksi_id' => $transaksi->id,
        'driver_id' => $driver_id[$index],  // Ambil dan set data nama sesuai index array dari $index
        'status' => 0, [$index],  // Ambil dan set data telepon sesuai index array dari $index
        'create_by' => $create_by[$index],  // Ambil dan set data alamat sesuai index array dari $index
      ));

      $index++;
    }


    $sql = $this->transaksi_model->save_batch($data);
    if ($sql) { // Jika sukses
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable fade show" > Data Berhasil Di input <button class="close" data-dismiss="alert" aria-label="Close">×</button></div>');
      redirect(base_url('admin/transaksi'), 'refresh');
    } else { // Jika gagal
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable fade show" > Data Telah di Batalkan <button class="close" data-dismiss="alert" aria-label="Close">×</button></div>');
      redirect(base_url('admin/transaksi'), 'refresh');
    }
  }
  public function pilih_driver($id)
  {
    $transaksi = $this->transaksi_model->detail($id);
    $kota_id = $transaksi->kota_id;
    $driver = $this->user_model->pilih_driver($kota_id);
    $this->form_validation->set_rules(
      'driver_id',
      'Driver ID',
      'required',
      array(
        'required'                        => '%s Harus Diisi',
      )
    );
    if ($this->form_validation->run() === FALSE) {
      $data = [
        'title'                 => 'Pilih Driver',
        'transaksi'             => $transaksi,
        'driver'                => $driver,
        'content'               => 'admin/transaksi/pilih_driver'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    } else {
      $driver_id = $this->input->post('driver_id');
      $data  = [
        'id'                      => $id,
        'stage'                   => 2,
        'status'                  => 'Dikonfirmasi',
        'driver_id'               => $driver_id,
      ];
      $this->transaksi_model->update($data);
      $this->driver_name($id);
      $this->session->set_flashdata('message', 'Driver telah di update');
      redirect(base_url('admin/transaksi'), 'refresh');
    }
  }
  public function driver_name($id)
  {
    $transaksi = $this->transaksi_model->detail($id);
    $user_id = $transaksi->driver_id;
    $user = $this->user_model->user_detail($user_id);
    $driver_name = $user->name;
    $data  = [
      'id'                            => $id,
      'driver_name'                   => $driver_name,
    ];
    $this->transaksi_model->update($data);
    $this->session->set_flashdata('message', 'Driver telah di update');
    redirect(base_url('admin/transaksi'), 'refresh');
  }
}
