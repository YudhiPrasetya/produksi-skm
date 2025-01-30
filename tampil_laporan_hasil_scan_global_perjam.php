<?php
require_once 'core/init.php';

  $proses = $_GET['trx'];
  $layar = $_GET['layar'];
  if($layar == 'laptop'){
    $tgl = $_GET['tgl'];
  }else{
    $tgl = date("Y-m-d");
  }
  
  $orc = $_GET['orc'];
  $style = $_GET['style'];
  $status = $_GET['status'];
  $costomer = $_GET['costomer'];
  $category = $_GET['category'];
  $line = $_GET['line'];
    
    if($line == 'all'){
        $line = '';
    }


  $temp_sewing = mencari_data_master_transaksi('sewing');
  $datasewing = mysqli_fetch_array($temp_sewing);
  $urutansewing = $datasewing['urutan']; 

  $temp1 = mencari_data_master_transaksi($proses);
  $datatransaksi = mysqli_fetch_array($temp1);
  $table = $datatransaksi['table_transaksi'];
  $urutan = $datatransaksi['urutan'];

  if($urutan < $urutansewing){
    $kategori_line = 'before_input_sewing';
  }else{
    $kategori_line = 'after_input_sewing';
  }

  if($kategori_line == 'before_input_sewing'){
    $plan_line = $line;
    $jalan_line = '';
  }else{
    $plan_line ='';
    $jalan_line = $line;
  }
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


<div style="margin-left: 20px; margin-right: 20px; margin-bottom: 20px;">
      <button class="btn btn-info" style="background: #254681" id="btnExportToExcel">Export To Excel</button>
</div>

<div id="tableContainer">
<div style="margin: 20px">
  <table border="1px"  class="table table-striped table-bordered row-border order-column display" id="example" style="font-size: 12px;">
  
  <thead>
      <tr>
      <th  style="text-align: center; background: #1E90FF; color: white " rowspan=2>NO</th>
      <th  style="text-align: center; background: #1E90FF; color: white " rowspan=2>ORC</th>
      <th  style="text-align: center; background: #1E90FF; color: white " rowspan=2>STYLE</th>
      <th  style="text-align: center; background: #1E90FF; color: white " rowspan=2>COLOR</th>
      <th  style="text-align: center; background: #1E90FF; color: white " rowspan=2><?php if($kategori_line == 'before_input_sewing'){ echo 'PLAN LINE'; }else{ echo 'LINE'; } ?></th>
      <th  style="text-align: center; background: #1E90FF; color: white " rowspan=2>COSTOMER</th>
      <th  style="text-align: center; background: #1E90FF; color: white " rowspan=2>NO PO</th>
      <th  style="text-align: center; background: #1E90FF; color: white " colspan=16>QTY OUTPUT PERJAM</th>
      <th  style="text-align: center; background: #1E90FF; color: white " colspan=4>QTY</th>
    </tr>
    <tr>
    <!-- <th style="text-align: center; background: #1E90FF; color: white">ORDER</th> -->
    <th style="text-align: center; background: #1E90FF; color: white">JAM 8</th>
    <th style="text-align: center; background: #1E90FF; color: white">JAM 9</th>
    <th style="text-align: center; background: #1E90FF; color: white">JAM 10</th>
    <th style="text-align: center; background: #1E90FF; color: white">JAM 11</th>
    <th style="text-align: center; background: #1E90FF; color: white">JAM 12</th>
    <th style="text-align: center; background: #1E90FF; color: white">JAM 13</th>
    <th style="text-align: center; background: #1E90FF; color: white">JAM 14</th>
    <th style="text-align: center; background: #1E90FF; color: white">JAM 15</th>
    <th style="text-align: center; background: #1E90FF; color: white">JAM 16</th>
    <th style="text-align: center; background: #1E90FF; color: white">JAM 17</th>
    <th style="text-align: center; background: #1E90FF; color: white">JAM 18</th>
    <th style="text-align: center; background: #1E90FF; color: white">JAM 19</th>
    <th style="text-align: center; background: #1E90FF; color: white">JAM 20</th>
    <th style="text-align: center; background: #1E90FF; color: white">JAM 21</th>
    <th style="text-align: center; background: #1E90FF; color: white">JAM 22</th>
    <th style="text-align: center; background: #1E90FF; color: white">JAM 23</th>
    <th style="text-align: center; background: #1E90FF; color: white">DAILY</th>
    <th style="text-align: center; background: #1E90FF; color: white">ORDER</th>
    <th style="text-align: center; background: #1E90FF; color: white">TOTAL</th>
    <th style="text-align: center; background: #1E90FF; color: white">BALANCE</th>
    
  </tr>
