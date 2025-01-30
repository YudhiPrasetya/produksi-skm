<?php
  require_once 'core/init.php';
  require_once 'view/header.php';

  $error='';
  if( !isset($_SESSION['username']) ){
    echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
    // header('Location: index.php');    
  }
  if(cek_status($_SESSION['username'] ) == 'admin' OR 
    cek_status($_SESSION['username'] ) == 'shipment'  OR 
    cek_status($_SESSION['username'] ) == 'report') {
  
    if( isset($_POST['tambah'])){
      $consignee = $_POST['consignee'];
      $address = $_POST['address'];
      $country = $_POST['country'];
    
      if(!empty(trim($consignee)) && !empty(trim($address)) && !empty(trim($country)) ){
        //memasukkan ke database
        if(cek_consignee($consignee) == 0){
          if(register_invoice($invoice, $inspection, $cut_off, $costomer, $shipment_by, $status, $ukuran_karton)){
            $error = 'Data Berhasil disimpan';
            // header('Location: master-user.php');
          }else{
            $error = 'gagal';
          }
        }else{
          $error = 'Invoice sudah ada';
        }
      }else{
        $error = 'Data tidak boleh ada yang kosong';
      }
    }
?>

<?php
  if(isset($_POST['update'])){
    $id   = $_POST['id_shipment'];
    $invoice = $_POST['invoice'];
    $cut_off = $_POST['cut_off'];
    $inspection = $_POST['inspection'];
    $costomer = $_POST['costomer'];
    $shipment_by = $_POST['shipment_by'];
    $status = $_POST['status'];
    $approve = $_POST['approve'];
    $ukuran_karton = $_POST['ukuran_karton'];

    if(!empty(trim($invoice))  && !empty(trim($inspection)) && !empty(trim($costomer)) && !empty(trim($shipment_by)) && !empty(trim($status)) && !empty(trim($ukuran_karton))){
      if(edit_data_invoice($id, $invoice, $inspection, $cut_off, $costomer, $shipment_by, $status, $ukuran_karton, $approve)){
      }else{
        $error = 'Ada masalah saat mengedit data';
      }
    }else{
      $error='Ada data yang masih kosong, wajib di isi semua';
    }
  }
?>

</div>
<div style = "margin-left: 20px; margin-right: 20px">
  
<center><h2>MASTER CONSIGNEE</h2>

<button class="btn btn-success" type="button" data-target="#tambah" data-toggle="modal" title="Tambah Data Siswa">
<i class="glyphicon glyphicon-plus"></i><b>&nbsp; Tambah Data</b></button>


</center>
<br><br>
<!-- <div class="container"> -->
<table border="1px" class="table table-striped table-bordered data">
  <thead>
    <tr>
      <th class="tengah theader">NO</th>
      <th class="tengah theader">CONSIGNEE</th>
      <th class="tengah theader">ADDRESS</th>
      <th class="tengah theader">COUNTRY</th>
      <th class="tengah theader">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no=1;
      $shipment = tampilkan_master_consignee();
      while($row=mysqli_fetch_assoc($shipment))
      {
    ?>
    <tr>
      <td class="tengah"><?= $no; ?></td>
      <td class="tengah"><?= strtoupper($row['consignee']); ?></td>
      <td class="tengah"><?= strtoupper($row['address']); ?></td>
      <td class="tengah"><?= strtoupper($row['country']); ?></td>
      <td class="tengah">
        <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" data-id="<?= $row['id_consignee']; ?>"><i class="glyphicon glyphicon-edit"></i></button> 
        <a href="hapus_shipment_satu.php?id=<?= $row['id_consignee']; ?>" target=”_blank”><button type="button" class="btn btn-xs btn-danger kecil"><i class="glyphicon glyphicon-trash"></i></button></a>
    
      </td>
    </tr>
  <?php
    $no++;
    }
  ?>
  </tbody>  
</table>

<div id="tampil_tabel"></div>


<!-- Modal Edit Data data kelas-->
<div id="myEdit" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>Edit Data Master Shipment</b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <div class="lihat-data"></div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit data kelas-->

<!-- Modal PACKING LIST Data data kelas-->
<div id="myPL" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>CETAK PACKINGLIST</b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <div class="lihat-data"></div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit data kelas-->
                
<!-- Modal Tambah -->
<div id="tambah" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>Tambah Data Consignee </b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <form name="modal_popup"  enctype="multipart/form-data" method="post">
             
          <div class="form-group">
            <label for="consignee">Consignee</label>
            <div class='input-group date' >
            	<div class="input-group-addon">
               	<i class="glyphicon glyphicon-bookmark"></i>
              </div>
                  <input type="text" class="form-control" name="consignee" id="consignee">
              </div>
          </div> 

          <div class="form-group">
            <label for="shipment_by">Address</label>
            <div class='input-group date' >
            	<div class="input-group-addon">
              	<i class="glyphicon glyphicon-book"></i>
              </div>
              <textarea class="form-control" id="adddress" name="address" rows="3"></textarea>
            </div>
          </div> 

          <div class="form-group">
            <label for="country">COUNTRY</label>
            <div class='input-group date' >
            	<div class="input-group-addon">
               	<i class="glyphicon glyphicon-flag"></i>
              </div>
              <select id="country" class="form-control" name="country" style="width: 100%" required>
                <option value="">- Pilih Country -</option>
                  <?php
                  $country = tampilkan_master_country();
                  while($pilih = mysqli_fetch_assoc($country)){
                  echo '<option value='.$pilih['country'].'>'.$pilih['country'].'</option>';

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
			url	 : 'edit_shipment.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#myPL', function (e) {
		var rowedit = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'view_button_packinglist.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
<!-- // $('#kode_barcode').on('change',function(){
//   $('#tampil_tabel').load(tampil.php);
// }); -->
</script><script src="assets/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#country").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
    
               
            });
        </script>
</body>
</html>
