<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');

?>

<body>
 
	<style>
    td{
        text-align: center;
    }
	
 
	.jam-digital-malasngoding {
		overflow: hidden;
		width: 220px;
		margin: 5px auto;
		border: 5px solid #efefef;
	}
	.kotak{
		float: left;
		width: 100px;
		height: 100px;
		background-color: #189fff;
        border: 5px solid #efefef;
	}
	.jam-digital-malasngoding p {
		color: #fff;
		font-size: 36px;
		text-align: center;
		margin-top: 30px;
	}
 

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


/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}




/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;
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

	<h2>REMINDER TARGET QC ENDLINE</h2>
</center>
 <?php
 $hari = tgl_indonesia_hari(date("Y-m-d"));
 ?>
<div class="row">
<div class="col-sm-7"><br>
<div class="jam-digital-malasngoding">
<center><b><font color="blue">
<?= tgl_indonesia5(date("Y-m-d")); ?>  </b>  
   

<br><b>JAM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp; MENIT </font></b></center>
	<div class="kotak">
		<p id="jam"></p>
        
	</div>
	<div class="kotak">
		<p id="menit"></p>
	</div>
	<!-- <div class="kotak">
		<p id="detik"></p>
	</div> -->
   
    <select id="jam_normal" class="form-control ganti" name="jam_normal" required >
        <option value="5" <?php if($hari == 'SABTU'){ echo 'selected'; } ?>>5 JAM KERJA</option>
        <option value="7" <?php if($hari != 'SABTU'){ echo 'selected'; } ?>>7 JAM KERJA</option>
    </select>
    <input type="hidden" id="lantai" value="<?= $_GET['lantai'] ?>">
    <!-- <select id="lantai" class="form-control ganti" name="lantai" required >
        <option value="1">LANTAI 1</option>
        <option value="2">LANTAI 2</option>
        <option value="3">LANTAI 3</option>
    </select> -->
    <audio id="myAudio1">
        <source src="audio/no_target1.mp3" type="audio/mpeg" >
    </audio>
    <audio id="myAudio2">
        <source src="audio/target_all.mp3" type="audio/mpeg" >
    </audio>
    <audio id="myAudio3">
        <source src="audio/no_input_master_target.mp3" type="audio/mpeg" >
    </audio>
</div> 
</div>
<div class="col-sm-4">
    <br><br>
    <label for="password"><b>Kode Akses Off / On Suara</b></label>
    <input type="password" placeholder="Masukkan Kode Akses Off Suara" name="password" id="password" class="form-control" required>
    <input type="checkbox" id="show-hide" onclick="myFunction()">
    <label for="show-hide" style="color:blue">Show Kode Akses</label><br>
   
    <button class="btn btn-danger suara" disabled id="off_suara"  name="submit"><i class="glyphicon glyphicon-volume-off"></i>&nbsp;&nbsp; MATIKAN SUARA</button>
    <button class="btn btn-success suara" disabled id="on_suara"  name="submit"><i class="glyphicon glyphicon-volume-up"></i>&nbsp;&nbsp; BUNYIKAN SUARA</button>
</div>

<div class="col-sm-1">

</div>    
</div>
<br>
</div>

<div style="margin: 10px">
    <div class="col-sm-6" style="margin-top: 8px">
    <b>REMINDER LIST ORDER RUNNING YANG TIDAK MENCAPAI TARGET PER JAM:</b>
    <br><br>
    </div>
    <table border="1px"  class="table table-striped table-bordered row-border order-column display " id="example" style="font-size: 12px;">
  
  <thead>
      <tr>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>NO</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>COSTOMER</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>NO PO</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>ITEM</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>ORC</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>STYLE</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>COLOR</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>LINE</th>
      <th  style="text-align: center; background: #1E90FF" >JAM </th>
      <th  style="text-align: center; background: #1E90FF" >TARGET </th>
      <th  style="text-align: center; background: #1E90FF" colspan=2>QTY PER JAM</th>

      </tr> 
      <tr>
      
        <th  style="text-align: center; background: #1E90FF" >NORMAL</th>
        <th  style="text-align: center; background: #1E90FF" >@ JAM</th>
        <th  style="text-align: center; background: #1E90FF" >OUTPUT</th>
        <th  style="text-align: center; background: #1E90FF" >BALANCE</th>
      </tr>
</thead>
<tbody>
</tbody>

</table>



</div>

