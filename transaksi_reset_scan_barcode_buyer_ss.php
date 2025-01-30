<?php
require_once 'core/init.php'; 

if($_POST['action'] == "table_data"){


  $orc = $_POST['orc'];
  $style = $_POST['style'];
  $id_costomer = $_POST['id_costomer'];
  $no_po = $_POST['po'];
  $color = $_POST['color'];
  $kelompok = $_POST['kelompok'];
  $var_sumsize = $_POST['var_sumsize'];
  $var_detailsize = $_POST['var_detailsize'];
  $arr_detailsize = explode (",",$var_detailsize);
  array_push($arr_detailsize,"jumlah_size","kelompok");
        
        $count_detailsize = count($arr_detailsize);
        
        $columns1 = array( 
          0=> 'no_trx', 
          1=> 'no_trx',
          2=> 'tanggal',
          3=> 'jam',
          4=> 'no_trx_pack',
          5=> 'tanggal_pack',
          6=> 'jam_pack',
          7=> 'no_po',
          8=> 'orc',
          9=> 'label',
          10=> 'style',
          11=> 'warna',
          );
          
          $count_columns1 = count($columns1);

          for($i=$count_columns1; $i<($count_detailsize+$count_columns1); $i++){
          $urutan[] =  $i;
          }

          $columns2 = array_combine($urutan, $arr_detailsize);
          
          $columns = array_merge($columns1, $columns2);
  

$sql = "SELECT C.orc, C.no_po, C.label, D.style, B.warna,C.orc, C.no_po, C.label, D.style, 
B.warna, A.no_trx, A.tanggal, A.jam, G.no_trx AS no_trx_pack, G.tanggal AS tanggal_pack, G.jam AS jam_pack, 
 $var_sumsize,  
         sum(A.qty) AS jumlah_size,
         COUNT(DISTINCT A.no_trx) AS karton, A.kelompok
  FROM transaksi_kenzin A
  join barang B ON A.kode_barcode = B.kode_barcode
  JOIN master_order	C ON A.orc = C.orc 
  JOIN style D ON B.id_style = D.id_style
  JOIN costomer E ON C.id_costomer = E.id_costomer
  LEFT OUTER JOIN size F ON B.size = F.size AND IFNULL(B.cup, '') = IFNULL(F.cup, '')
  LEFT OUTER JOIN transaksi_packing G ON A.no_trx = G.no_before AND A.orc = G.orc AND A.kode_barcode = G.kode_barcode
  ";

if($_POST['checkstyle'] == 'iya'){
    if($kelompok != ''){
        $where = " WHERE IFNULL(G.shipment, 'n') = 'n' AND C.status = 'open' AND C.no_po LIKE '%$no_po%' AND A.orc LIKE '%$orc%' AND D.style = '$style' AND C.id_costomer = $id_costomer 
        AND A.no_trx >= 10331 AND A.kelompok = '$kelompok' AND B.warna like '%$color%'";
    }else{
        $where = " WHERE IFNULL(G.shipment, 'n') = 'n' AND C.status = 'open' AND C.no_po LIKE '%$no_po%' AND A.orc LIKE '%$orc%' AND D.style = '$style' AND C.id_costomer = $id_costomer 
        AND A.no_trx >= 10331 AND B.warna like '%$color%'";
    }
}else{
    if($kelompok != ''){
        $where = " WHERE IFNULL(G.shipment, 'n') = 'n' AND C.status = 'open' AND C.no_po LIKE '%$no_po%' AND A.orc LIKE '%$orc%' AND D.style LIKE '%$style%' AND C.id_costomer = $id_costomer 
        AND A.no_trx >= 10331 AND A.kelompok = '$kelompok' AND B.warna like '%$color%'";
    }else{
        $where = " WHERE IFNULL(G.shipment, 'n') = 'n' AND C.status = 'open' AND C.no_po LIKE '%$no_po%' AND A.orc LIKE '%$orc%' AND D.style LIKE '%$style%' AND C.id_costomer = $id_costomer 
        AND A.no_trx >= 10331 AND B.warna like '%$color%'";
    }
}

$sql1 = "SELECT C.orc, C.no_po, C.label, D.style, B.warna, A.no_trx, A.tanggal, A.jam, 
A.no_trx
  FROM transaksi_kenzin A
  join barang B ON A.kode_barcode = B.kode_barcode
  JOIN master_order	C ON A.orc = C.orc 
  JOIN style D ON B.id_style = D.id_style
  JOIN costomer E ON C.id_costomer = E.id_costomer 
  LEFT OUTER JOIN size F ON B.size = F.size AND IFNULL(B.cup, '') = IFNULL(F.cup, '')
  LEFT OUTER JOIN transaksi_packing G ON A.no_trx = G.no_before AND A.orc = G.orc AND A.kode_barcode = G.kode_barcode";


$sql2 = $sql1.$where;
$sql = $sql.$where;

$totalQuery = mysqli_query($koneksi,$sql2);
$total_all_rows = mysqli_num_rows($totalQuery);



if(isset($_POST['search']['value']))
{
$search_value = $_POST['search']['value'];
$sql .= " AND ( A.no_trx LIKE '%".$search_value."%' OR A.tanggal LIKE '%".$search_value."%'
OR C.no_po LIKE '%".$search_value."%' OR A.orc LIKE '%".$search_value."%' OR D.style LIKE '%".$search_value."%'
OR B.warna LIKE '%".$search_value."%' OR A.kelompok LIKE '%".$search_value."%')";

}
$sql .= " group by A.no_trx, A.orc, D.style, B.warna";


if(isset($_POST['order']))
{
$column_name = $_POST['order'][0]['column'];
$order = $_POST['order'][0]['dir'];
$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
$sql .= "  order BY A.no_trx desc";
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
$nestedData['no_trx_trash'] = '<button type="button"  class="btn btn-danger edit_komentar kecil delete_target" data-kenzin="'.$r['no_trx'].'" data-packing="'.$r['no_trx_pack'].'"><i class="glyphicon glyphicon-trash"></i></button>';
$nestedData['no_trx'] = $r['no_trx'];
$nestedData['tanggal'] = $r['tanggal'];
$nestedData['jam'] = $r['jam'];
$nestedData['no_trx_pack'] = $r['no_trx_pack'];
$nestedData['tanggal_pack'] = $r['tanggal_pack'];
$nestedData['jam_pack'] = $r['jam_pack'];
$nestedData['no_po'] = $r['no_po'];
$nestedData['orc'] = $r['orc'];
$nestedData['label'] = $r['label'];
$nestedData['style'] = $r['style'];
$nestedData['warna'] = $r['warna'];
for($i=0; $i<$count_detailsize; $i++){
    $nestedData[$arr_detailsize[$i]] = $r[$arr_detailsize[$i]];
}
$nestedData['jumlah_size'] = $r['jumlah_size'];
if($r['kelompok'] == 'full'){
    $nestedData['kelompok'] = 'FULL';
}elseif($r['kelompok'] == 'ecer'){
    $nestedData['kelompok'] = 'ECER';
}elseif($r['kelompok'] == 'mix'){
    $nestedData['kelompok'] = 'MIX_SIZE';
}elseif($r['kelompok'] == 'mix_style'){
    $nestedData['kelompok'] = 'MIX_STYLE';
}
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