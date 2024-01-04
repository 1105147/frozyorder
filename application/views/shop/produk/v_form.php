<?php
$this->load->view('sistem/v_breadcrumb');
?>
<div class="row">
    <div class="col-xs-12">
        <?= $this->session->flashdata('notif'); ?>
    </div>
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?= $title[1] ?></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form id="validation-form" action="<?= site_url($action); ?>" name="form" class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
                    <div class="form-group <?= is_null($produk['nama_pdk']) ? '' : '' ?>">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right">Nama</label>
                        <div class="col-xs-12 col-sm-4">
                            <div class="clearfix">
                                <input value="<?= $produk['nama_pdk'] ?>" type="text" name="nama" id="nama" class="form-control col-xs-12  col-sm-6" placeholder="Nama Produk" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right">Harga</label>
                        <div class="col-xs-12 col-sm-3">
                            <div class="clearfix">
                                <input value="<?= $produk['harga_pdk'] ?>" type="number" name="harga" id="harga" class="form-control col-xs-12  col-sm-6" placeholder="Harga Produk" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right">Stok</label>
                        <div class="col-xs-12 col-sm-3">
                            <div class="clearfix">
                                <input value="<?= $produk['stok_pdk'] ?>" type="number" name="stok" id="stok" class="form-control col-xs-12  col-sm-6" placeholder="Stok Produk" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right">Kategori</label>
                        <div class="col-xs-12 col-sm-3">
                            <div class="clearfix">
                                <select class="form-control" name="kategori" id="kategori" data-placeholder="-------> Pilih Kategori <-------">
                                    <option value=""> -------> Pilih Kategori <------- </option>
                                    <?php
                                    foreach ($parent['data'] as $val) {
                                        $selected = ($produk['parent_kat'] == $val['id_kategori'] || $produk['kategori_id'] == $val['id_kategori']) ? 'selected' : '';
                                        echo '<option value="' . $val['id_kategori'] . '"  ' . $selected . '>' . $val['nama_kat'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group hide parent_related">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right">Sub Kategori</label>
                        <div class="col-xs-12 col-sm-3">
                            <div class="clearfix">
                                <input type="hidden" id="sub" value="<?= $produk['kategori_id'] ?>">
                                <select class="form-control" name="subkat" id="subkat" data-placeholder="-------> Pilih Sub Kategori <-------">
                                    
                                </select>
                            </div>
                        </div>
                        <span class="help-inline col-xs-12 col-sm-3">
                            <span class="middle orange">* Abaikan apabila tidak memiliki Sub</span>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right">Status</label>
                        <div class="col-xs-12 col-sm-8">
                            <div class="radio">
                                <label>
                                    <input <?= ($produk['status_pdk'] == '1') ? 'checked' : ''; ?> name="status" value="1" type="radio" class="" />
                                    <span class="lbl"> Aktif</span>
                                </label>&nbsp;&nbsp;&nbsp;
                                <label>
                                    <input <?= ($produk['status_pdk'] == '0') ? 'checked' : ''; ?> name="status" value="0" type="radio" class="" />
                                    <span class="lbl"> Tidak Aktif</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right">Kondisi</label>
                        <div class="col-xs-12 col-sm-8">
                            <div class="radio">
                                <label class="">
                                    <input <?= ($produk['kondisi_pdk'] == '1') ? 'checked' : ''; ?> name="kondisi" value="1" type="radio" class="" />
                                    <span class="lbl"> Baru</span>
                                </label>&nbsp;&nbsp;&nbsp;
                                <label class="">
                                    <input <?= ($produk['kondisi_pdk'] == '0') ? 'checked' : ''; ?> name="kondisi" value="0" type="radio" class="" />
                                    <span class="lbl"> Bekas</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right">Deskripsi</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="clearfix">
                                <textarea rows="5" name="info" id="info" placeholder="Deskripsi Produk" class="form-control"><?= $produk['informasi_pdk'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right">Foto</label>
                        <div class="col-xs-12 col-sm-3">
                            <div class="clearfix">
                                <input value="<?= $produk['fotosatu_pdk'] ?>" type="hidden" name="exfoto" id="exfoto" />
                                <input accept="image/*" value="" type="file" name="foto" id="foto" placeholder="Foto Produk" class="col-xs-12  col-sm-6" />
                            </div>
                        </div>
                        <span class="help-inline col-xs-12 col-sm-3">
                            <span class="middle red">
                                * Maksimal 3 MB<br/>
                                * Ratio 1:1
                            </span>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right"></label>
                        <div class="col-xs-12 col-sm-3">
                            <div class="clearfix">
                                <img class="img-thumbnail blur-up lazyload" src="<?= load_file($produk['fotosatu_pdk']) ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right">Terakhir diubah</label>
                        <div class="col-xs-12 col-sm-4">
                            <div class="well">
                                <span class="bigger-110 green"><i class="ace-icon fa fa-pencil"></i> &nbsp;&nbsp;<?= format_date($produk['buat_pdk'], 0) ?></span><br/>
                                <span class="bigger-110 blue"><i class="ace-icon fa fa-user"></i> &nbsp;&nbsp;<?= $produk['log_pdk'] ?></span><br/>
                                <span class="bigger-110 orange"><i class="ace-icon fa fa-clock-o"></i> &nbsp;&nbsp;<?= format_date($produk['update_pdk'], 0) ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-8">
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
        </div>
    </div>
</div><!-- /.row -->

<?php load_js(array("backend/assets/js/jquery.validate.js")); ?>

<script type="text/javascript">
    const module = '<?= site_url($module); ?>';
    $(document).ready(function() {
        var parent = $("#kategori").val();
        if (parent === '0' || parent === '') {
            $('.parent_related').addClass('hide');
        } else {
            list_kategori(parent);
            $('.parent_related').removeClass('hide');
        }
    });
    function list_kategori(id) {
        $("#subkat").html('<option value=""> -------> Pilih Sub Kategori <------- </option>');
        $.ajax({
            url: module + "/ajax/type/list/source/kategori",
            type: "POST",
            dataType: "json",
            data: {id: id, sub: $("#sub").val()},
            success: function (rs) {
                if (rs.status) {
                    $("#subkat").append(rs.content);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                myNotif('Peringatan!', 'Loading data gagal. Coba lagi!', 3);
            }
        });
    }

    $("select#kategori").change(function () {
        var selected = $('select[name="kategori"] option:selected').val();
        if (selected === '0' || selected === '') {
            $('.parent_related').addClass('hide');
        } else {
            list_kategori(selected);
            $('.parent_related').removeClass('hide');
        }
    });
    $("#validation-form").validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        rules: {
            nama: {
                required: true,
                minlength: 10
            },
            harga: {
                required: true,
                digits: true
            },
            stok: {
                required: true,
                digits: true,
                min: 1
            },
            kategori: {
                required: true
            },
            status: {
                required: true
            },
            kondisi: {
                required: true
            },
            info: {
                required: true,
                minlength: 20
            }
        },
        messages: {
            nama: {
                required: "Kolom Nama Produk harus diisi",
                minlength: "Panjang isi kolom minimal 10 karakter"
            },
            harga: {
                required: "Kolom Harga Produk harus diisi",
                digits: "Harga harus berupa angka bulat"
            },
            stok: {
                required: "Kolom Stok Produk harus diisi",
                digits: "Stok harus berupa angka bulat",
                min: "Minimal Stok 1 buah"
            },
            status: "Pilih Status Produk terlebih dahulu",
            kategori: "Pilih Kategori Produk terlebih dahulu",
            kondisi: "Pilih Kondisi Produk terlebih dahulu",
            info: {
                required: "Kolom Informasi Produk harus diisi",
                minlength: "Panjang isi kolom minimal 20 karakter"
            }
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
            $(e).remove();
        },
        errorPlacement: function (error, element) {
            if (element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if (controls.find(':checkbox,:radio').length > 1)
                    controls.append(error);
                else
                    error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if (element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            } else if (element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            } else
                error.insertAfter(element.parent());
        },
        invalidHandler: function (form) {
        }
    });
</script>
