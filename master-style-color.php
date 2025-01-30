<?php
  require_once 'core/init.php';
  $id = $_GET['id'];

  $sql = tampilkan_style_id($id); // memilih entri nim pada database
  $data = mysqli_fetch_array($sql);
?>
<br>
<center>
  <h3 style="color: blue;"><b>
    COLOR STYLE<br> 
    <?= $data['style'] ?></b>
  </h3>


  <button class="btn btn-success" type="button" data-target="#tambah2" data-toggle="modal" title="Tambah Data Siswa">
<i class="glyphicon glyphicon-plus"></i><b>&nbsp; TAMBAH COLOR</b></button>
<!-- <input type="hidden" value="<?= $id ?>" id="id_style"> -->
<br><br>
  </center>


<table border="1px" class="table table-striped table-bordered" id="example" style="font-size: 12px">
  <thead>
  <tr>
    <th class="tengah theader" style="width: 70%">COLOR</th>
    <th class="tengah theader">Action</th>
  </tr>
</thead>
<tbody>
<?php
    $color = tampilkan_master_style_color($id);
    while($row=mysqli_fetch_assoc($color))
    {
   ?>
  <tr>
    <td class="tengah"><?= $row['color_style']; ?></td>
    <td class="tengah">
    <button type="button" data-toggle="modal" data-id="<?= $row['id_color_style']; ?>" data-color="<?= $row['color_style']; ?>" data-target="#myEdit2" style="width: 30px; padding: 0; margin: 0" class="edit_color btn btn-success edit_komentar kecil"><i class="glyphicon glyphicon-edit"></i></button>
    <button type="button" data-toggle="modal" data-id="<?= $row['id_color_style']; ?>" style="width: 30px; padding: 0; margin: 0" class="hapus_color btn btn-danger edit_komentar kecil"><i class="glyphicon glyphicon-trash"></i></button>
    </td>
  </tr>

  <?php
}
  ?>
</tbody>

</table>


   <!-- Modal Tambah -->
<div id="tambah2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>Tambah color</b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">

          
        <div class="form-group">
    <label>COLOR</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
        <input type="hidden" value="<?= $id; ?>" id="id_style">
        <input type="text" class="form-control" placeholder="COLOR" name="color" id="color" required>
      </div>
    </div>

        <div class="modal-footer">
          <input name="tambah" type="submit" value="Tambah" id="buttonColor" class="btn btn-success" />     

        </div>
                
      </div>
    </div>
  </div>            
</div>
<!-- Modal EDIT -->
<div id="myEdit2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>EDIT COLOR</b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">

          
        <div class="form-group">
    <label>COLOR</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
        <input type="hidden" value="<?= $id; ?>" id="id_color_style">
        <input type="text" class="form-control" placeholder="COLOR" name="color" id="color_edit" required>
      </div>
    </div>

        <div class="modal-footer">
          <input name="simpan" type="submit" value="SIMPAN" id="buttonColorEdit" class="btn btn-success" />     

        </div>
                
      </div>
    </div>
  </div>            
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var table = $('#example').DataTable( {
       
        paging: false,
        searching : true,
      
    } );
	});

</script>

<script type="text/javascript">
  $('#buttonColor').on('click',function(){
    var id = $('#id_style').val();
    var color = $('#color').val();
    $.ajax({
      method: "POST",
      url: "proses_style_color.php",
      data: { id : id,
        color : color,
        type : "insert"
       },
      success: function(data){
        console.log(data);
        if(data.trim() == "success"){
          url = "master-style-color.php?id="+id;
            $('#tampil_tabel').load(url);
        }else if(data.trim() == "duplicate"){
          alert("Gagal, Color Udah Ada Seblumnya");
        }
      }
    });
    
  });

</script>


<script type="text/javascript">
  $('.edit_color').on('click',function(){
    var id_color_style = $(this).data('id');
    var color = $(this).data('color');
    document.getElementById("color_edit").value = color;
    document.getElementById("id_color_style").value = id_color_style;
  });

  $('#buttonColorEdit').on('click',function(){
    var id = $('#id_color_style').val();
    var color = $('#color_edit').val();
    var id_style = $('#id_style').val();
    $.ajax({
      method: "POST", 
      url: "proses_style_color.php",
      data: { id : id,
        color : color,
        id_style : id_style,
        type : "edit"
       },
      success: function(data){
        if(data.trim() == "success"){
          url = "master-style-color.php?id="+id_style;
            $('#tampil_tabel').load(url);
        }else if(data.trim() == "duplicate"){
          alert("Gagal, Color Udah Ada Seblumnya");
        }
      }
    });
    
  });
</script>


<script type="text/javascript">
 
  $('.hapus_color').on('click',function(){
    var yakin = confirm("Anda Yakin Akan Menyimpan Data ?");
    if (yakin) {
      var id_color_style = $(this).data('id');
      var id_style = $('#id_style').val();
    
      $.ajax({
        method: "POST",
        url: "proses_style_color.php",
        data: { id_color_style : id_color_style,
          type : "delete"
        },
        success: function(data){
          if(data.trim() == "success"){
            console.log(data);
            url = "master-style-color.php?id="+id_style;
              $('#tampil_tabel').load(url);
          }
        }
      });
    } 
  });
</script>