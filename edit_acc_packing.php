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
        <input type="text" class="form-control" value="<?= $data['orc'] . ' - ' . $data['style'] . ' - ' . $data['color'] ?>" disabled>
      </div>
    </div>


    <div class="form-group">
      <label>SHIPMENT PLAN</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-calendar"></i>
        </div>
        <input type="date" class="form-control" value="<?= $data['shipment_plan'] ?>" disabled>
      </div>
    </div>


    <div class="form-group">
      <label>DATE INHOUSE</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-calendar"></i>
        </div>
        <input type="hidden" name='id_prod' class="form-control" value="<?= $data['id_prod'] ?>" />
        <input name="kesiapan_acc_packing_date" type="date" value="<?= $today ?>" class="form-control" value="<?= $data['kesiapan_acc_packing_date'] ?>" <?php if (cek_status($_SESSION['username']) == 'warehouse' || cek_status($_SESSION['username']) == 'admin') {
                                                                                                                                                            echo '';
                                                                                                                                                          } else {
                                                                                                                                                            echo 'disabled';
                                                                                                                                                          }  ?>>
      </div>
    </div>

    <div class="form-group">
      <label>Quantity</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-edit"></i>
        </div>
        <input type="number" name='kesiapan_acc_packing' class="form-control" value="<?= $data['kesiapan_acc_packing']; ?>" max="10000000" <?php if (cek_status($_SESSION['username']) == 'warehouse' || cek_status($_SESSION['username']) == 'admin') {
                                                                                                                                              echo '';
                                                                                                                                            } else {
                                                                                                                                              echo 'disabled';
                                                                                                                                            }  ?>>
      </div>
    </div>

    <div class="form-group">
      <label>PIC</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-edit"></i>
        </div>
        <input type="text" name='acc_packing_pic' class="form-control" value="<?= $data['acc_packing_pic']; ?>" <?php if (cek_status($_SESSION['username']) == 'warehouse' || cek_status($_SESSION['username']) == 'admin') {
                                                                                                                  echo '';
                                                                                                                } else {
                                                                                                                  echo 'disabled';
                                                                                                                }  ?>>
      </div>
    </div>

    <div class="form-group">
      <label>REMAKS ACC PACKING</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-edit"></i>
        </div>
        <textarea class="form-control" id="remaks_pack" name="remaks_pack" rows="3" <?php if (cek_status($_SESSION['username']) == 'warehouse' || cek_status($_SESSION['username']) == 'admin') {
                                                                                      echo '';
                                                                                    } else {
                                                                                      echo 'disabled';
                                                                                    }  ?>><?= $data['remaks_acc_packing']; ?></textarea>
      </div>
    </div>

    </div>
    <div class="modal-footer" style="margin-top:20px;">
      <?php if (cek_status($_SESSION['username']) == 'warehouse' || cek_status($_SESSION['username']) == 'admin') { ?>
        <input name='update_acc_packing' type="submit" value="Simpan" id="button" class="btn btn-success" />
  </form>
<?php } ?>
</div>


<!-- Modal edit -->
<?php
} ?>