<?php

   require_once 'core/init.php';

   $id_order = $_POST['id_order'];

   $proses = [];
   if(isset($_POST['prosesTrans'])){
      foreach($_POST['prosesTrans'] as $check){
         array_push($proses, $check);
      }
   }
   $dataProsesJSON = json_encode($proses);

   $response = tampilkan_ticket_bundle1($id_order);
   $dataTiket = [];
   while($row = mysqli_fetch_assoc($response)){
      $arr = [
         'customer' => $row['costomer'],
         'orc' => $row['orc'],
         'no_po' => $row['no_po'],
         'style' => $row['style'],
         'size' => $row['size'],
         'cup' => $row['cup'],
         'prepare_on' => $row['prepare_on'],
         'item' => $row['item'],
         'color' => $row['color'],
         'lot' => $row['lot'],
         'qty_isi_bundle' => $row['qty_isi_bundle'],
         'no_bundle' => $row['no_bundle'],
         'shipment_plan' => $row['shipment_plan'],
         'barcode_bundle' => $row['barcode_bundle'],
      ];
      array_push($dataTiket, $arr);
   }
   
   $dataTiketJSON = json_encode($dataTiket);

?>

<html>
   <head>
      <style type="text/css">
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
            /* size: 210mm 330mm; */
            size: auto;
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
               margin: .3cm;
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
            margin-left: 3px;
            /* margin-top: 8px; */
            /* margin-bottom: 22px */
         }

         thead {
            display: table-header-group;
         }
      </style>
      <title>TICKET BUNDLE</title>
      <script src="./assets/js/jquery.js"></script>
   </head>
   <body>
      <table cellspacing="40">
         <thead>
            <th id="headerGanjil" style="padding-left: 10px;" width="40%"></th>
            <th id="headerGenap" style="padding-left: 10px;" width="40%"></th>
         </thead>
      </table>

      <script>
         $(document).ready(function(){
            var dataProsesJSON = JSON.parse('<?= $dataProsesJSON; ?>');

            var dataTiketJSON = JSON.parse('<?= $dataTiketJSON; ?>');
            console.table(dataTiketJSON);

            var noUrut = 1;

            function createTicket(item, header, even, proses){
               var lot = item.lot != null ? item.lot : "_________";
               // $barcode = bar128(stripslashes($item["barcode_bundle"]));
               $barcode = "test";

               var html = "";
               html += '<table style="border: 1px solid black; margin-bottom: 20px;" >';
               html += "<tr>";
               html += "<td colspan='7' style='border-bottom: 1px solid black'>";
               html += "<center>";
               html += "<h2 style='margin-bottom: 2px;'>" + header + "</h2>";
               html += "<h4 style='margin-top: 2px; margin-bottom:2px;'>Tiket "+proses.toUpperCase()+"</h4>";
               html += "</center>";
               html += "</td>";
               html += "</tr>";

               html += "<tr>";
               html += "<td width='10%' style='padding-top: 7px;'>BUYER</td>";
               html += "<td width='1%' style='padding-top: 7px'> : </td>";
               html += '<td width="25%" style="padding-top: 7px">'+item.customer+'</td>';
               html += '<td width="1%" style="padding-top: 7px"></td>';
               html += '<td width="10%" style="padding-top: 7px">PREP</td>';
               html += '<td width="1%" style="padding-top: 7px"> : </td>';
               html += '<td width="15%" style="padding-top: 7px">'+item.prepare_on+'</td>';
               html += "</tr>";

               html += '<tr>';
               html += '<td>NO. PO </td>'+
                        '<td> : </td>'+
                        '<td>'+item.no_po+'</td>'+
                        '<td width="1%"></td>'+
                        '<td>SHIP</td>'+
                        '<td> : </td>'+
                        '<td>'+item.shipment_plan+'</td>';
               html += '</tr>';

               html += '<tr>';
               html += '<td>ORC</td>' +
                        '<td> : </td>' +
                        '<td>' + item.orc + '</td>' +
                        '<td width="1%"></td>' +
                        '<td>QTY</td>' +
                        '<td> : </td>' +
                        '<td>' + item.qty_isi_bundle + '</td>';
               html += '</tr>';

               html += '<tr>';
               html += '<td>STYLE</td>'+
                        '<td> : </td>'+
                        '<td>'+item.style+'</td>'+
                        '<td width="1%"></td>'+
                        '<td>BUN</td>'+
                        '<td> : </td>'+
                        '<td>'+item.no_bundle+'</td>';
               html += '</tr>';

               html += '<tr>';
               html += '<td>COLOR</td>'+
                        '<td> : </td>'+
                        '<td>'+item.color+'</td>';
               html += '<td width="1%"></td>'+
                        '<td>LOT</td>'+
                        '<td> : </td>'+
                        '<td>' + lot + '</td>';
               html += '</tr>';

               html += '<tr>';
               html += '<td>SIZE</td>'+
                        '<td> : </td>'+
                        '<td>'+item.size + item.cup + '</td>'+
                        '<td width="1%"></td>'+
                        '<td></td>'+
                        '<td colspan="3" rowspan="3" class="qrCodeku"><p class="qrText">'+item.barcode_bundle+'</p></td>';
               html += '</tr>';

               html += '<tr>';
               html += '<td>ITEM</td>'+
                        '<td> : </td>'+
                        '<td>'+item.item+'</td>'+
                        '<td width="1%"></td>'+
                        '<td></td>';
               html += '</tr>';

               html += '<tr class="barcode">';
               html += `<td colspan="6"><center><p class="kode">${item.barcode_bundle}</p></center></td>`;
                        // <center>'. $barcode .'</center>

               html += '</tr>';
               html += '</table>';

               if(even == "ganjil"){
                  $('#headerGanjil').append(html);
               }else if(even == "genap"){
                  $('#headerGenap').append(html);

               }

            }

            for(let x = 0; x < dataTiketJSON.length; x++){
               for(let y = 0; y < dataProsesJSON.length; y++){
                  if(noUrut % 2 ==1)
                     createTicket(dataTiketJSON[x], "PT. Globalindo Intimates", "ganjil", dataProsesJSON[y]);
                  else{
                     createTicket(dataTiketJSON[x], "PT. Globalindo Intimates", "genap", dataProsesJSON[y]);                     
                  }
                  noUrut++;
               }
            }

            $('.barcode > td').each(function(){
               var text = $(this).text().trim();
               $('.kode').hide();
               var bars = $('<div class="thebars"><center><svg class="barcode text-center"></center></svg></div>').appendTo(this);
               bars.find('.barcode').JsBarcode(text, {
                  displayValue: false,
                  format: "code128",
                  height: 50
               });               
            });

            $('.qrCodeku').each(function() {
               var qrVal = $(this).text();
               $('.qrText').hide();
               var qrs = $('<div class="theQR"><div class="qrCodeku text-center"></div></div>').appendTo(this);
               qrs.find('.qrCodeku').qrcode({
                  text: qrVal,
                  width: 80,
                  height: 80
               });
            });            
         })
      </script>

      <script src="./assets/js/JsBarcode.all.min.js"></script>
      <script src="./assets/js/jquery.qrcode.js"></script>
      <script src="./assets/js/qrcode.js"></script>         
   </body>
</html>





<script>
   window.print();
</script>