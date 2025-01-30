<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
        $id_bom_detail_part = @$_POST['rowedit'];
        $id_order = $_POST['order'];
        $tanggal = $_POST['tanggal'];

        $total_order = 0;
        $total_day = 0;
        $total_qty = 0;
        $total_bal = 0;
        $total_day_rej = 0;
        $total_rej = 0; 
        $total_ok = 0;
        

          $sql = tampilkan_laporan_transaksi_part_cutting_detail($id_bom_detail_part, $id_order); // memilih entri nim pada database
		      $data = mysqli_fetch_array($sql);

          $sql4 = cek_ketersediaan_cup_order($id_order);
          $data4 = mysqli_fetch_array($sql4);
       


?>
<b><font color="blue"><?= "ORC : ".$data['orc']." - | - STYLE : ".$data['style']." - | - COLOR : ".$data['color']." - | - PO BUYER : ".$data['no_po']." - | - ( ITEM : ".$data['item']." )"; ?>
<hr></font>
<?= "MATERIAL : ".$data['material']; ?>
<hr>
<font color="red"><?= "NAMA PART : ".$data['part']; ?></font></b>

<br><br>           
<table border="1px" class="table table-striped table-bordered display" id="example2" style="font-size: 13px; width: 100%">
  <thead>
  <tr>
    
    <th style="text-align: center; " class="theader" colspan="2">PERIODE CUTTING</th>
    <th class="theader" style="text-align: center" rowspan="2" >SIZE</th>
    <?php if($data4['cup'] != ''){ ?>
    <th class="theader" style="text-align: center" rowspan="2" >CUP</th>
    <?php } ?>
    <th class="theader" style="text-align: center" colspan="4" >QTY PRODUCTION</th>
    <th class="theader" style="text-align: center" colspan="3" >QTY REJECT</th>
    <th class="theader" style="text-align: center" >QTY</th>
  </tr>
  <tr>
    <th class="theader" style="text-align: center; width: 11%" >TGL AWAL</th>
    <th class="theader" style="text-align: center; width: 8%" >TGL AKHIR</th>
    <th class="theader" style="text-align: center; width: 10%" >ORDER</th>
    <th class="theader" style="text-align: center; width: 9%" >DAY</th>
    <th class="theader" style="text-align: center; width: 10%" >TOT</th>
    <th class="theader" style="text-align: center; width: 10%" >BAL</th>
    <th class="theader" style="text-align: center; width: 7%" >DAY</th>
    <th class="theader" style="text-align: center; width: 8%" >TOTAL</th>
    <th class="theader" style="text-align: center; width: 12%" >%</th>
    <th class="theader" style="text-align: center; width: 9%" >OK</th>

  </tr>
</thead>
<tbody>
<?php
    $temp = tampilkan_laporan_transaksi_part_cutting_detail_size($id_order, $id_bom_detail_part, $tanggal);
    while($row=mysqli_fetch_assoc($temp))
    { 
   ?>
  <tr>
  <td ><?php if($row['tgl_min_potong'] == 'blm_potong'){ echo "BLM_POTONG"; }else{ echo tgl_indonesia3($row['tgl_min_potong']); } ?></td>
  <td class="tengah"><?php if($row['tgl_max_potong'] == 'blm_potong'){ echo "BLM_POTONG"; }else{ echo tgl_indonesia3($row['tgl_max_potong']); } ?></td>
  <td class="tengah"><?= $row['size']; ?></td>
  <?php if($data4['cup'] != ''){ ?>
  <td class="tengah"><?= $row['cup']; ?></td>
  <?php } ?>
  <td class="tengah"><?= $row['qty_order']; ?></td>
  <td class="tengah"><?= $row['total_day']; ?></td>
  <td class="tengah" ><?= $row['total_qty'];  ?> </td>
  <td class="tengah"><?= $row['balance'];  ?></td>
  <td class="tengah"><?= $row['days_reject'];  ?></td>
  <td class="tengah"><?= $row['total_reject'];  ?></td>
  <td class="tengah"><?= round($row['persentase'], 2); ?> %</td>
  <td class="tengah"><?= $row['total_ok'];  ?></td>
  </tr>
<?php 
    $total_order += $row['qty_order'];
    $total_day += $row['total_day'];
    $total_qty += $row['total_qty'];
    $total_bal += $row['balance'];
    $total_day_rej += $row['days_reject'];
    $total_rej +=  $row['total_reject']; 
    $total_ok += $row['total_ok'];
}
 ?>
</tbody>
<tfoot>
  <th class="theader" colspan=3></th>
  <th class="theader" style="text-align: center"><?= $total_order ?></th>
  <th class="theader" style="text-align: center"><?= $total_day ?></th>
  <th class="theader" style="text-align: center"><?= $total_qty ?></th>
  <th class="theader" style="text-align: center"><?= $total_bal ?></th>
  <th class="theader" style="text-align: center"><?= $total_day_rej ?></th>
  <th class="theader" style="text-align: center"><?= $total_rej ?></th>
  <th class="theader"></th>
  <th class="theader" style="text-align: center"><?= $total_ok ?></th>
</tfoot>
</table>


<script type="text/javascript">
   $(document).ready(function() {
    $('#example2').DataTable( {
        paging: false,
        deferRender:    true,
        scrollCollapse: true,
        scroller:       true,
        searching: false,
    } );
} );
</script>

<?php 
} ?>
