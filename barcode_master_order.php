
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
  $prosesTrans = [];
 
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
<h2>Master Order Print Barcode</h2>
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
<br><br><br>

<div class="col-sm-2">
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
  <br>
  <h3>Proses Produksi </h3>
<form action="generate_bundle.php" method="post"> 
<div style="margin: 20px">
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
          <input class="form-check-input" type="checkbox" name="proses[]" id="inlineCheckbox<?= $i; ?>" value="<?= $transaksi; ?>" 
              <?php 
              if(cek_master_bundle($id) != 0){
                  $proses2 = tampilkan_transaksi_proses_id($id);
                  while($data3 = mysqli_fetch_assoc($proses2)){
                    if( $transaksi == $data3['nama_transaksi'] ){
                      echo 'checked disabled';
                    } 
                  } 
              }else{
                if($transaksi == 'cutting'  || $transaksi == 'trimstore'
                  || $transaksi == 'sewing' || $transaksi == 'qc_endline' || $transaksi == 'qc_buyer' ){
                  echo 'checked ';
                  }
              }
              
              ?>>
          <label class="form-check-label" style="font-weight: normal" for="inlineCheckbox<?= $i; ?>"><?= strtoupper($transaksi) ?></label>
        </td>
        <?php }else{ ?>
      </tr>
      <tr>
          <td width="180px">
          <input class="form-check-input" type="checkbox" name="proses[]" id="inlineCheckbox<?= $i; ?>" value="<?= $data2['nama_transaksi'] ?>" 
              <?php 
              if(cek_master_bundle($id) != 0){
                  $proses2 = tampilkan_transaksi_proses_id($id);
                  while($data3 = mysqli_fetch_assoc($proses2)){
                    if( $transaksi == $data3['nama_transaksi'] ){
                      echo 'checked disabled';
                    }
                  }  
              }else{
                if($transaksi == 'cutting' || $transaksi == 'qc_cutput' || $transaksi == 'preparation' || $transaksi == 'trimstore'
                  || $transaksi == 'sewing' || $transaksi == 'qc_endline' || $transaksi == 'tatami' || $transaksi == 'packing' || $transaksi == 'shipment'){
                  echo 'checked ';
                  }
              }
              ?>>
          <label class="form-check-label" style="font-weight: normal" for="inlineCheckbox<?= $i; ?>"><?= strtoupper($transaksi) ?></label>
        </td>
        <?php } } ?>
      </tr>
    </table>
  <table>
    <tr>
      <!-- <td >   
<a href="print_barcode_size_all.php?id=<//?= $id ?>" class="btn btn-success" name="print_all"  target="_blank" >PRINT BARCODE</a>

</td>  -->
    <td style="padding-right: 30px; padding-bottom: 20px">
      <a href="edit_master_order.php?id=<?= $id ?>" class="btn btn-success" name="edit_proses" style="margin-left: 35px; margin-top: 20px" ><i class="glyphicon glyphicon-edit"> </i> EDIT DATA</a>       
    </td>

    <td style="padding-right: 30px; padding-bottom: 20px">
      <a href="edit_proses_orc.php?id=<?= $id ?>" class="btn btn-info" name="master_bundle" style="margin-top: 20px" ><i class="glyphicon glyphicon-edit"> </i> EDIT PROSES</a>       
    </td>

    <td style="padding-right: 30px; padding-bottom: 20px">
      <a href="master-bundle.php?id=<?= $id ?>" class="btn btn-danger" name="master_bundle" style="margin-top: 20px" ><i class="glyphicon glyphicon-th"> </i> MASTER BUNDLE</a>       
    </td>

   <input type="hidden" name="id_order" value="<?= $data['id_order']; ?>">
   <input type="hidden" name="orc" value="<?= $data['orc']; ?>">
   <input type="hidden" name="qty_bundle" value="<?= $data['qty_bundle']; ?>">
   <?php if(cek_master_bundle($id) == 0){ ?>
   
    <td>
   <input type="submit" class="btn btn-primary form-control"  <?php if($data['qty_bundle'] == 0) { echo 'disabled'; } ?>  name="generate" value="GENERATE BUNDLE"  onclick="return konfirmasi_generate()">
</form>

    <?php }else{ ?>
      </form>
    </td>
      <td style="padding-right: 20px; ">
      <form action="bundle_record.php" method="post"  target="_blank" >
      <input type="hidden" name="id_order" value=<?= $id ?>>
      <select name="ukuran_kertas" class="form-control" id="ukuran_kertas" required>
        <option value="">Ukuran Kertas</option>
        <option value="a4">A4</option>
        <option value="f4" selected>F4</option>
      </select>
      </td>
      <!-- <td style="padding-bottom: 20px">
      <button type="submit" class="btn btn-primary"  name="print_all">PRINT BUNDLE</button> -->
    </form>  
    <!-- </td> -->
    <form action="print_bundle_record_new.php" method="post"  target="_blank" >  
    <td style="padding-left: 20px; padding-bottom: 20px">
      <input type="hidden" name="id_order" value=<?= $id ?>>
      <input type="hidden" name="ukuran_kertas" id="ukuran_kertas2" class="ukuran_kertas" required>
      <button type="submit" class="btn btn-info"  name="print_all">PRINT BUNDLE IN OUT</button>
    </td>
    </form>  
    <form action="print_ticket_bundle_qrcode.php" method="post" target="_blank" >  
    <!-- <form action="print_ticket_bundle_qrcode_new.php" method="post" target="_blank" >   -->
    <td style="padding-left: 20px; padding-bottom: 20px">
      <input type="hidden" name="id_order" value=<?= $id ?>>
      <input type="hidden" name="ukuran_kertas" id="ukuran_kertas2" class="ukuran_kertas" required>
      <!-- <input type="hidden" name="prosesTransaksi" id="prosesTransaksi" value=<//?= implode(",", $prosesTransaksi); ?> /> -->
      <button type="submit" class="btn btn-warning"  name="print_all">PRINT TICKET</button>
    </td>
    </form>   

     <?php } ?>
