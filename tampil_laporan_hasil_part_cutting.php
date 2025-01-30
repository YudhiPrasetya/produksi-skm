<?php
  require_once 'core/init.php';

    $user = $_SESSION['username'];

    $tanggal = $_GET['tgl'];
    $orc = $_GET['orc'];
    $style = $_GET['style'];
    $costomer = $_GET['costomer'];
    $category = $_GET['category'];
    $no_po = $_GET['no_po'];
    $status = $_GET['status'];
    $status_potong = $_GET['status_potong'];
    

?>
   <!-- <link rel="stylesheet" type="text/css" href="assets/SearchPanes/css/SearchPanes.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="assets/Select/css/select.dataTables.min.css"> -->
   <link rel="stylesheet" type="text/css" href="assets/RowGroup/css/rowGroup.dataTables.min.css">
   <!-- <script type="text/javascript" src="assets/SearchPanes/js/dataTables.searchPanes.min.js"></script>
   <script type="text/javascript" src="assets/Select/js/dataTables.select.min.js"></script> -->
   <script type="text/javascript" src="assets/RowGroup/js/dataTables.rowGroup.min.js"></script>
  <link rel="stylesheet" href="view/style.css">
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
  <input type="hidden" value="<?= $tanggal ?>" id="tanggal">
  <table border="1px" class="table table-striped table-bordered display" id="example" style="font-size: 13px">
  <thead>
  <tr>
    <th rowspan="2">ORC</th>
    <th rowspan="2">MATERIAL</th>
    <th style="text-align: center; " class="theader" colspan="2">PERIODE CUTTING</th>
    <th style="text-align: center; width: 45%" class="theader" rowspan="2">PART</th>
    <th class="theader" style="text-align: center" colspan="4" >QTY PRODUCTION</th>
    <th class="theader" style="text-align: center" colspan="3" >QTY REJECT</th>
    <th class="theader" style="text-align: center width: 7%" >QTY</th>
    <th class="theader" style="text-align: center " rowspan="2">ACT</th>
  </tr>
  <tr>
    <th class="theader" style="text-align: center; width: 11%" >TGL AWAL</th>
    <th class="theader" style="text-align: center; width: 8%" >TGL AKHIR</th>
    <th class="theader" style="text-align: center; width: 3%" >ORDER</th>
    <th class="theader" style="text-align: center" >DAY</th>
    <th class="theader" style="text-align: center" >TOT</th>
    <th class="theader" style="text-align: center" >BAL</th>
    <th class="theader" style="text-align: center" >DAY</th>
    <th class="theader" style="text-align: center" >TOTAL</th>
    <th class="theader" style="text-align: center; width: 5%" >%</th>
    <th class="theader" style="text-align: center; width: 5%" >OK</th>
  </tr>
</thead>
<tbody>
<?php
if($status_potong == 'udah_potong'){
    $temp = tampilkan_laporan_transaksi_part_cutting_udah_potong($tanggal, $category, $costomer, $no_po, $status, $orc, $style);
}else{
    $temp = tampilkan_laporan_transaksi_part_cutting_blm_potong($tanggal, $category, $costomer, $no_po, $status, $orc, $style);
}
while($row=mysqli_fetch_assoc($temp))
{ 
   ?>
  <tr <?php if($row['tgl_orc_min'] != 'orc_blm' && $row['tgl_min'] == 'blm_cutting'){ ?>style="color: red" <?php } ?>>
  <td class="tengah" ><font color='#A91A6C'> <?= "ORC : ".$row['orc']." - | - STYLE : ".$row['style']." - | - COLOR : ".$row['color']." - | - BUYER : ".$row['costomer']." - | - PO BUYER : ".$row['no_po']." - | - ( ITEM : ".$row['item']." )"; ?>
   <?php if($row['tgl_orc_min'] != 'orc_blm'){ echo  " ===>> MULAI POTONG : ". tanggal_indo2($row['tgl_orc_min']) . " ===>> OK FULL SET : ".$row['full_set_ok']." SET"; }  ?> </font></td>
  <td ><font color='blue'><?= $row['material']; ?> <?php if($row['tgl_mat_min'] != 'mat_blm'){ echo  " ===>> MULAI POTONG : ". tanggal_indo2($row['tgl_mat_min']); } ?></font></td>
  <td ><?php if($row['tgl_min'] == 'blm_cutting'){ echo "BLM_POTONG"; }else{ echo tgl_indonesia3($row['tgl_min']); } ?></td>
  <td class="tengah"><?php if($row['tgl_max'] == 'blm_cutting'){ echo "BLM_POTONG"; }else{ echo tgl_indonesia3($row['tgl_max']); } ?></td>
  <td ><?= $row['part']; ?></td>
  <td class="tengah"><?= $row['qty_order']; ?></td>
  <td class="tengah"><?= $row['total_day']; ?></td>
  <td class="tengah" ><?= $row['total_qty'];  ?> </td>
  <td class="tengah"><?= $row['balance'];  ?></td>
  <td class="tengah"><?= $row['days_reject'];  ?></td>
  <td class="tengah"><?= $row['total_reject'];  ?></td>
  <td class="tengah"><?= round($row['persentase'], 2); ?> %</td>
  <td class="tengah"><?= $row['total_ok'];  ?></td>
  <td class="tengah">
    <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" style="width: 30px; padding: 0; margin: 0" class="edit_material btn btn-success edit_komentar kecil" data-id="<?= $row['id_bom_detail_part']; ?>" data-order="<?= $row['id_order']; ?>"><i class="glyphicon glyphicon-plus"></i></button>
  </td>
  </tr>
<?php } ?>
</tbody>

</table>

<!-- Modal Edit Data data kelas-->
<div id="myEdit" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
  <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>DETAIL PART CUTTING</b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <div class="lihat-data"></div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit data kelas-->


<script type="text/javascript">
   $(document).ready(function() {
    $('#example').DataTable( {
        order: [[0, 'asc'], [1, 'asc']],
        rowGroup: {
            dataSrc: [ 0, 1 ],
            
        },
        lengthMenu: [
        [ 12, 25, 50, -1 ],
        [ '12 rows', '25 rows', '50 rows', 'Show all' ],
        
    ],
        columnDefs: [ {
            targets: [ 0, 1 ],
            visible: false
        } ]
    } );
} );
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#myEdit', function (e) {
		    var rowedit = $(e.relatedTarget).data('id');
        var order = $(e.relatedTarget).data('order');
        var tanggal = $('#tanggal').val();
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'tampil_laporan_hasil_part_cutting_detail.php',
			data: { rowedit : rowedit,
                order : order,
                tanggal : tanggal
            },
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>