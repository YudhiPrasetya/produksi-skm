<?php
require_once 'db.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
   if (isset($_GET['action'])) {
       $action = $_GET['action'];
      //  var_dump($action);
       switch($action){
         case "tampilkanPackingKartonFull":
            tampilkan_packing_karton_full();
            break;
         case "getDetailDataMasterOrderByOrc":
            if(isset($_GET['param'])){
               $orc = $_GET['param'];
               get_detail_data_master_order_by_orc($orc);
               break;
            }
         case 'cariPackingKartonFullById':
            if(isset($_GET['param'])){
               $idPacking = $_GET['param'];
               cari_packing_karton_full_by_id($idPacking);
               break;
            }
         case 'ajax_getCustomers':
            getCustomers();
            break;
         case 'ajax_getLines':
            getLines();
            break;
       }
      //  }
   } else if(isset($_POST['action'])){
      $action = $_POST['action'];
      switch($action){
         case "simpanPackingKartoFull":
            if(isset($_POST['param'])){
               $param = $_POST['param'];
               simpan_packing_karton_full($param);
               break;
            }
         case "simpanDetailPackingKartoFull":
            if(isset($_POST['param'])){
               $param = $_POST['param'];
               simpan_detail_packing_karton_full($param);
               break;
            }            
      }
   }else{
       echo json_encode(array('error' => 'Aksi tidak valid')); // Mengembalikan error
      
   }
} else {
   header("HTTP/1.0 403 Forbidden"); // Menolak permintaan bukan AJAX
   die();
}

function tampilkan_packing_karton_full(){
   global $koneksi;
   $query = "SELECT DISTINCT id, no_po, orc, style, color, qty_order, costomer, size, cup,qty, 
             kapasitas_karton,total_karton,qrcode_char from view_packing_karton_full GROUP BY id";
   $result = mysqli_query($koneksi, $query) or die('gagal menampilkan data');
 
   $data = [];
   while($row =  mysqli_fetch_assoc($result)){
     $dtArr = [
      'id' => $row['id'],
      'no_po' => $row['no_po'],
      'orc' => $row['orc'],
      'style' => $row['style'],
      'color' => $row['color'],
      'qty_order' => $row['qty_order'],
      'costomer' => $row['costomer']
     ];
     array_push($data, $dtArr);
   }
   $retVal = json_encode($data);
   echo $retVal;

}

function cari_packing_karton_full_by_id($idPacking){
   global $koneksi;
   $query = "SELECT * FROM view_packing_karton_full WHERE id='$idPacking'";
   $response = mysqli_query($koneksi, $query);

   $data = [];
   while($row = mysqli_fetch_assoc($response)){
      $dtArr = [
         'orc' => $row['orc'],
         'style' => $row['style'],
         'color' => $row['color'],
         'size' => $row['size'],
         'cup' => $row['cup'],
         'qty' => $row['qty'],
         'kapasitas_karton' => $row['kapasitas_karton'],
         'total_karton' => $row['total_karton'],
         'no_urut' => $row['no_urut'],
         'qrcode_char' => $row['qrcode_char']
      ];
      array_push($data, $dtArr);
   }
   
   $retVal = json_encode($data);
   echo $retVal;
}

function tampilkan_packing_karton_Full_QRCODE($idPacking){
   global $koneksi;
   $query = "SELECT * FROM view_packing_karton_full WHERE id='$idPacking'";
   $response = mysqli_query($koneksi, $query);

   $data = [];
   while($row = mysqli_fetch_assoc($response)){
      $dtArr = [
         'orc' => $row['orc'],
         'style' => $row['style'],
         'color' => $row['color'],
         'size' => $row['size'],
         'cup' => $row['cup'],
         'qty' => $row['qty'],
         'kapasitas_karton' => $row['kapasitas_karton'],
         'total_karton' => $row['total_karton'],
         'no_urut' => $row['no_urut'],
         'qrcode_char' => $row['qrcode_char']
      ];
      array_push($data, $dtArr);
   }
   $retVal = json_encode($data);
   echo $retVal;

}

