<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->library('pagination');
        $this->load->model('meta_model');
        $this->load->model('main_model');
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('transaksi_model');
        $this->load->model('persentase_model');
        $this->load->model('tarif_model');
    }
    //Index
    public function index()
    {
        redirect(base_url('transaksi/calculate/'), 'refresh');
    }

    public function calculate()
    {
        $this->form_validation->set_rules(
            'address',
            'Nomor Resi',
            'required',
            [
                'required'      => 'Nomor Resi',
            ]
        );
        $this->form_validation->set_rules(
            'jarak',
            'Nomor Resi',
            'required',
            [
                'required'      => 'Nomor Resi',
            ]
        );
        if ($this->form_validation->run() == false) {
            $data = [
                'title'         => 'Buat Pesanan',
                'deskripsi'     => 'Cek Resi Pengiriman',
                'keywords'      => 'Resi',
                'content'       => 'front/transaksi/calculate'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            //Validasi Berhasil
            $this->create();
        }
    }

    //Create
    public function create()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);

        $origin = "";
        if ($this->input->get('origin') != NULL) {
            $origin = $this->input->get('origin');
            $this->session->set_userdata(array("origin" => $origin));
        } else {
            if ($this->session->userdata('origin') != NULL) {
                $origin = $this->session->userdata('origin');
            }
        }
        $address = "";
        if ($this->input->get('address') != NULL) {
            $address = $this->input->get('address');
            $this->session->set_userdata(array("address" => $address));
        } else {
            if ($this->session->userdata('address') != NULL) {
                $address = $this->session->userdata('address');
            }
        }
        $jarak = "";
        if ($this->input->get('jarak') != NULL) {
            $jarak = $this->input->get('jarak');
            $this->session->set_userdata(array("jarak" => $jarak));
        } else {
            if ($this->session->userdata('jarak') != NULL) {
                $jarak = $this->session->userdata('jarak');
            }
        }


        $product            = $this->product_model->car_product();
        $total_price        = $jarak * $product->price + $product->start_price;

        $this->form_validation->set_rules(
            'passenger_name',
            'Harga Paket',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                           => 'Buat Transaksi',
                'product'                         => $product,
                'origin'                          => $origin,
                'address'                         => $address,
                'jarak'                           => $jarak,
                'total_price'                     => $total_price,
                'user'                            => $user,
                'content'                         => 'front/transaksi/create'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {

            $order_id = strtoupper(random_string('alnum', 7));
            $data  = [
                'user_id'                           => $this->session->userdata('id'),
                'product_id'                        => $this->input->post('product_id'),
                'order_id'                          => $order_id,
                'order_type'                        => 'Online',
                'passenger_name'                    => $this->input->post('passenger_name'),
                'passenger_phone'                   => $this->input->post('passenger_phone'),
                'passenger_email'                   => $this->input->post('passenger_email'),
                'permintaan_khusus'                 => $this->input->post('permintaan_khusus'),
                'origin'                            => $origin,
                'destination'                       => $address,
                'jarak'                             => $jarak,
                'start_price'                       => $product->start_price,
                'total_price'                       => $total_price,
                'stage'                             => 1,
                'status'                            => 'Mencari Pengemudi',
                'date_created'                      => date('Y-m-d H:i:s'),
                'date_updated'                      => date('Y-m-d H:i:s')
            ];
            // $this->transaksi_model->create($data);
            $insert_id = $this->transaksi_model->create($data);
            $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
            redirect(base_url('transaksi/sukses/' . $insert_id), 'refresh');
        }
    }
    public function sukses($insert_id)
    {
        $id = $insert_id;
        $transaksi = $this->transaksi_model->last_transaksi($id);
        $data = [
            'title'     => 'Order Sukses',
            'transaksi' => $transaksi,
            'content'   => 'front/transaksi/sukses'
        ];
        $this->load->view('front/layout/wrapp', $data);
    }
    //Create
    public function dropoff()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);


        $origin = "";
        if ($this->input->get('origin') != NULL) {
            $origin = $this->input->get('origin');
            $this->session->set_userdata(array("origin" => $origin));
        } else {
            if ($this->session->userdata('origin') != NULL) {
                $origin = $this->session->userdata('origin');
            }
        }
        $destination = "";
        if ($this->input->get('destination') != NULL) {
            $origin = $this->input->get('destination');
            $this->session->set_userdata(array("destination" => $destination));
        } else {
            if ($this->session->userdata('destination') != NULL) {
                $destination = $this->session->userdata('destination');
            }
        }

        $product            = $this->product_model->car_product();

        $this->form_validation->set_rules(
            'passenger_name',
            'Harga Paket',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                           => 'Buat Transaksi',
                'product'                         => $product,
                'origin'                          => $origin,
                'destination'                          => $destination,
                'user'                            => $user,
                'content'                         => 'front/transaksi/dropoff'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {

            $order_id = strtoupper(random_string('alnum', 7));
            $data  = [
                'user_id'                           => $this->session->userdata('id'),
                'product_id'                        => $this->input->post('product_id'),
                'order_id'                          => $order_id,
                'order_type'                        => 'Drop Off',
                'passenger_name'                    => $this->input->post('passenger_name'),
                'passenger_phone'                   => $this->input->post('passenger_phone'),
                'passenger_email'                   => $this->input->post('passenger_email'),
                'origin'                            => $origin,
                'destination'                       => $destination,
                'total_price'                       => $this->input->post('total_price'),
                'stage'                             => 1,
                'status'                            => 'Mencari Pengemudi',
                'date_created'                      => date('Y-m-d H:i:s'),
                'date_updated'                      => date('Y-m-d H:i:s')
            ];
            // $this->transaksi_model->create($data);
            $insert_id = $this->transaksi_model->create($data);
            $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
            redirect(base_url('transaksi/sukses/' . $insert_id), 'refresh');
        }
    }
    public function select_driver($insert_id)
    {
        $driver                     = $this->user_model->get_driver();
        $last_transaksi             = $this->transaksi_model->last_transaksi($insert_id);

        $user_id = $this->input->post('driver_id');
        $user_driver = $this->user_model->user_detail($user_id);

        // var_dump($user_driver);
        // die;


        $this->form_validation->set_rules(
            'driver_id',
            'Harga Paket',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'             => 'Pilih Driver',
                'driver'            => $driver,
                'last_transaksi'    => $last_transaksi,
                'insert_id'         => $insert_id,
                'content'           => 'front/transaksi/selectdriver'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            if ($user_driver->status == 0 && $user_driver->saldo_driver >= 1) {
                $data = [
                    'id'                => $insert_id,
                    'driver_id'         => $user_id,
                    'stage'             => 2,
                ];
                $this->transaksi_model->update($data);
                //Update Status Driver
                $this->update_status_driver($user_id);

                $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
                redirect(base_url('front/transaksi/success'), 'refresh');
            } elseif ($user_driver->saldo_driver <= 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Saldo tidak mencukupi, pastikan driver memiliki saldo</div> ');
                redirect(base_url('front/transaksi/select_driver/' . $insert_id), 'refresh');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Driver masih memiliki order yang belum di selesaikan</div> ');
                redirect(base_url('front/transaksi/select_driver/' . $insert_id), 'refresh');
            }
        }
    }

    public function update_status_driver($user_id)
    {
        $data = [
            'id'                => $user_id,
            'status'             => 1,
        ];
        $this->user_model->update($data);
    }

    public function success()
    {
        $data = [
            'title'     => 'Order Berhasil',
            'content'   => 'front/transaksi/success'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    // Update Transaksi
    public function update($id)
    {
        $user = $this->session->userdata('id');
        $transaksi = $this->transaksi_model->detail($id);
        if ($transaksi->user_id == $user && $transaksi->stage == 1) {

            // Start Update

            $provinsi       = $this->main_model->getProvinsi();
            $product        = $this->product_model->get_product();
            $category       = $this->category_model->get_category();


            $this->form_validation->set_rules(
                'provinsi_id',
                'Provinsi Tujuan',
                'required',
                array(
                    'required'                        => 'Pilih %s'
                )
            );
            $this->form_validation->set_rules(
                'kota_id',
                'Kota Tujuan',
                'required',
                array(
                    'required'                        => 'Pilih %s'
                )
            );
            $this->form_validation->set_rules(
                'category_id',
                'Kategori Barang',
                'required',
                array(
                    'required'                        => 'Pilih %s'
                )
            );
            $this->form_validation->set_rules(
                'product_id',
                'Paket',
                'required',
                array(
                    'required'                        => 'Pilih %s'
                )
            );
            $this->form_validation->set_rules(
                'nama_pengirim',
                'Nama Pengirim',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            $this->form_validation->set_rules(
                'telp_pengirim',
                'Telp Pengirim',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            $this->form_validation->set_rules(
                'alamat_pengirim',
                'Alamat Pengirim',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            $this->form_validation->set_rules(
                'kodepos_pengirim',
                'Kode Pos Pengirim',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            $this->form_validation->set_rules(
                'nama_penerima',
                'Nama Penerima',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            $this->form_validation->set_rules(
                'telp_penerima',
                'Telp Penerima',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            $this->form_validation->set_rules(
                'alamat_penerima',
                'Alamat Penerima',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            $this->form_validation->set_rules(
                'kodepos_penerima',
                'Kode Pos Penerima',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            $this->form_validation->set_rules(
                'nama_barang',
                'Nama Barang',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            $this->form_validation->set_rules(
                'berat',
                'Berat Paket',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            $this->form_validation->set_rules(
                'harga',
                'Harga Paket',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            if ($this->form_validation->run() === FALSE) {
                $data = [
                    'title'                           => 'Buat Transaksi',
                    'provinsi'                        => $provinsi,
                    'product'                         => $product,
                    'category'                        => $category,
                    'user'                            => $user,
                    'transaksi'                       => $transaksi,
                    'content'                         => 'front/transaksi/update'
                ];
                $this->load->view('front/layout/wrapp', $data, FALSE);
            } else {


                $asuransi = $this->input->post('asuransi');
                if ($asuransi == 0) {
                    $nilai_asuransi               = $this->input->post('nilai_asuransi_zero');
                    $fix_nilai_asuransi           =  $nilai_asuransi;
                    // Nilai Barang Zero
                    $nilai_barang               = $this->input->post('nilai_barang_zero');
                    $fix_nilai_barang           = preg_replace('/\D/', '', $nilai_barang);
                } else {
                    $nilai_asuransi               = $this->input->post('nilai_asuransi');
                    $fix_nilai_asuransi           = preg_replace('/\D/', '', $nilai_asuransi);
                    // Nilai Barang
                    $nilai_barang               = $this->input->post('nilai_barang');
                    $fix_nilai_barang           = preg_replace('/\D/', '', $nilai_barang);
                }


                $harga               = $this->input->post('harga');
                $fix_harga           = preg_replace('/\D/', '', $harga);

                $total_harga         = (int)$fix_harga + (int)$fix_nilai_asuransi;


                $provinsi_id    = $this->input->post('provinsi_id');
                $kota_id        = $this->input->post('kota_id');

                $Getprovinsi = $this->provinsi_model->detail_provinsi($provinsi_id);
                $Getkota = $this->kota_model->detail($kota_id);

                $provinsi_to = $Getprovinsi->provinsi_name;
                $kota_to = $Getkota->kota_name;


                $data  = [
                    'id'                                => $id,
                    'user_id'                           => $this->session->userdata('id'),
                    'category_id'                       => $this->input->post('category_id'),
                    'product_id'                        => $this->input->post('product_id'),
                    'provinsi_id'                       => $this->input->post('provinsi_id'),
                    'kota_id'                           => $this->input->post('kota_id'),
                    'provinsi_to'                       => $provinsi_to,
                    'kota_to'                           => $kota_to,
                    'nama_pengirim'                     => $this->input->post('nama_pengirim'),
                    'telp_pengirim'                     => $this->input->post('telp_pengirim'),
                    'alamat_pengirim'                   => $this->input->post('alamat_pengirim'),
                    'email_pengirim'                    => $this->input->post('email_pengirim'),
                    'kodepos_pengirim'                  => $this->input->post('kodepos_pengirim'),
                    'nama_penerima'                     => $this->input->post('nama_penerima'),
                    'telp_penerima'                     => $this->input->post('telp_penerima'),
                    'alamat_penerima'                   => $this->input->post('alamat_penerima'),
                    'email_penerima'                    => $this->input->post('email_penerima'),
                    'kodepos_penerima'                  => $this->input->post('kodepos_penerima'),
                    'nama_barang'                       => $this->input->post('nama_barang'),
                    'berat'                             => $this->input->post('berat'),
                    'koli'                              => $this->input->post('koli'),
                    'panjang'                           => $this->input->post('panjang'),
                    'lebar'                             => $this->input->post('lebar'),
                    'tinggi'                            => $this->input->post('tinggi'),
                    'harga'                             => $fix_harga,
                    'asuransi'                          => $this->input->post('asuransi'),
                    'nilai_asuransi'                    => $fix_nilai_asuransi,
                    'total_harga'                       => $total_harga,
                    'nilai_barang'                      => $fix_nilai_barang,
                    'user_stage'                        => $this->session->userdata('id'),
                    'date_updated'                      => date('Y-m-d H:i:s')
                ];
                $this->transaksi_model->update($data);
                //Update Status Lacak
                $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
                redirect(base_url('front/transaksi'), 'refresh');
            }

            // End Update

        } else {
            redirect('front/404');
        }
    }
    // Cancel Transaksi
    public function cancel($id)
    {
        $user = $this->session->userdata('id');
        $transaksi = $this->transaksi_model->detail($id);
        if ($transaksi->user_id == $user && $transaksi->stage == 1) {
            //Proteksi delete
            is_login();
            $data = [
                'id'                        => $id,
                'stage'                     => 10,
            ];
            $this->transaksi_model->update($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable fade show" > Data Telah di Batalkan <button class="close" data-dismiss="alert" aria-label="Close">×</button></div>');
            redirect(base_url('front/transaksi'), 'refresh');
        } else {
            redirect('front/404');
        }
    }
    // Riwayat Transaksi
    public function riwayat()
    {
        $user_id = $this->session->userdata('id');
        $search = $this->input->post('search');

        $config['base_url']         = base_url('front/transaksi/riwayat/index');
        $config['total_rows']       = count($this->transaksi_model->get_row_front($user_id, $search));
        $config['per_page']         = 10;
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
        $transaksi = $this->transaksi_model->get_riwayat_front($limit, $start, $user_id, $search);
        $data = [
            'title'                 => 'Riwayat Transaksi',
            'transaksi'             => $transaksi,
            'search'     => '',
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'front/transaksi/riwayat'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }

    public function detail($id)
    {
        $user_id = $this->session->userdata('id');
        $transaksi = $this->transaksi_model->detail_front($id, $user_id);

        if ($transaksi->user_id == $user_id) {

            $data = [
                'title'                 => 'Detail Transaksi',
                'transaksi'             => $transaksi,
                'content'               => 'front/transaksi/detail'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('front/404'));
        }
    }

    public function print($id)
    {
        $user_id = $this->session->userdata('id');
        $transaksi = $this->transaksi_model->detail_front($id, $user_id);

        if ($transaksi->user_id == $user_id) {

            $data = [
                'title'                 => 'Detail Transaksi',
                'transaksi'             => $transaksi,
                'content'               => 'front/transaksi/print'
            ];
            $this->load->view('front/transaksi/print', $data, FALSE);
        } else {
            redirect(base_url('front/404'));
        }
    }
}