<script>
	window.setTimeout("waktu()", 1000);
	function waktu() {
		var waktu = new Date();
		setTimeout("waktu()", 60000);
        var menit = waktu.getMinutes();
        var jam = waktu.getHours();
        var hari = waktu.getDay();
        var jam_normal = document.getElementById('jam_normal').value;
        var lantai = document.getElementById('lantai').value;
		document.getElementById("jam").innerHTML = ("0"+waktu.getHours()).slice(-2);
		document.getElementById("menit").innerHTML = ("0"+waktu.getMinutes()).slice(-2);
		// document.getElementById("detik").innerHTML = waktu.getSeconds();
        var menit = waktu.getMinutes();
        var jam = waktu.getHours();

        if(jam_normal == 7){
           var sd_jam = 15;
            if(jam <= sd_jam){
                $('#example').DataTable().ajax.reload(null, false);
            }
        }else if(jam_normal == 5){
           var sd_jam = 12;
            if(jam <= sd_jam){
                $('#example').DataTable().ajax.reload(null, false);
            }
        }
        
        if(hari == 7){
            var not_jam = 13;
        }else{
            if(lantai == 1){
               var not_jam = 13;
            }else{
               var not_jam = 12;
            }
        }

        if(jam == 12){
            sd_menit = 0;
        }else{
            sd_menit = 5;
        }
      
        if((jam <= sd_jam)){
            if(jam != not_jam){
            if(menit == sd_menit){ 
                $.ajax({
                method: "POST",
                url: "proses_reminder_target.php",
                data: { lantai : lantai,
                        jam: jam,
                        type : "target_qc_endline",

                },
                success: function(data){
                console.log(data.trim());
                if(data.trim() == "not_target"){
                    var x = document.getElementById("myAudio1"); 
                    x.loop = true;
                    x.play(); 
                }else if(data.trim() == "no_master_target"){
                    var z = document.getElementById("myAudio3"); 
                    z.play();
                }else if(data.trim() == "target_all"){
                    var y = document.getElementById("myAudio2");
                    y.play(); 
                }
            }
            });
            }
        }
        }
	}

    $('#password').change(function(){
        if($(this).val != ''){
            $('.suara').removeAttr('disabled');
        }
    });

    

    $('#off_suara').on('click',function(){   
        var kode_akses = document.getElementById('password').value;
        if(kode_akses == ""){
            Swal.fire({
                        type: 'error',
                        title: 'Gagal, Kode_akses masih kosong',
                        text: 'Silakan Masukkan Kode Akses terdaftar terlebih dahulu',
                        allowEnterKey: false,  
            });
        }
        $.ajax({
                method: "POST",
                url: "proses_reminder_target.php",
                data: { kode_akses : kode_akses,
                        type : "kontrol_suara",

                },
                success: function(data){
                console.log(data.trim());
                if(data.trim() == "success"){
                    var x = document.getElementById("myAudio1"); 
                    x.pause(); 
                }else if(data.trim() == "kode_akses_salah"){
                    swal("Gagal Kode Akses Yang di Masukkan Salah", "Silahkan Coba lagi atau, Hubungi IT", "error");
                }else if(data.trim() == "kosong"){
                    swal("Gagal Kode Akses Masih Kosong", "Silahkan Isi Terlebih dahulu !", "error");
                }
            }
            });
            document.getElementById("password").value = "";
            $(".suara").attr("disabled", true);
    });

    $('#on_suara').on('click',function(){   
        var kode_akses = document.getElementById('password').value;
        if(kode_akses == ""){
            Swal.fire({
                        type: 'error',
                        title: 'Gagal, Kode_akses masih kosong',
                        text: 'Silakan Masukkan Kode Akses terdaftar terlebih dahulu',
                        allowEnterKey: false,  
            });
        }
        $.ajax({
                method: "POST",
                url: "proses_reminder_target.php",
                data: { kode_akses : kode_akses,
                        type : "kontrol_suara",

                },
                success: function(data){
                console.log(data.trim());
                if(data.trim() == "success"){
                    var x = document.getElementById("myAudio1"); 
                    x.loop = true;
                    x.play(); 
                }else if(data.trim() == "kode_akses_salah"){
                    swal("Gagal Kode Akses Yang di Masukkan Salah", "Silahkan Coba lagi atau, Hubungi IT", "error");
                }else if(data.trim() == "kosong"){
                    swal("Gagal Kode Akses Masih Kosong", "Silahkan Isi Terlebih dahulu !", "error");
                }
            }
            });
            document.getElementById("password").value = "";
            $(".suara").attr("disabled", true);
            
    });

    function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };

    $(document).ready(function(){
        $(document).on("keydown", disableF5);

    });

    $(document).ready(function() {
       
        var lantai = $('#lantai').val();
 
            $('#example').DataTable({
              "colReorder": true,
                "processing": true,
                "serverSide": true,
                "deferRender":    true,
                "scrollY":        500,
                "scrollCollapse": true,
                "scroller":       true,
                "aLengthMenu": [[20, 50, 75, -1], [20, 50, 75, "All"]],
                "order": [], 
                "ajax":{
                        "url": "tampil_laporan_reminder_qc_endline_ss.php",
                        "dataType": "json",
                        "type": "POST",
                        "data" : {
                            "action" : "table_data",
                            "lantai" : lantai,
                        },
                    },
                   
                "columns": [
                    { "data": "no" },
                    { "data": "costomer" },
                    { "data": "no_po" },
                    { "data": "item" },
                    { "data": "orc" },
                    { "data": "style" },
                    { "data": "color" },
                    { "data": "line" },
                    { "data": "jml_jam_normal" },
                    { "data": "target_jam" },
                    // { "data": "jam_ke" },
                    // { "data": "total_target_jam_ke" },
                    { "data": "total_output" },
                    { "data": "balance_target" },                                                              
                 ],                                                                                                                                                    
                });
    });                                                                                                                                                                                                                                                      
</script>
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
</body>
</html>