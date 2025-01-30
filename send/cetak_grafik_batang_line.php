<?php
require_once 'core/init.php';
require_once 'view/header.php';

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


  <div class="col-sm-3">
  <font color="blue"><b>PILIH BULAN</font><br></b>
    <select id="bulan" class="form-control ganti" name="bulan" required >
        <option value="">- Pilih Bulan -</option>
        <option value="1">JANUARI</option>
        <option value="2">FEBRUARI</option>
        <option value="3">MARET</option>
        <option value="4">APRIL</option>
        <option value="5">MEI</option>
        <option value="6">JUNI</option>
        <option value="7">JULI</option>
        <option value="8">AGUSTUS</option>
        <option value="9">SEPTEMBER</option>
        <option value="10">OKTOBER</option>
        <option value="11">NOVEMBER</option>
        <option value="12">DESEMBER</option>
    </select>
  </div>

    
  <div class="col-sm-3">
  <font color="blue"><b>PILIH LINE</font><br></b>
  <select id="line" class="form-control ganti" name="line" required>
     <option value="">- Pilih Line -</option>
       <?php
       $line2 = tampilkan_master_line_open();
       while($pilih2 = mysqli_fetch_assoc($line2)){ ?>
       <option value="<?= $pilih2['nama_line']; ?>"> <?= $pilih2['nama_line'] ?></option>;
<?php
       }
       ?>
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
    var bulan = $('#bulan').val();
    var line = $('#line').val();
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
    $.ajax({
			type : 'post',
			url	 : 'tampil_grafik_batang_line.php',
			data: { 
               bulan : bulan,
               line : line,
               costomer : costomer
            },
			success : function(data) {
			$('#tampil_tabel').html(data);//menampilkan data ke dalam modal
			}
		});

    // var url = "tampil_grafik_batang_line.php?bulan="+bulan+"&line="+line+"&costomer="+costomer;
    // $('#tampil_tabel').load(url);
  });

$(document).ready(function(){
    $('#tampil_tabel').load("kosong.php");
});


</script>


<script src="assets/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#line").select2({
                    theme: 'bootstrap4',
                    placeholder: "- Pilih Line -"
                });
            });
        </script>


</body>
</html>