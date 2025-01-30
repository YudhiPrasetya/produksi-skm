<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');


  if( !isset($_SESSION['username']) ){
    echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
    // header('Location: index.php');    
}
?>

<style>
  hr {
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    border-style: inset;
    border-width: 1px;
    border-color:blue;
    }
    
    ul.list-unstyled{
        background-color:#eee;
        cursor:pointer;
        position: absolute;
        width:25%;
        padding-left:0px;
        z-index: 2;
      }
      li.po{
        padding:7px;
        border:thin solid #F0F8FF;
        z-index: 2;
        padding-left:15px;
      }
      li.po:hover{
        background-color:#1E90FF;
        z-index: 2;
        padding-left:15px;
      }
  
  </style>
<center>
<h3>LAPORAN HASIL CUTTING PART</h3>
</center><br>
    </div>

    <div class="col-sm-2">
  <font color="blue"><b>s/d Tanggal</font><br></b>
  <input type="date" id="tanggal" value="<?= date("Y-m-d") ?>" class="form-control ganti" required>
  </div>

  <div class="col-sm-3">
  <font color="blue"><b>COSTOMER</font><br></b>
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
    
  <div class="col-sm-2">
  <font color="blue"><b>CATEGORY</font><br></b>
    <select id="category" class="form-control ganti" name="category" required>
     <option value="">- Category -</option>
     <option value="UNDERWEAR">UNDERWEAR</option>
     <option value="OUTERWEAR">OUTERWEAR</option>
     </select>
    </div>

  

  <div class="col-sm-3">
    <font color="blue"><b> PO BUYER</font><br></b>
        <input type="text" id="no_po" class="form-control ganti" required>
    </div>


  <div class="col-sm-2">
    <font color="blue"><b>STATUS</font><br></b>
        <select type="text" id="status" class="form-control ganti" required>
            <option value="open" selected>OPEN</option>
            <option value="close">CLOSE</option>
        </select>
    </div>
  
  <br><br><br>


    <div class="col-sm-3">
    <font color="blue"><b> ORC</font><br></b>
        <input type="text" id="orc" class="form-control ganti" required>
    </div>

    <div class="col-sm-3">
        <font color="blue"><b>STYLE</font><br></b>
        <input type="text" id="style" class="form-control ganti" required>
    </div>

    <div class="col-sm-2">
    <font color="blue"><b>UDAH / BLM POTONG</font><br></b>
        <select type="text" id="status_potong" class="form-control ganti" required>
            <option value="udah_potong" selected>UDAH POTONG</option>
            <option value="blm_potong">BLM POTONG</option>
        </select>
    </div>

    <div class="col-sm-1">
    <button type="button" id="refresh" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i></button>
    </div>  


    
    </div>
    <br><br><br>
<div id="tampil_tabel" style="margin-left: 20px; margin-right: 20px"></div>

<script type="text/javascript">
  $('.ganti').on('change',function(){
    var tgl = $('#tanggal').val();
    var no_po = $('#no_po').val();
    var orc = $('#orc').val();
    var style = $('#style').val();
    var status = $('#status').val();
    var costomer = $('#costomer').val();
    var category = $('#category').val();
    var status_potong = $('#status_potong').val();
    var url = "tampil_laporan_hasil_part_cutting.php?tgl="+tgl+"&orc="+orc+"&style="+style+"&status="+status+"&costomer="+costomer+"&no_po="+no_po+"&category="+category+"&status_potong="+status_potong;
    console.log(url);
    $('#tampil_tabel').load(url);
  });

  $('#refresh').on('click',function(){
    var tgl = $('#tanggal').val();
    var orc = $('#orc').val();
    var no_po = $('#no_po').val();
    var style = $('#style').val();
    var status = $('#status').val();
    var costomer = $('#costomer').val();
    var category = $('#category').val();
    var status_potong = $('#status_potong').val();
    var url = "tampil_laporan_hasil_part_cutting.php?tgl="+tgl+"&orc="+orc+"&style="+style+"&status="+status+"&costomer="+costomer+"&no_po="+no_po+"&category="+category+"&status_potong="+status_potong;
    console.log(url);
    $('#tampil_tabel').load(url);
  });

$(document).ready(function(){
    $('#tampil_tabel').load("kosong.php");
});


</script>


</body>
</html>
