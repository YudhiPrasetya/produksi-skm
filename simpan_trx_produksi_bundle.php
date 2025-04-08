<?php require_once "core/init.php";

// if(cek_status($_SESSION['username'] ) == 'admin' OR 
// cek_status($_SESSION['username'] ) == 'kensa' 
// ) {
// $id = 0;
$user;
$temp_table;
$table;
$proses;
$line;
$dataTransaksi;
$tgl = date('Y-m-d');

if(isset($_POST['kirim'])){
    $user = $_SESSION['username'];
    $temp_table = $_POST['temp_table'];
    $table = $_POST['table'];
    $proses = ucfirst($_POST['proses']);

    // var_dump($temp_table);
    // var_dump($table);
    // var_dump($proses);
    
    if(isset($_POST['line'])){
        $line = $_POST['line'];
        $id = kirim_data_transaksi_produksi_bundle_sewing($user, $temp_table, $table, $line);
        if($id > 0 && reset_temp_produksi_bundle($user, $temp_table)) {
            // session_start();

            session_destroy();
            session_start();

            $dataArray = array();
            $hasil = tampil_monitor_qc_endline($tgl, $line);

            while($row = mysqli_fetch_assoc($hasil)){
                $data = ["orc" => preg_replace("/\s+/","",$row["orc"]), "status" => $row["status"], "style" => $row["style"], "color" => $row["color"],
                        "size" => $row["size"], "cup" => $row["cup"], "qty_order" => $row["QTY_ORDER"], "today" => $row["TODAY"],
                        "yesterday" => $row["YESTERDAY"], "total" => $row["TOTAL"], "bal" => $row["BAL"]];
                array_push($dataArray, $data);
            }
            
            $dataTransaksi = json_encode($dataArray);
            
            $_SESSION['pesan'] = "Data Transaksi $proses Berhasil disimpan";
            

            // header('Location: index.php');
            
            // header("Location:$temp_table.php");
            }else{
            echo "gagal menyalin data";
            }
    
    }else{
        $id = kirim_data_transaksi_produksi_bundle($user, $temp_table, $table);
        if($id > 0 && reset_temp_produksi_bundle($user, $temp_table)) {
            if($proses == 'sewing' || $proses == 'qc_endline' || $proses == 'qc_buyer' || $proses == 'qc_transfer' || $proses == 'tatami_in' || 
            $proses == 'tatami_out'){
            // session_destroy();
            // session_start();
            // $dataTransaksi = get_data_transaksi($id, $table);
            $dataArray = array();
            // $hasil = tampil_monitor_packing($tgl);
            $hasil = tampil_monitor_qc_endline($tgl, $line);

            while($row = mysqli_fetch_assoc($hasil)){
                $data = ["orc" => $row["orc"], "status" => $row["status"], "style" => $row["style"], "color" => $row["color"],
                        "size" => $row["size"], "cup" => $row["cup"], "qty_order" => $row["QTY_ORDER"], "today" => $row["TODAY"],
                        "yesterday" => $row["YESTERDAY"], "total" => $row["TOTAL"], "bal" => $row["BAL"]];
                array_push($dataArray, $data);
            }
            
            $dataTransaksi = json_encode($dataArray);            
            
            $_SESSION['pesan'] = "Data Transaksi $proses Berhasil disimpan";
            // header('Location: index.php');
            header("Location:$temp_table.php");
            }else{
                $_SESSION['pesan'] = "Data Transaksi $proses Berhasil disimpan";
                header("Location:$temp_table.php");
            }
        }else{
        echo "gagal menyalin data";
        }
    }
} 

// } else {
//     echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

<html>
    <body>
        <div></div>
        <script src="assets/js/jquery.min.js"></script>
        <script>
            var qcEndline = new WebSocket("ws://localhost:10000/?service=qc_endline");
            // var qcEndline = new WebSocket("ws://localhost:10000/?service=packing");

            qcEndline.onopen = function(){
                let dataTransaksi = '<?= $dataTransaksi; ?>';
                let line = '<?= $line ?>';
                let tempTable = '<?= $temp_table; ?>';

                qcEndline.send(dataTransaksi);

                if(line != null){
                    window.open("http://localhost/produksi-skm/index.php", "_self");
                }else{
                    window.open("http://localhost/produksi-skm/" + tempTable + ".php", "_self");
                }
            }

        </script>
    </body>
</html>
