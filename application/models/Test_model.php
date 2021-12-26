<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test_model extends CI_Model
{
    //load database

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_all()
    {
        $this->db->select('id');
        $this->db->from('test');
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result();
    }
    public function batch_data($table, $data)
    {
        $this->db->update_batch($table, $data, 'id'); // this will set the id column as the condition field
        return true;
    }
}
