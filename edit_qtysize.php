<?php
  require_once 'core/init.php';
?>

<?php
  if($_POST['rowedit']) {
    $edit = @$_POST['rowedit'];
    // mengambil data berdasarkan nis
    $sql = tampilkan_temp_order_detail_id($edit); // memilih entri nim pada database
	  $data = mysqli_fetch_array($sql);
?>

<form name="modal_popup" enctype="multipart/form-data" method="post">
<input name="id_order_detail" id="id_order_detail" value="<?= $data['id_order_detail'] ?>" type="text" hidden/>
      <div class="form-group">
            <label for="size">Size</label>
            <div class="input-group">
            	<div class="input-group-addon"> 
              	<i class="glyphicon glyphicon-list-alt" ></i>
              </div>
                <input type="text" class="form-control" value="<?= $data['size'] ?>"  disabled>
          </div>
    </div>
  </div>

  <div class="form-group">
            <label for="cup">CUP</label>
            <div class="input-group">
            	<div class="input-group-addon"> 
              	<i class="glyphicon glyphicon-list-alt" ></i>
              </div>
                <input type="text" class="form-control" value="<?= $data['cup'] ?>"  disabled>
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
  $('#simpan_edit').on('click',function(){
    var id = $('#id_order_detail').val();
    var qtyorder = $('#qtyorder_edit').val();
    console.log(qtyorder);
    $.ajax({
      method: "POST",
      url: "proses_temp_order.php",
      data: { id : id,
        qtyorder_edit : qtyorder,
        type : "edit"
       },
      success: function(data){
        
        $('#tampil_tabel').load("tampil_temp_order.php");
      }
    });
    document.getElementById("id_order_detail").value = "";
    document.getElementById("size").value = "";
    document.getElementById("qtyorder").value = "";
  });

</script>
<!-- Modal edit -->
<?php } ?>

