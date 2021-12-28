<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daily extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('pengaturan_model');
        $this->load->model('kota_model');
        $this->load->model('daily_model');
        $this->load->model('mobil_model');
        $this->load->model('user_model');
        $this->load->model('point_model');
        $this->load->model('paket_model');
    }
    public function index()
    {

        $kota = $this->kota_model->get_allkota();

        $kota_id = "";
        if ($this->input->post('kota_id') != NULL) {
            $kota_id = $this->input->post('kota_id');
            $this->session->set_userdata(array("kota_id" => $kota_id));
        } else {
            if ($this->session->userdata('kota_id') != NULL) {
                $kota_id = $this->session->userdata('kota_id');
            }
        }
        $tanggal_sewa = "";
        if ($this->input->post('tanggal_sewa') != NULL) {
            $tanggal_sewa = $this->input->post('tanggal_sewa');
            $this->session->set_userdata(array("tanggal_sewa" => $tanggal_sewa));
        } else {
            if ($this->session->userdata('tanggal_sewa') != NULL) {
                $tanggal_sewa = $this->session->userdata('tanggal_sewa');
            }
        }
        $jam_sewa = "";
        if ($this->input->post('jam_sewa') != NULL) {
            $jam_sewa = $this->input->post('jam_sewa');
            $this->session->set_userdata(array("jam_sewa" => $jam_sewa));
        } else {
            if ($this->session->userdata('jam_sewa') != NULL) {
                $jam_sewa = $this->session->userdata('jam_sewa');
            }
        }



        // $kota_id = $this->input->post('kota_id');
        // $tanggal_sewa = $this->input->post('tanggal_sewa');
        // $jam_sewa = $this->input->post('jam_sewa');

        $paket_sewa = $this->paket_model->search_city($kota_id);
        $kota_name = '';

        $this->form_validation->set_rules(
            'kota_id',
            'Kota',
            'required',
            [
                'required'         => 'Pilih Kota',
            ]
        );

        if ($this->form_validation->run() == false) {
            $data = [
                'title'         => 'Halaman Home',
                'kota'          => $kota,
                'paket_sewa'    => $paket_sewa,
                'kota_id'       => $kota_id,
                'kota_name'     => $kota_name,
                'tanggal_sewa'  => $tanggal_sewa,
                'jam_sewa'      => $jam_sewa,
                'content'       => 'front/daily/index'
            ];
            $this->load->view('front/layout/wrapp', $data);
        } else {
            $this->kendaraan($kota_id);
        }
    }
    public function kendaraan($kota_id = false)
    {
        $kota = $this->kota_model->get_allkota();
        $kota_id = $this->input->get('kota_id');
        $tanggal_sewa = $this->input->get('tanggal_sewa');
        $jam_sewa = $this->input->get('jam_sewa');
        $paket_sewa = $this->paket_model->search_city($kota_id);
        $kota_detail = $this->kota_model->detail_encrypt($kota_id);
        $kota_name = $kota_detail->kota_name;
        // var_dump($kota_id);
        // die;
        //Validasi Berhasil
        $data = [
            'title'         => 'Pilih Kendaraan',
            'kota'          => $kota,
            'paket_sewa'    => $paket_sewa,
            'kota_id'       => $kota_id,
            'kota_name'     => $kota_name,
            'tanggal_sewa'  => $tanggal_sewa,
            'jam_sewa'      => $jam_sewa,
            'content'       => 'front/daily/kendaraan'
        ];
        $this->load->view('front/layout/wrapp', $data);
    }
    public function paket($kota_id = false, $mobil_id = false)
    {
        $tanggal_sewa = "";
        if ($this->input->get('tanggal_sewa') != NULL) {
            $tanggal_sewa = $this->input->get('tanggal_sewa');
            $this->session->set_userdata(array("tanggal_sewa" => $tanggal_sewa));
        } else {
            if ($this->session->userdata('tanggal_sewa') != NULL) {
                $tanggal_sewa = $this->session->userdata('tanggal_sewa');
            }
        }

        $jam_sewa = "";
        if ($this->input->get('jam_sewa') != NULL) {
            $jam_sewa = $this->input->get('jam_sewa');
            $this->session->set_userdata(array("jam_sewa" => $jam_sewa));
        } else {
            if ($this->session->userdata('jam_sewa') != NULL) {
                $jam_sewa = $this->session->userdata('jam_sewa');
            }
        }

        // $tanggal_sewa = $this->input->post('tanggal_sewa');
        // $jam_sewa = $this->input->post('jam_sewa');

        $mobil      = $this->mobil_model->detail_encrypt($mobil_id);
        $kota       = $this->kota_model->detail_encrypt($kota_id);

        $paket      = $this->paket_model->get_paket_daily($kota_id, $mobil_id);
        // var_dump($paket);
        // die;
        $data = [
            'title'         => 'Pilih Kendaraan',
            'paket'         => $paket,
            'mobil'         => $mobil,
            'kota'          => $kota,
            'tanggal_sewa'  =>  $tanggal_sewa,
            'jam_sewa'      => $jam_sewa,
            'content'       => 'front/daily/paket'
        ];
        $this->load->view('front/layout/wrapp', $data);
    }
    public function order()
    {
        $user_id = $this->session->userdata('id');
        $total_pointku = $this->point_model->total_user_point($user_id);
        // var_dump($user_point);
        // die;
        $tanggal_sewa = "";
        if ($this->input->get('tanggal_sewa') != NULL) {
            $tanggal_sewa = $this->input->get('tanggal_sewa');
            $this->session->set_userdata(array("tanggal_sewa" => $tanggal_sewa));
        } else {
            if ($this->session->userdata('tanggal_sewa') != NULL) {
                $tanggal_sewa = $this->session->userdata('tanggal_sewa');
            }
        }

        $jam_sewa = "";
        if ($this->input->get('jam_sewa') != NULL) {
            $jam_sewa = $this->input->get('jam_sewa');
            $this->session->set_userdata(array("jam_sewa" => $jam_sewa));
        } else {
            if ($this->session->userdata('jam_sewa') != NULL) {
                $jam_sewa = $this->session->userdata('jam_sewa');
            }
        }

        $mobil_name = "";
        if ($this->input->get('mobil_name') != NULL) {
            $mobil_name = $this->input->get('mobil_name');
            $this->session->set_userdata(array("mobil_name" => $mobil_name));
        } else {
            if ($this->session->userdata('mobil_name') != NULL) {
                $mobil_name = $this->session->userdata('mobil_name');
            }
        }
        $mobil_id = "";
        if ($this->input->get('mobil_id') != NULL) {
            $mobil_id = $this->input->get('mobil_id');
            $this->session->set_userdata(array("mobil_id" => $mobil_id));
        } else {
            if ($this->session->userdata('mobil_id') != NULL) {
                $mobil_id = $this->session->userdata('mobil_id');
            }
        }
        $kota_id = "";
        if ($this->input->get('kota_id') != NULL) {
            $kota_id = $this->input->get('kota_id');
            $this->session->set_userdata(array("kota_id" => $kota_id));
        } else {
            if ($this->session->userdata('kota_id') != NULL) {
                $kota_id = $this->session->userdata('kota_id');
            }
        }
        $kota_name = "";
        if ($this->input->get('kota_name') != NULL) {
            $kota_name = $this->input->get('kota_name');
            $this->session->set_userdata(array("kota_name" => $kota_name));
        } else {
            if ($this->session->userdata('kota_name') != NULL) {
                $kota_name = $this->session->userdata('kota_name');
            }
        }
        $paket_id = "";
        if ($this->input->get('paket_id') != NULL) {
            $paket_id = $this->input->get('paket_id');
            $this->session->set_userdata(array("paket_id" => $paket_id));
        } else {
            if ($this->session->userdata('paket_id') != NULL) {
                $paket_id = $this->session->userdata('paket_id');
            }
        }

        $paket = $this->paket_model->detail($paket_id);
        $paket_name     = $paket->paket_name;
        $paket_price    = $paket->paket_price;
        $order_point    = $paket->paket_point;
        $ketentuan_desc = $paket->ketentuan_desc;
        $paket_desc     = $paket->paket_desc;



        $this->form_validation->set_rules(
            'passenger_name',
            'Nama Penumpang',
            'required',
            array(
                'required'                        => '%s Harus Diisi',
            )
        );
        if ($this->form_validation->run() === FALSE) {

            $data = [
                'title'             => 'Pilih Kendaraan',
                'tanggal_sewa'      =>  $tanggal_sewa,
                'jam_sewa'          => $jam_sewa,
                'mobil_name'        => $mobil_name,
                'kota_id'           => $kota_id,
                'kota_name'         => $kota_name,
                'paket_name'        => $paket_name,
                'paket_price'       => $paket_price,
                'order_point'       => $order_point,
                'ketentuan_desc'    => $ketentuan_desc,
                'paket_desc'        => $paket_desc,
                'total_pointku'     => $total_pointku,
                'content'           => 'front/daily/order'
            ];
            $this->load->view('front/layout/wrapp', $data);
        } else {

            $order_id = strtoupper(random_string('numeric', 7));
            $kode_transaksi = strtoupper(random_string('alnum', 7));
            $start_price = $this->input->post('start_price');
            $lama_sewa = $this->input->post('lama_sewa');
            $jumlah_mobil = $this->input->post('jumlah_mobil');
            $diskon_point = $this->input->post('diskon_point');
            $total_price = (int)$start_price * (int)$lama_sewa * (int)$jumlah_mobil;
            $grand_total = (int)$start_price * (int)$lama_sewa * (int)$jumlah_mobil - (int)$diskon_point;
            // var_dump($total_price);
            // die;

            $data  = [
                'user_id'                               => $this->session->userdata('id'),
                'product_id'                            => 5,
                'order_id'                              => $order_id,
                'order_point'                              =>  $this->input->post('order_point'),
                'kode_transaksi'                        => $kode_transaksi,
                'passenger_name'                        => $this->input->post('passenger_name'),
                'passenger_phone'                       => $this->input->post('passenger_phone'),
                'passenger_email'                       => $this->input->post('passenger_email'),
                'mobil_name'                            => $this->input->post('mobil_name'),
                'mobil_id'                            => $mobil_id,
                'paket_name'                            => $this->input->post('paket_name'),
                'paket_id'                              => $paket_id,
                'kota_name'                             => $this->input->post('kota_name'),
                'kota_id'                               => $this->input->post('kota_id'),
                'alamat_jemput'                         => $this->input->post('alamat_jemput'),
                'tanggal_jemput'                        => $this->input->post('tanggal_jemput'),
                'jam_jemput'                            => $this->input->post('jam_jemput'),
                'lama_sewa'                             => $lama_sewa,
                'jumlah_mobil'                          => $jumlah_mobil,
                'start_price'                           => $start_price,
                'total_price'                           => $total_price,
                'diskon_point'                          => $diskon_point,
                'grand_total'                           => $grand_total,
                'permintaan_khusus'                     => $this->input->post('permintaan_khusus'),
                'pembayaran'                            => $this->input->post('pembayaran'),
                'ketentuan_desc'                            => $this->input->post('ketentuan_desc'),
                'paket_desc'                            => $this->input->post('paket_desc'),
                'order_type'                            => 'Daily',
                'status'                                => 'Pending',
                'date_created'                          => date('Y-m-d H:i:s')
            ];
            $insert_id = $this->transaksi_model->create($data);
            $this->sukses($insert_id);
            $this->update_point($insert_id);
            // $this->_sendEmail($insert_id, 'order');
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('daily/sukses/' . $insert_id), 'refresh');
        }
    }
    // Update Data Point jika point di gunakan
    public function update_point($insert_id)
    {
        $transaksi = $this->transaksi_model->last_transaksi($insert_id);

        if ($transaksi->diskon_point == 0) {
        } else {
            $user_id = $this->session->userdata('id');
            $id = $this->point_model->get_all($user_id);
            $status = 0;
            $result = array();
            foreach ($id as $key) {
                $result[] = array(
                    'id' => $key->id,
                    'point_status' => $status,
                );
            }
            $this->db->update_batch('point', $result, 'id');
        }
    }


    //     private function _sendEmail($insert_id)
    //     {
    //         $email_order = $this->pengaturan_model->email_order();
    //         $transaksi  = $this->transaksi_model->detail_transaksi($insert_id);
    //         $meta = $this->meta_model->get_meta();

    //         $config = [
    //             'protocol'     => "$email_order->protocol",
    //             'smtp_host'   => "$email_order->smtp_host",
    //             'smtp_port'   => $email_order->smtp_port,
    //             'smtp_user'   => "$email_order->smtp_user",
    //             'smtp_pass'   => "$email_order->smtp_pass",
    //             'mailtype'     => 'html',
    //             'charset'     => 'utf-8',
    //         ];

    //         $this->load->library('email', $config);
    //         $this->email->initialize($config);
    //         $this->email->set_newline("\r\n");
    //         $this->email->from("$email_order->smtp_user", 'Order');
    //         $this->email->to($this->input->post('user_email'));

    //         $this->email->subject('Order ' . $transaksi->kode_transaksi . '');
    //         $this->email->message('



    //                             <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    //   <html xmlns="http://www.w3.org/1999/xhtml">
    //   <head>
    //     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    //     <meta name="viewport" content="width=320, initial-scale=1" />
    //     <title>Airmail Invoice</title>
    //     <style type="text/css">


    //       #outlook a {
    //         padding: 0;
    //       }


    //       .ReadMsgBody {
    //         width: 100%;
    //       }

    //       .ExternalClass {
    //         width: 100%;
    //       }


    //       .ExternalClass,
    //       .ExternalClass p,
    //       .ExternalClass span,
    //       .ExternalClass font,
    //       .ExternalClass td,
    //       .ExternalClass div {
    //         line-height: 100%;
    //       }



    //       body, table, td, p, a, li, blockquote {
    //         -webkit-text-size-adjust: 100%;
    //         -ms-text-size-adjust: 100%;
    //       }


    //       table, td {
    //         mso-table-lspace: 0pt;
    //         mso-table-rspace: 0pt;
    //       }


    //       img {
    //         -ms-interpolation-mode: bicubic;
    //       }



    //       html,
    //       body,
    //       .body-wrap,
    //       .body-wrap-cell {
    //         margin: 0;
    //         padding: 0;
    //         background: #ffffff;
    //         font-family: Arial, Helvetica, sans-serif;
    //         font-size: 14px;
    //         color: #464646;
    //         text-align: left;
    //       }

    //       img {
    //         border: 0;
    //         line-height: 100%;
    //         outline: none;
    //         text-decoration: none;
    //       }

    //       table {
    //         border-collapse: collapse !important;
    //       }

    //       td, th {
    //         text-align: left;
    //         font-family: Arial, Helvetica, sans-serif;
    //         font-size: 14px;
    //         color: #464646;
    //         line-height:1.5em;
    //       }

    //       b a,
    //       .footer a {
    //         text-decoration: none;
    //         color: #464646;
    //       }

    //       a.blue-link {
    //         color: blue;
    //         text-decoration: underline;
    //       }



    //       td.center {
    //         text-align: center;
    //       }

    //       .left {
    //         text-align: left;
    //       }

    //       .body-padding {
    //         padding: 24px 40px 40px;
    //       }

    //       .border-bottom {
    //         border-bottom: 1px solid #D8D8D8;
    //       }

    //       table.full-width-gmail-android {
    //         width: 100% !important;
    //       }


    //       .header {
    //         font-weight: bold;
    //         font-size: 16px;
    //         line-height: 16px;
    //         height: 16px;
    //         padding-top: 19px;
    //         padding-bottom: 7px;
    //       }

    //       .header a {
    //         color: #464646;
    //         text-decoration: none;
    //       }


    //       .footer a {
    //         font-size: 12px;
    //       }
    //     </style>

    //     <style type="text/css" media="only screen and (max-width: 650px)">
    //       @media only screen and (max-width: 650px) {
    //         * {
    //           font-size: 16px !important;
    //         }

    //         table[class*="w320"] {
    //           width: 320px !important;
    //         }

    //         td[class="mobile-center"],
    //         div[class="mobile-center"] {
    //           text-align: center !important;
    //         }

    //         td[class*="body-padding"] {
    //           padding: 20px !important;
    //         }

    //         td[class="mobile"] {
    //           text-align: right;
    //           vertical-align: top;
    //         }
    //       }
    //     </style>

    //   </head>
    //   <body style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none">
    //   <table border="0" cellpadding="0" cellspacing="0" width="100%">
    //   <tr>
    //    <td valign="top" align="left" width="100%" style="background: #ffffff;">
    //    <center>
    //      <table class="w320 full-width-gmail-android" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" width="100%">
    //         <tr>
    //           <td width="100%" height="48" valign="top">           
    //                 <table class="full-width-gmail-android" cellspacing="0" cellpadding="0" border="0" width="100%">
    //                   <tr>
    //                     <td class="header center" width="100%" >
    //                       <a href="' . $meta->link . '" style="color:#ffffff;">
    //                       <img class="left" width="auto" height="30" src="' . base_url('assets/img/logo/' . $meta->logo) . '" alt="Sewamobiloka">
    //                       </a>
    //                     </td>
    //                   </tr>
    //                 </table>
    //           </td>
    //         </tr>
    //       </table>

    //       <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
    //         <tr>
    //           <td align="center">
    //             <center>
    //               <table class="w320" cellspacing="0" cellpadding="0" width="600">
    //                 <tr>
    //                   <td class="body-padding mobile-padding">

    //                   <table cellspacing="0" cellpadding="0" width="100%">
    //                     <tr>
    //                       <td class="left" style="padding-bottom:20px; text-align:left;">
    //                         <b>Invoice:</b> ' . $transaksi->kode_transaksi . '
    //                       </td>
    //                     </tr>
    //                     <tr>
    //                       <td class="left" style="padding-bottom:40px; text-align:left;">
    //                       <span style="font-size:20px;"> Hi <b>' . $transaksi->user_title . ' ' . $transaksi->user_name . '</b>,</span>
    //                       <br>
    //                       Terima kasih Telah menggunakan layanan ' . $meta->link . ' . Order Anda Telah Kami Terima, Kami Akan Segera Menghubungi Anda
    //                       </td>
    //                     </tr>
    //                   </table>

    //                   <br>

    //                   <div style="border:1px solid #ddd;border-radius:4px">
    //                   <div style="background:#0279d6;color:#ffff;padding:5px 0 5px 20px;border-radius:4px 4px 0 0">
    //                   <b>Informasi Order</b>
    //                   </div>
    //                   <div style="padding:10px;">
    //                   <table cellspacing="0" cellpadding="0" width="100%">


    //                     <tr>
    //                     <td>Mobil </td> 
    //                     <td>: ' . $transaksi->nama_mobil . ' <br> ' . $transaksi->nama_paket . ' </td>
    //                     </tr>

    //                     <tr>
    //                     <td>Harga / hari </td> 
    //                     <td>: Rp. ' . number_format($transaksi->harga_satuan, 0, ",", ".") . '</td>
    //                     </tr>

    //                     <tr>
    //                     <td>Lama Sewa </td> 
    //                     <td>: ' . $transaksi->lama_sewa . ' Hari</td>
    //                     </tr>

    //                     <tr>
    //                     <td>Total Harga </td> 
    //                     <td style="font-size:18px;color:#0070ee;">: <b>Rp. ' . number_format($transaksi->total_harga, 0, ",", ".") . '</b></td>
    //                     </tr>

    //                     </table>

    //                     </div>
    //                     </div>
    //                     <br>


    //                   <div style="border:1px solid #ddd;border-radius:4px">
    //                   <div style="background:#0279d6;color:#ffff;padding:5px 0 5px 20px;border-radius:4px 4px 0 0">
    //                   <b>Informasi Pelanggan</b>
    //                   </div>
    //                   <div style="padding:10px;">
    //                   <table cellspacing="0" cellpadding="0" width="100%">



    //                     <tr>
    //                     <td>Nama </td> 
    //                     <td>: ' . $transaksi->user_title . ' ' . $transaksi->user_name . '</td>
    //                     </tr>

    //                     <tr>
    //                     <td>Nomor Hp. </td> 
    //                     <td>: ' . $transaksi->user_phone . '</td>
    //                     </tr>

    //                     <tr>
    //                     <td>Mobil </td> 
    //                     <td>: ' . $transaksi->nama_mobil . '</td>
    //                     </tr>

    //                     <tr>
    //                     <td>Tanggal Jemput </td> 
    //                     <td>: ' . $transaksi->tanggal_jemput . '</td>
    //                     </tr>

    //                     <tr>
    //                     <td>Jam Jemput </td> 
    //                     <td>:' . $transaksi->jam_jemput . '</td>
    //                     </tr>



    //                     <tr>
    //                     <td>Alamat Jemput </td> 
    //                     <td>: ' . $transaksi->alamat_jemput . '</td>
    //                     </tr>

    //                     <tr>
    //                     <td>Permintaan Khusus </td> 
    //                     <td>: ' . $transaksi->permintaan_khusus . '</td>


    //                             </tr>

    //                     </table>

    //                     </div>
    //                     </div>
    //                     <br>


    //                   <table cellspacing="0" cellpadding="0" width="100%">
    //                     <tr>
    //                       <td class="left" style="text-align:left;">
    //                         Terima Kasih,
    //                       </td>
    //                     </tr>
    //                     <tr>
    //                       <td class="left" width="auto" height="20" style="padding-top:10px; text-align:left;">

    //                       </td>
    //                     </tr>
    //                   </table>



    //                   <table cellspacing="0" cellpadding="0" width="100%">

    //                   ' . $transaksi->ketentuan . '

    //                   </table>







    //                   </td>
    //                 </tr>
    //               </table>

    //             </center>
    //           </td>
    //         </tr>
    //       </table>




    //       <table class="w320" bgcolor="#2f383f" cellpadding="0" cellspacing="0" border="0" width="100%">
    //         <tr>
    //           <td align="center">
    //             <center>
    //               <table class="w320" cellspacing="0" cellpadding="0" width="500" bgcolor="#2f383f">
    //                 <tr>
    //                   <td>
    //                     <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#2f383f">
    //                       <tr>
    //                         <td class="center" style="padding:25px; text-align:center;color:#ffffff">
    //                          Silahkan Hubungi  <b> ' . $meta->telepon . '</b> Untuk informasi lebih lanjut
    //                         </td>
    //                       </tr>
    //                     </table>
    //                   </td>
    //                 </tr>
    //               </table>
    //             </center>
    //           </td>
    //         </tr>
    //         <tr>

    //         </tr>
    //       </table>


    //     </center>
    //     </td>
    //   </tr>
    //   </table>
    //   </body>
    //   </html>
    //           ');

    //         if ($this->email->send()) {
    //             return true;
    //         }
    //     }





    public function sukses($insert_id)
    {

        $id = $insert_id;
        $transaksi = $this->transaksi_model->last_transaksi($id);
        $data = [
            'title'     => 'Order Sukses',
            'transaksi' => $transaksi,
            'content'   => 'front/daily/sukses'
        ];
        $this->load->view('front/layout/wrapp', $data);
    }
}
