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
                <a href="<?= site_url($module . '/add') ?>" class="btn btn-success">
                    <i class="fa fa-plus-square"></i> Tambah Data
                </a>
                <div class="card-box table-responsive">
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Harga/Diskon</th>
                                <th>Kondisi</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $no = 1;
                            foreach ($produk['data'] as $row) {
                                $dis = $row['harga_pdk'] - (($row['diskon_pdk']/100)* $row['harga_pdk']);
                        ?>
                            <tr>
                                <td><?= ctk($no); ?></td>
                                <td><a href="<?= site_url('produk/'.$row['slug_pdk']) ?>"  class="bolder" target="_blank">
                                        <?= ctk($row['nama_pdk']); ?>
                                    </a>
                                    <hr class="margin-5">
                                    <?= ctk($row['nama_kat']); ?>
                                </td>
                                <td>
                                    <?= ($row['status_pdk'] == '0') ? '<span class="label label-danger arrowed-in-right arrowed">Tidak Aktif</span>' : '<span class="label label-success arrowed-in-right arrowed">Aktif</span>' ?>
                                </td>
                                <td><?= rupiah($row['harga_pdk']); ?>
                                    <hr class="margin-5">
                                    <?= (is_null($row['diskon_pdk']) || $row['diskon_pdk'] == '0') ? '' : '<span class="label label-info arrowed-in-right arrowed">'.$row['diskon_pdk'].' %</span> '.rupiah($dis) ?>
                                </td>
                                <td>
                                    <?= ($row['kondisi_pdk'] == '0') ? '<span class="label label-default arrowed-in-right arrowed">Bekas</span>' : '<span class="label label-success arrowed-in-right arrowed">Baru</span>' ?>
                                </td>
                                <td>
                                    <span class="label label-danger arrowed-in-right arrowed"><?= $row['stok_pdk']; ?></span>
                                </td>
                                <td nowrap>
                                    <div class="action-buttons">
                                        <a href="<?= site_url($module.'/detail/'.encode($row['id_produk'])) ?>" class="tooltip-info btn btn-info" data-rel="tooltip" title="Lihat Detail">
                                            <i class="fa fa-search-plus"></i>
                                        </a>
                                        <a href="<?= site_url($module.'/edit/'.encode($row['id_produk'])) ?>" class="tooltip-warning btn btn-warning" data-rel="tooltip" title="Ubah Data">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <a href="#" name="<?= encode($row['id_produk']) ?>" itemprop="<?= $row['nama_pdk'] ?>" id="delete-btn" class="tooltip-error btn btn-danger" data-rel="tooltip" title="Hapus Data">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $no++;
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->

<?php
load_js(array(
    'backend/vendors/datatables.net/js/jquery.dataTables.min.js',
    'backend/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
    'backend/assets/js/bootbox.min.js'
));
?>
<script type="text/javascript">
    $(document.body).on("click", "#delete-btn", function(event) {
        var id = $(this).attr("name");
        var name = $(this).attr("itemprop");
        var title = "<h4 class='red center'><i class='ace-icon fa fa-exclamation-triangle red'></i>" + 
                " Peringatan !</h4>";
        var msg = "<p class='center grey bigger-120'><i class='ace-icon fa fa-hand-o-right blue'></i>" + 
                " Apakah anda yakin akan menghapus data <br/><b>" + name + "</b> ? </p>";
        bootbox.confirm({
            title: title,
            message: msg, 
            buttons: {
                cancel: {
                    label: "<i class='ace-icon fa fa-times bigger-110'></i> Batal",
                    className: "btn btn-sm"
                },
                confirm: {
                    label: "<i class='ace-icon fa fa-trash-o bigger-110'></i> Hapus",
                    className: "btn btn-sm btn-danger"
                }
            },
            callback: function(result) {
                if (result === true) {
                    window.location.replace("<?= site_url($module . '/delete/'); ?>" + id);
                }
            }
        });
    });
</script>
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        $('[data-rel="tooltip"]').tooltip({placement: 'top'});
	$('[data-rel="popover"]').popover({html:true,placement: 'top'});
        
        table = $("#dynamic-table")
            .dataTable({
                bScrollCollapse: true,
                bAutoWidth: false,
                aaSorting: [],
                aoColumnDefs: [
                { bSortable: false, aTargets: [0,6] },
                { bSearchable: false, aTargets: [0,6] },
                { sClass: "text-center", aTargets: [0,1,2,3,4,5,6]}
            ],
            oLanguage: {
                sSearch: "Cari : ",
                sInfoEmpty: "Menampilkan dari 0 sampai 0 dari total 0 data",
                sInfo: "Menampilkan dari _START_ sampai _END_ dari total _TOTAL_ data",
                sLengthMenu: "Menampilkan _MENU_ data per halaman",
                sZeroRecords: "Maaf tidak ada data yang ditemukan",
                sInfoFiltered: "(Menyaring dari _MAX_ total data)"
            }
        });
        table.fnAdjustColumnSizing();
    });
</script>                  
