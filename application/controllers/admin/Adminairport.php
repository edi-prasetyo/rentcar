<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adminairport extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('pengaturan_model');
        $this->load->model('kota_model');
        $this->load->model('airport_model');
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

        $airport = $this->airport_model->get_allairport();
        $kota = $this->kota_model->get_allkota();

        $airport_id = "";
        if ($this->input->post('airport_id') != NULL) {
            $kota_id = $this->input->post('airport_id');
            $this->session->set_userdata(array("airport_id" => $kota_id));
        } else {
            if ($this->session->userdata('airport_id') != NULL) {
                $kota_id = $this->session->userdata('airport_id');
            }
        }
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
        $jam_jemput = "";
        if ($this->input->post('jam_jemput') != NULL) {
            $jam_jemput = $this->input->post('jam_jemput');
            $this->session->set_userdata(array("jam_jemput" => $jam_jemput));
        } else {
            if ($this->session->userdata('jam_jemput') != NULL) {
                $jam_jemput = $this->session->userdata('jam_jemput');
            }
        }


        $paket_sewa = $this->airport_model->search_city($airport_id, $kota_id);
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
                'title'         => 'Airport Car',
                'airport'          => $airport,
                'airport_id'    => $airport_id,
                'kota_id'       => $kota_id,
                'kota'          => $kota,
                'paket_sewa'    => $paket_sewa,
                'kota_name'     => $kota_name,

                'tanggal_sewa'  => $tanggal_sewa,
                'jam_jemput'      => $jam_jemput,
                'content'       => 'admin/airport/admin_airport'
            ];
            $this->load->view('admin/layout/wrapp', $data);
        } else {
            $this->kendaraan($airport_id, $kota_id);
        }
    }
    public function kendaraan($airport_id = false, $kota_id = false)
    {
        $kota = $this->kota_model->get_allkota();
        $airport = $this->airport_model->get_allairport();
        $airport_id = $this->input->get('airport_id');
        $kota_id = $this->input->get('kota_id');
        $tanggal_sewa = $this->input->get('tanggal_sewa');
        $jam_jemput = $this->input->get('jam_jemput');
        $paket_airport = $this->airport_model->search_city($airport_id, $kota_id);

        $airport_name = $this->airport_model->airport_encrypt($airport_id);
        $kota_name = $this->kota_model->kota_tujuan_encrypt($kota_id);


        // var_dump($paket_airport);
        // die;

        if (!$this->agent->is_mobile()) {
            // Desktop View
            $data = [
                'title'         => 'Pilih Kendaraan',
                'airport'       => $airport,
                'kota'          => $kota,
                'paket_airport'    => $paket_airport,
                'airport_name'     => $airport_name->airport_name,
                'kota_name'   => $kota_name->kota_name,
                'airport_id'     => $airport_id,
                'kota_id'     => $kota_id,
                'tanggal_sewa'  => $tanggal_sewa,
                'jam_jemput'      => $jam_jemput,
                'content'       => 'admin/airport/admin_kendaraan'
            ];
            $this->load->view('admin/layout/wrapp', $data);
        } else {
            // Mobile View
            $data = [
                'title'         => 'Pilih Kendaraan',
                'airport'       => $airport,
                'kota'          => $kota,
                'paket_airport'    => $paket_airport,
                'airport_name'     => $airport_name->airport_name,
                'kota_name'   => $kota_name->kota_name,
                'airport_id'     => $airport_id,
                'kota_id'     => $kota_id,
                'tanggal_sewa'  => $tanggal_sewa,
                'jam_jemput'      => $jam_jemput,
                'content'       => 'mobile/airport/kendaraan'
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

        $jam_jemput = "";
        if ($this->input->get('jam_jemput') != NULL) {
            $jam_jemput = $this->input->get('jam_jemput');
            $this->session->set_userdata(array("jam_jemput" => $jam_jemput));
        } else {
            if ($this->session->userdata('jam_jemput') != NULL) {
                $jam_jemput = $this->session->userdata('jam_jemput');
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
        $airport_id = "";
        if ($this->input->get('airport_id') != NULL) {
            $airport_id = $this->input->get('airport_id');
            $this->session->set_userdata(array("airport_id" => $airport_id));
        } else {
            if ($this->session->userdata('airport_id') != NULL) {
                $airport_id = $this->session->userdata('airport_id');
            }
        }
        $kota_tujuan = "";
        if ($this->input->get('kota_id') != NULL) {
            $kota_tujuan = $this->input->get('kota_id');
            $this->session->set_userdata(array("kota_id" => $kota_tujuan));
        } else {
            if ($this->session->userdata('kota_id') != NULL) {
                $kota_tujuan = $this->session->userdata('kota_id');
            }
        }
        $airport_name = "";
        if ($this->input->get('airport_name') != NULL) {
            $airport_name = $this->input->get('airport_name');
            $this->session->set_userdata(array("airport_name" => $airport_name));
        } else {
            if ($this->session->userdata('airport_name') != NULL) {
                $airport_name = $this->session->userdata('airport_name');
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
        $paket_price = "";
        if ($this->input->get('paket_price') != NULL) {
            $paket_price = $this->input->get('paket_price');
            $this->session->set_userdata(array("paket_price" => $paket_price));
        } else {
            if ($this->session->userdata('paket_price') != NULL) {
                $paket_price = $this->session->userdata('paket_price');
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

        $paket = $this->airport_model->airport_detail($airport_id, $kota_tujuan);
        // var_dump($paket);
        // die;

        // $paket_price    = $paket->paket_price;
        // $order_point    = $paket->paket_point;
        $ketentuan_desc = $paket->ketentuan_desc;
        $paket_desc     = $paket->paket_desc;

        // var_dump($paket_price);
        // die;



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
                'title'             => 'Pilih Kendaraan',
                'tanggal_sewa'      =>  $tanggal_sewa,
                'jam_jemput'        => $jam_jemput,
                'mobil_name'        => $mobil_name,
                'airport_id'        => $airport_id,
                'kota_tujuan'       => $kota_tujuan,
                'airport_name'      => $airport_name,
                'kota_name'         => $kota_name,
                'paket_price'       => $paket_price,
                'order_point'       => $order_point,
                'ketentuan_desc'    => $ketentuan_desc,
                'paket_desc'        => $paket_desc,
                'total_pointku'     => $total_pointku,
                'promo'             => $promo,
                'pembayaran'        => $pembayaran,
                'order_device'      => $order_device,
                'content'           => 'admin/airport/admin_order'
            ];
            $this->load->view('admin/layout/wrapp', $data);
        } else {

            $order_id = strtoupper(random_string('numeric', 7));
            $kode_transaksi = strtoupper(random_string('alnum', 7));
            $promo_amount = $this->input->post('promo_amount');
            $start_price = $this->input->post('start_price');
            $jumlah_mobil = $this->input->post('jumlah_mobil');

            $uang_bbm = $this->input->post('fuel_money');
            $uang_makan = $this->input->post('meal_allowance');
            $uang_inap = $this->input->post('accommodation_fee');
            $uang_dp = $this->input->post('down_payment');

            $total_price = (int) $start_price * (int) $jumlah_mobil;
            // $total_price = (int) $price + (int) $uang_bbm + (int) $uang_makan + (int) $uang_inap;

            $grand_total = (int) $total_price + (int) $uang_bbm + (int) $uang_makan + (int) $uang_inap  - (int) $promo_amount - (int)$uang_dp;




            $data  = [
                'user_id'                               => $this->session->userdata('id'),
                'order_device'                            => $this->input->post('order_device'),
                'product_id'                            => 2,
                // 'driver_name'                           => '',
                'product_name'                          => 'Airport',
                'order_id'                              => $order_id,
                'order_point'                           => $this->input->post('order_point'),
                'kode_transaksi'                        => $kode_transaksi,
                'passenger_name'                        => $this->input->post('passenger_name'),
                'passenger_phone'                       => $this->input->post('passenger_phone'),
                'passenger_email'                       => $this->input->post('passenger_email'),
                'kota_id'                               => $paket->kota_id,
                'origin'                                => $airport_name,
                'destination'                           => $kota_name,
                'mobil_id'                              => $mobil_id,
                'mobil_name'                            => $this->input->post('mobil_name'),
                'paket_id'                              => 0,
                'paket_name'                            => $airport_name . '-' . $kota_name,
                'alamat_jemput'                         => $this->input->post('alamat_jemput'),
                'tanggal_jemput'                        => $this->input->post('tanggal_jemput'),
                'jam_jemput'                            => $this->input->post('jam_jemput'),
                'permintaan_khusus'                     => $this->input->post('permintaan_khusus'),
                'lama_sewa'                             => 1,
                'jumlah_mobil'                          => $jumlah_mobil,
                'ketentuan_desc'                        => $this->input->post('ketentuan_desc'),
                'paket_desc'                            =>  $this->input->post('paket_desc'),
                'jarak'                                 => 0,
                'start_price'                           => $start_price,


                'fuel_money'                            => $uang_bbm,
                'meal_allowance'                        => $uang_makan,
                'accommodation_fee'                     => $uang_inap,
                'down_payment'                          => $uang_dp,

                'total_price'                           => $total_price,
                'diskon_point'                          => $this->input->post('diskon_point'),
                'promo_amount'                          => $promo_amount,
                'grand_total'                           => $grand_total,
                'status'                                => 'Pending',
                'status_read'                           => 0,
                'order_type'                            => 'airport',
                'pembayaran_id'                         => 0,
                'pembayaran'                            => $this->input->post('pembayaran'),
                'expired_payment_date'                  => null,
                'status_pembayaran'                     => 'Belum Dibayar',
                'no_va'                                 => '',
                'payment_channel'                       => 'VIRTUAL_ACCOUNT',
                'payment_transaction_id'                => '',
                'stage'                                 => 1,
                'date_created'                          => date('Y-m-d H:i:s'),
                'date_updated'                          => date('Y-m-d H:i:s'),
            ];
            $insert_id = $this->transaksi_model->create($data);
            // $this->update_point($insert_id);
            // $this->_sendEmail($insert_id, 'order');
            $this->_sendWhatsapp($insert_id);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('admin/transaksi/'), 'refresh');
        }
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
            Terima Kasih Atas Pesanan Anda 
            Berikut rincian Pesanan anda
            ----------------------------
            Detail Customer
            ----------------------------
            Nama            :  $transaksi->passenger_name  
            email           :  $transaksi->passenger_email 
            ----------------------------
            Detail Pesanan
            ----------------------------
            Mobil           :   $transaksi->mobil_name 
            Paket           :   $transaksi->paket_name  
            Tgl jemput      :   $transaksi->tanggal_jemput 
            Jam jemput      :   $transaksi->jam_jemput 
            Alamat jemput   :   $transaksi->alamat_jemput 
            ----------------------------
            Detail Harga
            ----------------------------
            Total Harga     :   $transaksi->total_price 
            Diskon Point    :   $transaksi->diskon_point 
            Diskon Promo    :   $transaksi->promo_amount 
            Total Harga     :   $transaksi->grand_total 
            ----------------------------
            Pembayaran
            ----------------------------
            Silahkan Klik Link di bawah ini untuk 
            melakukan Pembayaran
             $url_payment 
            Terima Kasih Atas Pesanan Anda.
            Jika butuh bantuan silahkan menghubungi
              $meta->whatsapp 
            
            ";
        } else {
            $message = "

            Terima Kasih Atas Pesanan Anda 
            Berikut rincian Pesanan anda
            ----------------------------
            Detail Customer
            ----------------------------
            Nama            :   $transaksi->passenger_name 
            email           :   $transaksi->passenger_email 
            ----------------------------
            Detail Pesanan
            ----------------------------
            Mobil           :   $transaksi->mobil_name 
            Paket           :   $transaksi->paket_name 
            Tgl jemput      :   $transaksi->tanggal_jemput 
            Jam jemput      :   $transaksi->jam_jemput 
            Alamat jemput   :   $transaksi->alamat_jemput 
            ----------------------------
            Detail Harga
            ----------------------------
            Total Harga     :   $transaksi->total_price 
            Diskon Point    :   $transaksi->diskon_point 
            Diskon Promo    :   $transaksi->promo_amount 
            Total Harga     :   $transaksi->grand_total 
            ----------------------------
            Pembayaran
            ----------------------------
            Silahkan melakukan Pembayaran 
            Melalui Driver Saat Penjemputan

            Terima Kasih Atas Pesanan Anda.
            Jika butuh bantuan silahkan 
            menghubungi.
              $meta->whatsapp 
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
