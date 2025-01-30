<?php
require_once 'core/init.php';
require_once 'view/header_tv.php';
// date_default_timezone_set('Asia/Jakarta');
?>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->


  
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
  </div>
<center>
<title>LAPORAN OUTPUT PRODUCTION</title>
<h3>LAPORAN OUTPUT PRODUCTION</h3>
</center>
 

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
</div>
<br><br>
<div id="tampil_tabel"></div>


<script type="text/javascript">

$('.ganti').on('change',function(){
    var proses = $('#proses').val();
    var costomer = $('#costomer').val();
    var category = $('#category').val();
    var url = "tampil_laporan_hasil_scan_global.php?trx="+proses+"&tgl=&orc=&style=&status=open&costomer="+costomer+"&category="+category+"&line=&layar=tv";
    
    $('#tampil_tabel').load(url);
    setInterval(function() {
        $("#tampil_tabel").load(url); 
        console.log(url);
    }, 60000);
  });

// $(document).ready(function(){
//     var url = "tampil_laporan_hasil_scan_global.php?trx="+proses+"&tgl="+tgl+"&orc="+orc+"&style="+style+"&status="+status+"&costomer="+costomer+"&category="+category+"&line="+line;
//     console.log(url);
//     $('#tampil_tabel').load(url);
//     setInterval(function() { $("#tampil_tabel").load(url); }, 5000);
    
// });
</script>



</body>
</html>
