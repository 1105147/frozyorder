<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends KZ_Controller {
    
    private $module = 'cart';
    private $url_route = array('id', 'source', 'type');
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_produk'));
    }
    function index() {
        $this->_check_cst();
        
        $this->data['cart'] = $this->cart->contents();
        
        $this->data['module'] = $this->module;
        $this->data['title'] = array('Beranda','');
        $this->data['breadcrumb'] = array(array('title'=>'Keranjang', 'url'=>'#'));
        
        $this->load_home('home/cart/h_cart', $this->data);
    }
    function detail(){
        $this->data['cst'] = $this->_check_cst();
        
        if($this->cart->total_items() < 1){
            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Keranjang belanja anda masih kosong'));
            redirect($this->module);
        }
        $this->data['cart'] = $this->cart->contents();
        
        $this->data['module'] = $this->module;
        $this->data['action'] = 'order/add';
        $this->data['title'] = array('Beranda','');
        $this->data['breadcrumb'] = array( 
            array('title'=>'Keranjang', 'url'=> site_url($this->module)),
            array('title'=>'Pemesanan', 'url'=>'#')
        );
        $this->load_home('home/cart/h_detail', $this->data);
    }
    function ajax() {
        $routing_module = $this->uri->uri_to_assoc(3, $this->url_route);
        if ($routing_module['type'] == 'list') {
            //LIST
            if ($routing_module['source'] == 'table') {
                $this->_list_cart();
            }
        }else if ($routing_module['type'] == 'action') {
            //AKSI
            if ($routing_module['source'] == 'add') {
                $this->_add_cart();
            }else if ($routing_module['source'] == 'delete') {
                $this->_delete_cart();
            }else if ($routing_module['source'] == 'favorit') {
                $this->_add_favorit();
            }
        }
    }
    //FUNCTION
    function _check_qty($id, $jumlah) {
        $check = FALSE;
        foreach ($this->cart->contents() as $items) {
            $total = intval($jumlah) + $items['qty'];
            if (($items['id'] == $id) && ($total > 100)) {
                $check = TRUE;
            }
        }
        return $check;
    }
    function _add_cart(){
        $this->load->model(array('m_produk'));
        
        $valid = $this->_valid_cst();
        if(!$valid['st']){
            jsonResponse(array('status' => $valid['st'], 'msg' => $valid['rs']));
        }
        if(!$this->validation($this->rules_cart)){
            jsonResponse(array('status' => FALSE, 'msg' => strval(validation_errors())));
        }
        $pdk_id = decode($this->input->post('produk_id', TRUE));
        $jumlah = $this->input->post('jumlah', TRUE);
        
        if($this->_check_qty($pdk_id, $jumlah)){
            jsonResponse(array('status' => FALSE, 'item' => $this->cart->total_items(), 'total' => rupiah($this->cart->total()),
                'msg' => 'Maksimal pembelian <b>100</b> dalam 1x transaksi'
            ));
        }
        $produk = $this->m_produk->getId(($pdk_id));
        //Cart
        $data['id'] = $pdk_id;
        $data['name'] = $produk['nama_pdk'];
        $data['qty'] = $jumlah;
        $diskon = ($produk['diskon_pdk'] == '0') ? $produk['harga_pdk'] : ($produk['harga_pdk'] - (($produk['diskon_pdk']/100)* $produk['harga_pdk'])) ;
        $data['price'] = $diskon; 
        //Produk
        $data['harga'] = $produk['harga_pdk']; 
        $data['diskon'] =  $produk['diskon_pdk'];
        $data['foto'] =  $produk['fotosatu_pdk'];
        $data['slug'] =  $produk['slug_pdk'];
        $data['kondisi'] =  $produk['kondisi_pdk'];
        //Option
        $option['idkat'] = $produk['kategori_id'];
        $option['link'] = $produk['slug_kat'];
        $option['user'] = $this->sessionid;
        $data['option'] = $option;
        
        $result = $this->cart->insert($data);
        if($result){
            jsonResponse(array('item' => $this->cart->total_items(), 'total' => rupiah($this->cart->total()),
                'status' => TRUE, 
                'msg' => 'Produk berhasil ditambahkan pada keranjang belanja'
            ));
        }else{
            jsonResponse(array('item' => $this->cart->total_items(), 'total' => rupiah($this->cart->total()),
                'status' => FALSE, 
                'msg' => 'Produk gagal ditambahkan pada keranjang belanja'
            ));
        }
    }
    function _delete_cart(){
        $valid = $this->_valid_cst();
        if(!$valid['st']){
            jsonResponse(array('status' => $valid['st'], 'msg' => $valid['rs']));
        }
        if(!$this->validation($this->rules_delete)){
            jsonResponse(array('status' => FALSE, 'msg' => strval(validation_errors())));
        }
        $rowid = $this->input->post('id');
        $jumlah = $this->input->post('jumlah');
        
        $result = $this->cart->update(array('rowid' => $rowid, 'qty' => ($jumlah == '0') ? 0 : $jumlah ));
        if($result){
            jsonResponse(array('item' => $this->cart->total_items(),'total' => rupiah($this->cart->total()),
                'status' => TRUE, 
                'msg' => 'Keranjang belanja anda berhasil diperbarui'
            ));
        }else{
            jsonResponse(array('item' => $this->cart->total_items(),'total' => rupiah($this->cart->total()),
                'status' => FALSE, 
                'msg' => 'Keranjang belanja anda gagal diperbarui'
            ));
        }
    }
    function _add_favorit(){
        $this->load->model(array('m_favorit'));
        
        $valid = $this->_valid_cst();
        if(!$valid['st']){
            jsonResponse(array('status' => $valid['st'], 'msg' => $valid['rs']));
        }
        if(!$this->validation($this->rules_favorit)){
            jsonResponse(array('status' => FALSE, 'msg' => 'Tidak ada Produk yang terpilih'));
        }
        
        $pdk_id = decode($this->input->post('produk_id', TRUE));
        $cst_id = $valid['rs']['id_costumer'];
        $data = array('produk_id' => $pdk_id, 'costumer_id' => $cst_id, 'buat_favorit' => date('Y-m-d H:i:s'));
        
        if($this->m_favorit->hasFavorit($pdk_id, $cst_id) > 0){
            $rs_del = $this->m_favorit->deleteFav($pdk_id, $cst_id);
            if($rs_del){
                jsonResponse(array('data' => 0, 'status' => TRUE, 'msg' => 'Produk dihapus dari favorit'));
            }else{
                jsonResponse(array('data' => 0, 'status' => FALSE, 'msg' => 'Produk gagal dihapus dari favorit'));
            }
        }else{
            $rs_add = $this->m_favorit->insert($data);
            if($rs_add){
                jsonResponse(array('data' => 1, 'status' => TRUE, 'msg' => 'Produk ditambahkan pada favorit'));
            }else{
                jsonResponse(array('data' => 1, 'status' => FALSE, 'msg' => 'Produk gagal ditambahkan pada favorit'));
            }
        }
    }
    function _list_cart() {
        if($this->cart->total_items() == 0){
            jsonResponse(array("status" => FALSE, "data" => $this->cart->contents()));
        }
        $data = array();
        $no = 1;
        foreach ($this->cart->contents() as $items) {
            
            $img = load_file($items['foto']);
            
            $row = array();
            $row[] = '<a href="'.site_url('produk/'.$items['slug']).'">
                    <img src="'.$img.'" style="max-width: 100px" class="img-circle lazyload blur-up" alt="'.$items['name'].'"></a>';
            $row[] = '<h4><a href="'.site_url('produk/'.$items['slug']).'">'.$items['name'].'</a></h4>
                    <p>-----</p>';
            $row[] = '<p>'.rupiah($items['harga']).'</p>';
            $row[] = '<p>'.$items['diskon'].' %</p>';
            $row[] = '<p>'.rupiah($items['price']).'</p>';
            $row[] = '<div class="btn-block quantity">
                    <input onkeyup="cekQty(this)" type="number" min="0" max="100" name="jumlah" id="jumlah'.$no.'" value="'.$items['qty'].'" class="form-control" style="max-width:80px" />
                    <button onclick=updateCart("'.$items['rowid'].'","'.$no.'") type="button" title="Ubah" class="btn btn-warning"> <i class="fa fa-pencil-square-o"></i></button>
                </div>';
            $row[] = '<p class="cart_total_price">'.rupiah($items['subtotal']).'</p>';
            $row[] = '<button onclick=updateCart("'.$items['rowid'].'","0") type="button" title="Hapus" class="btn btn-danger"><i class="fa fa-times"></i></a>';
            
            $data[] = $row;
            $no++;
        }
        jsonResponse(array("data" => $data));
    }
    function _valid_cst() {
        $this->load->model(array('m_costumer'));
        $cst = $this->m_costumer->getByUser($this->sessionid);
        if(is_null($cst)){
            return [
                'st' => FALSE,
                'rs' => 'Harap masuk sebagai Pelanggan untuk memulai berbelanja'
            ];
        }else{
            if($cst['status_cst'] === '0'){
                return [
                    'st' => FALSE,
                    'rs' => 'Anda belum dapat berbelanja.<br/> Status pelanggan anda dinyatakan <b>TIDAK AKTIF</b>'
                ];
            }
            return [
                    'st' => TRUE,
                    'rs' => $cst
                ];
        }
    }
    private $rules_cart = array(
        array(
            'field' => 'produk_id',
            'label' => 'Produk',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'jumlah',
            'label' => 'Jumlah',
            'rules' => 'required|trim|xss_clean|is_natural|greater_than[0]|less_than_equal_to[100]'
        )
    );
    private $rules_delete = array(
        array(
            'field' => 'id',
            'label' => 'Produk',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'jumlah',
            'label' => 'Jumlah',
            'rules' => 'required|trim|xss_clean|is_natural|greater_than_equal_to[0]|less_than_equal_to[100]'
        )
    );
    private $rules_favorit = array(
        array(
            'field' => 'produk_id',
            'label' => 'Produk',
            'rules' => 'required|trim|xss_clean'
        )
    );
}
