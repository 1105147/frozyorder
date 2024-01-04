<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sorder extends KZ_Controller {

    private $module = 'shop/sorder';
    private $module_do = 'shop/sorder_do';
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_order'));
    }
    function index() {
        $this->data['order'] = $this->m_order->getAll(
            array(
                'o.status_payment' => '0'
            ),
            array('0','1')
        );
        $this->data['module'] = $this->module;
        $this->data['title'] = array('Pemesanan', 'Daftar Pesanan Masuk');
        $this->data['breadcrumb'] = array(
            array('title' => $this->uri->segment(1), 'url' => '#'),
            array('title' => $this->uri->segment(2), 'url' => '')
        );
        $this->load_view('shop/order/v_index', $this->data);
    }
    function detail($id = NULL) {
        if (is_null($id)) {
            redirect($this->module);
        }
        $this->load->model(array('m_costumer', 'm_item'));

        $order = $this->data['order'] = $this->m_order->getId(decode($id));
        
        $this->data['produk'] = $this->m_item->getAll(array('i.order_id' => decode($id)));
        $this->data['cst'] = $this->m_costumer->getId($order['costumer_id']);

        $this->data['module'] = $this->module;
        $this->data['action_add'] = $this->module.'/add/'.$id;
        $this->data['action_edit'] = $this->module.'/edit/'.$id;
        $this->data['title'] = array('Pemesanan', 'Informasi Pemesanan');
        $this->data['breadcrumb'] = array(
            array('title' => $this->uri->segment(1), 'url' => '#'),
            array('title' => $this->uri->segment(2), 'url' => site_url($this->module)),
            array('title' => $this->data['title'][1], 'url' => '')
        );
        $this->load_view('shop/order/v_detail', $this->data);
    }
    function add($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        if(!$this->validation($this->rules)){
            redirect($this->module.'/detail/'.$id);
        }
        $cst_id = $this->input->post('cst_id');
        
        $data['ship_payment'] = $this->input->post('biaya');
        $data['status_ongkir'] = '1';
        $data['update_payment'] = $data['update_order'] = date('Y-m-d H:i:s'); 
        $data['log_payment'] = $this->sessionname.' menambahkan Biaya Pengiriman';
        $data['note_payment'] = 'Biaya Pengiriman berhasil ditambahkan. Silahkan melakukan pembayaran';
        $data['note_ship'] = '';
        
        $result = $this->m_order->update(decode($id), $data);
        if ($result) {
            $this->_notifikasi($cst_id, $id, $data['note_payment']);
            
            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Biaya Pengiriman berhasil ditambahkan'));
            redirect($this->module . '/detail/' . $id);
        } else {
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Gagal menambahkan Biaya Pengiriman'));
            redirect($this->module . '/detail/' . $id);
        }
    }
    function edit($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        if(!$this->validation($this->rules_edit)){
            redirect($this->module.'/detail/'.$id);
        }
        $cst = $this->input->post('cst_id');
        
        if ($this->input->post('proses') == '1') {
            $status = '1';
            $msg = 'Ubah status Siap apabila Pesanan sudah selesai diproses';
            $notif = 'Pemesanan anda sedang di proses oleh Toko. Mohon tunggu hingga pemesanan siap';
        }else if ($this->input->post('siap') == '1') {
            $status = '2';
            $msg = 'Harap segera lanjut ke tahap selanjutnya yaitu Pembayaran atau Pengiriman';
            $notif = 'Pemesanan anda telah siap diambil/diantar';
        }else {
            redirect($this->module.'/detail/'.$id);
        }
        $data['status_order'] = $status;
        $data['update_order'] = date('Y-m-d H:i:s');
        $data['log_order'] = $this->sessionname.' mengubah status pemesananan';

        $result = $this->m_order->update(decode($id), $data);
        if ($result) {
            $this->_notifikasi($cst, $id, $notif);
            
            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Status pemesanan Anda berhasil diubah. '.$msg));
            redirect($this->module);
        } else {
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Status pemesanan Anda gagal diubah'));
            redirect($this->module . '/detail/' . $id);
        }
    }
    
    function _notifikasi($cst_id, $id, $notif) {
        $this->load->model(array('m_notif'));
        $cst = array(
            'from_id' => $this->sessionid,
            'send_id' => decode($cst_id),
            'subject' => 'Status Pemesanan Berubah',
            'msg' => $notif,
            'link' => 'order/detail/' . $id,
        );
        $this->m_notif->insertAll($cst, 3);
    }
    private $rules_edit = array(
        array(
            'field' => 'cst_id',
            'label' => 'Data Required',
            'rules' => 'required|trim|xss_clean'
        )
    );
    private $rules = array(
        array(
            'field' => 'cst_id',
            'label' => 'Data Required',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'biaya',
            'label' => 'Biaya Pengiriman',
            'rules' => 'trim|xss_clean|numeric|greater_than_equal_to[0]'
        )
    );
}
