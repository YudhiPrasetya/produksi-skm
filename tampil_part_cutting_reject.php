<?php
  require_once 'core/init.php';
  if(cek_status($_SESSION['username'] ) == 'admin' ) {
    $user = $_SESSION['username'];
    $id_order = $_GET['id'];
?>
   <link rel="stylesheet" type="text/css" href="assets/SearchPanes/css/SearchPanes.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="assets/Select/css/select.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="assets/RowGroup/css/rowGroup.dataTables.min.css">
   <script type="text/javascript" src="assets/SearchPanes/js/dataTables.searchPanes.min.js"></script>
   <script type="text/javascript" src="assets/Select/js/dataTables.select.min.js"></script>
   <script type="text/javascript" src="assets/RowGroup/js/dataTables.rowGroup.min.js"></script>
  <link rel="stylesheet" href="view/style.css">
  <style>
    div.dtsp-panesContainer button.dtsp-clearAll, div.dtsp-panesContainer button.dtsp-collapseAll, div.dtsp-panesContainer button.dtsp-showAll {
    border: 1px solid transparent;
    background-color: #20B2AA;
}

div.dtsp-verticalContainer{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: flex-start;
    align-content: flex-start;
    align-items: flex-start;
}
 
div.dtsp-verticalContainer div.dtsp-verticalPanes,
div.dtsp-verticalContainer div.container{
    width: 20%;
    flex-grow: 0;
    flex-shrink: 0;
    flex-basis: 0;
}
 
div.dtsp-verticalContainer div.dtsp-verticalPanes{
    flex-grow: 1;
    flex-shrink: 0;
    flex-basis: 16%;
}
 
div.dtsp-verticalPanes {
    margin-right: 0px;
}
 
div.dtsp-title {
    margin-right: 0px !important;
    margin-top: 13px !important;
}
 
input.dtsp-search {
    min-width: 0px !important;
    padding-left: 0px !important;
    margin: 0px !important;
}
 
div.dtsp-verticalContainer div.dtsp-verticalPanes div.dtsp-searchPanes{
    flex-direction: column;
    flex-basis: 0px;
}
 
div.dtsp-verticalContainer div.dtsp-verticalPanes div.dtsp-searchPanes div.dtsp-searchPane{
    flex-basis: 0px;
}
 
div.dtsp-verticalContainer div.container{
    flex-grow: 1;
    flex-shrink: 0;
    flex-basis: 60%;
}
 
div.dtsp-panesContainer {
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 5px;
}
</style>
</div>
<div class="dtsp-verticalContainer">
        <div class="dtsp-verticalPanes"></div>
        <div class="container">
<input type="hidden" value="<?= $id_order ?>" id="id_order" >
<input type="hidden" value="<?= $user ?>" id="username" >
<?php
    if(cek_temp_part_cutting_reject_id_order($id_order) != 0){
        $sql = mencari_no_trx_temp_part_cutting_reject_id_order($id_order);
        $data = mysqli_fetch_array($sql);
        $no_trx = $data['no_trx'];
    }else{
        $sql2 = mencari_no_transaksi_part_cutting_reject();
        $data2 = mysqli_fetch_array($sql2);

        $sql3 = mencari_no_trx_temp_part_cutting_reject();
        $data3 = mysqli_fetch_array($sql3);

        if($data2['no_trx'] > $data3['no_trx']){
            $no_scan = $data2['no_trx'];
            $no_trx = $no_scan+1;
        }else{
            $no_scan = $data3['no_trx'];
            $no_trx = $no_scan+1;
        }

    }

    $sql4 = cek_ketersediaan_cup_order($id_order);
    $data4 = mysqli_fetch_array($sql4);
    $cup = $data4['cup'];
    
    
?>

<div style="margin:0px">
<center><h4>  NO TRX : <?= $no_trx ?></h4>

<div>
   
<button  type="button" id="simpan" class="btn btn-primary" style="margin-left: 35px" ><i class="glyphicon glyphicon-floppy-save"></i> SIMPAN DATA</button>
<button  type="button" id="reset" class="btn btn-danger" style="margin-left: 35px" ><i class="glyphicon glyphicon-refresh"></i> RESET DATA</button>
</center>
<font color="blue"><b>KETERANGAN REJECT</font><br></b>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
      </div>
      <input type="text" class="form-control" id="remaks_reject">
    </div>
  </div>
  <br>
<input type="hidden" value="<?= $no_trx ?>" id="no_trx">
  <table border="1px" class="table table-striped table-bordered" id="example" style="font-size: 14">
  <thead>
  <tr>
    <th rowspan="2">MATERIAL</th>
    <th style="text-align: center; width: 45%" class="theader" rowspan="2">PART</th>
    <th class="theader" style="text-align: center; width: 5%" rowspan="2">SIZE</th>
    <?php if($data4['cup'] != ''){ ?>
    <th class="theader" style="text-align: center; width: 4%" rowspan="2">CUP</th>
    <?php } ?>
    <th class="theader" style="text-align: center" >QTY</th>
    <th class="theader" style="text-align: center" colspan="3">REJECT</th>
    <th class="theader" style="text-align: center" colspan="2"> PRODUKSI</th>
  </tr>
  <tr>
    <th class="theader" style="text-align: center">ORD</th>
    <th class="theader" style="text-align: center;  width: 10%">REJ</th>
    <th class="theader" style="text-align: center">DAY</th>
    <th class="theader" style="text-align: center" >TOT</th>
    <th class="theader" style="text-align: center">TOT</th>
    <th class="theader" style="text-align: center">OK</th>
 
  </tr>
</thead>
<tbody>
<?php
$no=1;
$subtotal_qty=0;
$tanggal = date("Y-m-d");
$temp = tampilkan_temp_transaksi_part_cutting_reject($id_order, $tanggal);
while($row=mysqli_fetch_assoc($temp))
{ 
   ?>
  <tr>
  <td class="tengah"><?= $row['material']; ?></td>
  <td ><?= $row['part']; ?></td>
  <td class="tengah"><?= $row['size']; ?></td>
  <?php if($data4['cup'] != ''){ ?>
  <td class="tengah"><?= $row['cup']; ?></td>
  <?php } ?>
  <td class="tengah" id="qty_order<?= $no ?>"  ><?= $row['qty_order'];  ?> </td>
  <td class="tengah btnTemp" data-value="<?= $row['temp_reject']; ?>" style="background: green; color: white" id="qty_temp<?= $no ?>" data-urutan="<?= $no ?>" data-idtemp="<?= $row['id_transaksi']; ?>" data-iod="<?= $row['id_order_detail']; ?>" data-ibdp="<?= $row['id_bom_detail_part']; ?>" ><?= $row['temp_reject'];  ?>
  </td>
  <td class="tengah" id="days_reject<?= $no ?>" ><?= $row['days_reject'];  ?></td>
  <td class="tengah" id="total_reject<?= $no ?>" ><?= $row['total_reject'];  ?></td>
  <td class="tengah" id="qty_total<?= $no ?>" ><?= $row['qty_total'];  ?></td>
  <td class="tengah" id="total_ok<?= $no ?>" ><?= $row['total_ok'];  ?></td>
  </tr>

  <?php
    $no++;
    }
  ?>
</tbody>
</table>
</div>
<script type="text/javascript">
    $(document).ready( function () {
    var table = $('#example').DataTable({
   
        searchPanes: {
            layout: 'columns-1', 
            initCollapsed: true,
            cascadePanes: true,
        },
   
        lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 rows', '25 rows', '50 rows', 'Show all' ],
        
    ],

    orderFixed: [0, 'asc'],
        rowGroup: {
            dataSrc: 0
        },
        columnDefs: [ {
            targets: [ 0 ],
            visible: false
        } ]
        
    });
  table.searchPanes()
  $("div.dtsp-verticalPanes").append(table.searchPanes.container());
} );
</script>

