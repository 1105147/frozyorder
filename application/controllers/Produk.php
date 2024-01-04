<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends KZ_Controller {

    private $module = 'produk';

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_kategori', 'm_produk'));
    }
    function index($slug = NULL) {
        $this->load->model(array('m_review', 'm_costumer','m_favorit'));

        $produk = $this->data['produk'] = $this->m_produk->getSlug($slug);
        if(is_null($produk)){
            redirect('kategori');
        }
        $this->data['acak'] = $this->m_produk->getAll(array('status_pdk' => '1'), 'RANDOM', 4);
        $cst = $this->m_costumer->getByUser($this->sessionid);
        
        $this->data['favorit'] = $this->m_favorit->hasFavorit($produk['id_produk'], $cst['id_costumer']);
        $this->data['review'] = $this->m_review->getAll(array('r.produk_id' => $produk['id_produk']), 10);
        $this->data['hasview'] = $this->m_review->hasView($produk['id_produk'], $cst['id_costumer']);
        
        $this->data['meta'] = array(
            'title' => $produk['nama_pdk'], 
            'description' => substr(strip_tags($produk['informasi_pdk']), 0,100),
            'thumbnail' => base_url($produk['fotosatu_pdk']) 
        );
        $this->load_home('home/produk/h_product', $this->data);
    }
    //ADD
//    function add_review() {
//        $this->load->model(array('m_review'));
//        
//        $id = $this->input->post('produk_id');
//        $shop_user = $this->input->post('shop_user');
//        $uri = $this->input->post('uri');
//
//        if($this->validation($this->rules_review) == FALSE) {
//            redirect($uri);
//        }
//        if($this->sessionid == decode($shop_user)) {
//            $this->session->set_flashdata('notif', notif('warning', 'Peringatan', 'Anda sebagai pemilik toko tidak dapat memberikan ulasan'));
//            redirect($uri);
//        }
//        $hasview = $this->m_review->hasView(decode($id), $this->sessionid);
//        if($hasview > 0){
//            $this->session->set_flashdata('notif', notif('warning', 'Peringatan', 'Anda sudah mereview produk ini'));
//            redirect($uri);
//        }
//        $data['produk'] = decode($id);
//        $data['user'] = $this->sessionid;
//        $data['rate_review'] = $this->input->post('rate');
//        $data['isi_review'] = $this->input->post('isi');
//
//        $rate = $this->m_review->sumRate($data['produk']);
//        $prod['rate_pdk'] = ($rate['total'] + $data['rate_review']) / ($rate['jumlah'] + 1);
//        $prod['review_pdk'] = $rate['jumlah'] + 1;
//
//        $result = $this->m_review->insert($data);
//        if ($result) {
//            $this->m_produk->update(decode($id), $prod);
//            //$this->_notifikasi($shop_user, 'ulasan', $uri);
//
//            $this->session->set_flashdata('notif', notif('success', 'Informasi', 'Review Anda berhasil disimpan'));
//            redirect($uri);
//        } else {
//            $this->session->set_flashdata('notif', notif('danger', 'Peringatan', 'Review Anda gagal disimpan'));
//            redirect($uri);
//        }
//    }
//    function _notifikasi($shop_user, $type, $link, $topic_id = NULL) {
//        $this->load->model(array('m_notif'));
//        switch ($type) {
//            case 'ulasan':
//                $subject = 'Ulasan Produk';
//                $msg_shop = $this->sessionname.' baru saja mengulas produk anda, silahkan cek hasil ulasan';
//                $msg_user = 'Anda baru saja mengulas sebuah produk';
//                break;
//            case 'tanya':
//                $subject = 'Pertanyaan Produk';
//                $msg_shop = $this->sessionname.' baru saja menanyakan sesuatu tentang produk anda';
//                $msg_user = 'Anda baru saja mengajukan pertanyaan tentang sebuah produk';
//                break;
//            case 'komen':
//                $subject = 'Komentar Produk';
//                $msg_shop = $this->sessionname.' baru saja memberikan komentar tentang produk anda';
//                $msg_user = 'Anda baru saja memberikan sebuah komentar tentang sebuah produk';
//                break;
//            default:
//                $subject = '';
//                $msg_shop = '';
//                $msg_user = '';
//                break;
//        }
//        $toko = array(
//            'send_id' => decode($shop_user),
//            'subject' => $subject,
//            'msg' => $msg_shop,
//            'link' => $link
//        );
//        $user = array(
//            'send_id' => $this->sessionid,
//            'subject' => $subject,
//            'msg' => $msg_user,
//            'link' => $link
//        );
//        $reply = array(
//            'subject' => 'Komentar Produk',
//            'msg' => 'Toko membalas pertanyaan yang anda kirimkan',
//            'link' => $link
//        );
//        //Untuk User
//        $this->m_notif->insertAll($user, 1);
//        //Untuk Toko
//        if($this->sessionid !== decode($shop_user)){
//            $this->m_notif->insertAll($toko, 1);
//        }
//        //Untuk Yang Buat Topic
//        if(!is_null($topic_id) && ($this->sessionid == decode($shop_user)) ){
//            $this->load->model(array('m_topic'));
//            $user_topic = $this->m_topic->getId($topic_id)['user_id'];
//            
//            $reply['send_id'] = $user_topic;
//            $this->m_notif->insertAll($reply, 1);
//        }
//    }
//    private $rules_review = array(
//        array(
//            'field' => 'isi',
//            'label' => 'Review Anda',
//            'rules' => 'required|trim|xss_clean'
//        ), array(
//            'field' => 'rate',
//            'label' => 'Rating Review',
//            'rules' => 'required|trim|xss_clean'
//        )
//    );
}
