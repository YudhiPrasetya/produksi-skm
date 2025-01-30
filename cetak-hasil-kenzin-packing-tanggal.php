<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

  <?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'kenzin' OR 
cek_status($_SESSION['username'] ) == 'packing' OR 
cek_status($_SESSION['username'] ) == 'kenzin2' OR 
cek_status($_SESSION['username'] ) == 'kenzin3') {
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
<h2>CETAK LAPORAN HASIL KENZIN TANGGAL SEHARI</h2>
<br>
<h3 align="left">LAPORAN HASIL KENZIN PER TANGGAL</h3>
</center>
<br>
<table width="70%">
  <tr>
    <td width="40%">
      <form action="laporan-hasil-kenzin-packing-pertanggal.php" method="POST">
        <font color="blue"><b><label for="tgl">Tentukan Tanggal</label></font><br></b>
      <input type="date" name="tgl" id="tgl" class="form-control pilcek" required>
    </td>
    <td style="padding-top:20px;">
     <button type="submit" class="btn btn-md btn-success cetak">Cetak / Print</button>
   </td>
 </tr>
</form>
</table>
<br>
<hr width="100%" />

<h3 align="left">LAPORAN HASIL KENZIN PERIODE TANGGAL</h3>
</center>
<br>
<table width="70%">
  <tr>
    <td style="margin:10">
      <form action="laporan-hasil-kenzin-packing-periode-tanggal.php" method="POST">
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
</form>
</table>
<br>
<hr width="100%" />
<h3 align="left">LAPORAN HASIL KENZIN PER TANGGAL GROUPING LABEL</h3>
</center>
<br>
<table width="70%">
  <tr>
    <td width="40%">
      <form action="laporan_kenzin_pertanggal_grouping_label.php" method="POST">
        <font color="blue"><b><label for="tgl">Tentukan Tanggal</label></font><br></b>
      <input type="date" name="tgl" id="tgl" class="form-control pilcek" required>
    </td>
    <td style="padding-top:20px;">
     <button type="submit" class="btn btn-md btn-success cetak">Cetak / Print</button>
   </td>
 </tr>
</form>
</table>
<br>
<hr width="100%" />


<h3 align="left">Cetak Periode Tanggal Transaksi Grouping</h3>
</center>
<br>
<table width="70%">
  <tr>
    <td style="margin:10">
      <form action="laporan_packing_tanggal_periode_grouping.php" method="POST">
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
</form>
</table>
<hr width="100%" />
</div>
<!-- validasi level user -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>
