<?php
require_once 'core/init.php';

 

  $tgl = $_GET['tgl'];
  $today = date("Y-m-d");
  $jam     = date("H:i:s");
  
  $orc = $_GET['orc'];
  $style = $_GET['style'];
  $status = $_GET['status'];
  $costomer = $_GET['costomer'];
  $category = $_GET['category'];
  $line = $_GET['line'];
    
    if($line == 'all'){
        $line = '';
    }


  // $temp_sewing = mencari_data_master_transaksi('sewing');
  // $datasewing = mysqli_fetch_array($temp_sewing);
  // $urutansewing = $datasewing['urutan']; 

  // $temp1 = mencari_data_master_transaksi($proses);
  // $datatransaksi = mysqli_fetch_array($temp1);
  // $table = $datatransaksi['table_transaksi'];
  // $urutan = $datatransaksi['urutan'];

  // if($urutan < $urutansewing){
  //   $kategori_line = 'before_input_sewing';
  // }else{
  //   $kategori_line = 'after_input_sewing';
  // }

  // if($kategori_line == 'before_input_sewing'){
  //   $plan_line = $line;
  //   $jalan_line = '';
  // }else{
  //   $plan_line ='';
  //   $jalan_line = $line;
  // }
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
  <button type="button" class="btn btn-success" id="btnExportToExcel">Export To Excel</button>
  <div id="tableContainer">
  <table border="1px"  class="table table-striped table-bordered row-border order-column display" id="example" style="font-size: 12px;">
  
  <thead>
      <tr>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>NO</th>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>ORC</th>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>STYLE</th>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>COLOR</th>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>LINE</th>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>MAN POWER</th>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>TARGET PERJAM COMMIT</th>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>SMV</th>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>% TARGET COMMIT</th>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>TARGET 100%</th>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>TARGET 80%</th>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2><i class="glyphicon glyphicon-time">_JK NORMAL</th>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>ITEM</th>
      <th  style="text-align: center; background:#254681; color: white " rowspan=2>COSTOMER</th>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>NO PO</th>
      <th  style="text-align: center; background: #254681; color: white " colspan=16>QTY OUTPUT PERJAM</th>
      <th  style="text-align: center; background: #254681; color: white " colspan=3>LEMBUR</th>
      <th  style="text-align: center; background: #254681; color: white " colspan=4>TOTAL AFTER LEMBUR JIKA ADA</th>
      
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>REMAKS</th>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>ACTION</th>
      <th  style="text-align: center; background: #254681; color: white " rowspan=2>TARGET TODAY COMMIT</th>
      <th style="text-align: center; background: #254681; color: white" rowspan=2>DAILY / LINE</th>
    <th style="text-align: center; background: #254681; color: white" rowspan=2>TOTAL / LINE</th>
    <th style="text-align: center; background: #254681; color: white" rowspan=2>BALANCE ALL</th>
    </tr>
    <tr>

    <th style="text-align: center; background: #254681; color: white">JAM 8</th>
    <th style="text-align: center; background: #254681; color: white">JAM 9</th>
    <th style="text-align: center; background: #254681; color: white">JAM 10</th>
    <th style="text-align: center; background: #254681; color: white">JAM 11</th>
    <th style="text-align: center; background: #254681; color: white">JAM 12</th>
    <th style="text-align: center; background: #254681; color: white">JAM 13</th>
    <th style="text-align: center; background: #254681; color: white">JAM 14</th>
    <th style="text-align: center; background: #254681; color: white">JAM 15</th>
    <th style="text-align: center; background: #254681; color: white">JAM 16</th>
    <th style="text-align: center; background: #254681; color: white">JAM 17</th>
    <th style="text-align: center; background: #254681; color: white">JAM 18</th>
    <th style="text-align: center; background: #254681; color: white">JAM 19</th>
    <th style="text-align: center; background: #254681; color: white">JAM 20</th>
    <th style="text-align: center; background: #254681; color: white">JAM 21</th>
    <th style="text-align: center; background: #254681; color: white">JAM 22</th>
    <th style="text-align: center; background: #254681; color: white">JAM 23</th>
    <!-- <th style="text-align: center; background: #1E90FF; color: white"><i class="glyphicon glyphicon-time">_JK</th> -->
    <!-- <th style="text-align: center; background: #1E90FF; color: white">SAH</th>
    <th style="text-align: center; background: #1E90FF; color: white">MAH</th> -->
    <th style="text-align: center; background: #1E90FF; color: white"><i class="glyphicon glyphicon-user">_MP</th>
    <th style="text-align: center; background: #1E90FF; color: white"><i class="glyphicon glyphicon-time">_JL</th>
    <th style="text-align: center; background: #1E90FF; color: white">TARGET LEMBUR</th>
    <th style="text-align: center; background: #1E90FF; color: white">TARGET TOTAL</th>
    <th style="text-align: center; background: #1E90FF; color: white">SAH</th>
    <th style="text-align: center; background: #1E90FF; color: white">MAH</th>
    <th style="text-align: center; background: #1E90FF; color: white">EFFICIENCY</th>
    <!-- <th style="text-align: center; background: #1E90FF; color: white">TODAY</th> -->

    
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
$sql = tampilkan_laporan_bundle_record_perjam_qc_endline($tgl, $orc, $style, $status, $costomer, $category, $line);
while($row=mysqli_fetch_assoc($sql))
{ 
    ?>
    <tr>
        <td align="center"><?= $no ?></td>
        <td align="center"><?= $row['orc'] ?></td>
        <td align="center"><?= $row['style'] ?></td>
        <td align="center"><?= $row['color'] ?></td>
        <td align="center"><?php
          echo strtoupper($row['line_target']); 
        ?></td>
        <td align="center"><?= $row['man_power'] ?></td>  
        <td align="center" style="background-color: #82F903"><b><?= $row['target_jam'] ?></b></td>  
        <td align="center" style="background-color: #82F903"><b><?= $row['nilai_smv'] ?></b></td>
        <td align="center" style="background-color: #82F903"><?= $row['persentase'] ?> %</td>
        <td align="center"><?= $row['target_100'] ?></td>
        <td align="center"><?= $row['target_80'] ?></td>
        <td align="center"><b><?= $row['jml_jam_normal'] ?></b></td>
        <td align="center"><?= $row['item'] ?></td>  
        <td align="center"><?= $row['costomer'] ?></td>
        <td align="center"><?= $row['no_po'] ?></td>  
        <td align="center" 
        <?php
        if($tgl == $today){
          if($jam >= '08:05:00'){
            if(($row['jam_8'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_8'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_8'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_8'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?>><?= $row['jam_8'] ?></td>
        <td align="center" <?php
        if($tgl == $today){
          if($jam >= '09:05:00'){
            if(($row['jam_9'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_9'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_9'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_9'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?> ><?= $row['jam_9'] ?></td>
        <td align="center" <?php
        if($tgl == $today){
          if($jam >= '10:05:00'){
            if(($row['jam_10'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_10'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_10'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_10'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?>><?= $row['jam_10'] ?></td>
        <td align="center" <?php
        if($tgl == $today){
          if($jam >= '11:05:00'){
            if(($row['jam_11'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_11'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_11'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_11'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?>><?= $row['jam_11'] ?></td>
        <td align="center" <?php
        if($tgl == $today){
          if($jam >= '12:05:00'){
            if(($row['jam_12'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_12'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_12'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_12'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?>><?= $row['jam_12'] ?></td>
        <td align="center" <?php
        if($tgl == $today){
          if($jam >= '13:05:00'){
            if(($row['jam_13'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_13'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_13'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_13'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?>><?= $row['jam_13'] ?></td>
        <td align="center" <?php
        if($tgl == $today){
          if($jam >= '14:05:00'){
            if(($row['jam_14'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_14'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_14'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_14'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?>><?= $row['jam_14'] ?></td>
        <td align="center" <?php
        if($tgl == $today){
          if($jam >= '15:05:00'){
            if(($row['jam_15'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_15'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_15'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_15'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?>><?= $row['jam_15'] ?></td>
        <td align="center" <?php
        if($tgl == $today){
          if($jam >= '16:05:00'){
            if(($row['jam_16'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_16'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_16'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_16'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?>><?= $row['jam_16'] ?></td>
        <td align="center" <?php
        if($tgl == $today){
          if($jam >= '17:05:00'){
            if(($row['jam_17'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_17'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_17'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_17'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?>><?= $row['jam_17'] ?></td>
        <td align="center"  <?php
        if($tgl == $today){
          if($jam >= '18:05:00'){
            if(($row['jam_18'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_18'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_18'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_18'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?>><?= $row['jam_18'] ?></td>
        <td align="center"  <?php
        if($tgl == $today){
          if($jam >= '19:05:00'){
            if(($row['jam_19'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_19'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_19'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_19'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?>><?= $row['jam_19'] ?></td>
        <td align="center"  <?php
        if($tgl == $today){
          if($jam >= '20:05:00'){
            if(($row['jam_20'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_20'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_20'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_20'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?>><?= $row['jam_20'] ?></td>
        <td align="center"  <?php
        if($tgl == $today){
          if($jam >= '21:05:00'){
            if(($row['jam_21'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_21'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_21'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_21'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?>><?= $row['jam_21'] ?></td>
        <td align="center"  <?php
        if($tgl == $today){
          if($jam >= '22:05:00'){
            if(($row['jam_22'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_22'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_22'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_22'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?>><?= $row['jam_22'] ?></td>
        <td align="center"  <?php
        if($tgl == $today){
          if($jam >= '23:05:00'){
            if(($row['jam_23'] < $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['jam_23'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
              echo 'style="background-color: #82F903"';
            }
          }
        }else{
          if(($row['jam_23'] < $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="color: red"';
          }elseif(($row['jam_23'] >= $row['target_jam']) && ($row['target_jam'] != 0)){
            echo 'style="background-color: #82F903"';
          }
        }
         ?>><?= $row['jam_23'] ?></td>

        <!-- <td align="center"><b><?= $row['sah'] ?></b></td> -->
        <!-- <td align="center"><b><?= $row['mah'] ?></b></td> -->
        <td align="center"><b><?= $row['man_power_lembur'] ?></b></td>
        <td align="center"><b><?= $row['jml_lembur'] ?></b></td>
        <td align="center"><b><?= $row['target_days_lembur'] ?></b></td>
        <td align="center"><b><?= $row['total_target'] ?></b></td>
        <td align="center"><b><?= $row['sah'] ?></b></td>
        <td align="center"><b><?= $row['total_mah'] ?></b></td>
        <td align="center"><b><?= $row['efficiency'] ?> %</b></td>
        <td align="center"><?= $row['remaks'] ?></td>
        <td align="center"><b><button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" data-id="<?= $row['id']; ?>"><i class="glyphicon glyphicon-edit"></i></button></b></td>
        <td align="center" style="background-color: #82F903"><b><?= $row['target_days'] ?></b></td>
        <td align="center" <?php 
      
            if(($row['daily'] < $row['target_days']) && ($row['target_days'] != 0)){
              echo 'style="color: red"';
            }elseif(($row['daily'] < $row['target_days']) && ($row['target_days'] != 0)){
              echo 'style="background-color: #82F903"';
            }
           ?>><b><?= $row['daily'] ?></b></td>
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
        <td align="right" colspan="15" style="background: #1E90FF; color: white"><b>TOTAL:</b></td>
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
        <td align="center"  style="background: #1E90FF; color: white"><center><b>-</b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b>-</b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b>-</b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b>-</b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b>-</b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b>-</b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b>-</b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b>-</b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b>-</b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_daily; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b>-</b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_output; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_balance; ?></b></center></td>
    </tr>
</tfoot>
</table>
</div>
</div>



<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#myEdit', function (e) {
		var rowedit = $(e.relatedTarget).data('id');
        console.log(rowedit);
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'edit_remaks_target.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>





<script>
  var table = $('#example').DataTable( {
    // dom: 'Blfrtip',
    // buttons: ['excel'],
        paging: false,
        deferRender:    true,
        scrollY:        490,
        scrollCollapse: true,
        scroller:       true,
        searching: false,
        // scrollX:        true,
        // fixedColumns:   {
        //     left: 7,
        //     right: 4
        // },

    } );

    $('#btnExportToExcel').click(function(e) {
      // let fileName = '<//?= $data4['no_invoice'] ?>';
      let file = new Blob([$('#tableContainer').html()], {
         type: "application/vnd.ms-excel"
      });
      let url = URL.createObjectURL(file);
      let a = $("<a />", {
         href: url,
         // download: fileName + ".xls"
         download: "excelFile.xls"
      }).appendTo("body").get(0).click();
      e.preventDefault();
   });    
 
</script>
