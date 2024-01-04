<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_item extends CI_Model {

    private $table = 'm_item';
    private $id = 'id_item';
    
    function __construct() {
        parent::__construct();
    }
    //INSERT
    function insert($data) {
        $row = $this->db->insert($this->table, $data);
        return $row;
    }
    //UPDATE
    function update($id, $data) {
        $this->db->where($this->id, $id);
        $row = $this->db->update($this->table, $data);
        return $row;
    }
    //DELETE
    function delete($id) {
        $this->db->where($this->id, $id);
        $row = $this->db->delete($this->table);
        return $row;
    }
    //GET
    function getAll($where = NULL) {
        $this->db->select('i.*, p.*, k.nama_kat, k.slug_kat');
        $this->db->from('m_item i');
        $this->db->join('m_produk p','i.produk_id = p.id_produk','inner');
        $this->db->join('m_kategori k','p.kategori_id = k.id_kategori','inner');
        
        if(!is_null($where)){
            $this->db->where($where);
        }
        $this->db->order_by('p.nama_pdk','asc');
        
        $get = $this->db->get();
        
        return [
            'rows' => $get->num_rows(),
            'data' => $get->result_array()
        ];
    }
    function getId($id) {
        $this->db->from($this->table);
        $this->db->where($this->id, $id);
        
        return $this->db->get()->row_array();
    }
}
