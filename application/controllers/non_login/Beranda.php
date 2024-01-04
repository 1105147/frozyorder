<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends KZ_Controller {
    private $module = 'beranda';
    
    function __construct() {
        parent::__construct();
    }
    function index() {
        $this->data['module'] = $this->module;
        $this->data['title'] = array('Beranda','');
        $this->data['breadcrumb'] = array( 
            array('title'=>'', 'url'=>'#')
        );
        $this->load_view('non_login/v_beranda', $this->data);
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
}
