<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dropoff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('pengaturan_model');
        $this->load->model('kota_model');
        $this->load->model('dropoff_model');
        $this->load->model('mobil_model');
        $this->load->model('user_model');
        $this->load->model('point_model');
        $this->load->model('paket_model');
        $this->load->model('bank_model');
        $this->load->model('promo_model');
    }
    public function index()
    {

        $kota = $this->kota_model->get_allkota();

        $kota_asal = "";
        if ($this->input->post('kota_asal') != NULL) {
            $kota_asal = $this->input->post('kota_asal');
            $this->session->set_userdata(array("kota_asal" => $kota_asal));
        } else {
            if ($this->session->userdata('kota_asal') != NULL) {
                $kota_asal = $this->session->userdata('kota_asal');
            }
        }
        $kota_tujuan = "";
        if ($this->input->post('kota_tujuan') != NULL) {
            $kota_tujuan = $this->input->post('kota_tujuan');
            $this->session->set_userdata(array("kota_tujuan" => $kota_tujuan));
        } else {
            if ($this->session->userdata('kota_tujuan') != NULL) {
                $kota_tujuan = $this->session->userdata('kota_tujuan');
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

        $paket_sewa = $this->dropoff_model->search_city($kota_asal, $kota_tujuan);
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

            if (!$this->agent->is_mobile()) {
                // Desktop View
                $data = [
                    'title'         => 'Drop Off',
                    'kota_asal'          => $kota_asal,
                    'kota_tujuan'          => $kota_tujuan,
                    'paket_sewa'    => $paket_sewa,
                    'kota_name'     => $kota_name,
                    'kota'          => $kota,
                    'tanggal_sewa'  => $tanggal_sewa,
                    'jam_sewa'      => $jam_sewa,
                    'content'       => 'front/dropoff/index'
                ];
                $this->load->view('front/layout/wrapp', $data);
            } else {
                // Mobile View
                $data = [
                    'title'         => 'Drop Off',
                    'kota_asal'          => $kota_asal,
                    'kota_tujuan'          => $kota_tujuan,
                    'paket_sewa'    => $paket_sewa,
                    'kota_name'     => $kota_name,
                    'kota'          => $kota,
                    'tanggal_sewa'  => $tanggal_sewa,
                    'jam_sewa'      => $jam_sewa,
                    'content'       => 'mobile/dropoff/index'
                ];
                $this->load->view('mobile/layout/wrapp', $data);
            }
        } else {
            $this->kendaraan($kota_asal, $kota_tujuan);
        }
    }
    public function kendaraan($kota_asal = false, $kota_tujuan = false)
    {
        $kota = $this->kota_model->get_allkota();
        $kota_asal = $this->input->get('kota_asal');
        $kota_tujuan = $this->input->get('kota_tujuan');
        $tanggal_sewa = $this->input->get('tanggal_sewa');
        $jam_sewa = $this->input->get('jam_sewa');
        $paket_dropoff = $this->dropoff_model->search_city($kota_asal, $kota_tujuan);

        $kota_asal_name = $this->kota_model->kota_asal_encrypt($kota_asal);
        $kota_tujuan_name = $this->kota_model->kota_tujuan_encrypt($kota_tujuan);

        if (!$this->agent->is_mobile()) {
            // Desktop View
            $data = [
                'title'                 => 'Pilih Kendaraan',
                'kota'                  => $kota,
                'paket_dropoff'         => $paket_dropoff,
                'kota_asal_name'        => $kota_asal_name->kota_name,
                'kota_tujuan_name'      => $kota_tujuan_name->kota_name,
                'kota_asal'             => $kota_asal,
                'kota_tujuan'           => $kota_tujuan,
                'tanggal_sewa'          => $tanggal_sewa,
                'jam_sewa'              => $jam_sewa,
                'content'               => 'front/dropoff/kendaraan'
            ];
            $this->load->view('front/layout/wrapp', $data);
        } else {
            // Mobile View
            $data = [
                'title'                 => 'Pilih Kendaraan',
                'kota'                  => $kota,
                'paket_dropoff'         => $paket_dropoff,
                'kota_asal_name'        => $kota_asal_name->kota_name,
                'kota_tujuan_name'      => $kota_tujuan_name->kota_name,
                'kota_asal'             => $kota_asal,
                'kota_tujuan'           => $kota_tujuan,
                'tanggal_sewa'          => $tanggal_sewa,
                'jam_sewa'              => $jam_sewa,
                'content'               => 'mobile/dropoff/kendaraan'
            ];
            $this->load->view('mobile/layout/wrapp', $data);
        }
    }

    public function order()
    {
        $user_id = $this->session->userdata('id');
        $total_pointku = $this->point_model->total_user_point($user_id);
        $expired = date('Y-m-d');
        $promo = $this->promo_model->get_promo_active($expired);
        $pembayaran = $this->pengaturan_model->show_payment();

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
        $kota_asal = "";
        if ($this->input->get('kota_asal') != NULL) {
            $kota_asal = $this->input->get('kota_asal');
            $this->session->set_userdata(array("kota_asal" => $kota_asal));
        } else {
            if ($this->session->userdata('kota_asal') != NULL) {
                $kota_asal = $this->session->userdata('kota_asal');
            }
        }
        $kota_tujuan = "";
        if ($this->input->get('kota_tujuan') != NULL) {
            $kota_tujuan = $this->input->get('kota_tujuan');
            $this->session->set_userdata(array("kota_tujuan" => $kota_tujuan));
        } else {
            if ($this->session->userdata('kota_tujuan') != NULL) {
                $kota_tujuan = $this->session->userdata('kota_tujuan');
            }
        }
        $kota_asal_name = "";
        if ($this->input->get('kota_asal_name') != NULL) {
            $kota_asal_name = $this->input->get('kota_asal_name');
            $this->session->set_userdata(array("kota_asal_name" => $kota_asal_name));
        } else {
            if ($this->session->userdata('kota_asal_name') != NULL) {
                $kota_asal_name = $this->session->userdata('kota_asal_name');
            }
        }
        $kota_tujuan_name = "";
        if ($this->input->get('kota_tujuan_name') != NULL) {
            $kota_tujuan_name = $this->input->get('kota_tujuan_name');
            $this->session->set_userdata(array("kota_tujuan_name" => $kota_tujuan_name));
        } else {
            if ($this->session->userdata('kota_tujuan_name') != NULL) {
                $kota_tujuan_name = $this->session->userdata('kota_tujuan_name');
            }
        }
        $order_point = "";
        if ($this->input->get('order_point') != NULL) {
            $order_point = $this->input->get('order_point');
            $this->session->set_userdata(array("order_point" => $order_point));
        } else {
            if ($this->session->userdata('order_point') != NULL) {
                $order_point = $this->session->userdata('order_point');
            }
        }
        $paket_price = "";
        if ($this->input->get('paket_price') != NULL) {
            $paket_price = $this->input->get('paket_price');
            $this->session->set_userdata(array("paket_price" => $paket_price));
        } else {
            if ($this->session->userdata('paket_price') != NULL) {
                $paket_price = $this->session->userdata('paket_price');
            }
        }



        $paket = $this->dropoff_model->dropoff_detail($kota_asal, $kota_tujuan);
        $kota_id = $paket->kota_asal;

        // $paket_price    = $paket->paket_price;
        // $order_point    = $paket->paket_point;
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

            if (!$this->agent->is_mobile()) {
                // Desktop View
                $order_device = 1;
                $data = [
                    'title'             => 'Pilih Kendaraan',
                    'tanggal_sewa'      =>  $tanggal_sewa,
                    'jam_sewa'          => $jam_sewa,
                    'mobil_name'        => $mobil_name,
                    'kota_asal'         => $kota_asal,
                    'kota_tujuan'       => $kota_tujuan,
                    'kota_tujuan_name'  => $kota_tujuan_name,
                    'kota_asal_name'    => $kota_asal_name,
                    'paket_price'       => $paket_price,
                    'order_point'       => $order_point,
                    'ketentuan_desc'    => $ketentuan_desc,
                    'paket_desc'        => $paket_desc,
                    'total_pointku'     => $total_pointku,
                    'promo'             => $promo,
                    'pembayaran'        => $pembayaran,
                    'order_device'      => $order_device,
                    'content'           => 'front/dropoff/order'
                ];
                $this->load->view('front/layout/wrapp', $data);
            } else {
                // Mobile View
                $order_device = 2;
                $data = [
                    'title'             => 'Pilih Kendaraan',
                    'tanggal_sewa'      =>  $tanggal_sewa,
                    'jam_sewa'          => $jam_sewa,
                    'mobil_name'        => $mobil_name,
                    'kota_asal'           => $kota_asal,
                    'kota_tujuan'         => $kota_tujuan,
                    'kota_tujuan_name'         => $kota_tujuan_name,
                    'kota_asal_name'         => $kota_asal_name,
                    'paket_price'       => $paket_price,
                    'order_point'       => $order_point,
                    'ketentuan_desc'    => $ketentuan_desc,
                    'paket_desc'        => $paket_desc,
                    'total_pointku'     => $total_pointku,
                    'promo'             => $promo,
                    'pembayaran'        => $pembayaran,
                    'order_device'      => $order_device,
                    'content'           => 'mobile/dropoff/order'
                ];
                $this->load->view('mobile/layout/wrapp', $data);
            }
        } else {

            $order_id = strtoupper(random_string('numeric', 7));
            $kode_transaksi = strtoupper(random_string('alnum', 7));
            $diskon_point = $this->input->get('diskon_point');
            $promo_amount = $this->input->get('promo_amount');

            $grand_total = (int)$paket_price - (int)$diskon_point - (int) $promo_amount;

            $pembayaran = $this->input->post('pembayaran');

            if ($pembayaran == 'Cash') {
                $expired_paymant_date = date('Y-m-d  H:i:s', strtotime('+2 days'));
                $data  = [
                    'user_id'                               => $this->session->userdata('id'),
                    'order_device'                            => $this->input->post('order_device'),
                    'product_id'                            => 3,
                    'driver_name'                           => '',
                    'product_name'                          => 'Drop Off',
                    'order_id'                              => $order_id,
                    'order_point'                           => $this->input->post('order_point'),
                    'kode_transaksi'                        => $kode_transaksi,
                    'passenger_name'                        => $this->input->post('passenger_name'),
                    'passenger_phone'                       => $this->input->post('passenger_phone'),
                    'passenger_email'                       => $this->input->post('passenger_email'),
                    'kota_id'                               => $kota_id,
                    'kota_name'                             => $kota_asal_name,
                    'origin'                                => $kota_asal_name,
                    'destination'                           => $kota_tujuan_name,
                    'mobil_id'                              => $mobil_id,
                    'mobil_name'                            => $this->input->post('mobil_name'),
                    'paket_id'                              => 0,
                    'paket_name'                            => "dropoff",
                    'alamat_jemput'                         => $this->input->post('alamat_jemput'),
                    'tanggal_jemput'                        => $this->input->post('tanggal_jemput'),
                    'jam_jemput'                            => $this->input->post('jam_jemput'),
                    'permintaan_khusus'                     => $this->input->post('permintaan_khusus'),
                    'lama_sewa'                             => 1,
                    'jumlah_mobil'                          => $this->input->post('jumlah_mobil'),
                    'ketentuan_desc'                        => $this->input->post('ketentuan_desc'),
                    'paket_desc'                            =>  $this->input->post('paket_desc'),
                    'jarak'                                 => 0,
                    'start_price'                           => $this->input->post('start_price'),
                    'total_price'                           => $paket_price,
                    'diskon_point'                          => $this->input->post('diskon_point'),
                    'promo_amount'                          => $this->input->post('promo_amount'),
                    'grand_total'                           => $grand_total,
                    'status'                                => 'Pending',
                    'status_read'                           => 0,
                    'order_type'                            => 'dropoff',
                    'pembayaran_id'                         => 0,
                    'pembayaran'                            => $this->input->post('pembayaran'),
                    'expired_payment_date'                  => $expired_paymant_date,
                    'status_pembayaran'                     => 'Belum Dibayar',
                    'no_va'                                 => '',
                    'payment_channel'                       => 'VIRTUAL_ACCOUNT',
                    'payment_transaction_id'                => '',
                    'stage'                                 => 1,
                    'date_created'                          => date('Y-m-d H:i:s'),
                    'date_updated'                          => date('Y-m-d H:i:s'),
                ];
                $insert_id = $this->transaksi_model->create($data);
                $this->update_point($insert_id);
                // $this->_sendEmail($insert_id, 'order');
                $this->_sendWhatsapp($insert_id);
                // $this->session->set_flashdata('message', 'Data telah ditambahkan');
                redirect(base_url('transaksi/sukses/' . md5($insert_id)), 'refresh');
            } else {

                /* Endpoint */
                $url = 'https://api.sewamobiloka.com/api/order/create_order';

                $data  = [
                    'user_id'                               => $this->session->userdata('id'),
                    'order_device'                            => $this->input->post('order_device'),
                    'product_id'                            => 3,
                    'driver_name'                           => '',
                    'product_name'                          => 'Drop Off',
                    'order_id'                              => $order_id,
                    'order_point'                           => $this->input->post('order_point'),
                    'kode_transaksi'                        => $kode_transaksi,
                    'passenger_name'                        => $this->input->post('passenger_name'),
                    'passenger_phone'                       => $this->input->post('passenger_phone'),
                    'passenger_email'                       => $this->input->post('passenger_email'),
                    'kota_id'                               => $kota_id,
                    'kota_name'                             => $kota_asal_name,
                    'origin'                                => $kota_asal_name,
                    'destination'                           => $kota_tujuan_name,
                    'mobil_id'                              => $mobil_id,
                    'mobil_name'                            => $this->input->post('mobil_name'),
                    'paket_id'                              => 0,
                    'paket_name'                            => $this->input->post('paket_name'),
                    'alamat_jemput'                         => $this->input->post('alamat_jemput'),
                    'tanggal_jemput'                        => $this->input->post('tanggal_jemput'),
                    'jam_jemput'                            => $this->input->post('jam_jemput'),
                    'permintaan_khusus'                     => $this->input->post('permintaan_khusus'),
                    'lama_sewa'                             => 1,
                    'jumlah_mobil'                          => $this->input->post('jumlah_mobil'),
                    'ketentuan_desc'                        => $this->input->post('ketentuan_desc'),
                    'paket_desc'                            =>  $this->input->post('paket_desc'),
                    'jarak'                                 => 0,
                    'start_price'                           => $this->input->post('start_price'),
                    'total_price'                           => $paket_price,
                    'diskon_point'                          => $this->input->post('diskon_point'),
                    'promo_amount'                          => $this->input->post('promo_amount'),
                    'grand_total'                           => $grand_total,
                    'status'                                => 'Pending',
                    'status_read'                           => 0,
                    'order_type'                            => 'dropOff',
                    'pembayaran_id'                         => 0,
                    'pembayaran'                            => $this->input->post('pembayaran'),
                    'status_pembayaran'                     => 'Belum Dibayar',
                    'no_va'                                 => '',
                    'payment_channel'                       => 'VIRTUAL_ACCOUNT',
                    'payment_transaction_id'                => '',
                    'stage'                                 => 1,
                    'date_created'                          => date('Y-m-d H:i:s'),
                    'date_updated'                          => date('Y-m-d H:i:s'),
                ];


                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                $response = curl_exec($ch);


                $result = json_decode($response, true);


                $insert_id = $result['trx']['data']['id_order'];
                $this->update_point($insert_id);
                // $this->_sendEmail($insert_id, 'order');
                $this->_sendWhatsapp($insert_id);


                if ($response !== false) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable fade show"><button class="close" data-dismiss="alert" aria-label="Close"></button>Transaksi Telah di Konfirmasi</div>');
                    redirect(base_url('transaksi/sukses/' . md5($insert_id)), 'refresh');
                    // var_dump($response);
                    // die;
                } else {
                    $this->session->set_flashdata('message', 'transaksi gagal di approved');
                    redirect(base_url('daily/404'), 'refresh');
                }
                curl_close($ch);
                // }

            }
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
                    'id'            => $key->id,
                    'point_status'  => $status,
                );
            }
            $this->db->update_batch('point', $result, 'id');
        }
    }


    private function _sendEmail($insert_id)
    {
        $email_order = $this->pengaturan_model->email_order();
        $transaksi  = $this->transaksi_model->last_transaksi($insert_id);
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
        $this->email->from("$email_order->smtp_user", ' Order ', "$meta->title");
        $this->email->to($this->input->post('passenger_email'));
        $this->email->cc("$email_order->cc_email");
        $this->email->bcc("$email_order->bcc_email");

        $this->email->subject('Order ' . $meta->title . '' . $transaksi->kode_transaksi . '');
        $this->email->message('
        <b>Informasi Customer</b><br>
        Nama                : ' . $transaksi->passenger_name . '<br>
        No. HP              : ' . $transaksi->passenger_phone . '<br>
        Email               : ' . $transaksi->passenger_email . '<br>
        <b>Informasi Pemesanan Sewa Mobil</b><br>
        Rental              : ' . $meta->title . '<br>
        Order ID            : ' . $transaksi->order_id . '<br>
        Mobil               : ' . $transaksi->mobil_name . '<br>
        Alamat Jemput       : ' . $transaksi->alamat_jemput . '<br>
        Tanggal Jemput      : ' . $transaksi->tanggal_jemput . '<br>
        Jam Jemput          : ' . $transaksi->jam_jemput . '<br>
        Paket               : ' . $transaksi->paket_name . '<br>
        Permintaan Khusus   : ' . $transaksi->permintaan_khusus . '<br>
        Total Pembayaran    : ' . number_format($transaksi->grand_total, 0, ",", ".") . '<br>
        Pembayaran          : ' . $transaksi->pembayaran . '<br>
        Status Pembayaran   : ' . $transaksi->status_pembayaran . '<br>
        <b>Ketentuan Sewa :</b><br>
        ' . $transaksi->ketentuan_desc . '<br>
        <b>Batas Area Penggunaan </b>
        ' . $transaksi->paket_desc . '
        ');

        if ($this->email->send()) {
            return true;
        } //else {
        //     echo $this->email->print_debugger();
        //     die;
        // }
    }

    public function _sendWhatsapp($insert_id)
    {
        $meta = $this->meta_model->get_meta();
        $whatsapp_key = $meta->whatsapp_api;
        $transaksi = $this->transaksi_model->last_transaksi($insert_id);
        $whatsapp = $transaksi->passenger_phone;

        $url_payment = base_url('transaksi/sukses/' . md5($insert_id));

        if ($transaksi->pembayaran == "Transfer") {
            $message = "          
            Order Anda telah dibuat Berikut data pesanan anda :%0a
            Nama:   $transaksi->passenger_name %0a
            Whatsapp:  $transaksi->passenger_phone %0a
            Mobil:  $transaksi->mobil_name  %0a
            Paket:  $transaksi->paket_name %0a
            Tgl jemput:   $transaksi->tanggal_jemput  %0a
            Jam jemput:   $transaksi->jam_jemput  %0a
            Alamat jemput:   $transaksi->alamat_jemput  %0a
            Terima Kasih Telah Menggunakan Jasa Layanan Agelita Rentcar
            
            ";
        } else {
            $message = "
            Order Anda telah dibuat Berikut data pesanan anda :%0a
            Nama:  $transaksi->passenger_name %0a
            Whatsapp:  $transaksi->passenger_phone %0a
            Mobil:  $transaksi->mobil_name %0a
            Paket:  $transaksi->paket_name  %0a
            Tgl jemput:  $transaksi->tanggal_jemput  %0a
            Jam jemput:  $transaksi->jam_jemput  %0a
            Alamat jemput:  $transaksi->alamat_jemput %0a
            Terima Kasih Telah Menggunakan Jasa Layanan Agelita Rentcar
            ";
        }


        $apikey = $whatsapp_key;
        $tujuan = $whatsapp;
        $pesan = $message;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://starsender.online/api/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'apikey: ' . $apikey
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response;
    }
}
