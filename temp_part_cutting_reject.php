
<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'cutting' ) {
  $user = $_SESSION['username'];
  ?>


<center>
<h2>TRANSAKSI PART REJECT - CUTTING</h2>

</center>
</div>
<div style="margin: 0 30px">
<div class="row">
<div class="col-sm-3">
 <font color="blue"><b>Masukkan ORC</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <!-- <input type="text" name="orc" id="orc" class="form-control" onkeyup="this.value = this.value.toUpperCase()" placeholder="Tulis No ORC" /> -->
   <input type="text" class="form-control pilcek" id="orc2" style="width: 180px; display: inline-block" disabled >
   <input type="hidden" value = <?= $_SESSION['username']; ?> id="user" >
   <input type="hidden" name="id_order" class="form-control pilcek" id="id_order" >
   <button type="button" class="btn btn-info" style="margin: 0px 0 0 7px;" data-toggle="modal" data-target="#myModal"><b><span class="glyphicon glyphicon-search"></span> Cari</b></button>
 </div>
 <!-- <div id="orcList"></div> -->
</div>

<!-- <div class="col-sm-2">
 <font color="blue"><b>SIZE</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-th-list"></i>
   </div>
   <select name="size" class="form-control select2" id="size">
            <option value="">- PILIH SIZE -</option>
        </select>
 </div>
</div> -->
<div class="col-sm-2">
    <font color="blue"><b>COSTOMER</font><br></b>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
      </div>
      <input type="text" class="form-control" id="costomer" disabled>
    </div>
  </div>

 <div class="col-sm-2">
 <font color="blue"><b>No PO</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" id="no_po" class="form-control" disabled />
 </div>
</div>


<div class="col-sm-2">
 <font color="blue"><b>STYLE</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-tag"></i>
   </div>
   <input type="text" id="style" class="form-control" disabled />
 </div>
</div>

<div class="col-sm-3">
    <font color="blue"><b>COLOR</font><br></b>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
      </div>
      <input type="text" class="form-control" id="color" disabled>
    </div>
  </div>

<br><br><br><br><br>

 

 
<!-- Modal Tambah -->
<div class="modal fade" id="myModal" class="modal-backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>Data Order</b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <form name="modal_popup"  enctype="multipart/form-data" method="post">
      
        <table border="1px" id="lookup" class="table table-striped table-hover table-bordered data" style="font-size: 13px">
          <thead>
            <tr>
              <th class="tengah theader" width=5%>NO</th>
              <th class="tengah theader">COSTOMER</th>
              <th class="tengah theader">ORC</th>
              <th class="tengah theader">NO PO</th>
              <th class="tengah theader">STYLE</th>
              <th class="tengah theader">LABEL</th>
              <th class="tengah theader">COLOR</th>
              <!-- <th class="tengah theader">QTY ORDER</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
              $no=1;
              $shipment = tampilkan_master_order_open();
              while($row=mysqli_fetch_assoc($shipment))
              {
            ?>
            <tr class="pilih" data-order="<?= $row['orc']; ?>" data-po="<?= $row['no_po']; ?>" data-style="<?= $row['style']; ?>" data-id="<?= $row['id_order']; ?>" data-color="<?= $row['color']; ?>" data-costomer="<?= $row['costomer']; ?>" data-dismiss="modal">
              <td class="tengah"><?= $no; ?></td>
              <td class="tengah"><?= $row['costomer']; ?></td>
              <td class="tengah"><?= $row['orc']; ?></td>
              <td class="tengah"><?= $row['no_po']; ?></td>
              <td class="tengah"><?= $row['style']; ?></td>
              <td class="tengah"><?= $row['label']; ?></td>
              <td class="tengah"><?= $row['color']; ?></td>
              <!-- <td class="tengah"><?= $row['total']; ?></td> -->
            </tr>
              <?php
                $no++;
                }
              ?>
            </tbody>  
          </table> 
             
      <div class="modal-footer">
        <input name="tambah" type="button" value="Close" id="button" class="btn btn-success" data-dismiss="modal"/>     
        </form>    
      </div>         
    </div>
  </div>
  </div>            
</div>
<!-- Modal Tambah -->
</form>

<div id="tampil_tabel"></div>



<script src="assets/js/select2.min.js"></script>
 

<script>
    $(document).ready(function () {
        var id_order = $('#id_order').val();
        
    });
    </script>
   
<script type="text/javascript">
  $(document).on('click', '.pilih', function (e) {
    var id_order = $(this).attr('data-id');
    var url = "tampil_part_cutting_reject.php?id="+id_order;
    console.log(id_order);
    document.getElementById("id_order").value = $(this).attr('data-id');
    document.getElementById("orc2").value = $(this).attr('data-order');
    document.getElementById("no_po").value = $(this).attr('data-po');
    document.getElementById("style").value = $(this).attr('data-style');
	  document.getElementById("color").value = $(this).attr('data-color');
    document.getElementById("costomer").value = $(this).attr('data-costomer');
    $('#myModal').modal('hide');
    $('#tampil_tabel').load(url);

    $('.select2').select2({ 
            theme: 'bootstrap4',
            allowClear: true,
            minimumInputLength: 1,
            placeholder: 'PILIH SIZE',
            ajax: {
                dataType: 'json',
                url: 'select2.php',
                delay: 800,
                data: function (params) {
                    return {
                        search: params.term,
                        kategori : 'pilih_size',
                        id_order : id_order
                    }
                },
                processResults: function (data, page) {
                    return {
                        results: data
                    };
                    console.log(data);
                },
            }
        });
  });
			

// tabel lookup mahasiswa
    $(function () {
      $("#lookup").dataTable();
    });
 
</script>

<!-- <script src="style/jquery.min.js"></script> -->
<script>
  $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
  setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
</script>

<!-- // penutup hak akses level -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>
