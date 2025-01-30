<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
        $edit = @$_POST['rowedit'];
        // mengambil data berdasarkan nis
        $sql = tampilkan_master_line_id($edit); // memilih entri nim pada database
          $data = mysqli_fetch_array($sql);
	?>

              <form name="modal_popup" enctype="multipart/form-data" method="post">

              <input type="hidden" name='id_line' class="form-control" value="<?= $data['id_line'] ?>">

          <div class="form-group">
          <label for="line">Nama Line</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-bookmark"></i>
          </div>
             <input type="text" class="form-control" placeholder="No Purchasing Order" name="line" value="<?= $data['nama_line']; ?>" id="line" required>
          </div>
         </div>

         <div class="form-group">
          <label for="lantai">Lantai</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-text-height"></i>
          </div>
             <input type="number" class="form-control" placeholder="Lantai" name="lantai" value="<?= $data['lantai']; ?>" id="lantai">
          </div>
         </div>

         <div class="form-group">
          <label for="supervisor">Supervisor</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tag"></i>
          </div>
             <input type="text" class="form-control" placeholder="Supervisor" name="supervisor" value="<?= $data['supervisor']; ?>" id="supervisor">
          </div>
         </div>

         <div class="form-group">
          <label for="Chief">Chief</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tags"></i>
          </div>
             <input type="text" class="form-control" placeholder="Chief" name="chief" value="<?= $data['chief']; ?>" id="chief">
          </div>
         </div>

         <div class="form-group">
          <label for="status">STATUS</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-th-list"></i>
          </div>
          <select id="status" class="form-control" name="status" required>
          <!-- <option value="">--- Pilih Level ---</option> -->
              <option value="aktif" <?php if($data['status'] == 'aktif'){ echo 'selected'; } ?>>Aktif</option>
              <option value="tidak" <?php if($data['status'] == 'tidak'){ echo 'selected'; } ?>>TIdak</option>
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
