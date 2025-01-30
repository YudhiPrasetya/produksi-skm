<?php
require_once 'core/init.php';

if($_POST['action'] == "table_data"){
    $costomer = $_POST['costomer'];
    $filter_style = $_POST['filter_style'];
    $color = $_POST['color'];
    $checkstyle = $_POST['checkstyle'];


    $columns = array( 
                             0 =>'id_order', 
                             1 =>'kode_barcode',
                             2=> 'style',
                             3=> 'warna',
                             4=> 'size',
                             5=> 'cup',
                             6=> 'qty_barcode',
                             7=> 'costomer',
                             8=> 'weight',
                             9=> 'id_order',
                         );


    $sql = "SELECT A.kode_barcode, B.style, A.cup, A.warna, A.size, A.qty_barcode, A.weight ,IF(A.from_costomer='y', 'YES', 'NO') from_costomer, ifnull(C.costomer, '') costomer FROM 
    barang A join style B on A.id_style = B.id_style LEFT OUTER JOIN costomer C on B.id_costomer = C.id_costomer";
    if($checkstyle == 'iya'){
        $sql.= " WHERE IFNULL(C.costomer, '') like '%$costomer%' AND B.style = '$filter_style' AND A.warna like '%$color%'";
    }else{
        $sql.= " WHERE IFNULL(C.costomer, '') like '%$costomer%' AND B.style like '%$filter_style%' AND A.warna like '%$color%'";
    }
    $totalQuery = mysqli_query($koneksi,$sql);
    $total_all_rows = mysqli_num_rows($totalQuery);

    if(isset($_POST['search']['value']))
    {
        $search_value = $_POST['search']['value'];
        $sql .= " AND (A.kode_barcode LIKE '%".$search_value."%' OR B.style LIKE '%".$search_value."%'
         OR A.warna LIKE '%".$search_value."%' OR A.size LIKE '%".$search_value."%' OR IF(A.from_costomer='y', 'YES', 'NO') LIKE '%".$search_value."%') ";
        
    }

   
    if(isset($_POST['order']))
    {
        $column_name = $_POST['order'][0]['column'];
        $order = $_POST['order'][0]['dir'];
        $sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
    }
    else
    {
        $sql .= " ORDER BY A.date_create desc";
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
              $nestedData['kode_barcode'] = $r['kode_barcode'];
              $nestedData['style'] = $r['style'];
              $nestedData['warna'] = $r['warna'];
              $nestedData['size'] = $r['size'];
              $nestedData['cup'] = $r['cup'];
              $nestedData['qty_barcode'] = $r['qty_barcode'];
              $nestedData['costomer'] = $r['costomer'];
              $nestedData['weight'] = $r['weight'];
              $nestedData['aksi'] = '<button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" data-id="'.$r['kode_barcode'].'"><i class="glyphicon glyphicon-edit"></i></button>
              <a href="hapus_barang_satu.php?id='.$r['kode_barcode'].'"><button type="button" class="btn btn-xs btn-danger kecil"><i class="glyphicon glyphicon-trash"></i></button></a>';
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