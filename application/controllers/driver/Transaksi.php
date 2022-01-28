<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('string');
        $this->load->model('meta_model');
        $this->load->model('main_model');
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('persentase_model');
        $this->load->model('user_model');
        $this->load->model('saldo_model');
        $this->load->model('point_model');
        $this->load->model('pengaturan_model');
    }
    //Index
    public function index()
    {
        $user_id = $this->session->userdata('id');
        // var_dump($user_id);
        // die;
        $transaksi  = $this->transaksi_model->get_transaksi_driver($user_id);
        // End Listing Berita dengan paginasi
        $data = array(
            'title'         => 'Dashboard',
            'deskripsi'     => 'Halaman Dashboard',
            'keywords'      => '',
            'transaksi'     => $transaksi,
            'content'       => 'driver/transaksi/index'
        );
        $this->load->view('driver/layout/wrapp', $data, FALSE);
    }

    public function terima($id)
    {
        $transaksi = $this->transaksi_model->detail($id);
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);
        $driver_name = $user->name;

        is_login();
        $data = [
            'id'                => $id,
            'driver_name'       => $driver_name,
            'stage'             => 3,
        ];
        $this->transaksi_model->update($data);
        $this->dalam_perjalanan($id);
        $this->transaksi_log($id, $driver_name, $user_id);

        $this->potong_saldo_driver($transaksi);

        // $this->tambah_saldo_transfer_driver($transaksi);

        $this->session->set_flashdata('message', 'Order di terima');
        redirect($_SERVER['HTTP_REFERER']);
    }

    // Potong Saldo Driver
    public function potong_saldo_driver($transaksi)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);

        $persentase = $this->persentase_model->get_persentase();
        $pemotongan = $persentase->potong_saldo;

        $potong_saldo = ($pemotongan / 100) * $transaksi->total_price;
        $saldo_driver = $user->saldo_driver - $potong_saldo;

        $data = [
            'id'                => $user_id,
            'saldo_driver'      => $saldo_driver,
        ];
        $this->user_model->update($data);
        $this->create_saldo_driver($user_id, $potong_saldo, $transaksi, $saldo_driver);
        if ($transaksi->pembayaran == 'Cash') {
        } else {
            $this->tambah_saldo_transfer_driver($transaksi);
        }
    }
    // Tambah Saldo Driver
    public function tambah_saldo_transfer_driver($transaksi)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);
        $penambahan = $transaksi->total_price - $transaksi->diskon_point;

        $saldo_driver = $user->saldo_driver + $penambahan;

        $data = [
            'id'                => $user_id,
            'saldo_driver'      => $saldo_driver,
        ];
        $this->user_model->update($data);
        $this->create_saldo_driver_fromtransfer($user_id, $penambahan, $transaksi, $saldo_driver);
    }

    // Create Riwayat Saldo Driver
    public function create_saldo_driver($user_id, $potong_saldo, $transaksi, $saldo_driver)
    {

        $data = [
            'user_id'       => $user_id,
            'pemasukan'     => 0,
            'pengeluaran'   => $potong_saldo,
            'transaksi'     => $transaksi->total_price,
            'keterangan'    => $transaksi->order_id,
            'reason'        => 'Pemotongan Fee Untuk Order ID' . $transaksi->order_id,
            'total_saldo'   => $saldo_driver,
            'user_type'     => $user_id,
            'date_created'                      => date('Y-m-d H:i:s')
        ];
        $this->saldo_model->create($data);
    }
    // Create Riwayat Saldo Driver
    public function create_saldo_driver_fromtransfer($user_id, $penambahan, $transaksi, $saldo_driver)
    {


        $data = [
            'user_id'       => $user_id,
            'pemasukan'     => $penambahan,
            'pengeluaran'   => 0,
            'transaksi'     => $transaksi->total_price,
            'keterangan'    => $transaksi->order_id,
            'reason'        => 'Penambahan Order dengan pembayaran Transfer Dengan Order ID ' . $transaksi->order_id,
            'total_saldo'   => $saldo_driver,
            'user_type'     => $user_id,
            'date_created'                      => date('Y-m-d H:i:s')
        ];
        $this->saldo_model->create($data);
    }
    // Create Riwayat Saldo Driver
    public function add_saldo_point_driver($user_id, $tambah_saldo, $transaksi, $saldo_driver)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);

        $persentase = $this->persentase_model->get_persentase();
        $penambahan = $persentase->potong_saldo;

        $tambah_saldo = $transaksi->diskon_point;
        $persentase = ($penambahan / 100) * $transaksi->total_price;
        $saldo_driver = $user->saldo_driver + $tambah_saldo - $persentase;

        $data = [
            'user_id'       => $user_id,
            'pemasukan'     => $tambah_saldo,
            'pengeluaran'   => 0,
            'transaksi'     => $transaksi->total_price,
            'keterangan'    => $transaksi->order_id,
            'reason'        => 'Pengembalian Diskon Point Untuk Order ID' . $transaksi->order_id,
            'total_saldo'   => $saldo_driver,
            'user_type'     => $user_id,
            'date_created'                      => date('Y-m-d H:i:s')
        ];
        $this->saldo_model->create($data);
    }

    public function dalam_perjalanan($id)
    {
        is_login();
        $data = [
            'id'                => $id,
            'status'             => 'Dalam Pengantaran',
        ];
        $this->transaksi_model->update($data);
    }
    public function tolak($id)
    {
        is_login();
        $user_id = $this->session->userdata('id');
        $driver_detail = $this->user_model->user_detail($user_id);
        $driver_name = $driver_detail->name;
        $data = [
            'id'                => $id,
            'driver_name'       => $driver_name,
            'stage'             => 5,
        ];
        $this->transaksi_model->update($data);
        $this->update_status_driver($user_id);
        $this->order_ditolak($id);
        $this->transaksi_log($id, $driver_name, $user_id);
        $this->session->set_flashdata('message', 'Anda telah menolak Order');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function transaksi_log($id, $driver_name, $user_id)
    {
        $transaksi = $this->transaksi_model->transaksi_detail($id);
        $data = [
            'transaksi_id'      => $id,
            'order_id'          => $transaksi->order_id,
            'user_id'           => $user_id,
            'driver_name'       => $driver_name,
            'status'            => $transaksi->status,
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')

        ];
        $this->transaksi_model->create_log($data);
    }
    public function order_ditolak($id)
    {
        is_login();
        $data = [
            'id'                => $id,
            'driver_id'         => 0,
            'driver_name'       => '',

            'status'             => 'Ditolak Pengemudi',
        ];
        $this->transaksi_model->update($data);
    }

    // Sampai Ke tujuan
    public function finish($id)
    {

        $user_id = $this->session->userdata('id');
        $transaksi = $this->transaksi_model->transaksi_detail($id);
        is_login();
        if ($transaksi->diskon_point == 0) {
            $data = [
                'id'                => $id,
                'stage'             => 4,
                'status_pembayaran' => 'Lunas'
            ];
            $this->transaksi_model->update($data);
            $this->selesai_order($id);
            $this->update_status_driver($user_id);
            $this->add_point_customer($id);
            $this->_sendEmail($id);
            $this->session->set_flashdata('message', 'Anda telah Menyelesaikan Order');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $data = [
                'id'                => $id,
                'stage'             => 4,
                'status_pembayaran' => 'Lunas'
            ];
            $this->transaksi_model->update($data);
            $this->selesai_order($id);
            $this->update_status_driver($user_id);
            $this->add_point_customer($id);
            $this->add_point_driver($id);
            $this->_sendEmail($id);
            $this->session->set_flashdata('message', 'Anda telah Menyelesaikan Order');
            redirect($_SERVER['HTTP_REFERER']);
        }
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
        $this->email->message(
            '
          
            
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
            
            
            
            
            
                  '
        );

        if ($this->email->send()) {
            return true;
        } //else {
        //     echo $this->email->print_debugger();
        //     die;
        // }
    }
    public function add_point_driver($id)
    {
        $transaksi = $this->transaksi_model->transaksi_detail($id);
        $driver_id = $this->session->userdata('id');
        $driver = $this->user_model->detail_driver($driver_id);
        $tambah_saldo = $driver->saldo_driver + $transaksi->diskon_point;

        $add_saldo = $transaksi->diskon_point;

        $data = [
            'id'                => $this->session->userdata('id'),
            'saldo_driver'      => $tambah_saldo,
        ];
        $this->user_model->update($data);
        $this->create_saldo($add_saldo, $transaksi);
    }
    public function create_saldo($add_saldo, $transaksi)
    {
        $user_id = $this->session->userdata('id');
        $driver = $this->user_model->user_detail($user_id);
        $saldo_driver = $driver->saldo_driver;

        $data = [
            'user_id'       => $user_id,
            'pemasukan'     => $add_saldo,
            'pengeluaran'   => 0,
            'transaksi'     => $transaksi->total_price,
            'keterangan'    => $transaksi->order_id,
            'reason'        => 'Pengembalian Diskon Point Untuk Order ID' . $transaksi->order_id,
            'total_saldo'   => $saldo_driver,
            'user_type'     => $user_id,
            'date_created'                      => date('Y-m-d H:i:s')
        ];
        $this->saldo_model->create($data);
    }
    public function add_point_customer($id)
    {
        $date               = date("Y-m-d");
        $transaksi          = $this->transaksi_model->transaksi_detail($id);

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
            'id'                    => $id,
            'status'                => 'Selesai',
        ];
        $this->transaksi_model->update($data);
    }

    public function update_status_driver($user_id)
    {
        $data = [
            'id'                => $user_id,
            'status'             => 0,
        ];
        $this->user_model->update($data);
    }
    public function riwayat()
    {
        $user_id = $this->session->userdata('id');

        $config['base_url']         = base_url('driver/transaksi/riwayat/index/');
        $config['total_rows']       = count($this->transaksi_model->get_row_driver($user_id));
        $config['per_page']         = 5;
        $config['uri_segment']      = 5;

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
        $start                      = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);
        $transaksi = $this->transaksi_model->get_riwayat_driver($limit, $start, $user_id);
        $data = [
            'title'                 => 'Data Transaksi',
            'transaksi'             => $transaksi,
            'search'                => '',
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'driver/transaksi/riwayat'
        ];
        $this->load->view('driver/layout/wrapp', $data, FALSE);
    }
    public function detail($id)
    {
        $transaksi = $this->transaksi_model->detail($id);
        $data = [
            'title'                 => 'Data Transaksi',
            'transaksi'             => $transaksi,
            'content'               => 'driver/transaksi/detail'
        ];
        $this->load->view('driver/layout/wrapp', $data, FALSE);
    }
}
