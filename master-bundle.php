<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<?php
if( !isset($_SESSION['username']) ){
  echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
  // header('Location: index.php');    
}

  if(cek_status($_SESSION['username'] ) == 'admin' OR 
  cek_status($_SESSION['username'] ) == 'ppic') {
  $id = $_GET['id'];

  $sql = tampilkan_master_order_id($id); // memilih entri nim pada database
	$data = mysqli_fetch_array($sql);
  $category = $data['category'];
?>
  
<style>
 ul.list-unstyled{
        background-color:#eee;
        cursor:pointer;
        position: absolute;
        width: 93%;
        padding-left:40px;
        z-index: 3;
      }
      li.size{
        padding:5px;
        border:thin solid #F0F8FF;
        z-index: 2;
        padding-left:30px;
      }
      li.size:hover{
        background-color:#1E90FF;
        z-index: 2;
        padding-left:30px;
      }
</style>
<center>
<h2>EDIT MASTER BUNDLE RECORD</h2>
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
 
 <div style="margin: 10px">

<input type="hidden" name="id" value="<?= $id; ?>" id="id"> 
<div class="col-sm-3">
 <font color="blue"><b>PILIH COSTOMER</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <select id="costomer" class="form-control" name="costomer" disabled>
     <option value="">- Pilih Costomer -</option>
       <?php
       $costomer = tampilkan_master_costomer();
       while($hasil = mysqli_fetch_assoc($costomer)){
        if($hasil['id_costomer']==$data['id_costomer']){
             echo "<option value = '$hasil[id_costomer]' selected>$hasil[costomer]</option>";
           }else{
             echo "<option value = '$hasil[id_costomer]' >$hasil[costomer]</option>";
        }
      }
       
       ?>
     </select>
 </div>
</div>

<div class="col-sm-3">
 <font color="blue"><b>ORC</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-edit"></i>
   </div>
   <input type="text" name="orc" class="form-control" placeholder="ORC" value="<?= $data['orc'] ?>"  id="orc" disabled>
   <!-- <input type="text" name="orc" id="orc2" hidden> -->
 </div>
 </div>
 
 <div class="col-sm-3">
 <font color="blue"><b>NO PO</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" name="po" class="form-control" placeholder="INPUT PO NUMBER" value="<?= $data['no_po']; ?>"  id="po" disabled>
 </div>
</div>

<div class="col-sm-3">
 <font color="blue"><b>NO LABEL</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-tags"></i>
   </div>
   <input type="text" name="label" class="form-control" placeholder="label" value="<?= $data['label']; ?>"  id="label" disabled>
 </div>
</div>
<br><br><br>
<div class="col-sm-2">
 <font color="blue"><b>Pilih Style</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-list-alt"></i>
   </div>
   <select id="style" class="form-control" name="style" disabled>
     <option value="">- Pilih Style -</option>
       <?php
       $style = tampilkan_style();
       while($hasil = mysqli_fetch_assoc($style)){
        if($hasil['id_style']==$data['id_style']){
          echo "<option value = '$hasil[id_style]' selected>$hasil[style]</option>";
        }else{
          echo "<option value = '$hasil[id_style]' >$hasil[style]</option>";
     }
   }
 
       ?>
     </select>
 </div>
</div>

 <div class="col-sm-2">
 <font color="blue"><b>Color</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-tint"></i>
   </div>
   <input type="text" class="form-control" placeholder="Color" name="color" value="<?= $data['color'] ?>" id="color" disabled>
 </div>
 </div>

 <div class="col-sm-2">
 <font color="blue"><b>QTY ORDER</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-share"></i>
   </div>
   <input type="text" class="form-control" placeholder="QTY ORDER" name="qty_order" value="<?= $data['qty_order'] ?>" id="qty_order" disabled>
 </div>
 </div>

 <div class="col-sm-2">
 <font color="blue"><b>QTY BUNDLE</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-share"></i>
   </div>
   <input type="text" class="form-control" placeholder="QTY ORDER" name="qty_bundle" value="<?= $data['qty_bundle'] ?>" id="qty_bundle" disabled>
 </div>
 </div>

 <div class="col-sm-2" >
 <font color="blue"><b>PREPARE ON</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-share"></i>
   </div>
   <input type="date" class="form-control" placeholder="PREPARE ON" name="prepare_on" id="prepare_on" value="<?= $data['prepare_on'] ?>" disabled>
 </div>
 </div>

 <div class="col-sm-2">
 <font color="blue"><b>SHIPMENT PLAN</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-share"></i>
   </div>
   <input type="date" class="form-control" placeholder="SHIPMENT PLAN" name="shipment_plan" id="shipment_plan" value="<?= $data['shipment_plan'] ?>" disabled>
 </div>
 </div>
 </div>  
<br><br><br>
<div style="margin-left: 20px">
  <table>
    <tr>
     <?php 
          $i=0;
          $proses = tampilkan_transaksi_proses_category($category);
          while($data2 = mysqli_fetch_assoc($proses)){
            $i++;
            $transaksi = $data2['nama_transaksi'];
            if($i != 9){
          ?>
         <td width="180px">
          <input class="form-check-input" type="checkbox" name="proses[]" id="inlineCheckbox<?= $i; ?>" value="<?= $data2['nama_transaksi'] ?>" 
              <?php
                  if(cek_master_bundle($id) != 0){
                    $proses2 = tampilkan_transaksi_proses_id($id);
                    while($data3 = mysqli_fetch_assoc($proses2)){
                      if( $transaksi == $data3['nama_transaksi'] ){
                        echo 'checked disabled';
                      }
                    }  
                }else{
                  if($transaksi == 'cutting' || $transaksi == 'qc_cutput' || $transaksi == 'preparation' || $transaksi == 'trimstore'
                    || $transaksi == 'sewing' || $transaksi == 'qc_endline' || $transaksi == 'tatami' || $transaksi == 'packing' || $transaksi == 'shipment'){
                    echo 'checked ';
                    }
                }
              ?>>
          <label class="form-check-label" style="font-weight: normal" for="inlineCheckbox<?= $i; ?>"><?= strtoupper($data2['nama_transaksi']) ?></label>
        </td>
        <?php }else{ ?>
      </tr>
      <tr>
          <td width="150px">
          <input class="form-check-input" type="checkbox" name="proses[]" id="inlineCheckbox<?= $i; ?>" value="<?= $data2['nama_transaksi'] ?>" 
              <?php 
                if(cek_master_bundle($id) != 0){
                  $proses2 = tampilkan_transaksi_proses_id($id);
                  while($data3 = mysqli_fetch_assoc($proses2)){
                    if( $transaksi == $data3['nama_transaksi'] ){
                      echo 'checked disabled';
                    }
                  }  
              }else{
                if($transaksi == 'cutting' || $transaksi == 'qc_cutput' || $transaksi == 'preparation' || $transaksi == 'trimstore'
                  || $transaksi == 'sewing' || $transaksi == 'qc_endline' || $transaksi == 'tatami' || $transaksi == 'packing' || $transaksi == 'shipment'){
                  echo 'checked ';
                  }
              }
              ?>>
          <label class="form-check-label" style="font-weight: normal" for="inlineCheckbox<?= $i; ?>"><?= strtoupper($data2['nama_transaksi']) ?></label>
        </td>
        <?php } } ?>
      </tr>
    </table>
 
<center>

<table>
  <tr>
    <td>
      <a href="edit_master_order.php?id=<?= $id ?>" class="btn btn-primary" name="edit_proses" style="margin-left: 35px; margin-top: 20px" ><i class="glyphicon glyphicon-edit"> </i> EDIT DATA</a>       
    </td>
    <td>
      <a href="edit_proses_orc.php?id=<?= $id ?>" class="btn btn-info" name="edit_proses" style="margin-left: 35px; margin-top: 20px" ><i class="glyphicon glyphicon-edit"> </i> EDIT PROSES</a>       
    </td>
    <td >
      <a href="barcode_master_order.php?id=<?= $id ?>" class="btn btn-warning" name="edit_proses" style="margin-left: 35px; margin-top: 20px" ><i class="glyphicon glyphicon-barcode"> </i> PRINT BARCODE</a>       
    </td>
   
    
  </tr>
</table>

</center>
</div>
<!-- <div id="hasil"></div> -->
<div id="tampil_tabel" style="margin: 20px"></div>

<br>

<center>


<!-- <a href="hapus_temp_master_order.php" name="reset"><button type="button" class="btn btn-danger" onclick="return konfirmasi()">RESET</button></a> -->
</center>

<!-- Modal Tambah -->
<div id="tambah" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>Tambah Data Qty Order per Size </b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <form name="modal_popup"  enctype="multipart/form-data" method="post">
        <input type="hidden" value="<?= $_SESSION['username'] ?>"  id="user">
          <div class="form-group">
            <label for="size">Pilih Size</label>
            <div class="input-group">
            	<div class="input-group-addon">
              	<i class="glyphicon glyphicon-th-list" ></i>
              </div>
              <input type="text" name="size" id="size" class="form-control" onkeyup="this.value.toUpperCase()" placeholder="Ketikkan Size" />
            </div>
            <div id="sizeList"></div>
          </div>

          <div class="form-group">
            <label for="CUP">Masukkan Cup</label>
            <div class="input-group">
            	<div class="input-group-addon">
              	<i class="glyphicon glyphicon-th-list" ></i>
              </div>
              <input type="text" name="cup" id="cup" class="form-control" onkeyup="this.value.toUpperCase()" placeholder="Ketikkan CUP" />
            </div>
            <div id="sizeList"></div>
          </div>
                  
          <div class="form-group">
          	<label for="qtyorder">Qty Order</label>
           	<div class="input-group">
             	<div class="input-group-addon">
               	<i class="glyphicon glyphicon-text-width"></i>
              </div>
          		<input name="qtyorder" id="qtyorder" type="number" class="form-control"  required/>
            </div>
          </div>
             
         
        <div class="modal-footer">
          <input name="tambah" type="button" value="Tambah" id="button" class="btn btn-success" data-dismiss="modal"/>     
          </form>    
        </div>
                
      </div>
    </div>
  </div>            
</div>
<!-- Modal Tambah -->

<script type="text/javascript" language="JavaScript">
  function konfirmasi(){
    tanya = confirm("Anda Yakin Akan Menghapus Data ?");
    if (tanya == true) return true;
    else return false;
  }
</script>

<script type="text/javascript" language="JavaScript">
  function konfirmasi_generate(){
    tanya = confirm("Anda Yakin Data yang akan tergenerate benar ?");
    if (tanya == true) return true;
    else return false;
  }
</script>

<script type="text/javascript" language="JavaScript">
  function konfirmasi_simpan(){
    tanya2 = confirm("Yakin Data Sudah Benar dan ingin disimpan?");
    if (tanya2 == true) return true;
    else return false;
  }
</script>

<script type="text/javascript">
$(document).ready(function(){
    var id = $('#id').val();
    var url = 'tampil_master_bundle.php?id=';
    urlid = url+id;
    $('#tampil_tabel').load(urlid);
});

</script>

<script src="style/jquery.min.js"></script>
        <script>
            $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
            setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
</script>

<!-- // penutup hak akses level -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>
