<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
        $edit = @$_POST['rowedit'];
        // mengambil data berdasarkan nis
        $sql = tampilkan_description_id($edit); // memilih entri nim pada database
		      $data = mysqli_fetch_array($sql);

			?>

              <form name="modal_popup" enctype="multipart/form-data" method="post">

              <input type="hidden" name='id_costomer' class="form-control" value="<?php echo "$data[id_costomer]"; ?>"  />

          <div class="form-group">
          <label for="costomer">Costomer</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tag"></i>
          </div>
             <input type="text" class="form-control" placeholder="Masukkan Costomer" name="costomer" id="costomer" value="<?php echo $data['costomer']; ?>"  required>
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
