<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model
{

    // Get cities
    function getProvinsi()
    {

        $response = array();

        // Select record
        $this->db->select('*');
        $this->db->order_by('provinsi_name', 'ASC');
        $q = $this->db->get('provinsi');

        $response = $q->result_array();

        return $response;
    }
    public function detail($id)
    {
        $this->db->select('*');
        $this->db->from('provinsi');
        $this->db->where(['id', $id]);
        $query = $this->db->get();
        return $query->row();
    }

    // Get City departments
    function getKota($postData)
    {
        $response = array();

        // Select record
        $this->db->select('id,kota_name');
        $this->db->where('provinsi_id', $postData['provinsi']);
        $this->db->order_by('kota_name', 'ASC');
        $q = $this->db->get('kota');
        $response = $q->result_array();

        return $response;
    }

    // Get Department user
    function getKecamatan($postData)
    {
        $response = array();

        // Select record
        $this->db->select('id,kecamatan_name');
        $this->db->where('kota_id', $postData['kota']);
        $q = $this->db->get('kecamatan');
        $response = $q->result_array();

        return $response;
    }
}
