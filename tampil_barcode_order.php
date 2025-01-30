<?php
  require_once 'core/init.php';
?>
  <link rel="stylesheet" href="view/style.css">

<?php
$user = $_SESSION['username'];
$id = $_GET['id'];
$sql = tampilkan_jumlah_order_edit($id);
$data = mysqli_fetch_array($sql);

?>

<input type="hidden" value="<?= $id ?>" id="id_order">
<div style="text-align:right"><font color="blue" size=4 >Total Qty Order : <?= $data['total_order']; ?> PCS</font></div>
<br>
<div style="margin: 1% 1%">

<table border="1px" class="table table-striped table-bordered data">
  <thead>
    <tr>
        <th class="tengah theader">No</th>
        <th class="tengah theader">BARCODE</th>
        <th class="tengah theader">SIZE</th>
        <th class="tengah theader">QTY ORDER</th>
        <th class="tengah theader">QTY BUNDLE</th>
        <th class="tengah theader">TOT QTY BUNDLE</th>
        <th class="tengah theader">FULL BOX</th>
        <th class="tengah theader">PECAHAN</th>
        <th class="tengah theader" width="20%">PRINT BARCODE</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $no=1;
        $subtotal_qty=0;
        $temp_order = tampilkan_barcode_order_id($id);
        while($row=mysqli_fetch_assoc($temp_order))
        { 
    ?>
  <tr>
  <td class="tengah"><?= $no; ?></td>
  <td class="tengah"><?= $row['barcode_number']; ?></td>
  <td class="tengah"><?= $row['size'].$row['cup']; ?></td>
  <td class="tengah"><?= $row['qty_order'];  ?> </td>
  <td class="tengah"><?= $row['qty_bundle']; ?></td>
  <td class="tengah"><?= $row['tot_qty_bundle']; ?></td>
  <td class="tengah"><?= $row['full_box']; ?></td>
  <td class="tengah"><?= $row['pecahan']; ?></td>
  <td class="tengah">
    <form action="print_barcode_size.php" method="POST"  target="_blank">
            <div class="row">
                <div class="col-md-7">
                <input type="hidden" name="barcode_number" value="<?= $row['barcode_number'] ?>">
                <input type="hidden" name="label" value="<?= $row['label'] ?>">
                <input type="hidden" name="color" value="<?= $row['color'] ?>">
                <input type="hidden" name="no_po" value="<?= $row['no_po'] ?>">
                <input type="hidden" name="style" value="<?= $row['style'] ?>">
                <input type="text" name="qtyprint" placeholder="QTY PRINT" class="form-control" style="display: inline-block; width=50%">       
               </div>
                <div class="col-md-4"  style="margin-left: -13px; margin-top: -7px">
                <button type="submit" class="btn btn-md btn-success cetak" style="display: inline-block">PRINT</button>
                </div>
            </div>
        </td>
  </form>
  </tr>

  <?php
    $no++;
    }
  ?>
</tbody>
</table>
</div>
</div>

<!-- Modal Edit Data data kelas-->
<div id="myEdit" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><font face="Calibri" color="red"><b>Print Barcode Size</b></font></h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
           <div class="lihat-data"></div>
        </div>

    </div> 
</div>
</div>
<!-- Modal Edit data kelas-->

<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable();
	});
</script>

<script type="text/javascript" language="JavaScript">
function konfirmasi_kurangi()
{
tanya3 = confirm("Yakin ingin menghapus qty order ini ?");
if (tanya3 == true) return true;
else return false;
}
</script>


