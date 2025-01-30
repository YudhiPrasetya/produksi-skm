<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
if( !isset($_SESSION['username']) ){
  echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
  
}
?>

  

<center>
<h2>LAPORAN BALANCE ORDER</h2>
</center>
<br><br>
<h3 align="left">CETAK LAPORAN BALANCE ORDER BARCODE BUYER </h3>
</center><br>


<div class="row">
  <div class="col-sm-3">
    
    <font color="blue"><b>Masukkan ORC</font><br></b>
    <input type="text" class="form-control pilcek" id="orc2" style="width: 180px; display: inline-block" disabled >
     
      <button type="button" class="btn btn-info" style="margin: 0px 0 0 7px;" data-toggle="modal" data-target="#myModal"><b><span class="glyphicon glyphicon-search"></span> Cari</b></button>
  </div>

  <div class="col-sm-2">
 <font color="blue"><b>Costomer</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" id="costomer" class="form-control" disabled />
 </div>
</div>

  <div class="col-sm-2">
 <font color="blue"><b>FILTER No PO</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" id="no_po" class="form-control" />
 </div>
</div>

<div class="col-sm-2">
 <font color="blue"><b>STYLE</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" id="style" class="form-control" disabled />
 </div>
</div>


<div class="col-sm-2">
 <font color="blue"><b>FILTER COLOR</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" id="color" class="form-control"  />
 </div>
</div>

</div>

<br>
<div class="row"> 

<div class="col-sm-2">
  <font color="blue"><b>s/d Tanggal</font><br></b>
  <input type="date" id="tanggal" value="<?= date("Y-m-d") ?>" class="form-control pilcek" style="width: 180px; margin-top: 5px" required>
  </div>


<!-- <div class="col-sm-1">
<br>
    <form action="laporan_balance_order_barcode_buyer_all_orc.php" target="_blank" method="POST">
      <input type="hidden" name="tanggal2"  value="<?= date("Y-m-d") ?>" class="form-control pilcek tanggal" style="width: 180px; margin-top: 5px">
      <button type="submit" class="btn btn-md btn-primary cetak">ALL ORC</button>  
    </form>
</div>     -->

<div class="col-sm-1">
    <form action="laporan_balance_order_barcode_buyer.php" target="_blank" method="POST">
      <input type="hidden" name="orc" class="form-control pilcek" id="orc3" >
      <br>
      <input type="hidden" name="tanggal2"  value="<?= date("Y-m-d") ?>" class="form-control pilcek tanggal" style="width: 180px; margin-top: 5px">
      <button type="submit" class="btn btn-md btn-info cetak">FILTER ORC</button>  
    </form>
</div>

<div class="col-sm-2" style="margin-left: 20px">
    <form action="laporan_balance_order_barcode_buyer.php" target="_blank" method="POST">
      <input type="hidden" name="id_style" class="form-control pilcek" id="style2" >
      <input type="hidden" name="style" class="form-control pilcek" id="style3" >
      <input type="hidden" name="filter_po" class="form-control pilcek" id="no_po3" >
      <input type="hidden" name="filter_color" class="form-control pilcek" id="color2" >
      <br>
      <input type="hidden" name="tanggal2"  value="<?= date("Y-m-d") ?>" class="form-control pilcek tanggal" style="width: 180px; margin-top: 5px">
      <button type="submit" class="btn btn-md btn-success cetak">FILTER STYLE</button>  
    </form>
</div>    

<div class="col-sm-2" style="margin-left: -65px">
    <form action="laporan_balance_order_barcode_buyer.php" target="_blank" method="POST">
      <input type="hidden" name="no_po" class="form-control pilcek" id="no_po2" >
      <br>
      <input type="hidden" name="tanggal2"  value="<?= date("Y-m-d") ?>" class="form-control pilcek tanggal" style="width: 180px; margin-top: 5px">
      <button type="submit" class="btn btn-md btn-warning cetak">FILTER NO PO</button>  
    </form>
</div>  

<div class="col-sm-1" style="margin-left: -65px">
    <form action="laporan_balance_order_barcode_buyer.php" target="_blank" method="POST">
      <input type="hidden" name="costomer" class="form-control pilcek" id="costomer2" >
      <br>
      <input type="hidden" name="tanggal2"  value="<?= date("Y-m-d") ?>" class="form-control pilcek tanggal" style="width: 180px; margin-top: 5px">
      <button type="submit" class="btn btn-md btn-danger cetak">FILTER COSTOMER</button>  
    </form>
</div>  

</div>  
</div>


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
              $shipment = tampilkan_master_order_barcode_buyer_open();
              while($row=mysqli_fetch_assoc($shipment))
              {
            ?>
            <tr class="pilih" data-order="<?= $row['orc']; ?>" data-po="<?= $row['no_po']; ?>" data-style="<?= $row['style']; ?>" data-color="<?= $row['color']; ?>"  data-costomer="<?= $row['costomer']; ?>" data-id-style="<?= $row['id_style']; ?>" data-dismiss="modal">
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

<script type="text/javascript">
  $(document).on('click', '.pilih', function (e) {
    document.getElementById("orc2").value = $(this).attr('data-order');
    document.getElementById("orc3").value = $(this).attr('data-order');
    document.getElementById("style2").value = $(this).attr('data-id-style');
    document.getElementById("style3").value = $(this).attr('data-style');
    document.getElementById("style").value = $(this).attr('data-style');
    document.getElementById("costomer").value = $(this).attr('data-costomer');
    document.getElementById("costomer2").value = $(this).attr('data-costomer');
    $('#myModal').modal('hide');
  });
			

// tabel lookup mahasiswa
    $(function () {
      $("#lookup").dataTable();
    });


    $("#tanggal").on('change', function(){
     tanggal = $("#tanggal").val();
     
    //  filter_merkmesin = $("#filtermerkmesin_id").val();
    //  filter_vendor = $("#filtervendor_id").val();
    //  filter_status = $("#filter_status").val();

     $(".tanggal").val(tanggal);
    //  $("#hasilmerkmesin_id").val(filter_merkmesin);
    //  $("#hasilvendor_id").val(filter_vendor);
    //  $("#hasilstatus").val(filter_status);
    });

    $('#no_po').on('keyup',function(){
      document.getElementById("no_po2").value = $('#no_po').val();
       document.getElementById("no_po3").value = $('#no_po').val();
    }); 

    $('#color').on('keyup',function(){
       document.getElementById("color2").value = $('#color').val();
    }); 
</script>

</body>
</html>
