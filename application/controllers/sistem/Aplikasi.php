<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Aplikasi extends KZ_Controller {

    private $module = 'sistem/aplikasi';
    private $path = 'app/img/';
    private $url_route = array('id', 'source', 'type');
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_aplikasi'));
    }
    function index() {
        $this->data['chart_today'] = $this->_chart_visitor()['data'];
        $this->data['chart_total'] = $this->_chart_visitor()['total'];
        
        $this->data['module'] = $this->module;
        $this->data['action'] = $this->module . '/edit/';
        $this->data['title'] = array('Aplikasi', 'Ubah Pengaturan');
        $this->data['breadcrumb'] = array(
            array('title' => $this->uri->segment(1), 'url' => '#'),
            array('title' => $this->uri->segment(2), 'url' => '')
        );
        $this->load_view('sistem/aplikasi/v_ubah', $this->data);
    }
    function edit($id = NULL) {
        if(is_null($id)) {
            redirect($this->module);
        }
        if($this->validation($this->rules) == FALSE) {
            redirect($this->module);
        }
        $param = $this->input->post(NULL, TRUE);
        $apli = $this->m_aplikasi->getId(decode($id));
        
        $data['judul'] = element('judul', $param);
        $data['cipta'] = element('cipta', $param);
        $data['deskripsi'] = element('deskrip', $param);
        $data['update_aplikasi'] = date('Y-m-d H:i:s');
        $data['session_aplikasi'] = $this->sessionname;

        $nav = (element('navbar', $param)) ? 1 : 0;
        $side = (element('sidebar', $param)) ? 1 : 0;
        $bread = (element('bread', $param)) ? 1 : 0;
        $compact = (element('compact', $param)) ? 1 : 0;
        $hover = (element('hover', $param)) ? 1 : 0;
        $horizon = (element('horizontal', $param)) ? 1 : 0;
        $website = element('website', $param, '#000000');
        $website_dua = element('website_dua', $param, '#000000');
        
        if ($side == 1) {
            $nav = 1;
        }
        if ($bread == 1) {
            $nav = 1;
            $side = 1;
        }
        if ($compact == 1) {
            $hover = 1;
        }
        if ($horizon == 1) {
            $compact = 1;
            $hover = 1;
        }
        $aksi = array(
            0 => element('tema', $param),
            1 => element('back', $param),
            2 => $nav,
            3 => $side,
            4 => $bread,
            5 => (element('container', $param)) ? 1 : 0,
            6 => $hover,
            7 => $compact,
            8 => $horizon,
            9 => (element('item', $param)) ? 1 : 0,
            10 => $website,
            11 => $website_dua
        );
        $data['tema'] = implode(",", ($aksi));
        
        $this->load->library(array('upload'));
        if (!empty($_FILES['foto']['name'])) {
            $img = url_title($data['judul'].' '.random_string('alnum', 4),'dash',TRUE);
            $upload = $this->_upload_img('foto', $img, $this->path, 700, TRUE);
            if(is_null($upload)){
                redirect($this->module);
            }
            $data['logo'] = $upload;
            (is_file($apli['logo'])) ? unlink($apli['logo']) : '';
        }

        $result = $this->m_aplikasi->update(decode($id), $data);
        if ($result) {
            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Data berhasil diubah'));
            redirect($this->module);
        } else {
            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Data gagal diubah'));
            redirect($this->module);
        }
    }
    function ajax() {
        $routing_module = $this->uri->uri_to_assoc(4, $this->url_route);
        if(is_null($routing_module['type'])){
            redirect('');
        }
        if ($routing_module['type'] == 'list') {
            //LIST
            if ($routing_module['source'] == 'visitor') {
                $this->_list_visitor();
            }
        }
    }
    //Function
    function _list_visitor() {
        $this->load->model(array('m_visitor'));

        $visitor = $this->m_visitor->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($visitor as $items) {
            $no++;
            $row = array();

            $row[] = ctk($no);
            $row[] = format_date($items['access_date'], 0);
            $row[] = ($items['ip_address']);
            $row[] = ctk($items['no_of_visits']);
            $row[] = ctk($items['requested_url']);
            $row[] = ctk($items['page_name']);
            $row[] = ctk($items['user_agent']);

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_visitor->count_all(),
            "recordsFiltered" => $this->m_visitor->count_filtered(),
            "data" => $data,
        );
        jsonResponse($output);
    } 
    function _chart_visitor() {
        $this->load->model(array('m_visitor'));
        
        $awal = $this->input->get('awal');
        $akhir = $this->input->get('akhir');
        
        if(is_null($awal) || is_null($akhir)){
            $rs = $this->m_visitor->get_chart_today(date('Y-m-d'));
        }else if(strcmp($awal, $akhir) == 0){
            $rs = $this->m_visitor->get_chart_today($awal);
        }else{
            $rs = $this->m_visitor->get_chart_range($awal, $akhir);
        }   
        $data = array();
        $total = 0;
        if($rs['rows'] > 0){
            foreach ($rs['data'] as $item) {
                $row = array();
                $row['visits'] = $item['visits'];
                $row['day'] = '"'.$item['day'].'"';
                $row['akses'] = $item['akses'];

                $data[] = $row;
                $total += intval($item['visits']);
            }
        }else{
            $data[] = array(array('visits' => 0, 'day' => 0, 'akses' => 0));
        }
        return array('data' => $data, 'total' => $total);
    }
    var $rules = array(
        array(
            'field' => 'judul',
            'label' => 'Judul Aplikasi',
            'rules' => 'required|trim|xss_clean|min_length[5]|max_length[80]'
        ),array(
            'field' => 'cipta',
            'label' => 'Hak Cipta',
            'rules' => 'required|trim|xss_clean|min_length[5]|max_length[80]'
        ),array(
            'field' => 'deskrip',
            'label' => 'Deskripsi',
            'rules' => 'required|trim|xss_clean|min_length[5]|max_length[200]'
        ),array(
            'field' => 'tema',
            'label' => 'Tema Admin',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'website',
            'label' => 'Warna Pertama',
            'rules' => 'required|trim|xss_clean'
        ),array(
            'field' => 'website_dua',
            'label' => 'Warna Kedua',
            'rules' => 'required|trim|xss_clean'
        ), array(
            'field' => 'back',
            'label' => 'Background Login',
            'rules' => 'required|trim|xss_clean'
        )
    );

}
