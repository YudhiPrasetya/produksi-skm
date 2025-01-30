<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
if( !isset($_SESSION['username']) ){
  echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
  
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
<h3>LAPORAN HASIL PRODUKSI</h3>
</center><br>
    </div>

    <div class="col-sm-3">
  <font color="blue"><b>s/d Tanggal</font><br></b>
  <input type="date" id="tanggal" value="<?= date("Y-m-d") ?>" class="form-control ganti" required>
  </div>
    
  <div class="col-sm-3">
  <font color="blue"><b>CATEGORY</font><br></b>
    <select id="category" class="form-control ganti" name="category" required>
     <option value="">- Category -</option>
     <option value="UNDERWEAR">UNDERWEAR</option>
     <option value="OUTERWEAR">OUTERWEAR</option>
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

  <div class="col-sm-3">
    <font color="blue"><b>STATUS</font><br></b>
        <select type="text" id="status" class="form-control ganti" required>
            <option value="open" selected>OPEN</option>
            <option value="close">CLOSE</option>
        </select>
    </div>
  
  <br><br><br>

  <div class="col-sm-3">
  <font color="blue"><b>Proses</font><br></b>
  <select id="proses" class="form-control ganti" name="proses" required >
            <option value="">- Pilih Proses -</option>
              <?php
              $proses = tampilkan_transaksi_proses();
              while($hasil = mysqli_fetch_assoc($proses)){
                if($hasil['nama_transaksi'] != 'ht2'){
                  echo "<option value = '$hasil[nama_transaksi]'>".strtoupper($hasil['nama_transaksi'])."</option>";
                }
              }
              ?>
            </select>
  </div>


    <div class="col-sm-3">
    <font color="blue"><b> ORC</font><br></b>
        <input type="text" id="orc" class="form-control ganti" required>
    </div>

    <div class="col-sm-3">
        <font color="blue"><b>STYLE</font><br></b>
        <input type="text" id="style" class="form-control ganti" required>
    </div>

    <div class="col-sm-2">
        <font color="blue"><b>LINE</font><br></b>
        <select id="line" class="form-control ganti" name="line" required >
          <option value="all" selected>-- Pilih Line --</option>
              <?php
                // $line = tampilkan_master_line();
                $line = tampilkan_master_line_open();
                while($hasil = mysqli_fetch_assoc($line)){ ?>
                    <option value = "<?= $hasil['nama_line'] ?>"> <?= strtoupper($hasil['nama_line']) ?></option>
              <?php } ?>
            </select>
    </div>

    <div class="col-sm-1">
    <button type="button" id="refresh" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i></button>
    </div>  
    
    </div>
    <br><br><br>
    <div class="row text-center" id="loading">
      <!-- <div style="display: none;"> -->
        Loading...
        <img src="assets/images/loader.gif" alt="Loading" width="142" height="71" />
      <!-- </div> -->
    </div>
    <div id="tampil_tabel"></div>


<script type="text/javascript">


$(document).ready(function(){
    $('#loading').hide();
    $('#tampil_tabel').load("kosong.php");

    $('.ganti').on('change',function(){
      $('#loading').show();
      $('#example').hide();
      $('#btnExportToExcel').hide();
      $('#tableContainer').hide();
      // $('#tampil_tabel').hide();
      var proses = $('#proses').val();
      var tgl = $('#tanggal').val();
      var orc = $('#orc').val();
      var style = $('#style').val();
      var status = $('#status').val();
      var costomer = $('#costomer').val();
      var category = $('#category').val();
      var line1 = $('#line').val();
      var line2 = line1.replace(' ', '+');
      var line = line2.replace(' ', '+');
      var url = "tampil_laporan_hasil_scan_global_perjam.php?trx="+proses+"&tgl="+tgl+"&orc="+orc+"&style="+style+"&status="+status+"&costomer="+costomer+"&category="+category+"&line="+line+"&layar=laptop";
      console.log(line);
      $('#tampil_tabel').load(url, function(response, status, hrx){
        if(status == 'success'){
          $('#loading').hide();
          $('#btnExportToExcel').show();
          $('#tableContainer').show();
          
          // $('#tampil_tabel').show();
          $('#example').show();
        }
      });
      
    });

  $('#refresh').on('click',function(){
    $('#loading').show();
    $('#example').hide();
    $('#btnExportToExcel').hide();
    $('#tableContainer').hide();
    // $('#tampil_tabel').hide();
    var proses = $('#proses').val();
    var tgl = $('#tanggal').val();
    var orc = $('#orc').val();
    var style = $('#style').val();
    var status = $('#status').val();
    var costomer = $('#costomer').val();
    var category = $('#category').val();
    var line2 = line1.replace(' ', '+');
    var line = line2.replace(' ', '+');
    var url = "tampil_laporan_hasil_scan_global_perjam.php?trx="+proses+"&tgl="+tgl+"&orc="+orc+"&style="+style+"&status="+status+"&costomer="+costomer+"&category="+category+"&line="+line+"&layar=laptop";
    console.log(url);
    
    $('#tampil_tabel').load(url, function(response, status, hrx){
        if(status == 'success'){
          $('#loading').hide();
          $('#btnExportToExcel').show();
          $('#tableContainer').show();
          // $('#tampil_tabel').show();
          $('#example').show();
        }
      });
  });    

        
});

</script>


</body>
</html>
