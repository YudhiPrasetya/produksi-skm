<?php
  require_once 'core/init.php';
?>
  <link rel="stylesheet" href="view/style.css">

<br>


<?php
$user = $_SESSION['username'];
$id = $_GET['id'];
$sql = tampilkan_transaksi_proses_id($id);


?>
<!-- <div style="height:55px;">
                 <?php
                    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                    echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
                    }
                    $_SESSION['pesan'] = '';
                ?>
</div> -->
<div style="margin: 1% 10%">
<table border="1px" class="table table-striped table-bordered data">
  <thead>
  <tr>
    <th class="tengah theader">No</th>
    <th class="tengah theader">Nama Transaksi</th>
    <th class="tengah theader">Urutan</th>
    <th class="tengah theader">Action</th>
  </tr>
</thead>
<tbody>
<?php
$no=1;

while($row=mysqli_fetch_assoc($sql))
{

// $subtotal_qty += $row['qty'];
   ?>
  <tr>

  <td class="tengah"><?= $no; ?></td>
  <td class="tengah"><?= $row['nama_transaksi']; ?></td>
  <td class="tengah"><?= $row['urutan']; ?></td>
  <td class="tengah">
    <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" data-id="<?= $row['id_proses']; ?>"><i class="glyphicon glyphicon-edit"></i></button>

  </td>
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
            <h4 class="modal-title"><font face="Calibri" color="red"><b>Edit Data Master Purchasing Order</b></font></h4>
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

<!-- Script ajax menampilkan Edit kelas -->
<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#myEdit', function (e) {
		var rowedit = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'edit_proses_orc_urutan.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>

<!-- <script src="style/jquery.min.js"></script>
        <script>
            $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
            setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
</script> -->
<!-- Script ajax menampilkan Edit kelas -->
