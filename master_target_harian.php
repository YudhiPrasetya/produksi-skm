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

      
    if(isset($_POST['update'])){

      $id = $_POST['id'];
      $username = $_SESSION['username'];
      $man_power = $_POST['man_power'];
      $jml_jam = $_POST['jml_jam_normal'];
      $jml_lembur = $_POST['jml_lembur'];
      $line = $_POST['line'];
      $persentase = $_POST['persentase'];

      
      if(!empty(trim($id)) && !empty(trim($username))   && !empty(trim($man_power))
       && !empty(trim($jml_jam)) && !empty(trim($line)) && !empty(trim($persentase))){
          
                if(edit_data_master_target($id, $username, $man_power, $jml_jam, $jml_lembur, $line, $persentase)) {
                echo "success";
                }else{
                echo "errorDb";
                }
           
        }else{
            echo "kosong";
        }
       

    }
   ?>



</div>
<div style="margin: 0 20px">
<center><h2>DAFTAR MASTER TARGET</h2>

<a href="temp_target_harian_input.php"><button class="btn btn-success" type="button" data-toggle="modal">
<i class="glyphicon glyphicon-plus"></i><b>&nbsp; Tambah Data</b></button></a>
</center>
<br><br>
<div class="col-sm-2">
 <font color="blue"><b>PILIH BUYER</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <select id="costomer" class="form-control ganti" name="costomer" required>
     <option value="">- Costomer -</option>
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
 <font color="blue"><b>NO ORC</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-edit"></i>
   </div>
   <input type="text" name="orc" class="form-control ganti" placeholder="ORC"  id="orc">
   <!-- <input type="text" name="orc" id="orc2" hidden> -->
 </div>
 </div>
 
 <div class="col-sm-2">
 <font color="blue"><b>NO PO</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" name="po" class="form-control ganti" placeholder="INPUT PO NUMBER"  id="po">
 </div>
</div>

<div class="col-sm-2">
    <font color="blue"><b>STYLE</font><br></b>
    <div class="input-group">
      <div class="input-group-addon">
        <input type="checkbox" id="check_style" value="pilih_style">
      </div>
      <input type="text" class="form-control ganti" id="style" >
    </div>
  </div>

<div class="col-sm-2">
 <font color="blue"><b>STATUS</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <select id="status" class="form-control ganti" name="status" required>
     <option value="open" selected>OPEN</option>
     <option value="close">CLOSE</option>
     </select>
 </div>
</div>

<div class="col-sm-2">
    <font color="blue"><b>DATE</font><br></b>
    <div class="input-group">
      <div class="input-group-addon">
        <input type="checkbox" id="check_target" value="pilih_target">
      </div>
      <input type="date" class="form-control" id="date_target" >
    </div>
  </div>
  <br><br><br>

  
<div class="col-sm-2">
 <font color="blue"><b>STATUS</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
 
   <select id="line" class="form-control ganti" name="line" required >
          <option value="all" selected>-- Pilih Line --</option>
              <?php
                $line = tampilkan_master_line();
                while($hasil = mysqli_fetch_assoc($line)){ ?>
                    <option value = "<?= $hasil['nama_line'] ?>">LINE <?= strtoupper($hasil['nama_line']) ?></option>
              <?php } ?>
    </select>
 </div>
</div>


    <div class="col-sm-1">
    <button type="button" id="refresh" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i></button>
    </div>    
</div>
<br><br><br><br>
<div id="tampil_tabel"></div>

<script type="text/javascript">
    $('.ganti').on('change',function(){

    var url = "tampil_master_target.php";
    $('#tampil_tabel').load(url);
  });

  $('#refresh').on('click',function(){
    var url = "tampil_master_target.php";
    $('#tampil_tabel').load(url);

  });

$(document).ready(function(){
    var url = "tampil_master_target.php";
    $('#tampil_tabel').load(url);
});
</script>



<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>