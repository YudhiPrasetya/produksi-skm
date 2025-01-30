<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->


  
<style>
  hr {
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em; 
    border-style: inset;
    border-width: 1px;
    border-color:blue;
    }
    
    ul.list-unstyled{
        background-color:#eee;
        cursor:pointer;
        position: absolute;
        width:25%;
        padding-left:0px;
        z-index: 2;
      }
      li.po{
        padding:7px;
        border:thin solid #F0F8FF;
        z-index: 2;
        padding-left:15px;
      }
      li.po:hover{
        background-color:#1E90FF;
        z-index: 2;
        padding-left:15px;
      }
  
  </style>
<center>

<h3 align="left">CETAK LAPORAN STOK PACKING OUTERWARE</h3>
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
 <font color="blue"><b>No PO</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" id="no_po" class="form-control" disabled />
 </div>
</div>
<input type="hidden" id="id_style" class="form-control"  />
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
 <font color="blue"><b>COLOR</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" id="color" class="form-control" disabled />
 </div>
</div>

</div>

<br>
<div class="row"> 

<div class="col-sm-2">
  <font color="blue"><b>s/d Tanggal</font><br></b>
  <input type="date" id="tanggal" value="<?= date("Y-m-d") ?>" class="form-control ganti" required>
  </div>

  <div class="col-sm-3" style="margin-top: 5px">
  <font color="blue"><b>Pilih Costomer</font><br></b>
   <select id="costomer2" class="form-control ganti" name="costomer" required>
     <option value="">-- Costomer --</option>
       <?php
       $costomer = tampilkan_master_costomer();
       while($pilih = mysqli_fetch_assoc($costomer)){
       echo '<option value='.$pilih['costomer'].'>'.$pilih['costomer'].'</option>';

       }
       ?>
     </select>
 
</div>

<div class="col-sm-2" style="margin-top: 5px">
  <font color="blue"><b>NO ORC</font><br></b>
   <input type="text" name="orc" class="form-control ganti" placeholder="ORC"  id="orc3">
 </div>

 <div class="col-sm-2" style="margin-top: 5px">
 <font color="blue"><b>NO PO</font><br></b>
   <input type="text" name="po" class="form-control ganti" placeholder="INPUT PO NUMBER"  id="no_po2">
</div>

<div class="col-sm-2" style="margin-top: 5px">
  <font color="blue"><b>STYLE</font><br></b>
   <input type="text" name="style" class="form-control ganti" placeholder="INPUT STYLE"  id="style2">
 
</div>

</div>  
</div>

<div id="tampil_tabel"></div>


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
    document.getElementById("id_style").value = $(this).attr('data-id-style');
    document.getElementById("style").value = $(this).attr('data-style');
    document.getElementById("no_po").value = $(this).attr('data-po');
    document.getElementById("color").value = $(this).attr('data-color');
    document.getElementById("costomer").value = $(this).attr('data-costomer');
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
    })
</script>


<script type="text/javascript">
  $('.ganti').on('change',function(){
    var orc = $('#orc3').val();
    var tgl = $('#tanggal').val();
    var style = $('#style2').val();
    var po = $('#no_po2').val();
    var costomer = $('#costomer2').val();
    var url = "tampil_laporan_stok_packing_outerware.php?tgl="+tgl+"&orc="+orc+"&style="+style+"&costomer="+costomer+"&no_po="+po;
    console.log(url);
    $('#tampil_tabel').load(url);
  });

$(document).ready(function(){
    $('#tampil_tabel').load("kosong.php");
});

</script>


</body>
</html>
