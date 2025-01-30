
<?php
require_once 'core/init.php';
include('barcode128.php'); // include php barcode 128 class


$idstyle = $_GET['id'];
$sql2 = tampilkan_barang_costomer_idstyle($idstyle);
$data2 = mysqli_fetch_array($sql2);
?>
<!-- <center> -->
<h2><?= $data2['costomer'] ?></h2>
<h3><?= $data2['style'] ?></h3>
<!-- </center> -->

<?php
$sql1 = tampilkan_count_size($idstyle); // memilih entri nim pada database
$data1 = mysqli_fetch_array($sql1);
$qtyprint = 1;
$kolom = 3;  // jumlah kolom
$counter = 1;
?>
   
<!-- <h3><?= $data1['orc']." / ". $data1['no_po']." / ".$data1['style']. " / ".$data1['color']; ?></h3> -->
        <table cellpadding='10' border="1" cellspacing="70">

        <?php
        for ($ucopy=1; $ucopy<=$qtyprint; $ucopy++) {
        if (($counter-1) % $kolom == '0') {  ?>
        <tr >
        <?php } 
            $sql = tampilkan_barang_idstyle($idstyle); // memilih entri nim pada database
           
            while($hasil = mysqli_fetch_assoc($sql)){
        ?>
        
        <td class='merk' style="font-size: 10;" >
        
        Style : <?= $hasil['style']; ?>  &nbsp;  
            <?php echo bar128(stripslashes($hasil['kode_barcode'])); ?>
        </td>
            <?php 
            if ($counter % $kolom == '0') { echo "</tr>
            "; }
            $counter++;
            }
        }   
        ?>
        </table>
    <!-- </div>
</div> -->
