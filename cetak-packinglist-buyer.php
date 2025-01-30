<?php
  require_once 'core/init.php';
  require_once 'view/header.php';

if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'shipment' ) {

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
    
</style>

<script type="text/javascript">
  var htmlobjek;
  $(document).ready(function(){
    $("#combo_invoice").change(function(){
      var invoice = $("#combo_invoice").val();
      $.ajax({
        url: "ambilpo_shipment.php",
        data: "invoice="+invoice,
        cache: false,
        success: function(msg){
          $("#combo_po").html(msg);
        }
      });
    });
  $("#combo_po").change(function(){
    var no_invoice = $("#combo_invoice").val();
    var no_po = $("#combo_po").val();
    $.ajax({
      url: "ambilstyle_shipment.php",
      data: { po: no_po, invoice: no_invoice},
      cache: false,
      success: function(msg){
        $("#combo_style").html(msg);
      }
    });
  });
});
</script>


<script type="text/javascript">
  var htmlobjek;
  $(document).ready(function(){
    $("#combo_invoice2").change(function(){
      var invoice = $("#combo_invoice2").val();
      $.ajax({
        url: "ambilpo_shipment_mix.php",
        data: "invoice="+invoice,
        cache: false,
        success: function(msg){
          $("#combo_po2").html(msg);
        }
      });
    });
  $("#combo_po2").change(function(){
    var no_invoice = $("#combo_invoice2").val();
    var no_po = $("#combo_po2").val();
    $.ajax({
      url: "ambilstyle_shipment_mix.php",
      data: { po: no_po, invoice: no_invoice},
      cache: false,
      success: function(msg){
        $("#combo_style2").html(msg);
      }
    });
  });
});
</script>

<center>
<h2>CETAK LAPORAN PACKING</h2>
<br><br>
<h3 align="left">Cetak Packinglist Per NO Invoice</h3>
</center><br>

<table width="70%">
  <tr>
    <form action="laporan-packinglist-buyer-all.php" method="POST">
    <td colspan=2>
      <font color="blue"><b>No Invoice/Packing List (Data Tidak Mix Style)</font><br></b>
      <select class="form-control pilcek3"  name="invoice" required>
        <option value="">------------------------------------------- Pilih No Invoice / Packinglist -------------------------------------------</option>
          <?php
            $invoice= tampilkan_no_invoice();
            while($pilih2 = mysqli_fetch_assoc($invoice)) {
            echo '<option value='.$pilih2['id_shipment'].'>'.$pilih2['no_invoice'].'</option>';
          }
        ?>
    </td>
    <td style="width:21%; padding-top: 20px;"> 
      <button style="margin-left:30px; " type="submit" class="btn btn-md btn-success cetak">Cetak / Print</button>
    </td>
    </form>
  </tr>
  <tr>
    <form action="laporan-packinglist-buyer-mix.php" method="POST">
    <td colspan=2>
      <br>
      <font color="blue"><b>No Invoice/Packing List (Data Mix Style)</font><br></b>
      <select class="form-control pilcek3"  name="invoice" required>
        <option value="">------------------------------------------- Pilih No Invoice / Packinglist -------------------------------------------</option>
          <?php
          $invoice= tampilkan_no_invoice();
          while($pilih2 = mysqli_fetch_assoc($invoice)) {
          echo '<option value='.$pilih2['id_shipment'].'>'.$pilih2['no_invoice'].'</option>';
          }
       ?>
    </td>
    <td style="width:21%; padding-top: 40px;"> 
      <button style="margin-left:30px; " type="submit" class="btn btn-md btn-success cetak">Cetak / Print</button>
    </td>
    </form>
  </tr>
  <tr>
    <form action="laporan-packinglist-buyer-all-label.php" method="POST">
    <td colspan=2>
      <font color="blue"><b>No Invoice/Packing List (Data Tidak Mix Style) Grouping Label</font><br></b>
      <select class="form-control pilcek3"  name="invoice" required>
        <option value="">------------------------------------------- Pilih No Invoice / Packinglist -------------------------------------------</option>
          <?php
            $invoice= tampilkan_no_invoice();
            while($pilih2 = mysqli_fetch_assoc($invoice)) {
            echo '<option value='.$pilih2['id_shipment'].'>'.$pilih2['no_invoice'].'</option>';
          }
        ?>
    </td>
    <td style="width:21%; padding-top: 20px;"> 
      <button style="margin-left:30px; " type="submit" class="btn btn-md btn-success cetak">Cetak / Print</button>
    </td>
    </form>
  </tr>
</table>
<br><br>

<!-- =========================================================================================== -->
<hr width="70%"></hr>
<h3 align="left">Cetak Packinglist Per NO Invoice dan PO</h3>
</center>

<br>
<form action="laporan-packinglist-buyer-po.php" method="POST">
<table width="70%">
  <tr>
    <td width="70%" style="margin:10;  padding-top: 20px;">
      <font color="blue"><b>No Invoice/Packing List</font><br></b>
      <select class="form-control pilcek5"  name="invoice" id="combo_invoice" required>
        <option value="">--------- Pilih No Invoice / Packinglist ----------</option>
        <?php
          $invoice= tampilkan_po_shipment();
          while($pilih2 = mysqli_fetch_assoc($invoice)) {
          echo '<option value='.$pilih2['id_shipment'].'>'.$pilih2['no_invoice'].'</option>';
          }
        ?>
    </td>
    <td style="padding-left: 25px; padding-top: 20px;">
      <font color="blue"><b>Nomer Purchasing Order</font><br></b>
      <select class="form-control pilcek" name="no_po3" id="combo_po" required>
        <option value="">--- Pilih Nomer Purchasing Order ---</option>
      </select>
    </td>
    <td width="70%" style="padding-top:40px; padding-left: 25px">
      <button type="submit" class="btn btn-md btn-success cetak">Cetak / Print</button>
    </td>
  </tr>
</table>
</form>
<br>
<hr width="70%"></hr><br>

<!-- =========================================================================================== -->


</div>
<!-- validasi level user -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>