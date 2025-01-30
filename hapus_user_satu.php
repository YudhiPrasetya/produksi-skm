<?php require_once "core/init.php";
// $edit = ;
$sql = tampilkan_user_id($_GET['id']);
$data = mysqli_fetch_array($sql);
// $data[username]

if(isset($_GET['id'])){
  if(hapus_data_user($_GET['id'])) {
    echo "<script>alert('Data User $data[username] Berhasil dihapus');window.location='master-user.php'</script>";
    // header('Location: master-user.php');
    // $error2 = 'Data Berhasil dihapus';
  }else{
  echo "gagal menghapus data";
  }
}
?>
