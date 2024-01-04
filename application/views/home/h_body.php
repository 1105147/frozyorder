<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic page needs ============================================ -->
        <?php
        $param = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
        $meta = isset($meta) ? $meta : [];
        $meta_title_default = $app['deskripsi'];
        $meta_desc_default = $app['deskripsi'];
        $meta_author_default = $app['cipta'];
        $meta_url_default = current_url() . $param;
        $meta_img_default = load_file($app['logo'], 1);
        ?>
        <title><?php echo element('title', $meta, $meta_title_default) . ' | ' . $app['judul']; ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="Copyright" content="<?php echo element('author', $meta, $meta_author_default); ?>" />

        <!-- Mobile on Android -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="theme-color" content="<?= $theme[10] ?>" />
        <meta name="application-name" content="<?php echo element('title', $meta, $meta_title_default) . ' | ' . $app['judul']; ?>">
        <meta name="msapplication-navbutton-color" content="<?= $theme[10] ?>">   
        <!-- Mobile on iOS -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="<?= $theme[10] ?>">
        <meta name="apple-mobile-web-app-title" content="<?php echo element('title', $meta, $meta_title_default) . ' | ' . $app['judul']; ?>">   

        <link rel="shortcut icon" type="image/x-icon" href="<?= load_file('app/img/logo.png') ?>"/>  
        <link rel="manifest" href="<?= base_url('manifest.json') ?>">
        <link rel="canonical" href="<?php echo element('url', $meta, $meta_url_default); ?>">
        <link rel="amphtml" href="<?php echo element('amp_url', $meta, $meta_url_default); ?>">

        <!-- SEARCH ENGINE -->
        <meta name="keywords" content="<?php echo element('title', $meta, $meta_title_default) . ' | ' . $app['judul']; ?>" />
        <meta name="description" content="<?php echo limit_text(element('description', $meta, $meta_desc_default), 200); ?>">
        <meta name="author" content="<?php echo element('author', $meta, $meta_author_default); ?>">
        <meta name="rating" content="general">

        <meta itemprop="name" content="<?php echo element('title', $meta, $meta_title_default) . ' | ' . $app['judul']; ?>" />
        <meta itemprop="description" content="<?php echo limit_text(element('description', $meta, $meta_desc_default), 200); ?>" />
        <meta itemprop="image" content="<?php echo element('thumbnail', $meta, $meta_img_default); ?>" />

        <!-- FACEBOOK META -  Change what to your own FB-->
        <meta property="fb:app_id" content="MY_FB_ID">
        <meta property="fb:pages" content="MY_FB_FAGE_ID" />
        <meta property="og:title" content="<?php echo element('title', $meta, $meta_title_default) . ' | ' . $app['judul']; ?>">
        <meta property="og:type" content="article">
        <meta property="og:url" content="<?php echo element('url', $meta, $meta_url_default); ?>">
        <meta property="og:site_name" content="<?php echo element('author', $meta, $meta_author_default); ?>">
        <meta property="og:image" content="<?php echo element('thumbnail', $meta, $meta_img_default); ?>" >
        <meta property="og:description" content="<?php echo limit_text(element('description', $meta, $meta_desc_default), 200); ?>">

        <meta property="article:publisher" content="<?php echo element('author', $meta, $meta_author_default); ?>">
        <meta property="article:author" content="<?php echo element('author', $meta, $meta_author_default); ?>">
        <meta property="article:tag" content="<?php echo element('title', $meta, $meta_title_default) . ' | ' . $app['judul']; ?>">

        <!-- TWITTER META - Change what to your own twitter-->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:description" content="<?php echo limit_text(element('description', $meta, $meta_desc_default), 200); ?>">
        <meta name="twitter:site" content="<?php echo element('author', $meta, $meta_author_default); ?>">
        <meta name="twitter:creator" content="@my_twitter">
        <meta name="twitter:title" content="<?php echo element('title', $meta, $meta_title_default) . ' | ' . $app['judul']; ?>">
        <meta name="twitter:image:src" content="<?php echo element('thumbnail', $meta, $meta_img_default); ?>"> 
        <meta name="twitter:domain" content="<?php echo element('url', $meta, $meta_url_default); ?>" />

        <?php
        load_css(array(
            "backend/assets/fonts/poppins/font.css?family=Poppins:300,400,500,600,700",
            "backend/assets/css/jquery.gritter.css",
            
            "frontend/eshopper/css/bootstrap.min.css",
            "frontend/eshopper/css/font-awesome.min.css",
            "frontend/eshopper/css/prettyPhoto.css",
            "frontend/eshopper/css/price-range.css",
            "frontend/eshopper/css/animate.css",
            "frontend/eshopper/css/main.css",
            "frontend/eshopper/css/responsive.css",
            
            "backend/puru.css?".SW_VERSION,
        ));
        ?>
        <?php
        load_js(array(
            "frontend/eshopper/js/jquery.js",
            "frontend/eshopper/js/bootstrap.min.js"
        ));
        ?>
        <style type="text/css">
            body { font-family:'Poppins', sans-serif }
        </style>
    </head>

    <body>

        <?php $this->load->view('home/h_header'); ?>

        <?= $content ?>

        <?php $this->load->view('home/h_footer'); ?>

        <!-- Include Libs & Plugins ============================================ -->
        <?php
        load_js(array(
            "backend/assets/js/lazy/lazysizes.min.js",
            "backend/assets/js/jquery.gritter.js",
            
            "frontend/eshopper/js/jquery.scrollUp.min.js",
            "frontend/eshopper/js/price-range.js",
            "frontend/eshopper/js/jquery.prettyPhoto.js",
            "frontend/eshopper/js/main.js"
        ));
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/UpUp/1.0.0/upup.min.js"></script>
        <script async type="text/javascript">
            function gritNotif(judul, teks, code) {
                var type = '';
                if (code === 1) {
                    type = 'success';
                } else if (code === 2) {
                    type = 'warning';
                } else if (code === 3) {
                    type = 'error';
                } else {
                    type = 'info';
                }

                $.gritter.add({
                    title: judul + '! ',
                    text: '<span class="bigger-110">' + teks + '.</span>',
                    sticky: false,
                    class_name: 'gritter gritter-' + type
                });
                return false;
            }
            function toNumber(angka) {
                var number = Number(angka.replace(/[^0-9\,]+/g, ""));
                return number;
            }
            function toRp(angka) {
                var rupiah = '';
                var angkarev = angka.toString().split('').reverse().join('');
                for (var i = 0; i < angkarev.length; i++)
                    if (i % 3 === 0)
                        rupiah += angkarev.substr(i, 3) + '.';

                return 'Rp ' + rupiah.split('', rupiah.length - 1).reverse().join('');

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
        <script type="text/javascript">
            $(document).ready(function () {
                const filesToCache = [
                    "app/backend/assets/fonts/poppins/font.css?family=Poppins:300,400,500,600,700",
                    "app/backend/assets/css/jquery.gritter.css",

                    "app/backend/puru.css",

                    "app/frontend/eshopper/css/bootstrap.min.css",
                    "app/frontend/eshopper/css/font-awesome.min.css",
                    "app/frontend/eshopper/css/prettyPhoto.css",
                    "app/frontend/eshopper/css/price-range.css",
                    "app/frontend/eshopper/css/animate.css",
                    "app/frontend/eshopper/css/main.css",
                    "app/frontend/eshopper/css/responsive.css",
                    
                    "app/frontend/eshopper/js/jquery.js",
                    "app/frontend/eshopper/js/bootstrap.min.js",
                    
                    "app/backend/assets/js/lazy/lazysizes.min.js",
                    "app/backend/assets/js/jquery.gritter.js",

                    "app/frontend/eshopper/js/jquery.scrollUp.min.js",
                    "app/frontend/eshopper/js/price-range.js",
                    "app/frontend/eshopper/js/jquery.prettyPhoto.js",
                    "app/frontend/eshopper/js/main.js"
                ];
                UpUp.start({
                    'cache-version': '<?= SW_VERSION ?>',
                    'content-url': '<?= site_url() ?>',
                    'content': 'No Internet Connection',
                    'service-worker-url': '<?= base_url('sw.js') ?>',
                    'assets': filesToCache
                });

                var color_utama = "<?= $theme[10] ?>";
                var color_kedua = "<?= $theme[11] ?>";
            });
        </script>
    </body>
</html>