<?php
require_once 'db.php';
// require_once($_SERVER['DOCUMENT_ROOT']."/produksi-skm/view/header.php");
// require_once($_SERVER['DOCUMENT_ROOT']."/produksi-skm/view/header.php");
global $koneksi;

$idPacking = $_GET['id'];
$query = "SELECT * FROM view_packing_karton_full WHERE id='$idPacking'";
$response = mysqli_query($koneksi, $query);

$dataPacking = [];
while($row = mysqli_fetch_assoc($response)){
   $dtArr = [
      'no_po' => $row['no_po'],
      'costomer' => $row['costomer'],
      'orc' => $row['orc'],
      'style' => $row['style'],
      'color' => $row['color'],
      'size' => $row['size'],
      'cup' => $row['cup'],
      'qty' => $row['qty'],
      'kapasitas_karton' => $row['kapasitas_karton'],
      'total_karton' => $row['total_karton'],
      // 'no_urut' => $row['no_urut'],
      'barcode' => $row['barcode_char'],
      'qrcode_char' => $row['qrcode_char'],
      'total_karton' => $row['total_karton']
   ];
   array_push($dataPacking, $dtArr);
}

// var_dump($dataPacking);
// QRcode::png($dataPacking['qrcode_char']);

$dataPackingJSON = json_encode($dataPacking);
// var_dump($dataPacking);
?>

