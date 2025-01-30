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
<h3>LAPORAN REMINDER TARGET QC ENDLINE</h3>
<h5 style="color: red" >( MAXIMAL REPORT TAMPIL STANDAR JAM KERJA NORMAL )</h5>
    </div>

    <div class="col-sm-2">
  <font color="blue"><b>Pilihan</font><br></b>
    <select id="target" class="form-control ganti" name="target" required>
    <option value="">--PILIHAN--</option> 
    <option value="tidak">TIDAK CAPAI TARGET</option>
     <option value="target">CAPAI TARGET</option>

     </select>
    </div>

    <div class="col-sm-2">
  <font color="blue"><b>s/d Tanggal</font><br></b>
  <input type="date" id="tanggal" value="<?= date("Y-m-d") ?>" class="form-control ganti" required>
  </div>
    
  <div class="col-sm-1">
  <font color="blue"><b>JAM KE</font><br></b>
    <select id="jam" class="form-control ganti" name="jam" required>
  
     <option value="8">8</option>
     <option value="9">9</option>
     <option value="10">10</option>
     <option value="11">11</option>
     <option value="12">12-13</option>
     <!-- <option value="13">13</option> -->
     <option value="14">14</option>
     <option value="15">15</option>
     <!-- <option value="add">ADD +</option> -->
     </select>
    </div>

<div class="col-sm-2">
  <font color="blue"><b>PILIH LANTAI</font><br></b>
    <select id="lantai" class="form-control ganti" name="lantai" required >
        <option value="1">LANTAI 1</option>
        <option value="2">LANTAI 2</option>
        <option value="3">LANTAI 3</option>
    </select>
  </div>

  <div class="col-sm-2">
        <font color="blue"><b>LINE</font><br></b>
        <select id="line" class="form-control ganti" name="line" required >
        
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
  
  <br><br><br>
  <div class="col-sm-2">
    <font color="blue"><b> PO BUYER</font><br></b>
        <input type="text" id="no_po" class="form-control ganti" required>
    </div>




    <div class="col-sm-2">
    <font color="blue"><b> ORC</font><br></b>
        <input type="text" id="orc" class="form-control ganti" required>
    </div>

    <div class="col-sm-3">
        <font color="blue"><b> <input type="checkbox" class="ganti" id="check_style" value="pilih_style"> STYLE </b></font> ( CHECKLIST UTK FILTER = )<br>
        <input type="text" id="style" class="form-control ganti" required>
    </div>

    <div class="col-sm-1">
    <button type="button" id="refresh" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i> REFRESH</button>
    </div>  

    </div>
    <br><br><br>
<div id="tampil_tabel"></div>

<script type="text/javascript">

$("#lantai").change(function(){
            // variabel dari nilai combo box kendaraan
            var lantai = $("#lantai").val();

            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "ambil-data-select.php",
                data: { 
                    lantai : lantai,
                    type : "line_lantai"
                },
                success: function(data){
                   $("#line").html(data);
             }
       });
 });

 $("#tanggal").change(function(){
    document.getElementById("jam").value = "8";
 });


  $('.ganti').on('change',function(){
    var target = $('#target').val();
    
    var tanggal = $('#tanggal').val();
    var jam = $('#jam').val();
    var lantai = $('#lantai').val();
    var line = $('#line').val();
    var costomer = $('#costomer').val();
    var no_po = $('#no_po').val();
    var orc = $('#orc').val();
    var style = $('#style').val();
    var check_style = $("#check_style:checked").val();
    if(check_style=='pilih_style'){
      checkstyle = 'iya';
    }else{
      checkstyle = 'tidak';
    }
    $.ajax({
            type: "POST",
            dataType: "html",
            url: "tampil_laporan_reminder_qc_endline_all.php",
            data: { 
                target : target,
                tanggal : tanggal,
                jam : jam, 
                lantai : lantai, 
                line : line, 
                costomer : costomer, 
                no_po : no_po, 
                orc : orc,
                style : style,
                checkstyle : checkstyle
                },
            success: function(data){
               $("#tampil_tabel").html(data);
             }
       });
       
  });

  $('#refresh').on('click',function(){
    var target = $('#target').val();
    
    var tanggal = $('#tanggal').val();
    var jam = $('#jam').val();
    var lantai = $('#lantai').val();
    var line = $('#line').val();
    var costomer = $('#costomer').val();
    var no_po = $('#no_po').val();
    var orc = $('#orc').val();
    var style = $('#style').val();
    var check_style = $("#check_style:checked").val();
    if(check_style=='pilih_style'){
      checkstyle = 'iya';
    }else{
      checkstyle = 'tidak';
    }
    $.ajax({
            type: "POST",
            dataType: "html",
            url: "tampil_laporan_reminder_qc_endline_all.php",
            data: { 
                target : target,
                tanggal : tanggal,
                jam : jam, 
                lantai : lantai, 
                line : line, 
                costomer : costomer, 
                no_po : no_po, 
                orc : orc,
                style : style,
                checkstyle : checkstyle
                },
            success: function(data){
               $("#tampil_tabel").html(data);
             }
       });
  });

  $(document).ready(function(){
    $('#tampil_tabel').load("kosong.php");
});

$(document).ready(function(){
    
    var lantai = $("#lantai").val();

    // Menggunakan ajax untuk mengirim dan dan menerima data dari server
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "ambil-data-select.php",
        data: { 
                    lantai : lantai,
                    type : "line_lantai"
                },
        success: function(data){
        $("#line").html(data);
    }
    });

    
});


</script>


</body>
</html>
