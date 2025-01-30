<?php
  require_once 'core/init.php';
  require_once 'view/header.php';
  if( !isset($_SESSION['username']) ){
    echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
    // header('Location: index.php');    
  }

  if(cek_status($_SESSION['username'] ) == 'admin' OR 
  cek_status($_SESSION['username'] ) == 'ppic') {
?>
<br>
<?php
  if(isset($_POST['tambah'])){
    $style = $_POST['style'];
    $description = $_POST['description'];
    $item = $_POST['item'];
    $costomer = $_POST['costomer'];
    $username = $_SESSION['username'];

      if(!empty(trim($style)) && !empty(trim($description)) && !empty(trim($item))  && !empty(trim($costomer))){
      //memasukkan ke database
        if(cek_style($style) == 0){
          if(tambah_data_style($style, $description, $item, $costomer, $username)){
            $_SESSION['pesan'] = 'Berhasil Menyimpan Style';
          }else{
            $_SESSION['pesan'] = 'gagal';
          }
        }else{
          $_SESSION['pesan'] = 'Style sudah Ada';
        }
      }else{
        $_SESSION['pesan'] = 'Data tidak boleh ada yang kosong';
      }
    }
?>

<?php
  if(isset($_POST['update'])){
    $id   = $_POST['id_style'];
    $style   = $_POST['style'];
    $description   = $_POST['description'];
    $item = $_POST['item'];
    $costomer = $_POST['costomer'];
    $username = $_SESSION['username'];

    if(!empty(trim($style))){
      if(edit_data_style($style, $id, $description, $item, $costomer, $username)){
        $_SESSION['pesan'] = 'Data Berhasil di Edit';
      }else{
        $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
      }
    }else{
      $_SESSION['pesan'] = 'Ada data yang masih kosong, wajib di isi semua';
    }
  }
 ?>

<!-- <div style="margin-left: 20px; margin-right: 20px"> -->
</div>




<div class="col-sm-12">
<center><h2>MASTER STYLE </h2>


<button class="btn btn-success" type="button" data-target="#tambah" data-toggle="modal" title="Tambah Data Siswa">
<i class="glyphicon glyphicon-plus"></i><b>&nbsp; TAMBAH STYLE</b></button>

</center>
<div style="height:55px;">
                 <?php
                    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                    echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
                    }
                    $_SESSION['pesan'] = '';
                ?>
            </div>
<br>




<!-- <div class="container"> -->

<table border="1px" class="table table-striped table-bordered data" style="font-size: 12px">
  <thead>
  <tr>
    <th class="tengah theader">No</th>
    <th class="tengah theader">STYLE</th>
    <th class="tengah theader">Description</th>
    <th class="tengah theader">Item</th>
    <th class="tengah theader">Costomer</th>
    <th class="tengah theader">Action</th>
  </tr>
</thead>
<tbody>
<?php
$no=1;
$style = tampilkan_master_style_costomer();
while($row=mysqli_fetch_assoc($style))
{

// $subtotal_qty += $row['qty'];
   ?>
  <tr>

  <td class="tengah"><?= $no; ?></td>
  <td class="tengah"><?= $row['style']; ?></td>
  <td class="tengah"><?= $row['description']; ?></td>
  <td class="tengah"><?= $row['item']; ?></td>
  <td class="tengah"><?= $row['costomer']; ?></td>
  <td class="tengah">
    <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" style="width: 30px; padding: 0; margin: 0" class="btn btn-success edit_komentar kecil" data-id="<?= $row['id_style']; ?>"><i class="glyphicon glyphicon-edit"></i></button>
    <button type="button"  class="color btn btn-warning edit_komentar kecil" style="width: 30px; padding: 0; margin: 0" data-id="<?= $row['id_style']; ?>" data-style="<?= $row['style']; ?>"><i class="glyphicon glyphicon-tint"></i></button>
    <!-- <a href="print_barcode_style.php?id=<?= $row['id_style']; ?>"><button type="button" class="btn btn-xs btn-warning kecil"><i class="glyphicon glyphicon-print"></i></button></a> -->
    <a href="hapus_style_satu.php?id=<?= $row['id_style']; ?>"><button style="width: 30px; padding: 0; margin: 0" type="button" class="btn btn-xs btn-danger kecil"><i class="glyphicon glyphicon-trash"></i></button></a>

  </td>
  </tr>

  <?php
    $no++;
    }
  ?>
</tbody>

</table>
</div>

<!-- </div>
penting jangan di hapus
<div class="col-sm-3" style="margin-top: 80px" id="tampil_tabel">
</div> -->

         
<!-- Modal Tambah -->
<div id="tambah" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>Tambah Data Style </b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <form name="modal_popup"  enctype="multipart/form-data" method="post">
          
        <div class="form-group">
    <label>STYLE BARU</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
        <input type="text" class="form-control" placeholder="STYLE BARU" name="style" id="style_baru" required>
      </div>
    </div>

    <div class="form-group">
      <label for="item">ITEM</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-edit"></i>
        </div>
            <select id="item" class="form-control" name="item" required>
              <option value="">- Pilih Item -</option>
                <?php
                $item = tampilkan_item();
                while($pilih = mysqli_fetch_assoc($item)){
                echo '<option value='.$pilih['item'].'>'.$pilih['item'].'</option>';

                }
                ?>
          </select>
      </div>
    </div>

    <div class="form-group">
    <label>Description</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
        <input type="text" class="form-control" placeholder="DESCRIPTION" name="description" id="description" required>
      </div>
    </div>


    <div class="form-group">
      <label for="id_costomer">COSTOMER</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-edit"></i>
        </div>
        <select id="costomer" class="form-control ganti" name="costomer" required>
          <option value="">- Pilih Costomer -</option>
            <?php
            $costomer = tampilkan_master_costomer();
            while($pilih = mysqli_fetch_assoc($costomer)){
            echo '<option value='.$pilih['id_costomer'].'>'.$pilih['costomer'].'</option>';

            }
            ?>
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
            <h4 class="modal-title"><font face="Calibri" color="red"><b>Edit Data Master Style</b></font></h4>
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
			url	 : 'edit_style.php',
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
    var id_style = $(this).data('id');
    var style = $(this).data('style');
    
    url = "master-style-color.php?id="+id_style;

    $('#tampil_tabel').load(url);
    
  });
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
