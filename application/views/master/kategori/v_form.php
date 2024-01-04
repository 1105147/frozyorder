<?php
$this->load->view('sistem/v_breadcrumb');
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            <?= $title[0] ?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?= $title[1] ?>
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-xs-12">
            <?= $this->session->flashdata('notif'); ?>
        </div>
        <div class="col-xs-12">
            <h3 class="lighter center block blue"><?= $title[1] ?></h3>
            <form id="validation-form" action="<?= site_url($action); ?>" name="form" class="form-horizontal" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">Nama :</label>
                    <div class="col-xs-12 col-sm-7">
                        <div class="clearfix">
                            <input value="<?= $kat['nama_kat'] ?>" type="text" name="nama" id="nama" class="col-xs-12  col-sm-6" placeholder="Nama Kategori" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">Jenis :</label>
                    <div class="col-xs-12 col-sm-3">
                        <div class="clearfix">
                            <select class="select2 width-100" name="jenis" id="jenis" data-placeholder="-------> Pilih Jenis Kategori <-------">
                                <option value="" <?= (is_null($kat['parent_kat'])) ? 'selected' : '' ; ?>>  </option>
                                <option value="0" <?= ($kat['parent_kat'] == '0') ? 'selected' : '' ; ?>>Kategori Utama</option>
                                <option value="1" <?= (!(is_null($kat['parent_kat'])) && $kat['parent_kat'] != '0') ? 'selected' : '' ; ?> >Sub Kategori</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group hide parent_related">
                    <label class="control-label col-xs-12 col-sm-4 no-padding-right"></label>
                    <div class="col-xs-12 col-sm-3">
                        <div class="clearfix">
                            <select class="select2 width-100" name="pilihan" id="pilihan" data-placeholder="-------> Pilih Kategori <-------">
                                <option value=""> </option>
                                <?php
                                foreach ($parent['data'] as $val) {
                                    $selected = ($kat['parent_kat'] == $val['id_kategori']) ? 'selected' : '';
                                    echo '<option value="'.$val['id_kategori'].'"  '.$selected.'>'.$val['nama_kat'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">Order :</label>
                    <div class="col-xs-12 col-sm-7">
                        <div class="clearfix">
                            <input value="<?= $kat['order_kat'] ?>" type="number" name="order" id="icon" class="col-xs-12  col-sm-3" placeholder="Order Kategori" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">Status :</label>
                    <div class="col-xs-12 col-sm-7">
                        <div class="clearfix">
                            <label class="control-label">
                                <input <?= ($kat['status_kat'] == '1') ? 'checked' : '' ; ?> name="status" value="1" type="radio" class="ace" />
                                <span class="lbl"> Aktif</span>
                            </label>&nbsp;&nbsp;&nbsp;
                            <label class="control-label">
                                <input <?= ($kat['status_kat'] == '0') ? 'checked' : '' ; ?> name="status" value="0" type="radio" class="ace" />
                                <span class="lbl"> Tidak Aktif</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">Icon :</label>
                    <div class="col-xs-12 col-sm-7">
                        <div class="clearfix">
                            <input value="<?= $kat['icon_kat'] ?>" type="text" name="icon" id="icon" class="col-xs-12  col-sm-3" placeholder="Icon Kategori" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">Foto :</label>
                    <div class="col-xs-12 col-sm-3">
                        <div class="clearfix">
                            <input value="<?= $kat['foto_kat'] ?>" type="hidden" name="exfoto" id="exfoto" />
                            <input accept="image/*" value="" type="file" name="foto" id="foto" placeholder="Foto Kategori" class="col-xs-12  col-sm-6" />
                        </div>
                    </div>
                    <span class="help-inline col-xs-12 col-sm-2">
                        <span class="middle red">* Maksimal 300 Kb</span>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-4 no-padding-right"></label>
                    <div class="col-xs-12 col-sm-4">
                        <div class="clearfix">
                            <img class="img-thumbnail blur-up lazyload" src="<?= load_file($kat['foto_kat']) ?>">
                        </div>
                    </div>
                </div>
                <div class="clearfix form-actions">
                    <div class="col-md-offset-5 col-md-4">
                        <button class="btn" type="reset">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            Batal
                        </button>
                        &nbsp; &nbsp; &nbsp;
                        <button class="btn btn-success" name="simpan" id="simpan" type="submit">
                            <i class="ace-icon fa fa-check"></i>
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.row -->
</div><!-- /.page-content -->

<?php load_js(array(
    "backend/assets/js/jquery.validate.js",
    "backend/assets/js/select2.js")); 
?>

<script type="text/javascript">
    jQuery(function($) {
        $(".select2").select2({allowClear: true})
            .on('change', function() {
                $(this).closest('form').validate().element($(this));
        });
        
        if($('select#jenis').val() === '0' || $('select#jenis').val() === ''){
            $('.parent_related').addClass('hide');
        }else{
            $('.parent_related').removeClass('hide');
        }
        
        var img_ext = ["jpg", "png", "jpeg", "PNG", "JPG"];
        $('#foto').ace_file_input({
            no_file: 'Pilih Foto Kategori...',
            no_icon: 'fa fa-file-image-o',
            icon_remove: 'fa fa-times',
            btn_choose: 'Pilih',
            btn_change: 'Ubah',
            onchange: null,
            allowExt: img_ext,
            maxSize: 310000
        }).on('file.error.ace', function(ev, success) {
            if(success.error_count['ext']) myNotif('Peringatan!', 'Format gambar harus berupa *.jpg, *.png', 3);
            if(success.error_count['size']) myNotif('Peringatan!', 'Ukuran gambar maksimal 300 Kb', 3);
        });
    });
</script>
<script type="text/javascript">
    $('select#jenis').change(function(){
        if($('select[name="jenis"] option:selected').val() === '0' || $('select[name="jenis"] option:selected').val() === '') {
            $('.parent_related').addClass('hide');
        } else {
            $('.parent_related').removeClass('hide');
        }
    });
    $('#validation-form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        rules: {
            nama: {
                required: true
            },
            jenis: {
                required: true
            },
            order: {
                required: true
            },
            status: {
                required: true
            }
        },
        messages: {
            nama: "Kolom Nama Kategori harus diisi",
            jenis: "Field Jenis Kategori harus diisi",
            order: "Field Order Kategori harus diisi",
            status: "Pilih Status Kategori terlebih dahulu"
        },
        highlight: function(e) {
            $(e).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(e) {
            $(e).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(e).remove();
        },
        errorPlacement: function(error, element) {
            if (element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if (controls.find(':checkbox,:radio').length > 1)
                    controls.append(error);
                else
                    error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if (element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if (element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else
                error.insertAfter(element.parent());
        },
        invalidHandler: function(form) {
        }
    });
</script>
