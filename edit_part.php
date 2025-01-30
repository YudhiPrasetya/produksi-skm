<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
        $edit = @$_POST['rowedit'];
        // mengambil data berdasarkan nis
        $sql = tampilkan_master_part_id($edit); // memilih entri nim pada database
		      $data = mysqli_fetch_array($sql);

			?>

              <form name="modal_popup" enctype="multipart/form-data" method="post">

              <input type="hidden" name='id_part' class="form-control" value="<?php echo "$data[id_part]"; ?>"  />

          <div class="form-group">
          <label for="part">PART</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tag"></i>
          </div>
             <input type="text" class="form-control" placeholder="Masukkan Costomer" name="part" id="part" value="<?php echo $data['part']; ?>"  required>
          </div>
         </div>

         <div class="form-group">
      <label for="form-control">STATUS</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
          <select name="status" id="status" class="form-control">
              <option value="aktif" <?php if($data['status'] == 'aktif'){ echo 'selected'; } ?>>Aktif</option>
              <option value="tidak" <?php if($data['status'] == 'tidak'){ echo 'selected'; } ?>>Tidak</option>
          </select>
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
