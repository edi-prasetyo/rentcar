<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admindaily extends CI_Controller
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
        $this->load->model('bank_model');
        $this->load->model('promo_model');
        $this->load->model('meta_model');
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


            // Desktop View
            $data = [
                'title'         => 'Daily Rent',
                'kota'          => $kota,
                'paket_sewa'    => $paket_sewa,
                'kota_id'       => $kota_id,
                'kota_name'     => $kota_name,
                'tanggal_sewa'  => $tanggal_sewa,
                'jam_sewa'      => $jam_sewa,
                'content'       => 'admin/daily/admin_daily'
            ];
            $this->load->view('admin/layout/wrapp', $data);
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

        $data = [
            'title'         => 'Pilih Kendaraan',
            'kota'          => $kota,
            'paket_sewa'    => $paket_sewa,
            'kota_id'       => $kota_id,
            'kota_name'     => $kota_name,
            'tanggal_sewa'  => $tanggal_sewa,
            'jam_sewa'      => $jam_sewa,
            'content'       => 'admin/daily/admin_kendaraan'
        ];
        $this->load->view('admin/layout/wrapp', $data);
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


        $mobil      = $this->mobil_model->detail_encrypt($mobil_id);
        $kota       = $this->kota_model->detail_encrypt($kota_id);

        $paket      = $this->paket_model->get_paket_daily($kota_id, $mobil_id);


        $data = [
            'title'         => 'Pilih Paket',
            'paket'         => $paket,
            'mobil'         => $mobil,
            'kota'          => $kota,
            'tanggal_sewa'  =>  $tanggal_sewa,
            'jam_sewa'      => $jam_sewa,
            'content'       => 'admin/daily/admin_paket'
        ];
        $this->load->view('admin/layout/wrapp', $data);
    }

    public function order()
    {



        $user_id = $this->session->userdata('id');
        $total_pointku = $this->point_model->total_user_point($user_id);
        $expired = date('Y-m-d');
        $promo = $this->promo_model->get_promo_active($expired);
        $pembayaran = $this->pengaturan_model->show_payment();
        // var_dump($expired);
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


            $order_device = 3;
            $data = [
                'title'             => 'Form pemesanan',
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
                'promo'             => $promo,
                'pembayaran'        => $pembayaran,
                'order_device'      => $order_device,
                'content'           => 'admin/daily/admin_order'
            ];
            $this->load->view('admin/layout/wrapp', $data);
        } else {

            $order_id = strtoupper(random_string('numeric', 7));
            $kode_transaksi = strtoupper(random_string('alnum', 7));
            $start_price = $this->input->post('start_price');
            $lama_sewa = $this->input->post('lama_sewa');
            $jumlah_mobil = $this->input->post('jumlah_mobil');
            $diskon_point = $this->input->post('diskon_point');
            $promo_amount = $this->input->post('promo_amount');

            $uang_bbm = $this->input->post('fuel_money');
            $uang_makan = $this->input->post('meal_allowance');
            $uang_inap = $this->input->post('accommodation_fee');
            $uang_dp = $this->input->post('down_payment');




            $total_price = (int) $start_price * (int) $lama_sewa * (int) $jumlah_mobil;
            // $total_price = (int) $price + (int) $uang_bbm + (int) $uang_makan + (int) $uang_inap;

            $grand_total = (int) $total_price + (int) $uang_bbm + (int) $uang_makan + (int) $uang_inap  - (int) $promo_amount - (int)$uang_dp;

            $data  = [
                'user_id'                               => $this->session->userdata('id'),
                'order_device'                          => $this->input->post('order_device'),
                'product_id'                            => 5,
                'driver_name'                           => '',
                'product_name'                          => 'Daily',
                'order_id'                              => $order_id,
                'order_point'                           => $this->input->post('order_point'),
                'kode_transaksi'                        => $kode_transaksi,
                'passenger_name'                        => $this->input->post('passenger_name'),
                'passenger_phone'                       => $this->input->post('passenger_phone'),
                'passenger_email'                       => $this->input->post('passenger_email'),
                'kota_id'                               => $this->input->post('kota_id'),
                'kota_name'                             => $this->input->post('kota_name'),
                'mobil_id'                              => $mobil_id,
                'mobil_name'                            => $this->input->post('mobil_name'),
                'paket_id'                              => $paket_id,
                'paket_name'                            => $this->input->post('paket_name'),
                'alamat_jemput'                         => $this->input->post('alamat_jemput'),
                'tanggal_jemput'                        => $this->input->post('tanggal_jemput'),
                'jam_jemput'                            => $this->input->post('jam_jemput'),
                'permintaan_khusus'                     => $this->input->post('permintaan_khusus'),
                'lama_sewa'                             => $this->input->post('lama_sewa'),
                'jumlah_mobil'                          => $this->input->post('jumlah_mobil'),
                'ketentuan_desc'                        => $this->input->post('ketentuan_desc'),
                'paket_desc'                            =>  $this->input->post('paket_desc'),
                'jarak'                                 => 0,
                'start_price'                           => $this->input->post('start_price'),

                'fuel_money'                            => $uang_bbm,
                'meal_allowance'                        => $uang_makan,
                'accommodation_fee'                     => $uang_inap,
                'down_payment'                          => $uang_dp,

                'total_price'                           => $total_price,
                'diskon_point'                          => (int) $diskon_point,
                'promo_amount'                          => $this->input->post('promo_amount'),
                'grand_total'                           => $grand_total,
                'status'                                => 'Pending',
                'status_read'                           => 0,
                'order_type'                            => 'daily',
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

            $insert_id = $this->transaksi_model->create($data);
            $this->_sendWhatsapp($insert_id);
            // $this->update_point($insert_id);
            // $this->_sendEmail($insert_id, 'order');
            redirect(base_url('admin/transaksi'), 'refresh');
        }
    }

    public function _sendWhatsapp($insert_id)
    {
        $meta = $this->meta_model->get_meta();
        $whatsapp_key = $meta->whatsapp_api;
        $transaksi = $this->transaksi_model->last_transaksi($insert_id);
        $whatsapp = $transaksi->passenger_phone;


        $message = "

            Terima Kasih Atas Pesanan Anda 
            Berikut rincian Pesanan anda
            ----------------------------
            Detail Customer
            ----------------------------
            Nama            :  . $transaksi->passenger_name . 
            email           :  . $transaksi->passenger_email . 
            ----------------------------
            Detail Pesanan
            ----------------------------
            Mobil           :  . $transaksi->mobil_name . 
            Paket           :  . $transaksi->paket_name . 
            Tgl jemput      :  . $transaksi->tanggal_jemput . 
            Jam jemput      :  . $transaksi->jam_jemput . 
            Alamat jemput   :  . $transaksi->alamat_jemput . 
            ----------------------------
            Detail Harga
            ----------------------------
            Total Harga     :  . $transaksi->total_price . 
            Diskon Point    :  . $transaksi->diskon_point . 
            Diskon Promo    :  . $transaksi->promo_amount . 
            Total Harga     :  . $transaksi->grand_total . 
            ----------------------------
            Pembayaran
            ----------------------------
            Silahkan melakukan Pembayaran 
            Melalui Driver Saat Penjemputan

            Terima Kasih Atas Pesanan Anda.
            Jika butuh bantuan silahkan 
            menghubungi.
             . $meta->whatsapp . 

            ";

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
