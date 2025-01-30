
<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'packing' ) {
  $user = $_SESSION['username'];
 $trx = $_GET['trx'];  
 $cekpacking = tampilkan_data_packing($trx);
 $data = mysqli_fetch_array($cekpacking);

  ?>


<center>
<h2>TRANSAKSI PACKING</h2>
<div style="height:55px;">
                 <?php
                    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                    echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
                    }
                    $_SESSION['pesan'] = '';
                ?>
            </div>
</center>
</div>
<div style="margin: 0 30px">
<div class="row">
<div class="col-sm-3">
 <font color="blue"><b>Masukkan ORC</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <!-- <input type="text" name="orc" id="orc" class="form-control" onkeyup="this.value = this.value.toUpperCase()" placeholder="Tulis No ORC" /> -->
   <input type="text" class="form-control pilcek" id="orc2" style="width: 180px; display: inline-block" disabled >
   <input type="hidden" value = <?= $_SESSION['username']; ?> id="user" >
   <input type="hidden" name="orc" class="form-control pilcek" id="orc" >
   <input type="hidden" name="orc" class="form-control" id="trx" value="<?= $_GET['trx'] ?>" >
   <button type="button" class="btn btn-info" style="margin: 0px 0 0 7px;" data-toggle="modal" data-target="#myModal"><b><span class="glyphicon glyphicon-search"></span> Cari</b></button>
 </div>
 <!-- <div id="orcList"></div> -->
</div>

<div class="col-sm-2">
    <font color="blue"><b>Buyer</font><br></b>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
      </div>
      <input type="text" class="form-control" id="buyer" disabled>
    </div>
  </div>

 <div class="col-sm-2">
 <font color="blue"><b>No PO</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" id="no_po" class="form-control" disabled />
 </div>
</div>


 <div class="col-sm-2">
 <font color="blue"><b>LABEL</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-list"></i>
   </div>
   <input type="text" id="label" class="form-control" disabled />
 </div>
</div> 

 <div class="col-sm-3">
 <font color="blue"><b>Kode Barcode</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-barcode"></i>
   </div>
   <input type="text" class="form-control" placeholder="KODE BARCODE" name="kode_barcode" id="kode_barcode" autofocus required>
 </div>

   <!-- <input type="text" class="form-control" placeholder="KODE BARCODE" name="kode_barcode" id="kode_barcode" autofocus required> -->
   <input type="submit"  name="submit_barcode" value="TAMBAH" id="submit_barcode" hidden>
</div>

</div>
 

 
<!-- Modal Tambah -->
<div class="modal fade" id="myModal" class="modal-backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>Data Order</b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <form name="modal_popup"  enctype="multipart/form-data" method="post">
      
        <table border="1px" id="lookup" class="table table-striped table-hover table-bordered data" style="font-size: 13px">
          <thead>
            <tr>
              <th class="tengah theader" width=5%>NO</th>
              <th class="tengah theader">COSTOMER</th>
              <th class="tengah theader">ORC</th>
              <th class="tengah theader">NO PO</th>
              <th class="tengah theader">STYLE</th>
              <th class="tengah theader">LABEL</th>
              <th class="tengah theader">COLOR</th>
              <!-- <th class="tengah theader">QTY ORDER</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
              $no=1;
              $shipment = tampilkan_master_order_open();
              while($row=mysqli_fetch_assoc($shipment))
              {
            ?>
            <tr class="pilih" data-order="<?= $row['orc']; ?>" data-po="<?= $row['no_po']; ?>" data-label="<?= $row['label']; ?>" data-costomer="<?= $row['costomer']; ?>"  data-dismiss="modal">
              <td class="tengah"><?= $no; ?></td>
              <td class="tengah"><?= $row['costomer']; ?></td>
              <td class="tengah"><?= $row['orc']; ?></td>
              <td class="tengah"><?= $row['no_po']; ?></td>
              <td class="tengah"><?= $row['style']; ?></td>
              <td class="tengah"><?= $row['label']; ?></td>
              <td class="tengah"><?= $row['color']; ?></td>
              <!-- <td class="tengah"><?= $row['total']; ?></td> -->
            </tr>
              <?php
                $no++;
                }
              ?>
            </tbody>  
          </table> 
             
      <div class="modal-footer">
        <input name="tambah" type="button" value="Close" id="button" class="btn btn-success" data-dismiss="modal"/>     
        </form>    
      </div>         
    </div>
  </div>
  </div>            
