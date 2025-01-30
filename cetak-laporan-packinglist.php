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



<h3 align="left">Cetak Laporan Packinglist</h3>
</center>
<br><br>
<table width="70%">
  <tr>
    <td style="margin:10">
      <form action="laporan_packinglist.php" method="POST">
      <font color="blue"><b>Nomer Purchasing Order</font><br></b>
      <select id="combo_po2" class="form-control pilcek" name="no_po" required>
       <option value="">--- Pilih Nomer Purchasing Order ---</option>
       <?php
       $po = tampilkan_po();
       while($pilih = mysqli_fetch_assoc($po)) {
       echo '<option value='.$pilih['id_po'].'>'.$pilih['no_po'].'</option>';
       }
       ?>
     </select>
    </td>
  <td>
  <font color="blue"><b>STYLE dan Warna</font><br></b>
   <select id="combo_style2" class="form-control pilcek" name="style" required>
       <option value="">--Pilih Style dan Warna--</option>
       <?php
        $barcode = tampilkan_cetak_packing();
         while($row=mysqli_fetch_assoc($barcode)){
           echo'<option class="dt2 '.$row['id_po'].'" value="'.$row['id_style'].'">'.$row['style'].' ( '.$row['warna'].' ) </option>';
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
<hr width="70%"></hr>
<br>
<b><h3 align="left">Cetak Laporan Packinglist Rentan Tanggal</h3></b>
</center>
<br>
<table width="70%">
  <tr>
    <td style="margin:10">
      <form action="laporan_packinglist_pertanggal.php" method="POST">
      <font color="blue"><b>Tanggal Awal</font><br></b><input type="date" name="tgl_awal" id="tgl_awal" class="form-control pilcek" required>
    </td>
  <td>
  <font color="blue"><b>Tanggal Akhir</font><br></b>
      <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control pilcek" required>
   </td>
   </tr>
   <tr>
   <td style="margin-left:10; padding-top:30px">
   <font color="blue"><b>Nomer Purchasing Order</font><br></b>
      <select id="combo_po" class="form-control pilcek" name="no_po2" required>
       <option value="">--- Pilih Nomer Purchasing Order ---</option>
       <?php
       $po2= tampilkan_po();
       while($pilih2 = mysqli_fetch_assoc($po2)) {
       echo '<option value='.$pilih2['id_po'].'>'.$pilih2['no_po'].'</option>';
       }
       ?>
     </select>
    </td>
  <td style="margin-left:10; padding-top:30px">
  <font color="blue"><b>Style & Warna</font><br></b>
   <select id="combo_style" class="form-control pilcek" name="style2" required>
       <option value="">--Pilih Style dan Warna--</option>
       <?php
        $barcode2 = tampilkan_cetak_packing();
         while($row2=mysqli_fetch_assoc($barcode2)){
           echo'<option class="sa '.$row2['id_po'].'" value="'.$row2['id_style'].'">'.$row2['style'].' ( '.$row2['warna'].' ) </option>';
         }
       ?>
       ?> -->
     </select>
   </td>

    
   <td style="padding-top:50px">
     <button type="submit" class="btn btn-md btn-success cetak">Cetak / Print </button>
   </td>
 </tr>
</form>
</table>

<br>
<hr width="70%"></hr><br>
<h3 align="left">Cetak Packinglist Per List PO & STYLE</h3>
</center>
<br>
<form action="laporan_packinglist_po_style.php" method="POST">
<table width="70%">
 <tr>
    <td width="42%" style="margin:10; padding-top: 20px;">
    <font color="blue"><b>Nomer Purchasing Order</font><br></b>
      <select class="form-control pilcek" name="no_po3" required>
       <option value="">--- Pilih Nomer Purchasing Order ---</option>
       <?php
       $po2= tampilkan_po();
       while($pilih2 = mysqli_fetch_assoc($po2)) {
       echo '<option value='.$pilih2['id_po'].'>'.$pilih2['no_po'].'</option>';
       }
       ?>
     </select>
    </td>
  <td style="padding-left: 25px; padding-top: 20px;">
  <font color="blue"><b>STYLE</font><br></b>
      <input type="text" name="style3" id="style" placeholder="STYLE" class="form-control pilcek" required>
   </td>
   <td width="70%" style="padding-top:40px; padding-left: 25px">
     <button type="submit" class="btn btn-md btn-success cetak">Cetak / Print</button>
   </td>
   <tr>
 </tr>
</form>
</table>

<br>
<hr width="70%"></hr><br>
<h3 align="left">Cetak Laporan Packinglist Per Style Rentan Tanggal</h3>
</center>
<br>
<form action="laporan_packinglist_po_style_tanggal.php" method="POST">
<table width="70%">
  <tr>
    <td width="42%" style="margin:10" >
    <font color="blue"><b>Tanggal Awal</font><br></b>
      <input type="date" name="tgl_awal" id="tgl_awal" class="form-control pilcek" required>
    </td>
    <td style="padding-left: 25px">
      <font color="blue"><b>Tanggal Akhir</font><br></b>
      <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control pilcek" required>
    </td>
 </tr>
 <tr>
    <td width="42%" style="margin:10; padding-top: 20px;">
    <font color="blue"><b>Nomer Purchasing Order</font><br></b>
      <select class="form-control pilcek" name="no_po" required>
       <option value="">--- Pilih Nomer Purchasing Order ---</option>
       <?php
       $po2= tampilkan_po();
       while($pilih2 = mysqli_fetch_assoc($po2)) {
       echo '<option value='.$pilih2['id_po'].'>'.$pilih2['no_po'].'</option>';
       }
       ?>
     </select>
    </td>
  <td style="padding-left: 25px; padding-top: 20px;">
  <font color="blue"><b>STYLE</font><br></b>
      <input type="text" name="style" id="style" placeholder="STYLE" class="form-control pilcek" required>
   </td>
   <td width="70%" style="padding-top:40px; padding-left: 25px">
     <button type="submit" class="btn btn-md btn-success cetak">Cetak / Print</button>
   </td>
   <tr>
 </tr>
</form>
</table>


<script type="text/javascript">
  $(document).ready(function(){
    var combo_style2 = $("#combo_style");

          temp2 = combo_style2.children(".sa").clone();
           $("#combo_po").change(function(){
            var value = $(this).val();
              combo_style2.children(".sa").remove();
              if(value!==''){
                  temp2.clone().filter("."+value).appendTo(combo_style2);
              } else {
                  temp2.clone().appendTo(combo_style2);
              }
           });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    var combo_style2 = $("#combo_style2");

          temp = combo_style2.children(".dt2").clone();
           $("#combo_po2").change(function(){
            var value = $(this).val();
              combo_style2.children(".dt2").remove();
              if(value!==''){
                  temp.clone().filter("."+value).appendTo(combo_style2);
              } else {
                  temp.clone().appendTo(combo_style2);
              }
           });
  });
</script>


</div>
<!-- validasi level user -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>