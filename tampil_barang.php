<?php
  require_once 'core/init.php';
?>
<link rel="stylesheet" href="view/style.css">
<style>
  td{
    text-align: center;
  }
</style>
 <th class="tengah theader"style="background: #254681"><center><H2>MASTER BARANG</th></H2>
<br>
<div class="col-sm-2">
  <div class="form-group">
    <label>KODE BARCODE</label>
    <div class="input-group">
      <div class="input-group-addon">
      <i class="glyphicon glyphicon-barcode"></i>
    </div>
    <input type="text" class="form-control" placeholder="KODE BARCODE" name="kode_barcode" id="kode_barcode" required>
  </div>
  </div>
  </div>  

  <div class="col-sm-2">
  <div class="form-group">
   <label>STYLE </label>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-list"></i>
   </div>
   <select id="style" class="form-control" name="style" required>
     <option value="" selected>--- Pilih STYLE ---</option>
       <?php
       $style = tampilkan_style();
       while($pilih = mysqli_fetch_assoc($style)){
       echo '<option value='.$pilih['id_style'].'>'.$pilih['style'].'</option>';

       }
       ?>
     </select>
   </div>
 </div>
</div>  

<div class="col-sm-2">
<label for="size">SIZE</label>
      <div class="input-group">
        <div class="input-group-addon">  
          <i class="glyphicon glyphicon-text-width"></i>
        </div>
        <!-- <input type="text" name="size" id="size" class="form-control" onkeyup="this.value.toUpperCase()" placeholder="Ketikkan Size" /> -->
        <select id="size" class="form-control" name="size" required style="width: 100%">
            <option value="">- Pilih SIZE -</option>
            <?php
              $size = tampilkan_master_size();
              while($pilih = mysqli_fetch_assoc($size)) { ?>
              <option value="<?= $pilih['size'] ?>"><?= $pilih['size'] ?></option>
             <?php }
            ?>
          </select>
        </div>
</div>  

<div class="col-sm-1">
<label for="cup">CUP</label>
      <div class="input-group">
        <!-- <input type="text" name="cup" id="cup" class="form-control" onkeyup="this.value.toUpperCase()" placeholder="CUP" /> -->
        <select id="cup" class="form-control" name="cup" required style="width: 100%">
                  <option value="">- Pilih Cup -</option>
                  <?php
                    $cup = tampilkan_master_cup();
                    while($pilih = mysqli_fetch_assoc($cup)) {
                      echo '<option value='.$pilih['cup'].'>'.$pilih['cup'].'</option>';
                    }
                  ?>
          </select>
        </div>
</div>  

<div class="col-sm-2">
<div class="form-group">
      <label for="warna">WARNA</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tint"></i>
        </div>
        <input type="text" class="form-control" placeholder="WARNA" name="warna" id="warna" required>
      </div>
    </div>
</div>  


<div class="col-sm-2">
<div class="form-group">
      <label for="qty_barcode">QTY BARCODE</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-pencil"></i>
        </div>
        <input type="text" class="form-control"  value="1"  placeholder="QTY BARCODE" name="qty_barcode" id="qty_barcode" required>
      </div>
    </div>
</div>  

<div class="col-sm-1">
    <button type="button" id="kirim" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-save"></i> SIMPAN</button>
    </div>  

<table border="1px" id="example" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th class="tengah theader"style="background: #254681"><center>No</th>
      <th class="tengah theader"style="background: #254681"><center>Kode Barcode</th>
      <th class="tengah theader"style="background: #254681"><center>STYLE</th>
      <th class="tengah theader"style="background: #254681"><center>WARNA</th>
      <th class="tengah theader"style="background: #254681"><center>SIZE</th>
      <th class="tengah theader"style="background: #254681"><center>CUP</th>
      <th class="tengah theader"style="background: #254681"><center>QTY</th>
      <th class="tengah theader"style="background: #254681"><center>COSTOMER</th>
      <th class="tengah theader"style="background: #254681"><center>BERAT</th>
      <th class="tengah theader"style="background: #254681"><center>Action</th>
    </tr>
  </thead>
  <tbody>
 

  </tbody>
