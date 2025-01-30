
<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
 <link rel="stylesheet" type="text/css" href="assets/SearchPanes/css/SearchPanes.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="assets/Select/css/select.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="assets/RowGroup/css/rowGroup.dataTables.min.css">
   <script type="text/javascript" src="assets/SearchPanes/js/dataTables.searchPanes.min.js"></script>
   <script type="text/javascript" src="assets/Select/js/dataTables.select.min.js"></script>
   <script type="text/javascript" src="assets/RowGroup/js/dataTables.rowGroup.min.js"></script>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'cutting' ) {
  $user = $_SESSION['username'];
  ?>


<center>
<h2>TRANSAKSI PART - CUTTING</h2>

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

<div class="col-sm-2">
    <font color="blue"><b>COLOR</font><br></b>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
      </div>
      <input type="text" class="form-control" id="color" disabled>
    </div>
  </div>

  <div class="col-sm-3">
    <font color="blue"><b>ITEMS</font><br></b>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
      </div>
      <input type="text" class="form-control" id="item" disabled>
    </div>
  </div>

<br><br><br><br>
<div class="col-sm-2">
      <font color="blue"><b>TANGGAL POTONG</font><br></b>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
        </div>
        <input type="date" class="form-control" id="tgl_potong">
      </div>
    </div>

    <div class="col-sm-2">
      <font color="blue"><b>JAM MULAI</font><br></b>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
        </div>
        <input type="time" class="form-control" id="start_time">
      </div>
    </div>

    <div class="col-sm-2">
      <font color="blue"><b>JAM AKHIR</font><br></b>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
        </div>
        <input type="time" class="form-control" id="end_time">
      </div>
    </div>

    <div class="col-sm-2">
      <font color="blue"><b>JUMLAH LAYER</font><br></b>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
        </div>
        <input type="number" class="form-control" id="jmlh_layer">
      </div>
    </div>

    <div class="col-sm-2">
      <font color="blue"><b>OPERATOR POTONG</font><br></b>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
        </div>
        <input type="text" class="form-control" id="operator">
      </div>
    </div>

    <div class="col-sm-2">
      <font color="blue"><b>ITEM POTONG</font><br></b>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
        </div>
        <input type="text" class="form-control" id="item_potong">
      </div>
    </div>
</div>
<center>
<table>
  <tr>
    <td>
    <button  type="button" id="tampil_part" class="btn btn-primary" ><i class="glyphicon glyphicon-list-alt"></i> 1. PROSES PART</button>
    </td>
    <td style="padding-left: 20px">
    <button  type="button" id="tampil_size" class="btn btn-success" ><i class="glyphicon glyphicon-list-alt"></i> 2. PROSES SIZE</button>
    </td>
  </tr>
</table>
</center>
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
              $shipment = tampilkan_master_order_bom_open();
              while($row=mysqli_fetch_assoc($shipment))
              {
            ?>
            <tr class="pilih" data-order="<?= $row['orc']; ?>" data-po="<?= $row['no_po']; ?>" data-style="<?= $row['style']; ?>" data-id="<?= $row['id_order']; ?>" data-color="<?= $row['color']; ?>" data-costomer="<?= $row['costomer']; ?>" data-item="<?= $row['item']; ?>" data-dismiss="modal">
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
 
<!-- 
<script>
    $(document).ready(function () {
        var id_order = $('#id_order').val();
        
    });
    </script> -->
 
<script type="text/javascript">
  $(document).on('click', '.pilih', function (e) {
    var id_order = $(this).attr('data-id');
   
  
    document.getElementById("id_order").value = $(this).attr('data-id');
    document.getElementById("orc2").value = $(this).attr('data-order');
    document.getElementById("no_po").value = $(this).attr('data-po');
    document.getElementById("style").value = $(this).attr('data-style');
	  document.getElementById("color").value = $(this).attr('data-color');
    document.getElementById("item").value = $(this).attr('data-item');
    $('#myModal').modal('hide');
    $('#tampil_tabel').load("kosong.php");

  });

  $('#tampil_part').on('click',function(){
    var id_order = $('#id_order').val();
    var url = "tampil_part_cutting_part.php?id="+id_order;
    $('#tampil_tabel').load(url);
  });

  $('#tampil_size').on('click',function(){
    var id_order = $('#id_order').val();
   
    var url = "tampil_part_cutting_size.php?id="+id_order;
    $('#tampil_tabel').load(url);
  });

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
