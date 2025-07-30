<?php

require_once 'core/init.php';
require_once 'view/header.php';
$_SESSION["last_login_time"] = time();
if( isset($_SESSION['username'])){
  header('Location: cetak_laporan_hasil_scan_global.php');
}
ini_set('session.gc_maxlifetime', 36000);
session_set_cookie_params(36000);
session_start();
?>
<style>
/* Bordered form */
/* Full-width inputs */
input[type=text], input[type=password] {
  width: 100%;
  padding: 8px 20px;
  margin: 10px 0;
  /* display: inline-block; */
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #254681;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the avatar image inside this container */
.imgcontainer {
  text-align: center;
  margin: 15px 0 12px 0;
}

/* Avatar image */
img.avatar {
  width: 15%;
  /* border-radius: 50%; */
}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;
}

.alert{
	/* background: #e44e4e; */
	color: red;
	padding: 10px;
	text-align: center;
	border:1px solid #b32929;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }

}

</style>

<center>
<h2><font color="red"><b><u>SISTEM PRODUKSI<br>PT. Globalindo Intimates</u></b></font></h2>
</center>
<div style="height:35px;">
  <?php
    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
      echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
    }
      $_SESSION['pesan'] = '';
    ?>
</div>
  <div class="col-sm-12" >
  <center><h4><b><u>LOGIN SISTEM<br>BY SCAN</u></b></h4></center>
  <div class="imgcontainer" style="margin-top: -15px">
    <img src="img/barcode-qr.png" alt="Avatar" width="300px">
    <br>


   <font color="blue"><b style="font-size: 20px">SCAN BARCODE USER DISINI <br><br></b>
   
    <i class="glyphicon glyphicon-arrow-down" style="font-size: 25px"></i><i class="glyphicon glyphicon-arrow-down" style="font-size: 25px"></i><i class="glyphicon glyphicon-arrow-down" style="font-size: 25px"></i></font>
    <br><br>
    <input type="text" class="form-control" placeholder="SCAN BARCODE USER UNTUK LOGIN SISTEM INI" name="kode_barcode" id="kode_barcode" autofocus required>

    
   <!-- <input type="text" class="form-control" placeholder="KODE BARCODE" name="kode_barcode" id="kode_barcode" autofocus required> -->
   <input type="submit"  name="submit_barcode" value="TAMBAH" id="submit_barcode" hidden>
   
   <a href="index_akun.php"><button type="submit" name="submit" style="margin-top: 18px">LOGIN PAKAI AKUN</button></a>
</div>
  </div>
  </div>
 
</body>
</html>

<!-- Melihat Password -->
<script>
   function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<script type="text/javascript"> 
  $('#kode_barcode').on('change',function(){
    var barcode = $('#kode_barcode').val();
    $.ajax({
      method: "POST",
      url: "proses_login.php",
      data: { isi_barcode : barcode
      },
      success: function(data){
        console.log(data.trim());
        if(data.trim() == "cutting"){
          window.location.href = 'temp_cutting.php';
        }else if(data.trim() == "press"){
          window.location.href = 'temp_press.php';
        }else if(data.trim() == "moulding"){
          window.location.href = 'temp_moulding.php';
        }else if(data.trim() == "bemis"){
          window.location.href = 'temp_bemis.php';
        }else if(data.trim() == "qc_cutpart"){
          window.location.href = 'temp_qc_cutpart.php';
        }else if(data.trim() == "preparation"){
          window.location.href = 'temp_preparation.php';
        }else if(data.trim() == "ht"){
          window.location.href = 'temp_ht.php';
        }else if(data.trim() == "trimstore"){
          window.location.href = 'temp_trimstore.php';
        }else if(data.trim() == "sewing"){
          window.location.href = 'temp_sewing.php';
        }else if(data.trim() == "bbl"){
          window.location.href = 'temp_bbl.php';
        }else if(data.trim() == "qc_endline"){
          window.location.href = 'temp_qc_endline.php';
        }else if(data.trim() == "qc_buyer"){
          window.location.href = 'temp_qc_buyer.php';
        }else if(data.trim() == "ht_after"){
          window.location.href = 'temp_ht2.php';
        }else if(data.trim() == "washing"){
          window.location.href = 'temp_washing.php';
        }else if(data.trim() == "iron"){
          window.location.href = 'temp_iron.php';
        }else if(data.trim() == "qc_transfer"){
          window.location.href = 'temp_qc_transfer.php';
        }else if(data.trim() == "tatami_in"){
          window.location.href = 'temp_tatami_in2.php';
        }else if(data.trim() == "tatami"){
          window.location.href = 'temp_tatami.php';
        }else if(data.trim() == "report"){
          window.location.href = 'cetak_laporan_hasil_scan_global.php';
        }else if(data.trim() == "warehouse" || data.trim() == "team_sample" || data.trim() == "ppm"
        || data.trim() == "pattern_check" || data.trim() == "moulding_bounding"
        || data.trim() == "template_sewing" || data.trim() == "machines_setting" || data.trim() == "layout"|| data.trim() == "ready_produksi"){
          window.location.href = 'temp_preparation_production.php';
        }else if(data.trim() == "not_valid"){
          alert("Belum Terdaftar Disistem Hubungi IT");
        }else if(data.trim() == "pass_salah"){
          alert("Password Salah");
        }
      }
    });
    document.getElementById("kode_barcode").value = "";
  });

  $(document).ready(function(){
    $('#tampil_tabel').load("tampil_tatami_reject.php");
  });

  let inputStart, inputStop;

$("#kode_barcode")[0].onpaste = e => e.preventDefault();
// handle a key value being entered by either keyboard or scanner
var lastInput

let checkValidity = () => {
    if ($("#kode_barcode").val().length < 10) {
      $("#kode_barcode").val('')
  } else {
    $("body").append($('<div style="background:green;padding: 5px 12px;margin-bottom:10px;" id="msg">ok</div>'))
  }
  timeout = false
}

let timeout = false
$("#kode_barcode").keypress(function (e) {
  if (performance.now() - lastInput > 1000) {
    $("#kode_barcode").val('')
  }
    lastInput = performance.now();
    if (!timeout) {
    timeout = setTimeout(checkValidity, 200)
  }
});
</script>
<script>
  $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
  setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
</script>

