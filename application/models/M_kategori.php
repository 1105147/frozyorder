<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategori extends CI_Model {
    
    private $table = 'm_kategori';
    private $id = 'id_kategori';
    
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
    function getAll($where = NULL, $order = 'asc', $limit = NULL) {
       $this->db->from($this->table);
        if(!is_null($where)){
            $this->db->where($where);
        }
        if(!is_null($limit)){
            $this->db->limit($limit);
        }
        $this->db->order_by('nama_kat', $order);
        
        $get = $this->db->get();
        return [
            'rows' => $get->num_rows(),
            'data' => $get->result_array()
        ];
    }
    function getNav() {
        $this->db->distinct(true)
                ->from($this->table)
                ->where('status_kat =', '1');
        $this->db->order_by('order_kat','asc');
        
        $get = $this->db->get();
        return [
            'rows' => $get->num_rows(),
            'data' => $get->result_array()
        ];
    }
    function getId($id) {
        $this->db->from($this->table)->where($this->id, $id);
        return $this->db->get()->row_array();
    }
    function getSlug($slug) {
        $this->db->from($this->table)->where('slug_kat', $slug);
        return $this->db->get()->row_array();
    }
    function getParent($where = NULL) {
        $this->db->from($this->table);
        $this->db->where('parent_kat', '0');
        if(!is_null($where)){
            $this->db->where($where);
        }
        $get = $this->db->get();
        return [
            'rows' => $get->num_rows(),
            'data' => $get->result_array()
        ];
    }
    function getEmpty() {
        $data[$this->id] = NULL;
        $data['parent_kat'] = NULL;
        $data['nama_kat'] = NULL;
        $data['slug_kat'] = NULL;
        $data['status_kat'] = NULL;
        $data['icon_kat'] = NULL;
        $data['order_kat'] = NULL;
        $data['foto_kat'] = NULL;
       
        return $data;
   }
}
