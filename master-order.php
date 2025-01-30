<?php
  require_once 'core/init.php';
  require_once 'view/header.php';

  $error='';
  if( !isset($_SESSION['username']) ){
    echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
    // header('Location: index.php');    
  }
  if(cek_status($_SESSION['username'] ) == 'admin' OR 
    cek_status($_SESSION['username'] ) == 'kenzin' OR 
    cek_status($_SESSION['username'] ) == 'packing_outerware') {
  
   ?>

<?php
  
  if(isset($_POST['kirim'])){
    // $id = $_POST['id'];
    $user = $_SESSION['username'];
    $costomer = $_POST['costomer'];
    $orc = $_POST['orc']; 
    $po = $_POST['po'];
    $label = $_POST['label'];
    $style = $_POST['style'];
    $color = $_POST['color'];
    $qty_order = $_POST['qty_order'];
    $qty_bundle = $_POST['qty_bundle'];
    $prepare_on = $_POST['prepare_on'];
    $shipment_plan = $_POST['shipment_plan'];
    
    
    // if(cek_category_style($style) != 0){  
      if(!empty(trim($costomer)) && !empty(trim($orc)) && !empty(trim($po)) && !empty(trim($label)) 
      && !empty(trim($style)) && !empty(trim($qty_order))){

        if(!empty(trim($prepare_on)) || !empty(trim($shipment_plan)) || !empty(trim($qty_bundle))){
          if(kirim_data_master_order($costomer, $orc, $po, $label, $style, $color, $qty_order, $qty_bundle, $prepare_on, $shipment_plan, $user) && reset_temp_master_order($user) ) {
            $_SESSION['pesan'] = 'Data Order Berhasil disimpan';
          }else{
            echo "gagal menyimpan data";
          }
        }else{
          if(kirim_data_master_order2($costomer, $orc, $po, $label, $style, $color, $qty_order, $user) && reset_temp_master_order($user) ) {
            $_SESSION['pesan'] = 'Data Order Berhasil disimpan';
          }else{
            echo "gagal menyimpan data";
          }
        }
          
        }else{
          $_SESSION['pesan'] = 'Data Masih ada yang kosong silakan diulang';
        }
      } 
    // }else{
    //   $_SESSION['pesan'] = 'Item Barang Blm Ditentukan di Master Style';
    // }
?>
</div>

<div style="margin: 0 20px">
<center><h2>DAFTAR MASTER ORDER</h2>
<div style="height:35px;">
                 <?php
                    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                    echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
                    }
                    $_SESSION['pesan'] = '';
                ?>
</div>
<a href="tambah-order.php"><button class="btn btn-success" type="button" data-toggle="modal">
<i class="glyphicon glyphicon-plus"></i><b>&nbsp; Tambah Data</b></button></a>
</center>
<br><br>
<div class="col-sm-3">
 <font color="#254681"><b>PILIH BUYER</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <select id="costomer" class="form-control ganti" name="costomer" required>
     <option value="">- Pilih Costomer -</option>
       <?php
       $costomer = tampilkan_master_costomer();
       while($pilih = mysqli_fetch_assoc($costomer)){
       echo '<option value='.$pilih['costomer'].'>'.$pilih['costomer'].'</option>';

       }
       ?>
     </select>
 </div>
</div>


<div class="col-sm-2">
 <font color="#254681"><b>NO ORC</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-edit"></i>
   </div>
   <input type="text" name="orc" class="form-control ganti" placeholder="ORC"  id="orc3">
   <!-- <input type="text" name="orc" id="orc2" hidden> -->
 </div>
 </div>
 
 <div class="col-sm-3">
 <font color="#254681"><b>NO PO</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" name="po" class="form-control ganti" placeholder="INPUT PO NUMBER"  id="po">
 </div>
</div>

<div class="col-sm-2">
 <font color="#254681"><b>Style</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-list-alt"></i>
   </div>
   <input type="text" name="style" class="form-control ganti" placeholder="INPUT STYLE"  id="style2">
 </div>
</div>
</div>

<div class="col-sm-2">
 <font color="#254681"><b>STATUS</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <select id="status" class="form-control ganti" name="status" required>
     <option value="open" selected >OPEN</option>
     <option value="close" >CLOSE</option>
     </select>
 </div>
</div>

</div>
<br><br><br><br>
<div id="tampil_tabel"></div>

<script type="text/javascript">
    $('.ganti').on('change',function(){
    var status = $('#status').val();
    var url = "tampil_master_order.php?status="+status;
    $('#tampil_tabel').load(url);
  });

$(document).ready(function(){
    var url = "tampil_master_order.php?status="+status;
    $('#tampil_tabel').load(url);
});
</script>



<script src="style/jquery.min.js"></script>
        <script>
            $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
            setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);

</script>


 <!-- penutup hak akses level -->

<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
<!-- // $('#kode_barcode').on('change',function(){
//   $('#tampil_tabel').load(tampil.php);
// }); -->
</script>

</body>
</html>
