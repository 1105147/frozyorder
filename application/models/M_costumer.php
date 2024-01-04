<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_costumer extends CI_Model {

    private $table = 'm_costumer';
    private $id = 'id_costumer';
    
    function __construct() {
        parent::__construct();
    }
    //INSERT
    function insert($data) {
        $row = $this->db->insert($this->table, $data);
        return $row;
    }
    function insertAll($user, $data) {
        $this->db->trans_start();
        
        $user['buat_user'] = date('Y-m-d H:i:s');
        $this->db->insert('yk_user', $user);
        $user_id = $this->db->insert_id();
        
        $data['user_id'] = $user_id;
        $this->insert($data);
        
        $this->db->trans_complete();
        return [
            'rs' => $this->db->trans_status(),
            'id' => $user_id
        ];
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
        $this->db->from('m_costumer c');
        $this->db->join('yk_user u', 'c.user_id = u.id_user', 'inner');
        if(!is_null($where)){
            $this->db->where($where);
        }
        $this->db->order_by('c.update_cst','desc');
        
        $get = $this->db->get();
        return [
            'rows' => $get->num_rows(),
            'data' => $get->result_array()
        ];
    }
    function getOne($where = NULL) {
        $this->db->from('m_costumer c');
        $this->db->join('yk_user u', 'c.user_id = u.id_user', 'inner');
        if(!is_null($where)){
            $this->db->where($where);
        }
        $this->db->order_by('c.update_cst','desc');
        
        $get = $this->db->get();
        return [
            'rows' => $get->num_rows(),
            'data' => $get->row_array()
        ];
    }
    function getId($id) {
        $this->db->from($this->table);
        $this->db->where($this->id, $id);
        return $this->db->get()->row_array();
    }
    function getByUser($id) {
        $this->db->from($this->table);
        $this->db->where('user_id', $id);
        
        return $this->db->get()->row_array();
    }
}
