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
<h2>CETAK LAPORAN PACKING</h2>
<h3 align="left">Cetak Per Periode Tanggal Transaksi ( No Urut Scan )</h3>
</center>

<br>
<form action="laporan_packing_tanggal.php" method="POST">
<table width="35%">
  <tr>
    <td style="margin:10">
      <font color="blue"><b>Tentukan tanggal</font><br></b>
      <input type="date" name="tanggal" id="tanggal" class="form-control pilcek" required>
    </td>
    <td style="padding-top:20px; padding-left: 20px">
     <button type="submit" class="btn btn-md btn-success cetak">Cetak / Print</button>
    </td>
  </tr>
</table>
</form>

<br>
<hr width="100%" />
<h3 align="left">Cetak Per Periode Tanggal Transaksi ( No Urut Scan )</h3>
<br>

<form action="laporan_packing_periode_tanggal.php" method="POST">
<table width="70%">
  <tr>
    <td style="margin:10">
      <font color="blue"><b>Tanggal Awal</font><br></b>
      <input type="date" name="tgl_awal" id="tgl_awal" class="form-control pilcek" required>
    </td>
    <td>
      <font color="blue"><b>Tanggal Akhir</font><br></b>
      <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control pilcek" required>
    </td>
    <td style="padding-top:20px">
      <button type="submit" class="btn btn-md btn-success cetak">Cetak / Print</button>
   </td>
 </tr>
</table>
</form>

</div>
<!-- validasi level user -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>
