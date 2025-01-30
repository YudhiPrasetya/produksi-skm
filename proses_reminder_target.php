<?php

require_once 'core/init.php';

    if($_POST['type'] == 'target_qc_endline'){
    
        $jam = $_POST['jam'];
        $lantai = $_POST['lantai'];
        $tanggal = date("Y-m-d");

        if($jam <= 8){
            // $jam_ke = 1;
            $waktu_awal = '00:00:01';
            $waktu_akhir = '08:05:00';
        }elseif($jam <= 9){
            // $jam_ke = 2;
            $waktu_awal = '08:05:01';
            $waktu_akhir = '09:05:00';
        }elseif($jam <= 10){
            // $jam_ke = 3;
            $waktu_awal = '09:05:01';
            $waktu_akhir = '10:05:00';
        }elseif($jam <= 11){
            // $jam_ke = 4;
            $waktu_awal = '10:05:01';
            $waktu_akhir = '11:05:00';
        }elseif($jam <= 12){
            // $jam_ke = 5;
            $waktu_awal = '11:05:01';
            $waktu_akhir = '12:00:00';
        }elseif($jam <= 13){
            // $jam_ke = 5;
            $waktu = '11:05:01';
            $waktu = '13:05:00';
        }elseif($jam <= 14){
            // $jam_ke = 6;
            $waktu_awal = '13:05:01';
            $waktu_akhir = '14:05:00';
        }elseif($jam <= 15){
            // $jam_ke = 7;
            $waktu_awal = '14:05:01';
            $waktu_akhir = '15:05:00';
        }

        if(cek_input_master_target($tanggal, $lantai) !=0){
            if(cek_output_target_qc_endline($tanggal, $waktu_awal, $waktu_akhir, $lantai) != 0){
                echo "not_target";
            }else{
                echo "target_all";
            }
        }else{
            echo "no_master_target";
        }
    }

    if($_POST['type'] == 'kontrol_suara'){
        $kode_akses = $_POST['kode_akses'];
        $username = $_SESSION['username'];

        if(!empty(trim($kode_akses))){
            if(cek_kode_akses_username($username, $kode_akses) != 0){
                echo "success";   
            }else{
                echo "kode_akses_salah";
            }
        }else{
            echo "kosong";
        }

    }
?>
