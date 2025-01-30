<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<script src="assets/js/select2.min.js"></script>
<?php
  if(cek_status($_SESSION['username'] ) == 'admin' OR 
  cek_status($_SESSION['username'] ) == 'ie') {
  $id = $_GET['id'];
  $tgl = date("Y-m-d");
  $sql = tampilkan_master_line_id($id); // memilih entri nim pada database
  $data = mysqli_fetch_array($sql);
?>

<center>
<h2>REGISTER HRD OPERATOR</h2>
<div style="height:55px;">
                 <?php
                    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                    echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
                    }
                    $_SESSION['pesan'] = '';
                ?>
</div>
</center>
</div>
 
 <div style="margin: 10px">


<input type="hidden" name="id" value="<?= $id; ?>" id="id"> 
<div class="col-sm-3">
 <font color="blue"><b>NAMA LINE </font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" name="line" class="form-control" value="<?= strtoupper($data['nama_line']) ?>"  id="line" disabled>
 </div>
</div>

<div class="col-sm-3">
 <font color="blue"><b>LANTAI</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-edit"></i>
   </div>
   <input type="text" name="lantai" class="form-control" placeholder="LANTAI" value="<?= $data['lantai'] ?>"  id="lantai" disabled>
   <!-- <input type="text" name="orc" id="orc2" hidden> -->
 </div>
 </div>
 
 <div class="col-sm-3">
 <font color="blue"><b>SUPERVISOR</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" name="supervisor" class="form-control" placeholder="Supervisor" disabled value="<?= strtoupper($data['supervisor']); ?>"  id="po">
 </div>
</div>

<div class="col-sm-3">
 <font color="blue"><b>CHIEF</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-tags"></i>
   </div>
   <input type="text" name="chief" class="form-control" placeholder="Chief" value="<?= strtoupper($data['chief']); ?>" disabled  id="chief">
 </div>
</div>

<br><br><br>

<center>
      <a href="master-line.php" ><button class="btn btn-danger" type="button" >
      <i class="glyphicon glyphicon-arrow-left"></i><b>&nbsp; BACK MASTER LINE</b></button></a>
      <button class="btn btn-success" type="button" data-target="#tambah" data-toggle="modal" title="Tambah Data">
      <i class="glyphicon glyphicon-plus"></i><b>&nbsp; Register HRD Operator terbaru</b></button>


</center>
</div>
<!-- <div id="hasil"></div> -->
<div id="tampil_tabel"></div>

<center>


<!-- <a href="hapus_temp_master_order.php" name="reset"><button type="button" class="btn btn-danger" onclick="return konfirmasi()">RESET</button></a> -->
</center>

<!-- Modal Tambah -->
<div id="tambah" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>Tambah Data Qty Order per Size </b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <form name="modal_popup"  enctype="multipart/form-data" method="post">
        <input type="hidden" value="<?= $_SESSION['username'] ?>"  id="user">
        <input type="hidden" value="<?= $id ?>"  id="id_line">
          <div class="form-group">
            <label for="date">DATE</label>
            <div class="input-group">
            	<div class="input-group-addon">
              	<i class="glyphicon glyphicon-th-list" ></i>
              </div>
              <input type="date" name="date_register" id="date_register" class="form-control" placeholder="Pilih Tgl Register" value="<?= $tgl ?>" required />
            </div>
         
          </div>

          <div class="form-group">
          	<label for="qtyorder">JUMLAH REGISTER HRD</label>
           	<div class="input-group">
             	<div class="input-group-addon">
               	<i class="glyphicon glyphicon-text-width"></i>
              </div>
          		<input name="jml_register_hrd" id="jml_register_hrd" type="number" class="form-control"  required/>
            </div>
          </div>
             
         
        <div class="modal-footer">
          <input name="tambah" type="button" value="Tambah" id="button" class="btn btn-success" data-dismiss="modal"/>     
          </form>    
        </div>
                
      </div>
    </div>
  </div>            
</div>
<!-- Modal Tambah -->

<script type="text/javascript" language="JavaScript">
  function konfirmasi(){
    tanya = confirm("Anda Yakin Akan Menghapus Data ?");
    if (tanya == true) return true;
    else return false;
  }
</script>

<script type="text/javascript" language="JavaScript">
  function konfirmasi_generate(){
    tanya = confirm("Anda Yakin Data yang akan tergenerate benar ?");
    if (tanya == true) return true;
    else return false;
  }
</script>

<script type="text/javascript" language="JavaScript">
  function konfirmasi_simpan(){
    tanya2 = confirm("Yakin Data Sudah Benar dan ingin disimpan?");
    if (tanya2 == true) return true;
    else return false;
  }
</script>

<script type="text/javascript">
  $('#button').on('click',function(){
    var user = $('#user').val();
    var id = $('#id_line').val();
    var date_register = $('#date_register').val();
    var jml_register_hrd = $('#jml_register_hrd').val();
    $.ajax({
      method: "POST",
      url: "proses_register_hrd_operator.php",
      data: { id : id,
        date_register : date_register,
        jml_register_hrd : jml_register_hrd,
        user : user,
        type : "insert"
       },
      success: function(data){
        console.log(data);
        var id = $('#id').val();
        var url = 'tampil_master_line_register_hrd.php?id=';
        urlid = url+id;
        $('#tampil_tabel').load(urlid);
      }
    });

    document.getElementById("jml_register_hrd").value = "";

  });

$(document).ready(function(){
    var id = $('#id').val();
    var url = 'tampil_master_line_register_hrd.php?id=';
    urlid = url+id;
    $('#tampil_tabel').load(urlid);
});

</script>

<script src="assets/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                    $("#size").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select Size"
                });
            });  
        </script>

<script src="style/jquery.min.js"></script>
        <script>
            $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
            setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
</script>

<!-- // penutup hak akses level -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>
