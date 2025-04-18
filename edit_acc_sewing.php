<?php
require_once 'core/init.php';
$today = date('Y-m-d');
?>
<!-- Script untuk menampilkan kalender -->
<?php
if ($_POST['rowedit']) {
  $edit = @$_POST['rowedit'];

  $sql = tampilkan_data_preparation_production_id($edit); // memilih entri nim pada database
  $data = mysqli_fetch_array($sql);

?>

  <form name="modal_popup" enctype="multipart/form-data" method="post">

    <div class="form-group">
      <label>ORC - STYLE - COLOR</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-list-alt"></i>
        </div>
        <input type="hidden" name='id_prod' class="form-control" value="<?= $data['id_prod'] ?>" />
        <input type="text" class="form-control" value="<?= $data['orc'] . ' - ' . $data['style'] . ' - ' . $data['color'] ?>" disabled>
      </div>
    </div>

    <div class="form-group">
      <label>PREPARE ON</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-calendar"></i>
        </div>
        <input type="date" class="form-control" value="<?= $data['prepare_on'] ?>" disabled>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-sm-6">
        <label>DATE INHOUSE</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-calendar"></i>
          </div>
          <input name="inhouse_acc_sewing_date" type="date" class="form-control" value="<?= $data['inhouse_acc_sewing_date'] ?>" <?php if (cek_status($_SESSION['username']) == 'warehouse' || cek_status($_SESSION['username']) == 'admin') {
                                                                                                                                    echo '';
                                                                                                                                  } else {
                                                                                                                                    echo 'disabled';
                                                                                                                                  }  ?>>
        </div>
      </div>


      <div class="form-group col-sm-6">
        <label>DATE ACTUAL</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-calendar"></i>
          </div>
          <input type="hidden" name='id_prod' class="form-control" value="<?= $data['id_prod'] ?>" />
          <input name="kesiapan_acc_sewing_date" type="date" class="form-control" value="<?= $data['kesiapan_acc_sewing_date'] ?>" <?php if (cek_status($_SESSION['username']) == 'warehouse' || cek_status($_SESSION['username']) == 'admin') {
                                                                                                                                      echo '';
                                                                                                                                    } else {
                                                                                                                                      echo 'disabled';
                                                                                                                                    }  ?>>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-sm-6">
        <label>Status (%)</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-edit"></i>
          </div>
          <input type="number" name='kesiapan_acc_sewing' class="form-control" value="<?= $data['kesiapan_acc_sewing']; ?>" max="100" <?php if (cek_status($_SESSION['username']) == 'warehouse' || cek_status($_SESSION['username']) == 'admin') {
                                                                                                                                        echo '';
                                                                                                                                      } else {
                                                                                                                                        echo 'disabled';
                                                                                                                                      }  ?>>
        </div>
      </div>

      <div class="form-group col-sm-6">
        <label>PIC</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-edit"></i>
          </div>
          <input type="text" name='acc_sewing_pic' class="form-control" value="<?= $data['acc_sewing_pic']; ?>" <?php if (cek_status($_SESSION['username']) == 'warehouse' || cek_status($_SESSION['username']) == 'admin') {
                                                                                                                  echo '';
                                                                                                                } else {
                                                                                                                  echo 'disabled';
                                                                                                                }  ?>>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label>REMAKS ACC SEWING</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-edit"></i>
        </div>
        <textarea class="form-control" id="remaks_acc" name="remaks_acc" rows="3" <?php if (cek_status($_SESSION['username']) == 'warehouse' || cek_status($_SESSION['username']) == 'admin') {
                                                                                    echo '';
                                                                                  } else {
                                                                                    echo 'disabled';
                                                                                  }  ?>><?= $data['remaks_acc_sewing']; ?></textarea>
      </div>
    </div>

    </div>
    <div class="modal-footer" style="margin-top:20px;">
      <?php if (cek_status($_SESSION['username']) == 'warehouse' || cek_status($_SESSION['username']) == 'admin') { ?>
        <input name='update_acc_sewing' type="submit" value="Simpan" id="button" class="btn btn-success" />
  </form>
<?php } ?>
</div>


<!-- Modal edit -->
<?php
} ?>