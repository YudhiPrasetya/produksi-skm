<?php  
//   include 'functions/db.php';
  require_once 'core/init.php';

  if(isset($_POST["query"])){
    $output = '';
    $key = "%".$_POST["query"]."%";
    $query = "SELECT distinct C.no_po FROM transaksi_packing A JOIN master_order B ON A.orc = B.orc JOIN PO C ON B.id_po = C.id_po where A.kelompok != 'mix_style' and no_po LIKE ? LIMIT 10";
    $dewan1 = $koneksi->prepare($query);
    $dewan1->bind_param('s', $key);
    $dewan1->execute();
    $res1 = $dewan1->get_result();

    $output = '<ul class="list-unstyled">';
    if($res1->num_rows > 0){
      while ($row = $res1->fetch_assoc()) {
        $output .= '<li class=po>'.$row["no_po"].'</li>';  
      }
    } else {
      $output .= '<li class=po>Tidak ada yang cocok.</li>';  
    }  
    $output .= '</ul>';
    echo $output;
  }

  
?>