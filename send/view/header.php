<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <title>APLIKASI PRODUKSI SKM</title>
    <script src="assets/js/jquery.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
  <script type="text/javascript" src="assets/DataTables/js/jquery.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/DataTables/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="assets/popper.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/DataTables/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="assets/DataTables/css/dataTables.bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/DataTables/css/select2.min.css" />
  
        <!-- jika menggunakan bootstrap4 gunakan css ini  -->
  <link rel="stylesheet" href="assets/css/select2-bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="assets/FixedColumns/css/fixedColumns.dataTables.min.css">
<script type="text/javascript" src="assets/FixedColumns/js/dataTables.fixedColumns.min.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="assets/row-reorder/css/rowReorder.dataTables.min.css">
<script type="text/javascript" src="assets/row-reorder/js/dataTables.rowReorder.min.js"></script> -->
<link rel="stylesheet" type="text/css" href="assets/FixedHeader/css/fixedHeader.dataTables.min.css">
<script type="text/javascript" src="assets/FixedHeader/js/dataTables.fixedHeader.min.js"></script>

<!-- <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.min.css" /> -->
<script src="assets/sweetalert2/sweetalert2.all.min.js"></script>
<!-- <script src="assets/sweetalert2/sweetalert2.all.min.js"></script> -->

        <!-- cdn bootstrap4 -->
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
            integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> -->

    <!-- <link rel="stylesheet" href="view/nav_style.css"> -->
  <link rel="stylesheet" href="view/style.css">
  <link rel="icon" href="img/skm_icon.png">

<style>

  
.swal2-modal{
  width: 40%;
}    

.swal2-popup{
padding:3em;
}

.swal2-icon-text{
font-size: 5em;
}

.swal2-icon{
width: 5em;
height: 5em;
}

.swal2-icon {
line-height: 5em;
font-size:1.3em;
}

.swal2-popup .swal2-title{
 font-size: 2.5em;
}

.swal2-popup .swal2-content {
font-size: 1.5em;
}

.swal2-popup .swal2-styled.swal2-confirm {
font-size: 1.5em;
}

.swal2-popup .swal2-styled.swal2-cancel {
font-size: 1.5em;
}   

