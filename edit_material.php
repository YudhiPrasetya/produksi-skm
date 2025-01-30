<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
        $edit = @$_POST['rowedit'];
        // mengambil data berdasarkan nis
        $sql = tampilkan_material_id($edit); // memilih entri nim pada database
		      $data = mysqli_fetch_array($sql);

			?>

              <form name="modal_popup" enctype="multipart/form-data" method="post">

              <input type="hidden" name='id_material' class="form-control" value="<?php echo "$data[id_material]"; ?>"  />

          <div class="form-group">
          <label for="material_code">MATERIAL CODE</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tag"></i>
          </div>
             <input type="text" class="form-control" placeholder="MATERIAL CODE" name="material_code" id="material_code" value="<?php echo $data['material_code']; ?>" required>
          </div>
         </div>

         <div class="form-group">
          <label for="description">MATERIAL NAME</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tag"></i>
          </div>
          <input type="text" class="form-control" placeholder="MATERIAL NAME" name="material_name" id="material_name" value="<?php echo $data['material_name']; ?>" required>
          </div>
         </div>

         
             </div>
       <div class="modal-footer" style="margin-top:20px;">
        <input name='update' type="submit" value="Simpan" id="button" class="btn btn-success"/>
         </form>
                </div>


<!-- Modal edit -->
<?php
		 } ?> -->
