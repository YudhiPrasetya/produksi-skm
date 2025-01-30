
<?php
require_once 'core/init.php';
include('barcode128.php'); // include php barcode 128 class


$barcode = $_POST['barcode_number'];  // jumlah kolom
$label = $_POST['label']; // jumlah copy barcode
$color = $_POST['color'];
$style = $_POST['style'];
$no_po = $_POST['no_po'];
$qtyprint = $_POST['qtyprint'];
$kolom = 2;  // jumlah kolom
$counter = 1;
?>
<!-- <div class="book">
    <div class="page"> -->
        <table cellpadding='10' border="1" cellspacing="1">

        <?php
        for ($ucopy=1; $ucopy<=$qtyprint; $ucopy++) {
        if (($counter-1) % $kolom == '0') {  ?>
        <tr>
        <?php } ?>

        <td class='merk' style="font-size: 10; " >
        NO PO : <?= $no_po ?> &nbsp; / &nbsp; LABEL : <?= $label; ?> <br>
        STYLE : <?= $style; ?>  &nbsp; / &nbsp; COLOR : <?= $color; ?> 
        <center> <?php echo bar128(stripslashes($barcode)); ?></center>
        </td>
        <?php 
        if ($counter % $kolom == '0') { echo "</tr>
        "; }
        $counter++;
        }
        ?>
        </table>
    <!-- </div>
</div> -->
