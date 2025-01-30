<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
        $edit = @$_POST['rowedit'];
        // mengambil data berdasarkan nis
        $sql = tampil_master_bundle_id($edit); // memilih entri nim pada database
		      $data = mysqli_fetch_array($sql);

			?>

              <form name="modal_popup" enctype="multipart/form-data" method="post">

              <input type="hidden" name='id_uundle' class="form-control" value="<?php echo "$data[id_bundle]"; ?>"  />

          <div class="form-group">
          <label for="costomer">SIZE CUP</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tag"></i>
          </div>
             <input type="text" class="form-control" value="<?= $data['size'].$data['cup']; ?>"  disabled>
          </div>
         </div>

         <div class="form-group">
      <label for="form-control">Barcode Costomer</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
          <select name="barcode_costomer" id="barcode_costomer" class="form-control">
              <option value="y" <?php if($data['barcode_costomer'] == 'y'){ echo 'selected'; } ?>>Yes</option>
              <option value="n" <?php if($data['barcode_costomer'] == 'n'){ echo 'selected'; } ?>>No</option>
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
