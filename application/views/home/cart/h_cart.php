<section id="cart_items">
    <div class="container">
        <h2 class="title text-center">Keranjang Belanja</h2>
        
        <?= $this->session->flashdata('notif'); ?>
        <div class="table-responsive cart_info">
            <table id="dynamic-table" class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="price"></td>
                        <td class="price">Item</td>
                        <td class="price">Harga Satuan</td>
                        <td class="price">Diskon</td>
                        <td class="price">Harga Diskon</td>
                        <td class="quantity">Jumlah</td>
                        <td class="price">Total</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6"></th>
                        <th colspan="2" class="cart_total bolder">
                            <p class="cart_total_price" id="subtotal_cart"><?= rupiah($this->cart->total()) ?></p>
                            <a class="btn btn-default check_out" href="<?= site_url('cart/detail') ?>">
                                Lanjutkan Pemesanan <i class="fa fa-arrow-right"></i>
                            </a>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<?php
load_js(array(
    'backend/assets/js/dataTables/jquery.dataTables.js',
    'backend/assets/js/dataTables/jquery.dataTables.bootstrap.js'
));
?>
<script type="text/javascript">
    var table;
    var module = "<?= site_url($module); ?>";
    $(document).ready(function () {
        loadTable();
    });
</script>
<script type="text/javascript">
    function cekQty(rs) {
        var id = $(rs).attr("id");
        if (rs.value < 0 || rs.value > 100) {
            $("#" + id).focus();
            gritNotif('Peringatan', 'Minimal <b>1</b> dan Maksimal <b>100</b> dalam 1x transaksi', 2);
        }
    }
    function updateCart(id, jum) {
        var jumlah = 0;
        if (jum !== '0') {
            jumlah = $("#jumlah" + jum).val();
        }
        if (jumlah < 0 || jumlah > 100) {
            $("#jumlah" + jum).focus();
            gritNotif('Peringatan', 'Minimal <b>1</b> dan Maksimal <b>100</b> dalam 1x transaksi', 2);
        } else {
            $.ajax({
                url: module + "/ajax/type/action/source/delete",
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    jumlah: jumlah
                },
                success: function (rs) {
                    if (rs.status) {
                        gritNotif('Informasi', rs.msg, 1);
                    } else {
                        gritNotif('Peringatan', rs.msg, 2);
                    }
                    table.fnDraw();
                    $("span#item_cart").html(rs.item);
                    $("span#total_cart, p#subtotal_cart").html(rs.total);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    gritNotif('Error', 'Keranjang belanja anda gagal diperbarui', 3);
                }
            });
        }
    }
    function loadTable() {
        table = $('#dynamic-table')
        .dataTable({
            bScrollCollapse: true,
            bAutoWidth: false,
            bFilter: false,
            bPaginate: false,
            bInfo: false,
            bProcessing: true,
            bServerSide: true,
            sAjaxSource: module + "/ajax/type/list/source/table",
            fnServerData: function (sSource, aaData, fnCallback) {
                $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    url: sSource,
                    data: aaData,
                    success: function (json) {
                        fnCallback(json);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log('Loading tabel barang GAGAL');
                    }
                });
            },
            aoColumnDefs: [
                {bSortable: false, aTargets: [0, 1, 2, 3, 4, 5, 6, 7]},
                {sClass: "cart_price", aTargets: [2,3,4]},
                {sClass: "cart_total", aTargets: [6]}
            ],
            oLanguage: {
                "sZeroRecords": "Item masih kosong"
            }
        });
        table.fnAdjustColumnSizing();
    }
</script>
