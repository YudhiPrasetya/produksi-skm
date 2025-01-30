<?php
  
  require_once 'core/init.php';
  $id = $_GET['id'];
  $search1 = $_GET['search1'];
  $search2 = $_GET['search2'];
  
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


  <table border="1px" class="table table-striped table-bordered" id="cutting_part" style="font-size: 12px">
  <thead>
  <tr>
    <th class="tengah theader" style="width: 80%"><center>MATERIAL</center></th>
    <th class="tengah theader" style="width: 80%"><center>MASTER PART</center></th>
   
    <th class="tengah theader" style="width: 20%"><center>Action</center></th>
  </tr>
</thead>
<tbody>
  <?php 
  $part = tampilkan_master_part_orc_transaksi($id, $search1);
  while($row=mysqli_fetch_assoc($part))
  {

  // $subtotal_qty += $row['qty'];
    ?>
    <tr>
    <td class="tengah"><font color="red"><?= $row['material_code']; ?> - <?= $row['material_name']; ?></font></td>
    <td class="tengah"><?= $row['part']; ?></td>
    <td class="tengah">
      <button type="button" style="width: 30px; padding: 0; margin: 0" class="send_part btn btn-success edit_komentar kecil" data-id="<?= $row['id_bom_detail_part'] ?>" ><i class="glyphicon glyphicon-arrow-right"></i></button>
      
    </td>
    </tr>

    <?php
        }
    ?>
</tbody>

</table>

<script type="text/javascript">
   $(document).ready(function() {
    $('#cutting_part').DataTable( {
        lengthChange: false,
        paging:         true,
        searching : false,
        order: [[0, 'asc'], [1, 'asc']],
        rowGroup: {
            dataSrc: [ 0],
            
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

$('#cutting_part tbody').on('click', '.send_part', function () {
 
       var id_bom_detail_part = $(this).data('id');
       var id_order = $('#id_order').val();
       var Ambilsearch1 = $('#search_part1').val();
       var search1 = Ambilsearch1.replace(' ', '+');
       var Ambilsearch2 = $('#search_part2').val();
       var search2 = Ambilsearch2.replace(' ', '+');
      
       $.ajax({
        method: "POST",
        url: "proses_part_cutting.php",
        data: { id_bom_detail_part : id_bom_detail_part,
          id_order : id_order,
            type : "send_part_orc"
        },
        success: function(data){
          console.log(data);
            if(data.trim() == "success"){
             
              url8 = "tampil_part_cutting_orc_part.php?id="+id_order+"&search1="+search1+"&search2="+search2;
                $('#search_part_table1').load(url8);
              url9 = "tampil_part_cutting_orc_part2.php?id="+id_order+"&search1="+search1+"&search2="+search2;
                $('#search_part_table2').load(url9);
            }else if(data.trim() == "duplicate"){
                alert("Gagal, Item Udah Ada Udah Ada Seblumnya atau Sama dengan Sebelumnya");
            }else if(data.trim() == "error"){
                alert("Gagal, Ada Masalah Query, hubungi IT");
            }
        }
        });
   
    });
</script>