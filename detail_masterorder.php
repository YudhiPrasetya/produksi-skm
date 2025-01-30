<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
        $edit = @$_POST['rowedit'];
       
        $sql = tampilkan_master_order_id($edit); // memilih entri nim pada database
		      $data = mysqli_fetch_array($sql);

      ?>  
      <center><h4>ORC : <?= $data['orc']; ?></h4></center>
      
<input type="hidden" value="<?= $data['id_order'] ?>" id="id_order"> 
<table width="100%">
    <tr> 
        <td width="5%">NO PO</td>
        <td width="1%">:</td>
        <td width="25%"><?= $data['no_po']; ?></td>
        <td width="15%"></td>
        <td width="15%">Prepare ON</td>
        <td width="1%">:</td>
        <td width="10%"><?= tgl_indonesia3($data['prepare_on']); ?></td>
       
    </tr>
    <tr>
        <td width="5%">LABEL</td>
        <td width="1%">:</td>
        <td width="25%"><?= $data['label'] ?></td>
        <td width="15%"></td>
        <td width="15%">SHIPMENT PLAN</td>
        <td width="1%">:</td>
        <td width="10%"><?= tgl_indonesia3($data['shipment_plan']); ?></td>
    </tr>
    <tr>
        <td width="5%">STYLE</td>
        <td width="1%">:</td>
        <td width="25%"><?= $data['style']; ?></td>
        <td width="15%"></td>
        <td width="15%">Total Order</td>
        <td width="1%">:</td>
        <td width="10%"><span class="total_order"><?= $data['total']; ?></span> PCS</td>
    </tr>
    <tr>
        <td width="5%">COLOR</td>
        <td width="1%">:</td>
        <td width="25%"><?= $data['color']; ?></td>
        <td width="15%"></td>
        <td width="5%">ITEM</td>
        <td width="1%">:</td>
        <td width="50%" colspan="5"><?= $data['item']; ?></td>
    </tr>

</table>  
<br>

Rincian Order : 
<table border="1px" class="table table-striped table-bordered data" id="rincian">
  <thead>
    <tr>
        <th class="tengah theader">Barcode</th>
        <th class="tengah theader">SIZE</th>
        <th class="tengah theader">CUP</th>
        <th class="tengah theader">QTY ORDER</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $no=1;
        $subtotal_qty=0;
        $temp_order = tampilkan_order_detail_id($edit);
        while($row=mysqli_fetch_assoc($temp_order))
        { 
    ?>
  <tr>
  <td class="tengah"><?= $row['barcode_number']; ?></td>
  <td class="tengah"><?= $row['size']; ?></td>
  <td class="tengah"><?= $row['cup']; ?></td>
  <td class="qty_ubah tengah" data-id="<?= $row['id_order_detail']; ?>"><?= $row['qty_order'];  ?> </td>
  </tr>

  <?php
   
    }
  ?>
</tbody>
</table>
<?php
		 } ?>


<script type="text/javascript" language="JavaScript">
function konfirmasi_kurangi()
{
tanya = confirm("Anda Yakin Akan Menghapus Data Size ini ?");
if (tanya == true) return true;
else return false;
}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable();
	});
</script>