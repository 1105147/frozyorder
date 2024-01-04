<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_favorit extends CI_Model {

    private $table = 'm_favorit';
    private $id = 'id_favorit';
    
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
    function deleteFav($pdk, $cst) {
        $this->db->where('produk_id', $pdk);
        $this->db->where('costumer_id', $cst);
        
        $row = $this->db->delete($this->table);
        return $row;
    }
    
    //GET
    function getAll($where = NULL, $limit = NULL) {
        $this->db->select('p.*, k.nama_kat, k.parent_kat, k.slug_kat, (SELECT SUM(jumlah_item) FROM m_item WHERE produk_id = p.id_produk AND status_item = "1") as item');
        $this->db->from('m_favorit f');
        $this->db->join('m_produk p', 'f.produk_id = p.id_produk', 'inner');
        $this->db->join('m_kategori k', 'p.kategori_id = k.id_kategori', 'inner');
        if(!is_null($where)){
            $this->db->where($where);
        }
        if(!is_null($limit)){
            $this->db->limit($limit);
        }
        $this->db->order_by('f.buat_favorit','desc');
        
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
    function hasFavorit($pdk, $cst) {
        $this->db->from($this->table);
        $this->db->where('produk_id', $pdk);
        $this->db->where('costumer_id', $cst);
        
        $get = $this->db->get();
        return $get->num_rows();
    }
}
