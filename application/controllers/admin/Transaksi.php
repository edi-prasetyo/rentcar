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
    $this->load->model('point_model');
    $this->load->model('pengaturan_model');
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
    $transaksi_driver = $this->transaksi_model->transaksi_detail_driver($id);
    $bank       = $this->bank_model->get_allbank();

    // var_dump($transaksi);
    // die;
    $data = [
      'title'                 => 'Detail Transaksi',
      'transaksi'             => $transaksi,
      'transaksi_driver'      => $transaksi_driver,
      'bank'                  => $bank,
      'content'               => 'admin/transaksi/detail'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
    $this->update_satus_read($id);
  }

  function mypdf($id)
  {
    $transaksi = $this->transaksi_model->detail($id);
    $data = [
      'transaksi'             => $transaksi
    ];
    // $this->load->view('admin/transaksi/mypdf', $data);

    $this->load->library('pdf');

    $this->pdf->load_view('admin/transaksi/mypdf', $data);
    $this->pdf->render();
    ob_end_clean();
    $this->pdf->stream("welcome.pdf");
    exit;
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
        'cancel_by'                 => $this->session->userdata('id'),
        'stage'                     => 6,
      ];
      $this->transaksi_model->update($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable fade show" > Data Telah di Batalkan <button class="close" data-dismiss="alert" aria-label="Close">×</button></div>');
      redirect($_SERVER['HTTP_REFERER']);
    } else {
      redirect('admin/404');
    }
  }


  // Sampai Ke tujuan
  public function finish($id)
  {
    $transaksi = $this->transaksi_model->detail($id);
    $driver_id = $transaksi->driver_id;
    is_login();
    $data = [
      'id'                => $id,
      'stage'             => 4,
      'status_pembayaran' => 'Lunas'
    ];
    $this->transaksi_model->update($data);
    $this->selesai_order($id);
    $this->update_status_driver($driver_id);
    if ($transaksi->user_id == null) {
    } else {
      $this->add_point_customer($id);
    }

    $this->_sendEmail($id);
    $this->session->set_flashdata('message', 'Anda telah Menyelesaikan Order');
    redirect($_SERVER['HTTP_REFERER']);
  }
  public function add_point_customer($id)
  {
    $date           = date("Y-m-d");
    $transaksi = $this->transaksi_model->transaksi_detail($id);
    $data = [
      'user_id'       => $transaksi->user_id,
      'product_id'    => $transaksi->product_id,
      'order_id'      => $transaksi->order_id,
      'nominal_point' => $transaksi->order_point,
      'point_status'  => 1,
      'expired'       => date("Y-m-d", strtotime("$date +3 month"))
    ];
    $this->point_model->create($data);
  }
  public function selesai_order($id)
  {
    is_login();
    $data = [
      'id'                  => $id,
      'status'              => 'Selesai',
    ];
    $this->transaksi_model->update($data);
  }

  public function update_status_driver($driver_id)
  {
    $data = [
      'id'                => $driver_id,
      'status'             => 0,
    ];
    $this->user_model->update($data);
  }

  private function _sendEmail($id)
  {
    $email_order = $this->pengaturan_model->email_order();
    $transaksi  = $this->transaksi_model->transaksi_detail($id);
    $meta = $this->meta_model->get_meta();

    $config = [
      'protocol'     => "$email_order->protocol",
      'smtp_host'   => "$email_order->smtp_host",
      'smtp_port'   => $email_order->smtp_port,
      'smtp_user'   => "$email_order->smtp_user",
      'smtp_pass'   => "$email_order->smtp_pass",
      'mailtype'     => 'html',
      'charset'     => 'utf-8',
    ];

    $this->load->library('email', $config);
    $this->email->initialize($config);
    $this->email->set_newline("\r\n");
    $this->email->from("$email_order->smtp_user", ' INVOICE ', "$meta->title");
    $this->email->to($this->input->post('passenger_email'));
    $this->email->cc("$email_order->cc_email");
    $this->email->bcc("$email_order->bcc_email");

    $this->email->subject('INVOICE ' . $meta->title . '' . $transaksi->kode_transaksi . '');
    $this->email->message('
    



    <!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <title>

    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        #outlook a {
            padding: 0;
        }
        .ReadMsgBody {
            width: 100%;
        }
        .ExternalClass {
            width: 100%;
        }
        .ExternalClass * {
            line-height: 100%;
        }
        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            border-collapse: collapse;
        }
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }
        p {
            display: block;
            margin: 13px 0;
        }
    </style>
    <style type="text/css">
        @media only screen and (max-width:480px) {
            @-ms-viewport {
                width: 320px;
            }
            @viewport {
                width: 320px;
            }
        }
    </style>
    <style type="text/css">
        @media only screen and (min-width:480px) {
            .mj-column-per-100 {
                width: 100% !important;
            }
        }
    </style>
    <style type="text/css">
    </style>
