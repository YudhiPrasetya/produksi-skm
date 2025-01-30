<?php

function run($query){
  global $koneksi;

  if(mysqli_query($koneksi, $query)) return true;
  else return false;
}
?>
