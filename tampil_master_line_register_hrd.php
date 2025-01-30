<?php
  require_once 'core/init.php';
?>
  <link rel="stylesheet" href="view/style.css">
<br>
<?php

$id = $_GET['id'];
$tgl = date("Y-m-d");
?>

<input type="hidden" value="<?= $id ?>" id="id">
<br>
<div style="margin: 1% 10%">

<table border="1px" class="table table-striped table-bordered data">
  <thead>
    <tr>
        <th class="tengah theader">No</th>
        <th class="tengah theader">DATE REGISTER</th>
        <th class="tengah theader">JUMLAH REGISTER HRD</th>
        <th class="tengah theader">ACTION</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $no=1;
        $subtotal_qty=0;
        $temp_order = tampilkan_master_line_register_hrd($id);
        while($row=mysqli_fetch_assoc($temp_order))
        { 
    ?>
  <tr>
  <td class="tengah"><?= $no; ?></td>
  <td class="tengah"><?= tanggal_indo2($row['date_register']); ?></td>
  <td class="tengah"><?= $row['jml_register_hrd']; ?></td>
  <td class="tengah">
<?php if($row['date_register'] >= $tgl){ ?>
  <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id'] ?>" id="edit" data-toggle="modal" data-target="#myEdit" >Edit</button> | 
  <button type="submit" class="hapus_data btn btn-sm btn-danger" style="margin-top: 0" data-id="<?= $row['id'] ?>" onclick="return konfirmasi_kurangi()">Hapus</button>
<?php } ?>
</td>
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
<div id="myEdit" class="modal fade"  role="dialog">
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
			url	 : 'edit_master_line_register_hrd.php',
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
  $('.hapus_data').on('click',function(){
    swal.fire({
      title: "Anda Yakin ingin Menghapus Data ini?",
      text: "Jika Sudah yakin, tekan Yes.!",
      type: "warning",

      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Delete',
      cancelButtonText: "Cancel",
      showCancelButton: true,
      reverseButtons: false,
    }).then((result) => {
      if (result.dismiss !== 'cancel') {
    var id = $(this).attr('data-id');
    $.ajax({
      method: "POST",
      url: "proses_register_hrd_operator.php",
      data: { id:id,
      type : "delete"
       },
      success: function(data){
        var id_line = $('#id').val();
        var url = 'tampil_master_line_register_hrd.php?id=';
        urlid = url+id_line;
        swal("Data Berhasil di Hapus !", "Klik Ok untuk melanjutkan!", "success");
        $('#tampil_tabel').load(urlid);
      }
    });
}else {
      swal.close();
    }
});
  });
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable();
	});
</script>




