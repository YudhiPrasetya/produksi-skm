<?php  
//   include 'functions/db.php';
  require_once 'core/init.php';

  if(isset($_POST["query"])){
    $output = '';
    $key = "%".$_POST["query"]."%";
    $query = "SELECT distinct orc FROM transaksi_packing WHERE kelompok != 'mix_style' and orc LIKE ? LIMIT 10";
    $dewan1 = $koneksi->prepare($query);
    $dewan1->bind_param('s', $key);
    $dewan1->execute();
    $res1 = $dewan1->get_result();

    $output = '<ul class="list-unstyled">';
    if($res1->num_rows > 0){
      while ($row = $res1->fetch_assoc()) {
        $output .= '<li class=orc>'.$row["orc"].'</li>';  
      }
    } else {
      $output .= '<li class=orc>Tidak ada yang cocok.</li>';  
    }  
    $output .= '</ul>';
    echo $output;
  }

  
?>