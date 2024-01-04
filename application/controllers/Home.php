<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends KZ_Controller {
    function __construct() {
        parent::__construct();
    }
    function index() {
        $this->load->model(array('m_produk','m_galeri'));
        
        $this->data['diskon'] = $this->m_produk->getAll(array('diskon_pdk >' => 0,'status_pdk' => '1'), 'RANDOM', 12);
        $this->data['top'] = $this->m_produk->getAll(array('rate_pdk >=' => 3, 'status_pdk' => '1'), 'RANDOM', 4);
        $this->data['galeri'] = $this->m_galeri->getAll(array(
            'status_galeri' => '1', 
            'jenis_galeri' => '0',
            'is_header' => '1'
        ), 'RANDOM', 5);
        
        $this->data['title'] = array('Beranda', '');
        $this->data['breadcrumb'] = array(
            array('title' => '', 'url' => '#')
        );
        $this->load_home('home/h_home', $this->data);
    }
    function pages($slug = NULL){
        if(is_null($slug)){
            redirect('');
        }
        $this->load->model(array('m_page'));
        
        $pages = $this->m_page->getSlug($slug);
        if(is_null($pages)){
            redirect('home/err_404');
        }
        $this->data['detail'] = $pages;
        $this->_visit();
        
        $this->data['meta'] = array(
            'title' => ($pages) ? $pages['judul_page'] : NULL, 
            'description' => ($pages) ? $pages['isi_page'] : NULL,
            'thumbnail' => ($pages) ? base_url($pages['foto_page']) : NULL
        );
        $this->load_home('home/page/h_pages', $this->data);
    }
    function err_404() {
        $this->data['breadcrumb'] = array( 
            array('title'=>'Halaman Tidak Ditemukan', 'url'=>'#')
        );
        $this->load_view('errors/html/error_404', $this->data);
    }
    function err_module() {
        $this->data['breadcrumb'] = array( 
            array('title'=>'Gagal Akses Module', 'url'=>'#')
        );
        $this->load_view('errors/html/error_module', $this->data);
    }
    
    //Function
    function _visit() {
        $this->load->model(array('m_visitor'));
        
        $today = $this->m_visitor->get_today();
        $yesterday = $this->m_visitor->get_yesterday();
        $last_week = $this->m_visitor->get_week();
        $last_month = $this->m_visitor->get_month();
        
        $this->data['visit_today'] = isset($today['visits']) ? $today['visits'] : 0;
        $this->data['visit_yesterday'] = isset($yesterday['visits']) ? $yesterday['visits'] : 0;
        $this->data['visit_week'] = isset($last_week['visits']) ? $last_week['visits'] : 0;
        $this->data['visit_month'] = isset($last_month['visits']) ? $last_month['visits'] : 0;
    }
}
