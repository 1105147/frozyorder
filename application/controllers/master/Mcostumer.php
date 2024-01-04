<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mcostumer extends KZ_Controller {
    
    private $module = 'master/mcostumer';
    private $module_do = 'master/mcostumer_do';    
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_costumer'));
    }
    function index() {
        $this->data['module'] = $this->module;
        $this->data['costumer'] = $this->m_costumer->getAll();
        
        $this->data['title'] = array('Pelanggan','Daftar Pelanggan');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> '')
        );
        $this->load_view('master/costumer/v_index', $this->data);
    }
    function edit($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        $this->data['costumer'] = $this->m_costumer->getId(decode($id));
        
        $this->data['action'] = $this->module_do.'/edit/'.$id;
        $this->data['title'] = array('Costumer','Ubah Data');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> site_url($this->module)),
            array('title'=>$this->data['title'][1], 'url'=>'')
        );
        $this->load_view('master/costumer/v_form', $this->data);
    }
    function detail($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        $this->data['cst'] = $this->m_costumer->getOne(array(
            'c.id_costumer' => decode($id)))['data'];
        
        $this->data['title'] = array('Pelanggan','Profil');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> site_url($this->module)),
            array('title'=>$this->data['title'][1], 'url'=>'')
        );
        $this->load_view('master/costumer/v_detail', $this->data);
    }
}
