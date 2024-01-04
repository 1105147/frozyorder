<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends KZ_Controller {

    function index() {
        if (!empty($this->sessionid) || ($this->sessionid != '')) {
            redirect('beranda');
        }
        $this->load->model(array('m_aplikasi'));
        
        $data['app'] = $this->m_aplikasi->getAll(); 
        $data['theme'] = explode(",",$data['app']['tema']);
        
        $this->data['content'] = $this->load->view('non_login/v_login', $data, TRUE);
        $this->load->view('non_login/v_template', $this->data);
    }
    function home() {
        if (!empty($this->sessionid) || ($this->sessionid != '')) {
            redirect('');
        }
        $this->data['action'] = 'non_login/login_do/auth_do';
        $this->data['title'] = array('Beranda','');
        $this->data['breadcrumb'] = array( 
            array('title'=>'Akun', 'url'=> site_url('akun')),
            array('title'=>'Masuk', 'url'=>'#')
        );
        $this->load_home('home/user/h_login', $this->data);
    }
    function logout() {
        session_destroy();
        redirect('');
    }
    function xss() {
        if(!$this->validation($this->xss)){
            redirect('help/contact');
        }
        $input = $this->input->post('txtemail');
        $this->session->set_flashdata('notif', notif('info', 'Informasi', $input));
        redirect('help/contact');
    }
    private $xss = array(
        array(
            'field' => 'txtemail',
            'label' => 'Cek XSS',
            'rules' => 'required|trim|xss_clean'
        )
    );
}
