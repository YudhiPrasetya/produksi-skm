<?php
  
  require_once 'core/init.php';
  $id = $_GET['id'];
  $search3 = $_GET['search3'];

  
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


  <table border="1px" class="table table-striped table-bordered" id="cutting_part3" style="font-size: 12px">
  <thead>
  <tr>
    <th class="tengah theader" style="width: 80%"><center>MATERIAL</center></th>
    <th class="tengah theader" style="width: 80%"><center>PART TERPILIH</center></th>
   

  </tr>
</thead>
<tbody>
  <?php 
  $part = tampilkan_master_part_orc_transaksi_terpilih($id, $search3);
  while($row=mysqli_fetch_assoc($part))
  {

  // $subtotal_qty += $row['qty'];
    ?>
    <tr>
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
    $('#cutting_part3').DataTable( {
        lengthChange: false,
        paging:         false,
        searching : false,
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
</script>