</table>
</div>

<!-- Modal Edit Data data kelas-->
<div id="myEdit" class="modal fade"  role="dialog">
  <div class="modal-dialog">
  <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>Edit Data Master Barang</b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <div class="lihat-data"></div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit data kelas-->



<script type="text/javascript">
$(document).ready(function() {
        var filter_style = $('#filter_style').val();
        var costomer = $('#costomer').val();
        var color = $('#color').val();
        var check_style = $("#check_style:checked").val();
        if(check_style=='pilih_style'){
          checkstyle = 'iya';
        }else{
          checkstyle = 'tidak';
        }
        
  $('#example').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [], 
    "ajax":{
            "url": "tampil_barang_ss.php",
            "dataType": "json",
            "type": "POST",
            "data" : {
                        "action" : "table_data",
                        "filter_style" : filter_style,
                        "costomer" : costomer,
                        "color" : color,
                        "checkstyle" : checkstyle
                      },
          },
    "columns": [
        { "data": "no" },
        { "data": "kode_barcode" },
        { "data": "style" },
        { "data": "warna" },
        { "data": "size" },
        { "data": "cup" },
        { "data": "qty_barcode" },
        { "data": "costomer" },
        { "data": "weight" },
        { "data": "aksi" },
    ],
    

});
});  
</script>

<!-- Script ajax menampilkan Edit kelas -->
<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#myEdit', function (e) {
		var rowedit = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'edit_barang.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});

$('#kirim').on('click',function(){
    var kode_barcode = $('#kode_barcode').val();
    var style = $('#style').val();
    var size = $('#size').val();
    var cup = $('#cup').val();
    var warna = $('#warna').val();
    var qty_barcode = $('#qty_barcode').val();
    if(kode_barcode == ""){ 
      swal("Gagal, Kode Barcode Masih kosong", "Silakan isi Kode Barcode", "error");
    }else if(style == ""){
      Swal.fire({
                  type: 'error',
                  title: 'Gagal, Style Masih Kosong silakan isi',
                  text: 'Silakan pilih style terlebih dahulu',
                  allowEnterKey: false,  
      });
    }else if(size == ''){
      Swal.fire({
                  type: 'error',
                  title: 'Gagal, Size Masih kosong,',
                  text: 'Silakan isi size terlebih dahulu',
                  allowEnterKey: false,  
      }); 
    }else if(warna == ''){
      Swal.fire({
                  type: 'error',
                  title: 'Gagal, Color masih kosong,',
                  text: 'Silakan isi Color Terlebih dahulu',
                  allowEnterKey: false,  
      }); 
    }
          $.ajax({
            method: "POST",
            url: "proses_barang.php",
            data: { type : "simpan",
              isi_barcode : kode_barcode,
              id_style : style,
              size : size,
              cup : cup,
              warna : warna,
              qty_barcode : qty_barcode,
            },
            success: function(data){
              console.log(data.trim()); 
              if(data.trim() == 'true'){  
                swal("Data Berhasil di Disimpan!", "Klik Ok untuk melanjutkan!", "success");
                $('#example').DataTable().ajax.reload();
                $("#size").val('').trigger('change');
                document.getElementById("kode_barcode").value = "";
                document.getElementById("cup").value = "";
                document.getElementById("qty_barcode").value = "";
              }else if(data.trim() == 'kosong'){
                swal("Data Ada yang Masih kosong!", "Silahkan Cek Ulang lagi!", "error");
              }else if(data.trim() == 'error'){
                swal("Error Program!", "Silahkan Hubungi IT!", "error");
              }else if(data.trim() == 'duplicate'){
                swal("Kode Barcode Duplicate udah pernah di pakai!", "Silahkan Double cek Kode Barcode nya!", "error");
              }
            }
          });
        
});

</script>


<!-- Script ajax menampilkan Edit kelas -->
<script src="assets/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#size").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });

                $("#style").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
            });
        </script>
