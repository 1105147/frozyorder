<div class="container">
    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
            <h2 class="title text-center">Daftar Pesanan Anda</h2>
            <?= $this->session->flashdata('notif'); ?>
            <div class="table-responsive">
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Pesanan</th>
                            <th>Status Pesanan</th>
                            <th>Total Tagihan</th>
                            <th>Status Tagihan</th>
                            <th>Pengiriman</th>
                            <th></th>
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
                                <strong class="bolder bigger-130"><?= $val['code_order'] ?></strong><br/>
                                <span class="grey"><?= format_date($val['buat_order'],2) ?></span>
                            </td>
                            <td><?= status_order($val['status_order'], $val['ship_order']) ?>
                                <br/>
                                <span class="grey"><?= format_date($val['update_order'],2) ?></span>
                            </td>
                            <td class="bolder"><?= rupiah($val['total_payment'] + $val['ship_payment']) ?></td>
                            <td><?= ($val['status_payment'] == '0') ? '<span class="label label-danger">Belum Bayar</span>' : '<span class="label label-success">Sudah Bayar</span>'; ?>
                                <br/>
                                <span class="grey"><?= format_date($val['update_payment'],2) ?></span>
                            </td>
                            <td>
                                <?= ($val['ship_order'] == '0') ? '<span class="label label-info">Ambil Sendiri</span>' : '<span class="label label-warning">Jasa Kurir</span>' ?>
                            </td>
                            <td nowrap>
                                <a href="<?= site_url($module. '/detail/' . encode($val['id_order']) ) ?>" data-original-title="Lihat" title="" data-toggle="tooltip">
                                    <i class="fa fa-external-link blue bigger-150"></i> Detail
                                </a>
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
        <!--Middle Part End-->
    </div>
</div>
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
                {   sClass: "text-center", aTargets: [0,1,2,3,4,5,6]}
            ]
        });
        table.fnAdjustColumnSizing();
    });
</script>