<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mcostumer_do extends KZ_Controller {
    
    private $module = 'master/mcostumer';
    private $module_do = 'master/mcostumer_do';
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_costumer'));
    }
    function edit($id = NULL) {
        if(is_null($id)){
            redirect($this->module);
        }
        if($this->validation($this->rules) == FALSE){
            redirect($this->module.'/edit/'.$id);
        }
        $data['level_cst'] = $this->input->post('level');
        $data['status_cst'] = $this->input->post('status');
        $data['update_cst'] = date('Y-m-d H:i:s');
        $data['log_cst'] = $this->sessionname. ' mengubah Profil Pelanggan';

        $result = $this->m_costumer->update(decode($id), $data);
        if ($result) {
            $this->_notifikasi(decode($id));
            
            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Data berhasil diubah'));
            redirect($this->module);
        } else {
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Data gagal diubah'));
            redirect($this->module.'/edit/'.$id);
        }
    }
    function _notifikasi($id) {
        $this->load->model(array('m_notif','m_user'));
        $cst = array(
            'from_id' => $this->sessionid,
            'send_id' => $id,
            'subject' => 'Perubahan Status Pelanggan',
            'msg' => 'Administrator telah mengubah status pelanggan anda, silahkan cek perubahan status',
            'link' => 'akun',
        );
        $this->m_notif->insertAll($cst, 3);
        $this->m_user->insertLog($this->sessionid, 
            array(
                'ip_user' => ip_agent(),
                'log_user' => $this->sessionname. ' mengubah Profil Pelanggan
                <a href="'.  site_url($this->module.'/detail/'.encode($id)) . '">Lihat Data</a>'
            )        
        );
    }
    private $rules = array(
        array(
            'field' => 'level',
            'label' => 'Level Costumer',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'status',
            'label' => 'Status Costumer',
            'rules' => 'required|trim|xss_clean'
        )
    );
}