</thead>
<tbody>
<?php
$no=1;
$subtotal_qty=0;
$total_daily= 0;
$total_qty_order = 0;
$total_output = 0;
$total_jam_8 = 0;
$total_jam_9 = 0;
$total_jam_10 = 0;
$total_jam_11 = 0;
$total_jam_12= 0;
$total_jam_13 = 0;
$total_jam_14 = 0;
$total_jam_15 = 0;
$total_jam_16 = 0;
$total_jam_17 = 0;
$total_jam_18 = 0;
$total_jam_19 = 0;
$total_jam_20 = 0;
$total_jam_21 = 0;
$total_jam_22 = 0;
$total_jam_23 = 0;
$total_balance = 0;
$sql = tampilkan_laporan_bundle_record_perjam($table, $tgl, $orc, $style, $status, $costomer, $category, $plan_line, $jalan_line);
while($row=mysqli_fetch_assoc($sql))
{ 
    ?>
    <tr>
        <td align="center"><?= $no ?></td>
        <td align="center"><?= $row['orc'] ?></td>
        <td align="center"><?= $row['style'] ?></td>
        <td align="center"><?= $row['color'] ?></td>
        <td align="center"><?php if($kategori_line == 'before_input_sewing'){ echo  strtoupper($row['plan_line']); }else{ echo strtoupper($row['line']); } ?></td>    
        <td align="center"><?= $row['costomer'] ?></td>
        <td align="center"><?= $row['no_po'] ?></td>
        <td align="center" ><?= $row['jam_8'] ?></td>
        <td align="center" ><?= $row['jam_9'] ?></td>
        <td align="center" ><?= $row['jam_10'] ?></td>
        <td align="center" ><?= $row['jam_11'] ?></td>
        <td align="center" ><?= $row['jam_12'] ?></td>
        <td align="center" ><?= $row['jam_13'] ?></td>
        <td align="center" ><?= $row['jam_14'] ?></td>
        <td align="center" ><?= $row['jam_15'] ?></td>
        <td align="center" ><?= $row['jam_16'] ?></td>
        <td align="center" ><?= $row['jam_17'] ?></td>
        <td align="center" ><?= $row['jam_18'] ?></td>
        <td align="center" ><?= $row['jam_19'] ?></td>
        <td align="center" ><?= $row['jam_20'] ?></td>
        <td align="center" ><?= $row['jam_21'] ?></td>
        <td align="center" ><?= $row['jam_22'] ?></td>
        <td align="center" ><?= $row['jam_23'] ?></td>
        <td align="center" ><b><?= $row['daily'] ?></b></td>
        <td align="center"><b><?= $row['qty_order'] ?></b></td>
        <td align="center"><b><?= $row['output_total'] ?></b></td>
        <td align="center"><b><?= $row['balance_order'] ?></b></td>
    </tr>

<?php
    $total_qty_order += $row['qty_order'];
    $total_daily += $row['daily'];
    $total_output += $row['output_total'];
    $total_balance += $row['balance_order'];
    $total_jam_8 += $row['jam_8'];
    $total_jam_9 += $row['jam_9'];
    $total_jam_10 += $row['jam_10'];
    $total_jam_11 += $row['jam_11'];
    $total_jam_12 += $row['jam_12'];
    $total_jam_13 += $row['jam_13'];
    $total_jam_14 += $row['jam_14'];
    $total_jam_15 += $row['jam_15'];
    $total_jam_16 += $row['jam_16'];
    $total_jam_17 += $row['jam_17'];
    $total_jam_18 += $row['jam_18'];
    $total_jam_19 += $row['jam_19'];
    $total_jam_20 += $row['jam_20'];
    $total_jam_21 += $row['jam_21'];
    $total_jam_22 += $row['jam_22'];
    $total_jam_23 += $row['jam_23'];
$no++;
 } ?>
</tbody>
 <tfoot>
    <tr>
        <td align="right" colspan="7" style="background: #1E90FF; color: white"><b>TOTAL:</b></td>
        
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_8; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_9; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_10; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_11; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_12; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_13; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_14; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_15; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_16; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_17; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_18; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_19; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_20; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_21; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_22; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_jam_23; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_daily; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_qty_order; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_output; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_balance; ?></b></center></td>
    </tr>
</tfoot>
</table>
</div>
</div>


<?php if($layar == 'laptop'){ ?>
<script>
  var table = $('#example').DataTable( {

        paging: false,
        deferRender:    true,
        scrollY:        490,
        scrollCollapse: true,
        scroller:       true,
        searching: false,
        scrollX:        true,
        fixedColumns:   {
            left: 5,
            right: 4
        }        
    } );
 
</script>
<?php }else{ ?>
<script>
  var table = $('#example').DataTable({
        paging: false,
        deferRender:    true,
        scrollY:        600,
        scrollCollapse: true,
        scroller:       true,
        searching: false,
       
    }
  );
 
</script>
<?php } ?>

<script>
    $('#btnExportToExcel').click(function(e) {
    let fileName = $('#proses').val();
    let file = new Blob([$('#tableContainer').html()], {
        type: "application/vnd.ms-excel"
    });
    let url = URL.createObjectURL(file);
    let a = $("<a />", {
        href: url,
        download: fileName + ".xls"
    }).appendTo("body").get(0).click();
    e.preventDefault();
  });  
</script>  