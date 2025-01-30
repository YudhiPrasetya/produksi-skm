<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'packing') {

 
?>
  
<center>
<h2>TRANSAKSI SHIPMENT TO PACKING</h2>

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
 <font color="blue"><b>PILIH PACKINGLIST</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <select id="packinglist" class="form-control ganti" name="packinglist" required>
     <option value="">- Pilih PACKINGLIST -</option>
     <?php
            $packinglist = tampilkan_packinglist_aktif_no_approve();
            while($pilih = mysqli_fetch_assoc($packinglist)) {
              echo '<option value='.$pilih['id_shipment'].'>'.$pilih['no_invoice'].'</option>';
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
   <input type="text" name="orc" class="form-control ganti" placeholder="ORC"  id="orc">
   <!-- <input type="text" name="orc" id="orc2" hidden> -->
 </div>
 </div>
 
 <div class="col-sm-3">
 <font color="blue"><b>NO PO</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" name="po" class="form-control ganti" placeholder="INPUT PO NUMBER"  id="po">
 </div>
</div>

<div class="col-sm-3">
 <font color="blue"><b>Style</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-list-alt"></i>
   </div>
   <input type="text" name="style" class="form-control ganti" placeholder="INPUT STYLE"  id="style">
 </div>
</div>
</div>
<br><br>
<center>
   <div style="margin: 25px" id="tampil_tabel"></div>
</center>


</div>
<br>
<!-- <div id="tampil_tabel"></div> -->


<script type="text/javascript">
  $('.ganti').on('change',function(){
    var po = $('#po').val();
    var orc = $('#orc').val();
    var style = $('#style').val();
    var pl = $('#packinglist').val();
    url = "transaksi_shipment_to_packing2.php?po="+po+"&orc="+orc+"&style="+style+"&pl="+pl;
    console.log(url)
          $('#tampil_tabel').load(url);
    
  });

$(document).ready(function(){
    $('#tampil_tabel').load("kosong.php");
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
