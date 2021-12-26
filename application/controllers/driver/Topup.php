<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Topup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('pagination');
        $this->load->model('user_model');
        $this->load->model('nilaitopup_model');
        $this->load->model('topup_model');
        $this->load->model('bank_model');
    }
    public function index()
    {
        $code_topup = date('dmY') . strtoupper(random_string('alnum', 5));
        $nominal = $this->nilaitopup_model->get_nilai_topup();
        $bank = $this->bank_model->get_allbank();

        $user = $this->session->userdata('id');
        $my_topup = $this->topup_model->get_my_topup($user);

        $this->form_validation->set_rules(
            'nominal',
            'Nominal',
            'required',
            array(
                'required'                        => 'Anda Harus Memilih %s Top Up',
            )
        );
        if ($this->form_validation->run()) {

            $config['upload_path']          = './assets/img/struk/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 500000000000; //Dalam Kilobyte
            $config['max_width']            = 500000000000; //Lebar (pixel)
            $config['max_height']           = 500000000000; //tinggi (pixel)
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto_struk')) {

                $data = [
                    'title'                 => 'Top Up saldo Deposit',
                    'bank'                  => $bank,
                    'nominal'               => $nominal,
                    'my_topup'              => $my_topup,
                    'error_upload'          => $this->upload->display_errors(),
                    'content'               => 'driver/topup/index'
                ];
                $this->load->view('driver/layout/wrapp', $data, FALSE);
            } else {

                //Proses Manipulasi Gambar
                $upload_data    = array('uploads'  => $this->upload->data());
                //Gambar Asli dcontentmpan di folder assets/upload/Struk
                //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/struk/thumbs

                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/struk/' . $upload_data['uploads']['file_name'];
                //Gambar Versi Kecil dipindahkan
                // $config['new_image']        = './assets/img/struk/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 500;
                $config['height']           = 500;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();

                $data  = [
                    'user_id'                   => $this->session->userdata('id'),
                    'code_topup'                => $code_topup,
                    'foto_struk'                => $upload_data['uploads']['file_name'],
                    'nominal'                   => $this->input->post('nominal'),
                    'keterangan'                => 'Top Up Driver',
                    'status_bayar'              => 'Pending',
                    'status_read'               => 0,
                    'date_created'              => date('Y-m-d H:i:s')
                ];
                $insert_id = $this->topup_model->create($data);
                $this->session->set_flashdata('message', 'Data telah ditambahkan');
                redirect(base_url('driver/topup/success/' . $insert_id), 'refresh');
            }
        }
        $data = [
            'title'                 => 'Top Up saldo',
            'bank'                  => $bank,
            'nominal'               => $nominal,
            'my_topup'              => $my_topup,
            'error_upload'          => $this->upload->display_errors(),
            'content'               => 'driver/topup/index'
        ];
        $this->load->view('driver/layout/wrapp', $data, FALSE);
    }
    public function success($insert_id)
    {
        $user = $this->session->userdata('id');

        $bank                               = $this->bank_model->get_allbank();
        $last_topup                         = $this->topup_model->last_topup($insert_id, $user);

        if ($last_topup->user_id == $user) {

            $data = [
                'title'                           => 'Success',
                'last_topup'                      => $last_topup,
                'bank'                            => $bank,
                'content'                         => 'driver/topup/success'
            ];
            $this->load->view('driver/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('driver/404'), 'refresh');
        }
    }

    // Detail Top Up
    public function detail($id)
    {
        $user_id    = $this->session->userdata('id');
        $topup      = $this->topup_model->detail_topup_konfirmasi($id);

        if ($topup->user_id == $user_id) {
            $data = [
                'title'     => 'Detail Top Up',
                'topup'     => $topup,
                'content'   => 'driver/topup/detail'
            ];
            $this->load->view('driver/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('driver/404'), 'refresh');
        }
    }

    // Konfirmasi Order
    public function konfirmasi($id)
    {
        $user_id = $this->session->userdata('id');
        $bank = $this->bank_model->get_allbank();
        $topup = $this->topup_model->detail_topup_konfirmasi($id);
        // var_dump($topup);
        // die;

        if ($topup->user_id == $user_id) {

            $config['upload_path']          = './assets/img/struk/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 500000000000; //Dalam Kilobyte
            $config['max_width']            = 500000000000; //Lebar (pixel)
            $config['max_height']           = 500000000000; //tinggi (pixel)
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto_struk')) {

                $data = [
                    'title' => 'Konfirmasi',
                    'topup' => $topup,
                    'bank'  => $bank,
                    'content'   => 'driver/topup/konfirmasi'
                ];
                $this->load->view('driver/layout/wrapp', $data, FALSE);
            } else {

                //Proses Manipulasi Gambar
                $upload_data    = array('uploads'  => $this->upload->data());
                //Gambar Asli dcontentmpan di folder assets/upload/Struk
                //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/struk/thumbs

                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/struk/' . $upload_data['uploads']['file_name'];
                //Gambar Versi Kecil dipindahkan
                // $config['new_image']        = './assets/img/struk/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 500;
                $config['height']           = 500;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();

                $data  = array(
                    'id'                    => $id,
                    'foto_struk'            => $upload_data['uploads']['file_name'],
                    'status_bayar'          => 'Process',
                    'date_updated'          => date('Y-m-d H:i:s')
                );
                $this->topup_model->update($data);
                $this->session->set_flashdata('sukses', 'Terima Kasih Atas konfirmasi anda,  Top Up akan segera kami proses');
                redirect(base_url('driver/topup/berhasil'), 'refresh');
            }
        } else {
            redirect(base_url('driver/404'), 'refresh');
        }
    }
    // Top Up Berhasil
    public function berhasil()
    {
        $data = [
            'title'     => 'Konfirmai Berhasil',
            'content'   => 'driver/topup/berhasil'
        ];
        $this->load->view('driver/layout/wrapp', $data, FALSE);
    }
    // Batalkan Order
    public function batal($id)
    {
        $user_id        = $this->session->userdata('id');
        $user           = $this->user_model->user_detail($user_id);
        $user_proccess  = $user->name;

        $topup                          = $this->topup_model->detail_topup($id);

        if ($topup->user_id == $user_id) {

            $this->form_validation->set_rules(
                'topup_reason',
                'Reason',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            if ($this->form_validation->run() === FALSE) {
                $data = [
                    'title'                             => 'Top Up Decline',
                    'topup'                             => $topup,
                    'content'                           => 'driver/topup/batal'
                ];
                $this->load->view('driver/layout/wrapp', $data, FALSE);
            } else {
                $data  = array(
                    'id'                    => $id,
                    'user_proccess'         => $user_proccess,
                    'topup_reason'          => $this->input->post('topup_reason'),
                    'status_bayar'          => 'Decline',
                    'date_updated'          => date('Y-m-d H:i:s')
                );
                $this->topup_model->update($data);
                $this->session->set_flashdata('sukses', 'Transaksi Telah di batalkan');
                redirect(base_url('driver/topup'), 'refresh');
            }
        } else {
            redirect(base_url('driver/404'), 'refresh');
        }
    }
    // Riwayat Top Up
    public function riwayat()
    {
        $user_id = $this->session->userdata('id');
        $config['base_url']         = base_url('driver/topup/riwayat/index');
        $config['total_rows']       = count($this->topup_model->get_row_driver($user_id));
        $config['per_page']         = 20;
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
        $topup = $this->topup_model->get_riwayat_topup_driver($limit, $start, $user_id);
        $data = [
            'title'                 => 'Riwayat Top Up',
            'topup'                 => $topup,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'driver/topup/riwayat'
        ];
        $this->load->view('driver/layout/wrapp', $data, FALSE);
    }
}
