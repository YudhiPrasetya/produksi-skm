<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
    $edit = @$_POST['rowedit'];
    // mengambil data berdasarkan nis
    $sql = tampilkan_label_id($edit); // memilih entri nim pada database
		$data = mysqli_fetch_array($sql);
?>

<form name="modal_popup" enctype="multipart/form-data" method="post">
  <input type="hidden" name='id_label' class="form-control" value="<?php echo "$data[id_label]"; ?>"  />

  <div class="form-group">
    <label for="style">LABEL</label>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon glyphicon-tag"></i>
      </div>
      <input type="text"  value="<?= $data['label'] ?>" class="form-control" name="label" id="label" required>
    </div>
  </div>

  <div class="form-group">
    <label for="bulan">Bulan</label>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon glyphicon-tag"></i>
      </div>
        <select name="bulan" id="bulan" class="form-control">
          <option value=""> -- Pilih Bulan -- </option>
            <?php
              $bulan = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');   
              for($i= 0; $i<count($bulan); $i++){    
                if($bulan[$i] == $data['bulan']){ ?>
                  <option value="<?= $bulan[$i] ?>" selected><?= $bulan[$i] ?></option>
                <?php } else { ?>
                  <option value="<?= $bulan[$i] ?>"><?= $bulan[$i] ?></option>
                <?php } } ?>
          </select>
      </div>
    </div>

    <div class="form-group">
      <label for="tahun">Tahun</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
          <select name="tahun" id="tahun" class="form-control">
              <option value=""> -- Pilih Tahun -- </option>
              <option value="2019" <?php if($data['tahun'] == '2019'){ echo 'selected'; } ?>>2019</option>
              <option value="2020" <?php if($data['tahun'] == '2020'){ echo 'selected'; } ?>>2020</option>
              <option value="2021" <?php if($data['tahun'] == '2021'){ echo 'selected'; } ?>>2021</option>
              <option value="2022" <?php if($data['tahun'] == '2022'){ echo 'selected'; } ?>>2022</option>
          </select>
      </div>
    </div>

    <div class="form-group">
      <label for="status">STATUS</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-th-list"></i>
        </div>
          <select id="status" class="form-control" name="status" required>
            <option value="open" <?php if($data['status'] == 'open'){ echo 'selected'; } ?>>Open</option>
            <option value="close" <?php if($data['status'] == 'close'){ echo 'selected'; } ?>>Close</option>
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
