<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
        $edit = @$_POST['rowedit'];
        // mengambil data berdasarkan nis
        $sql = tampilkan_item_id($edit); // memilih entri nim pada database
          $data = mysqli_fetch_array($sql);
	?>

              <form name="modal_popup" enctype="multipart/form-data" method="post">

              <input type="hidden" name='id_item' class="form-control" value="<?= $data['id_item']; ?>"  />

          <div class="form-group">
          <label for="item">ITEM</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-list-alt"></i>
          </div>
             <input type="text" class="form-control" placeholder="Masukkan Nama Item" name="item" value="<?php echo $data['item']; ?>" id="item" required>
          </div>
         </div>

         <div class="form-group">
          <label for="category">CATEGORY</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-th-list"></i>
          </div>
          <select id="category" class="form-control" name="category" required>
              <option value="OUTERWEAR" <?php if($data['category'] == 'OUTERWEAR'){ echo 'selected'; } ?>>OUTERWEAR</option>
              <option value="UNDERWEAR" <?php if($data['category'] == 'UNDERWEAR'){ echo 'selected'; } ?>>UNDERWEAR</option>
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
