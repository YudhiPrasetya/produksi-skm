<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<style>
/* Bordered form */
/* Full-width inputs */
input[type=text], input[type=password], select {
  width: 100%;
  padding: 8px 20px;
  margin: 10px 0;
  /* display: inline-block; */
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the avatar image inside this container */
.imgcontainer {
  text-align: center;
  margin: 15px 0 12px 0;
}

/* Avatar image */
img.avatar {
  width: 15%;
  /* border-radius: 50%; */
}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;
}

.alert{
	/* background: #e44e4e; */
	color: red;
	padding: 10px;
	text-align: center;
	border:1px solid #b32929;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }

}

</style>
<?php
if(cek_status($_SESSION['username'] ) == 'admin') {
  ?>

<?php
$error='';
  if( isset($_POST['submit'])){
    $username = $_POST['username'];
    $pass =  $_POST['password'];
    $nama = $_POST['nama'];
    $level = $_POST['level'];

    if(!empty(trim($username)) && !empty(trim($pass)) && !empty(trim($nama)) && !empty(trim($level))){
      //memasukkan ke database
      if(cek_username($username) == 0){
        if(register_user($username, $pass, $nama, $level)){
          $error =  'berhasil';
        }else{
          $error = 'gagal';
        }
      }else{
        $error = 'Username sudah terpakai';
      }

      }else{
        $error = 'Data tidak boleh ada yang kosong';
      }
    }
  
?>
<h2 style='text-align:center; color: blue;'>Tambah User Baru</h2>
  <form action="register.php" method="post">
  <div class="imgcontainer">
    <img src="img/iconuser.png" alt="Avatar" class="avatar">
  </div>


  <div class="container">
  <div class="col-sm-6">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Masukkan Username" name="username" class="form-control" required>
    <label for="nama"><b>Nama</b></label>
    <input type="text" placeholder="Masukkan Nama Lengkap" name="nama" class="form-control" required>
  </div>
  <div class="col-sm-6">
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Masukkan Password" name="password" class="form-control" required>

    <label for="level"><b>Level</b></label>
    <!-- <input type="text" placeholder="Enter Level" name="level" class="form-control" required> -->
    <select class="form-control" name="level" required>
      <option value="" selected>Pilih Level</option>
      <option value="admin">Admin</option>
      <option value="ppic">PPIC</option>
      <option value="kenzin">Kenzin</option>
      <option value="packing">Packing</option>
    </select>
  </div>
  <button type="submit" name="submit">Register</button>
  

</div>

<div class="container" style="background-color:#f1f1f1">
    <span class="error">
    <?php
    	echo $error;
    ?>
    </span>
</div>
<!-- penutup hak akses level -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>
