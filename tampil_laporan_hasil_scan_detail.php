<?php
require_once 'core/init.php';

$proses = $_GET['trx'];
$tgl = $_GET['tgl'];
$orc = $_GET['orc'];
$style = $_GET['style'];
$status = $_GET['status'];
$costomer = $_GET['costomer'];
$no_po = $_GET['no_po'];
$category = $_GET['category'];
$line = $_GET['line'];
$color = $_GET['color'];
if ($line == 'all') {
  $line = '';
}
$checkstyle = $_GET['checkstyle'];

$temp_sewing = mencari_data_master_transaksi('qc_endline');
$datasewing = mysqli_fetch_array($temp_sewing);
$urutansewing = $datasewing['urutan'];

$temp1 = mencari_data_master_transaksi($proses);
$datatransaksi = mysqli_fetch_array($temp1);
$table = $datatransaksi['table_transaksi'];
$urutan = $datatransaksi['urutan'];

if ($urutan < $urutansewing) {
  $kategori_line = 'before_input_sewing';
} else {
  $kategori_line = 'after_input_sewing';
}

if ($kategori_line == 'before_input_sewing') {
  $plan_line = $line;
  $jalan_line = '';
} else {
  $plan_line = '';
  $jalan_line = $line;
}
$temp1 = mencari_data_master_transaksi($proses);
$datatransaksi = mysqli_fetch_array($temp1);
$table = $datatransaksi['table_transaksi'];
?>
<!-- <style>
  #float {
        position: fixed;
        top: 2em;
        left: 1em;
        z-index: 100;
    }
</style> -->
<!-- <div id="float">
        <button id="enable">Enable</button> <button id="disable">Disable</button>
    </div> -->
<div style="margin: 20px">
  <button class="btn btn-success btn-sm" style="background: #254681" id="btnExportToExcel">Export To excel</button>
  <div id="tableContainer">
    <table border="1px" class="table table-striped table-bordered row-border order-column display" id="example" style="font-size: 12px;">

      <thead>
        <tr>
          <th style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2>NO</th>
          <th style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2><?php if ($kategori_line == 'before_input_sewing') {
                                                                                                    echo 'PLAN LINE';
                                                                                                  } else {
                                                                                                    echo 'LINE';
                                                                                                  } ?></th>
          <th style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2>COSTOMER</th>
          <th style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2>NO PO</th>
          <th style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2>ORC</th>
          <th style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2>STYLE</th>
          <th style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2>COLOR</th>
          <th style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2>SIZE</th>
          <th style="text-align: center; background: #254681; vertical-align: middle; color: white;" colspan=4>QTY</th>
        </tr>
        <tr>
          <th style="text-align: center; background: #254681; color: white;">ORDER</th>
          <th style="text-align: center; background: #254681; color: white;">DAILY</th>
          <th style="text-align: center; background: #254681; color: white;">TOTAL</th>
          <th style="text-align: center; background: #254681; color: white;">BALANCE</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $subtotal_qty = 0;
        $total_daily = 0;
        $total_qty_order = 0;
        $total_output = 0;
        $total_balance = 0;

        if ($kategori_line == 'after_input_sewing') {
          $sql = tampilkan_laporan_bundle_record_detail_size($table, $tgl, $orc, $style, $status, $costomer, $category, $jalan_line, $plan_line, $no_po, $color, $checkstyle);
        } else {
          $sql = tampilkan_laporan_bundle_record_detail_size_before_qc($table, $tgl, $orc, $style, $status, $costomer, $category, $plan_line, $no_po, $color, $checkstyle);
        }


        while ($row = mysqli_fetch_assoc($sql)) {
        ?>
          <tr>
            <td align="center"><?= $no ?></td>
            <td align="center"><?php if ($kategori_line == 'before_input_sewing') {
                                  echo  strtoupper($row['plan_line']);
                                } else {
                                  echo strtoupper($row['line']);
                                } ?></td>
            <td align="center"><?= $row['costomer'] ?></td>
            <td align="center"><?= $row['no_po'] ?></td>
            <td align="center"><?= $row['orc'] ?></td>
            <td align="center"><?= $row['style'] ?></td>
            <td align="center"><?= $row['color'] ?></td>
            <td align="center"><?= $row['size'] . $row['cup'] ?></td>
            <td align="center"><?= $row['qty_order'] ?></td>
            <td align="center"><?= $row['daily'] ?></td>
            <td align="center"><?= $row['output_total'] ?></td>
            <td align="center"><?= $row['balance_order'] ?></td>
          </tr>

        <?php
          $total_qty_order += $row['qty_order'];
          $total_daily += $row['daily'];
          $total_output += $row['output_total'];
          $total_balance += $row['balance_order'];

          $no++;
        } ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="8" style="background: #254681; color: white"><b>TOTAL:</b></td>
          <td align="center" style="background: #254681; color: white"><b>
              <center><?= $total_qty_order; ?>
            </b></center>
          </td>
          <td align="center" style="background: #254681; color: white">
            <center><b><?= $total_daily; ?></b></center>
          </td>
          <td align="center" style="background: #254681; color: white">
            <center><b><?= $total_output; ?></b></center>
          </td>
          <td align="center" style="background: #254681; color: white">
            <center><b><?= $total_balance; ?></b></center>
          </td>

        </tr>
      </tfoot>
    </table>
  </div>
</div>

<!-- <script type="text/javascript">
    $(document).ready(function() {
    $('#example').dataTable( {
      rowReorder: true,
      paging: false,
      fixedHeader: {
            header: true,
            footer: true
        }
    } );
} );
</script> -->

<script>
  var table = $('#example').DataTable({
    // fixedHeader: true, 
    // rowReorder: true,
    paging: false,
    deferRender: true,
    scrollY: 490,
    scrollCollapse: true,
    scroller: true,
    searching: false,
    // fixedHeader: {
    //     header: false,
    //     footer: true
    // }
  });

  // $('#enable').on( 'click', function () {
  //     table.fixedHeader.enable();
  // } );

  // $('#disable').on( 'click', function () {
  //     table.fixedHeader.disable();
  // } );
  $('#btnExportToExcel').click(function(e) {
    // let fileName = '<//?= $data4['no_invoice'] ?>';
    let file = new Blob([$('#tableContainer').html()], {
      type: "application/vnd.ms-excel"
    });
    let url = URL.createObjectURL(file);
    let a = $("<a />", {
      href: url,
      download: "hasil_scan_size_detail" + ".xls"
    }).appendTo("body").get(0).click();
    e.preventDefault();
  });
</script>