<?php
// require_once '../view/header.php';
require_once 'db.php';
// include('../assets/qrcode/qrlib.php');

global $koneksi;

$idPacking = $_GET['id'];
$query = "SELECT * FROM view_packing_karton_full WHERE id='$idPacking'";
$response = mysqli_query($koneksi, $query);

$dataPacking = [];
while($row = mysqli_fetch_assoc($response)){
   $dtArr = [
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
      'qrcode_char' => $row['qrcode_char']
   ];
   array_push($dataPacking, $dtArr);
}

// var_dump($dataPacking);
// QRcode::png($dataPacking['qrcode_char']);

$dataPackingJSON = json_encode($dataPacking);
?>

<html>
   <head>
      <style type="text/css">
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

         thead {
            display: table-header-group;
         }

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

      <script src="../assets/js/jquery.js"></script>
   </head>
   <body>
      <table id="mainTable" cellspacing="40">
         <thead>
            <th id="headerGanjil" width="40%"></th>
            <th id="headerGenap" width="40%"></th>
         </thead>
      </table>

      <script>
         $(document).ready(function(){
            var dataPackingJSON = JSON.parse('<?= $dataPackingJSON; ?>');
            var evenOdd;
            var noUrut = 1;

            function createBundleBarcode(itm, partLabel, even, no) {
               var theData = "";

               theData += '<table style="border: 1px solid black;" >';
               theData += '<tr>';
               theData += '<td colspan="4" class="centered title pt-2 pb-3">';
               theData += partLabel + '</td></tr>';

               theData += '<thead><tr><th></th><th></th><th></th><th></th></tr></thead>';

               theData += '<tr>';
               theData += '<td class=" lefted ps-3">CUSTOMER</td>';
               theData += '<td class=" lefted">:</td>';
               theData += '<td class=" lefted">' + itm.costomer + '</td>';
               theData += '<td class=" lefted" width="100px" rowspan="6">';
               theData += '<table>'
               theData += '<tr class="qrCodeku">';
               theData += `<td class="pe-4"><p class="qrText">${itm.qrcode_char}; ${no}</p></td>`;
               theData += '</tr>'
               theData += '</table>'
               theData += '</td>';
               theData += '</tr>';

               theData += '<tr>';
               theData += '<td class=" lefted ps-3">ORC</td>';
               theData += '<td class=" lefted">:</td>';
               theData += '<td class=" lefted">' + itm.orc + '</td>';
               theData += '</tr>';

               theData += '<tr>';
               theData += '<td class=" lefted ps-3">COLOR</td>';
               theData += '<td class=" lefted">:</td>';
               theData += '<td class=" lefted">' + itm.color + '</td>';
               theData += '</tr>';

               theData += '<tr>';
               theData += '<td class=" lefted ps-3">STYLE</td>';
               theData += '<td class=" lefted">:</td>';
               theData += '<td class=" lefted">' + itm.style + '</td>';
               theData += '</tr>';

               theData += '<tr>';
               theData += '<td class=" lefted ps-3">SIZE</td>';
               theData += '<td class=" lefted">:</td>';
               theData += '<td class=" lefted">' + itm.size + '</td>';
               theData += '</tr>';

               theData += '<tr>';
               theData += '<td class=" lefted ps-3">NO.URUT</strong></td>';
               theData += '<td class=" lefted">:</td>';
               theData += '<td class=" lefted">' + no + '</td>';
               theData += '</tr>';

               theData += '<tr class="barcode">';
               theData += `<td colspan="4" class="px-3 pb-2"><p class="kode"> ${itm.barcode};${no}</p></td>`;

               theData += '</tr></table><br/>';
               if (even == "ganjil") {
                  $('#headerGanjil').append(theData);

               } else if (even == "genap") {
                  $('#headerGenap').append(theData);
               }

            }

            for(let x = 0; x < dataPackingJSON.length; x++){
               let kapasitasKarton = dataPackingJSON[x].total_karton;
               for(let y = 0; y < kapasitasKarton; y++){
                  if(noUrut % 2 == 1){
                     createBundleBarcode(dataPackingJSON[x], "Globalindo Intimates - Karton QRCode", "ganjil", noUrut);
                  }else if(noUrut % 2 == 0){
                     createBundleBarcode(dataPackingJSON[x], "Globalindo Intimates - Karton QRCode", "genap", noUrut);
                  }
                  noUrut++;
               }
            }

            // $.each(dataPackingJSON, function(i, item) {
            //    // console.log('dataPrint: ', dataPrint);
            //    evenOdd = i + 1;
            //    if (evenOdd % 2 == 1) {
            //       if (item.cp != "")
            //          createBundleBarcode(item, "Globalindo Intimates - Karton QRCode", "ganjil");

            //    } else if (evenOdd % 2 == 0) {
            //          createBundleBarcode(item, "Globalindo Intimates - Karton QRCode", "genap");
            //    }
            // });
            
            $('.barcode > td').each(function() {
               var text = $(this).text().trim();

               $('.kode').hide();

               var bars = $('<div class="thebars"><svg class="barcode text-center"></svg></div>').appendTo(this);
               bars.find('.barcode').JsBarcode(text, {
                  displayValue: false,
                  format: "code128",
                  height: 50
               });
            });

            $('.qrCodeku > td').each(function() {
               var qrVal = $(this).text();
               $('.qrText').hide();
               var qrs = $('<div class="theQR"><div class="qrCodeku text-center"></div></div>').appendTo(this);
               qrs.find('.qrCodeku').qrcode({
                  text: qrVal,
                  width: 125,
                  height: 125
               });
            });            

         });

      </script>

      <script src="../assets/js/JsBarcode.all.min.js"></script>
      <script src="../assets/js/jquery.qrcode.js"></script>
      <script src="../assets/js/qrcode.js"></script>

   </body>
</html>







