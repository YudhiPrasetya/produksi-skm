<?php
  require_once 'core/init.php';
?>
  <link rel="stylesheet" href="view/style.css">
<br>
<?php
$user = $_SESSION['username'];
$sql = tampilkan_jumlah_temp_order($user);
$data = mysqli_fetch_array($sql);
?>

<div style="text-align:right; margin-right: 30px"><font color="blue" size=4 >Total Qty Order : <?= $data['total_order']; ?> PCS</font></div>
<br>
<div style="margin: 1% 10%">

<table border="1px" class="table table-striped table-bordered data">
  <thead>
    <tr>
        <th class="tengah theader">No</th>
        <th class="tengah theader">BARCODE</th>
        <th class="tengah theader">SIZE</th>
        <th class="tengah theader">CUP</th>
        <th class="tengah theader">QTY ORDER</th>
        <th class="tengah theader">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $no=1;
        $subtotal_qty=0;
        $temp_order = tampilkan_temp_order_detail($user);
        while($row=mysqli_fetch_assoc($temp_order))
        { 
    ?>
  <tr>
  <td class="tengah"><?= $no; ?></td>
  <td class="tengah"><?= $row['barcode']; ?></td>
  <td class="tengah"><?= $row['size']; ?></td> 
  <td class="tengah"><?= $row['cup']; ?></td>
  <td class="tengah"><?= $row['qty_order'];  ?> </td>
  <td class="tengah"><button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_order_detail'] ?>" id="edit" data-toggle="modal" data-target="#myEdit" >Edit</button> | 
  <button type="submit" class="hapus_size btn btn-sm btn-danger" style="margin-top: 0" data-id="<?= $row['id_order_detail'] ?>" onclick="return konfirmasi_kurangi()">Hapus</button></td>
  <!-- <td class="tengah"><a href="hapus_qty_ordersize.php?id=<?= $row['id_order_detail']; ?>" onclick="return konfirmasi_kurangi()">DELETE</a></td> -->
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
            <h4 class="modal-title"><font face="Calibri" color="red"><b>Edit Qty Order</b></font></h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
           <div class="lihat-data"></div>
        </div>

    </div>
</div>
</div>
<!-- Modal Edit data kelas-->

<!-- Script ajax menampilkan Edit kelas -->
<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#myEdit', function (e) {
		var rowedit = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'edit_qtysize.php', 
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>
<!-- Script ajax menampilkan Edit kelas -->



<script type="text/javascript">
  $('.hapus_size').on('click',function(){
    var id = $(this).attr('data-id'); 
    $.ajax({
      method: "POST",
      url: "proses_temp_order.php",
      data: { id:id,
      type : "delete"
       },
      success: function(data){
        $('#tampil_tabel').load("tampil_temp_order.php");
      }
    });
  });
</script>

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


