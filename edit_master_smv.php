<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
        $edit = @$_POST['rowedit'];
        // mengambil data berdasarkan nis
        $sql = tampilkan_master_smv_id($edit); // memilih entri nim pada database
          $data = mysqli_fetch_array($sql);
         
	?>

              <form name="modal_popup" enctype="multipart/form-data" method="post">

              <input type="hidden" name='id' class="form-control" value="<?= $data['id']; ?>"  />

          <div class="form-group">
          <label for="item">STYLE</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-list-alt"></i>
          </div>
          <select id="style" class="form-control" name="style"  disabled>
        
          <?php
            $style = tampilkan_style_karton_edit();
            while($hasil = mysqli_fetch_assoc($style)){
              
                if($hasil['id_style'] == $data['id_style']){
                     echo "<option value = '$hasil[id_style]' selected>$hasil[style]</option>";
                   }else{
                     echo "<option value = '$hasil[id_style]' >$hasil[style]</option>";
                }
              }
          ?>
        </select>
          </div>
         </div>

         <div class="form-group">
          <label for="nilai_smv">NILAI SMV</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-th-list"></i>
          </div>
          <input type="number" class="form-control" step=".01" placeholder="Masukkan Nilai SMV" name="nilai_smv" id="nilai_smv" value="<?= $data['nilai_smv'] ?>" required>
        </div>
          </div>

             </div>
       <div class="modal-footer" style="margin-top:20px;">
        <input name='update' type="submit" value="Simpan" id="button" class="btn btn-success"/>
         </form>
                </div>


<!-- Modal edit -->
<?php
		 } ?>
