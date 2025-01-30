<?php
require_once 'core/init.php';


  $tgl = date("Y-m-d");
  
  $costomer = $_GET['costomer'];
  $category = $_GET['category'];
  $lantai = $_GET['lantai'];
 
  

?>

<div style="margin: 20px">
  <table border="1px"  class="table table-striped table-bordered row-border order-column display" id="example" style="font-size: 14px;">
  
  <thead>
      <tr>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>NO</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>LINE</th>
      <!-- <th  style="text-align: center; background: #1E90FF" rowspan=2>COSTOMER</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>NO PO</th> -->
      <th  style="text-align: center; background: #1E90FF" rowspan=2>ORC</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>STYLE</th> 
      <th  style="text-align: center; background: #1E90FF" rowspan=2>COLOR</th>
      <th  style="text-align: center; background: #1E90FF" colspan=6>QTY SEWING PRODUCTION</th>
    </tr>
    <tr>
    <th style="text-align: center; background: #1E90FF">ORDER</th>
    <th style="text-align: center; background: #1E90FF">DAILY</th>
    <th style="text-align: center; background: #1E90FF">IN</th>
    <th style="text-align: center; background: #1E90FF">OUT</th>
    <th style="text-align: center; background: #1E90FF">STOCK</th>
    <th style="text-align: center; background: #1E90FF">BAL ORDER</th>
  </tr>
</thead>
<tbody>
<?php
$no=1;
$subtotal_qty=0;
$total_daily= 0;
$total_sewing_in= 0;
$total_qty_order = 0;
$total_sewing_out = 0;
$total_outstanding = 0;
$total_balance = 0;
$sql = tampilkan_laporan_bundle_record_tv_sewing($tgl, $costomer, $category, $lantai);
while($row=mysqli_fetch_assoc($sql))
{ 
    ?>
    <tr>
        <td align="center"><?= $no ?></td>
        <td align="center"><?= strtoupper($row['line']); ?></td>
        <!-- <td align="center"><?= $row['costomer'] ?></td>
        <td align="center"><?= $row['no_po'] ?></td> -->
        <td align="center"><?= $row['orc'] ?></td>
        <td align="center"><?= $row['style'] ?></td>
        <td align="center"><?= $row['color'] ?></td>
        <td align="center" <?php if($row['total_sewing_in'] == $row['qty_order']){ ?> style="background: #82F903" <?php } ?>><?= $row['qty_order'] ?></td>
        <td align="center" <?php if($row['total_sewing_out'] == $row['qty_order']){ ?> style="background: #82F903" <?php } ?>><?= $row['daily_output'] ?></td>
        <td align="center" <?php if($row['total_sewing_in'] == $row['qty_order']){ ?> style="background: #82F903" <?php } ?> ><?= $row['total_sewing_in'] ?></td>
        <td align="center" <?php if($row['total_sewing_out'] == $row['qty_order']){ ?> style="background: #82F903" <?php } ?>><?= $row['total_sewing_out'] ?></td>
        <td align="center" <?php if($row['total_sewing_out'] == $row['qty_order']){ ?> style="background: #82F903" <?php } ?>><?= $row['outstanding'] ?></td>
        <td align="center" <?php if($row['total_sewing_out'] == $row['qty_order']){ ?> style="background: #82F903" <?php } ?>><?= $row['balance_order'] ?></td>
      
    </tr>

<?php
    $total_qty_order += $row['qty_order'];
    $total_daily += $row['daily_output'];
    $total_sewing_in += $row['total_sewing_in'];
    $total_sewing_out += $row['total_sewing_out'];
    $total_outstanding += $row['outstanding'];
    $total_balance += $row['balance_order'];

$no++;
 } ?>
</tbody>
 <tfoot>
    <tr>
        <td align="right" colspan="5" style="background: #1E90FF; color: white"><b>TOTAL:</b></td>
        <td align="center"  style="background: #1E90FF; color: white"><b><center><?= $total_qty_order; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_daily; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_sewing_in; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_sewing_out; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_outstanding; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_balance; ?></b></center></td>
    </tr>
</tfoot>
</table>
</div>




<script>
  var table = $('#example').DataTable( {

        paging: false,
        deferRender:    true,
        scrollY:        650,
        scrollCollapse: true,
        scroller:       true,
        searching: false,
       
    } );
 
</script>

