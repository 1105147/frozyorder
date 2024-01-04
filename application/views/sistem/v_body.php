<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $param = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
            $meta = isset($meta) ? $meta : [];
            $meta_title_default = $app['judul'] .' | '.ctk($app['deskripsi']);
            $meta_desc_default = ctk($app['deskripsi']);
            $meta_author_default = $app['judul'];
            $meta_url_default  = current_url() . $param;
            $meta_img_default  = base_url($app['logo']);    
        ?>
        <title><?php echo element('title', $meta, $meta_title_default).' | '.$app['judul']; ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="Copyright" content="<?php echo element('author', $meta, $meta_author_default); ?>" />
        
        <!-- Mobile on Android -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="theme-color" content="<?= $theme[10] ?>" />
        <meta name="application-name" content="<?php echo element('title', $meta, $meta_title_default).' | '.$app['judul']; ?>">
        <meta name="msapplication-navbutton-color" content="<?= $theme[10] ?>">   
        <!-- Mobile on iOS -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="<?= $theme[10] ?>">
        <meta name="apple-mobile-web-app-title" content="<?php echo element('title', $meta, $meta_title_default).' | '.$app['judul']; ?>">   
        
        <link rel="shortcut icon" type="image/x-icon" href="<?= load_file('app/img/logo.png') ?>"/>  
        <link rel="manifest" href="<?= base_url('manifest.json') ?>">
        <link rel="canonical" href="<?php echo element('url', $meta, $meta_url_default); ?>">
        <link rel="amphtml" href="<?php echo element('amp_url', $meta, $meta_url_default); ?>">
        
        <!-- SEARCH ENGINE -->
        <meta name="keywords" content="<?php echo element('title', $meta, $meta_title_default).' | '.$app['judul']; ?>" />
        <meta name="description" content="<?php echo limit_text(element('description', $meta, $meta_desc_default),200); ?>">
        <meta name="author" content="<?php echo element('author', $meta, $meta_author_default); ?>">
        <meta name="rating" content="general">
        
        <meta itemprop="name" content="<?php echo element('title', $meta, $meta_title_default).' | '.$app['judul']; ?>" />
        <meta itemprop="description" content="<?php echo limit_text(element('description', $meta, $meta_desc_default),200); ?>" />
        <meta itemprop="image" content="<?php echo element('thumbnail', $meta, $meta_img_default); ?>" />

        <!-- FACEBOOK META -  Change what to your own FB-->
        <meta property="fb:app_id" content="MY_FB_ID">
        <meta property="fb:pages" content="MY_FB_FAGE_ID" />
        <meta property="og:title" content="<?php echo element('title', $meta, $meta_title_default).' | '.$app['judul']; ?>">
        <meta property="og:type" content="article">
        <meta property="og:url" content="<?php echo element('url', $meta, $meta_url_default); ?>">
        <meta property="og:site_name" content="<?php echo element('author', $meta, $meta_author_default); ?>">
        <meta property="og:image" content="<?php echo element('thumbnail', $meta, $meta_img_default); ?>" >
        <meta property="og:description" content="<?php echo limit_text(element('description', $meta, $meta_desc_default),200); ?>">
        
        <meta property="article:publisher" content="<?php echo element('author', $meta, $meta_author_default); ?>">
        <meta property="article:author" content="<?php echo element('author', $meta, $meta_author_default); ?>">
        <meta property="article:tag" content="<?php echo element('title', $meta, $meta_title_default).' | '.$app['judul']; ?>">

        <!-- TWITTER META - Change what to your own twitter-->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:description" content="<?php echo limit_text(element('description', $meta, $meta_desc_default),200); ?>">
        <meta name="twitter:site" content="<?php echo element('author', $meta, $meta_author_default); ?>">
        <meta name="twitter:creator" content="@my_twitter">
        <meta name="twitter:title" content="<?php echo element('title', $meta, $meta_title_default).' | '.$app['judul']; ?>">
        <meta name="twitter:image:src" content="<?php echo element('thumbnail', $meta, $meta_img_default); ?>"> 
        <meta name="twitter:domain" content="<?php echo element('url', $meta, $meta_url_default); ?>" />
        
        <!-- bootstrap & fontawesome -->
        <?php
            load_css(array(
//                'backend/assets/css/bootstrap.css',
//                'backend/assets/css/font-awesome.css',
//                'backend/assets/css/select2.css',
//                'backend/assets/css/jquery.gritter.css',
//                'backend/assets/css/datepicker.css',
//                'backend/assets/css/colorpicker.css',
//                'backend/assets/css/ace-fonts.css',
                'backend/assets/fonts/poppins/font.css?family=Poppins:300,400,500,600,700',
                
                
                
                //'frontend/shop/css/font-awesome/css/font-awesome.min.css',
                
                'backend/vendors/bootstrap/dist/css/bootstrap.min.css',
                'backend/vendors/font-awesome/css/font-awesome.min.css',
                'backend/build/css/custom.min.css',
                
                'backend/puru.css'
            ));
            load_js(array(
                //'backend/assets/js/ace-extra.js',
                //'backend/assets/js/jquery.js'
                'backend/vendors/jquery/dist/jquery.min.js'
            ));
        ?>
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?= site_url() ?>" class="site_title">
                                <i class="fa fa-paw"></i> <span><?= $app['judul'] ?></span>
                            </a>
                        </div>

                        <div class="clearfix"></div>
                        <!-- sidebar menu -->
                        <?php $this->load->view('sistem/v_sidebar'); ?>
                        <!-- /sidebar menu -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <?php $this->load->view('sistem/v_header'); ?>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <?= $content ?>
                    </div>
                </div>
                <!-- /page content -->

                <!-- footer content -->
                <?php $this->load->view('sistem/v_footer'); ?>
                <!-- /footer content -->
            </div>
        </div>
        <?php
            load_js(array(
                'backend/vendors/bootstrap/dist/js/bootstrap.min.js',
                'backend/build/js/custom.min.js',
                //'backend/assets/js/bootstrap.js',
                'backend/assets/js/jquery.gritter.js',
                'backend/assets/js/lazy/lazysizes.min.js',
                
//                'backend/assets/js/ace/elements.scroller.js',
//                'backend/assets/js/ace/elements.colorpicker.js',
//                'backend/assets/js/ace/elements.fileinput.js',
//                'backend/assets/js/ace/elements.aside.js',
//                'backend/assets/js/ace/ace.js',
//                'backend/assets/js/ace/ace.ajax-content.js',
//                'backend/assets/js/ace/ace.touch-drag.js',
//                'backend/assets/js/ace/ace.sidebar.js',
//                'backend/assets/js/ace/ace.sidebar-scroll-1.js',
//                'backend/assets/js/ace/ace.submenu-hover.js',
//                'backend/assets/js/ace/ace.widget-box.js',
//                'backend/assets/js/ace/ace.settings.js',
//                'backend/assets/js/ace/ace.settings-skin.js',
//                'backend/assets/js/ace/ace.widget-on-reload.js'
            ));
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/UpUp/1.0.0/upup.min.js"></script>
        <script async type="text/javascript">
            $(document).ready(function() {
                const filesToCache = [
                    'app/backend/assets/css/bootstrap.css',
                    'app/backend/assets/css/font-awesome.css',
                    'app/backend/assets/css/select2.css',
                    'app/backend/assets/css/jquery.gritter.css',
                    'app/backend/assets/css/datepicker.css',
                    'app/backend/assets/css/colorpicker.css',
                    'app/backend/assets/css/ace-fonts.css',
                    'app/backend/assets/fonts/poppins/font.css?family=Poppins:300,400,500,600,700',
                    'app/backend/assets/css/ace.css',
                    
                    'app/backend/puru.css',
                
                    'app/frontend/shop/css/font-awesome/css/font-awesome.min.css',
                    
                    'app/backend/assets/js/ace-extra.js',
                    'app/backend/assets/js/jquery.js',

                    'app/backend/assets/js/bootstrap.js',
                    'app/backend/assets/js/jquery.gritter.js',
                    'app/backend/assets/js/lazy/lazysizes.min.js',

                    'app/backend/assets/js/ace/elements.scroller.js',
                    'app/backend/assets/js/ace/elements.colorpicker.js',
                    'app/backend/assets/js/ace/elements.fileinput.js',
                    'app/backend/assets/js/ace/elements.aside.js',
                    'app/backend/assets/js/ace/ace.js',
                    'app/backend/assets/js/ace/ace.ajax-content.js',
                    'app/backend/assets/js/ace/ace.touch-drag.js',
                    'app/backend/assets/js/ace/ace.sidebar.js',
                    'app/backend/assets/js/ace/ace.sidebar-scroll-1.js',
                    'app/backend/assets/js/ace/ace.submenu-hover.js',
                    'app/backend/assets/js/ace/ace.widget-box.js',
                    'app/backend/assets/js/ace/ace.settings.js',
                    'app/backend/assets/js/ace/ace.settings-skin.js',
                    'app/backend/assets/js/ace/ace.widget-on-reload.js'
                ];
                UpUp.start({
                    'cache-version': '<?= SW_VERSION ?>',
                    'content-url': '<?= site_url() ?>',
                    'content': 'No Internet Connection',
                    'service-worker-url': "<?= base_url('sw.js') ?>",
                    'assets': filesToCache
                });
            });
        </script>
        <script type="text/javascript">
            $('button[type="reset"]').click(function(){
                $('.select2').val(null).trigger('change');
            });
            function myNotif(judul,teks,code){
                var type = '';
                if(code === 1){
                    type = 'success';
                }else if(code === 2){
                    type = 'warning';
                }else if(code === 3){
                    type = 'error';
                }else{
                    type = 'info';
                }
                
                $.gritter.add({
                    title: judul + ' !',
                    text: '<span class="bigger-130">' + teks + '</span>',
                    sticky: false,
                    class_name: 'gritter gritter-' + type
                });                
                return false;
            }
            function ToNumber(angka) {
                var number = Number(angka.replace(/[^0-9\,]+/g, ""));
                return number;
            }
            function ToRp(angka) {
                var rupiah = '';
                var angkarev = angka.toString().split('').reverse().join('');
                for (var i = 0; i < angkarev.length; i++)
                    if (i % 3 == 0)
                        rupiah += angkarev.substr(i, 3) + '.';

                return rupiah.split('', rupiah.length - 1).reverse().join('');

            }
            jQuery(function($) {
                $.extend($.gritter.options, { 
                    position: 'top-right',
                    fade_in_speed: 'medium', 
                    fade_out_speed: 1500,
                    time: 3000
                });
            });
        </script>
    </body>
</html>