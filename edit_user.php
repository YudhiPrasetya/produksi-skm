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
              <div class="form-group">
              <label>Nama Lengkap</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-barcode"></i>
              </div>
              <input type="hidden" name='id_user' class="form-control" value="<?php echo "$data[id_user]"; ?>"  />
              <input name='nama' class="form-control" value="<?php echo "$data[nama]"; ?>">
            </div>
          </div>

          <div class="form-group">
              <label>Username</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-barcode"></i>
              </div>
              <input name='username' class="form-control" value="<?php echo "$data[username]"; ?>">
            </div>
          </div>
 

    <div class="form-group" >
    <label>Level</label>
    <div class="input-group">
      <div class="input-group-addon">
      <i class="glyphicon glyphicon-th-list"></i>
    </div>
    <select class="form-control" name="level" id="level2" style="width: 100%">
    <?php
        $level = tampilkan_level_user();
        while($hasil = mysqli_fetch_assoc($level)){
          if($hasil['level']==$data['level']){
            echo "<option value = ".$hasil['level']."selected>".strtoupper($hasil['level'])."</option>";
          }else{
            echo "<option value = ".$hasil['level'].">".strtoupper($hasil['level'])."</option>";
          }
        }
        ?>
  </select>
  </div>
  </div>

  <div class="form-group" >
    <label>LINE SEWING</label>
    <div class="input-group">
      <div class="input-group-addon">
      <i class="glyphicon glyphicon-th-list"></i>
    </div>
    <select class="form-control" name="line" id="line2" style="width: 100%">
    <option value="" >NOT LINE</option>
    <?php
    
        $line = tampilkan_master_line();
        while($hasil = mysqli_fetch_assoc($line)){
          
          if($hasil['nama_line'] == $data['line']){
            echo "<option value = ".$hasil['nama_line']." selected>".strtoupper($hasil['nama_line'])."</option>";
          }else{
            echo "<option value = ".$hasil['nama_line'].">".strtoupper($hasil['nama_line'])."</option>";
          }
        }
        ?>
  </select>
  </div>
  </div>

         <div class="form-group">
          <label>STATUS</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-th-list"></i>
          </div>
          <select id="status" class="form-control" name="status" required>
              <option value="">--- Pilih STATUS ---</option>
              <option value="aktif" <?php if($data['status'] == 'aktif'){ echo 'selected'; } ?>>Aktif</option>
              <option value="non_aktif" <?php if($data['status'] == 'non_aktif'){ echo 'selected'; } ?>>Non Aktif</option>
        </select>
          </div>
         </div>
        
             </div>
       <div class="modal-footer" style="margin-top:20px;">
        <input name='update' type="submit" value="Simpan" id="button" class="btn btn-success"/>
         </form>
                </div>

<script>
   $(document).ready(function () {
     $("#level2").select2({
       theme: 'bootstrap4',
       placeholder: "Please Select"
      });

       $("#line2").select2({
           theme: 'bootstrap4',
           placeholder: "Please Select"
       });
 
    });
</script>
<!-- Modal edit -->
<?php
		 } ?>
