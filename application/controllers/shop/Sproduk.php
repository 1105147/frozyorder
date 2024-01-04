<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sproduk extends KZ_Controller {
    
    private $module = 'shop/sproduk';
    private $module_do = 'shop/sproduk_do';  
    private $url_route = array('id', 'source', 'type');
            
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_produk','m_kategori'));
    }
    function index() {
        $this->data['produk'] = $this->m_produk->getAll();
        
        $this->data['module'] = $this->module;
        $this->data['title'] = array('Produk','Daftar Produk Anda');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> '')
        );
        $this->load_view('shop/produk/v_index', $this->data);
    }
    function add() {
        $this->data['produk'] = $this->m_produk->getEmpty();
        $this->data['parent'] = $this->m_kategori->getParent();
        $this->data['sub'] = $this->m_kategori->getAll(array('parent_kat !=' => '0'));
        
        $this->data['module'] = $this->module;
        $this->data['action'] = $this->module_do.'/add';
        $this->data['title'] = array('Produk','Tambah Data');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> site_url($this->module)),
            array('title'=>$this->data['title'][1], 'url'=>'')
        );
        $this->load_view('shop/produk/v_form', $this->data);
    }
    function edit($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        $kategori = $this->data['produk'] = $this->m_produk->getId(decode($id));
        
        $this->data['parent'] = $this->m_kategori->getParent(array('parent_kat =' => '0'));
        $this->data['sub'] = $this->m_kategori->getAll(array('parent_kat' => $kategori['parent_kat']));
        
        $this->data['module'] = $this->module;
        $this->data['action'] = $this->module_do.'/edit/'.$id;
        $this->data['title'] = array('Produk','Ubah Data');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> site_url($this->module)),
            array('title'=>$this->data['title'][1], 'url'=>'')
        );
        $this->load_view('shop/produk/v_form', $this->data);
    }
    function detail($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        $this->data['produk'] = $this->m_produk->getId(decode($id));
        
        $this->data['module'] = $this->module;
        $this->data['action'] = $this->module_do.'/detail/'.$id;
        $this->data['title'] = array('Produk','Rincian Produk');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> site_url($this->module)),
            array('title'=>$this->data['title'][1], 'url'=>'')
        );
        $this->load_view('shop/produk/v_detail', $this->data);
    }
    function delete($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        $data['status_pdk'] = '0';
        $data['log_pdk'] = $this->sessionname.' menghapus/non-aktifkan produk ini';
        $data['update_pdk'] = date('Y-m-d H:i:s');
        
        $result = $this->m_produk->update(decode($id), $data);
        if ($result) {
            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Data berhasil di non-aktifkan'));
            redirect($this->module);
        } else {
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Data gagal di non-aktifkan'));
            redirect($this->module);
        }
    }
    function ajax() {
        $routing_module = $this->uri->uri_to_assoc(4, $this->url_route);
        if ($routing_module['type'] == 'list') {
            if ($routing_module['source'] == 'kategori') {
                $this->_list_kategori();
            }
        }
    }
    function _list_kategori() {
        $id = $this->input->post('id');
        $sub = $this->input->post('sub');
        
        if(empty($id) || is_null($id)){
            jsonResponse(array("data" => "", "status" => false));
        }
        $result = $this->m_kategori->getAll(array('parent_kat' => $id));
        if($result['rows'] < 1){
            jsonResponse(array("data" => "", "status" => false));
        }
        $data = array();
        $content = '';
        foreach ($result['data'] as $item) {
            $data[] = $item;
            $selected = ($sub == $item['id_kategori']) ? 'selected' : '';
            $content .= '<option value="' . $item['id_kategori'] . '"  '. $selected .'>' . $item['nama_kat'] . '</option>';
        }
        jsonResponse(array('data' => $data, 'content' => $content, 'status' => true));
    }
}
