<?php
require_once 'core/init.php';

  $proses = $_GET['trx'];
  $tgl = date("Y-m-d");
  
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
<div style="margin: 20px">
  <table border="1px"  class="table table-striped table-bordered row-border order-column display" id="example" style="font-size: 12px;">
  
  <thead>
      <tr>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>NO</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2><?php if($kategori_line == 'before_input_sewing'){ echo 'PLAN LINE'; }else{ echo 'LINE'; } ?></th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>COSTOMER</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>NO PO</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>ORC</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>STYLE</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>COLOR</th>
      <th  style="text-align: center; background: #1E90FF" colspan=4>QTY</th>

    </tr>
    <tr>
    <th style="text-align: center; background: #1E90FF">ORDER</th>
    <th style="text-align: center; background: #1E90FF">DAILY</th>
    <th style="text-align: center; background: #1E90FF">TOTAL</th>
    <th style="text-align: center; background: #1E90FF">BALANCE</th>
   
  </tr>
</thead>
<tbody>
<?php
$no=1;
$subtotal_qty=0;
$total_daily= 0;
$total_qty_order = 0;
$total_output = 0;
$total_balance = 0;
$sql = tampilkan_laporan_bundle_record_tv($table, $tgl, $orc, $style, $status, $costomer, $category, $plan_line, $jalan_line, $lantai);
while($row=mysqli_fetch_assoc($sql))
{ 
    ?>
    <tr>
        <td align="center"><?= $no ?></td>
        <td align="center"><?php if($kategori_line == 'before_input_sewing'){ echo  strtoupper($row['plan_line']); }else{ echo strtoupper($row['line']); } ?></td>
        <td align="center"><?= $row['costomer'] ?></td>
        <td align="center"><?= $row['no_po'] ?></td>
        <td align="center"><?= $row['orc'] ?></td>
        <td align="center"><?= $row['style'] ?></td>
        <td align="center"><?= $row['color'] ?></td>
        <td align="center"><?= $row['qty_order'] ?></td>
        <td align="center" ><?= $row['daily'] ?></td>
        <td align="center"><?= $row['output_total'] ?></td>
        <td align="center"><?= $row['balance_order'] ?></td>
        <
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
        <td align="right" colspan="7" style="background: #1E90FF; color: white"><b>TOTAL:</b></td>
        <td align="center"  style="background: #1E90FF; color: white"><b><center><?= $total_qty_order; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_daily; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_output; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_balance; ?></b></center></td>
       
    </tr>
</tfoot>
</table>
</div>




<script>
  var table = $('#example').DataTable( {

        paging: false,
        deferRender:    true,
        scrollY:        600,
        scrollCollapse: true,
        scroller:       true,
        searching: false,
       
    } );
 
</script>

