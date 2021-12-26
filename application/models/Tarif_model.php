
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tarif_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_alltarif()
    {
        $this->db->select('tarif.*, provinsi_name');
        $this->db->from('tarif');
        // join
        $this->db->join('provinsi', 'provinsi.id = tarif.provinsi_id', 'LEFT');
        // End Join
        $this->db->order_by('provinsi.provinsi_name', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_tarif($limit, $start)
    {
        $this->db->select('tarif.*, provinsi_name');
        $this->db->from('tarif');
        // join
        $this->db->join('provinsi', 'provinsi.id = tarif.provinsi_id', 'LEFT');
        // End Join
        $this->db->limit($limit, $start);
        $this->db->order_by('provinsi.provinsi_name', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('tarif');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail_tarif_destinasi($destinasi_id)
    {
        $this->db->select('tarif.*, product.product_name');
        $this->db->from('tarif');
        // join
        $this->db->join('product', 'product.id = tarif.product_id', 'LEFT');
        // End Join
        $this->db->where('destinasi_id', $destinasi_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function detail($tarif_id)
    {
        $this->db->select('*');
        $this->db->from('tarif');
        $this->db->where('id', $tarif_id);
        $query = $this->db->get();
        return $query->row();
    }
    public function detail_tarif($id)
    {
        $this->db->select('*');
        $this->db->from('tarif');
        // join
        $this->db->join('product', 'product.id = tarif.product_id', 'LEFT');
        // End Join
        $this->db->where('tarif.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function tarif_by_provinsi($provinsi_id)
    {
        $this->db->select('*');
        $this->db->from('tarif');
        $this->db->where(['id', $provinsi_id]);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Create
    public function create($data)
    {
        $this->db->insert('tarif', $data);
    }
    // Create
    public function create_tarif($data)
    {
        $this->db->insert_batch('tarif', $data);
    }

    // Update
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tarif', $data);
    }
    //
    //Delete Data
    public function delete($id_tarif)
    {
        $this->db->where_in('id', $id_tarif);
        $this->db->delete('tarif');
    }

    public function get_cek_tarif($destinasi_id)
    {
        $this->db->select('tarif.*, product.product_name');
        $this->db->from('tarif');
        // join
        $this->db->join('product', 'product.id = tarif.product_id', 'LEFT');
        // End Join
        $this->db->where('destinasi_id', $destinasi_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
}
