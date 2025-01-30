<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

  <?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'kenzin' ) {
  ?>


<center>
<h2>CETAK LAPORAN KENZIN</h2>

<h3 align="left">Cetak Format Packing List</h3>
</center>
<br><br>
<table width="70%">
  <tr>
    <td style="margin:10">
      <form action="laporan_kenzin.php" method="get">
      <select id="combo_po" class="form-control pilcek" name="no_po" required>
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
   <select id="combo_style" class="form-control pilcek" name="style" required>
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
    var combo_style = $("#combo_style");

          temp = combo_style.children(".dt").clone();
           $("#combo_po").change(function(){
            var value = $(this).val();
              combo_style.children(".dt").remove();
              if(value!==''){
                  temp.clone().filter("."+value).appendTo(combo_style);
              } else {
                  temp.clone().appendTo(combo_style);
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
