<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo extends CI_Controller
{
  //Load Model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('promo_model');
    $this->load->model('category_model');
    $this->load->model('meta_model');
    $this->load->library('pagination');
  }
  //main page - Promo
  public function index()
  {
    $category = $this->category_model->category_sidebar();
    $promo_sidebar = $this->promo_model->promo_sidebar();
    $meta                           = $this->meta_model->get_meta();
    // Listing Promo Dengan Pagination
    $this->load->library('pagination');
    $config['base_url']             = base_url('promo/index/');
    $config['total_rows']           = count($this->promo_model->total());
    $config['per_page']             = 3;
    $config['uri_segment']          = 4;
    //Limit dan Start
    $limit                          = $config['per_page'];
    $start                          = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
    //End Limit Start
    $this->pagination->initialize($config);
    $promo                         = $this->promo_model->promo($limit, $start);
    // End Listing Promo dengan paginasi
    if (!$this->agent->is_mobile()) {
      // Desktop View
      $data = array(
        'title'                       => 'Promo - ' . $meta->title,
        'deskripsi'                   => 'Promo - ' . $meta->description,
        'keywords'                    => 'Promo - ' . $meta->keywords,
        'paginasi'                    => $this->pagination->create_links(),
        'promo'                      => $promo,
        'promo_sidebar'              => $promo_sidebar,
        'category'                    => $category,
        'content'                     => 'front/promo/index'
      );
      $this->load->view('front/layout/wrapp', $data, FALSE);
    } else {
      // Mobile View
      $data = array(
        'title'                       => 'Promo - ' . $meta->title,
        'deskripsi'                   => 'Promo - ' . $meta->description,
        'keywords'                    => 'Promo - ' . $meta->keywords,
        'paginasi'                    => $this->pagination->create_links(),
        'promo'                      => $promo,
        'category'                    => $category,
        'content'                     => 'mobile/promo/index'
      );
      $this->load->view('mobile/layout/wrapp', $data, FALSE);
    }
  }
  //main page - detail Promo
  public function detail($promo_slug = NULL)
  {
    $promo_sidebar = $this->promo_model->promo_sidebar();

    if (!empty($promo_slug)) {
      $promo_slug;
    } else {
      redirect(base_url('promo'));
    }
    $promo                         = $this->promo_model->read($promo_slug);

    if (!$this->agent->is_mobile()) {
      // Desktop View
      $data                           = array(
        'title'                       => $promo->promo_title,
        'deskripsi'                   => $promo->promo_title,
        'keywords'                    => $promo->promo_keywords,
        'promo'                      => $promo,
        'promo_sidebar'              => $promo_sidebar,
        'tanggal_post'                => date('Y-m-d H:i:s'),
        'content'                     => 'front/promo/detail'
      );

      $this->load->view('front/layout/wrapp', $data, FALSE);
    } else {
      // Mobile View
      $data                           = array(
        'title'                       => 'Detail',
        'deskripsi'                   => $promo->name,
        'keywords'                    => $promo->name,
        'promo'                      => $promo,
        'tanggal_post'                => date('Y-m-d H:i:s'),
        'content'                     => 'mobile/promo/detail'
      );

      $this->load->view('mobile/layout/wrapp', $data, FALSE);
    }
  }
}

/* End of file Promo.php */
/* Location: ./application/controllers/Promo.php */