</style>
</head>
<body>

  <nav >
  
        <ul>
        <?php  
          if(isset($_SESSION['username'])){ 
            if(cek_status($_SESSION['username'] ) == 'admin' OR 
            cek_status($_SESSION['username'] ) == 'warehouse' OR 
            cek_status($_SESSION['username'] ) == 'team_sample' OR
            cek_status($_SESSION['username'] ) == 'ppm' OR
            cek_status($_SESSION['username'] ) == 'pattern_check' OR
            cek_status($_SESSION['username'] ) == 'moulding_bounding' OR
            cek_status($_SESSION['username'] ) == 'team_marker' OR
            cek_status($_SESSION['username'] ) == 'machines_setting' OR
            cek_status($_SESSION['username'] ) == 'layout' OR
            cek_status($_SESSION['username'] ) == 'ready_produksi'
            ){
          ?>
           <li><a href="#">DATA MASTER</a>
             <ul>
                <li><a href="master-order.php">MASTER ORDER</a>
                  <ul>
                    <li><a href="tambah-order.php">TAMBAH ORDER</a></li>
                  </ul>
                </li>
                <li><a href="master_barang2.php">MASTER BARANG</a></li>
                <li><a href="master-size.php">MASTER SIZE</a></li>
                <li><a href="master-costomer.php">MASTER COSTOMER</a></li>
                <li><a href="master_item.php">MASTER ITEMS</a></li>
                <li><a href="master-style.php">MASTER STYLE</a></li>
                <li><a href="master_smv.php">MASTER SMV</a></li>
                <li><a href="master-material.php">MASTER MATERIAL</a></li>
                <li><a href="master-part.php">MASTER PART</a></li>
                <li><a href="master-bom.php">MASTER BOM</a></li>
                <li><a href="master-line.php">MASTER LINE</a></li>
                <li><a href="master_karton.php">MASTER QTY CTN</a></li>
                <li><a href="master-user.php">MASTER USER</a></li>
             </ul>
          </li>
          <li><a href="#">PRE PRODUCTION</a>
            <ul>
              <li><a href="temp_preparation_production.php">PRE PRODUCTION</a></li>
              <li><a href="master_target_harian.php">INPUT TARGET</a></li>
            </ul>
          </li>

          <li><a href="#">PART CUTTING</a>
            <ul>
                <li><a href="temp_part_cutting2.php">OUTPUT OK</a></li>
                <li><a href="temp_part_cutting_reject.php">REJECT</a></li>
            </ul>
          </li>

            <li><a href="#">TRANSAKSI BUNDLE</a>
              <ul>
                <li><a href="temp_cutting.php">CUTTING</a></li>
                <li><a href="temp_qc_cutpart.php">QC CUTPART</a></li>
                <li><a href="temp_press.php">PRESS</a></li>
                <li><a href="temp_moulding.php">MOULDING</a></li>
                <li><a href="temp_bemis.php">BEMIS</a></li>
                <li><a href="temp_preparation.php">PREPARATION</a></li>
                <li><a href="temp_ht.php">HT</a></li>
                <li><a href="temp_trimstore.php">TRIMSTORE</a></li>
                <li><a href="temp_sewing.php">IN SEWING</a></li>
                <li><a href="temp_qc_endline.php">QC ENDLINE</a></li>
                <li><a href="temp_ht2.php">HT AFTER SEWING</a></li>
                <li><a href="temp_iron.php">IRON</a></li>
                <li><a href="temp_qc_buyer.php">QC BUYER</a></li>
                <li><a href="temp_qc_transfer.php">QC TRANSFER</a></li>
                <li><a href="temp_tatami.php">TATAMI OUT</a></li>
                <li><a href="temp_packing_bundle.php">PACKING</a></li>
              </ul>
            </li>
            <li><a href="#">TRANSAKSI</a>
              <ul>
                <!-- <li><a href="temp_qc_kensa.php">QC KENSA</a></li> -->
                <!-- <li><a href="temp_tatami_in.php">TATAMI</a></li> -->
                <li><a href="temp_kenzin.php">KENZIN</a></li>
                <li><a href="temp_packing.php">PACKING</a></li>
                <li><a href="#">REJECT</a>
                    <ul>
                        <!-- <li><a href="temp_reject_tatami.php">TATAMI REJECT</a></li> -->
                    </ul>
                </li>
              </ul>
            </li>
         
           <li><a href="#">SHIPMENT</a> 
           <ul>
              <li><a href="master-shipment.php">CREATE PACKINGLIST</a></li>
              <li><a href="transaksi_shipment_all7.php">KIRIM SHIPMENT</a></li>
              <li><a href="transaksi_shipment_to_packing4.php">KEMBALI KE PACKING</a></li>
              <li><a href="transaksi_shipment_all_bundle.php">PRINT BARCODE CARTON</a></li>
              <li><a href="transaksi_reset_scan_barcode_buyer.php">RESET SCAN</a></li>
           </ul>
          </li>
        <li><a href="#">CETAK LAPORAN</a>
            <ul>
                            <li><a href="cetak_laporan_hasil_part_cutting.php">PART CUTTING</a></li>
                            <li><a href="cetak_laporan_balance_order_barcode_buyer.php">BAL ORDER</a></li>
                            <li><a href="#">HASIL SCAN</a>
                            <ul>
                                <li><a href="cetak_laporan_hasil_scan_global.php">GLOBAL SIZE</a></li>
                                <li><a href="cetak_laporan_hasil_scan_global_perjam.php">GLOBAL PERJAM</a></li>
                                <li><a href="cetak_laporan_hasil_scan_global_perjam_qc_endline.php">ENDLINE PERJAM</a></li>
                                <li><a href="cetak_laporan_hasil_scan_size_detail.php">DETAIL SIZE</a></li>
                                <li><a href="cetak_laporan_hasil_scan_global_allproses.php">ALL PROSES</a></li>
                                <li><a href="cetak_laporan_hasil_scan_global_sewing.php">SEWING LANTAI</a></li>
                                <li><a href="cetak_laporan_reminder_target_qc_endline.php">REMINDER TARGET</a></li>
                            </ul>
                            </li>
                            <li><a href="#">REPORT TV</a>
                            <ul>
                                <li><a href="tv_laporan_hasil_scan_global.php">GLOBAL SIZE</a></li>
                                <li><a href="tv_laporan_hasil_scan_global_sewing2.php">SEWING PROD</a></li>
                                <li><a href="tv_laporan_preparation_production.php">REPORT TV</a></li>
                                <li><a href="reminder_qc_endline_target.php?lantai=1">REMINDER TARGET LT.1</a></li>
                            </ul>
                            </li>
                            <li><a href="#">PREPARATION PRODUCTION</a>
                              <ul>
                                  <li><a href="cetak_laporan_preparation_production.php">REPORT FULL</a></li>
                                 
                              </ul>
                            </li>
                            <!-- <li><a href="cetak_laporan_hasil_qc_kensa.php">QC KENSA</a></li> -->
                            <!-- <li><a href="cetak_laporan_hasil_tatami_buyer.php">TATAMI</a></li> -->
                            
                            <li><a href="cetak_laporan_hasil_kenzin_buyer.php">KENZIN</a></li>
                            <li><a href="cetak_laporan_hasil_packing_buyer.php">PACKING OUTER</a>
                                <ul>
                                    <li><a href="cetak_laporan_hasil_packing_buyer.php">REPORT HARIAN</a></li>
                                    <li><a href="cetak_laporan_stok_packing_barcode_buyer.php">KARTON</a></li>
                                </ul>
                            </li>
                            <li><a href="cetak_grafik_batang_all_line.php">GRAFIK</a>
                                <ul>
                                  <li><a href="cetak_grafik_batang_all_line.php">ALL LINE</a></li>
                                  <li><a href="cetak_grafik_batang_line.php">LINE</a></li>
            </ul>
                            </li>

                        
          </ul>
          </li>
           <li style="float:right; background:#101cb4;"><a href="logout.php">LOG OUT</a></li>
           <?php }else if( cek_status($_SESSION['username'] ) == 'report'){ ?>
            <li><a  target="_blank" href="cetak_laporan_hasil_scan_global.php">REPORT SCAN BUNDLE</a>
              <ul>
                <li><a href="cetak_laporan_hasil_scan_global.php">GLOBAL SIZE</a></li>
                <li><a href="cetak_laporan_hasil_scan_global_perjam.php">GLOBAL PERJAM</a></li>
                <li><a href="cetak_laporan_hasil_scan_size_detail.php">DETAIL SIZE</a></li>
                <li><a href="cetak_laporan_hasil_scan_global_allproses.php">ALL PROSES</a></li>
                <li><a href="cetak_laporan_hasil_scan_global_sewing.php">SEWING LANTAI</a></li>
              </ul>
          </li>
          <li><a href="#">REPORT PACKING OUTER</a>
              <ul>
                <li><a href="cetak_laporan_balance_order_barcode_buyer.php">BAL ORDER</a></li>
                <li><a href="cetak_laporan_hasil_packing_buyer.php">PACKING OUTER</a>
                    <ul>
                        <li><a href="cetak_laporan_hasil_packing_buyer.php">REPORT HARIAN</a></li>
                        <li><a href="cetak_laporan_stok_packing_barcode_buyer.php">KARTON</a></li>
                    </ul>
                </li>
                <li><a href="master-shipment.php">LIST PACKINGLIST</a></li>
               
              </ul>
              
          </li>
            <li style="float:right; background:#101cb4;"><a href="logout.php">LOG OUT</a></li>
          <?php }else if(cek_status($_SESSION['username'] ) == 'packing_outerware' OR cek_status($_SESSION['username'] ) == 'kenzin') {  ?>
            <li><a href="#">DATA MASTER</a>
             <ul>
                <li><a href="master-order.php">MASTER ORDER</a></li>
                <li><a href="master_barang2.php">MASTER BARANG</a></li>
                <li><a href="master-style.php">MASTER STYLE</a></li>
                <li><a href="master_karton.php">MASTER QTY CTN</a></li>
             </ul>
          </li>
          <li><a href="#">TRANSAKSI</a>
              <ul>
               
                <li><a href="temp_kenzin.php">KENZIN</a></li>
                <li><a href="temp_packing.php">PACKING</a></li>
               
              </ul>
            </li>
          <li><a href="#">SHIPMENT</a> 
           <ul>
              <li><a href="master-shipment.php">CREATE PACKINGLIST</a></li>
              <li><a href="transaksi_shipment_all7.php">KIRIM SHIPMENT</a></li>
              <li><a href="transaksi_shipment_to_packing4.php">KEMBALI KE PACKING</a></li>
           </ul>
          </li>
            <li><a  target="_blank" href="cetak_laporan_hasil_scan_global.php">REPORT SCAN</a>
              <ul>
              <li><a href="cetak_laporan_balance_order_barcode_buyer.php">BAL ORDER</a></li>
                <li><a href="cetak_laporan_hasil_kenzin_buyer.php">KENZIN</a></li>
                <li><a href="cetak_laporan_hasil_packing_buyer.php">PACKING OUTER</a>
                                <ul>
                                    <li><a href="cetak_laporan_hasil_packing_buyer.php">REPORT HARIAN</a></li>
                                    <li><a href="cetak_laporan_stok_packing_barcode_buyer.php">KARTON</a></li>
                                </ul>
                            </li>
                
              </ul>
          </li>
            <li style="float:right; background:#101cb4;"><a href="logout.php">LOG OUT</a></li>
          <?php } else{ ?>
            <li><a  target="_blank" href="cetak_laporan_hasil_scan_global.php">REPORT SCAN BUNDLE</a>
              <ul>
             
                <li><a href="cetak_laporan_hasil_scan_global.php">GLOBAL SIZE</a></li>
                <li><a href="cetak_laporan_hasil_scan_global_perjam.php">GLOBAL PERJAM</a></li>
                <li><a href="cetak_laporan_hasil_scan_size_detail.php">DETAIL SIZE</a></li>
                <li><a href="cetak_laporan_hasil_scan_global_allproses.php">ALL PROSES</a></li>
                <li><a href="cetak_laporan_hasil_scan_global_perjam_qc_endline.php">ENDLINE PERJAM</a></li>
                <li><a href="cetak_laporan_reminder_target_qc_endline.php">REMINDER TARGET</a></li>
                
              </ul>
          </li>
            <li style="float:right; background:#101cb4;"><a href="logout.php">LOG OUT</a></li>
           <?php } ?>
           <?php }else{ ?>
             <li style="float:right; background:#101cb4 ;"><a href="index.php">LOG IN</a></li>
           <?php } ?>
           
     </nav>
    
  <div class="container">