</div>
<!-- Modal Tambah -->
</form>

<div id="tampil_tabel"></div>
<form action="simpan_master_packing_edit.php" method="post" >
    <input type="hidden" name="trx" value="<?= $trx ?>">
<center>
  <div  style="width: 40%; border: 2px solid blue; padding:20px;">
    <br>
    <b><font color="blue">Pastikan Pilihan Kelompok Karton Benar Sebelum Disimpan</font></b>
    <br><br>
  
    <div class="col-sm-12">
      <font color="red"><b>Kelompok Karton</b>
        <select class="form-control pilcek3" name="kelompok" required>
          <option value="">--- Pilih Kelompok Karton ---</option>
          <option value="full" <?php if($data['kelompok'] == 'full'){ echo 'selected'; } ?>>Full Karton (No Mix)</option>
          <option value="ecer" <?php if($data['kelompok'] == 'ecer'){ echo 'selected'; } ?>>Isi Karton Tidak Full</option>
          <option value="mix" <?php if($data['kelompok'] == 'mix'){ echo 'selected'; } ?>>MIX SIZE</option>
          <!-- <option value="mix_color" <?php if($data['kelompok'] == 'mix_color'){ echo 'selected'; } ?>>Mix Color</option> -->
          <option value="mix_style" <?php if($data['kelompok'] == 'mix_style'){ echo 'selected'; } ?>>Mix Style</option>
        </select>
    </div>
    <br>
    <div>
    <!-- <a href="simpan_master_packing.php" name="simpan"><button type="button" class="btn btn-primary" onclick="return konfirmasi_simpan()">SIMPAN</button></a> -->
    <INPUT type="submit" class="btn btn-primary" name="kirim" value="SIMPAN DATA" id="submit_barang" onclick="return konfirmasi_simpan()" style="margin-right: 40px; margin-top: 20px">
    <a href="hapus_packing_transaksi.php?trx=<?= $trx ?>" name="reset"><button type="button" class="btn btn-danger" onclick="return konfirmasi_delete_all()">DELETE ALL</button></a>
    </div>
    </form>
</center>
<script type="text/javascript">
  $('#kode_barcode').on('change',function(){
    var barcode = $('#kode_barcode').val();
    var orc = $('#orc').val();
    var user = $('#user').val();
    var trx = $('#trx').val();
    $.ajax({
      method: "POST",
      url: "proses_packing.php",
      data: { isi_barcode : barcode,
              orc : orc,
              user : user,
              trx : trx,
              type : 'edit'
      },
      success: function(data){
       
        if(data.trim() == "success"){
            var trx = $('#trx').val();
            url = "tampil_packing_edit.php?trx="+trx;
          $('#tampil_tabel').load(url);
        }else if(data.trim() == "errorDb"){
          alert("Gagal Ada masalah dengan kode barcode");
        }else if(data.trim() == "errorQtyBefore"){
          alert("Gagal Qty Kenzin Habis");
        }else if(data.trim() == "errorQtyOrder"){
          alert("Gagal Qty Sudah Memenuhi Order Atau Tidak Ada Orderan untuk Label ini");
        }
      }
    });
    document.getElementById("kode_barcode").value = "";
  });

  $(document).ready(function(){
    var trx = $('#trx').val();
    url = "tampil_packing_edit.php?trx="+trx;
    $('#tampil_tabel').load(url);
  });
</script>




<script type="text/javascript">
  $(document).on('click', '.pilih', function (e) {
    document.getElementById("orc").value = $(this).attr('data-order');
    document.getElementById("orc2").value = $(this).attr('data-order');
    document.getElementById("no_po").value = $(this).attr('data-po');
    document.getElementById("label").value = $(this).attr('data-label');
    document.getElementById("buyer").value = $(this).attr('data-costomer');
    $('#myModal').modal('hide');
  });
			

// tabel lookup mahasiswa
    $(function () {
      $("#lookup").dataTable();
    });
 
</script>


<script type="text/javascript" language="JavaScript">
function konfirmasi_delete_all()
{
tanya = confirm("Anda Yakin Akan Menghapus Data ini ?  Data yg dihapus udah tidak bisa di kembalikan lagi");
if (tanya == true) return true;
else return false;
}
</script>

<!-- <script src="style/jquery.min.js"></script> -->
<script>
  $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
  setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
</script>

<!-- // penutup hak akses level -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>