</td>
</tr>
</table>
</center>

<center>
  <div style="margin: 20px;">
    <div class="panel panel-default">
      <div class="panel-heading" style="padding-top: 4px; padding-bottom: 4px;">
        <h3 style="margin-top: 6px; margin-bottom: 6px;">Cetak Tiket dan Barcode</h3>
      </div>
      <div class="panel-body">
        <center>
          <form action="print_ticket_bundle_qrcode_new.php" method="post" target="_blank">
            <table>
              <tr>
                <?php
                  $x = 0;
                  $prosesTransaksi = tampilkan_transaksi_proses_category($category);
                  while($dt = mysqli_fetch_assoc($prosesTransaksi)){
                    $x++;
                    $namaTransaksi = $dt['nama_transaksi'];
                    if($x != 9){ ?>
                      <td width="180px">
                        <input class="form-check-input" type="checkbox" name="prosesTrans[]" id="prosesTrans<?= $x; ?>" value="<?= $namaTransaksi; ?>" />
                        <label class="form-check-label" for="namaTransaksi<?=$x; ?>"><?=strtoupper($namaTransaksi); ?></label>
                      </td>
                  <?php }else{ ?>
              </tr>
              <tr>
                <td width="180px;">
                  <input class="form-check-input" type="checkbox" name="prosesTrans[]" id="prosesTrans<?= $x; ?>" value="<?= $namaTransaksi; ?>" />
                  <label class="form-check-label" for="namaTransaksi<?=$x; ?>"><?=strtoupper($namaTransaksi); ?></label>                    
                </td>
                <?php }} ?>
              </tr>
            </table>
            <input type="hidden" name="id_order" value=<?= $id ?>>
            <!-- <input type="hidden" name="prosesTrans" id="prosesTrans" value=<//?= implode(",", $prosesTrans); ?> />             -->
            <button type="submit" class="btn btn-default"  name="print_ticket" id="print_ticket">PRINT TICKET</button>
          </form>
        </center>
      </div>
    </div>
  </div>
</center>

<!-- <div id="hasil"></div> -->
<div id="tampil_tabel"></div>

<br>

<center>


<!-- <a href="hapus_temp_master_order.php" name="reset"><button type="button" class="btn btn-danger" onclick="return konfirmasi()">RESET</button></a> -->
</center>


<!-- Load file JS untuk JQuery dan Selec2.js melalui CDN -->


<!-- <script type="text/javascript" language="JavaScript"> -->
<script>
  function konfirmasi_generate(){
    tanya = confirm("Anda Yakin Data yang akan tergenerate benar ?");
    if (tanya == true) return true;
    else return false;
  }
</script>

<script type="text/javascript">
 
$(document).ready(function(){
    var id = $('#id').val();
    var url = 'tampil_barcode_order.php?id=';
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


<script type="text/javascript">
	$(document).ready(function(){
		$('#ukuran_kertas').change(function(){
			var ukuran = $("#ukuran_kertas").val();
      $('.ukuran_kertas').val(ukuran);
		});		
	});
</script>
</html>
