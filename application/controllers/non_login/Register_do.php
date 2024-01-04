<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Register_do extends KZ_Controller {   
    
    private $module = 'non_login/register';
    
    function __construct() {
        parent::__construct();
    }
    function index() {
        if(!$this->validation($this->rules)){
            redirect($this->module);
        }
        $this->load->model(array('m_costumer'));
        
        $mail['name'] = $user['fullname'] = $this->input->post('depan').' '.$this->input->post('belakang');
        $mail['user'] = $user['username'] = strtolower($this->input->post('username'));
        $mail['pass'] = $this->input->post('confirm');
        $mail['module'] = site_url('non_login/login');
        
        $user['id_group'] = '3';
        $user['email'] = $this->input->post('email');
        $user['password'] = password_hash($mail['pass'] , PASSWORD_DEFAULT);
        $user['status_user'] = '1';
        $user['log_user'] = 'Registrasi Akun';
        $user['ip_user'] = ip_agent();
        
        $data['dpn_cst'] = $this->input->post('depan');
        $data['blkg_cst'] = $this->input->post('belakang');
        $data['kontak_cst'] = $this->input->post('kontak');
        $data['kelamin_cst'] = $this->input->post('jenis');
        $data['alamat_cst'] = $this->input->post('alamat');
        $data['status_cst'] = '0';
        
        $result = $this->m_costumer->insertAll($user, $data);
        if ($result['rs']) {
            
            $this->_notifikasi($result['id'], $user['fullname']);
            //$this->_send_email('reg', NULL, $mail, $user['email'], 'Pendaftaran Akun');
            $this->_auto($user['username']);
            
        } else {
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Pendaftaran gagal. Mohon lengkapi data anda!'));
            redirect($this->module);
        }
    }
    //Function
    function _auto($username) {
        $this->load->model(array('m_authentication','m_user'));
        $this->load->library(array('session'));
        
        $data = $this->m_authentication->getAuth($username);
        $this->session->set_userdata(array(
            'logged' => true,
            'id' => $data['id_user'],
            'name' => $data['fullname'],
            'usr' => $data['username'],
            'groupid' => $data['id_group'],
            'foto' => $data['foto_user']
        ));
        $usr['last_login'] = date('Y-m-d H:i:s');
        $usr['ip_user'] = ip_agent();
        $usr['log_user'] = $data['fullname'] . ' baru saja membuat akun';
        
        $this->m_user->update($data['id_user'], $usr, 1);

        $this->session->set_flashdata('notif', notif('success', 'Pendaftaran Berhasil', 'Selamat Datang di BIOMART UNIMUDA, '.$data['fullname']));
        redirect('');   
    }
    function _uqemail() {
        $email = strtolower($this->input->post('email'));
        if($this->_unique($email) > 0) {
            $this->form_validation->set_message("_uqemail", "Email yang anda input sudah terdaftar di sistem kami. Gunakan email yang lain");
            return FALSE;
        } else {
            return TRUE;
        }
    }
    function _uquser() {
        $username = strtolower($this->input->post('username'));
        if($this->_unique($username) > 0) {
            $this->form_validation->set_message("_uquser", "Username yang anda input sudah terdaftar di sistem kami. Gunakan username yang lain");
            return FALSE;
        } else {
            return TRUE;
        }
    }
    function _unique($useremail) {
        $this->load->model(array('m_authentication'));
        $data = $this->m_authentication->getAuth($useremail);
        return sizeof($data);
    }
    function _captcha_google($str){
        $this->load->library('recaptcha');
        $rs = $this->recaptcha->verifyResponse($str);
        if ($rs['success']){
            return TRUE;
        }else{
            $this->form_validation->set_message('_captcha_google', 'Berikan tanda centang apabila anda bukan Robot');
            return FALSE;
        }
    }
    function _notifikasi($user_id, $name) {
        $this->load->model(array('m_notif'));
        $user = array(
            'from_id' => NULL,
            'send_id' => $user_id,
            'subject' => 'Pendaftaran Akun',
            'msg' => 'Terimakasih '.$name.' telah mendaftarkan diri anda. Silahkan melakukan transaksi yang anda inginkan',
            'link' => 'sistem/profil',
        );
        $this->m_notif->insertAll($user, 1);
        $admin = array(
            'from_id' => $user_id,
            'send_id' => 1,
            'subject' => 'Pendaftaran Akun Baru',
            'msg' => 'Akun <b>'.$name.'</b> baru saja mendaftarkan diri di aplikasi. Segera validasi proses akun tersebut',
            'link' => 'sistem/user'
        );
        $this->m_notif->insertAll($admin, 1);
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
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim|xss_clean|valid_email|callback__uqemail'
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
        ),array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|trim|xss_clean|min_length[5]|callback__uquser'
        ),array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|xss_clean|min_length[5]'
        ),array(
            'field' => 'confirm',
            'label' => 'Konfirmasi Password',
            'rules' => 'trim|required|xss_clean|matches[password]|min_length[5]'
        ),array(
            'field' => 'check',
            'label' => 'Persetujuan',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'g-recaptcha-response',
            'label' => 'Pengecekan Keamanan',
            'rules' => 'trim|required|xss_clean|callback__captcha_google' 
        )
    );
}
