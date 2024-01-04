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
            <div class="widget-box widget-color-orange">
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
                                    <th>No.Pesanan</th>
                                    <th>Status Pesanan</th>
                                    <th>Dikirim Oleh</th>
                                    <th>Status Pengiriman</th>
                                    <th>Biaya Kirim</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($order['data'] as $val) {
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>    
                                        <span class="bolder bigger-120"><?= $val['code_order'] ?></span>
                                        <br/>
                                        <span class="grey"><?= format_date($val['buat_order'],2) ?></span>
                                    </td>
                                    <td>
                                        <?= status_order($val['status_order'],$val['ship_order']) ?>
                                        <br/>
                                        <span class="grey"><?= format_date($val['update_order'],2) ?></span>
                                    </td>
                                    <td>
                                        <span class="label label-info arrowed arrowed-in-right">
                                        <?php
                                        if($val['jenis_ship'] == '0'){
                                            echo 'Toko';
                                        }else if($val['jenis_ship'] == '1'){
                                            echo 'Jasa Ekspedisi';
                                        }else{
                                            echo 'Pilih Metode Pengiriman';
                                        }
                                        ?>
                                        </span>
                                        <br/>
                                        <span class="grey bolder"><?= $val['kurir'] ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        if ($val['status_ship'] === '1') {
                                            echo '<span class="label label-warning arrowed arrowed-in-right">Proses Kirim</span>';
                                        } else if ($val['status_ship'] === '2') {
                                            echo '<span class="label label-success arrowed arrowed-in-right">Sampai Tujuan</span>';
                                        }else if ($val['status_ship'] === '3') {
                                            echo '<span class="label label-danger arrowed arrowed-in-right">Belum Sampai</span>';
                                        } else {
                                            echo '<span class="label label-default arrowed arrowed-in-right">Pending</span>';
                                        }
                                        ?>
                                        <br/>
                                        <span class="grey"><?= format_date($val['update_ship'], 2) ?></span>
                                    </td>
                                    <td class="bolder"><?= rupiah($val['ship_payment']) ?></td>
                                    <td nowrap>
                                        <div class="action-buttons">
                                            <a href="<?= site_url($module. '/detail/' . encode($val['id_order']) ) ?>" class="tooltip-info btn btn-white btn-info btn-sm" data-rel="tooltip" title="Lihat Detail">
                                                <i class="ace-icon fa fa-external-link blue bigger-130"></i>
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
