<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
        $edit = @$_POST['rowedit'];
        // mengambil data berdasarkan nis
          $sql = tampilkan_transaksi_proses_urutan($edit); // memilih entri nim pada database
          $data = mysqli_fetch_array($sql);
	?>

              <form name="modal_popup" enctype="multipart/form-data" method="post">

              <input type="hidden" name='id_proses' class="form-control" value="<?php echo "$data[id_proses]"; ?>"  />

          <div class="form-group">
          <label for="nama_transaksi">Nama Transaksi</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tint"></i>
          </div>
             <input type="text" class="form-control" placeholder="Nama Transaksi" name="nama_transaksi" value="<?php echo $data['nama_transaksi']; ?>" id="nama_transaksi" disabled>
          </div>
         </div>

         <div class="form-group">
          <label for="urutan">Urutan</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-th-list"></i>
          </div>
          <input type="number" class="form-control" placeholder="Urutan" name="urutan" value="<?php echo $data['urutan']; ?>" id="urutan" required>
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
