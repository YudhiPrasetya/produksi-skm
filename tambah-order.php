<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'ppic') {

 
?>
  
<style>
 ul.list-unstyled{
        background-color:#eee;
        cursor:pointer;
        position: absolute;
        width: 93%;
        padding-left:40px;
        z-index: 3;
      }
      li.size{
        padding:5px;
        border:thin solid #F0F8FF;
        z-index: 2;
        padding-left:30px;
      }
      li.size:hover{
        background-color:#1E90FF;
        z-index: 2;
        padding-left:30px;
      }
</style>
<center>
<h2>Tambah Data Master Order</h2>
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
<form action="master-order.php" method="post">


<div class="col-sm-3">
 <font color="blue"><b>PILIH BUYER</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <select id="costomer" class="form-control" name="costomer" required>
     <option value="">- Pilih Costomer -</option>
       <?php
       $costomer = tampilkan_master_costomer();
       while($pilih = mysqli_fetch_assoc($costomer)){
       echo '<option value='.$pilih['id_costomer'].'>'.$pilih['costomer'].'</option>';

       }
       ?>
     </select>
 </div>
</div>

<div class="col-sm-3">
 <font color="blue"><b>ORC</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-edit"></i>
   </div>
   <input type="text"  class="form-control"  name="orc" placeholder="ORC" name="orc2" id="orc">
   <input type="hidden" class="form-control"  name="orc2" id="orc2">
 </div>
 </div>
 
 <div class="col-sm-3">
 <font color="blue"><b>Pilih PO</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" name="po" class="form-control" placeholder="INPUT PO NUMBER"  id="po">
 </div>
</div>

<div class="col-sm-3">
 <font color="blue"><b>Pilih LABEL</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-tags"></i>
   </div>
   <input type="text" name="label" class="form-control" placeholder="label" value='-'  id="label">
 </div>
</div>
<br>
<br>
<br>
<br>
<div class="col-sm-2">
 <font color="blue"><b>Pilih Style</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-list-alt"></i>
   </div>
   <select id="style" class="form-control" name="style" required>
     <option value="">- Pilih Style -</option>
       <?php
       $style = tampilkan_style();
       while($pilih = mysqli_fetch_assoc($style)){
       echo '<option value='.$pilih['id_style'].'>'.$pilih['style'].'</option>';

       }
       ?>
     </select>
 </div>
</div>

 <div class="col-sm-2">
 <font color="blue"><b>Color</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-tint"></i>
   </div>
   <input type="text" class="form-control" placeholder="Color" name="color" id="color" required>
 </div>
 </div>

 <div class="col-sm-2">
 <font color="blue"><b>QTY ORDER</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-share"></i>
   </div>
   <input type="text" class="form-control" placeholder="QTY ORDER" name="qty_order"  id="qty_order" required>
 </div>
 </div>

 <div class="col-sm-2">
 <font color="blue"><b>QTY BUNDLE</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-share"></i>
   </div>
   <input type="text" class="form-control" placeholder="QTY BUNDLE" name="qty_bundle"  id="qty_bundle" >
 </div>
 </div> 

 <div class="col-sm-2" >
 <font color="blue"><b>PREPARE ON</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-share"></i>
   </div>
   <input type="date" class="form-control" placeholder="PREPARE ON" name="prepare_on" id="prepare_on" >
 </div>
 </div>

 <div class="col-sm-2">
 <font color="blue"><b>SHIPMENT PLAN</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-share"></i>
   </div>
   <input type="date" class="form-control" placeholder="SHIPMENT PLAN" name="shipment_plan" id="shipment_plan" >
 </div>
 </div>
      </div>
<br><br><br>
<center>

<button class="btn btn-success" type="button" data-target="#tambah" data-toggle="modal" title="Tambah Data">
<i class="glyphicon glyphicon-plus"></i><b>&nbsp; Tambah QTY Per Size</b></button>
</center>

<!-- <div id="hasil"></div> -->
<div id="tampil_tabel"></div>

<br>

<center>
  <!-- <button type="button" class="btn btn-danger" >RESET</button> -->
  <INPUT type="submit" class="btn btn-primary" name="kirim" value="SIMPAN DATA" onclick="return konfirmasi_simpan()" id="submit_barang" style="margin-right: 40px; margin-top: 20px">

  </form> 
  <!-- <button name="kirim" type="submit" class="btn btn-primary" onclick="return konfirmasi_simpan()">SIMPAN DATA</button> -->
<!-- <a href="simpan_master_order.php" name="simpan"><button type="button" class="btn btn-primary" onclick="return konfirmasi_simpan()">SIMPAN</button></a> -->
<a href="hapus_temp_master_order.php" name="reset"><button type="button" class="btn btn-danger" onclick="return konfirmasi()">RESET</button></a>
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
          <div class="form-group">
            <label for="size">Pilih Size</label>
            <div class="input-group">
            	<div class="input-group-addon">
              	<i class="glyphicon glyphicon-th-list" ></i>
              </div>
              <select id="size" class="form-control" name="size" required style="width: 100%">
                <option value="">- Pilih SIZE -</option>
                <?php
                  $size = tampilkan_master_size();
                  while($pilih = mysqli_fetch_assoc($size)) {
                    echo '<option value='.$pilih['size'].'>'.$pilih['size'].'</option>';
                  }
                ?>
          </select>
              <!-- <input type="text" name="size" id="size" class="form-control" onkeyup="this.value.toUpperCase()" placeholder="Ketikkan Size" /> -->
            </div>
           
          </div>

          <div class="form-group">
          	<label for="cup">CUP</label>
           	<div class="input-group">
             	<div class="input-group-addon">
               	<i class="glyphicon glyphicon-th-list"></i>
              </div>
          		<!-- <input name="cup" id="cup" onkeyup="this.value.toUpperCase()" type="text" class="form-control"  required/> -->
              <select id="cup" class="form-control" name="cup" required style="width: 100%">
                  <option value="">- Pilih Cup -</option>
                  <?php
                    $cup = tampilkan_master_cup();
                    while($pilih = mysqli_fetch_assoc($cup)) {
                      echo '<option value='.$pilih['cup'].'>'.$pilih['cup'].'</option>';
                    }
                  ?>
                </select>
            </div>
          </div>
                  
          <div class="form-group">
          	<label for="qtyorder">Qty Order</label>
           	<div class="input-group">
             	<div class="input-group-addon">
               	<i class="glyphicon glyphicon-text-width"></i>
              </div>
          		<input name="qtyorder" id="qtyorder" type="number" class="form-control"  required/>
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
  function konfirmasi_simpan(){
    tanya2 = confirm("Yakin Data Sudah Benar dan ingin disimpan?");
    if (tanya2 == true) return true;
    else return false;
  }
</script>


<script type="text/javascript">
  $('#button').on('click',function(){
    var size = $('#size').val();
    var cup = $('#cup').val();
    var qtyorder = $('#qtyorder').val();
    var user = $('#user').val();
    var orc = $('#orc').val();
    var color = $('#color').val();
    var style = $('#style').val();
    var costomer = $('#costomer').val();
    console.log(orc);
    document.getElementById("orc2").value = orc;
    $.ajax({
      method: "POST",
      url: "proses_temp_order.php",
      data: { size : size,
        cup : cup,
        qtyorder : qtyorder,
        user : user,
        orc : orc,
        style : style,
        color : color,
        costomer : costomer,
        type : "insert"
       },
      success: function(data){
        console.log(data);
        $('#tampil_tabel').load("tampil_temp_order.php");
      }
    });
    var orc = $('#orc').val();
   
    $("#orc").attr('disabled','disabled');
    $("#orc").attr("name","orc1");
    $("#orc2").attr("name","orc");
    $("#size").val('').trigger('change');
    document.getElementById("cup").value = "";
    document.getElementById("qtyorder").value = "";
  });

$(document).ready(function(){
    $('#tampil_tabel').load("tampil_temp_order.php");
});

</script>

<script src="style/jquery.min.js"></script>
        <script>
            $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
            setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
</script>

<script src="assets/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#style").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
    
                $("#size").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select Size"
                });
            });
        </script>

<!-- // penutup hak akses level -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>
