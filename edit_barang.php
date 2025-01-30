
<style>
 ul.list-unstyled{
        background-color:#eee;
        cursor:pointer;
        position: absolute;
        width: 93%;
        padding-left:40px;
        z-index: 3;
      }
      li.editsize{
        padding:5px;
        border:thin solid #F0F8FF;
        z-index: 2;
        padding-left:30px;
      }
      li.editsize:hover{
        background-color:#1E90FF;
        z-index: 2;
        padding-left:30px;
      }
</style>

<?php
  require_once 'core/init.php';
?>

<?php
  if($_POST['rowedit']) {
    $edit = @$_POST['rowedit'];
    // mengambil data berdasarkan nis
    $sql = tampilkan_barang_id($edit); // memilih entri nim pada database
	  $data = mysqli_fetch_array($sql);
?>

<form name="modal_popup" enctype="multipart/form-data" method="post">
  <div class="form-group">
    <label for="kode_barcode">KODE BARCODE</label>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon glyphicon-barcode"></i>
      </div>
      <input name='kode_barcode' class="form-control" value="<?= $data['kode_barcode']; ?>" readonly>
    </div>
  </div>

  <div class="form-group">
    <label for="style2">STYLE</label>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon glyphicon-list"></i>
      </div>
      <select id="style2" class="form-control" name="id_style" style="width: 100%" required>
        <option value="">--- Pilih STYLE ---</option>
          <?php
            $style = tampilkan_style();
            while($hasil = mysqli_fetch_assoc($style)){
              if($hasil['id_style']==$data['id_style']){
               	echo "<option value = '$hasil[id_style]' selected>$hasil[style]</option>";
             	}else{
               	echo "<option value = '$hasil[id_style]' >$hasil[style]</option>";
              }
            }
          ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="warna">WARNA</label>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon glyphicon-tint"></i>
      </div>
      <input type="text" class="form-control" placeholder="WARNA" name="warna" value="<?= $data['warna']; ?>" id="warna" required>
    </div>
  </div>

  <div class="form-group">
    <label for="size2">SIZE</label>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon glyphicon-text-width"></i>
      </div>

      <!-- <input type="text" name="size" id="size2" class="form-control" value="<?= $data['size']; ?>" onkeyup="this.value.toUpperCase()"/> -->
      <select id="size2" class="form-control" name="size" required style="width: 100%">
                  <option value="">- Pilih SIZE -</option>
                  <?php
                    $size = tampilkan_master_size();
                    while($pilih = mysqli_fetch_assoc($size)) {
                      if($pilih['size'] == $data['size']){ ?>
                        <option value="<?= $pilih['size'] ?>" selected><?= $pilih['size'] ?></option>
                       <?php }else{ ?>
                        <option value="<?= $pilih['size'] ?>" ><?= $pilih['size'] ?></option>
                     <?php }
                    }
                  ?>
                </select>
        </div>
    
    </div>
  </div>

  <div class="form-group">
    <label for="cup">CUP</label>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon glyphicon-text-width"></i>
      </div>
      <select id="cup" class="form-control" name="cup" style="width: 100%">
                  <option value="">- Pilih Cup -</option>
                  <?php
                    $cup = tampilkan_master_cup();
                    while($pilih = mysqli_fetch_assoc($cup)) {
                      if($pilih['cup'] == $data['cup']){
                      echo '<option value='.$pilih['cup'].' selected> '.$pilih['cup'].'</option>';
                      }else{
                        echo '<option value='.$pilih['cup'].'>'.$pilih['cup'].'</option>';
                      }
                    }
                  ?>
                </select>
      <!-- <input type="text" name="cup" id="cup" class="form-control" value="<?= $data['cup']; ?>" /> -->
        </div>
    
    </div>
  </div>

  <div class="form-group">
    <label for="qty_barcode">QTY BARCODE</label>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon glyphicon-pencil"></i>
      </div>
      <input  type="number" class="form-control" placeholder="QTY BARCODE" name="qty_barcode" value="<?= $data['qty_barcode']; ?>" required>
    </div>
  </div>

  <div class="form-group">
    <label for="weight">BERAT</label>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon glyphicon-pencil"></i>
      </div>
      <input  type="number" class="form-control" placeholder="BERAT" name="weight" value="<?= $data['weight']; ?>" >
    </div>
  </div>

</div>
<div class="modal-footer" style="margin-top:20px;">
  <input name='update' type="submit" value="Simpan" id="button" class="btn btn-success"/>
</form>
</div>
<script src="assets/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#size2").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });

                $("#style2").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
            });
        </script>

<!-- Modal edit -->
<?php } ?>
