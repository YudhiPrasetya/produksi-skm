<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');

if( !isset($_SESSION['username']) ){
  echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
  // header('Location: index.php');    
}
?>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->



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
<h2>CETAK LAPORAN HASIL PACKING</h2>
<br>
<h3 align="left">LAPORAN SCAN PACKING PERIODE TANGGAL</h3>
</center>
<br>
<table width="70%">
  <tr>
    <td style="margin:10">
      <form action="laporan-hasil-packing-periode-tanggal.php" method="POST">
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
<h3 align="left">LAPORAN HASIL PACKING PER TANGGAL FILTER COSTOMER</h3>
</center>
<br>
<table width="100%">
  <tr>
    <td widht="20%">
    <form action="laporan-hasil-packing-periode-tanggal-costomer.php" target=”_blank”  method="POST">
        <font color="blue"><b>Tanggal Awal</font><br></b>
      <input type="date" name="tgl_awal" id="tgl_awal" class="form-control pilcek" required>
    </td>
  <td>
  <font color="blue"><b>Tanggal Akhir</font><br></b>
      <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control pilcek" required>
   </td>
   <td>
  <font color="blue"><b>Costomer</font><br></b>
    <select id="costomer" class="form-control" name="costomer" required>
      <option value="">- Pilih Costomer -</option>
        <?php
        $costomer = tampilkan_master_costomer();
        while($pilih = mysqli_fetch_assoc($costomer)){
        echo '<option value='.$pilih['id_costomer'].'>'.$pilih['costomer'].'</option>';

        }
        ?>
      </select>
   </td>
  
   <td style="padding-top:20px">
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

</body>
</html>
