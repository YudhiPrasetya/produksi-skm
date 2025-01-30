<?php
  require_once 'core/init.php';
  require_once 'view/header.php';

  $error='';
  if( !isset($_SESSION['username']) ){
    echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
    // header('Location: index.php');    
  }
  if(cek_status($_SESSION['username'] ) == 'admin' OR 
    cek_status($_SESSION['username'] ) == 'kenzin'  OR 
    cek_status($_SESSION['username'] ) == 'packing'  OR 
    cek_status($_SESSION['username'] ) == 'report') {
  
    if( isset($_POST['tambah'])){
      $invoice = $_POST['invoice'];
      $inspection = $_POST['inspection'];
      $cut_off = $_POST['cut_off'];
      $costomer = $_POST['costomer'];
      $shipment_by = $_POST['shipment_by'];
      $status = $_POST['status'];
      $ukuran_karton = $_POST['ukuran_karton'];
    
      if(!empty(trim($invoice)) && !empty(trim($inspection)) && !empty(trim($costomer)) && !empty(trim($shipment_by)) && !empty(trim($status)) && !empty(trim($ukuran_karton))){
        //memasukkan ke database
        if(cek_invoice($invoice) == 0){
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
  
<th class="tengah theader"style="font: #254681"><CENTER><h2>CREATE PACKINGLIST</h2>
<?php if (cek_status($_SESSION['username'] ) == 'report'){
}else{ ?>
<button class="btn btn-success" type="button" data-target="#tambah" data-toggle="modal" title="Tambah Data Siswa">
<i class="glyphicon glyphicon-plus"></i><b>&nbsp; Tambah Data</b></button>
<?php } ?>

</center>
<br><br>
<!-- <div class="container"> -->
<table border="1px" class="table table-striped table-bordered data">
  <thead>
    <tr>
      <th class="tengah theader"style="background: #254681"><CENTER>No</th>
      <th class="tengah theader"style="background: #254681"><CENTER>NO INVOICE </th>
      <th class="tengah theader"style="background: #254681"><CENTER>DATE INFECTION</th>
      <th class="tengah theader"style="background: #254681"><CENTER>DATE CUT OFF</th>
      <th class="tengah theader"style="background: #254681"><CENTER>COSTUMER</th>
      <th class="tengah theader"style="background: #254681"><CENTER>SHIPMENT BY</th>
      <th class="tengah theader"style="background: #254681"><CENTER>CARTON MEASURMENT</th>
      <th class="tengah theader"style="background: #254681"><CENTER>STATUS</th>
      <th class="tengah theader"style="background: #254681"><CENTER>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no=1;
      $shipment = tampilkan_master_shipment();
      while($row=mysqli_fetch_assoc($shipment))
      {
    ?>
    <tr>
      <td class="tengah"><?= $no; ?></td>
      <td class="tengah"><?= $row['no_invoice']; ?></td>
      <td class="tengah"><?= tanggal_indo2($row['inspection'], false) ?></td>
      <td class="tengah"><?= tanggal_indo2($row['cut_off'], false) ?></td>
      <td class="tengah"><?= $row['costomer']; ?></td>
      <td class="tengah"><?= $row['shipment_by']; ?></td>
      <td class="tengah"><?= $row['ukuran_karton']; ?></td>
      <td class="tengah"><?= ucfirst($row['status']); ?> / 
      <?php
        if($row['approve'] == 'y'){
          echo 'Approve';
        }else{
          echo 'Pending';
        }
      ?>
      </td>
      <td class="tengah">
      <?php if (cek_status($_SESSION['username'] ) == 'report'){
        }else{ ?><button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" data-id="<?= $row['id_shipment']; ?>"><i class="glyphicon glyphicon-edit"></i></button> <?php } ?> 
        <button type="button" id="packinglist" data-toggle="modal" data-target="#myPL" class="btn btn-info edit_komentar kecil" data-id="<?= $row['id_shipment']; ?>">PL</i></button>
       
        <a href="laporan_shipment.php?id=<?= $row['id_shipment']; ?>"><button type="button" class="btn btn-xs btn-primary kecil"><i class="glyphicon glyphicon-print"></i></button></a>
        <?php if (cek_status($_SESSION['username'] ) == 'report'){
        }else{ ?>
        <a href="hapus_shipment_satu.php?id=<?= $row['id_shipment']; ?>" target=”_blank”><button type="button" class="btn btn-xs btn-danger kecil"><i class="glyphicon glyphicon-trash"></i></button></a>
        <?php } ?>
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
        <h4 class="modal-title"><font face="Calibri" color="red"><b>Tambah Data Shipment </b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <form name="modal_popup"  enctype="multipart/form-data" method="post">
          
          <div class="form-group">
            <label for="invoice">NO INVOICE/PACKINGLIST</label>
            <div class="input-group">
            	<div class="input-group-addon">
              	<i class="glyphicon glyphicon-list-alt" ></i>
              </div>
              <?php
                  $bulan	= date('n');
	                $bulrow = getRomawi($bulan);
                  $tahun	= date('Y');
                  $tglnow = date('Y-m-d');
                  $noinv = '---/SKM/'.$bulrow.'/'.$tahun;
                ?>
              <input name="invoice" id="invoice" value="<?= $noinv ?>" type="text" class="form-control" placeholder="Masukkan No Invoice / Packinglist" required/>
            </div>
          </div>
                  
          <div class="form-group">
          	<label for="inspection">Date inspection</label>
           	<div class="input-group">
             	<div class="input-group-addon">
               	<i class="glyphicon glyphicon-calendar"></i>
              </div>
          		<input name="inspection" value="<?= $tglnow ?>" id="inspection" type="date" class="form-control"  required/>
            </div>
          </div>

          <div class="form-group">
          	<label for="cut_off">Date Cut OFF</label>
           	<div class="input-group">
             	<div class="input-group-addon">
               	<i class="glyphicon glyphicon-calendar"></i>
              </div>
          		<input name="cut_off" value="<?= $tglnow ?>" id="cut_off" type="date" class="form-control"  required/>
            </div>
          </div>
             
          <div class="form-group">
            <label for="costomer">Costomer</label>
            <div class='input-group date' >
            	<div class="input-group-addon">
               	<i class="glyphicon glyphicon-user"></i>
              </div>
              <select id="costomer" class="form-control" name="costomer" required>
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

          <div class="form-group">
            <label for="shipment_by">SHIPMENT BY</label>
            <div class='input-group date' >
            	<div class="input-group-addon">
              	<i class="glyphicon glyphicon-random"></i>
              </div>
              <select class="form-control" name="shipment_by" required>
               	<!-- <option value="" selected>Pilih Metode Pengiriman</option> -->
               	<option value="BY AIR">BY AIR</option>
               	<option value="BY SEA">BY SEA</option>
                <option value="KURIR" Selected>KURIR</option>
              </select>
            </div>
          </div> 

          <div class="form-group">
            <label for="ukuran_karton">Ukuran Karton </label>
            <div class='input-group date' >
            	<div class="input-group-addon">
               	<i class="glyphicon glyphicon-resize-horizontal"></i>
              </div>
              <input type="text" name="ukuran_karton" value="60 x 40 x 24" id="ukuran_karton" class="form-control" placeholder="Masukkan Ukuran Karton" required/>
              </div>
          </div> 
                           
          <div class="form-group">
          	<label>Status</label>
           	<div class="input-group">
             	<div class="input-group-addon">
             		<i class="glyphicon glyphicon-list"></i>
             	</div>
           		<select class="form-control" name="status" required>
               	<option value="" selected>Pilih Status (Aktif/Tidak Aktif)</option>
               	<option value="aktif" selected>Aktif</option>
               	<option value="tidak">Tidak Aktif</option>
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
    console.log('rowedit: ', rowedit);
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'view_button_packinglist2.php',
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
</script>

</body>
</html>
