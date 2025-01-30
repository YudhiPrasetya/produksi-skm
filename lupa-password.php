<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
        $edit = @$_POST['rowedit'];
        // mengambil data berdasarkan nis
        $sql = tampilkan_user_id($edit); // memilih entri nim pada database
		      $data = mysqli_fetch_array($sql);

			?>

        <form name="modal_popup" enctype="multipart/form-data" method="post">

            <input type="hidden" name='id_user' class="form-control" value="<?php echo "$data[id_user]"; ?>"  />
            <div class="form-group">
              <label>PASSWORD BARU</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-cog"></i>
                </div>
            <input type="password" id="password2" name='password2' class="form-control" placeholder="Masukkan Password Baru">
            </div>
          </div>

          <div class="form-group">
              <label>KONFIRMASI PASSWORD BARU</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-cog"></i>
                </div>
            <input type="password" id="password3" name='password3' class="form-control" placeholder="Masukkan Password Baru Lagi">
            </div>
            <input type="checkbox" id="show-password" name="show-password" onclick="myFunction()" value="" /> <label for="show-password" style="color:blue">Lihat Password</label>
          </div>

        
             </div>
       <div class="modal-footer" style="margin-top:20px;">
        <input name='lupa' type="submit" value="Simpan" id="button" class="btn btn-success"/>
         </form>
                </div>


<!-- Modal edit -->
<?php
		 } ?>

         <!-- melihat password -->
<script>
   function myFunction() {
  var x = document.getElementById("password2");
      y = document.getElementById("password3");
  if (x.type === "password" && x.type === "password") {
    x.type = "text";
    y.type = "text";
  } else {
    x.type = "password";
    y.type = "password";
  }


//   var y = document.getElementById("password3");
//   if (y.type === "password") {
//     y.type = "text";
//   } else {
//     y.type = "password";
//   }
}
</script>
