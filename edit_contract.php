<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
        $edit = @$_POST['rowedit'];
        // mengambil data berdasarkan nis
        $sql = tampilkan_contract_id($edit); // memilih entri nim pada database
          $data = mysqli_fetch_array($sql);
	?>

              <form name="modal_popup" enctype="multipart/form-data" method="post">

              <input type="hidden" name='id_contract' class="form-control" value="<?= $data['id_contract']; ?>"  />

          <div class="form-group">
          <label>Contract Number</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-list-alt"></i>
          </div>
             <input type="text" class="form-control" placeholder="Masukkan Contract Number" name="contract" value="<?php echo $data['no_contract']; ?>" id="contract" required>
          </div>
         </div>

         <div class="form-group">
            <label>Total Order</label>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
            <input type="number" class="form-control" value="<?php echo $data['total_order']; ?>" placeholder="Masukkan Total Order" name="total_order" id="total_order" required>
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
              <option value="open" <?php if($data['status'] == 'open'){ echo 'selected'; } ?>>Open</option>
              <option value="close" <?php if($data['status'] == 'close'){ echo 'selected'; } ?>>Close</option>
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
