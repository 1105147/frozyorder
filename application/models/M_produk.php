<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_produk extends CI_Model {

    private $table = 'm_produk';
    private $id = 'id_produk';
    
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
    function getAll($where = NULL, $order = 'asc', $limit = 0, $offset = 0, $search = NULL, $wherein = NULL) {
        $this->db->select('p.*, k.nama_kat, k.parent_kat, k.slug_kat, (SELECT SUM(jumlah_item) FROM m_item WHERE produk_id = p.id_produk AND status_item = "1") as item');
        $this->db->from('m_produk p');
        $this->db->join('m_kategori k', 'p.kategori_id = k.id_kategori', 'inner');
        if(!is_null($where)){
            $this->db->where($where);
        }
        if(!is_null($wherein)){
            $this->db->where_in('p.kategori_id', $wherein);
        }
        if(!is_null($search)){
            $this->db->like('p.nama_pdk', trim($search), 'both');
        }
        if(!is_null($limit)){
            $this->db->limit($limit, $offset);
        }
        if(!is_null($order)){
            $this->db->order_by('p.nama_pdk',$order);
        }
        $get = $this->db->get();
        return [
            'rows' => $get->num_rows(),
            'data' => $get->result_array()
        ];
    }
    function countAll($where = NULL, $search = NULL, $wherein = NULL) {
        $this->db->select('COUNT(p.id_produk) AS total');
        $this->db->from('m_produk p');
        $this->db->join('m_kategori k', 'p.kategori_id = k.id_kategori', 'inner');
        if(!is_null($where)){
            $this->db->where($where);
        }
        if(!is_null($wherein)){
            $this->db->where_in('p.kategori_id', $wherein);
        }
        if(!is_null($search)){
            $this->db->like('p.nama_pdk', trim($search), 'both');
        }
        return $this->db->get()->row_array()['total'];
        
    }
    function getId($id) {
        $this->db->select('p.*, k.nama_kat, k.parent_kat, k.slug_kat')->from('m_produk p');
        $this->db->join('m_kategori k', 'p.kategori_id = k.id_kategori', 'inner');
        $this->db->where('p.id_produk', $id);
        
        return $this->db->get()->row_array();
    }
    function getSlug($slug) {
        $this->db->select('p.*, k.parent_kat, k.nama_kat, k.slug_kat, (SELECT SUM(jumlah_item) FROM m_item WHERE produk_id = p.id_produk AND status_item = "1") as item');
        $this->db->from('m_produk p');
        $this->db->join('m_kategori k', 'p.kategori_id = k.id_kategori', 'inner');
        $this->db->where('p.status_pdk', '1');
        $this->db->where('p.slug_pdk =', $slug);
        
        return $this->db->get()->row_array();
    }
    function getEmpty() {
        $data[$this->id] = NULL;
        $data['kategori_id'] = NULL;
        $data['parent_kat'] = NULL;
        $data['nama_pdk'] = NULL;
        $data['status_pdk'] = NULL;
        $data['harga_pdk'] = NULL;
        $data['stok_pdk'] = NULL;
        $data['kondisi_pdk'] = NULL;
        $data['informasi_pdk'] = NULL;
        $data['fotosatu_pdk'] = NULL;
        
        $data['log_pdk'] = NULL;
        $data['buat_pdk'] = NULL;
        $data['update_pdk'] = NULL;
       
        return $data;
   }
}
