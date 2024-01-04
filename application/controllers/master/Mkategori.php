<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mkategori extends KZ_Controller {
    
    private $module = 'master/mkategori';
    private $module_do = 'master/mkategori_do';    
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_kategori'));
    }
    function index() {
        $data = array();
        foreach ($this->m_kategori->getAll()['data'] as $val) {
            $row = array();
            $row['a'] = $val;
            $row['b'] = $this->m_kategori->getId($val['parent_kat']);
            
            $data[] = $row;
        }
        $this->data['kategori'] = $data;
        $this->data['title'] = array('Kategori','Daftar Kategori');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> '')
        );
        $this->data['module'] = $this->module;
        $this->load_view('master/kategori/v_index', $this->data);
    }
    function add() {
        $this->data['kat'] = $this->m_kategori->getEmpty();
        $this->data['parent'] = $this->m_kategori->getParent();
        
        $this->data['action'] = $this->module_do.'/add';
        $this->data['title'] = array('Kategori','Tambah Data');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> site_url($this->module)),
            array('title'=>$this->data['title'][1], 'url'=>'')
        );
        $this->load_view('master/kategori/v_form', $this->data);
    }
    function edit($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        $this->data['kat'] = $this->m_kategori->getId(decode($id));
        $this->data['parent'] = $this->m_kategori->getParent();
        
        $this->data['action'] = $this->module_do.'/edit/'.$id;
        $this->data['title'] = array('Kategori','Ubah Data');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> site_url($this->module)),
            array('title'=>$this->data['title'][1], 'url'=>'')
        );
        $this->load_view('master/kategori/v_form', $this->data);
    }
}
