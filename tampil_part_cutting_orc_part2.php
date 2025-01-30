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
  <input type="hidden" id="id_order" value="<?= $id ?>">
  <input type="hidden" id="search1" value="<?= $search1 ?>">
  <input type="hidden" id="search2" value="<?= $search2 ?>">

  <table border="1px" class="table table-striped table-bordered" id="cutting_part2" style="font-size: 12px">
  <thead>
  <tr>
  <th class="tengah theader" style="width: 20%"><center>Action</center></th>
    <th class="tengah theader" style="width: 80%"><center>MATERIAL</center></th>
    <th class="tengah theader" style="width: 80%"><center>MASTER PART</center></th>
   

  </tr>
</thead>
<tbody>
  <?php 
  $part = tampilkan_master_part_orc_transaksi_terpilih($id, $search2);
  while($row=mysqli_fetch_assoc($part))
  {

  // $subtotal_qty += $row['qty'];
    ?>
    <tr>
    <td class="tengah">
      <button type="button" style="width: 30px; padding: 0; margin: 0; margin-right: 40px" class="send_back_part btn btn-danger edit_komentar kecil" data-id="<?= $row['id_transaksi'] ?>" ><i class="glyphicon glyphicon-arrow-left"></i></button>
    </td>
    <td class="tengah"><font color="red"><?= $row['material_code']; ?> - <?= $row['material_name']; ?></font></td>
    <td class="tengah"><?= $row['part']; ?></td>
   
    </tr>

    <?php
        }
    ?>
</tbody>

</table>

<script type="text/javascript">
   $(document).ready(function() {
    $('#cutting_part2').DataTable( {
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

$('#cutting_part2 tbody').on('click', '.send_back_part', function () {
    var yakin = confirm("Anda Yakin Akan Menghapus Part Terpilih ?");
    if (yakin) {
       var id_transaksi = $(this).data('id');
       var id_order = $('#id_order').val();
       var Ambilsearch1 = $('#search_part1').val();
       var search1 = Ambilsearch1.replace(' ', '+');
       var Ambilsearch2 = $('#search_part2').val();
       var search2 = Ambilsearch2.replace(' ', '+');
       $.ajax({
        method: "POST",
        url: "proses_part_cutting.php",
        data: { id_transaksi : id_transaksi,
            type : "send_back_part_orc"
        },
        success: function(data){
      
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
        }
    });
</script>


