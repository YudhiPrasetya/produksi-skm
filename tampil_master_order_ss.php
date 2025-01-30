<?php
require_once 'core/init.php';

if($_POST['action'] == "table_data"){
    $status = $_POST['status']; 
    $costomer = $_POST['costomer']; 
    $orc = $_POST['orc']; 
    $po = $_POST['po'];
    $style = $_POST['style']; 
    
    if($status == 'open'){
        $action = 'close';
        $glyphicon = 'remove';
    }else{
        $action = 'open';
        $glyphicon = 'folder-open';
    }
    $columns = array( 
                             0 =>'id_order', 
                             1 =>'costomer',
                             2=> 'orc',
                             3=> 'no_po',
                             4=> 'style',
                             5=> 'label',
                             6=> 'color',
                             7=> 'qty_order',
                             8=> 'status',
                             9=> 'id_order',
                         );


    $sql = "SELECT D.costomer,  B.orc, B.id_order, B.no_po, B.label, C.style, B.color, B.status, B.qty_order FROM master_order B 
    JOIN style C ON B.id_style = C.id_style JOIN costomer D ON D.id_costomer = B.id_costomer";

    $sql .= " WHERE B.status = '$status' AND D.costomer like '%$costomer%' AND B.orc like '%$orc%' AND B.no_po like '%$po%' AND C.style like '%$style%'";
    $group = "GROUP BY B.orc";
    $sql1 = "$sql $group";

    $totalQuery = mysqli_query($koneksi,$sql1);
    $total_all_rows = mysqli_num_rows($totalQuery);

    
   
    if(isset($_POST['search']['value']))
    {
        $search_value = $_POST['search']['value'];
        $sql .= " AND ( D.costomer LIKE '%".$search_value."%' OR B.orc LIKE '%".$search_value."%'
         OR B.no_po LIKE '%".$search_value."%' OR C.style LIKE '%".$search_value."%' OR B.color LIKE '%".$search_value."%'
         OR B.qty_order LIKE '%".$search_value."%')";
        
    }
    $sql .= " GROUP BY B.orc";

   
    if(isset($_POST['order']))
    {
        $column_name = $_POST['order'][0]['column'];
        $order = $_POST['order'][0]['dir'];
        $sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
    }
    else
    {
        $sql .= " ORDER BY id_order desc";
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
              $nestedData['check'] =  "<input type='checkbox' class='check-item' name='id[]' value='$r[id_order]'>";
              $nestedData['costomer'] = $r['costomer'];
              $nestedData['orc'] = $r['orc'];
              $nestedData['no_po'] = $r['no_po'];
              $nestedData['style'] = $r['style'];
              $nestedData['label'] = $r['label'];
              $nestedData['color'] = $r['color'];
              $nestedData['total'] = $r['qty_order'];
              $nestedData['status'] = $r['status'];
              $nestedData['aksi'] = '<button type="button" id="detail" data-toggle="modal" data-target="#myDetail" class="btn btn-primary edit_komentar kecil" data-id="'.$r['id_order'].'"><i class="glyphicon glyphicon-zoom-in"></i></button>
              <a href="edit_master_order.php?id='.$r['id_order'].'"><button type="button" onclick="return konfirmasi_edit()" class="btn btn-xs btn-success kecil"><i class="glyphicon glyphicon-edit"></i></button></a>
              <a href="barcode_master_order.php?id='.$r['id_order'].'"><button type="button" onclick="return konfirmasi_edit()" class="btn btn-xs btn-warning kecil"><i class="glyphicon glyphicon-barcode"></i></button></a> 
              <a href="proses_'.$action.'_master_order.php?id='.$r['id_order'].'"><button type="button" onclick="return konfirmasi_'.$action.'()" class="btn btn-xs btn-info kecil"><i class="glyphicon glyphicon-'.$glyphicon.'"></i></button></a>
              <a href="hapus_master_order.php?id='.$r['id_order'].'"><button type="button" onclick="return konfirmasi()" class="btn btn-xs btn-danger kecil"><i class="glyphicon glyphicon-trash"></i></button></a>
                ';
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