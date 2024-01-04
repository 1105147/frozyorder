<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sproduk_do extends KZ_Controller {
    
    private $module = 'shop/sproduk';
    private $module_do = 'shop/sproduk_do';
    private $path = 'app/upload/produk/';
    private $size = 500;
            
    function __construct() {
        parent::__construct();
        
        $this->load->model(array('m_produk'));
    }
    function add() {
        if(!$this->validation($this->rules)){
            redirect($this->module);
        }
        $data['nama_pdk'] = $this->input->post('nama');
        $data['slug_pdk'] = url_title($this->input->post('nama'), 'dash', TRUE);
        $data['status_pdk'] = $this->input->post('status');
        $data['harga_pdk'] = $this->input->post('harga');
        $data['stok_pdk'] = $this->input->post('stok');
        $data['kondisi_pdk'] = $this->input->post('kondisi');
        $data['informasi_pdk'] = $this->input->post('info');
        
        $data['log_pdk'] = $this->sessionname.' membuat produk baru';
        $data['buat_pdk'] = date('Y-m-d H:i:s');
        
        $subkat = $this->input->post('subkat');
        $data['kategori_id'] = (is_null($subkat) || ($subkat == '')) ? $this->input->post('kategori') : $subkat;
        
        if(!empty($_FILES['foto']['name'])){
            $upload = $this->_upload_img('foto', $data['slug_pdk'], $this->path, $this->size, TRUE);
            if(is_null($upload)){
                redirect($this->module.'/add');
            }
            $data['fotosatu_pdk'] = $upload; 
        }
        $result = $this->m_produk->insert($data);
        if ($result) {
            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Data berhasil disimpan'));
            redirect($this->module);
        } else {
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Data gagal disimpan'));
            redirect($this->module.'/add');
        }
    }
    function edit($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        if(!$this->validation($this->rules)){
            redirect($this->module.'/edit/'.$id);
        }
        $data['nama_pdk'] = $this->input->post('nama');
        $data['slug_pdk'] = url_title($this->input->post('nama'), 'dash', TRUE);
        $data['status_pdk'] = $this->input->post('status');
        $data['harga_pdk'] = $this->input->post('harga');
        $data['stok_pdk'] = $this->input->post('stok');
        $data['kondisi_pdk'] = $this->input->post('kondisi');
        $data['informasi_pdk'] = $this->input->post('info');
        
        $data['log_pdk'] = $this->sessionname.' mengubah produk ini';
        $data['update_pdk'] = date('Y-m-d H:i:s');
        
        $subkat = $this->input->post('subkat');
        $data['kategori_id'] = (is_null($subkat) || ($subkat == '')) ? $this->input->post('kategori') : $subkat;
        
        if(!empty($_FILES['foto']['name'])){
            $upload = $this->_upload_img('foto', $data['slug_pdk'], $this->path, $this->size, TRUE);
            if(is_null($upload)){
                redirect($this->module.'/edit/'.$id);
            }
            $data['fotosatu_pdk'] = $upload;
            
            $old_img = $this->input->post('exfoto');
            (is_file($old_img)) ? unlink($old_img) : '';    
        }
        $result = $this->m_produk->update(decode($id), $data);
        if ($result) {
            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Data berhasil diubah'));
            redirect($this->module);
        } else {
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Data gagal diubah'));
            redirect($this->module.'/edit/'.$id);
        }
    }
    function detail($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        if(!$this->validation($this->rules_detail)){
            redirect($this->module.'/detail/'.$id);
        }
        $slug = $this->input->post('slug');
        
        $data['diskon_pdk'] = $this->input->post('diskon');
        $data['stok_pdk'] = $this->input->post('stok');
        $data['update_pdk'] = date('Y-m-d H:i:s');
        //FOTO 2
        if(!empty($_FILES['foto2']['name'])){
            $upload = $this->_upload_img('foto2', $slug.'-dua', $this->path, $this->size, TRUE);
            if(is_null($upload)){
                redirect($this->module.'/detail/'.$id);
            }
            $data['fotodua_pdk'] = $upload;
            $old_img2 = $this->input->post('exfoto2');
            (is_file($old_img2)) ? unlink($old_img2) : '';   
        }
        //FOTO 3
        if(!empty($_FILES['foto3']['name'])){
            $upload = $this->_upload_img('foto3', $slug.'-tiga', $this->path, $this->size, TRUE);
            if(is_null($upload)){
                redirect($this->module.'/detail/'.$id);
            }
            $data['fototiga_pdk'] = $upload;
            $old_img3 = $this->input->post('exfoto3');
            (is_file($old_img3)) ? unlink($old_img3) : '';
        }
        
        $result = $this->m_produk->update(decode($id), $data);
        if ($result) {
            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Data berhasil diubah'));
            redirect($this->module.'/detail/'.$id);
        } else {
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Data gagal diubah'));
            redirect($this->module.'/detail/'.$id);
        }
    }
    private $rules = array(
        array(
            'field' => 'nama',
            'label' => 'Nama Produk',
            'rules' => 'required|trim|xss_clean|min_length[10]'
        ),array(
            'field' => 'harga',
            'label' => 'Harga Produk',
            'rules' => 'required|trim|xss_clean|numeric'
        ),array(
            'field' => 'stok',
            'label' => 'Stok Produk',
            'rules' => 'required|trim|xss_clean|numeric'
        ),array(
            'field' => 'kategori',
            'label' => 'Kategori Produk',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'status',
            'label' => 'Status Produk',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'kondisi',
            'label' => 'Kondisi Produk',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'info',
            'label' => 'Informasi Produk',
            'rules' => 'required|trim|xss_clean|min_length[20]'
        )
    );
    private $rules_detail = array(
        array(
            'field' => 'diskon',
            'label' => 'Harga Produk',
            'rules' => 'trim|xss_clean|numeric'
        ),array(
            'field' => 'stok',
            'label' => 'Stok Produk',
            'rules' => 'trim|xss_clean|numeric'
        )
    );
}