<script  type="text/javascript">
    $(document).on('dblclick', '.btnTemp', function(event){
  
        var id_order = $('#id_order').val();
        var nilai = $(this).attr('data-value');
        var urutan = $(this).attr('data-urutan');
        var idInputan = "input"+urutan;
        var idTDorder = "qty_order"+urutan;
        var idTDtemp = "qty_temp"+urutan;
        var idTDdaily = "days_reject"+urutan;
        var idTDtotRej = "total_reject"+urutan;
        var idTDtotal = "qty_total"+urutan;
        var idTDok = "total_ok"+urutan;
        var idTemp = $(this).attr('data-idtemp');
        var idiod = $(this).attr('data-iod');
        var idibdp = $(this).attr('data-ibdp');
        var tdOrder = document.getElementById(idTDorder);
        var tdTemp = document.getElementById(idTDtemp);
        var tdDaily = document.getElementById(idTDdaily);
        var tdTotRej = document.getElementById(idTDtotRej);
        var tdTotal = document.getElementById(idTDtotal);
        var tdTotOk = document.getElementById(idTDok);
        tdTemp.innerHTML = "<input type='number' class='form-control' id='"+idInputan+"' value='"+nilai+"' autofocus></td>";
        event.preventDefault();
        var inputanForm = document.getElementById(idInputan);
        
        $("#"+idInputan).keypress(function(event){
           
            if(event.keyCode === 13){
                var valTemp = $("#"+idInputan).val();
                
                $.ajax({
                method: "POST",
                url: "proses_part_cutting.php",
                data: { idTemp : idTemp,
                    valTemp : valTemp,
                        idiod : idiod,
                        idibdp : idibdp,
                        id_order : id_order,
                        type : 'insert_reject'
                },
                success: function(data){
                   
                    if(data.trim() == "over"){
                        alert("Gagal, Qty yang diinput melebihi Output Produksi, silakan ubah");
                    }else{
                        obj = JSON.parse(data);
                        tdTemp.innerHTML = valTemp;
                        tdDaily.innerHTML = obj.days_reject;
                        tdTotal.innerHTML = obj.qty_total;
                        tdTotRej.innerHTML = obj.total_reject;
                        tdTotOk.innerHTML = obj.total_ok;
                        $("#"+idTDtemp).attr("data-value", obj.temp_reject);
                        $("#"+idTDtemp).attr("data-idtemp", obj.id_transaksi);
                        if(obj.balance >= 0){
                            tdOrder.setAttribute('style', 'background: #7FFFD4');
                            tdTemp.setAttribute('style', 'background: #7FFFD4');
                        }
                    }
                }
                });

            }else if(event.keyCode === 96){
               
                tdTemp.innerHTML = nilai;
            }
        });
        
    });

    
