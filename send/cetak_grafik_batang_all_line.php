<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');


  if( !isset($_SESSION['username']) ){
    echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
    // header('Location: index.php');    
}
?>
<script src="assets/Chart.js"></script>
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
<h3>LAPORAN HASIL PRODUKSI</h3>
</center><br>
    </div>

    <div class="col-sm-2">
  <font color="blue"><b>Pilih Tanggal</font><br></b>
  <input type="date" id="tanggal" value="<?= date("Y-m-d") ?>" class="form-control ganti" required>
  </div>
    
  <div class="col-sm-3">
  <font color="blue"><b>PILIH LANTAI</font><br></b>
    <select id="lantai" class="form-control ganti" name="lantai" required >
        <option value="">- Pilih lantai -</option>
        <option value="1">LANTAI 1</option>
        <option value="2">LANTAI 2</option>
        <option value="3">LANTAI 3</option>
    </select>
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

    <div class="col-sm-1">
    <button type="button" id="refresh" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i> REFRESH</button>
    </div>  
 
    </div>
    <br><br><br>
<div id="tampil_tabel"></div>

<script type="text/javascript">

  $('#refresh').on('click',function(){
    var tanggal = $('#tanggal').val();
    var lantai = $('#lantai').val();
    var costomer = $('#costomer').val();

    // var tgl = $('#tanggal').val();
    // var orc = $('#orc').val();
    // var no_po = $('#no_po').val();
    // var style = $('#style').val();
    // var status = $('#status').val();
    // var costomer = $('#costomer').val();
    // var category = $('#category').val();
    // var line = $('#line').val();
    // var url = "tampil_laporan_hasil_scan_global2.php?trx="+proses+"&tgl="+tgl+"&orc="+orc+"&style="+style+"&status="+status+"&costomer="+costomer+"&no_po="+no_po+"&category="+category+"&line="+line+"&layar=laptop";
    // console.log(url);
    // $('#tampil_tabel').load(url);
    

    var url = "tampil_grafik_batang_all_line.php?tanggal="+tanggal+"&lantai="+lantai+"&costomer="+costomer;
    $('#tampil_tabel').load(url);
  });

$(document).ready(function(){
    $('#tampil_tabel').load("kosong.php");
});


</script>


</body>
</html>