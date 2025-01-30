<?php
require_once 'core/init.php'; 

if($_POST['action'] == "table_data"){
  
  $tgl = date("Y-m-d");
  
  $costomer = $_POST['costomer'];
  $category = $_POST['category'];
  $lantai = $_POST['lantai'];

  $columns = array( 
    0 =>'no', 
    1 =>'line',
    2=> 'orc',
    3=> 'style',
    4=> 'color',
    5=> 'order',
    6=> 'daily_output',
    7=> 'total_sewing_in',
    8=> 'total_sewing_out',
    9=> 'outstanding',
    10=> 'balance_order',
);


$sql = "SELECT D.tanggal_max, B.line, A.costomer, A.id_order, A.no_po, A.orc, A.style, A.color, A.qty_order, ifnull(B.total_sewing_in,0) total_sewing_in, ifnull(C.daily,0) daily_output,
ifnull(D.total_sewing_out,0) total_sewing_out, (ifnull(B.total_sewing_in,0) - ifnull(D.total_sewing_out,0)) outstanding , (ifnull(D.total_sewing_out,0) - A.qty_order) balance_order FROM 
(SELECT C.id_order, C.orc, D.style, C.color, C.id_costomer, E.costomer, C.no_po, A.barcode_bundle, A.id_order_detail, 
sum(A.qty_isi_bundle) qty_order, C.status, F.category  FROM master_bundle A
 JOIN order_detail B ON A.id_order_detail = B.id_order_detail
 JOIN master_order C ON B.id_order = C.id_order
 JOIN style D ON C.id_style = D.id_style
 JOIN costomer E ON C.id_costomer = E.id_costomer
 JOIN items F on D.item = F.item 
 GROUP BY C.id_order) A
 LEFT OUTER JOIN 
 (SELECT A.tanggal, C.id_order, sum(ifnull(A.qty,0)) total_sewing_in, A.line FROM transaksi_sewing A
 JOIN master_bundle B ON A.kode_barcode = B.barcode_bundle
 JOIN order_detail C ON B.id_order_detail = C.id_order_detail
 WHERE tanggal <= '$tgl' 
 GROUP BY C.id_order)B
 ON A.id_order = B.id_order
  LEFT OUTER JOIN 
 (SELECT A.tanggal, C.id_order, sum(ifnull(A.qty,0)) daily FROM transaksi_qc_endline A
 JOIN master_bundle B ON A.kode_barcode = B.barcode_bundle
 JOIN order_detail C ON B.id_order_detail = C.id_order_detail
 WHERE tanggal = '$tgl' 
 GROUP BY C.id_order)C
 ON A.id_order = C.id_order
 LEFT OUTER JOIN 
 (SELECT max(A.tanggal) tanggal_max, C.id_order, sum(ifnull(A.qty,0)) total_sewing_out FROM transaksi_qc_endline A
 JOIN master_bundle B ON A.kode_barcode = B.barcode_bundle
 JOIN order_detail C ON B.id_order_detail = C.id_order_detail
 WHERE tanggal <= '$tgl' 
 GROUP BY C.id_order)D
 ON A.id_order = D.id_order
LEFT OUTER JOIN master_line E ON B.line = E.nama_line";

$sql .= " WHERE A.status = 'open' AND A.costomer like '%$costomer%' AND A.category LIKE '%$category%' AND E.lantai LIKE '%$lantai%' ";

$sql1 = "SELECT A.id_order FROM 
(SELECT C.id_order, E.costomer, C.status, F.category  FROM master_bundle A
 JOIN order_detail B ON A.id_order_detail = B.id_order_detail
 JOIN master_order C ON B.id_order = C.id_order
 JOIN style D ON C.id_style = D.id_style
 JOIN costomer E ON C.id_costomer = E.id_costomer
 JOIN items F on D.item = F.item 
 GROUP BY C.id_order) A
 LEFT OUTER JOIN 
 (SELECT C.id_order, A.line FROM transaksi_sewing A
 JOIN master_bundle B ON A.kode_barcode = B.barcode_bundle
 JOIN order_detail C ON B.id_order_detail = C.id_order_detail
 WHERE tanggal <= '2023-03-03' 
 GROUP BY C.id_order)B
 ON A.id_order = B.id_order
LEFT OUTER JOIN master_line E ON B.line = E.nama_line
WHERE A.status = 'open' AND A.costomer like '%$costomer%' AND A.category LIKE '%$category%' AND E.lantai LIKE '%$lantai%' 
GROUP BY A.id_order";

$totalQuery = mysqli_query($koneksi,$sql1);
$total_all_rows = mysqli_num_rows($totalQuery);



if(isset($_POST['search']['value']))
{
$search_value = $_POST['search']['value'];
$sql .= " AND ( B.line LIKE '%".$search_value."%'  OR A.orc LIKE '%".$search_value."%' OR A.style LIKE '%".$search_value."%'
OR A.color LIKE '%".$search_value."%' OR A.qty_order LIKE '%".$search_value."%')";

}
$sql .= " GROUP BY A.id_order";


if(isset($_POST['order']))
{
$column_name = $_POST['order'][0]['column'];
$order = $_POST['order'][0]['dir'];
$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
$sql .= " ORDER BY D.tanggal_max desc, C.daily asc";
}

if($_POST['length'] != -1)
{
$start = $_POST['start'];
$length = $_POST['length'];
$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($koneksi,$sql);
$count_rows = mysqli_num_rows($query);

$data = array();
if(!empty($query))
{
$no = $start + 1;
while ($r = $query->fetch_array())
{
$nestedData['no'] =  $no;
$nestedData['line'] = strtoupper($r['line']);
$nestedData['costomer'] = $r['costomer'];
$nestedData['no_po'] = $r['no_po'];
$nestedData['orc'] = $r['orc'];
$nestedData['style'] = $r['style'];
$nestedData['color'] = $r['color'];
$nestedData['qty_order'] = $r['qty_order'];
$nestedData['daily_output'] = $r['daily_output'];
$nestedData['total_sewing_in'] = $r['total_sewing_in'];
$nestedData['total_sewing_out'] = $r['total_sewing_out'];
$nestedData['outstanding'] = $r['outstanding'];
$nestedData['balance_order'] = $r['balance_order'];

$data[] = $nestedData;
$no++;
}
}

$output = array(
'draw'=> intval($_POST['draw']),
'recordsTotal' =>$count_rows ,
'recordsFiltered'=>   $total_all_rows,
'data'=>$data,
);
echo  json_encode($output);
}  