</head>
<body style="background-color:#f9f9f9;">
    <div style="background-color:#f9f9f9;">
        <div style="background:#f9f9f9;background-color:#f9f9f9;Margin:0px auto;max-width:600px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#f9f9f9;background-color:#f9f9f9;width:100%;">
                <tbody>
                    <tr>
                        <td style="border-bottom:#333957 solid 5px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
               
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="background:#fff;background-color:#fff;Margin:0px auto;max-width:600px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#fff;background-color:#fff;width:100%;">
                <tbody>
                    <tr>
                        <td style="border:#dddddd solid 1px;border-top:0px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                            <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">
                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:bottom;" width="100%">
                                    <tr>
                                        <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width:64px;">
                                                            <img height="auto" src="' . base_url('assets/img/logo/' . $meta->logo) . '" style="border:0;display:block;outline:none;text-decoration:none;width:100%;" width="64" />
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                            <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:24px;font-weight:bold;line-height:22px;text-align:center;color:#525252;">
                                                INVOICE<br>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                            <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:14px;line-height:22px;text-align:left;color:#525252;">
                                                <span style="float:left;">
                                                    <b>Customer</b> <br>
                                                    Nama   : " ' . $transaksi->passenger_name . ' "<br>
                                                No. Hp : ' . $transaksi->passenger_phone . ' <br>
                                                Email  : ' . $transaksi->passenger_email . '<br>
                                                    
                                                </span>
                                                <span style="float:right;text-align: right;">
                                                    Tanggal : "' . $transaksi->created_at . '"<br>
                                                    Order ID : "' . $transaksi->order_id . '"<br>
                                                    Status Pembayaran : "' . $transaksi->status_pembayaran . '"
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                  
                                    <tr>
                                        <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                            <table 0="[object Object]" 1="[object Object]" 2="[object Object]" border="0" style="color:#000;font-family:Helvetica Neue,Arial,sans-serif;font-size:13px;line-height:22px;table-layout:auto;width:100%;">
                                                <tr style="border-bottom:1px solid #ecedee;text-align:left;">
                                                    <th style="padding: 0 15px 10px 0;">Produk</th>
                                                    <th style="padding: 0 15px;">Durasi</th>
                                                    <th style="padding: 0 0 0 15px;" align="right">Harga</th>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 5px 15px 5px 0;">
                                                    "' . $transaksi->mobil_name . '"
                                                    <br>"' . $transaksi->paket_name . '", Jakarta</td>
                                                    <td style="padding: 0 15px;">"' . $transaksi->lama_sewa . '" Hari</td>
                                                    <td style="padding: 0 0 0 15px;" align="right">Rp. "' . $transaksi->start_price . '"</td>
                                                </tr>
                                               
                                                <tr style="border-bottom:2px solid #ecedee;text-align:left;padding:15px 0;">
                                                    <td style="padding: 0 15px 5px 0;">Diskon Point</td>
                                                    <td style="padding: 0 15px;"></td>
                                                    <td style="padding: 0 0 0 15px;" align="right">"' . $transaksi->diskon_point . '"</td>
                                                </tr>
                                                <tr style="border-bottom:2px solid #ecedee;text-align:left;padding:15px 0;">
                                                    <td style="padding: 5px 15px 5px 0; font-weight:bold">TOTAL</td>
                                                    <td style="padding: 0 15px;"></td>
                                                    <td style="padding: 0 0 0 15px; font-weight:bold" align="right">Rp. "' . $transaksi->grand_total . '"</td>
                                                </tr>
                                            </table>

                                        </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">

                                            <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:14px;line-height:20px;text-align:left;color:#525252;">
                                                Terima Kasih,<br><br><br>
                                                Admin<br>
                                                <br>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>



        ');

    if ($this->email->send()) {
      return true;
    } //else {
    //     echo $this->email->print_debugger();
    //     die;
    // }
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
    // $kota_id = $transaksi->kota_id;
    $driver = $this->user_model->pilih_driver();



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
      $saldo_driver = $this->user_model->detail_driver($driver_id);

      if ($saldo_driver->saldo_driver <= 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning">Saldo Driver Tidak Mencukupi</div>');
        redirect(base_url('admin/transaksi/pilih_driver/' . $id), 'refresh');
      } else {
        $data  = [
          'id'                      => $id,
          'stage'                   => 2,
          'status'                  => 2,
          'driver_id'               => $driver_id,
        ];
        $this->transaksi_model->update($data);
        $this->driver_name($id);
        $this->session->set_flashdata('message', 'Driver telah di update');
        redirect(base_url('admin/transaksi'), 'refresh');
      }
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
