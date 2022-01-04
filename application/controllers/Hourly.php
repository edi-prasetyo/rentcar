<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hourly extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('pengaturan_model');
        $this->load->model('kota_model');
        // $this->load->model('hourly_model');
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
                // 'paket_sewa'    => $paket_sewa,
                'kota_id'       => $kota_id,
                'kota_name'     => $kota_name,
                'tanggal_sewa'  => $tanggal_sewa,
                'jam_sewa'      => $jam_sewa,
                'content'       => 'front/hourly/index'
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
            'content'       => 'front/hourly/kendaraan'
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

        $mobil      = $this->mobil_model->detail_encrypt($mobil_id);
        $kota       = $this->kota_model->detail_encrypt($kota_id);

        $paket      = $this->paket_model->get_paket_hourly($kota_id, $mobil_id);

        $data = [
            'title'         => 'Pilih Kendaraan',
            'paket'         => $paket,
            'mobil'         => $mobil,
            'kota'          => $kota,
            'tanggal_sewa'  =>  $tanggal_sewa,
            'jam_sewa'      => $jam_sewa,
            'content'       => 'front/hourly/paket'
        ];
        $this->load->view('front/layout/wrapp', $data);
    }
    public function order()
    {
        $user_id = $this->session->userdata('id');
        $total_pointku = $this->point_model->total_user_point($user_id);
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
        $paket_name = $paket->paket_name;
        $paket_price = $paket->paket_price;
        $order_point = $paket->paket_point;
        $ketentuan_desc = $paket->ketentuan_desc;


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
                'total_pointku'     => $total_pointku,
                'content'           => 'front/hourly/order'
            ];
            $this->load->view('front/layout/wrapp', $data);
        } else {

            $order_id = strtoupper(random_string('numeric', 7));
            $kode_transaksi = strtoupper(random_string('alnum', 7));
            $start_price = $this->input->post('start_price');
            $lama_sewa = $this->input->post('lama_sewa');
            $jumlah_mobil = $this->input->post('jumlah_mobil');
            $diskon_point = $this->input->post('diskon_point');
            $total_price = (int)$start_price *  (int)$jumlah_mobil;
            $grand_total = (int)$start_price *  (int)$jumlah_mobil - (int)$diskon_point;
            // var_dump($total_price);
            // die;

            $data  = [
                'user_id'                               => $this->session->userdata('id'),
                'product_id'                            => 5,
                'order_id'                              => $order_id,
                'order_point'                              =>  $order_point,
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
                'order_type'                            => 'Hourly',
                'status'                                => 'Pending',
                'date_created'                          => date('Y-m-d H:i:s')
            ];
            $insert_id = $this->transaksi_model->create($data);
            $this->_sendEmail($insert_id, 'order');
            $this->sukses($insert_id);
            $this->update_point($insert_id);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('hourly/sukses/' . $insert_id), 'refresh');
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
        $this->email->from("$email_order->smtp_user", "Order", "$meta->title");
        $this->email->to($this->input->post('user_email'));
        $this->email->cc("$email_order->cc_email");
        $this->email->bcc("$email_order->bcc_email");

        $this->email->subject('Order ' . $transaksi->kode_transaksi . '');
        $this->email->message('
        Rental              : ' . $meta->title . '<br>
        Order ID            : ' . $transaksi->order_id . '<br>
        Mobil               : ' . $transaksi->mobil_name . '<br>
        Alamat Jemput       : ' . $transaksi->alamat_jemput . '<br>
        Tanggal Jemput      : ' . $transaksi->tanggal_jemput . '<br>
        Jam Jemput          : ' . $transaksi->jam_jemput . '<br>
        Paket               : ' . $transaksi->paket_name . '<br>
        Permintaan Khusus   : ' . $transaksi->permintaan_khusus . '<br>
        Total Pembayaran    : ' . number_format($transaksi->grand_total, 0, ",", ".") . '<br>
        Pembayaran          : ' . $transaksi->pembayaran . '
        ');

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
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
    public function sukses($insert_id)
    {
        $id = $insert_id;
        $transaksi = $this->transaksi_model->last_transaksi($id);
        $data = [
            'title'     => 'Order Sukses',
            'transaksi' => $transaksi,
            'content'   => 'front/hourly/sukses'
        ];
        $this->load->view('front/layout/wrapp', $data);
    }
}
