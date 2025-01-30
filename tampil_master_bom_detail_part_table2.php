<?php
  require_once 'core/init.php';
  $id = $_GET['id'];
  $search1 = $_GET['search1'];
  $search2 = $_GET['search2'];
  $id_style = $_GET['id_style'];

  $sql3 = tampilkan_master_bom_detail_id($id); // memilih entri nim pada database
  $data3 = mysqli_fetch_array($sql3);
  
  ?>
 <input type="hidden" id="id_bom_detail" value="<?= $id ?>">
<input type="hidden" id="id_style" value="<?= $id_style ?>">
<input type="hidden" id="search1" value="<?= $search1 ?>">
<input type="hidden" id="search2" value="<?= $search2 ?>">
<table border="1px" class="table table-striped table-bordered" id="bom_part2" style="font-size: 12px">
  <thead>
  <tr>
    <th class="tengah theader" style="width: 20%"><center>Action</center></th>
    <th class="tengah theader" style="width: 80%"><center>PART MATERIAL : <?= $data3['material_code']; ?></center></th>
  </tr>
</thead>
<tbody>
  <?php 
  $part_bom = tampilkan_master_part_table_bom_terpilih($id, $search2);
  while($row=mysqli_fetch_assoc($part_bom))
  {

  // $subtotal_qty += $row['qty'];
    ?>
    <tr>
    <td class="tengah">
      <button type="button" id="edit" style="width: 30px; padding: 0; margin: 0" class="send_back_part edit_material btn btn-danger edit_komentar kecil" data-id="<?= $row['id_bom_detail_part'] ?>" ><i class="glyphicon glyphicon-arrow-left"></i></button>
    </td>
    <td class="tengah"><?= $row['part']; ?></td>
    </tr>

    <?php
        }
    ?>
</tbody>

</table>

<!-- datatables  -->
<script type="text/javascript">
    $(document).ready(function() {
    var table = $('#bom_part2').DataTable( {
    
      lengthChange: false,
        paging:         true,
        searching : false,
       
    } );
} );


$('#bom_part2 tbody').on('click', '.send_back_part', function () {
  var yakin = confirm("Anda Yakin Akan Menghapus Part Terpilih ?");
    if (yakin) {
       var id_bom_detail_part = $(this).data('id');
       var id_style = $('#id_style').val();
       var id = $('#id_bom_detail').val();
       var Ambilsearch1 = $('#search_part1').val();
       var search1 = Ambilsearch1.replace(' ', '+');
       var Ambilsearch2 = $('#search_part2').val();
       var search2 = Ambilsearch2.replace(' ', '+');
       $.ajax({
        method: "POST",
        url: "proses_bom.php",
        data: { id_bom_detail_part : id_bom_detail_part,
            type : "send_back_part"
        },
        success: function(data){
            console.log(data);
            if(data.trim() == "success"){
                url10 = "tampil_master_bom_detail_part_table.php?id="+id+"&id_style="+id_style+"&search1="+search1+"&search2="+search2;
                $('#search_part_table1').load(url10);
                url11 = "tampil_master_bom_detail_part_table2.php?id="+id+"&id_style="+id_style+"&search1="+search1+"&search2="+search2;
                $('#search_part_table2').load(url11);
            }else if(data.trim() == "error"){
                alert("Gagal, ada error program hubungi IT");
            }
        }
        });
      }
    });   
</script>
