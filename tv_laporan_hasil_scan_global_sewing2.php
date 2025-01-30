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
<title>LAPORAN SEWING PRODUCTION</title>
<!-- <h3>LAPORAN SEWING PRODUCTION</h3> -->
</center>
 

<div class="row" style="margin-left: 25px;">
   <button class="btn btn-warning" id="showFullScreen" onclick="showFullScreen()">Full Screen</button>
</div>

<div class="container-fluid" id="fullScreen">
  <div class="row" style="background-color: red; margin-bottom: 20px; margin-top: 20px; margin-left: 15px; margin-right: 15px; border-radius: 5px;">
      <center>
        <h2 style="color: white;"><strong>LAPORAN SEWING PRODUCTION</strong></h2>
      </center>
   </div>
   <div class="row">
      <div class="col-sm-4">
      <center><p style="font-size: x-large; color: white; margin-bottom: 0px;"><b>PROSES</b></p></center>
         <select id="lantai" class="form-control ganti" name="lantai" required>
            <option value="">- Pilih lantai -</option>
            <option value="1">LANTAI 1</option>
            <option value="2">LANTAI 2</option>
            <option value="3">LANTAI 3</option>
         </select>

      </div>


      <div class="col-sm-4">
      <center><p style="font-size: x-large; color: white; margin-bottom: 0px;"><b>CATEGORY</b></p></center>
         <select id="category" class="form-control ganti" name="category" required>
            <option value="">- Category -</option>
            <option value="UNDERWEAR">UNDERWEAR</option>
            <option value="OUTERWEAR">OUTERWEAR</option>
         </select>
      </div>

      <div class="col-sm-4">
      <center><p style="font-size: x-large; color: white; margin-bottom: 0px;"><b>CUSTOMER</b></p></center>
         <select id="costomer" class="form-control ganti" name="costomer" required>
            <option value="">- Pilih Costomer -</option>
            <?php
            $costomer = tampilkan_master_costomer();
            while ($pilih = mysqli_fetch_assoc($costomer)) {
               echo '<option value=' . $pilih['costomer'] . '>' . $pilih['costomer'] . '</option>';
            }
            ?>
         </select>
      </div>
   </div>
   <div class="row">
      <div class="col-12">
         <div id="tampil_tabel"></div>
      </div>
   </div>

   <div class="row" style="background-color: #528113; margin-bottom: 2px; margin-top: 2px; margin-left: 15px; margin-right: 15px; border-radius: 5px; vertical-align: middle; padding-top: 10px; padding-bottom: 10px;">
      <marquee direction="left">
         <p style="color: white; font-size: x-large; margin-bottom: 0px;">
            <b>Memulai seseuatu adalah hal yang berat. Namun, kontinu melakukan usahanya adalah hal yang tidak kalah berat.</b>
         </p>
      </marquee>
   </div>   
</div>


<script type="text/javascript">
   $('.ganti').on('change', function() {
      var url = "tampil_laporan_hasil_scan_global_sewing2.php";
      $('#tampil_tabel').load(url);

   });

   var elem = document.getElementById('fullScreen');

   function showFullScreen() {
      if (elem.requestFullscreen) {
         elem.requestFullscreen();
      } else if (elem.webkitRequestFullScreen) {
         elem.webkitRequestFullScreen();
      } else if (elem.msRequestFullScreen) {
         elem.msRequestFullScreen();
      }
   }
</script>



</body>
</html>
