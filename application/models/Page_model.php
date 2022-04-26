<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_page()
    {
        $this->db->select('*');
        $this->db->from('page');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function detail_page($id)
    {
        $this->db->select('*');
        $this->db->from('page');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($page_slug)
    {
        $this->db->select('*');
        $this->db->from('page');
        // Join

        //End Join
        $this->db->where(array(
            'page.page_slug'      =>  $page_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('page', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('page', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('page', $data);
    }

    //Total Berita Main Page
    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('page');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
