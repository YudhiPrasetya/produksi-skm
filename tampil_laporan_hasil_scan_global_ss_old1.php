<?php
require_once 'core/init.php';

$start = 0;

if ($_POST['action'] == "table_data") {
   $proses = $_POST['proses'];
   $checkstyle = $_POST['checkstyle'];
   $tgl1 = $_POST['tgl1'];
   $tgl2 = $_POST['tgl2'];

   $orc = $_POST['orc'];
   $style = $_POST['style'];
   $status = $_POST['status'];
   $costomer = $_POST['costomer'];
   $no_po = $_POST['no_po'];
   $category = $_POST['category'];
   $line = $_POST['line'];


   $temp1 = mencari_data_master_transaksi($proses);
   $datatransaksi = mysqli_fetch_array($temp1);
   $table = $datatransaksi['table_transaksi'];


   $columns = array(
      0 => 'id_order',
      1 => 'line',
      2 => 'costomer',
      3 => 'no_po',
      4 => 'orc',
      5 => 'style',
      6 => 'color',
      7 => 'shipment_date',
      8 => 'qty_order',
      9 => 'daily',
      10 => 'total',
      11 => 'balance',
      12 => 'id_order',
   );


   $sql = "SELECT C.tanggal_max, A.costomer, A.id_order, A.no_po, A.orc, A.style, A.color, A.shipment_plan, A.qty_order, ifnull(B.daily,0) daily,
ifnull(C.output_total,0) total, (ifnull(C.output_total,0) - sum(IFNULL(A.qty_order,0))) balance,  IFNULL(AD.line, 'not_yet') line, A.plan_line FROM 
(SELECT C.id_order, C.orc, D.style, C.color, E.costomer, C.no_po, A.barcode_bundle, A.id_order_detail, C.shipment_plan,
sum(A.qty_isi_bundle) qty_order, C.status, F.category, G.plan_line FROM master_bundle A
 JOIN order_detail B ON A.id_order_detail = B.id_order_detail
 JOIN master_order C ON B.id_order = C.id_order
 JOIN style D ON C.id_style = D.id_style
 JOIN costomer E ON C.id_costomer = E.id_costomer
 JOIN items F on D.item = F.item 
 JOIN production_preparation G on B.id_order = G.id_order
 GROUP BY C.id_order
 order by C.id_order desc
 limit 1000) A 
 LEFT OUTER JOIN 
 (SELECT A.tanggal, C.id_order, sum(ifnull(A.qty,0)) daily FROM $table A
 JOIN master_bundle B ON A.kode_barcode = B.barcode_bundle
 JOIN order_detail C ON B.id_order_detail = C.id_order_detail
 WHERE tanggal >= '$tgl1' AND tanggal <= '$tgl2' 
 GROUP BY C.id_order)B
 ON A.id_order = B.id_order
  LEFT OUTER JOIN 
 (SELECT max(A.tanggal) tanggal_max, C.id_order, sum(ifnull(A.qty,0)) output_total FROM $table A
 JOIN master_bundle B ON A.kode_barcode = B.barcode_bundle
 JOIN order_detail C ON B.id_order_detail = C.id_order_detail
 WHERE tanggal >= '$tgl1' AND tanggal <= '$tgl2'
 GROUP BY C.id_order)C
 ON A.id_order = C.id_order
 JOIN proses_transaksi_orc AB ON A.id_order = AB.id_order
 JOIN master_transaksi AC ON AB.nama_transaksi = AC.nama_transaksi 
 LEFT OUTER JOIN
  (SELECT C.id_order, IFNULL(A.line, 'not_yet') line FROM transaksi_qc_endline A
  JOIN master_bundle B ON A.kode_barcode = B.barcode_bundle
  JOIN order_detail C ON B.id_order_detail = C.id_order_detail
  GROUP BY C.id_order)AD
 ON A.id_order = AD.id_order
  ";

   // if($checkstyle == 'iya'){
   //   if($line == 'all'){
   //     $sql .= " WHERE A.orc LIKE '%$orc%' AND A.style = '$style' AND AC.table_transaksi = '$table' AND A.status = '$status' 
   //     AND A.costomer like '%$costomer%' AND A.category LIKE '%$category%'
   //     AND A.no_po LIKE '%$no_po%' ";
   //   }else{
   //     $sql .= " WHERE A.orc LIKE '%$orc%' AND A.style = '$style' AND AC.table_transaksi = '$table' AND A.status = '$status' 
   //     AND A.costomer like '%$costomer%' AND A.category LIKE '%$category%' AND IFNULL(AD.line, 'not_yet') = '$line'
   //     AND A.no_po LIKE '%$no_po%' ";
   //   }
   // }else{
   //   if($line == 'all'){
   //     $sql .= " WHERE A.orc LIKE '%$orc%' AND A.style LIKE '%$style%' AND AC.table_transaksi = '$table' AND A.status = '$status' 
   //     AND A.costomer like '%$costomer%' AND A.category LIKE '%$category%'
   //     AND A.no_po LIKE '%$no_po%' ";
   //   }else{
   //     $sql .= " WHERE A.orc LIKE '%$orc%' AND A.style LIKE '%$style%' AND AC.table_transaksi = '$table' AND A.status = '$status' 
   //     AND A.costomer like '%$costomer%' AND A.category LIKE '%$category%' AND IFNULL(AD.line, 'not_yet') = '$line'
   //     AND A.no_po LIKE '%$no_po%' ";
   //   }
   // }

   $sql1 = "SELECT A.orc, A.style, A.status, A.no_po from
(SELECT C.id_order, C.orc, D.style, C.color, E.costomer, C.no_po, A.barcode_bundle, A.id_order_detail, 
sum(A.qty_isi_bundle) qty_order, C.status, F.category, G.plan_line FROM master_bundle A
 JOIN order_detail B ON A.id_order_detail = B.id_order_detail
 JOIN master_order C ON B.id_order = C.id_order
 JOIN style D ON C.id_style = D.id_style
 JOIN costomer E ON C.id_costomer = E.id_costomer
 JOIN items F on D.item = F.item 
 JOIN production_preparation G on B.id_order = G.id_order
 GROUP BY C.id_order
 order by C.id_order desc
 limit 1000) A
 LEFT OUTER JOIN 
 (SELECT C.id_order FROM $table A
 JOIN master_bundle B ON A.kode_barcode = B.barcode_bundle
 JOIN order_detail C ON B.id_order_detail = C.id_order_detail
 WHERE tanggal >= '$tgl1' AND tanggal <= '$tgl2' 
 GROUP BY C.id_order)B
 ON A.id_order = B.id_order
  LEFT OUTER JOIN 
 (SELECT C.id_order FROM $table A
 JOIN master_bundle B ON A.kode_barcode = B.barcode_bundle
 JOIN order_detail C ON B.id_order_detail = C.id_order_detail
 WHERE tanggal <= '$tgl1' AND tanggal >= '$tgl2' 
 GROUP BY C.id_order)C
 ON A.id_order = C.id_order
 JOIN proses_transaksi_orc AB ON A.id_order = AB.id_order
 JOIN master_transaksi AC ON AB.nama_transaksi = AC.nama_transaksi 
 LEFT OUTER JOIN
  (SELECT C.id_order, IFNULL(A.line, 'not_yet') line FROM transaksi_qc_endline A
  JOIN master_bundle B ON A.kode_barcode = B.barcode_bundle
  JOIN order_detail C ON B.id_order_detail = C.id_order_detail
  GROUP BY C.id_order)AD
 ON A.id_order = AD.id_order";

   if ($checkstyle == 'iya') {
      if ($line == 'all') {
         $where = " WHERE A.orc LIKE '%$orc%' AND A.style = '$style' AND AC.table_transaksi = '$table' AND A.status = '$status' 
    AND A.costomer like '%$costomer%' AND A.category LIKE '%$category%'
    AND A.no_po LIKE '%$no_po%' ";
      } else {
         $where = " WHERE A.orc LIKE '%$orc%' AND A.style = '$style' AND AC.table_transaksi = '$table' AND A.status = '$status' 
    AND A.costomer like '%$costomer%' AND A.category LIKE '%$category%' AND IFNULL(AD.line, 'not_yet') = '$line'
    AND A.no_po LIKE '%$no_po%' ";
      }
   } else {
      if ($line == 'all') {
         $where = " WHERE A.orc LIKE '%$orc%' AND A.style LIKE '%$style%' AND AC.table_transaksi = '$table' AND A.status = '$status' 
    AND A.costomer like '%$costomer%' AND A.category LIKE '%$category%'
    AND A.no_po LIKE '%$no_po%' ";
      } else {
         $where = " WHERE A.orc LIKE '%$orc%' AND A.style LIKE '%$style%' AND AC.table_transaksi = '$table' AND A.status = '$status' 
    AND A.costomer like '%$costomer%' AND A.category LIKE '%$category%' AND IFNULL(AD.line, 'not_yet') = '$line'
    AND A.no_po LIKE '%$no_po%' ";
      }
   }

   $group = " GROUP BY A.id_order";
   $sql2 = $sql1 . $where . $group;
   $sql = $sql . $where;
   $totalQuery = mysqli_query($koneksi, $sql2);
   $total_all_rows = mysqli_num_rows($totalQuery);



   if (isset($_POST['search']['value'])) {
      $search_value = $_POST['search']['value'];
      $sql .= " AND ( AD.line LIKE '%" . $search_value . "%' OR A.costomer LIKE '%" . $search_value . "%'
OR A.no_po LIKE '%" . $search_value . "%' OR A.orc LIKE '%" . $search_value . "%' OR A.style LIKE '%" . $search_value . "%'
OR A.color LIKE '%" . $search_value . "%' OR A.shipment_plan LIKE '%" . $search_value . "%')";
   }
   $sql .= " GROUP BY A.id_order";


   if (isset($_POST['order'])) {
      $column_name = $_POST['order'][0]['column'];
      $order = $_POST['order'][0]['dir'];
      $sql .= " ORDER BY " . $columns[$column_name] . " " . $order . "";
   } else {
      $sql .= "  ORDER BY C.tanggal_max desc, B.daily asc";
   }

   if ($_POST['length'] != -1) {
      $start = $_POST['start'];
      $length = $_POST['length'];
      $sql .= " LIMIT  " . $start . ", " . $length;
   }

   $query = mysqli_query($koneksi, $sql);
   $count_rows = mysqli_num_rows($query);

   $data = array();
   if (!empty($query)) {
      $no = $start + 1;
      while ($r = $query->fetch_array()) {
         $nestedData['no'] =  $no;
         if ($r['line'] != 'not_yet') {
            $nestedData['line'] = strtoupper($r['line']);
         } else {
            $nestedData['line'] = strtoupper($r['plan_line']);
         }
         $nestedData['costomer'] = $r['costomer'];
         $nestedData['no_po'] = $r['no_po'];
         $nestedData['orc'] = $r['orc'];
         $nestedData['style'] = $r['style'];
         $nestedData['color'] = $r['color'];
         $nestedData['shipment_plan'] = tgl_indonesia3($r['shipment_plan']);
         $nestedData['qty_order'] = $r['qty_order'];
         $nestedData['daily'] = $r['daily'];
         $nestedData['total'] = $r['total'];
         $nestedData['balance'] = $r['balance'];
         $nestedData['aksi'] = '<button  id="edit" data-toggle="modal" data-target="#myEdit" style="width: 30px; padding: 0; margin: 0" class="edit_material btn btn-primary edit_komentar kecil" data-id="' . $r['id_order'] . '" data-table="' . $table . '"><i class="glyphicon glyphicon-zoom-in"></i></button> | 
<a href="bundle_record.php?id=' . $r['id_order'] . '&tgl>=' . $tgl1 . '&tgl<=' . $tgl2 . '&proses=' . $proses . '" target="_blank"><i class="glyphicon glyphicon-open"></i></a> 
';
         if ($proses == 'qc_endline') {
            $nestedData['aksi'] .= '| <a href="bundle_record_sewing.php?id=' . $r['id_order'] . '&tgl>=' . $tgl1 . '&tgl<=' . $tgl2 . '&proses=' . $proses . '"; target="_blank"><i class="glyphicon glyphicon-th-large"></i></a>';
         }
         if ($proses == 'qc_buyer') {
            $nestedData['aksi'] .= '| <a href="bundle_record_qc_buyer.php?id=' . $r['id_order'] . '&tgl>=' . $tgl1 . '&tgl<=' . $tgl2 . '&proses=' . $proses . '"; target="_blank"><i class="glyphicon glyphicon-th-large"></i></a>';
         }
         if ($proses == 'tatami') {
            $nestedData['aksi'] .= '| <a href="bundle_record_tatami.php?id=' . $r['id_order'] . '&tgl>=' . $tgl1 . '&tgl<=' . $tgl2 . '&proses=' . $proses . '"; target="_blank"><i class="glyphicon glyphicon-th-large"></i></a>';
         }

         $data[] = $nestedData;
         $no++;
      }
   }

   $output = array(
      'draw' => intval($_POST['draw']),
      'recordsTotal' => $count_rows,
      'recordsFiltered' =>   $total_all_rows,
      'data' => $data,
   );
   echo  json_encode($output);
}
