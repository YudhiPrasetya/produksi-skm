<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

  <?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'packing' ) {
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
<center>
<h2>CETAK LAPORAN HISTORY SCAN PACKING</h2>
<h3 align="left">Cetak Per Tanggal Transaksi</h3>
</center>
<br>
<table width="67%">
<form action="laporan_shipment_invoice_tanggal_periode.php" method="POST">
<tr>
 <td colspan=2 style="padding-left: 20px">
<br>
<font color="blue"><b>No Invoice/Packing List </font><br></b>
      <select class="form-control pilcek35"  name="invoice" required>
       <option value="">--------------------------------------- Pilih No Invoice / Packinglist --------------------------------------</option>
       <?php
       $invoice= tampilkan_no_invoice();
       while($pilih2 = mysqli_fetch_assoc($invoice)) {
       echo '<option value='.$pilih2['id_shipment'].'>'.$pilih2['no_invoice'].'</option>';
       }
       ?>
</td>
</tr>
  <tr>
    <td style="margin:10">
    <br>
        <font color="blue"><b>Tanggal Awal</font><br></b>
      <input type="date" name="tgl_awal" id="tgl_awal" class="form-control pilcek" required>
    </td>
  <td style="padding-top: 20px; padding-left: 30px">
  <font color="blue"><b>Tanggal Akhir</font><br></b>
      <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control pilcek" required>
   </td>
   <td style="padding-top:40px">
     <button type="submit" class="btn btn-md btn-success cetak">Cetak / Print</button>
   </td>
 </tr>
 
</form>
</table>

</div>
<!-- validasi level user -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>
