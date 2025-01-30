<?php
  require_once 'core/init.php';
  require_once 'view/header.php';

  if( !isset($_SESSION['username']) ){
    echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
    // header('Location: index.php');    
  }
  
  if(cek_status($_SESSION['username'] ) == 'admin' OR 
  cek_status($_SESSION['username'] ) == 'ppic') {
    $username = $_SESSION['username'];
?>
<br>
<?php
  if(isset($_POST['tambah'])){
    $material_code = $_POST['material_code'];
    $material_name = $_POST['material_name'];

      if(!empty(trim($material_code)) && !empty(trim($material_name))){
      //memasukkan ke database
        if(cek_material_code($material_code) == 0){
          if(tambah_data_material($material_code, $material_name, $username)){
            $_SESSION['pesan'] = 'Berhasil Menyimpan Material';
          }else{
            $_SESSION['pesan'] = 'gagal';
          }
        }else{
          $_SESSION['pesan'] = 'Material sudah Ada';
        }
      }else{
        $_SESSION['pesan'] = 'Data tidak boleh ada yang kosong';
      }
    }
?>

<?php
  if(isset($_POST['update'])){
    $id   = $_POST['id_material'];
    $material_code   = $_POST['material_code'];
    $material_name   = $_POST['material_name'];

    if(!empty(trim($material_code)) && !empty(trim($material_name))){
      if(edit_data_material($id, $material_code, $material_name, $username)){
        $_SESSION['pesan'] = 'Data Berhasil di Edit';
      }else{
        $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
      }
    }else{
      $_SESSION['pesan'] = 'Ada data yang masih kosong, wajib di isi semua';
    }
  }
 ?>
</div>




<div class="col-sm-8">
<center><h2>MASTER MATERIAL</h2>


<button class="btn btn-success" type="button" data-target="#tambah" data-toggle="modal" title="Tambah ">
<i class="glyphicon glyphicon-plus"></i><b>&nbsp; TAMBAH MATERIAL</b></button>

</center>
<div style="height:55px;">
                 <?php
                    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                    echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
                    }
                    $_SESSION['pesan'] = '';
                ?>
            </div>




<!-- <div class="container"> -->

<table border="1px" class="table table-striped table-bordered data" style="font-size: 12px">
  <thead>
  <tr>
    <th class="tengah theader" style="width: 5%">No</th>
    <th class="tengah theader" style="width: 30%">Artikel</th>
    <th class="tengah theader" style="width: 50%">Description</th>
    <th class="tengah theader" style="width: 15%">Action</th>
  </tr>
</thead>
<tbody>
<?php
$no=1;
$material = tampilkan_master_material();
while($row=mysqli_fetch_assoc($material))
{

// $subtotal_qty += $row['qty'];
   ?>
  <tr>

  <td class="tengah"><?= $no; ?></td>
  <td class="tengah"><?= $row['material_code']; ?></td>
  <td class="tengah"><?= $row['material_name']; ?></td>
  <td class="tengah">
    <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" style="width: 30px; padding: 0; margin: 0" class="btn btn-success edit_komentar kecil" data-id="<?= $row['id_material']; ?>"><i class="glyphicon glyphicon-edit"></i></button>
    <button type="button"  class="color btn btn-warning edit_komentar kecil" style="width: 30px; padding: 0; margin: 0" data-id="<?= $row['id_material']; ?>" data-code="<?= $row['material_code']; ?>" data-name="<?= $row['material_name']; ?>"><i class="glyphicon glyphicon-tint"></i></button>
    <!-- <a href="print_barcode_style.php?id=<?= $row['id_style']; ?>"><button type="button" class="btn btn-xs btn-warning kecil"><i class="glyphicon glyphicon-print"></i></button></a> -->
    <a href="hapus_material_satu.php?id=<?= $row['id_material']; ?>"><button style="width: 30px; padding: 0; margin: 0" type="button" class="btn btn-xs btn-danger kecil" onclick="return konfirmasi()"><i class="glyphicon glyphicon-trash"></i></button></a>

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

<div class="col-sm-3" style="margin-top: 0px" id="tampil_tabel">
</div>

         
<!-- Modal Tambah -->
<div id="tambah" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>Tambah Data Material </b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <form name="modal_popup"  enctype="multipart/form-data" method="post">
          
        <div class="form-group">
    <label for="material_code">MATERIAL CODE</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
        <input type="text" class="form-control" placeholder="MATERIAL CODE" name="material_code" id="material_code" required>
      </div>
    </div>

    <div class="form-group">
      <label for="material_name">MATERIAL NAME</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-edit"></i>
        </div>
        <input type="text" class="form-control" placeholder="MATERIAL NAME" name="material_name" id="material_name" required>
        </select>
      </div>
 </div>
              
        <div class="modal-footer">
          <input name="tambah" type="submit" value="Tambah" id="button" class="btn btn-success" />     
          </form>    
        </div>
                
      </div>
    </div>
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
            <h4 class="modal-title"><font face="Calibri" color="red"><b>Edit Data Material</b></font></h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
           <div class="lihat-data"></div>
        </div>

    </div>
</div>
</div>
<!-- Modal Edit data kelas-->

</div>
</div>

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
			url	 : 'edit_material.php',
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
  $('.color').on('click',function(){
    var id_material = $(this).data('id');

    
    url = "master-material-color.php?id="+id_material;

    $('#tampil_tabel').load(url);
    
  });
</script>



<script type="text/javascript" language="JavaScript">
function konfirmasi()
{
tanya = confirm("Anda Yakin Akan Menghapus Data ini?");
if (tanya == true) return true;
else return false;
}
</script>


<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>

</script>
<!-- <script src="style/jquery.min.js"></script> -->
        <script>
            $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
            setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
        </script>
</body>
</html>
