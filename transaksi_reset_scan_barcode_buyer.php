<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<?php
if($_SESSION['username'] == 'admin' OR $_SESSION['username'] == 'agus') {

 
?>
  <style>
  td{
    text-align: center;
  }

  .warnaKolom{
    font-weight: bold;
    color : blue;
  }
</style>
<center>
<h2>TRANSAKSI RESET SCAN KENZIN PACKING BARCODE_BUYER</h2>

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
<div class="col-sm-3">
 <font color="blue"><b>PILIH COSTOMER</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
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

<div class="col-sm-3">
 <font color="blue"><b>NO ORC</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-edit"></i>
   </div>
   <input type="text" name="orc" class="form-control ganti" placeholder="FILTER ORC"  id="orc">
   <!-- <input type="text" name="orc" id="orc2" hidden> -->
 </div>
 </div>
 
 <div class="col-sm-3">
 <font color="blue"><b>NO PO</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" name="po" class="form-control ganti" placeholder="FILTER PO NUMBER"  id="po">
 </div>
</div>

<div class="col-sm-3">
 <font color="blue"><b>Style</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <input type="checkbox" class="ganti" id="check_style" value="pilih_style">
   </div>
   <input type="text" name="style" class="form-control ganti" placeholder="FILTER STYLE"  id="style">
 </div>
</div>
<br><br><br>
<div class="col-sm-3">
 <font color="blue"><b>COLOR</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" name="color" class="form-control ganti" placeholder="FILTER COLOR"  id="color">
 </div>
</div>

<div class="col-sm-3">
 <font color="blue"><b>KELOMPOK KARTON</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <select id="kelompok" class="form-control ganti" name="kelompok" required>
     <option value="">- Pilih Kelompok Karton -</option>
     <option value="full">Full Karton</option>
     <option value="ecer">Tidak Full Karton ( ECER )</option>
     <option value="mix">Mix Size</option>
     <option value="mix_style">Mix Style</option>
     </select>
 </div>
</div>
</div>
<br><br>


<center>
   <div style="margin: 25px" id="tampil_tabel2"></div>
</center>


</div>
<br>
<!-- <div id="tampil_tabel"></div> -->


<script type="text/javascript">
  $('.ganti').on('change',function(){
    var po = $('#po').val();
    var orc = $('#orc').val();
    var style = $('#style').val();
    var costomer = $('#costomer').val();
    var color = $('#color').val();
    var kelompok = $('#kelompok').val();
    var check_style = $("#check_style:checked").val();
        if(check_style=='pilih_style'){
          checkstyle = 'iya';
        }else{
          checkstyle = 'tidak';
        }
    url = "transaksi_reset_scan_barcode_buyer2.php?po="+po+"&orc="+orc+"&style="+style+"&costomer="+costomer+"&color="+color+"&kelompok="+kelompok+"&checkstyle="+checkstyle;

          $('#tampil_tabel2').load(url);
    
  });

$(document).ready(function(){
    $('#tampil_tabel2').load("kosong.php");
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
