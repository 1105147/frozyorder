<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends KZ_Controller {   
 
    function __construct() {
        parent::__construct();
        $this->load->library(array('recaptcha'));
    }
    function index() {
        if (!empty($this->sessionid) || ($this->sessionid != '')) {
            redirect('');
        }
        $this->data['action'] = 'non_login/register_do';
        $this->data['title'] = array('Beranda','');
        $this->data['breadcrumb'] = array( 
            array('title'=>'Akun', 'url'=> site_url('akun')),
            array('title'=>'Daftar', 'url'=>'#')
        );
        $this->data['captcha'] = $this->recaptcha->getWidget();
        $this->data['script_captcha'] = $this->recaptcha->getScriptTag();
        
        $this->load_home('home/user/h_register', $this->data);
    }
}
