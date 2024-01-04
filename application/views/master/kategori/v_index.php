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
            <div class="widget-box widget-color-blue">
                <div class="widget-header">
                    <h5 class="widget-title bigger lighter">
                        <i class="ace-icon fa fa-list"></i>
                        <?= $title[1] ?>
                    </h5>
                    <div class="widget-toolbar">
                        <div class="btn-group btn-overlap">
                            <a href="<?= site_url($module.'/add') ?>" class="btn btn-white btn-primary btn-bold">
                                <i class="fa fa-plus-square bigger-110 blue"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                </div>
                <div class="widget-body">
                    <div class="widget-main padding-2 table-responsive">
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Kategori</th>
                                    <th>Parent</th>
                                    <th>Status</th>
                                    <th>Order</th>
                                    <th>Icon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no = 1;
                                foreach ($kategori as $row) {
                            ?>
                                <tr>
                                    <td><?= ctk($no); ?></td>
                                    <td>
                                        <img style="height: 50px" src="<?= load_file($row['a']['foto_kat']) ?>" class="img-circle lazyload blur-up"/>
                                    </td>
                                    <td><?= ctk($row['a']['nama_kat']); ?>
                                        <hr class="margin-5">
                                        <?= ctk($row['a']['slug_kat']); ?>
                                    </td>
                                    <td><?= ($row['a']['parent_kat'] == '0') ?  'Kategori Utama' : $row['b']['nama_kat']; ?></td>
                                    <td>
                                        <?= ($row['a']['status_kat'] == '0') ? '<span class="label label-danger arrowed-in-right arrowed">Tidak Aktif</span>' : '<span class="label label-success arrowed-in-right arrowed">Aktif</span>' ?>
                                    </td>
                                    <td><?= ctk($row['a']['order_kat']); ?></td>
                                    <td><i class="<?= $row['a']['icon_kat']; ?> blue bigger-120"></i></td>
                                    <td nowrap>
                                        <div class="action-buttons">
                                            <a href="<?= site_url($module.'/edit/'.encode($row['a']['id_kategori'])) ?>" class="tooltip-warning btn btn-white btn-warning btn-sm" data-rel="tooltip" title="Ubah Data">
                                                <span class="orange"><i class="ace-icon fa fa-pencil-square-o bigger-130"></i></span>
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
</div><!-- /.page-content -->

<?php
load_js(array(
    'backend/assets/js/dataTables/jquery.dataTables.js',
    'backend/assets/js/dataTables/jquery.dataTables.bootstrap.js'
));
?>
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        $('[data-rel="tooltip"]').tooltip({placement: 'top'});
	
        table = $('#dynamic-table')
            .dataTable({
                bScrollCollapse: true,
                bAutoWidth: false,
                aaSorting: [],
                aoColumnDefs: [
                {
                    bSortable: false,
                    aTargets: [0,7]
                },
                {
                    bSearchable: false,
                    aTargets: [0,7]
                },
                {   sClass: "center", aTargets: [0,1,2,3,4,5,6,7]}
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
