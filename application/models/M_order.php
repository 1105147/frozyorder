<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_order extends CI_Model {

    private $table = 'm_order';
    private $id = 'id_order';
    
    function __construct() {
        parent::__construct();
    }
    //INSERT
    function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    //UPDATE
    function update($id, $data, $item = NULL) {
        $this->db->where($this->id, $id);
        $row = $this->db->update($this->table, $data);
        if(!is_null($item)){
            $this->db->update('m_item', array('status_item' => '1'), array('order_id' => $id));
        }
        return $row;
    }
    //DELETE
    function delete($id) {
        $this->db->where($this->id, $id);
        $row = $this->db->delete($this->table);
        return $row;
    }
    function insertAll($post, $cart) {
        $this->db->trans_start();
        
        $order['costumer_id'] = decode($post['cst_id']);
        $order['ship_order'] = $post['cshiping'];
        $order['pay_order'] = ($post['cshiping'] === '0') ? '0' : '1';
        $order['note_order'] = $post['catatan'];
        $order['status_order'] = '0';
        $order['buat_order'] = date('Y-m-d H:i:s');
        $order['log_order'] = $post['log'];
        
        $order['total_payment'] = $post['total_payment'];
        $order['status_payment'] = '0';
        
        if($post['cshiping'] === '1'){
            $order['status_ship'] = '0';
            $order['nama_ship'] = $post['nama'];
            $order['kontak_ship'] = $post['kontak'];
            $order['alamat_ship'] = $post['alamat'];
            $order['note_ship'] = 'Produk telah dipesan. Menunggu estimasi Biaya Pengiriman dari Toko.';
        }
        $order['code_order'] = 'BIO'.date('yn').'U'.$order['costumer_id'].date('H').'MRT'.date('i');
        
        $order_id = $this->insert($order);
        
        if(!is_null($order_id)) {
            $data = array();
            foreach ($cart as $items) {
                $row = array();
                $row['produk_id'] = $items['id'];
                $row['order_id'] = $order_id;
                $row['jumlah_item'] = $items['qty'];
                $row['harga_item'] = $items['price'];
                $row['status_item'] = '0';

                $data[] = $row;
            }
            $this->db->insert_batch('m_item', $data);
        }
        $this->db->trans_complete();
        return [
            'id' => $order_id,
            'status' => $this->db->trans_status()
        ];
    }
    //GET
    function getAll($where = NULL, $status = NULL) {
        $this->db->select('o.*, c.dpn_cst, c.blkg_cst');
        $this->db->from('m_order o');
        $this->db->join('m_costumer c','o.costumer_id = c.id_costumer','inner');
        
        if(!is_null($where)){
            $this->db->where($where);
        }
        if(!is_null($status)){
            $this->db->where_in('o.status_order',$status);
        }
        $this->db->order_by('o.buat_order','desc');
        
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
