<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Wilayah extends CI_Controller
{

    public function index()
    {
        // load base_url 
        $this->load->helper('url');

        //load model 
        $this->load->model('Main_model');

        // get cities 
        $data['provinsi'] = $this->Main_model->getProvinsi();

        // load view 
        $this->load->view('wilayah_view', $data);
    }

    public function getKota()
    {
        // POST data 
        $postData = $this->input->post();

        // load model 
        $this->load->model('Main_model');

        // get data 
        $data = $this->Main_model->getKota($postData);
        echo json_encode($data);
    }

    public function getKecamatan()
    {
        // POST data 
        $postData = $this->input->post();

        // load model 
        $this->load->model('Main_model');

        // get data 
        $data = $this->Main_model->getKecamatan($postData);
        echo json_encode($data);
    }
}
