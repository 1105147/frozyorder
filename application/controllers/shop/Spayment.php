<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Spayment extends KZ_Controller {
    
    private $module = 'shop/spayment';
    private $module_do = 'shop/spayment_do';
            
    function __construct() {
        parent::__construct();
        
        $this->load->model(array('m_order'));
    }
    function index() {
        $this->data['order'] = $this->m_order->getAll(
            array(
                'o.status_order' => '2',
                //'o.status_payment' => '0'
            )
        );
        $this->data['module'] = $this->module;
        $this->data['title'] = array('Pembayaran','Daftar Tagihan Pelanggan');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> '')
        );
        $this->load_view('shop/payment/v_index', $this->data);
    }
    function detail($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        $this->load->model(array('m_costumer','m_item'));
        
        $order = $this->data['order'] = $this->m_order->getId(decode($id));
        $this->data['cst'] = $this->m_costumer->getId($order['costumer_id']);
        
        $this->data['module'] = $this->module;
        $this->data['action'] = $this->module.'/edit/'.$id;
        $this->data['title'] = array('Pembayaran','Informasi Pembayaran');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> site_url($this->module)),
            array('title'=>$this->data['title'][1], 'url'=>'')
        );
        $this->load_view('shop/payment/v_detail', $this->data);
    }
    function edit($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        if(!$this->validation($this->rules)){
            redirect($this->module.'/detail/'.$id);
        }
        $cst_id = $this->input->post('cst_id');
        
        $data['status_payment'] = '1';
        $data['update_payment'] = date('Y-m-d H:i:s');
        $data['log_payment'] = $this->sessionname.' telah memvalidasi pembayaran pelanggan';
        $data['note_payment'] = 'Tagihan telah dibayar';
        
        $result = $this->m_order->update(decode($id), $data, 'item');
        if($result){
            $this->_notifikasi($cst_id, $id, $data['note_payment']);
            
            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Pembayaran berhasil di validasi'));
            redirect($this->module.'/detail/'.$id);
        }else{
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Pembayaran gagal di validasi'));
            redirect($this->module.'/detail/'.$id);
        }
    }
    function _notifikasi($cst_id, $id, $notif) {
        $this->load->model(array('m_notif'));
        $cst = array(
            'from_id' => $this->sessionid,
            'send_id' => decode($cst_id),
            'subject' => 'Pembayaran Pemesanan',
            'msg' => $notif,
            'link' => 'order/detail/' . $id,
        );
        $this->m_notif->insertAll($cst, 3);
    }
    private $rules = array(
        array(
            'field' => 'cst_id',
            'label' => 'Data Required',
            'rules' => 'required|trim|xss_clean'
        )
    );
}
