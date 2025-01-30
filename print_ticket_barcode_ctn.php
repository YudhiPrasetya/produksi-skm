<title>TICKET CARTON</title>
<?php
require_once 'core/init.php';
include('assets/qrcode/qrlib.php');
include('barcode128.php'); // include php barcode 128 class

$id = $_GET['id']; // Ambil data NIS yang dikirim oleh index.php melalui form submit
// $kirim = $_POST['kirim'];
// $data = implode(",", $id);
$arr_id = explode (",",$id);



// $kertas = $_POST['ukuran_kertas'];
$nama = tampilkanNamaPerusahaan();
$dataperusahaan = mysqli_fetch_array($nama);
$namaperusahaan = $dataperusahaan['nama_perusahaan'];
$qtyprint = 1;
$kolom = 2;  // jumlah kolom
// $sisaBawahKertas = 150; // F4
?>
  <style type="text/css" media="print">
            @page { 
                width: 128mm;
                height: 50mm;
            }
    </style>
<?php
        $jumlahTicket = count($arr_id);
        // $jumlahTicket = Cek_jumlah_ticket_bundle($id_order);
?>

   <div style="width: 106mm; height 50mm; margin-bottom: 1mm;" >

    <table cellspacing="1"  width="100%">
        <tr>      
             <?php 
                $i = 0;
                $data = tampilkan_hd_transaksi_packing_bundle($id);
                while($row = mysqli_fetch_array($data)){
                $i++;
               

             ?>
            <td>
            
            <table style="font-size: 8px; font-family: calibri; margin-bottom: 45px" width="100%">
                <!-- <tr>
                    <td colspan="2">
                        <center><h2 style="margin-bottom: 2px;"><?= $namaperusahaan; ?></h2></center>
                    </td>
                </tr> -->
                
                <tr >
                   
                    <td style="margin-left: 20px">
                    <span style="font-size: 7px"><center><?= $namaperusahaan ?></center></span>

                        <?php
                        $tempDir = "qrcodes/ctn ";
                        $barcode = '4537065110802';
                        $fileName = $barcode.'.png';
    
                        // $pngAbsoluteFilePath = $tempDir.$fileName;
                        $urlRelativeFilePath = $tempDir.$fileName;
                        // generating
                        if (!file_exists($urlRelativeFilePath)) {
                            QRcode::png($barcode, $urlRelativeFilePath, QR_ECLEVEL_H);
                        }

                        // displaying
                        echo '<img src="'.$urlRelativeFilePath.'" width="90px" height=90px" />';
                        
                        ?>
                        <span style="padding-left: 10px; margin-bottom: 15px">4537065110802</span>
                    </td>
                    <td width="75%">
                  
                    
                    <?php

                    $data4 = tampilkan_data_scan_packing_bundle_costomer($row['no_trx']);
                    $row4 = mysqli_fetch_array($data4);
                    ?>
                    <span style="font-size: 8px">BUYER : <?= $row4['costomer']; ?></span>
                    <br>
                
                    <?php
                        $data5 = tampilkan_data_scan_packing_bundle_po_buyer($row['no_trx']);
                        while($row5 = mysqli_fetch_array($data5)){ ?>
                            <span style="font-size: 8px; margin-bottom: 20px"> NO PO : <?= $row5['no_po']; ?></span>
                            <br>
                        <?php } ?>
                        <?php
                            $data2 = tampilkan_data_scan_packing_bundle($row['no_trx']);
                            while($row2 = mysqli_fetch_array($data2)){
                                echo "STYLE : ".$row2['style']."  
                                <br>Col. ".$row2['color']."<br>";
                                
                                $data3 = tampilkan_data_scan_packing_bundle_size($row['no_trx'], $row2['style'], $row2['color']);
                                while($row3 = mysqli_fetch_array($data3)){
                                    echo "* SIZE ".$row3['size'].$row3['cup']." : ".$row3['total']." PCS <br>";
                                }
                               echo "<br>";
                            }

                        ?>
                        
                    </td>
                </tr>
                
            </table>
            </td>
        <?php
        $sisa = $i % 2;
        if($sisa == 0){
            echo "</tr>";
        } 
        } 
    ?>
    
    </table>

 


   


     
      

    <script>
		window.print();
	</script>
    