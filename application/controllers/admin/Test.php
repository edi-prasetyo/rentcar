<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('test_model');
        $this->load->library('pagination');
    }
    public function index()
    {
        $id = $this->test_model->get_all();
        // var_dump($id);
        // die;
        $data = [
            'title'         => 'Test',
            'content'       => 'admin/test/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function update_record()
    {
        $id = $this->test_model->get_all();
        $status = 0;
        $result = array();
        foreach ($id as $key) {
            $result[] = array(
                'id' => $key->id,
                'status' => $status,
            );
        }
        // var_dump($result);
        // die;
        $this->db->update_batch('test', $result, 'id');
    }
    // public function update_status()
    // {
    //     $id = $this->test_model->get_all();
    //     $sd=array();        
    //     foreach($_POST['your_newly_posted_seeds'] as $key=>$value){
    //         $sd['id']=$value->id;
    //         $sd['tournament_id']=$tournament_id;
    //         //...
    //         array_push($seeded, $sd);
    //     }

    //     $this->db->update_batch('tournament_seed', $seeded, 'id');
    // }
    // public function update_record()
    // {
    //     $id = $this->test_model->get_all();
    //     $data = array(
    //         array(
    //             'id' => 3,
    //             'status' => '1',
    //         ),
    //         array(
    //             'id' => 4,
    //             'status' => '1',
    //         )
    //     );
    //     $this->db->update_batch('test', $data, 'id');
    // }
}
