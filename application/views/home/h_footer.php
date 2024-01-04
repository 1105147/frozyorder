<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<footer id="footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="companyinfo">
                        <h2><span>FROZY</span> ORDER</h2>
                        <p><?= $app['deskripsi'] ?></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-3 hide">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <!--<img src="images/home/iframe1.png" alt="" />-->
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="address">
                        <img src="<?= load_file('app/img/map.png') ?>" alt="map" class="lazyload blur-up" />
                        <p class="bolder">
                            Perum Citra Kedaton 1 Jl. Sukun no. 11 Ngringin, Condongcatur Kecamatan Depok, Kabupaten Sleman, D.I Yogyakarta
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-widget hide">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Service</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Online Help</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Quock Shop</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">T-Shirt</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2023 <?= $app['judul'] ?></p>
                <p class="pull-right">Designed by 
                    <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span>
                    <small>{elapsed_time} detik ~ {memory_usage}</small>
                </p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->
<script type="text/javascript">
var routing = "<?= site_url('non_login/ajax/routing'); ?>";

<?php
if(!empty($this->session->userdata('logged'))){
?>
    function update_session() {
        var action = '';
        $.ajax({
            url: routing + "/type/action/source/session",
            type: "POST",
            dataType: "json",
            data: { action: action },
            success: function(rs) {
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }
        });
    }
    function notif_user(notif_id = '') {
        $.ajax({
            url: routing + "/type/list/source/notif",
            type: "POST",
            dataType: "json",
            data: { id: notif_id },
            success: function(rs) {
                $("span#item-notif").html(rs.item);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }
        });
    }
    jQuery(function($) {
        notif_user();
        update_session();
    });
<?php
}
?>
</script>
<script language="javascript">
    jQuery(function($) {
        setInterval(function timer() {
            now = new Date();
            if (now.getTimezoneOffset() == 0)
                (a = now.getTime() + (7 * 60 * 60 * 1000))
            else
                (a = now.getTime());
            now.setTime(a);
            var tahun = now.getFullYear()
            var hari = now.getDay()
            var bulan = now.getMonth()
            var tanggal = now.getDate()
            var hariarray = new Array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu")
            var bulanarray = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember")

            var waktu = hariarray[hari] + ", " + tanggal + " " + bulanarray[bulan] + " " + tahun + " | " + (((now.getHours() < 10) ? "0" : "") + now.getHours() + ":" + ((now.getMinutes() < 10) ? "0" : "") + now.getMinutes() + ":" + ((now.getSeconds() < 10) ? "0" : "") + now.getSeconds() + (" WIT "));
            $(".jam").html(waktu);
        }, 1000);
    });
</script>

