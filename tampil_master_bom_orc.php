<?php
 require_once 'core/init.php';
 $id = $_GET['id'];
 $sql = mencari_data_di_master_bom_orc($id);
 $data = mysqli_fetch_assoc($sql);
 $id_bom_orc = $data['id_bom_orc'];

?>
<div style="margin-left: 40px; margin-right: 40px">
<input type="hidden" value="<?= $id ?>" id="id_order">
<input type="hidden" value="<?= $id_bom_orc ?>" id="id_bom_orc">
<center><button  class="btn btn-md btn-primary cetak" id="tambah" style="margin-top: 10px"><i class="glyphicon glyphicon-plus"></i> TAMBAH MATERIAL</button>  </center>
 <div class="form-group" id="form-tambah">
    <div class="col-sm-8">
    <label for="material">TAMBAH MATERIAL</label>
      <div class="input-group" >
        <div class="input-group-addon" >
          <i class="glyphicon glyphicon-tag"></i>
        </div>
            <select name="material" class="form-control select2" id="material" style="width: 870px;">
            <option value="">- PILIH MATERIAL -</option>
        </select>
      </div>
    </div>

    <div class="col-sm-1" style="margin-top: 15px;">
    <button  class="btn btn-md btn-success" id="tambah2" style="margin-top: 10px"><i class="glyphicon glyphicon-plus"></i> TAMBAH</button> 
    </div>
    <div class="col-sm-1" style="margin-top: 15px">
    <button  class="btn btn-md btn-danger" id="close" style="margin-top: 10px"><i class="glyphicon glyphicon-remove"></i> HIDE</button> 
    </div>
    <br><br><br><br>
</div>

</center>
<div class="form-group" id="form-edit">
    <div class="col-sm-8">
    <label for="material">EDIT MATERIAL</label>
      <div class="input-group" >
        <div class="input-group-addon" >
          <i class="glyphicon glyphicon-tag"></i>
        </div>
           
            <input type="hidden" id="id_bom_detail_orc">
            <select name="material" class="form-control" id="material_edit" style="width: 870px;">
            <?php
                $bom = tampilkan_master_material();
                while($hasil = mysqli_fetch_assoc($bom)){ ?>
                   
                   <option value = "<?= $hasil['id_material']; ?>"><?= $hasil['material_code']." - ".$hasil['material_name']; ?></option>
                <?php  
                }
            ?>
     </select>
      </div>
    </div>

    <div class="col-sm-1" style="margin-top: 15px">
    <button  class="btn btn-md btn-primary" id="simpan_edit" style="margin-top: 10px"><i class="glyphicon glyphicon-plus"></i> SIMPAN</button> 
    </div>
    <div class="col-sm-1" style="margin-top: 15px">
    <button  class="btn btn-md btn-danger" id="close_edit" style="margin-top: 10px"><i class="glyphicon glyphicon-remove"></i> HIDE</button> 
    </div>
    <br><br><br><br>
</div> 
</div>        
</div>

<div style="margin-left: 40px; margin-right: 40px">
<table border="1px" class="table table-striped table-bordered" id="bom_table" style="font-size: 13px">
  <thead>
  <tr>
    <th class="tengah theader" style="width: 20%"><center>Artikel</center></th>
    <th class="tengah theader" style="width: 35%"><center>Description</center></th>
    <th class="tengah theader" style="width: 35%"><center>PART</center></th>
    <th class="tengah theader" style="width: 10%"><center>Action</center></th>
  </tr>
</thead>
<tbody>
<?php
$no=1;
$bom = tampilkan_master_bom_detail_orc($id);
while($row=mysqli_fetch_assoc($bom))
{

// $subtotal_qty += $row['qty'];
   ?>
  <tr>


  <td class="tengah" style="vertical-align: middle;"><?= $row['material_code']; ?></td>
  <td class="tengah" style="vertical-align: middle;"><?= $row['material_name']; ?></td>
  <td>
    <?php
      $part = tampilkan_master_part_table_bom_orc_terpilih($row['id_bom_detail_orc']);
      while($row2=mysqli_fetch_assoc($part))  { 
        echo $row2['part'].'<br>'; ?>
  
          

    <?php } ?>
  
  </td>
  <td class="tengah">
    <button type="button" id="edit" style="width: 30px; padding: 0; margin: 0" class="edit_material btn btn-success edit_komentar kecil" data-id="<?= $row['id_bom_detail_orc']; ?>" data-material="<?= $row['id_material']; ?>" data-code="<?= $row['material_code']; ?>" data-name="<?= $row['material_name']; ?>"><i class="glyphicon glyphicon-edit"></i></button>
    <button style="width: 30px; padding: 0; margin: 0" type="button" class="part_material btn-xs btn-info kecil" data-id="<?= $row['id_bom_detail_orc']; ?>" ><i class="glyphicon glyphicon-list"></i></button>
   <button style="width: 30px; padding: 0; margin: 0" type="button" class="delete_material btn-xs btn-danger kecil" data-id="<?= $row['id_bom_detail_orc']; ?>" ><i class="glyphicon glyphicon-trash"></i></button>

  </td>
  </tr>

  <?php
      }
  ?>
