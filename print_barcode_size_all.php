
<?php
require_once 'core/init.php';
include('barcode128.php'); // include php barcode 128 class


$id = $_GET['id'];
$sql1 = tampilkan_count_size($id); // memilih entri nim pada database
$data1 = mysqli_fetch_array($sql1);
$qtyprint = 1;
$kolom = 2;  // jumlah kolom
$counter = 1;
?>
<!-- <div class="book">
    <div class="page"> -->
<!-- <h3><?= $data1['orc']." / ". $data1['no_po']." / ".$data1['style']. " / ".$data1['color']; ?></h3> -->
        <table cellpadding='10' border="1" cellspacing="1">

        <?php
        for ($ucopy=1; $ucopy<=$qtyprint; $ucopy++) {
        if (($counter-1) % $kolom == '0') {  ?>
        <tr>
        <?php } 
            $sql = tampilkan_edit_order_id2($id); // memilih entri nim pada database
           
            while($hasil = mysqli_fetch_assoc($sql)){
        ?>
        
        <td class='merk' style="font-size: 10; " >
        NO PO : <?= $hasil['no_po']; ?> &nbsp; / &nbsp; LABEL : <?= $hasil['label']; ?> <br>
        LABEL : <?= $hasil['style']; ?>  &nbsp; / &nbsp; COLOR : <?= $hasil['color']; ?> 
            <?php echo bar128(stripslashes($hasil['barcode_number'])); ?>
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
