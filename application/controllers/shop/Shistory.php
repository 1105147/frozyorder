<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Shistory extends KZ_Controller {
    
    private $module = 'shop/shistory';
    private $module_do = 'shop/shistory_do';
            
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_order'));
    }
    function index() {
        $this->data['order'] = $this->m_order->getAll(
            array(
                //'o.status_payment' => '1'
            ),
            array('4','5','6')
        );
        
        $this->data['module'] = $this->module;
        $this->data['title'] = array('Riwayat','Daftar Transaksi');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> '')
        );
        $this->load_view('shop/history/v_index', $this->data);
    }
    function detail($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        $this->load->model(array('m_costumer', 'm_item'));
        
        $order = $this->data['order'] = $this->m_order->getId(decode($id));

        $this->data['produk'] = $this->m_item->getAll(array('i.order_id' => decode($id)));
        $this->data['cst'] = $this->m_costumer->getId($order['costumer_id']);
        
        $this->data['module'] = $this->module;
        $this->data['title'] = array('Riwayat','Informasi Pemesanan');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> site_url($this->module)),
            array('title'=>$this->data['title'][1], 'url'=>'')
        );
        $this->load_view('shop/history/v_detail', $this->data);
    }
}
