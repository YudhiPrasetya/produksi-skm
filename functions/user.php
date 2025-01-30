<?php

function register_user($username, $pass, $nama, $level, $line){

  global $koneksi;

  // menjegah sql injection

  $username = escape($username);
  $pass = escape($pass);
  $nama = escape($nama);
  $level = escape($level);
  $line = escape($line);
  $pass = password_hash($pass, PASSWORD_DEFAULT);
  $query = "INSERT INTO user (username, password, nama, level, line) VALUES ('$username', '$pass', '$nama', '$level', '$line')";

  if(mysqli_query($koneksi, $query)){
    return true;
  }else{
    return false;
  }
}

  // Menguji nama kembar sblm refactory

// function register_cek_user($username){
//   global $koneksi;
//   $username = escape($username);
//   $query = "SELECT username FROM user where username='$username'";

//   if( $result = mysqli_query($koneksi, $query) ){
//     if(mysqli_num_rows($result) == 0) return true;
//     else return false;
//   }
// }

// //menguji login cek username 

// function login_cek_username($username){
//   global $koneksi;
//   $username = escape($username);
//   $query = "SELECT username FROM user where username='$username'";

//   if( $result = mysqli_query($koneksi, $query) ) {
//     if(mysqli_num_rows($result) != 0) return true;
//     else return false;
//   }
// }

//hasil refactory

function cek_username($username){
  global $koneksi;
  $username = escape($username);
  $query = "SELECT username FROM user where username='$username'";

  if( $result = mysqli_query($koneksi, $query) ) {
    return mysqli_num_rows($result);
  }
}

function cek_kode_akses_username($username, $kode_akses){
  global $koneksi;
  $username = escape($username);
  $kode_akses = escape($kode_akses);
  $query = "SELECT username FROM user where username='$username' AND kode_akses = '$kode_akses'";

  if( $result = mysqli_query($koneksi, $query) ) {
    return mysqli_num_rows($result);
  }
}




//Untuk Login
function cek_data($username, $pass){
  global $koneksi;
  $username = escape($username);


  $query = "SELECT * from user where username='$username' and status = 'aktif'";
  $result = mysqli_query($koneksi, $query);
  $hash = mysqli_fetch_assoc($result);

  // var_dump($hash);

  if( password_verify($pass, $hash['password']) ){
    return true;
  }else{
    return false;
  }
  

  // return $result1;
}

// function buat_session($username, $pass){
//   global $koneksi;
//   $username = escape($username);
//   $nama = escape($nama);
//   $level = escape($level);

//   $query = "SELECT password from user where username='$username'";
//   $result = mysqli_query($koneksi, $query);
//   $hash = mysqli_fetch_assoc($result);

//   if( $hash2 = password_verify($pass, $hash['password']) ){
//     return true;
//   }else{
//     return false;
//   }

//   $query1 = "SELECT username, nama, level from user where username='$username' && password='$pass'";
//   $result1 = mysqli_query($koneksi, $query1);

//   return $result1;
// }

function cek_status($username){
  global $koneksi;

  $username=escape($username);
  $query = "SELECT level FROM user where username='$username'";

  $result = mysqli_query($koneksi, $query);
  $status = mysqli_fetch_assoc($result)['level']; 
  return $status;
  // die($status);
  // if ( $status == 'admin') return true;
  // else return false;
}



function tampilkan_level(){
  global $koneksi;

  $query = "SELECT DISTINCT(level) FROM user";
  $result = mysqli_query($koneksi, $query) or die('gagal menampilkan data');

  return $result;
}

function tampilkan_user(){
  global $koneksi;

  $query = "SELECT * FROM user";
  $result = mysqli_query($koneksi, $query) or die('gagal menampilkan data');

  return $result;
}

function tampilkan_user_id($edit){
  global $koneksi;


  $query = "SELECT * FROM user where id_user = '$edit'";
  $result = mysqli_query($koneksi, $query) or die('gagal menampilkan data');

  return $result;

}

function tampilkan_user_id_in($data){
  global $koneksi;


  $query = "SELECT * FROM user where id_user IN($data)";
  $result = mysqli_query($koneksi, $query) or die('gagal menampilkan data');

  return $result;

}

function tampilkan_line_username($username){
  global $koneksi;


  $query = "SELECT line FROM user where username = '$username'";
  $result = mysqli_query($koneksi, $query) or die('gagal menampilkan data');

  return $result;

}

function edit_data_user($id, $username, $nama, $level, $status, $line){
  global $koneksi;

    $query = "UPDATE user SET username='$username', nama='$nama', level='$level', status = '$status', line = '$line'
     WHERE id_user='$id'";

    $result = mysqli_query($koneksi, $query) or die('gagal menampilkan data');

    return $result;

}

function lupa_password($id, $password1) {
  global $koneksi;
  $password1 = escape($password1);
  $password1 = password_hash($password1, PASSWORD_DEFAULT);

  $query = "UPDATE user SET password='$password1' WHERE id_user='$id'";

  $result = mysqli_query($koneksi, $query) or die('gagal menampilkan data');

    return $result;
}


function hapus_data_user($id){
  global $koneksi;

  $query = "DELETE FROM user where id_user='$id'";
  return run($query);

}

// mencegah sql injection  
function escape($data){
  global $koneksi;
  return mysqli_real_escape_string($koneksi, $data);
}


 ?>

