<?php
require_once 'core/init.php'; 


  $tanggal = $_POST['tanggal'];
  $jam = $_POST['jam'];
  $target = $_POST['target'];
  $lantai = $_POST['lantai'];
  $line = $_POST['line'];
  $orc = $_POST['orc'];
  $costomer = $_POST['costomer'];
  $no_po = $_POST['no_po'];
  $style = $_POST['style'];
  $checkstyle = $_POST['checkstyle'];

    if($jam <= 8){
        // $jam_ke = 1;
        $waktu_awal = '00:00:01';
        $waktu_akhir = '08:05:00';
    }elseif($jam <= 9){
        // $jam_ke = 2;
        $waktu_awal = '08:05:01';
        $waktu_akhir = '09:05:00';
    }elseif($jam <= 10){
        // $jam_ke = 3;
        $waktu_awal = '09:05:01';
        $waktu_akhir = '10:05:00';
    }elseif($jam <= 11){
        // $jam_ke = 4;
        $waktu_awal = '10:05:01';
        $waktu_akhir = '11:05:00';
    }elseif($jam <= 12){
        // $jam_ke = 5;
        $waktu_awal = '11:05:01';
        $waktu_akhir = '12:00:00';
    }elseif($jam <= 13){
        // $jam_ke = 5;
        $waktu = '11:05:01';
        $waktu = '13:05:00';
    }elseif($jam <= 14){
        // $jam_ke = 6;
        $waktu_awal = '13:05:01';
        $waktu_akhir = '14:05:00';
    }elseif($jam <= 15){
        // $jam_ke = 7;
        $waktu_awal = '14:05:01';
        $waktu_akhir = '15:05:00';
    }

    ?>
</div>
<h4 style="text-align: right; margin-right: 20px; color: blue"><?php echo tgl_indonesia5(date("Y-m-d")); ?></h4>
<div style="margin: 10px">
<table border="1px"  class="table table-striped table-bordered row-border order-column display " id="example" style="font-size: 12px;">
  
  <thead>
      <tr>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>NO</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>COSTOMER</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>NO PO</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>ITEM</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>ORC</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>STYLE</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>COLOR</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>LINE</th>
      <th  style="text-align: center; background: #1E90FF" >JAM</th>
      <th  style="text-align: center; background: #1E90FF" >TARGET </th>

      <th  style="text-align: center; background: #1E90FF" colspan=2>TOTAL QTY S/D SAAT INi</th>

      </tr> 
      <tr>
      <th  style="text-align: center; background: #1E90FF" >NORMAL</th>
        <th  style="text-align: center; background: #1E90FF" >@ JAM</th>

 
        <th  style="text-align: center; background: #1E90FF" >OUTPUT</th>
        <th  style="text-align: center; background: #1E90FF" >BALANCE</th>
      </tr>
</thead>
<tbody>
    <?php
    $no = 0;
    $sql = tampilkan_laporan_reminder_qc_endline_all($tanggal, $waktu_awal, $waktu_akhir, $target, $lantai, $line, $costomer, $no_po, $orc, $style, $checkstyle);
    while($row=mysqli_fetch_assoc($sql))
    {
        
      
        ?>
        <tr>
            <td align="center"><?= $no ?></td>
            <td align="center"><?= $row['costomer'] ?></td>
            <td align="center"><?= $row['no_po'] ?></td>  
            <td align="center"><?= $row['item'] ?></td>  
            <td align="center"><?= $row['orc'] ?></td>
            <td align="center"><?= $row['style'] ?></td>
            <td align="center"><?= $row['color'] ?></td>
            <td align="center"><?= strtoupper($row['line']); ?></td>

            <td align="center"><b><?= $row['jml_jam_normal'] ?></b></td>
            <td align="center"><b><?= $row['target_jam'] ?></b></td>
            <td align="center"><b><?= $row['total_output'] ?></b></td>
            <td align="center" <?php if( $row['balance_target'] < 0){ echo 'style="color: red"'; }else{
                echo 'style="color: green"';
            } ?>><b><?php if($row['balance_target'] > 0){
                echo '+'.$row['balance_target'];
            }else{
                echo $row['balance_target'];
            } ?></b></td>

    <?php } ?>
</tbody>

</table>
<script type="text/javascript">
	$(document).ready(function(){
		$('#example').DataTable();
	});
</script>