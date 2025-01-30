<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
        $edit = @$_POST['rowedit'];
        // mengambil data berdasarkan nis
        $sql = tampilkan_style_id($edit); // memilih entri nim pada database
		      $data = mysqli_fetch_array($sql);

			?>

              <form name="modal_popup" enctype="multipart/form-data" method="post">

              <input type="hidden" name='id_style' class="form-control" value="<?php echo "$data[id_style]"; ?>"  />

          <div class="form-group">
          <label for="style">STYLE BARU</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tag"></i>
          </div>
             <input type="text" class="form-control" placeholder="Masukkan Style Barur" name="style" id="style" value="<?php echo $data['style']; ?>" required>
          </div>
         </div>

         <div class="form-group">
          <label for="description">DESCRIPTION</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tag"></i>
          </div>
          <input type="text" class="form-control" placeholder="Masukkan Description" name="description" id="description" value="<?php echo $data['description']; ?>" id="po" required>
          </div>
         </div>

         <div class="form-group">
          <label for="item">ITEM</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tag"></i>
          </div>
              <select id="item" class="form-control" name="item">
                <option value="">- Pilih ITEM -</option>
                  <?php
                  $item = tampilkan_item();
                  while($hasil = mysqli_fetch_assoc($item)){
                    if($hasil['item']==$data['item']){
                      echo "<option value = '$hasil[item]' selected>$hasil[item]</option>";
                    }else{
                      echo "<option value = '$hasil[item]' >$hasil[item]</option>";
                }
              }
            
                  ?>
            </select>
          </div>
         </div>

         <div class="form-group">
          <label for="costomer">COSTOMER</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tag"></i>
          </div>
          <select id="costomer" class="form-control ganti" name="costomer" required>
          <option value="">- Pilih Costomer -</option>
            <?php
            $costomer = tampilkan_master_costomer();
            while($pilih = mysqli_fetch_assoc($costomer)){
              if($pilih['id_costomer'] == $data['id_costomer']){
                echo '<option value='.$pilih['id_costomer'].' selected>'.$pilih['costomer'].'</option>';
              }else{
                echo '<option value='.$pilih['id_costomer'].'>'.$pilih['costomer'].'</option>';
              }
            }
            ?>
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
		 } ?> -->
