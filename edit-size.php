<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
    $edit = @$_POST['rowedit'];
    // mengambil data berdasarkan nis
    $sql = tampilkan_size_id($edit); // memilih entri nim pada database
		$data = mysqli_fetch_array($sql);
?>

<form name="modal_popup" enctype="multipart/form-data" method="post">
  <input type="hidden" name='id_size' class="form-control" value="<?php echo "$data[id_size]"; ?>"  />

  <div class="form-group">
      <label>SIZE BARU</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
        <input type="text" class="form-control" placeholder="SIZE BARU" onkeyup="this.value = this.value.toUpperCase()" name="size" id="size" value="<?= $data['size'] ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label for="kelompok">Kelompok Size</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
          <select name="kelompok" id="kelompok" class="form-control">
              <option value="a" <?php if($data['kelompok_size'] == 'a'){ echo 'selected'; } ?>>Kelompok Size : S-M-L</option>
              <option value="b" <?php if($data['kelompok_size'] == 'b'){ echo 'selected'; } ?>>Kelompok Size : W</option>
              <option value="c" <?php if($data['kelompok_size'] == 'c'){ echo 'selected'; } ?>>Kelompok Size : 7-9-11-13</option>
          </select>
      </div>
    </div>
        
             
    <div class="modal-footer" style="margin-top:20px;">
      <input name='update' type="submit" value="Simpan" id="button" class="btn btn-success"/>
    </form>
  </div>


<!-- Modal edit -->
<?php
		 } ?>
