<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('sidebar')) {
    
    function sidebar($data, $parrent, $module) {
        $CI = & get_instance();
        $menu = $CI->uri->segment(1);
        $sub = $CI->uri->segment(2);
        $str = '';
        if (isset($data[$parrent])) {
            // 
            foreach ($data[$parrent] as $value) {
                $child = sidebar($data, $value['id_menu'], $module);
                
                $parent_active = (strtolower(substr($value['module_menu'], 0, strpos($value['module_menu'], '/'))) == $menu) ? 'active' : '';
                $is_open = ($parent_active == 'active') ? ' style="display: block;"' : '';
                $is_sub = strtolower(str_replace('/', '', $value['module_menu']));
                $sub_active = ($is_sub == $menu . $sub || $is_sub . '_do' == $menu . $sub) ? 'current-page' : '';
                
                if ($child) {
                    $str .= '<li class="'.$parent_active.'">
                        <a href="#">
                            <i class="' . $value['icon_menu'] . '"></i>
                            '.$value['nama_menu'].'
                            <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu" '.$is_open.'>' . $child . '</ul>
                    </li>';
                }else{
                    $str .= '<li class="'.$sub_active.'">
                        <a href="' . site_url($module . $value['module_menu']) . '">
                            <i class="' . $value['icon_menu'] . '"></i>&nbsp;&nbsp;
                            '. $value['nama_menu'] .'</a>
                    </li>';
                }
            }
        }
        return $str;
    }
}
if (!function_exists('breadcrumb')) {
    
    function breadcrumb($breadcrumb) {
        if (isset($breadcrumb) && is_array($breadcrumb)) {

            $buffString = "";
            foreach ($breadcrumb as $values) {

                $title = $values['title'];
                $url = $values['url'];

                $breadcrumContent = "";

                if ($url != "") {
                    $breadcrumContent = '<a href="' . $url . '">' . $title . '</a>';
                } else {
                    $breadcrumContent = $title;
                }
                $buffString .= '<li>' . $breadcrumContent . '</li>';
            }
            return $buffString;
        }
    }

}


//HOME
if (!function_exists('sidebar_cat')) {
    
    function sidebar_cat($data, $parrent, $module) {
        $no = 1;
        $str = '';
        if (isset($data[$parrent])) {
            foreach ($data[$parrent] as $value) {
                $child = sidebar_cat($data, $value['id_kategori'], $module);
                if ($child) {
                    
                    $str .= '<div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordian" href="#sport'.$no.'">
                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                    '.$value['nama_kat'].'
                                </a>
                            </h4>
                        </div>
                        <div id="sport'.$no.'" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>'.$child.'</ul>
                            </div>
                        </div>
                    </div>';
                }else{
                    $str .= '<li><a href="'.site_url($module.'/'.$value['slug_kat']).'">'.$value['nama_kat'].'</a></li>';
                }
                $no++;
            }
        }
        return $str;
    }
}
if (!function_exists('navbar')) {
    
    function navbar($data, $parrent, $module) {
        $str = '';
        if (isset($data[$parrent])) {
            
            foreach ($data[$parrent] as $value) {
                $child = navbar($data, $value['id_nav'], $module);
                if ($child) {
                    $str .= '<li class="dropdown">
                                <a href="'. site_url($module . $value['url_nav']) .'">
                                    '. $value['judul_nav'] .' <i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">'.$child.'</ul>
                            </li>';
                }else{
                    if($value['link_nav'] == '1'){
                        $str .= '<li>
                                <a target="_blank" href="'. $value['url_nav'] .'">'. $value['judul_nav'] .'</a>
                            </li>';
                    }else{
                        $str .= '<li>
                                <a href="'. site_url($module . $value['url_nav']) .'">'. $value['judul_nav'] .'</a>
                            </li>';
                    }
                    
                }
            }
        }
        return $str;
    }
}