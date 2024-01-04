<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_do extends KZ_Controller {
    
    private $module = 'non_login/login';
    private $beranda = 'non_login/beranda';
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_authentication', 'm_user'));
    }
    function auth() {
        if(!$this->validation($this->rules)){
            redirect($this->module);
        } else {
            redirect($this->beranda);
        }
    }
    function auth_do() {
        if(!$this->validation($this->rules)){
            redirect($this->module.'/home');
        } else {
            redirect('');
        }
    }
    function forgot() {
        if($this->validation($this->rules_forgot) == FALSE){
            redirect($this->module);
        }
        $username = $this->input->post('fuser');
        $user = $this->m_authentication->getAuth($username);
        $newpass = random_string('alnum', 6);
        //Update Data
        $data['password'] = password_hash($newpass, PASSWORD_DEFAULT);
        $data['update_user'] = date('Y-m-d H:i:s');
        $data['log_user'] = $user['fullname'] . ' Reset Password';
        $data['ip_user'] = ip_agent();
        
        $result = $this->m_user->update($user['id_user'], $data, 1);
        if($result) {
            $this->session->set_flashdata('notif', notif('info', 'Informasi', 'Password anda berhasil di reset
                Password saat ini adalah : <span class="bigger-150 bolder red">'.$newpass.'</span>'));
        }else{
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Password anda gagal di reset'));
        }
        redirect($this->module);
    }
    function changed($id = NULL) {
        if(is_null($id)){
            redirect($this->beranda);
        }
        $this->load->model(array('m_group'));
        
        $role = $this->m_group->getRole(array('r.user_id' => $this->sessionid,'r.group_id' => decode($id)));
        if($role['rows'] > 0){
            
            $this->load->library(array('session'));
                
            $this->session->set_userdata(array(
                'logged' => true,
                'id' => $this->sessionid,
                'name' => $this->sessionname,
                'usr' => $this->sessionusr,
                'groupid' => decode($id),
                'foto' => $this->sessionfoto
            ));
            $usr['last_login'] = date('Y-m-d H:i:s');
            $usr['ip_user'] = ip_agent();
            $usr['log_user'] = $this->sessionname . ' Login Sistem with Switch Account';
            
            $this->m_user->update($this->sessionid, $usr, 1);

            $this->session->set_flashdata('notif', notif('info', 'Selamat datang kembali', $this->sessionname));
            redirect($this->beranda);
        }else{
            redirect('home/err_module');
        }        
    }
    
    //Callback Function
    function _validate() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $data = $this->m_authentication->getAuth($username);
        if (sizeof($data) > 0) {
            
            if($data['status_user'] == '0') {
                $this->form_validation->set_message("_validate", "Mohon maaf, untuk sementara Akun anda tidak aktif. Hubungi Administrator");
                return FALSE;
            }
            if(password_verify($password, $data['password'])){
                
                $this->load->library(array('session'));
                
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
                $usr['log_user'] = $data['fullname'] . ' Login Sistem';
                
                $this->m_user->update($data['id_user'], $usr, 1);

                $this->session->set_flashdata('notif', notif('info', 'Selamat datang kembali', $data['fullname']));
                return TRUE;
            }else{
                $this->form_validation->set_message("_validate", "Password yang anda masukkan salah");
                return FALSE;
            }
        } else {
            $this->form_validation->set_message("_validate", "Email atau Username anda belum terdaftar di sistem kami");
            return FALSE;
        }
    }
    function _unique() {
        $this->load->model(array('m_authentication'));
        
        $val = ($this->input->post('fuser'));
        $data = $this->m_authentication->getAuth($val);
        if (sizeof($data) < 1) {
            $this->form_validation->set_message("_unique", "Username atau Email yang anda input belum terdaftar di sistem kami");
            return FALSE;
        } else {
            return TRUE;
        }
    }
    private $rules = array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|trim|xss_clean|min_length[5]|callback__validate'
        )
    );
    private $rules_forgot = array(
        array(
            'field' => 'femail',
            'label' => 'Email',
            'rules' => 'required|trim|xss_clean|valid_email|callback__unique'
        )
    );
}
