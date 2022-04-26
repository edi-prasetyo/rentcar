<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
    /**
     * Development By Edi Prasetyo
     * edikomputer@gmail.com
     * 0812 3333 5523
     * https://edikomputer.com
     * https://grahastudio.com
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('meta_model');
        $this->load->model('page_model');
    }

    public function index()
    {
        $meta           = $this->meta_model->get_meta();
        $page           = $this->page_model->get_page();

        $data = array(
            'title'       => 'Halaman',
            'deskripsi'   => 'Berita - ' . $meta->description,
            'keywords'    => 'Berita - ' . $meta->keywords,
            'page'        => $page,
            'content'     => 'front/page/index_page'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }

    public function detail($page_slug)
    {
        $meta           = $this->meta_model->get_meta();
        $page           = $this->page_model->read($page_slug);


        $data = array(
            'title'       => $page->page_title,
            'deskripsi'   => 'Halaman - ' . $meta->description,
            'keywords'    => 'Halaman - ' . $meta->keywords,
            'page'        => $page,
            'content'     => 'front/page/detail_page'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}
