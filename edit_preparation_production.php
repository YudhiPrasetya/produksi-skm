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
              <input type="hidden" name='id_prod' class="form-control" value="<?= $data['id_prod'] ?>"  />
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
              <label>PLAN LINE</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
              </div>
              <select id="line" class="form-control" name="line">
                    <option value="">--- PILIH LINE ---</option>
                    <?php
                    $line = tampilkan_master_line();
                    while($hasil = mysqli_fetch_assoc($line)){
                        if($hasil['nama_line'] == $data['plan_line']){ ?>
                           <option value ="<?=$hasil['nama_line'] ?>" selected>LINE <?= strtoupper($hasil['nama_line']) ?></option>
                         <?php }else{ ?>
                           <option value = "<?= $hasil['nama_line'] ?>">LINE <?= strtoupper($hasil['nama_line']) ?></option>
                    <?php  } } ?>
               </select>
            </div>
          </div>

          <div class="form-group">
              <label>DAYS PROSES</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
              </div>
                 <input type="number" class="form-control" name="days_proses" value="<?= $data['days_proses'] ?>" >
            </div>
          </div>

          <div class="form-group">
              <label>PLAN SEWING DATE</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
              </div>
                 <input type="date" class="form-control" name="plan_production" value="<?= $data['plan_production'] ?>" >
            </div>
          </div>

        
             </div>
       <div class="modal-footer" style="margin-top:20px;">
        <input name='update_prep_prod' type="submit" value="Simpan" id="button" class="btn btn-success"/>
         </form>
                </div>


<!-- Modal edit -->
<?php
		 } ?>
