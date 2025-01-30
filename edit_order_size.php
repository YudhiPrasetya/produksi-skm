<?php
  require_once 'core/init.php';
?>

<?php
  if($_POST['rowedit']) {
    $edit = @$_POST['rowedit'];
    // mengambil data berdasarkan nis
    $sql = tampilkan_size_order_detail_id($edit); // memilih entri nim pada database
	  $data = mysqli_fetch_array($sql);
?>

<form name="modal_popup" enctype="multipart/form-data" method="post">
<input name="id_order_detail" id="id_order_detail" value="<?= $data['id_order_detail'] ?>" type="text" hidden/>
<input id="id_order" value="<?= $data['id_order'] ?>" type="hidden" />
<input id="orc" value="<?= $data['orc'] ?>" type="hidden" />
<input id="style2" value="<?= $data['style'] ?>" type="hidden" />


      <div class="form-group">
                  <label for="barcode">Barcode Number</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-list-alt" ></i>
                    </div>
                      <input type="text" class="form-control" value="<?= $data['barcode_number'] ?>" id="barcode" disabled>
                      <input type="hidden" class="form-control" value="<?= $data['barcode_number'] ?>" id="barcode2">
                </div>
          </div>
      </div>
        
      <div class="form-group">
            <label for="size2">Size</label>
            <div class="input-group">
            	<div class="input-group-addon">
              	<i class="glyphicon glyphicon-list-alt" ></i>
              </div>
                <!-- <input type="text" class="form-control" value="<?= $data['size'] ?>" id="size"> -->
                <select id="size2" class="form-control" name="size" required style="width: 100%">
                  <option value="">- Pilih SIZE -</option>
                  <?php
                    $size = tampilkan_master_size();
                    while($pilih = mysqli_fetch_assoc($size)) {
                      if($pilih['size'] == $data['size']){
                        echo '<option value='.$pilih['size'].' selected>'.$pilih['size'].'</option>';
                      }else{
                        echo '<option value='.$pilih['size'].'>'.$pilih['size'].'</option>';
                      }
                    }
                  ?>
                </select>
          </div>
    </div>
  </div>

  <div class="form-group">
            <label for="cup2">CUP</label>
            <div class="input-group">
            	<div class="input-group-addon">
              	<i class="glyphicon glyphicon-list-alt" ></i>
              </div>
                <!-- <input type="text" class="form-control" value="<?= $data['cup'] ?>" id="cup"> -->
                <select id="cup2" class="form-control" name="cup2" required style="width: 100%">
                  <option value="">- Pilih Cup -</option>
                  <?php
                    $cup = tampilkan_master_cup();
                    while($pilih = mysqli_fetch_assoc($cup)) {
                      if($pilih['cup'] == $data['cup']){
                        echo '<option value='.$pilih['cup'].' selected>'.$pilih['cup'].'</option>';
                      }else{
                        echo '<option value='.$pilih['cup'].'>'.$pilih['cup'].'</option>';
                      }
                    }
                  ?>
                </select>
          </div>
    </div>
  </div>

  <div class="form-group">
        <label for="qtyorder">Qty Order</label>
        <div class="input-group">
          	<div class="input-group-addon">
               	<i class="glyphicon glyphicon-calendar"></i>
            </div>
      		<input name="qtyorder" id="qtyorder_edit" value="<?= $data['qty_order'] ?>" type="number" class="form-control"  required/>
        </div>
    </div>

</div>
<div class="modal-footer" style="margin-top:20px;">
  <input name='update' type="submit" id="simpan_edit" value="Simpan" class="btn btn-primary"  data-dismiss="modal"/>
</form>
</div>

<script type="text/javascript">
  $('#size').on('change',function(){
    var orc = $('#orc').val();
    var style = $('#style2').val();
    var size = $('#size').val();
    var cup = $('#cup').val();
    var barcode = orc+"-"+size+cup;
    document.getElementById("barcode").value = barcode;
    document.getElementById("barcode2").value = barcode;
  });
</script>

<script type="text/javascript">
  $('#simpan_edit').on('click',function(){
    var id = $('#id_order_detail').val();
    var orc = $('#orc').val();
    var cup = $('#cup2').val();
    var style = $('#style2').val();
    var size = $('#size2').val();
    var barcode = orc+"-"+size+cup;
    
    var qtyorder = $('#qtyorder_edit').val();

    $.ajax({
      method: "POST",
      url: "proses_edit_order.php",
      data: { id : id,
        size : size,
        cup : cup,
        qtyorder_edit : qtyorder,
        barcode : barcode,
        type : "edit"
       },
      success: function(data){
        id_order = $('#id_order').val();
        url = "tampil_edit_order.php?id=";
        urlid = url+id_order;
        $('#tampil_tabel').load(urlid);
      }
    });
    document.getElementById("id_order_detail").value = "";
    document.getElementById("size").value = "";
    document.getElementById("cup").value = "";
    document.getElementById("qtyorder").value = "";
  });

  $(document).ready(function () {
                    $("#size3").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select Size"
                });
            });
</script>
<!-- Modal edit -->



<?php } ?>