<html>
   <head>
      <!-- <script src="../assets/js/jquery.js"></script>
      <script type="text/javascript" src="../assets/DataTables/js/jquery.js"></script>
      <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
      <script type="text/javascript" src="../assets/DataTables/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="../assets/popper.min.js"></script>
      <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="../assets/DataTables/css/jquery.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="../assets/DataTables/css/dataTables.bootstrap.css">
      <link rel="stylesheet" type="text/css" href="../assets/DataTables/css/select2.min.css" />        -->

      <style>
         .title {
            font-weight: bold;
            font-size: 14pt;
         }

         .td-padding {
            padding-top: 5px;
            padding-bottom: 5px;
         }

         .centered {
            text-align: center;
            padding-bottom: 10px;
            page-break-inside: avoid;

         }

         .lefted {
            text-align: left;
            padding-bottom: 5px;
            page-break-inside: avoid;
         }

         body {
            width: 100%;
            height: 100%;
            font: 12pt "Tahoma";
            margin: 0;
            padding: 0;
         }

         tr {
            page-break-inside: avoid;
            page-break-after: auto;
         }

         thead {
            display: table-header-group;
         }

         @page {
            /* size: 105mm 297mm; */
            /* size: 210mm 297mm; */
            size: 210mm 330mm;
            /* margin: 3cm; */
            /* margin-top: 5mm; */
            /* margin-bottom: 5mm;             */
            /* margin-left: 15mm; */
            /* margin: 5mm 5mm 5mm 5mm; */
            /* margin: 4mm; */
            /* width: 210mm;
                  height: 330mm; */
         }

         @media print{
            @page {
               size: 210mm 330mm;
               margin: .5cm;
            }
         }

         /* @media print{
            body {
               zoom: 80%;
            }
         } */

         /* @page:first{
                  margin-top: 4mm;
            } */

         table {
            page-break-inside: avoid;
            /* margin-top: 8px; */
            margin-left: 5px;
            /* margin-top: 8px; */
            /* margin-bottom: 22px */
         }

         /* thead {
            display: table-header-group;
         } */

         .column {
            float: left;
            width: 50%;
            padding: 10px;
         }

         .row:after {
            content: "";
            display: table;
            clear: both;
         }

         .pe-4{
            padding-right: .5rem !important;
         }

         .ps-3{
            padding-left: .5rem !important;
         }

         .pt2{
            padding-top: .5rem !important;
         }

         .pb3{
            padding-bottom: 1rem !important;
         }         
      </style>
   </head>
   <body>
      <center>
         <h3 style="margin-bottom: 10px;">Packing List Karton</h3>
         <h4 style="margin-top: 10px;">No.PO: <?= $dataPacking[0]['no_po']; ?></h4>

         <table id="tblHeader" width="85%">
            <!-- <tbody id="tblHeaderBody"></tbody> -->
            <tbody>
               <tr>
                  <td class="lefted ps-3" width="10%">ORC</td>
                  <td width="1%">:</td>
                  <td width="20%" align="left"><strong><?= $dataPacking[0]['orc']; ?></strong></td>
                  <td width="55%"></td>
                  <td width="5%">CUSTOMER</td>
                  <td width="1%">:</td>
                  <td width="20%"><strong><?= $dataPacking[0]['costomer']; ?></strong></td>
               </tr>
               <tr>
                  <td class="lefted ps-3" width="10%">Style</td>
                  <td width="1%">:</td>
                  <td width="20%" align="left"><strong><?= $dataPacking[0]['style']; ?></strong></td>
                  <td width="55%"></td>
                  <!-- <td width="5%">CUSTOMER</td>
                  <td width="1%">:</td>
                  <td width="20%"><//?= $dataPacking[0]['costomer']; ?></td> -->
               </tr>

            </tbody>
         </table>
         <br/>
         <table id="tblDetail" width="85%" border="1" class="table">
            <thead>
               <tr>
                  <th rowspan="2"><center>Size</center></th>
                  <th rowspan="2"><center>Cup</center></th>
                  <th rowspan="2"><center>Qty</center></th>
                  <th rowspan="2"><center>Kapasitas Karton</center></th>
                  <th rowspan="2"><center>Total Karton</center></th>
                  <th colspan="2"><center>No.Urut Karton</center></th>
               </tr>
               <tr>
                  <th><center>Dari</center>
                  <th><center>Sampai</center>
               </tr>
            </thead>
            <tbody id="tblDetailBody">
               <?php
                  $tbody = "";
                  for($x = 0; $x < count($dataPacking); $x++){
                     echo '<tr>';
                     echo '<td><center>'.$dataPacking[$x]["size"].'</center></td>';
                     echo '<td><center>'.$dataPacking[$x]["cup"].'</center></td>';
                     echo '<td><center>'.$dataPacking[$x]["qty"].'</center></td>';
                     echo '<td><center>'.$dataPacking[$x]["kapasitas_karton"].'</center></td>';
                     echo '<td><center>'.$dataPacking[$x]["total_karton"].'</center></td>';
                     if($x == 0){
                        echo '<td><center>1</center></td>';
                        echo '<td><center>'.$dataPacking[$x]["total_karton"] . '</center></td>';
                        echo '</tr>';
                     }else{
                        $totKarton = 0;
                        $noKarton = 0;
                        for($y = 0; $y <= $x; $y++){
                           $totKarton += $dataPacking[$y]['total_karton'];
                           if($y > 0){
                              $noKarton += $dataPacking[$y-1]['total_karton'];
                           }
                        }
                        echo '<td><center>'.strval($noKarton+1).'</center></td>';
                        echo '<td><center>'.$totKarton.'</center></td>';
                        echo '</tr>';
                     }

                  }
                  // echo $tbody;
               ?>
            </tbody>
         </table>
      </center>

      <script>
         // var dataPackingJSON = JSON.parse('<?= $dataPackingJSON; ?>');
         // var htmlTable = "";
         // $(document).ready(function(){
         //    for(let x = 0; x < dataPackingJSON.length; x++){
         //       htmlTable += "<tr>";
         //       htmlTable += `<td>${dataPackingJSON[x]['size']}</td>`;
         //       htmlTable += `<td>${dataPackingJSON[x]['cup']}</td>`;
         //       htmlTable += `<td>${dataPackingJSON[x]['kapasitas_karton']}</td>`;
         //       htmlTable += `<td>${dataPackingJSON[x]['no_urut']}</td>`;
         //       htmlTable += `<td>${dataPackingJSON[x]['no_urut']}</td>`;
         //       htmlTable += "</tr>";
         //       $('#tblDetailBody').append(htmlTable);
         //    }

         // });
      </script>
   </body>
</html>