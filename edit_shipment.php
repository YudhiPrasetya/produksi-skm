<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
        $edit = @$_POST['rowedit'];
       
        $sql = tampilkan_shipment_id($edit); // memilih entri nim pada database
		      $data = mysqli_fetch_array($sql);

			?> 

              <form name="modal_popup" enctype="multipart/form-data" method="post">
              <div class="form-group">
              <label>NO INVOICE/PACKINGLIST</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-list-alt"></i>
              </div>
              <input type="hidden" name='id_shipment' class="form-control" value="<?php echo "$data[id_shipment]"; ?>"  />
              <input name="invoice" class="form-control" value="<?php echo "$data[no_invoice]"; ?>">
            </div>
          </div>

          <div class="form-group">
              <label>DATE INSPECTION</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
              </div>
              <input type="date" name='inspection' class="form-control" value="<?php echo "$data[inspection]"; ?>">
            </div>
          </div>

          <div class="form-group">
              <label>DATE CUT OFF</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
              </div>
              <input type="date" name='cut_off' class="form-control" value="<?php echo "$data[cut_off]"; ?>">
            </div>
          </div>

          <div class="form-group">
              <label>Costomer</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-user"></i>
              </div>
              <select id="costomer" class="form-control" name="costomer" required>
                <option value="">- Pilih Costomer -</option>
                  <?php
                  $costomer = tampilkan_master_costomer();
                  while($hasil = mysqli_fetch_assoc($costomer)){
                    if($hasil['id_costomer']==$data['id_costomer']){
                        echo "<option value = '$hasil[id_costomer]' selected>$hasil[costomer]</option>";
                      }else{
                        echo "<option value = '$hasil[id_costomer]' >$hasil[costomer]</option>";
                    }
                  }  
              ?>
            </select>
            </div>
          </div>
 
          <div class="form-group">
              <label>Shipment By</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-random"></i>
              </div>
              <select id="style" class="form-control" name="shipment_by" required>
              <option value="">--- Pilih Status---</option>
              <option value="BY AIR" <?php if($data['shipment_by'] == 'BY AIR'){ echo 'selected'; } ?>>BY AIR</option>
              <option value="BY SEA" <?php if($data['shipment_by'] == 'BY SEA'){ echo 'selected'; } ?>>BY SEA</option>
              <option value="KURIR" <?php if($data['shipment_by'] == 'KURIR'){ echo 'selected'; } ?>>KURIR</option>
          </select>
            </div>
          </div>

          <div class="form-group">
            <label for="ukuran_karton">Ukuran Karton </label>
            <div class='input-group date' >
            	<div class="input-group-addon">
               	<i class="glyphicon glyphicon-resize-horizontal"></i>
              </div>
              <input type="text" name="ukuran_karton" value="<?= $data['ukuran_karton'] ?>" id="ukuran_karton" class="form-control" placeholder="Masukkan Ukuran Karton" required/>
              </div>
          </div>

          <div class="form-group">
          <label>Level</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-list"></i>
          </div>
          <select id="level" class="form-control" name="status" required>
              <option value="">--- Pilih Status---</option>
              <option value="aktif" <?php if($data['status'] == 'aktif'){ echo 'selected'; } ?>>Aktif</option>
              <option value="tidak" <?php if($data['status'] == 'tidak'){ echo 'selected'; } ?>>Tidak Aktif</option>
          </select>
          </div>
         </div>

         <div class="form-group">
          <label>Approve</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-list"></i>
          </div>
          <select id="approve" class="form-control" name="approve" required>
              <option value="">--- Pilih Status---</option>
              <option value="y" <?php if($data['approve'] == 'y'){ echo 'selected'; } ?>>Approve</option>
              <option value="n" <?php if($data['approve'] == 'n'){ echo 'selected'; } ?>>Pending</option>
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
