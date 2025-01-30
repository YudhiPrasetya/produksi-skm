<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');'
if( !isset($_SESSION['username']) ){
  echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
  // header('Location: index.php');    
}
if(cek_status($_SESSION['username'] ) == 'admin') {
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
<center>

<h3 >MASTER BOM CUTTING</h3>
</center><br>

    </div>
<div class="container-fluid">
  <div class="col-sm-5">
    
    <font color="blue"><b>PILIH STYLE</font><br></b>
    <input type="text" class="form-control pilcek" id="style" style="width: 280px; display: inline-block" disabled >
    <input type="hidden" id="id_style">
     
      <button type="button" class="btn btn-info" style="margin: 0px 0 0 7px;" data-toggle="modal" data-target="#not_yet"><b><span class="glyphicon glyphicon-search"></span> NOT YET</b></button>
      <button type="button" class="btn btn-danger" style="margin: 0px 0 0 7px;" data-toggle="modal" data-target="#already"><b><span class="glyphicon glyphicon-search"></span> ALREADY</b></button>
  </div>

  <div class="col-sm-4" >
 <font color="blue"><b>DESCRIPTION</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" id="description" class="form-control" disabled />
 </div>
</div>

<div class="col-sm-1">
<button  class="btn btn-md btn-primary cetak" id="tampil" style="margin-top: 20px"><i class="glyphicon glyphicon-fullscreen"></i> TAMPIL BOM</button>  
</div>

<!-- <div class="col-sm-1">
<button  class="btn btn-md btn-danger cetak" id="reload" style="margin-top: 20px"><i class="glyphicon glyphicon-refresh"></i> RELOAD</button>  
</div> -->
</div>

<br>
<div id="tampil_tabel" style="padding-left: 20px; padding-right: 20px;"></div>

<!-- Modal SEARCH NOT YET -->
<div class="modal fade" id="not_yet" class="modal-backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>DATA STYLE NOT YET</b></font></h4>
      </div>
      <div id="not_yet_view"></div>
  </div>
  </div>            
</div>
<!-- Modal SEARCH NOT YET -->
</form>

<!-- Modal SEARCH ALREADY -->
<div class="modal fade" id="already" class="modal-backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>DATA STYLE ALREADY</b></font></h4>
      </div>
      <!-- body modal -->
      <div id="already_view"></div>
  </div>
  </div>            
</div>
<!-- Modal SEARCH ALREADY -->
</form>


<script type="text/javascript">
   
      $(document).on('click', '.pilih', function (e) {
        document.getElementById("id_style").value = $(this).attr('data-id');
        document.getElementById("style").value = $(this).attr('data-style');
        document.getElementById("description").value = $(this).attr('data-description');
        $('#myModal').modal('hide');

        var id_style = $('#id_style').val();
        url = "tampil_master_bom.php?id="+id_style;
        $('#tampil_tabel').load(url);
        });

// tabel lookup mahasiswa
    $(function () {
      $("#lookup").dataTable();
    });


</script>

<!-- Script ajax menampilkan Edit kelas -->
<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#not_yet', function (e) {
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'modal_style_bom.php',
			data : { keterangan : 'not_yet'
       },
			success : function(data) {
			$('#not_yet_view').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#already', function (e) {
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'modal_style_bom.php',
			data : { keterangan : 'already'
       },
			success : function(data) {
			$('#already_view').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>

<script type="text/javascript">
  $('#tampil').on('click',function(){
       var id = $('#id_style').val();
       url2 = "tampil_master_bom.php?id="+id;
       $('#tampil_tabel').load(url2);
    });   
   
</script>
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>
