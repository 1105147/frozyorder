<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_visitor extends CI_Model {

    var $id = 'site_log_id';
    var $table = 'yk_site_log';
    var $column_order = array(null, 'access_date','ip_address','no_of_visits','requested_url','page_name','user_agent'); //set column field database for datatable orderable
    var $column_search = array('access_date','ip_address','no_of_visits','requested_url','page_name','user_agent'); //set column field database for datatable searchable 
    var $order = array('access_date' => 'desc'); // default order 

    function __construct() {
        parent::__construct();
    }
    //INSERT
    function insert($data) {
        $row = $this->db->insert($this->table, $data);
        return $row;
    }
    //UPDATE
    function update($id, $data) {
        $this->db->where($this->id, $id);
        $row = $this->db->update($this->table, $data);
        return $row;
    }
    //DELETE
    function delete($id) {
        $this->db->where($this->id, $id);
        $row = $this->db->delete($this->table);
        return $row;
    }
    function getAll($where = NULL, $order = 'desc', $limit = NULL) {
        $this->db->from($this->table);
        if (!is_null($where)) {
            $this->db->where($where);
        }
        if (!is_null($limit)) {
            $this->db->limit($limit);
        }
        if (!is_null($order)) {
            $this->db->order_by('access_date', $order);
        }
        $get = $this->db->get();
        return [
            'rows' => $get->num_rows(),
            'data' => $get->result_array()
        ];
    }
    function cekToday($ip, $date) {
        $this->db->from($this->table);
        $this->db->where('ip_address', $ip);
        $this->db->where('DATE(access_date)', $date);
        $this->db->limit(1);
        $get = $this->db->get();
        return [
            'rows' => $get->num_rows(),
            'data' => $get->row_array()
        ];
    }
    function get_today() {
        $this->db->select('COUNT(ip_address) as visits');
        $this->db->from($this->table);
        $this->db->where('DATE(access_date) = CURDATE()');
        $this->db->limit(1);

        $get = $this->db->get();
        return $get->row_array();
    }
    function get_yesterday() {
        $this->db->select('COUNT(ip_address) as visits');
        $this->db->from($this->table);
        $this->db->where('DATE(access_date) = CURDATE()-1');
        $this->db->limit(1);

        $get = $this->db->get();
        return $get->row_array();
    }
    function get_week() {
        $this->db->select('COUNT(ip_address) as visits');
        $this->db->from($this->table);
        $this->db->where('YEARWEEK(access_date, 1) = YEARWEEK(CURDATE(), 1)');
        $this->db->limit(1);

        $get = $this->db->get();
        return $get->row_array();
    }
    function get_month() {
        $this->db->select('COUNT(ip_address) as visits');
        $this->db->from($this->table);
        $this->db->where('YEAR(access_date) = YEAR(CURDATE())');
        $this->db->where('MONTH(access_date) = MONTH(CURDATE())');
        $this->db->limit(1);

        $get = $this->db->get();
        return $get->row_array();
    }
    function get_datatables() {
        $this->get_datatables_query();
        if ($_POST['length'] != -1){
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    function count_filtered() {
        $this->get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    function get_datatables_query() {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        
        if(!is_null($awal) || !is_null($akhir)){
            $this->db->where('DATE(access_date) >=', $awal);
            $this->db->where('DATE(access_date) <=', $akhir);
        }
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) { // looping awal
            if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
                if ($i === 0) { // looping awal
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_chart_today($awal = NULL) {
        $this->db->select('COUNT(ip_address) as visits,
            DATE_FORMAT(access_date,"%h %p") AS day, SUM(no_of_visits) AS akses');
        $this->db->from($this->table);
        $this->db->where('DATE(access_date)', $awal);
        $this->db->group_by('HOUR(access_date)');
        
        $get = $this->db->get();
        return [
            'rows' => $get->num_rows(),
            'data' => $get->result_array()
        ];
    }
    function get_chart_range($awal = NULL, $akhir = NULL) {
        $this->db->select('COUNT(ip_address) as visits,
            DATE_FORMAT(access_date,"%d-%m-%Y") AS day, SUM(no_of_visits) AS akses');
        $this->db->from($this->table);
        $this->db->where('DATE(access_date) >=', $awal);
        $this->db->where('DATE(access_date) <=', $akhir);
        $this->db->group_by('DATE(access_date)');
        
        $get = $this->db->get();
        return [
            'rows' => $get->num_rows(),
            'data' => $get->result_array()
        ];
    }
}