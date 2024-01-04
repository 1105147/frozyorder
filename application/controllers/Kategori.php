<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Kategori extends KZ_Controller {

    private $module = 'kategori';

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_kategori', 'm_produk'));
    }
    function index($first = null, $second = null) {
        
        $slug = (is_null($second)) ? $first : $first.'/'.$second ;
        
        $cat = $this->m_kategori->getSlug($slug);
        $param = $this->input->get(null, TRUE);
        
        $where['p.status_pdk'] = '1';
        $wherein = null;
        
        if(!is_null($slug)){
            $parent = $this->m_kategori->getAll(array('parent_kat' => $cat['id_kategori']));
            foreach ($parent['data'] as $rw) {
                $wherein[] = $rw['id_kategori'];
            }
            $wherein[] = $cat['id_kategori'];
        }
        
        $get['q'] = element('q', $param);
        $page = element('page', $param, 1);
        $limit = 12;
        $offset = ($page) ? ($page - 1) * $limit : 0;
        $url = current_url() . '?' . 'q=' . $get['q'];

        $produk = $this->m_produk->getAll($where, 'asc', $limit, $offset, $get['q'], $wherein);
        $count = $this->m_produk->countAll($where, $get['q'], $wherein);

        $this->data['cat'] = $cat;
        $this->data['produk'] = $produk;
        $this->data['pagination'] = $this->set_paging($url, $count, $limit);
        $this->data['param'] = $get;
        $this->data['breadcrumb'] = array(array('title' => ($cat) ? $cat['nama_kat'] : 'Semua Kategori', 'url' => '#'));
        
        $this->data['meta'] = array(
            'title' => ($cat) ? $cat['nama_kat'] : 'Semua Kategori', 
            'description' => ($cat) ? $cat['nama_kat'] : 'Semua Kategori',
            'thumbnail' => ($cat) ? base_url($cat['foto_kat']) : NULL
        );
        $this->load_home('home/category/h_category', $this->data);
    }
    function favorit() {
        $this->load->model(array('m_favorit'));
        $cst = $this->_check_cst();
        
        $produk = $this->m_favorit->getAll(array(
            'f.costumer_id' => $cst['id_costumer'], 
            'p.status_pdk' => '1')
        );
        $this->data['produk'] = $produk;
        $this->data['breadcrumb'] = array(array('title' => 'Favorit Anda', 'url' => '#'));
        
        $this->data['meta'] = array(
            'title' => 'Produk Favorit', 
            'description' => 'Produk Favorit ' . $cst['dpn_cst'].' '.$cst['blkg_cst']
        );
        $this->load_home('home/category/h_favorit', $this->data);
    }
}
