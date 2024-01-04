<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends KZ_Controller {
    
    private $cst;
    private $module = 'akun';
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_costumer'));
        
        $this->cst = $this->_check_cst();
    }
    function index(){
        $this->data['cst'] = $this->cst;
        $this->data['module'] = $this->module;
        $this->data['title'] = array('Beranda','');
        $this->data['breadcrumb'] = array(array('title'=>'Akun Saya', 'url'=>'#'));
        
        $this->load_home('home/user/h_akun', $this->data);
    }
    function edit($id = NULL) {
        if(!$this->validation($this->rules)){
            redirect($this->module);
        }
        $data['dpn_cst'] = $this->input->post('depan');
        $data['blkg_cst'] = $this->input->post('belakang');
        $data['lahir_cst'] = date('Y-m-d H:i:s', strtotime($this->input->post('lahir')));
        $data['kontak_cst'] = $this->input->post('kontak');
        $data['kelamin_cst'] = $this->input->post('jenis');
        $data['alamat_cst'] = $this->input->post('alamat');
        
        $data['update_cst'] = date('Y-m-d H:i:s');
        $data['log_cst'] = $this->sessionname.' merubah pengaturan akun';
        
        $result = $this->m_costumer->update(decode($id), $data);
        if ($result) {
            $this->_notifikasi($data['dpn_cst'].' '.$data['blkg_cst']);
            
            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Data berhasil disimpan'));
            redirect($this->module);
        } else {
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Data gagal disimpan'));
            redirect($this->module);
        }
    }
    function _notifikasi($cst) {
        $this->load->model(array('m_notif','m_user'));
        $admin = array(
            'from_id' => $this->sessionid,
            'send_id' => 1,
            'subject' => 'Perubahan Profil Costumer',
            'msg' => 'Pelanggan '.$cst.' baru saja mengubah profilnya',
            'link' => 'master/mcostumer'
        );
        $this->m_notif->insertAll($admin, 1);   
        $this->m_user->insertLog($this->sessionid, 
            array(
                'ip_user' => ip_agent(),
                'log_user' => $this->sessionname. ' mengubah Profil Pelanggan '.$cst
            )        
        );
    }
    private $rules = array(
        array(
            'field' => 'depan',
            'label' => 'Nama Depan',
            'rules' => 'required|trim|xss_clean|min_length[5]'
        ),array(
            'field' => 'belakang',
            'label' => 'Nama Belakang',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'lahir',
            'label' => 'Tanggal Lahir',
            'rules' => 'required|trim|xss_clean|date'
        ),array(
            'field' => 'kontak',
            'label' => 'Kontak',
            'rules' => 'required|trim|xss_clean|is_natural|min_length[10]'
        ),array(
            'field' => 'jenis',
            'label' => 'Jenis Kelamin',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'alamat',
            'label' => 'Alamat',
            'rules' => 'required|trim|xss_clean|min_length[20]'
        )
    );
}