</tbody>

</table>
</div>

<script src="assets/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#bom_table').DataTable();
	});

</script>

<script>
   $(document).ready(function() {
    $("#form-tambah").hide();
    $("#form-edit").hide();
     
    $("#tambah").click(function() {
        $("#form-tambah").show();
        $("#tambah").hide();
        $("#form-edit").hide();
     })
  
     $("#close").click(function() {
       $("#form-tambah").hide();
       $("#form-edit").hide();
       $("#tambah").show();
     })

     $("#close_edit").click(function() {
       $("#form-tambah").hide();
       $("#form-edit").hide();
       $("#tambah").show();
     })
  
   });
   </script>

<script>
    $(document).ready(function () {
        var material_name = $('#material_name').val();
        $('.select2').select2({
            theme: 'bootstrap4',
            allowClear: true,
            minimumInputLength: 1,
            placeholder: 'Cari Material',
            ajax: {
                dataType: 'json',
                url: 'select2.php',
                delay: 800,
                data: function (params) {
                    return {
                        search: params.term,
                        kategori : 'daftar_material'
                    }
                },
                processResults: function (data, page) {
                    return {
                        results: data
                    };
                    console.log(data);
                },
            }
        })
    });
    </script>

<script src="assets/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#material_edit").select2({
                    theme: 'bootstrap4',
                    allowClear: true,
                    minimumInputLength: 1,
                    placeholder: 'Cari Material',       
                });
    
               
            });
</script>

<script type="text/javascript">
  $('#tambah2').on('click',function(){
    var id = $('#id_order').val();
    var id_bom_orc = $('#id_bom_orc').val();
    var id_material = $('#material').val();

    $.ajax({
      method: "POST",
      url: "proses_bom_orc.php",
      data: { id_bom_orc : id_bom_orc,
        id_material : id_material,
        type : "insert_material"
       },
      success: function(data){
       
        if(data.trim() == "success"){
          url = "tampil_master_bom_orc.php?id="+id;
            $('#tampil_tabel').load(url);
        }else if(data.trim() == "duplicate"){
          alert("Gagal, Item Udah Ada Udah Ada Seblumnya");
        }
      }
    });
    
  });

</script>

<script type="text/javascript">
  $('.edit_material').on('click',function(){
       $("#form-tambah").hide();
       $("#form-edit").show();
       $("#tambah").show();
       var id = $(this).data('id');
       var id_material = $(this).data('material');
       document.getElementById("id_bom_detail_orc").value = id;
        $('#material_edit').val(id_material); // Change the value or make some change to the internal state
        $('#material_edit').trigger('change.select2'); // Notify only Select2 of changes

    });  

    $('#simpan_edit').on('click',function(){
        var id_bom_detail_orc = $('#id_bom_detail_orc').val();
        var id_order = $('#id_order').val();
        var id_material = $('#material_edit').val();
        
        $.ajax({
        method: "POST",
        url: "proses_bom_orc.php",
        data: { id_bom_detail_orc : id_bom_detail_orc,
            id_material : id_material,
            type : "edit_material"
        },
        success: function(data){
          console.log(id_material);
            if(data.trim() == "success"){
            url = "tampil_master_bom_orc.php?id="+id_order;
                $('#tampil_tabel').load(url);
            }else if(data.trim() == "duplicate"){
                alert("Gagal, Item Udah Ada Seblumnya atau Sama dengan Sebelumnya");
            }
        }
        });
  });
</script>

<script type="text/javascript">
 
  $('.delete_material').on('click',function(){
    var yakin = confirm("Anda Yakin Akan Menghapus Data, Data Part Juga Akan Kehapus ?");
    if (yakin) {
        var id_bom_detail_orc = $(this).data('id');
        var id_order = $('#id_order').val();
      $.ajax({
        method: "POST",
        url: "proses_bom_orc.php",
        data: { id_bom_detail_orc : id_bom_detail_orc,
          type : "delete_material"
        },
        success: function(data){
            if(data.trim() == "success"){
            url = "tampil_master_bom_orc.php?id="+id_order;
                $('#tampil_tabel').load(url);
            }else if(data.trim() == "error"){
                alert("Gagal, Ada Masalah dengan Query, Hubungi IT");
            }
        }
      });
    } 
  });
</script>


<script type="text/javascript">
  $('.part_material').on('click',function(){
       var id = $(this).data('id');
       var id_order = $('#id_order').val();
       url2 = "tampil_master_bom_detail_part_orc.php?id="+id+"&id_order="+id_order;
       $('#tampil_tabel').load(url2);
    });   
   
</script>