</script>

<script type="text/javascript">
    
  $('#simpan').on('click',function(){
    var yakin = confirm("Anda Yakin Data Udah Sesuai dengan Aktual ?");
    if (yakin) {
        var id = $('#id_order').val();
        var username = $('#username').val();
        var remaks = $('#remaks_reject').val();
        
        $.ajax({
        method: "POST",
        url: "proses_part_cutting.php",
        data: { id : id,
            username : username,
            remaks : remaks,
            type : "simpan_reject"
        },
        success: function(data){
          
            if(data.trim() == "success"){
                var url = "tampil_part_cutting_reject.php?id="+id;
                $('#tampil_tabel').load(url);
                alert('Data berhasil di SIMPAN!');
            }else if(data.trim() == "error"){
                alert("Gagal Ada masalah dengan QUERY DB");
            }else if(data.trim() == "qty_kosong"){
                alert("Gagal qty msih kosong, silakan isi terlebih dahulu");
            }
        
        }
        });
         }
    });

    $('#reset').on('click',function(){
    var yakin = confirm("Anda Yakin Akan Mereset data inputan no transaksi ini ?");
    if (yakin) {
        var id = $('#id_order').val();
        var username = $('#username').val();
        
        $.ajax({
        method: "POST",
        url: "proses_part_cutting.php",
        data: { id : id,
            username : username,
            type : "reset_reject"
        },
        success: function(data){
            console.log(data);
            if(data.trim() == "success"){
                var url = "tampil_part_cutting_reject.php?id="+id;
                $('#tampil_tabel').load(url);
                alert('Data berhasil di Reset!');
            }else if(data.trim() == "error"){
                alert("Gagal Ada masalah dengan QUERY DB");
            }
        
        }
        });
         }
    });
</script>

<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>