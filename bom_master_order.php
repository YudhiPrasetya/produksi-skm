
<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>


<?php
  if(cek_status($_SESSION['username'] ) == 'admin' OR 
  cek_status($_SESSION['username'] ) == 'ppic') {
  $id = $_GET['id'];

  $sql = tampilkan_master_order_id($id); // memilih entri nim pada database
	$data = mysqli_fetch_array($sql);
  $category = $data['category'];
 
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
<h2>BOM MASTER ORDER</h2>
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
<div style="margin-left: 10px; margin-right: 10px">
<input type="hidden" name="id" value="<?= $id; ?>" id="id"> 
<div class="col-sm-3">
 <font color="blue"><b> COSTOMER</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <select id="costomer" class="form-control" name="costomer" disabled>
     <option value="">- Pilih Costomer -</option>
       <?php
       $costomer = tampilkan_master_costomer();
       while($hasil = mysqli_fetch_assoc($costomer)){
        if($hasil['id_costomer']==$data['id_costomer']){
             echo "<option value = '$hasil[id_costomer]' selected>$hasil[costomer]</option>";
           }else{
             echo "<option value = '$hasil[id_costomer]' >$hasil[costomer]</option>";
        }
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
   <input type="text" name="orc" class="form-control" placeholder="ORC" value="<?= $data['orc'] ?>"  id="orc" disabled>
   <!-- <input type="text" name="orc" id="orc2" hidden> -->
 </div>
 </div>
 
 <div class="col-sm-3">
 <font color="blue"><b>NO PO</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" name="po" class="form-control" placeholder="INPUT PO NUMBER" value="<?= $data['no_po']; ?>"  id="po" disabled>
 </div>
</div>

<div class="col-sm-3">
 <font color="blue"><b>NO LABEL</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-tags"></i>
   </div>
   <input type="text" name="label" class="form-control" placeholder="label" value="<?= $data['label']; ?>"  id="label" disabled>
 </div>
</div>
<br><br><br>

<div class="col-sm-2">
 <font color="blue"><b> Style</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-list-alt"></i>
   </div>
   <select id="style" class="form-control" name="style" disabled>
     <option value="">- Pilih Style -</option>
       <?php
       $style = tampilkan_style();
       while($hasil = mysqli_fetch_assoc($style)){
        if($hasil['id_style']==$data['id_style']){
          echo "<option value = '$hasil[id_style]' selected>$hasil[style]</option>";
        }else{
          echo "<option value = '$hasil[id_style]' >$hasil[style]</option>";
     }
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
   <input type="text" class="form-control" placeholder="Color" name="color" value="<?= $data['color'] ?>" id="color" disabled>
 </div>
 </div>

 <div class="col-sm-2">
 <font color="blue"><b>QTY ORDER</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-share"></i>
   </div>
   <input type="text" class="form-control" placeholder="QTY ORDER" name="qty_order" value="<?= $data['qty_order'] ?>" id="qty_order" disabled>
 </div>
 </div>

 <div class="col-sm-2">
 <font color="blue"><b>QTY BUNDLE</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-share"></i>
   </div>
   <input type="text" class="form-control" placeholder="QTY BUNDLE" name="qty_bundle" id="qty_bundle" value="<?= $data['qty_bundle'] ?>" disabled>
 </div>
 </div>

 <div class="col-sm-2" >
 <font color="blue"><b>PREPARE ON</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-share"></i>
   </div>
   <input type="date" class="form-control" placeholder="PREPARE ON" name="prepare_on" id="prepare_on" value="<?= $data['prepare_on'] ?>" disabled>
 </div>
 </div>

 <div class="col-sm-2">
 <font color="blue"><b>SHIPMENT PLAN</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-share"></i>
   </div>
   <input type="date" class="form-control" placeholder="SHIPMENT PLAN" name="shipment_plan" id="shipment_plan" value="<?= $data['shipment_plan'] ?>" disabled>
 </div>
 </div>
</div>


<br>
<center>
<table>
    <tr>
   
    <td style="padding-bottom: 20px">
      <a href="edit_master_order.php?id=<?= $id ?>" class="btn btn-success" name="edit_proses" style="margin-left: 35px; margin-top: 20px" ><i class="glyphicon glyphicon-edit"> </i> EDIT DATA</a>       
    </td>

    <td style="padding-right: 30px; padding-bottom: 20px">
      <a href="barcode_master_order.php?id=<?= $id ?>" class="btn btn-warning"  name="edit_proses" style="margin-left: 35px; margin-top: 20px" ><i class="glyphicon glyphicon-barcode"> </i> PRINT BARCODE</a>       
    </td>
    
    <td style="padding-right: 30px; padding-bottom: 20px">
    <button  type="button" class="btn btn-danger" id="generate_ulang_bom"  data-id="<?= $row['id_bom_detail']; ?>" ><i class="glyphicon glyphicon-refresh"></i> RESET KE MASTER BOM</button>
    </td>

    <td style="padding-right: 20px; ">
        <button  class="btn btn-md btn-primary cetak" id="tampil"><i class="glyphicon glyphicon-fullscreen"></i> TAMPIL BOM</button>  
    <td>



</tr>
</table>
</center>

<!-- <div id="hasil"></div> -->
<div id="tampil_tabel"></div>

<br>

<center>


<!-- <a href="hapus_temp_master_order.php" name="reset"><button type="button" class="btn btn-danger" onclick="return konfirmasi()">RESET</button></a> -->
</center>

<!-- Load file JS untuk JQuery dan Selec2.js melalui CDN -->


<script type="text/javascript" language="JavaScript">
  function konfirmasi_generate(){
    tanya = confirm("Anda Yakin Data yang akan tergenerate benar ?");
    if (tanya == true) return true;
    else return false;
  }
</script>

<script type="text/javascript">
 
$(document).ready(function(){
    var id = $('#id').val();
    var url = 'tampil_master_bom_orc.php?id=';
    urlid = url+id;
    $('#tampil_tabel').load(urlid);
});

</script>

<script type="text/javascript">
  $('#tampil').on('click',function(){
       var id = $('#id').val();
       url2 = "tampil_master_bom_orc.php?id="+id;
       $('#tampil_tabel').load(url2);
    });   
   
</script>

<script>
            $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
            setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
</script>
<script type="text/javascript">
$('#generate_ulang_bom').on('click',function(){
    var yakin = confirm("Anda Yakin Akan Mereset BOM ke MAStTER ?");
    if (yakin) {
        var id_order = $('#id_order').val();
  
        $.ajax({
          method: "POST",
          url: "generate_bom_orc.php",
          data: { id_order : id_order,
            type : "generate_ulang_bom"
          },
          success: function(data){
            console.log(data);
            if(data.trim() == "success"){
                url = "tampil_master_bom_orc.php?id="+id_order;
                $('#tampil_tabel').load(url);
                }else if(data.trim() == "error"){
                    alert("Gagal, Ada Masalah dengan Query, Hubungi IT");
                }
          }
        });
    }   
    
  });
</script>
<!-- // penutup hak akses level -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>



</html>
