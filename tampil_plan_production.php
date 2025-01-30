<?php
require_once 'core/init.php';
$today = date('Y-m-d');


?>
<style>
    th,
    td {
        white-space: nowrap;
    }

    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>

<link rel="stylesheet" type="text/css" href="assets/FixedColumns/css/fixedColumns.dataTables.min.css">
<script type="text/javascript" src="assets/FixedColumns/js/dataTables.fixedColumns.min.js"></script>

<div style="margin: 30px">
    <div clss="dataTables_wrapper">
        <br>
        <button class="btn btn-success btn-sm" style="background: #254681" id="btnExportToExcel">Export To excel</button>
        <div id="tableContainer">
            <table id="example" class="table table-striped table-bordered row-border order-column" cellspacing="0" border="1px" width="100%" style="font-size: 12px">
                <thead>
                    <tr>
                        <th style="text-align: center; background: #254681; color: white; color: white">No</th>
                        <th style="text-align: center; background: #254681; color: white">ORC</th>
                        <th style="text-align: center; background: #254681; color: white">STYLE</th>
                        <th style="text-align: center; background: #254681; color: white">ITEM</th>
                        <th style="text-align: center; background: #254681; color: white">COLOR</th>
                        <th style="text-align: center; background: #254681; color: white">BUYER</th>
                        <th style="text-align: center; background: #254681; color: white">PO BUYER</th>
                        <th style="text-align: center; background: #254681; color: white">QTY ORDER</th>
                        <th style="text-align: center; background: #254681; color: white">LINE</th>
                        <th style="text-align: center; background: #254681; color: white">DAYS PROSES</th>
                        <th style="text-align: center; background: #254681; color: white">PLAN SEWING</th>
                        <th style="text-align: center; background: #254681; color: white">ACTION</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    $po = $_GET['po'];
                    $category = $_GET['category'];
                    $orc = $_GET['orc'];
                    $style = $_GET['style'];
                    $status = $_GET['status'];
                    $costomer = $_GET['costomer'];
                    $no = 1;
                    $subtotal_qty = 0;
                    $preparation = tampilkan_plan_production($po, $category, $orc, $style, $status, $costomer);
                    while ($row = mysqli_fetch_assoc($preparation)) {
                    ?>
                        <tr>
                            <td style="text-align: center"><?= $no; ?></td>
                            <td style="text-align: center"><?= $row['orc']; ?></td>
                            <td style="text-align: center"><?= $row['style'];  ?> </td>
                            <td style="text-align: center"><?= $row['item'];  ?> </td>
                            <td style="text-align: center"><?= $row['color'];  ?> </td>
                            <td style="text-align: center"><?= $row['costomer']; ?></td>
                            <td style="text-align: center"><?= $row['no_po']; ?></td>
                            <td style="text-align: center"><?= $row['qty_order'];  ?> </td>
                            <td style="text-align: center"><?= strtoupper($row['plan_line']);  ?> </td>
                            <td style="text-align: center"><?= $row['days_proses'];  ?> </td>
                            <td style="text-align: center"><?= tgl_indonesia3($row['plan_production']);  ?> </td>
                            <td><button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#myEdit">Edit</button>
                                <!-- | <button type="submit" class="hapus_size btn btn-sm btn-danger" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" onclick="return konfirmasi_kurangi()">Hapus</button> -->
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
</div>


<!-- Modal edit preparation -->
<div id="myEdit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <font face="Calibri" color="red"><b>EDIT PREPARATION PRODUCTION</b></font>
                </h4>
            </div>
            <div class="modal-body">
                <div class="lihat-data"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#example').DataTable({
            scrollY: "400px",
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            searching: false,
            fixedColumns: {
                left: 5,
            }
        });
    });
</script>



<script type="text/javascript">
    $(document).ready(function() {
        $('body').on('show.bs.modal', '#myEdit', function(e) {
            var rowedit = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengembalian data
            $.ajax({
                type: 'post',
                url: 'edit_preparation_production.php',
                data: 'rowedit=' + rowedit,
                success: function(data) {
                    $('.lihat-data').html(data); //menampilkan data ke dalam modal
                }
            });
        });

        $('#btnExportToExcel').click(function(e) {
         // let fileName = '<//?= $data4['no_invoice'] ?>';
         let file = new Blob([$('#tableContainer').html()], {
            type: "application/vnd.ms-excel"
         });
         let url = URL.createObjectURL(file);
         let a = $("<a />", {
            href: url,
            download: "plan_production" + ".xls"
         }).appendTo("body").get(0).click();
         e.preventDefault();
      });        

    });
</script>