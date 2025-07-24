<?php require_once "core/init.php";

// if(cek_status($_SESSION['username'] ) == 'admin' OR 
// cek_status($_SESSION['username'] ) == 'kensa' 
// ) {
// $id = 0;
$user;
$temp_table;
$table;
$proses;
$line='';
$dataTransaksi='';
$dataTransaksiTatami='';
$tgl = date('Y-m-d');

if(isset($_POST['kirim'])){
    $user = $_SESSION['username'];
    $temp_table = $_POST['temp_table'];
    $table = $_POST['table'];
    $proses = ucfirst($_POST['proses']);

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
                $data = [
                    "id" => $row["id"],
                    "orc" => preg_replace("/\s+/","",$row["orc"]), 
                    "line" => $row["line"], 
                    "status" => $row["status"], 
                    "style" => $row["style"],
                    "smv" => $row["smv"], 
                    "color" => $row["color"],
                    "size" => $row["size"], 
                    "cup" => $row["cup"], 
                    "qty_order" => $row["QTY_ORDER"], 
                    "today" => $row["TODAY"],
                    "total" => $row["TOTAL"], 
                    "bal" => $row["BAL"], 
                    "tanggal" => $row["tanggal"], 
                    "jam" => $row["JAM"]
                ];
                array_push($dataArray, $data);
            }

            $dataOutput = [];
            $hasilOutput = get_output_qc_endline($tgl, $line);
            while($r = mysqli_fetch_assoc($hasilOutput)){
                $dt = [
                    "id" => $r["id"], 
                    "orc" => preg_replace("/\s+/","",$r["orc"]), 
                    "line" => $r["line"], 
                    "style" => $r["style"], 
                    "smv" => $r["smv"],
                    "qty_order" => $r["qty_order"],
                    "qty" => $r["qty"], 
                    "tanggal" => $r["tanggal"], 
                    "jam" => $r["jam"]
                ];
                array_push($dataOutput, $dt);
            }

            $dtTrans = [
                "dataOutput" => $dataArray,
                "dataEff" => $dataOutput
            ];

            
            // $dataTransaksi = json_encode($dataArray);
            $dataTransaksi = json_encode($dtTrans);
            
            $_SESSION['pesan'] = "Data Transaksi $proses Berhasil disimpan";
            

            // header('Location: index.php');
            
            // header("Location:$temp_table.php");
        }else{
            // echo "gagal menyalin data";
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
                    $data = [
                        "id" => $row["id"],
                        "orc" => preg_replace("/\s+/","",$row["orc"]), 
                        "line" => $row["line"], 
                        "status" => $row["status"], 
                        "style" => $row["style"],
                        "smv" => $row["smv"], 
                        "color" => $row["color"],
                        "size" => $row["size"], 
                        "cup" => $row["cup"], 
                        "qty_order" => $row["QTY_ORDER"], 
                        "today" => $row["TODAY"],
                        "total" => $row["TOTAL"], 
                        "bal" => $row["BAL"], 
                        "tanggal" => $row["tanggal"], 
                        "jam" => $row["JAM"]
                    ];
                    array_push($dataArray, $data);
                }

                $dataOutput = [];
                $hasilOutput = get_output_qc_endline($tgl, $line);
                while($r = mysqli_fetch_assoc($hasilOutput)){
                    $dt = [
                        "id" => $r["id"], 
                        "orc" => preg_replace("/\s+/","",$r["orc"]), 
                        "line" => $r["line"], 
                        "style" => $r["style"], 
                        "smv" => $r["smv"],
                        "qty_order" => $r["qty_order"],
                        "qty" => $r["qty"], 
                        "tanggal" => $r["tanggal"], 
                        "jam" => $r["jam"]
                    ];
                    array_push($dataOutput, $dt);
                }
    
                $dtTrans = [
                    "dataOutput" => $dataArray,
                    "dataEff" => $dataOutput
                ];                
                
                $dataTransaksi = json_encode($dataArray);            
                
                $_SESSION['pesan'] = "Data Transaksi $proses Berhasil disimpan";
                // header('Location: index.php');
                // header("Location:$temp_table.php");
            }else{
                if($proses == "tatami"){
                    // session_destroy();
                    // session_start();

                    // $dataTransaksi = null;
                    // $line = null;
                    $hasilTatami = get_output_packing_today($line);
                    $packingLineToday = mysqli_fetch_assoc($hasilTatami);


                    $dataPackingLineToday = json_encode($packingLineToday);                
                    $_SESSION['pesan'] = "Data Transaksi $proses Berhasil disimpan";
                }else{
                    header("Location:$temp_table.php");
                }                
            }
        }
        // echo "gagal menyalin data";
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
            var proses = '<?= $proses; ?>';
            // console.log('proses: ', proses);
            // debugger;
            if(proses === 'Tatami'){
                sendPackingMsg();
            }else{
                sendQCEndlineMsg();
            }

            function sendQCEndlineMsg(){
                var qcEndline = new WebSocket("ws://192.168.90.100:10000/?service=qc_endline");
                // var qcEndline = new WebSocket("ws://localhost:10000/?service=qc_endline");
                qcEndline.onopen = function(){
                    let dataTransaksi = '<?= $dataTransaksi; ?>';
                    // console.log('dataTransaksi', dataTransaksi);
                    let line = '<?= $line ?>';
                    // console.log('line', line);
                    let tempTable = '<?= $temp_table; ?>';
                    // console.log('tempTable: ', tempTable);
                    // debugger;

                    if(dataTransaksi != '' && line != ''){
                        qcEndline.send(dataTransaksi);
    
                        if(line != null){
                            window.open("http://192.168.90.100/produksi-skm/index.php", "_self");
                            // window.open("http://localhost/produksi-skm/index.php", "_self");
                        }else{
                            window.open("http://192.168.90.100/produksi-skm/" + tempTable + ".php", "_self");
                            // window.open("http://localhost/produksi-skm/" + tempTable + ".php", "_self");
                        }
                    }
                }
            }

            function sendPackingMsg(){
                var packing = new WebSocket("ws://192.168.90.100:10000/?service=packing");
                packing.onopen = function(){
                    let dataPackingLineToday = '<?= $dataPackingLineToday; ?>';
                    if(dataPackingLineToday != ''){
                        packing.send(dataPackingLineToday);
                        
                        // window.open("http://192.168.90.100/produksi-skm/" + tempTableTatami + ".php", "_self");                
                    }
                }
            }
        </script>
    </body>
</html>
