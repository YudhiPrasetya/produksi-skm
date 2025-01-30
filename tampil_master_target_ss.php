<?php
require_once 'core/init.php';

if($_POST['action'] == "table_data"){
    $costomer = $_POST['costomer'];
    $orc = $_POST['orc'];
    $no_po = $_POST['no_po'];
    $style = $_POST['style'];
    $status = $_POST['status'];
    $line = $_POST['line'];
    $today = date("Y-m-d");

    $date_target = $_POST['date_target'];
    $checkstyle = $_POST['checkstyle'];
    $checktarget = $_POST['checktarget'];
    
    $columns = array( 
                             0 => 'no', 
                             1 => 'hari', 
                             2 => 'date_target', 
                             3 => 'orc',
                             4=> 'style',
                             5=> 'color',
                             6=> 'order',
                             7=> 'costomer',
                             8=> 'no_po',
                             9=> 'line',
                             10=> 'nilai_smv',
                             11=> 'persentase_target',
                             12=> 'man_power',
                             13=> 'jml_jam_normal',
                             14=> 'target_jam',
                             15=> 'target_days',
                             16=> 'man_power_lembur',
                             17=> 'jml_lembur',
                             18=> 'target_jam_lembur',
                             19=> 'target_days_lembur',
                             20=> 'status',
                             21=> 'id',
                         );


    $sql = "SELECT CASE DAYOFWEEK(A.date_target)
    WHEN 1 THEN 'Minggu'
    WHEN 2 THEN 'Senin'
    WHEN 3 THEN 'Selasa'
    WHEN 4 THEN 'Rabu'
    WHEN 5 THEN 'Kamis'
    WHEN 6 THEN 'Jumat'
    WHEN 7 THEN 'Sabtu'
END AS hari, A.date_target, A.id_order, B.orc, C.style, B.color, SUM(D.qty_order) qty_order, 
E.costomer, B.no_po, A.nilai_smv, A.line, A.man_power, A.jml_jam_normal, A.man_power_lembur, A.jml_lembur,
A.persentase_target, ROUND(((60/A.nilai_smv)*A.man_power*(A.persentase_target/100)),0) target_jam,
(ROUND(((60/A.nilai_smv)*A.man_power*(A.persentase_target/100)),0) * A.jml_jam_normal) target_days,
ROUND(((60/A.nilai_smv)*IFNULL(A.man_power_lembur, 0)*(A.persentase_target/100)),0) target_jam_lembur,
(ROUND(((60/A.nilai_smv)*IFNULL(A.man_power_lembur, 0)*(A.persentase_target/100)),0) * A.jml_lembur ) target_days_lembur,
B.`status`, A.id  FROM
master_target A JOIN master_order B ON A.id_order = B.id_order
JOIN style C ON B.id_style = C.id_style
JOIN order_detail D ON B.id_order = D.id_order
JOIN costomer E ON B.id_costomer = E.id_costomer
    ";

    $sql1 = "SELECT A.date_target, A.id_order, A.id  FROM
    master_target A JOIN master_order B ON A.id_order = B.id_order
    JOIN style C ON B.id_style = C.id_style
    JOIN order_detail D ON B.id_order = D.id_order
    JOIN costomer E ON B.id_costomer = E.id_costomer";

    if($checkstyle == 'iya'){
        if($line != 'all'){
            if($checktarget == 'iya'){
                $where = " WHERE B.status = '$status' AND E.costomer like '%$costomer%' AND B.orc like '%$orc%' AND B.no_po like '%$no_po%' AND C.style = '$style'
                 AND A.line = '$line' AND A.date_target = '$date_target'";
            }else{
                $where = " WHERE B.status = '$status' AND E.costomer like '%$costomer%' AND B.orc like '%$orc%' AND B.no_po like '%$no_po%' AND C.style = '$style'
                 AND A.line = '$line'";
            }
        }else{
            if($checktarget == 'iya'){
                $where = " WHERE B.status = '$status' AND E.costomer like '%$costomer%' AND B.orc like '%$orc%' AND B.no_po like '%$no_po%' AND C.style = '$style'
                AND A.date_target = '$date_target'";
            }else{
                $where = " WHERE B.status = '$status' AND E.costomer like '%$costomer%' AND B.orc like '%$orc%' AND B.no_po like '%$no_po%' AND C.style = '$style'";
            }
        }
    }else{
        if($line != 'all'){
            if($checktarget == 'iya'){
                $where = " WHERE B.status = '$status' AND E.costomer like '%$costomer%' AND B.orc like '%$orc%' AND B.no_po like '%$no_po%' AND C.style LIKE '%$style%'
                 AND A.line = '$line' AND A.date_target = '$date_target'";
            }else{
                $where = " WHERE B.status = '$status' AND E.costomer like '%$costomer%' AND B.orc like '%$orc%' AND B.no_po like '%$no_po%' AND C.style LIKE '%$style%'
                 AND A.line = '$line'";
            }
        }else{
            if($checktarget == 'iya'){
                $where = " WHERE B.status = '$status' AND E.costomer like '%$costomer%' AND B.orc like '%$orc%' AND B.no_po like '%$no_po%' AND C.style LIKE '%$style%'
                AND A.date_target = '$date_target'";
            }else{
                $where = " WHERE B.status = '$status' AND E.costomer like '%$costomer%' AND B.orc like '%$orc%' AND B.no_po like '%$no_po%' AND C.style LIKE '%$style%'";
            }
        }
    }
    


    $group = " GROUP BY A.date_target, A.id_order, A.line";

    $sql1 = $sql1.$where.$group;

    $sql = $sql.$where;

    $totalQuery = mysqli_query($koneksi,$sql1);
    $total_all_rows = mysqli_num_rows($totalQuery);

    
   
    if(isset($_POST['search']['value']))
    {
        $search_value = $_POST['search']['value'];
        $sql .= " AND ( A.date_target LIKE '%".$search_value."%' OR B.orc LIKE '%".$search_value."%'
         OR B.no_po LIKE '%".$search_value."%' OR C.style LIKE '%".$search_value."%' OR B.color LIKE '%".$search_value."%'
         OR E.costomer LIKE '%".$search_value."%' OR A.line LIKE '%".$search_value."%')";
        
    }
    $sql .= " GROUP BY A.date_target, A.id_order, A.line";

   
    if(isset($_POST['order']))
    {
        $column_name = $_POST['order'][0]['column'];
        $order = $_POST['order'][0]['dir'];
        $sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
    }
    else
    {
        $sql .= " ORDER BY A.id desc";
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
              $nestedData['no'] = $no;
              $nestedData['hari'] =  $r['hari'];
              $nestedData['date_target'] =  $r['date_target'];
              $nestedData['orc'] = $r['orc'];
              $nestedData['style'] = $r['style'];
              $nestedData['color'] = $r['color'];
              $nestedData['qty_order'] = $r['qty_order'];
              $nestedData['costomer'] = $r['costomer'];
              $nestedData['no_po'] = $r['no_po'];
              $nestedData['line'] = strtoupper($r['line']);
              $nestedData['nilai_smv'] = $r['nilai_smv'];
              $nestedData['persentase_target'] = $r['persentase_target'];
              $nestedData['man_power'] = $r['man_power'];
              $nestedData['jml_jam_normal'] = $r['jml_jam_normal'];
              $nestedData['target_jam'] = $r['target_jam'];
              $nestedData['target_days'] = $r['target_days'];
              $nestedData['man_power_lembur'] = $r['man_power_lembur'];
              $nestedData['jml_lembur'] = $r['jml_lembur'];
              $nestedData['target_jam_lembur'] = $r['target_jam_lembur'];
              $nestedData['target_days_lembur'] = $r['target_days_lembur'];
              $nestedData['status'] = $r['status'];
              $nestedData['action'] = '<button type="button" class="copy_target btn btn-info edit_komentar kecil" data-id="'.$r['id'].'"><i class="glyphicon glyphicon-transfer"></i></button>
              ';
            //   if($r['date_target'] >= $today){
              $nestedData['action'] .= '<button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil edit_target" data-id="'.$r['id'].'"><i class="glyphicon glyphicon-edit"></i></button>
               <button type="button"  class="btn btn-danger edit_komentar kecil delete_target" data-id="'.$r['id'].'"><i class="glyphicon glyphicon-trash"></i></button>';
            //   }
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