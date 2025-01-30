<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
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
              <input type="text" class="form-control" value="<?= $data['orc'].' - '.$data['style'].' - '.$data['color'] ?>" disabled >
            </div>
          </div>

              <div class="form-group">
              <label>DATE</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-list-alt"></i>
              </div>
              <input type="hidden" name='id_prod' class="form-control" value="<?= $data['id_prod'] ?>"  />
              <input name="date_pp" type="date" class="form-control" value="<?= $data['machines_setting_date'] ?>" <?php if(cek_status($_SESSION['username'] ) == 'machines_setting' || cek_status($_SESSION['username'] ) == 'admin'){ echo ''; }else{ echo 'disabled'; }  ?>>
            </div>
          </div>

          <div class="form-group">
              <label>PIC</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
              </div>
              <input type="text" name='pic_pp' class="form-control" value="<?= $data['machines_setting_pic']; ?>" <?php if(cek_status($_SESSION['username'] ) == 'machines_setting' || cek_status($_SESSION['username'] ) == 'admin'){ echo ''; }else{ echo 'disabled'; }  ?>>
            </div>
          </div>

          <div class="form-group">
              <label>DATE FINNIS SETTING MACHINES</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-edit"></i>
              </div>
              <textarea class="form-control" id="remaks" name="remaks" rows="3" <?php if(cek_status($_SESSION['username'] ) == 'machines_setting' || cek_status($_SESSION['username'] ) == 'admin'){ echo ''; }else{ echo 'disabled'; }  ?>><?= $data['remaks_machines_setting']; ?></textarea>
            </div>
          </div>    

             </div>

             <?php if(cek_status($_SESSION['username'] ) == 'machines_setting' || cek_status($_SESSION['username'] ) == 'admin'){ ?>     
       <div class="modal-footer" style="margin-top:20px;">
        <input name='update_machines_setting' type="submit" value="Simpan" id="button" class="btn btn-success"/>
         </form>
         <?php } ?>
                </div>


<!-- Modal edit -->
<?php
		 } ?>
