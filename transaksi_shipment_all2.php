<?php
require_once 'core/init.php';
// require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'packing') {

    $no_po = $_GET['po'];
    $orc = $_GET['orc'];
    $style = $_GET['style'];
    $pl = $_GET['pl'];
    
    // $tgl = date("Y-m-d");
    
    $laporan4 = tampilkan_master_shipment_id($pl);
    $data4 = mysqli_fetch_assoc($laporan4);
    $costomer = $data4['id_costomer'];
    $user = $_SESSION['username'];


        $ListSize = tampilkan_size_transaksi_packing_tarikpl($orc, $costomer, $no_po, $style);
        while($size = mysqli_fetch_array($ListSize)){
           ${$size['total_size']} = 0;
           $sumsize[] = $size['sum_size'];
          
        }
        // print_r($arraysize);
        
        $var_sumsize =implode(", ",$sumsize);

?>


<input type="hidden" value="<?= $costomer ?>" class="ganti" name="id_costomer" id="id_costomer">
<input type="hidden" value="<?= $pl ?>" class="ganti" name="pl" id="pl">
<input type="hidden" value="<?= $no_po ?>" class="ganti" name="no_po" id="po">
<input type="hidden" value="<?= $orc ?>" class="ganti" name="orc" id="orc">
<input type="hidden" value="<?= $style ?>" class="ganti" name="style" id="style">
<input type="hidden" value="<?= $var_sumsize ?>" name="var_sumsize" id="var_sumsize">
<!-- <button type="submit" id="autoclick" class="btn btn-primary" >AUTO</button> -->


<div id="tampil_tabel2"></div>
<script type="text/javascript">
  $(document).ready(function(){
    var id_costomer = $('#id_costomer').val();
    var pl = $('#pl').val();
    var po = $('#po').val();
    var orc = $('#orc').val();
    var proses = $('#orc').val();
    var style = $('#style').val();
    var var_sumsize = $('#var_sumsize').val();
     
    $.ajax({
      method: "POST",
      url: "transaksi_shipment_all3.php",
      data: { id_costomer : id_costomer,
        pl : pl,
        po : po,
        orc : orc,
        style : style,
        var_sumsize : var_sumsize
      },
      success: function(data){
        url = "transaksi_shipment_all3.php",
          $('#tampil_tabel2').html(data);
      }
    });
   
  });

 

 
</script>


<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>

