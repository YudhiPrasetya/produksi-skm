<title>TICKET PECAH BUNDLE</title>
<link rel="icon" href="img/skm_icon.png">
<style type="text/css" media="print">
            @page { 
                width: 110mm;
                height: 320mm;
            }
    </style>
<?php
require_once 'core/init.php';
include('assets/qrcode/qrlib.php');
include('barcode128.php'); // include php barcode 128 class

$id_order = $_GET['id'];
$barcode = $_GET['barcode'];
$proses = $_GET['proses'];
$balance = $_GET['balance'];

$temp1 = mencari_data_master_transaksi($proses);
         $datatransaksi = mysqli_fetch_array($temp1);
         $table = $datatransaksi['table_transaksi'];

$nama = tampilkanNamaPerusahaan();
$dataperusahaan = mysqli_fetch_array($nama);
$namaperusahaan = $dataperusahaan['nama_perusahaan'];
$qtyprint = 1;
$kolom = 2;  // jumlah kolom

$sql = tampilkan_ticket_bundle_pecah_bundle($id_order, $barcode); // memilih entri nim pada database
$data = mysqli_fetch_assoc($sql);
 
?>
 <div style="width: 100mm; height 320mm; border: 1px black solid;">
<table style="margin-left: 5px; font-size: 12px" width="100%">
                <tr>
                    <td colspan = "7" style="border-bottom: 1px solid black;">
                        <center><h2 style="margin-bottom: 2px;"><?= $namaperusahaan; ?></h2>
                    </td>
                </tr>
                
                <tr >
                    <td width="10%" style="padding-top: 7px">BUYER</td>
                    <td width="1%" style="padding-top: 7px"> : </td>
                    <td width="25%" style="padding-top: 7px"><?= $data['costomer'] ?></td>
                    <td width="2%" style="padding-top: 7px"></td>
                    <td width="10%" style="padding-top: 7px">PREP</td>
                    <td width="1%" style="padding-top: 7px"> : </td>
                    <td width="15%" style="padding-top: 7px"><?= tgl_indonesia3($data['prepare_on']); ?></td>
                </tr>
                <tr>
                    <td>NO. PO </td>
                    <td> : </td>
                    <td><?= $data['no_po'] ?></td>
                    <td width="2%"></td>
                    <td>SHIP</td>
                    <td> : </td>
                    <td><?= tgl_indonesia3($data['shipment_plan']); ?></td>
                </tr>
                <tr>
                    <td>ORC</td>
                    <td> : </td>
                    <td><?= $data['orc'] ?></td>
                    <td width="2%"></td>
                    <td>QTY</td>
                    <td> : </td>
                    <td><?= $data['qty_isi_bundle'] ?></td>
                </tr>
                <tr>
                    <td>STYLE</td>
                    <td> : </td>
                    <td><?= $data['style'] ?></td>
                    <td width="2%"></td>
                    <td>BUN</td>
                    <td> : </td>
                    <td><?= $data['no_bundle'] ?></td>
                </tr>
                <tr>
                    <td>COLOR</td>
                    <td> : </td>
                    <td><?= $data['color'] ?></td>
                    <td width="2%"></td>
                    <td>LOT</td>
                    <td> : </td>
                    <td>_________</td>
                </tr>
                <tr>
                    <td>SIZE</td>
                    <td> : </td>
                    <td><?= $data['size'].$data['cup'] ?></td>
                    <td width="2%"></td>
                    <td></td>
                    <td colspan="3" rowspan="3">
                        <?php
                        $tempDir = "qrcodes/ ";
                        $barcode = $data['barcode_bundle'];
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
                        <!-- <img src="filename.png" alt="" width=""> -->
                    </td>
                </tr>
                <tr>
                    <td>ITEM</td>
                    <td> : </td>
                    <td><?= $data['item'] ?></td>
                    <td width="2%"></td>
                    <td></td>
                <tr>
                    <td colspan=6>
                    <center><?= bar128(stripslashes($data['barcode_bundle'])); ?></center>
                    </td>
                </tr>
               
    </table>
    <?php
            $j = 0;
            $limit = 11;
            $jumlahProses = countJumlahTransaksi($id_order);
            $jumlahRow = ceil($jumlahProses/$limit);
            // $jumlahColoumn = 8;
            $sisaBagi = $jumlahProses - ( ($jumlahRow-1)*$limit);
            $offset = -$limit;
            
            for($m=1; $m<=$jumlahRow; $m++){
                $offset+=$limit;
                if($m != $jumlahRow){
                    $jumlahColoumn = $limit;
                }else{
                    $jumlahColoumn = $sisaBagi;
                }
        ?>
    <center>
    <table border="1" cellspacing="0" width="<?= $jumlahColoumn*9.1 ?>%" style="font-size: 12px">
        <tr>
            <?php
                
                $sql2 = tampilkan_transaksi_proses_id_ticket($id_order, $offset, $limit);
                while($proses = mysqli_fetch_assoc($sql2)){
                    $j++;
                   
                ?>
                <td style="padding: 5px; text-align: center" width="11%"><?= $proses['singkatan']; ?></td>
                <?php 
                
                if($j == $jumlahColoumn){    
                   
                ?>
                </tr>
                <tr>
                    <?php for($k=1; $k<=$j; $k++){ ?>
                    <td> &nbsp; </td>
                    <?php } ?>
                </tr>
        <?php } }
        $j = 0;
        ?>
    </table>
    </center>
    <table style="font-size: 11px; padding-top:10px; width="100%">
        <?php
            for($n=1; $n<=4; $n++){
        ?>
        <tr>
            <td style="border-bottom: 1px solid black; padding: 3px"><?= $data['orc'].' / '.$data['style'].' / '.$data['color'].' / '.$data['size'].$data['cup'].' / '.$data['no_bundle'] ?></td>
        </tr>
        <?php } } ?>
    </table>

    <table style="font-size: 11px; padding-top:5px; padding-bottom: 5px;  width=100%">
        
        <tr>
            <td align="center"><b>TRANSAKSI QC_ENDLINE - BALANCE PECAH BUNDLE : <?= $balance; ?></b></td>
        </tr>

    </table>

</div>