

<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>


<?php
  
  if(cek_status($_SESSION['username'] ) == 'admin' OR 
  cek_status($_SESSION['username'] ) == 'ppic') {
  $id = $_GET['id'];

  if(isset($_POST['update'])){
    $idproses   = $_POST['id_proses'];
    $urutan   = $_POST['urutan'];

    
    $sql1 = cekUrutanProsesIdOrder($id, $urutan);
    $data4 = mysqli_fetch_array($sql1);
    
    
    
    if(!empty(trim($idproses)) && !empty(trim($urutan))){
      //query data po master
      if(edit_proses_orc_urutan($idproses, $urutan)){
        if($data4['nama_transaksi'] != null){
          $nama_transaksi = $data4['nama_transaksi'];
           $_SESSION['pesan'] = "Data Berhasil Diedit, cek urutan $urutan sebelumnya karena udah di pakai di proses $nama_transaksi";
        }else{
          $_SESSION['pesan'] = "Data Berhasil Diedit, tidak ada urutan yang sama"; 
        }
        // header('Location: master-po.php');
      } else {
        $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
      }
    }else{
      $_SESSION['pesan']='Ada data yang masih kosong, wajib di isi semua';
    }
  }
  

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


<h2>EDIT PROSES ORC</h2>
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
 <font color="blue"><b>PILIH COSTOMER</font><br></b>
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
</div>
<br><br><br>

<div class="col-sm-2" style="margin-left: 10px">
 <font color="blue"><b>Pilih Style</font><br></b>
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

 <div class="col-sm-2" style="margin-left: -20px">
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
<br><br><br>
  <h3>Proses Produksi </h3>
  <form action="generate_ulang_proses_orc.php" method="post">
      <input type="hidden" name="id_order" value="<?= $id; ?>">
  
  
      <br>
<div style="margin-left: 20px">
  <table>
    <tr>
     <?php 
          $i=0;
          $proses = tampilkan_transaksi_proses_category($category);
          while($data2 = mysqli_fetch_assoc($proses)){
            $i++;
            $transaksi = $data2['nama_transaksi'];
            if($i != 9){
          ?>
         <td width="180px">
          <input class="form-check-input" type="checkbox" name="proses[]" id="inlineCheckbox<?= $i; ?>" value="<?= $data2['nama_transaksi'] ?>" 
              <?php
                $proses2 = tampilkan_transaksi_proses_id($id);
                  while($data3 = mysqli_fetch_assoc($proses2)){
                    if( $transaksi == $data3['nama_transaksi'] ){
                      echo 'checked';
                    }
                }
            
              ?>>
          <label class="form-check-label" style="font-weight: normal" for="inlineCheckbox<?= $i; ?>"><?= strtoupper(($data2['nama_transaksi'] == "press" ? "washing" : $data2['nama_transaksi'])) ?></label>
        </td>
        <?php }else{ ?>
      </tr>
      <tr>
          <td width="150px">
          <input class="form-check-input" type="checkbox" name="proses[]" id="inlineCheckbox<?= $i; ?>" value="<?= $data2['nama_transaksi'] ?>" 
          <?php
                $proses2 = tampilkan_transaksi_proses_id($id);
                  while($data3 = mysqli_fetch_assoc($proses2)){
                    if( $transaksi == $data3['nama_transaksi'] ){
                      echo 'checked';
                    }
                }

              ?>>
          <label class="form-check-label" style="font-weight: normal" for="inlineCheckbox<?= $i; ?>"><?= strtoupper(($data2['nama_transaksi'] == "press" ? "washing" : $data2['nama_transaksi'])) ?></label>
        </td>
        <?php } } ?>
      </tr>
    </table>
    <br>
    <input type="submit" class="btn btn-primary form-control" name="generate" value="GENERATE PROSES"  onclick="return konfirmasi_generate()" style="width: 200px">
    </form>
</center>

<!-- <div id="hasil"></div> -->
<div id="tampil_tabel"></div>

<br>

<center>


<!-- <a href="hapus_temp_master_order.php" name="reset"><button type="button" class="btn btn-danger" onclick="return konfirmasi()">RESET</button></a> -->
</center>

<!-- Load file JS untuk JQuery dan Selec2.js melalui CDN -->


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
 
$(document).ready(function(){
    var id = $('#id').val();
    var url = 'tampil_proses_orc.php?id=';
    urlid = url+id;
    $('#tampil_tabel').load(urlid);
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
