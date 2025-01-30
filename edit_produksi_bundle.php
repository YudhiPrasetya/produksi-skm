<?php
  require_once 'core/init.php';
?>
<!-- Script untuk menampilkan kalender -->
<?php

if($_GET['rowedit']) {
        $transaksi = $_GET['trx'];
        $id_order = $_GET['order'];
        $user = $_SESSION['username'];
        $temp1 = mencari_data_master_transaksi($transaksi);
        $datatransaksi = mysqli_fetch_array($temp1);
        $temp_table = $datatransaksi['table_temporary'];
        $table = $datatransaksi['table_transaksi'];
        $edit = @$_GET['rowedit']; 

        $proses2 = mencari_no_urutan_proses($transaksi, $id_order);
        $dataproses = mysqli_fetch_array($proses2);
        $urutan = $dataproses['urutan'];

        if($urutan != 1){
           $proses_before = $urutan-1; 
            $proses3 = mencari_nama_tabel_transaksi_sebelum($proses_before, $id_order);
            $dataproses2 = mysqli_fetch_array($proses3);
            $table_transaksi_sebelum = $dataproses2['table_transaksi'];
        }else{
          $table_transaksi_sebelum = 'transaksi_cutting';
        }
        
        // mengambil data berdasarkan nis
        $sql = tampilkan_temp_production_bundle_id($user, $temp_table, $table, $edit, $table_transaksi_sebelum); // memilih entri nim pada database
		    $data = mysqli_fetch_array($sql);

			?>

              <form name="modal_popup" enctype="multipart/form-data" method="post">

              <input type="hidden" name='id_transaksi' class="form-control" value="<?php echo "$data[id_transaksi]"; ?>"  />

          <div class="form-group">
          <label for="">NO BUNDLE || BARCODE BUNDLE</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tag"></i>
          </div>
             <input class="form-control" type="text" value="<?= $data['no_bundle']." || ".$data['kode_barcode'] ?>" disabled>
          </div>
         </div>

         <div class="form-group">
          <label for="description">STYLE</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tag"></i>
          </div>
          <input type="text" class="form-control" placeholder="Masukkan Description" name="description" id="description" value="<?= $data['style']." || ".$data['color']." || SIZE : ".$data['size'].$data['cup']; ?>" id="po" disabled>
          </div>
         </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="description">QTY ISI BUNDLE</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-tag"></i>
              </div>
              <input type="number" class="form-control" id="qty_isi_bundle" value="<?= $data['qty_isi_bundle'] ?>" disabled>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="description">QTY TERKIRIM</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-tag"></i>
              </div>
              <input type="number" class="form-control" placeholder="Masukkan Description" name="qty_tersimpan" id="qty_tersimpan" value="<?= $data['qty_tersimpan'] ?>" id="qty_tersimpan" disabled>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="description">BALANCE</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-tag"></i>
              </div>
              <input type="number" class="form-control" placeholder="balance" id="balance" value="<?= $data['balance'] ?>" disabled>
              <input type="hidden" name="balance" id="balance2" value="<?= $data['balance'] ?>">
              </div>
            </div>
          </div>
         </div>

         <div class="row">
         
         <div class="col-md-6">
            <div class="form-group">
              <label for="description">QTY BUNDLE PROSES SEBELUM</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-tag"></i>
              </div>
              <input type="number" class="form-control" placeholder="QTY PROSES BEFORE" id="before" value="<?php if($urutan != 1){ echo $data['qty_proses_before']; }else{ echo $data['qty_isi_bundle']; } ?>" disabled>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="description">BALANCE PROSES SEBELUM</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="glyphicon glyphicon-tag"></i>
              </div>
              <input type="number" class="form-control" placeholder="BALANCE PROSES BEFORE" id="balance_before" value="<?= $data['balance_before']; ?>" disabled>
              </div>
            </div>
          </div>

          
        </div>


        <div class="row">

        <div class="col-md-4">
         <div class="form-group">
          <label for="description">QTY SCAN</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tag"></i>
</div>
          <input type="number" class="form-control" placeholder="Masukkan Description" name="qty_scan" id="qty_scan" value="<?= $data['qty_scan'] ?>" required>
          </div>
         </div>
         </div>

        
         <div class="col-md-8">
         <div class="form-group">
          <label for="description">KETERANGAN</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tag"></i>
          </div>
          <input type="text" class="form-control" id="keterangan" value="<?php if($data['balance'] == 0){
            echo "FULL QTY BUNDLE";
          }else if($data['balance'] < 0 ){ echo "QTY MASIH BELUM FULL BUNDLE"; }else{ echo "QTY MELEBIHI ISI DARI BUNDLE"; } ?>" disabled>
          </div>
         </div>
        </div>
        

             </div>
       <div class="modal-footer" style="margin-top:20px;">
        <input name='update' type="submit" value="Simpan" id="button_simpan" class="btn btn-success"/>
         </form>
                </div>

  <script type="text/javascript">
  $('#qty_scan').on('change',function(){
    var qty_scan = $('#qty_scan').val();
    var qty_isi_bundle = $('#qty_isi_bundle').val();
    var qty_tersimpan = $('#qty_tersimpan').val();
    var qty_proses_before = $('#before').val();
    
    var balance = parseInt(qty_scan) + parseInt(qty_tersimpan) - parseInt(qty_isi_bundle);
    var balance_before = parseInt(qty_scan) + parseInt(qty_tersimpan) - parseInt(qty_proses_before);
    document.getElementById("balance").value = balance;
    document.getElementById("balance2").value = balance;
    document.getElementById("balance_before").value = balance_before;
        if(balance_before > 0){
          document.getElementById("keterangan").value = "QTY MELEBIHI OUTPUT PROSES SEBELUMNYA";
          alert("QTY MELEBIHI OUTPUT PROSES SEBELUMNYA");
          document.getElementById("button_simpan").disabled = true;
        }else if(balance == 0){
          document.getElementById("keterangan").value = "FULL QTY BUNDLE";
          document.getElementById("button_simpan").disabled = false;
        } else if(balance < 0){
          document.getElementById("keterangan").value = "QTY MASIH BELUM FULL BUNDLE";
          document.getElementById("button_simpan").disabled = false;
        }else if(balance > 0){
          document.getElementById("keterangan").value = "QTY MELEBIHI ISI DARI BUNDLE";
          alert("Qty Melebihi QTY ISI DARI BUNDLE");
          document.getElementById("button_simpan").disabled = true;
        }
  });

</script>

<!-- Modal edit -->
<?php
		 } ?> 
