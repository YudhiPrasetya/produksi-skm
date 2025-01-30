<?php
  require_once 'core/init.php';
?>

<?php
  if($_POST['rowedit']) {
    $edit = @$_POST['rowedit'];
    // mengambil data berdasarkan nis
    $sql = tampilkan_master_line_register_hrd_id($edit); // memilih entri nim pada database
	  $data = mysqli_fetch_array($sql);
?>

<form name="modal_popup" enctype="multipart/form-data" method="post">
<input name="id" id="id2" value="<?= $data['id'] ?>" type="text" hidden />
<input name="id_line" id="id_line2" value="<?= $data['id_line'] ?>" type="text" hidden/>

      <div class="form-group">
                  <label for="date_register2">DATE REGISTER</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-list-alt" ></i>
                    </div>
                      <input type="date" class="form-control" value="<?= $data['date_register'] ?>" id="date_register2">
                </div>
          </div>
      </div>
        
      <div class="form-group">
            <label for="jml_register_hrd2">JUMLAH REGISTER HRD</label>
            <div class="input-group">
            	<div class="input-group-addon">
              	<i class="glyphicon glyphicon-list-alt" ></i>
              </div>
                <input type="number" class="form-control" value="<?= $data['jml_register_hrd'] ?>" id="jml_register_hrd2">
          </div>
    </div>
  </div>

</div>
<div class="modal-footer" style="margin-top:20px;">
  <input name='update' type="submit" id="simpan_edit" value="Simpan" class="btn btn-primary"  data-dismiss="modal"/>
</form>
</div>

<script type="text/javascript">
  $('#simpan_edit').on('click',function(){
    var id = $('#id2').val();
    var id_line = $('#id_line2').val();
    var date_register2 = $('#date_register2').val();
    var jml_register_hrd2 = $('#jml_register_hrd2').val();
    console.log(id);
    $.ajax({
      method: "POST",
      url: "proses_register_hrd_operator.php",
      data: { id : id,
        date_register : date_register2,
        jml_register_hrd : jml_register_hrd2,
        type : "edit"
       },
      success: function(data){
        console.log(data);
        id_order = $('#id_order').val();
        url = "tampil_master_line_register_hrd.php?id=";
        urlid = url+id_line;
        swal("Data Berhasil di Simpan !", "Klik Ok untuk melanjutkan!", "success");
        $('#tampil_tabel').load(urlid);
      }
    });
    document.getElementById("jml_register_hrd2").value = "";
    document.getElementById("date_register2").value = "";
    document.getElementById("id_line2").value = "";
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

