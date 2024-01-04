<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends KZ_Controller {
    
    private $url_route = array('id', 'source', 'type');
    private $module = 'order';
    private $cst;
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_order','m_item'));
        
        $this->cst = $this->_check_cst();
    }
    function index() {
        $this->data['order'] = $this->m_order->getAll(array('o.costumer_id' => $this->cst['id_costumer']));
        
        $this->data['module'] = $this->module;
        $this->data['title'] = array('Beranda','');
        $this->data['breadcrumb'] = array( 
            array('title'=>'Transaksi Pembelian', 'url'=>'#')
        );
        $this->load_home('home/order/h_index', $this->data);
    }
    function detail($id = NULL){
        if(is_null($id)){
            redirect($this->module);
        }
        $this->load->model(array('m_costumer'));
        
        $order = $this->m_order->getId(decode($id));
        
        $this->data['order'] = $order;
        $this->data['produk'] = $this->m_item->getAll(array('i.order_id' => decode($id)));
        
        $this->data['module'] = $this->module;
        $this->data['title'] = array('Beranda','');
        $this->data['breadcrumb'] = array( 
            array('title'=>'Transaksi', 'url'=> site_url($this->module)),
            array('title'=>'Rincian', 'url'=>'#')
        );
        $this->load_home('home/order/h_detail', $this->data);
    }
    function add() {
        $this->load->model(array('m_order'));
        
        if($this->validation($this->rules) == FALSE){
            redirect('cart/detail/');
        }
        $param = $this->input->post(null, TRUE);
        $param['log'] = $this->sessionname.' membuat pesanan baru';        
        
        $result = $this->m_order->insertAll($param, $this->cart->contents());
        if ($result['status']){
            
            //callback fungsi
            $this->_notifikasi($result['id']);
            $this->_clear_cart();

            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Pesanan anda berhasil dibuat. <br>Silahkan menunggu beberapa saat, pesanan anda akan segera kami proses.'));
            redirect($this->module);
        } else {
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Pesanan gagal dibuat.'));
            redirect($this->module);
        }
    }
    function terima($id = NULL) {
        if(is_null($id)){
            redirect($this->module.'/detail/'.$id);
        }
        $data['status_order'] = '4';
        $data['update_order'] = date('Y-m-d H:i:s');
        $data['log_order'] = $this->sessionname.' sudah menerima pesanan.';
        
        $result = $this->m_order->update(decode($id), $data);
        if($result){
            $this->_notifikasi_terima($id);
            
            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Status berhasil diubah'));
            redirect($this->module.'/detail/'.$id);
        } else {
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Status gagal diubah'));
            redirect($this->module.'/detail/'.$id);
        }
    }
    //FUNCTION
    function _clear_cart() {
        $this->cart->destroy();
    }
    function _notifikasi($id) {
        $this->load->model(array('m_notif'));
        $toko = array(
            'from_id' => $this->sessionid,
            'send_id' => 2,
            'subject' => 'Pemesanan Produk',
            'msg' => 'Anda mendapatkan pemesanan terbaru. Silahkan cek menu Pemesanan',
            'link' => 'shop/sorder/detail/' . encode($id),
        );
        $this->m_notif->insertAll($toko, 1);
        $cst = array(
            'from_id' => NULL,
            'send_id' => $this->sessionid,
            'subject' => 'Pemesanan Produk',
            'msg' => 'Pemesanan anda berhasil dibuat. Harap menunggu permintaan agar segera di proses',
            'link' => 'order/detail/' . encode($id),
        );
        $this->m_notif->insertAll($cst, 1);
    }
    function _notifikasi_terima($id) {
        $this->load->model(array('m_notif'));
        $toko = array(
            'from_id' => $this->sessionid,
            'send_id' => 2,
            'subject' => 'Pemesanan Produk',
            'msg' => 'Pelanggan telah menerima pemesanan dari Toko anda',
            'link' => 'shop/shistory/detail/' . $id,
        );
        $this->m_notif->insertAll($toko, 1);
    }
    private $rules = array(
        array(
            'field' => 'cst_id',
            'label' => 'Pelanggan',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'total_payment',
            'label' => 'Total Tagihan',
            'rules' => 'required|trim|xss_clean|numeric|greater_than[1000]'
        ),array(
            'field' => 'cshiping',
            'label' => 'Metode Pengiriman',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'catatan',
            'label' => 'Catatan Pemesanan',
            'rules' => 'trim|xss_clean|min_length[5]'
        ),array(
            'field' => 'confirm',
            'label' => 'Persetujuan',
            'rules' => 'required|trim|xss_clean'
        )
    );
}
