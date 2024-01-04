<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sshipment extends KZ_Controller {
    
    private $module = 'shop/sshipment';
    private $module_do = 'shop/sshipment_do';
            
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_order'));
    }
    function index() {
        $this->data['order'] = $this->m_order->getAll(
            array(
                'o.ship_order' => '1',
                'o.status_payment' => '1'
            ), array('2','3')
        );
        $this->data['module'] = $this->module;
        $this->data['title'] = array('Pengiriman','Daftar Pengiriman Pesanan');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> '')
        );
        $this->load_view('shop/shipment/v_index', $this->data);
    }
    function detail($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        $this->load->model(array('m_costumer','m_item'));
        
        $order = $this->data['order'] = $this->m_order->getId(decode($id));
        
        $this->data['produk'] = $this->m_item->getAll(array('i.order_id' => decode($id)));
        $this->data['cst'] = $this->m_costumer->getId($order['costumer_id']);
        
        $this->data['module'] = $this->module;
        $this->data['action_add'] = $this->module.'/add/'.$id;
        $this->data['action_edit'] = $this->module.'/edit/'.$id;
        $this->data['title'] = array('Pengiriman','Informasi Pengiriman');
        $this->data['breadcrumb'] = array( 
            array('title'=>$this->uri->segment(1), 'url'=>'#'),
            array('title'=>$this->uri->segment(2), 'url'=> site_url($this->module)),
            array('title'=>$this->data['title'][1], 'url'=>'')
        );
        $this->load_view('shop/shipment/v_detail', $this->data);
    }
    function add($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        if(!$this->validation($this->rules)){
            redirect($this->module.'/detail/'.$id);
        }
        $cst_id = $this->input->post('cst_id');
        $nama = $this->input->post('nama');
        $nomor = $this->input->post('nomor');
        
        $data['jenis_ship'] = $this->input->post('jenis');
        $data['kurir'] = $nama.' - ['.$nomor.']';
        $data['status_order'] = '3';
        $data['status_ship'] = '1';
        $data['update_order'] = $data['update_ship'] = date('Y-m-d H:i:s');
        $data['log_order'] =  $data['log_ship'] = $this->sessionname. ' mengirimkan pesanan';
        $data['note_ship'] = 'Pesanan akan langsung dikirimkan oleh Kurir ke alamat Anda. Mohon menunggu.';
        
        $result = $this->m_order->update(decode($id), $data);
        if($result){
            $this->_notifikasi($cst_id, $id, $data['note_ship']);
            
            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Status pengiriman Anda berhasil diubah.'));
            redirect($this->module.'/detail/'.$id);
        }else{
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Status pengiriman Anda gagal diubah'));
            redirect($this->module.'/detail/'.$id);
        }
    }
    function edit($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        if(!$this->validation($this->rules_edit)){
            redirect($this->module.'/detail/'.$id);
        }
        $cst_id = $this->input->post('cst_id');
        
        $data['status_ship'] = '2';
        $data['update_ship'] = date('Y-m-d H:i:s');
        $data['log_ship'] = $this->sessionname. ' mengubah status pengiriman';
        $data['note_ship'] = 'Pesanan telah sampai. Mohon konfirmasi penerimaan pesanan anda kepada kami.';
        
        $result = $this->m_order->update(decode($id), $data);
        if($result){
            $this->_notifikasi($cst_id, $id, $data['note_ship']);
            
            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Status pengiriman Anda berhasil diubah.'));
            redirect($this->module.'/detail/'.$id);
        }else{
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Status pengiriman Anda gagal diubah'));
            redirect($this->module.'/detail/'.$id);
        }
    }
    function _notifikasi($cst_id, $id, $notif) {
        $this->load->model(array('m_notif'));
        $cst = array(
            'from_id' => $this->sessionid,
            'send_id' => decode($cst_id),
            'subject' => 'Status Pengiriman Berubah',
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
        ),array(
            'field' => 'jenis',
            'label' => 'Jenis Pengiriman',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'nama',
            'label' => 'Nama Kurir',
            'rules' => 'required|trim|xss_clean|min_length[3]'
        ),array(
            'field' => 'nomor',
            'label' => 'Nomor Kurir/Resi',
            'rules' => 'required|trim|xss_clean|min_length[5]'
        )
    );
    private $rules_edit = array(
        array(
            'field' => 'cst_id',
            'label' => 'Data Required',
            'rules' => 'required|trim|xss_clean'
        )
    );
}
