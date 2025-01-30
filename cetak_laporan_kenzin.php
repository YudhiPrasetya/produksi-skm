<?php
require_once 'core/init.php';
require_once 'view/header.php';

if( !isset($_SESSION['username']) ){
  echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
  
}


?>
<center>
<h2>CETAK LAPORAN KENZIN</h2>

<h3 align="left">Cetak Format Packing List</h3>
</center>
<br><br>
<table width="70%">
  <tr>
    <td style="margin:10">
      <form action="laporan_packinglist.php" method="get">
      <select id="combo_provinsi" class="form-control pilcek" name="no_po" required>
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
   <select id="combo_kabupaten" class="form-control pilcek" name="style" required>
       <option value="">--Pilih Style dan Warna--</option>
       <?php
        $barcode = tampilkan_cetak_packing();
         while($row=mysqli_fetch_assoc($barcode)){
           echo'<option class="dt '.$row['id_po'].'" value="'.$row['id_style'].'">'.$row['style'].' ( '.$row['warna'].' ) </option>';
         }
       ?>
       ?> -->
     </select>
   </td>
   <td>
     <button type="submit" class="btn btn-md btn-success cetak">Cetak / Print</button>
   </td>
 </tr>
</form>
</table>

<br><br>
<h3 align="left">Cetak Per Tanggal Transaksi</h3>
</center>
<br>
<table width="70%">
  <tr>
    <td style="margin:10">
      <form action="laporan_packing_tanggal.php" method="POST">
      <input type="date" name="tgl_awal" id="tgl_awal" class="form-control pilcek" required>
    </td>
  <td>
      <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control pilcek" required>
   </td>
   <td>
     <button type="submit" class="btn btn-md btn-success cetak">Cetak / Print</button>
   </td>
 </tr>
</form>
</table>

<script type="text/javascript">
  $(document).ready(function(){
    var combo_kabupaten = $("#combo_kabupaten");

          temp = combo_kabupaten.children(".dt").clone();
           $("#combo_provinsi").change(function(){
            var value = $(this).val();
              combo_kabupaten.children(".dt").remove();
              if(value!==''){
                  temp.clone().filter("."+value).appendTo(combo_kabupaten);
              } else {
                  temp.clone().appendTo(combo_kabupaten);
              }
           });
  });
</script>
</div>

</body>
</html>
