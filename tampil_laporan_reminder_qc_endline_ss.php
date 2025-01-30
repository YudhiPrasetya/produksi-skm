<?php
require_once 'core/init.php'; 

if($_POST['action'] == "table_data"){
  
  $tgl = date("Y-m-d");
  $lantai = $_POST['lantai'];
  $jam = date("H:i:s");

    if($jam <= '09:04:59'){
        // $jam_ke = 1;
        $waktu_awal = '00:00:01';
        $waktu_akhir = '08:05:00';
    }elseif($jam <= '10:04:59'){
        // $jam_ke = 2;
        $waktu_awal = '08:05:01';
        $waktu_akhir = '09:05:00';
    }elseif($jam <= '11:04:59'){
        // $jam_ke = 3;
        $waktu_awal = '09:05:01';
        $waktu_akhir = '10:05:00';
    }elseif($jam <= '11:59:59'){
        // $jam_ke = 4;
        $waktu_awal = '10:05:01';
        $waktu_akhir = '11:05:00';
    }elseif($jam <= '14:04:59'){
        // $jam_ke = 5;
        $waktu_awal = '11:05:01';
        $waktu_akhir = '13:05:00';
    }elseif($jam <= '15:04:59'){
        // $jam_ke = 6;
        $waktu_awal = '13:05:01';
        $waktu_akhir = '14:05:00';
    }elseif($jam <= '16:04:59'){
        // $jam_ke = 7;
        $waktu_awal = '14:05:01';
        $waktu_akhir = '15:05:00';
    }
  $columns = array( 
    0 =>'no', 
    1=> 'costomer',
    2=> 'no_po',
    3=> 'item',
    4=> 'orc',
    5=> 'style',
    6=> 'color',
    7 =>'line',
    8=> 'jml_jam_normal',
    9=> 'target_jam',
    10=> 'total_output',
    11=> 'balance_target',
);


$sql = "SELECT A.date_target, A.item, A.jml_jam_normal, A.orc,  A.style, A.color, A.no_po, A.costomer, A.id_order, A.lantai, A.line, 
IFNULL(A.target_jam, 0) target_jam,
IFNULL(B.total_output, 0) total_output, (IFNULL(B.total_output, 0)-IFNULL(A.target_jam, 0)) balance_target 
FROM 
(SELECT A.date_target, D.item, B.orc, D.style, B.color, B.no_po, E.costomer, A.id_order, C.lantai, A.line, 
 ROUND(((60/A.nilai_smv)*A.man_power*(A.persentase_target/100)),0) target_jam, A.jml_jam_normal  
FROM master_target A 
JOIN master_order B ON A.id_order = B.id_order
JOIN master_line C ON A.line = C.nama_line
JOIN style D ON B.id_style = D.id_style
JOIN costomer E ON B.id_costomer = E.id_costomer
WHERE A.date_target = '$tgl' AND C.lantai = $lantai
 GROUP BY A.date_target, A.id_order, A.line) A
LEFT OUTER JOIN 
(SELECT C.id_order, SUM(A.qty) total_output  FROM transaksi_qc_endline A 
JOIN master_bundle B ON A.kode_barcode = B.barcode_bundle 
JOIN order_detail C ON B.id_order_detail = C.id_order_detail
WHERE A.tanggal = '$tgl' AND A.jam BETWEEN '$waktu_awal' AND '$waktu_akhir'
GROUP BY C.id_order)B
ON A.id_order = B.id_order
WHERE IFNULL(B.total_output, 0) < (IFNULL(A.target_jam, 0)) ";



$totalQuery = mysqli_query($koneksi,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);



if(isset($_POST['search']['value']))
{
$search_value = $_POST['search']['value'];
$sql .= " AND ( A.line LIKE '%".$search_value."%'  OR A.orc LIKE '%".$search_value."%' OR A.style LIKE '%".$search_value."%'
OR A.color LIKE '%".$search_value."%' OR A.costomer LIKE '%".$search_value."%' OR A.no_po LIKE '%".$search_value."%')";

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
$sql .= " ORDER BY A.line, A.costomer";
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
$nestedData['costomer'] = $r['costomer'];
$nestedData['no_po'] = $r['no_po'];
$nestedData['item'] = $r['item'];
$nestedData['orc'] = $r['orc'];
$nestedData['style'] = $r['style'];
$nestedData['color'] = $r['color'];
$nestedData['line'] = strtoupper($r['line']);
$nestedData['jml_jam_normal'] = $r['jml_jam_normal'];
$nestedData['target_jam'] = $r['target_jam'];
$nestedData['total_output'] = $r['total_output'];
$nestedData['balance_target'] = $r['balance_target'];


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