<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_review extends CI_Model {

    private $table = 'm_review';
    private $id = 'id_review';
    
    function __construct() {
        parent::__construct();
    }
    //INSERT
    function insert($data) {
        $data['buat_review'] = date('Y-m-d H:i:s');
        
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
    function getAll($where = NULL, $limit = NULL) {
        $this->db->from('m_review r');
        $this->db->join('m_produk p', 'r.produk_id = p.id_produk', 'inner');
        if(!is_null($where)){
            $this->db->where($where);
        }
        if(!is_null($limit)){
            $this->db->limit($limit);
        }
        $this->db->order_by('r.buat_review','desc');
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
    function hasView($id, $user) {
        $this->db->from($this->table);
        $this->db->where(array(
            'produk_id' => $id,
            'costumer_id' => $user
        ));
        $get = $this->db->get();
        return $get->num_rows();
    }
    function sumRate($id) {
        $this->db->select('SUM(rate_review) as total, COUNT(costumer_id) as jumlah');
        $this->db->from($this->table);
        $this->db->where('produk_id', $id);
        
        return $this->db->get()->row_array();
    }
}
