<?php
  require_once 'core/init.php';
  $id = $_GET['id'];
  $search1 = $_GET['search1'];
  $search2 = $_GET['search2'];
  $id_order = $_GET['id_order'];

  ?>
  
  <input type="hidden" id="id_bom_detail_orc" value="<?= $id ?>">
  <input type="hidden" id="id_order" value="<?= $id_order ?>">
  <input type="hidden" id="search1" value="<?= $search1 ?>">
  <input type="hidden" id="search2" value="<?= $search2 ?>">
  
<table border="1px" class="table table-striped table-bordered" id="bom_part" style="font-size: 12px">
  <thead>
  <tr>
    <th class="tengah theader" style="width: 80%"><center>MASTER PART</center></th>
   
    <th class="tengah theader" style="width: 20%"><center>Action</center></th>
  </tr>
</thead>
<tbody>
  <?php 
  $part = tampilkan_master_part_table_bom_orc($id, $search1);
  while($row=mysqli_fetch_assoc($part))
  {

  // $subtotal_qty += $row['qty'];
    ?>
    <tr>
    <td class="tengah"><?= $row['part']; ?></td>
    <td class="tengah">
      <button type="button" style="width: 30px; padding: 0; margin: 0" class="send_part btn btn-success edit_komentar kecil" data-id="<?= $row['id_part'] ?>" ><i class="glyphicon glyphicon-arrow-right"></i></button>
      
    </td>
    </tr>

    <?php
        }
    ?>
</tbody>

</table>


<script type="text/javascript">
    $(document).ready(function() {
    var table = $('#bom_part').DataTable( {
    
      lengthChange: false,
        paging:         true,
        searching : false,
       
    } );
} );

$('#bom_part tbody').on('click', '.send_part', function () {
 
       var id_part = $(this).data('id');
       var id = $('#id_bom_detail_orc').val();
       var id_order = $('#id_order').val();
       var Ambilsearch1 = $('#search_part1').val();
       var search1 = Ambilsearch1.replace(' ', '+');
       var Ambilsearch2 = $('#search_part2').val();
       var search2 = Ambilsearch2.replace(' ', '+');
       $.ajax({
        method: "POST",
        url: "proses_bom_orc.php",
        data: { id : id,
            id_part : id_part,
            type : "send_part"
        },
        success: function(data){
            if(data.trim() == "success"){
              url8 = "tampil_master_bom_detail_part_orc_table.php?id="+id+"&id_order="+id_order+"&search1="+search1+"&search2="+search2;
                $('#search_part_table1').load(url8);
              url9 = "tampil_master_bom_detail_part_orc_table2.php?id="+id+"&id_order="+id_order+"&search1="+search1+"&search2="+search2;
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