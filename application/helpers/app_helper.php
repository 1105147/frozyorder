<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('jsonResponse')) {

    function jsonResponse($output) {
        $CI = &get_instance();
        $ajax = $CI->config->item('app.debug');

        $ajax_request = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? TRUE : FALSE;
        if ($ajax == 0) {
            (!$ajax_request) ? exit('No direct script access allowed') : '';
        }
        if (defined('JSON_PRETTY_PRINT')) {
            $output = json_encode($output, JSON_PRETTY_PRINT);
        } else {
            $output = json_encode($output);
        }
        header('content-type: application/json; charset: UTF-8');
        print_r($output);
        exit();
    }
}
if (!function_exists('notif')) {

    function notif($type, $title, $message) {
        $alert = '<div class="alert alert-' . $type . '">' .
                '<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' .
                '<strong>' . $title . ' ! </strong></br>' . $message . '<br />' .
                '</div>';

        return $alert;
    }
}
if (!function_exists('load_css')) {

    function load_css(array $array) {
        foreach ($array as $uri) {
            echo '<link rel="stylesheet" type="text/css" href="' . base_url('app/'.$uri) . '" />';
        }
    }

}
if (!function_exists('load_js')) {

    function load_js(array $array, $async = FALSE) {
        foreach ($array as $uri) {
            if(!$async){
                echo '<script type="text/javascript"  src="' . base_url('app/'.$uri) . '"></script>';
            }else{
                echo '<script async type="text/javascript"  src="' . base_url('app/'.$uri) . '"></script>';
            }
        }
    }

}
if (!function_exists('load_file')) {

    function load_file($src, $img = NULL) {
        $new_img = (!is_null($img)) ? 'app/img/no-avatar.png' : 'app/img/no-img.jpg';
        $link = (is_null($src) || $src === '') ? $new_img : $src;
        
        return base_url($link);
    }

}
if (!function_exists('star')) {

    function star($value) {
        if ($value > 0) {
            for ($i = 1; $i <= $value; $i++) {
                echo '<span class="fa fa-stack"><i class="fa fa-star orange"></i></span>';
            }
            for ($i = 1; $i <= 5 - $value; $i++) {
                echo '<span class="fa fa-stack"><i class="fa fa-star-o"></i></span>';
            }
        }
    }

}
if (!function_exists('status_file')) {

    function status_file($value) {

        if(is_null($value) || $value === '') {
            $file = '<i class="bigger-130 fa fa-times red"></i>';
        }else{ 
            $file = '<i class="bigger-130 fa fa-check green"></i>';
        }
        return $file;
    }

}
if (!function_exists('status_order')) {

    function status_order($value, $ship) {

        if ($value == '1') {
            $status = '<span class="label label-warning arrowed-in-right arrowed">Proses</span>';
        } else if ($value == '2') {
            if ($ship == '0') {
                $status = '<span class="label label-info arrowed-in-right arrowed">Siap Diambil</span>';
            } else {
                $status = '<span class="label label-warning arrowed-in-right arrowed">Siap Diantar</span>';
            }
        } else if ($value == '3') {
            $status = '<span class="label label-warning arrowed-in-right arrowed">Pengiriman</span>';
        } else if ($value == '4') {
            $status = '<span class="label label-success arrowed-in-right arrowed">Selesai</span>';
        } else if ($value == '5') {
            $status = '<span class="label label-danger arrowed-in-right arrowed">Ditolak</span>';
        } else if ($value == '6') {
            $status = '<span class="label label-danger arrowed-in-right arrowed">Belum Terima</span>';
        } else {
            $status = '<span class="label label-default arrowed-in-right arrowed">Pending</span>';
        }
        
        return $status;
    }

}
if (!function_exists('encode')) {

    function encode($param, $url_safe = TRUE) {
        if(is_null($param) || $param == '' ){
            return '';
        }        
        $CI = &get_instance();
        $secret_key = $CI->config->item('encryption_key');
        $secret_iv = $CI->config->item('encrypt_iv');
        $encrypt_method = $CI->config->item('encrypt_method');
        // hash
        $key = hash('sha256', $secret_key);
        // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        //do the encryption given text/string/number
        $result = openssl_encrypt($param, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($result);
        
        if ($url_safe) {
            $output = strtr($output, array('+' => '.', '=' => '-', '/' => '~'));
        }
        return $output;
    }
}
if (!function_exists('decode')) {

    function decode($param, $url_safe = TRUE) {
        $CI = &get_instance();
        $secret_key = $CI->config->item('encryption_key');
        $secret_iv = $CI->config->item('encrypt_iv');
        $encrypt_method = $CI->config->item('encrypt_method');
        
        if ($url_safe){
            $param = strtr($param, array('.' => '+', '-' => '=', '~' => '/'));
        }
        // hash
        $key = hash('sha256', $secret_key);
        // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        //do the decryption given text/string/number
        $output = openssl_decrypt(base64_decode($param), $encrypt_method, $key, 0, $iv);

        return $output;
    }
}
if (!function_exists('ip_agent')) {

    function ip_agent() {
        $CI = &get_instance();
        $CI->load->library('user_agent');

        $agent = $CI->input->ip_address();
        if ($CI->agent->is_robot()) {
            $agent .= ' | Robot ' . $CI->agent->robot();
        } else if ($CI->agent->is_mobile()) {
            $agent .= ' | Mobile ' . $CI->agent->mobile();
        } else if ($CI->agent->is_browser()) {
            $agent .= ' | Desktop ';
        } else {
            $agent .= ' | '.$CI->agent->agent_string();
        }
        $agent .= ' - ' . $CI->agent->platform();
        $agent .= ' | ' . $CI->agent->browser() . ' ' . $CI->agent->version();

        return $agent;
    }
}
if (!function_exists('in_sorong')) {

    function in_sorong($latitude_y, $longitude_x) {
        $vertices_x = array(-1.684643, -0.393396, -0.574884, -1.481357);  //latitude points of polygon
        $vertices_y = array(132.004649, 132.334323, 131.191417, 130.943873);   //longitude points of polygon
        
        $points_polygon = count($vertices_x); 
        $status = FALSE; 
        $i = $j = $c = 0;
        for ($i = 0, $j = $points_polygon-1; $i < $points_polygon; $j = $i++) {
            if (($vertices_y[$i] >  $latitude_y != ($vertices_y[$j] > $latitude_y)) && ($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i])) {
                $status = !$status;
            }
        }
        return $status;
    }
}
if (!function_exists('dijkstraAlgorithm')) {
    
    function dijkstraAlgorithm($nodes, $awal, $akhir) {
        $ver = array();
        $next = array();
        
        foreach ($nodes as $node) {
            //ID
            array_push($ver, $node['asal_rute'], $node['tujuan_rute']);
            $next[$node['asal_rute']][] = array("tujuan" => $node['tujuan_rute'], "cost" => $node['jarak_rute']);
            $next[$node['tujuan_rute']][] = array("tujuan" => $node['asal_rute'], "cost" => $node['jarak_rute']);
        }
        $ver = array_unique($ver);
        $tujuan = array();
        foreach ($ver as $v) {
            $tcost[$v] = INF;
            $tujuan[$v] = NULL;
        }
        $tcost[$awal] = 0;
        $V = $ver;
        while (count($V) > 0) {
            $min = INF;
            foreach ($V as $vke) {
                if ($tcost[$vke] < $min) {
                    $min = $tcost[$vke];
                    $u = $vke;
                }
            }

            $V = array_diff($V, array($u));
            if ($tcost[$u] == INF or $u == $akhir) {
                break;
            }
            if (isset($next[$u])) {
                foreach ($next[$u] as $key => $n) {
                    $cost = $tcost[$u] + $n["cost"];
                    if ($cost < $tcost[$n["tujuan"]]) {
                        $tcost[$n["tujuan"]] = $cost;
                        $tujuan[$n["tujuan"]] = $u;
                    }
                }
            }
        }
        $path = array();
        $akh = $akhir;
        while (isset($tujuan[$akh])) {
            array_unshift($path, $akh);
            $akh = $tujuan[$akh];
        }
        array_unshift($path, $awal);
       
        $result['path'] = $path;
        $result['cost'] = (int) $min;
        
        return $result;
    }
}
if (!function_exists('load_array')) {

    function load_array($type) {
        $val = array();
        switch ($type) {
            case 'agama':
                $val = array(
                    'Islam','Katolik','Kristen','Hindu','Budha','Lainnya'
                );
                break;
            case 'tahun':
                $awal = intval(date('Y')) - 1;
                for($i = $awal; $i <= $awal + 5; $i++ ){
                    $val[] = $i;
                }
                break;
        }
        return $val;
    }
}