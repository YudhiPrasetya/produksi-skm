<?php
  
  require_once 'core/init.php';
  $id = $_GET['id'];
  $size2 = $_GET['size2'];  
  $cup2 = $_GET['cup2']; 
  $layer = $_GET['layer']; 
 

  ?>
   <style>
        tr.odd td:first-child,
        tr.even td:first-child {
        padding-left: 4em;
    }
        .dtrg-level-1{
            font-size: 16px;
        }

        .modal-dialog{
            width: 1175px;
        }
  </style>
<table border="1px" class="table table-striped table-bordered" id="cutting_size2" style="font-size: 12px">
  <thead>
  <tr>
  <th class="tengah theader" style="width: 20%"><center>Action</center></th>
    <th class="tengah theader" ><center>CUP</center></th>
    <th class="tengah theader" ><center>SIZE</center></th>
    <th class="tengah theader" ><center>RASIO</center></th>
    <th class="tengah theader" ><center>LAYER</center></th>
    <th class="tengah theader" ><center>QTY TOTAL</center></th>
   

  </tr>
</thead>
<tbody>
  <?php 
  $no = 1;
  $part = tampilkan_master_size_orc_transaksi_terpilih($id, $size2, $cup2);
  while($row=mysqli_fetch_assoc($part))
  {
    $rasio = round($row['rasio'],2);

  // $subtotal_qty += $row['qty'];
    ?>
    <tr>
    <td class="tengah">
      <button type="button" style="width: 30px; padding: 0; margin: 0; margin-right: 40px" class="send_back_size btn btn-danger edit_komentar kecil" data-id="<?= $row['id_transaksi'] ?>" ><i class="glyphicon glyphicon-arrow-left"></i></button>
    </td>
    <td class="tengah"><font color="red">CUP : <?= $row['cup']; ?></font></td>
    <td class="tengah"><?= $row['size'].$row['cup']; ?></td>
    <td class="tengah btnTemp" id="qty_temp<?= $no; ?>" data-id="<?= $row['id_transaksi']; ?>" data-urutan="<?= $no; ?>" data-value="<?=  $rasio ?>"><?=  $rasio ?></td>
    <td class="tengah"><?= $layer; ?></td>
    <td class="tengah" id="qty_total<?= $no; ?>"><?= $layer* $rasio ?></td>
    </tr>

    <?php
    $no++;
        }
    ?>
</tbody>

</table>

<script type="text/javascript">
   $(document).ready(function() {
    $('#cutting_size2').DataTable( {
        lengthChange: false,
        paging:         true,
        searching : false,
        order: [[1, 'asc'], [2, 'asc']],
        rowGroup: {
            dataSrc: [ 1],
            
        },
        lengthMenu: [
        [ 12, 25, 50, -1 ],
        [ '12 rows', '25 rows', '50 rows', 'Show all' ],
        
    ],
        columnDefs: [ {
            targets: [ 1 ],
            visible: false
        } ]
        
    } );
} );

$('#cutting_size2 tbody').on('click', '.send_back_size', function () {
  var yakin = confirm("Anda Yakin Akan Hapus Size ini ?");
    if (yakin) {
       var id_transaksi = $(this).data('id');
       var id_order = $('#id_order').val();
       var AmbilSize1 = $('#search_size1').val();
       var searchSize1 = AmbilSize1.replace(' ', '+');
       var AmbilCup1 = $('#search_cup1').val();
       var searchCup1 = AmbilCup1.replace(' ', '+');
       var AmbilSize2 = $('#search_size2').val();
       var searchSize2 = AmbilSize2.replace(' ', '+');
       var AmbilCup2 = $('#search_cup2').val();
       var searchCup2 = AmbilCup2.replace(' ', '+');
       var layer = $('#jmlh_layer').val();
       $.ajax({
        method: "POST",
        url: "proses_part_cutting.php",
        data: { id_transaksi : id_transaksi,
            type : "send_back_size_orc"
        },
        success: function(data){
       console.log(data);
            if(data.trim() == "success"){
                document.getElementById("tampil_temp").disabled = true;
                url12 = "tampil_part_cutting_orc_size.php?id="+id_order+"&size1="+searchSize1+"&cup1="+searchCup1+"&size2="+searchSize2+"&cup2="+searchCup2;
                $('#search_size_table1').load(url12);
                url13 = "tampil_part_cutting_orc_size2.php?id="+id_order+"&size1="+searchSize1+"&cup1="+searchCup1+"&size2="+searchSize2+"&cup2="+searchCup2+"&layer="+layer;
                $('#search_size_table2').load(url13);
            }else if(data.trim() == "duplicate"){
                alert("Gagal, Item Udah Ada Udah Ada Seblumnya atau Sama dengan Sebelumnya");
            }else if(data.trim() == "error"){
                alert("Gagal, Ada Masalah Query, hubungi IT");
            }
        }
        });
      }
    });

    $(document).on('dblclick', '.btnTemp', function(event){
        var id_transaksi = $(this).attr('data-id');
        var urutan = $(this).attr('data-urutan');
        var nilai = $(this).attr('data-value');
        var idInputan = "input"+urutan;
        var idTDtemp = "qty_temp"+urutan;
        var idTDtotal = "qty_total"+urutan;
        var layer = $('#jmlh_layer').val();
        var tdTemp = document.getElementById(idTDtemp);
        var tdTotal = document.getElementById(idTDtotal);
        console.log(layer);
        tdTemp.innerHTML = "<input type='number' class='form-control' id='"+idInputan+"' value='"+nilai+"' autofocus>";
        event.preventDefault();
        var inputanForm = document.getElementById(idInputan);
        $("#"+idInputan).keypress(function(event){
            if(event.keyCode === 13){
                var valTemp = $("#"+idInputan).val();
                $.ajax({
                method: "POST",
                url: "proses_part_cutting.php",
                data: { id_transaksi : id_transaksi,
                    valTemp : valTemp,
                    layer : layer,
                        type : 'edit_detail_rasio'
                },
                success: function(data){
                    
                    if(data.trim() == "error"){
                        alert("Gagal, silakan hubungi IT");
                    }else{
                        obj = JSON.parse(data);
                        tdTemp.innerHTML = valTemp;
                        tdTotal.innerHTML = Math.round(obj.qty_total);
                        $("#"+idTDtemp).attr("data-value", valTemp);
                       
                    }
                }
                });

            }else if(event.keyCode === 96){
               
                tdTemp.innerHTML = nilai;
            }
        });
    });
</script>