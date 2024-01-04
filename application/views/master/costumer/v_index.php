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
                </div>
                <div class="widget-body">
                    <div class="widget-main padding-2 table-responsive">
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Level</th>
                                    <th>Costumer</th>
                                    <th>Akun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no = 1;
                                foreach ($costumer['data'] as $row) {
                            ?>
                                <tr>
                                    <td><?= ctk($no); ?></td>
                                    <td><?= ctk($row['dpn_cst'].' '.$row['blkg_cst']); ?></td>
                                    <td><?= ctk($row['kelamin_cst']); ?></td>
                                    <td>
                                        <?= ($row['level_cst'] == '0') ? '<span class="label label-default arrowed-in-right arrowed">Standar</span>' : '<span class="label label-warning arrowed-in-right arrowed">Premium</span>' ?>
                                    </td>
                                    <td>
                                        <?= ($row['status_cst'] == '0') ? '<span class="label label-danger arrowed-in-right arrowed">Tidak Aktif</span>' : '<span class="label label-success arrowed-in-right arrowed">Aktif</span>' ?>
                                    </td>
                                    <td>
                                        <?= ($row['status_user'] == '0') ? '<span class="label label-danger arrowed-in-right arrowed">Tidak Aktif</span>' : '<span class="label label-success arrowed-in-right arrowed">Aktif</span>' ?>
                                        <?= ctk($row['username']); ?>
                                        <hr class="margin-5">
                                        <?= is_online($row['last_login']) ?>
                                    </td>
                                    <td nowrap>
                                        <div class="action-buttons">
                                            <a href="<?= site_url($module.'/detail/'.encode($row['id_costumer'])) ?>" class="tooltip-info btn btn-white btn-info btn-sm" data-rel="tooltip" title="Lihat Detail">
                                                <span class="blue"><i class="ace-icon fa fa-eye bigger-130"></i></span>
                                            </a>
                                            <a href="<?= site_url($module.'/edit/'.encode($row['id_costumer'])) ?>" class="tooltip-warning btn btn-white btn-warning btn-sm" data-rel="tooltip" title="Ubah Data">
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
        $('[data-rel="popover"]').popover({html:true,placement: 'top'});
	
        table = $('#dynamic-table')
            .dataTable({
                bScrollCollapse: true,
                bAutoWidth: false,
                aaSorting: [],
                aoColumnDefs: [
                {
                    bSortable: false,
                    aTargets: [0,6]
                },
                {
                    bSearchable: false,
                    aTargets: [0,6]
                },
                {   sClass: "center", aTargets: [0,1,2,3,4,5,6]}
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
