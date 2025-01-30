<?php
  require_once 'core/init.php';
?>

<?php
  if($_POST['rowedit']) {
    $edit = @$_POST['rowedit'];
    // mengambil data berdasarkan nis
    $sql = tampil_master_target_id($edit); // memilih entri nim pada database
	$data = mysqli_fetch_array($sql);
?>

<form name="modal_popup" enctype="multipart/form-data" method="post">
<input name="id" id="id" value="<?= $data['id'] ?>" type="text" hidden/>

<div class="form-group">
            <label for="date_target">DATE TARGET</label>
            <div class="input-group">
            	<div class="input-group-addon"> 
              	<i class="glyphicon glyphicon-list-alt" ></i>
              </div>
                <input type="date" class="form-control" value="<?= $data['date_target'] ?>"  disabled>
          </div>
    </div>
  </div>

      <div class="form-group">
            <label for="order">DATA ORDER</label>
            <div class="input-group">
            	<div class="input-group-addon"> 
              	<i class="glyphicon glyphicon-list-alt" ></i>
              </div>
                <input type="text" class="form-control" value="<?= $data['orc']." - ".$data['style']." - ".$data['color']?>"  disabled>
          </div>
    </div>
  </div>

  <div class="form-group">
            <label for="nilai_smv">NILAI SMV</label>
            <div class="input-group">
            	<div class="input-group-addon"> 
              	<i class="glyphicon glyphicon-list-alt" ></i>
              </div>
                <input type="text" class="form-control" value="<?= $data['nilai_smv'] ?>"  disabled>
          </div>
    </div>
  </div>
    
    <div class="form-group">
            <label for="line">LINE</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i>
                </div>
                <select id="line2" class="form-control" name="line" style="width: 100%" disabled >
                <?php
                $line = tampilkan_master_line(); 
                while($hasil = mysqli_fetch_assoc($line)){
                    if($hasil['nama_line'] == $data['line']){
                    echo "<option value = '$hasil[nama_line]' selected>LINE ". strtoupper($hasil['nama_line'])."</option>";
                    }else{
                        echo "<option value = '$hasil[nama_line]'>LINE ". strtoupper($hasil['nama_line'])."</option>";
                    }
                }
                ?>
        </select>
        </div>
    </div>

    <div class="form-group">
            <label for="remaks">REMAKS</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-edit"></i>
                </div>
                <input type="text" id="remaks" class="form-control" value="<?= $data['remaks'] ?>"  required>
        </div>
    </div>

</div>
</div>


</div>
<div class="modal-footer" style="margin-top:20px;">
<!-- <button id="simpan_edit">SIMPAN</button> -->
  <input name='update' type="submit" id="simpan_edit" value="Simpan" class="btn btn-primary"  data-dismiss="modal"/>
</form>
</div>


<script src="assets/js/select2.min.js"></script>
        <script>
            $(document).ready(function (e) {
                $("#line2").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
    
            });
</script>




<!-- Modal edit -->
<?php } ?>

