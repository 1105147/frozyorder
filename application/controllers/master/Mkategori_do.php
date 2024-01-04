<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mkategori_do extends KZ_Controller {
    
    private $module = 'master/mkategori';
    private $module_do = 'master/mkategori_do';
    private $path = 'app/upload/kategori/';
            
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_kategori'));
    }
    function add() {
        if($this->validation($this->rules) == FALSE){
            redirect($this->module);
        }
        $data['nama_kat'] = $this->input->post('nama');
        $data['status_kat'] = $this->input->post('status');
        $data['order_kat'] = $this->input->post('order');
        $data['icon_kat'] = empty($this->input->post('icon')) ? 'fa fa-list' : $this->input->post('icon');
        
        if($this->input->post('jenis') == '0'){
            $data['parent_kat'] = '0';
            $data['slug_kat'] = url_title($this->input->post('nama'), 'dash', TRUE);
        }else{
            $id = $data['parent_kat'] = $this->input->post('pilihan');
            
            $slug = $this->m_kategori->getId($id)['slug_kat'];
            $data['slug_kat'] = $slug.'/'.url_title($this->input->post('nama'), 'dash', TRUE);
        }
        
        if(!empty($_FILES['foto']['name'])){
            $upload = $this->_upload_img('foto', $data['slug_kat'], $this->path, 300, TRUE);
            if(is_null($upload)){
                redirect($this->module.'/add');
            }
            $data['foto_kat'] = $upload; 
        }
        
        $result = $this->m_kategori->insert($data);
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
        if($this->validation($this->rules) == FALSE){
            redirect($this->module.'/edit/'.$id);
        }
        
        $data['nama_kat'] = $this->input->post('nama');
        $data['status_kat'] = $this->input->post('status');
        $data['order_kat'] = $this->input->post('order');
        $data['icon_kat'] = empty($this->input->post('icon')) ? 'fa fa-list' : $this->input->post('icon');
        
        if($this->input->post('jenis') == '0'){
            $data['parent_kat'] = '0';
            $data['slug_kat'] = url_title($this->input->post('nama'), 'dash', TRUE);
        }else{
            $cat_id = $data['parent_kat'] = $this->input->post('pilihan');
            
            $slug = $this->m_kategori->getId($cat_id)['slug_kat'];
            $data['slug_kat'] = $slug.'/'.url_title($this->input->post('nama'), 'dash', TRUE);
        }
        
        if(!empty($_FILES['foto']['name'])){
            $upload = $this->_upload_img('foto', $data['slug_kat'], $this->path, 300, TRUE);
            if(is_null($upload)){
                redirect($this->module.'/edit/'.$id);
            }
            $data['foto_kat'] = $upload;
            $old_img = $this->input->post('exfoto');
            (is_file($old_img)) ? unlink($old_img) : '';
        }
        
        $result = $this->m_kategori->update(decode($id), $data);
        if ($result) {
            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Data berhasil diubah'));
            redirect($this->module);
        } else {
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Data gagal diubah'));
            redirect($this->module.'/edit/'.$id);
        }
    }
    private $rules = array(
        array(
            'field' => 'nama',
            'label' => 'Nama Kategori',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'jenis',
            'label' => 'Jenis Kategori',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'order',
            'label' => 'Order Kategori',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'status',
            'label' => 'Status Kategori',
            'rules' => 'required|trim|xss_clean'
        )
    );    
}
