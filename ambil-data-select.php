<?php
require_once 'core/init.php';
    
if ($_POST['type'] == 'line_lantai') {
    $lantai = $_POST["lantai"];

    $line = tampilkan_master_line_lantai($lantai); ?> 
    <option value="all" selected>-- Pilih Line --</option>
<?php
    while($hasil = mysqli_fetch_assoc($line)){ ?>
    
    <option value = "<?= $hasil['nama_line'] ?>">LINE <?= strtoupper($hasil['nama_line']) ?></option>
<?php   
}        
        
}

if ($_POST['type'] == 'pilihan_reject') {  

    $type_reject = $_POST["type_reject"];
    $sql = tampilkan_master_reject_type($type_reject);
    while($hasil = mysqli_fetch_assoc($sql)){ ?>
<option value = "<?= $hasil['id'] ?>"><?= ucwords($hasil['nama_reject_eng'])." ( ".ucwords($hasil['nama_reject_ind'])." )" ?></option>

<?php
    }
}

?>