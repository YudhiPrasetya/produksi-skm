<?php
  
  require_once 'core/init.php';
  $id = $_GET['id'];
  $size1 = $_GET['size1'];  
  $cup1 = $_GET['cup1']; 


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

<table border="1px" class="table table-striped table-bordered" id="cutting_size" style="font-size: 12px">
  <thead>
  <tr>
    <th class="tengah theader" style="width: 80%"><center>CUP</center></th>
    <th class="tengah theader" style="width: 80%"><center>SIZE</center></th>
   
    <th class="tengah theader" style="width: 20%"><center>Action</center></th>
  </tr>
</thead>
<tbody>
  <?php 
  $part = tampilkan_master_size_orc_transaksi($id, $size1, $cup1);
  while($row=mysqli_fetch_assoc($part))
  {

  // $subtotal_qty += $row['qty'];
    ?>
    <tr>
    <td class="tengah"><font color="red">CUP : <?= $row['cup']; ?></font></td>
    <td class="tengah"><?= $row['size'].$row['cup']; ?></td>
    <td class="tengah">
      <button type="button" style="width: 30px; padding: 0; margin: 0" class="send_size btn btn-success edit_komentar kecil" data-id="<?= $row['id_order_detail'] ?>" ><i class="glyphicon glyphicon-arrow-right"></i></button>
      
    </td>
    </tr>

    <?php
        }
    ?>
</tbody>

</table>

<script type="text/javascript">
   $(document).ready(function() {
    $('#cutting_size').DataTable( {
        lengthChange: false,
        paging:         true,
        searching : false,
        order: [[0, 'asc'], [1, 'asc']],
        rowGroup: {
            dataSrc: [ 0 ],
            
        },
        lengthMenu: [
        [ 12, 25, 50, -1 ],
        [ '12 rows', '25 rows', '50 rows', 'Show all' ],
        
    ],
        columnDefs: [ {
            targets: [ 0 ],
            visible: false
        } ]
        
    } );
} );

$('#cutting_size tbody').on('click', '.send_size', function () {
  
       var id_order_detail = $(this).data('id');
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
        data: { id_order_detail : id_order_detail,
            type : "send_size_orc"
        },
        success: function(data){
       
            if(data.trim() == "success"){
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
     
    });

</script>

