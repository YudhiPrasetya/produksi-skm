<html>
    <head>
        <title>BUNDLE RECORD</title>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<style type="text/css" media="print">
            @page { 
                
                width: 215mm;
                height: 330mm;
                
            }
        </style>
    </head>
    <body>
<?php
         
    require_once 'core/init.php';
    include('assets/qrcode/qrlib.php');
    include('barcode128.php'); // include php barcode 128 class

    $id = $_POST['idtrx']; // Ambil data NIS yang dikirim oleh index.php melalui form submit
    
    $id_user = implode(",", $id);
    $nama = tampilkanNamaPerusahaan();
    $dataperusahaan = mysqli_fetch_array($nama);
    $namaperusahaan = $dataperusahaan['nama_perusahaan'];

    $sql = tampilkan_user_id_in($id_user); // memilih entri nim pada database
    while($data = mysqli_fetch_array($sql)){

?>

<table style="border: 1px solid black; float: left; " >
    <tr>
        <td align="center" style="padding-left: 10px; padding-right: 10px; padding-top: 15px; padding-bottom: 5px;"><b><u><font size= 2px><?= $namaperusahaan; ?></font></u></b></td>
    </tr>
    <tr>
        <td align="center" ><font size= 2px><b>PROSES <?php 
        if($data['level'] == 'ht_after'){
            echo 'HT AFTER SEWING';
        }else{ ?>
            <?= strtoupper($data['level']) ?><b></td>
        <?php
            }
        ?>
        
    </tr>
    <tr>
        <td align="center" style="padding-top: 15px;">
        <?php
                        $tempDir = "qrcodes/ ";
                        $barcode = $data['username'];
                        $fileName = $barcode.'.png';
    
                        // $pngAbsoluteFilePath = $tempDir.$fileName;
                        $urlRelativeFilePath = $tempDir.$fileName;
                        // generating
                        if (!file_exists($urlRelativeFilePath)) {
                            QRcode::png($barcode, $urlRelativeFilePath, QR_ECLEVEL_H);
                        }

                        // displaying
                        echo '<img src="'.$urlRelativeFilePath.'" width="80px" height="80px" />';
                        
         ?>
        </td>
    </tr>
    <tr>
        <td align="center" style="padding-top: 15px">
        <font size="2px">    Nama : <?= ucfirst($data['nama']) ?></font>
        </td>
    </tr>
    <tr>
        <td align="center" style="padding-top: 15px; padding-bottom: 15px">
        <?= bar128(stripslashes($barcode)); ?>
        </td>
    </tr>
</table>
<?php } ?>