function get_detail_data_master_order_by_orc($orc){
   global $koneksi;
   
   $dataOrder = [];
   $queryCari = "SELECT COUNT(*) AS hitung FROM view_packing_karton_full WHERE orc='$orc'";
   $responseCari = mysqli_query($koneksi, $queryCari);
   $hasilCari = mysqli_fetch_assoc($responseCari);
   if((int)$hasilCari['hitung'] > 0){
      array_push($dataOrder, ["data" => "invalid"]);
      $jsonDataOrder = json_encode($dataOrder);
      echo $jsonDataOrder;
   }else{
      $queryOrder = "SELECT * FROM view_master_order_detail WHERE orc='$orc' AND status='open'";
      $responseOrder = mysqli_query($koneksi, $queryOrder) or die('gagal menampilkan data');
      if($responseOrder){
         while($rowOrder = mysqli_fetch_assoc($responseOrder)){
            $data = [
               'no_po' => $rowOrder['no_po'],
               'orc' => $rowOrder['orc'],
               'style' => $rowOrder['style'],
               'color' => $rowOrder['color'],
               'qty_order' => $rowOrder['qty_order'],
               'id_order_detail' => $rowOrder['id_order_detail'],
               'id_order' => $rowOrder['id_order'],
               'id_costomer' => $rowOrder['id_costomer'],
               'size' => $rowOrder['size'],
               'cup' => $rowOrder['cup'],
               'qty' => $rowOrder['qty_order_size'],            
            ];
            array_push($dataOrder, $data);
         }
      }
      array_push($dataOrder, ["data" => "valid"]);
      $jsonDataOrder = json_encode($dataOrder);
      echo $jsonDataOrder;

   }
}

function simpan_packing_karton_full($p){
   global $koneksi;

   $id_order = $p['id_order'];
   $id_costomer = $p['id_costomer'];
   $orc = $p['orc'];
   $style = $p['style'];
   $color = $p['color'];

   $query = "INSERT INTO packing_karton_full(id_order, id_costomer, orc, style, color) 
            VALUES('$id_order', '$id_costomer', '$orc', '$style', '$color')";
   $result = mysqli_query($koneksi, $query) or die('gagal menampilkan data');

   $insertedID = mysqli_insert_id($koneksi);
  // return $result;
  echo $insertedID;
   
}

function simpan_detail_packing_karton_full($payload){
   global $koneksi;

   $idPacking = $payload[0]['id_packing_karton_full'];
   $query1 = "SELECT * FROM packing_karton_full WHERE id='$idPacking'";
   $response1 = mysqli_query($koneksi, $query1);
   $resultPacking = mysqli_fetch_assoc($response1);

   // $nourut = 1;
   // $dataArray = [];
   for($x = 0; $x < count($payload); $x++){
      $idPacking = $payload[$x]['id_packing_karton_full'];
      $size = $payload[$x]['size'];
      $cup = $payload[$x]['cup'];
      $qty = $payload[$x]['qty'];
      $kapasitasKarton = $payload[$x]['kapasitas_karton'];
      $totalKarton = $payload[$x]['total_karton'];
      $barcode = $resultPacking['orc'] .";". $payload[$x]['size'];
      $qrCode = 'orc: '.$resultPacking['orc'].'; style: '.$resultPacking['style'].'; color: '.$resultPacking['color'].'; size: '.
                           $payload[$x]['size'].'; cup: '.$payload[$x]['cup'].'; qty: '.$payload[$x]['qty'].
                           '; kapasitas_karton: '.$payload[$x]['kapasitas_karton'].'; total_karton: '. $payload[$x]['total_karton'];
                           
      $query2 = "INSERT INTO packing_karton_full_detail(id_packing_karton_full, size, cup, qty, kapasitas_karton, total_karton,
                  barcode_char, qrcode_char)VALUES('$idPacking', '$size', '$cup', '$qty', '$kapasitasKarton',
                  '$totalKarton', '$barcode', '$qrCode')";

      $response2 = mysqli_query($koneksi, $query2);

   }

   // var_dump($dataArray);
   echo true;
   
   // for($x = 0; $x < count($p); $x++){

   // }
}

function getCustomers(){
   global $koneksi;

   $query = "SELECT id_costomer,costomer FROM costomer";
   $responseCust = mysqli_query($koneksi, $query) or die('Gagal menampilkan data!');
   $dataCustomer = [];
   while($row =  mysqli_fetch_assoc($responseCust)){
     $dtArr = [
      'id' => $row['id_costomer'],
      'costomer' => $row['costomer']
     ];
     array_push($dataCustomer, $dtArr);
   }   
   $jsonCust = json_encode($dataCustomer);
   echo $jsonCust;
}

function getLines(){
   global $koneksi;

   $query = "SELECT id_line,nama_line FROM master_line";
   $responseLine = mysqli_query($koneksi, $query) or die('Gagal menampilkan data!');
   $dataLines = [];
   while($row =  mysqli_fetch_assoc($responseLine)){
     $dtArr = [
      'id_line' => $row['id_line'],
      'nama_line' => $row['nama_line']
     ];
     array_push($dataLines, $dtArr);
   }   
   $jsonLines = json_encode($dataLines);
   echo $jsonLines;
}

?>