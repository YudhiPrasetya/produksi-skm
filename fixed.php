<?php
  require_once 'core/init.php';
?>
<style>
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>
<!-- <link rel="stylesheet" type="text/css" href="assets/DataTables/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" type="text/css" href="assets/FixedColumns/css/fixedColumns.dataTables.min.css">
<!-- <script type="text/javascript" src="assets/DataTables/js/jquery.js"></script> -->
<!-- <script type="text/javascript" src="assets/DataTables/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript" src="assets/FixedColumns/js/dataTables.fixedColumns.min.js"></script>

<div style="margin: 30px">
<div clss="dataTables_wrapper">
<br>
<table id="example" class="table table-striped table-bordered row-border order-column" cellspacing="0" border="1px" width="100%" style="font-size: 12px">
  <thead>
    <tr>
        <th rowspan="2" style="text-align: center; background: #1E90FF">No</th>
        <th rowspan="2" style="text-align: center; background: #1E90FF">ORC</th>
        <th rowspan="2" style="text-align: center; background: #1E90FF">STYLE</th>
        <th rowspan="2" style="text-align: center; background: #1E90FF">COLOR</th>
        <th rowspan="2" style="text-align: center; background: #1E90FF">BUYER</th>
        <th rowspan="2" style="text-align: center; background: #1E90FF">PO BUYER</th>
        <th rowspan="2" style="text-align: center; background: #1E90FF">QTY ORDER</th>
        <th rowspan="2" style="text-align: center; background: #1E90FF">LINE</th>
        <th rowspan="2" style="text-align: center; background: #1E90FF">DAYS PROSES</th>
        <th rowspan="2" style="text-align: center; background: #1E90FF">PLAN SEWING</th>
        <th colspan="2" style="text-align: center; background: #1E90FF">TEAM SAMPLE</th>
        <th colspan="2" style="text-align: center; background: #1E90FF">PATTERN CHECK</th>
        <th colspan="2" style="text-align: center; background: #1E90FF">PPM</th>
        <th colspan="2" style="text-align: center; background: #1E90FF">MOULDING/BOUNDING</th>
        <th rowspan="2" style="text-align: center; background: #1E90FF">ACTION</th>
    </tr>
    <tr>
      <th style="text-align: center; background: #1E90FF">DATE</th>
      <th style="text-align: center; background: #1E90FF">PIC</th>
      <th style="text-align: center; background: #1E90FF">DATE</th>
      <th style="text-align: center; background: #1E90FF">PIC</th>
      <th style="text-align: center; background: #1E90FF">DATE</th>
      <th style="text-align: center; background: #1E90FF">PIC</th>
      <th style="text-align: center; background: #1E90FF">DATE</th>
      <th style="text-align: center; background: #1E90FF">PIC</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $no=1;
        $subtotal_qty=0;
        $preparation = tampilkan_preparartion_production();
        while($row=mysqli_fetch_assoc($preparation))
        { 
    ?>
  <tr>
  <td style="text-align: center"><?= $no; ?></td>
  <td style="text-align: center"><?= $row['orc']; ?></td>
  <td style="text-align: center"><?= $row['style'];  ?> </td>
  <td style="text-align: center"><?= $row['color'];  ?> </td>
  <td style="text-align: center"><?= $row['costomer']; ?></td>
  <td style="text-align: center"><?= $row['no_po']; ?></td>
  <td style="text-align: center"><?= $row['qty_order'];  ?> </td>
  <td style="text-align: center"><?= strtoupper($row['plan_line']);  ?> </td>
  <td style="text-align: center"><?= $row['days_proses'];  ?> </td>
  <td style="text-align: center"><?= tgl_indonesia3($row['plan_production']);  ?> </td>
  <td style="text-align: center"><?= tgl_indonesia3($row['team_sample_date']);  ?> </td>
  <td style="text-align: center">  
  <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#EditTeamSample" ><?php if($row['team_sample_pic'] == null){ ?><i class="glyphicon glyphicon-user">  <?php }else{ echo strtoupper($row['team_sample_pic']); } ?></i></button></td>

  <td style="text-align: center"><?= tgl_indonesia3($row['ppm_date']);  ?> </td>
  <td style="text-align: center"><?= strtoupper($row['ppm_pic']);  ?><button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#myEdit" >TAMBAH</button></td>
  <td style="text-align: center"><?= tgl_indonesia3($row['pattern_check_date']);  ?> </td>
  <td style="text-align: center"><?= strtoupper($row['pattern_check_pic']);  ?><button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#myEdit" >TAMBAH</button></td>
  <td style="text-align: center"><?= tgl_indonesia3($row['pattern_check_date']);  ?> </td>
  <td style="text-align: center"><?= strtoupper($row['pattern_check_pic']);  ?><button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#myEdit" >TAMBAH</button></td>
  <td ><button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#myEdit" >Edit</button> | 
  <button type="submit" class="hapus_size btn btn-sm btn-danger" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" onclick="return konfirmasi_kurangi()">Hapus</button></td>
  </tr>

  <?php
    $no++;
    }
  ?>
</tbody>
</table>
</div>
</div>
</div>

<!-- Modal Edit Data data kelas-->
<div id="EditTeamSample" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>Team Sample</b></font></h4>
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
    var table = $('#example').DataTable( {
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            left: 4,
        }
    } );
} );
</script>



<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#EditTeamSample', function (e) {
		var rowedit = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'edit_team_sample.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>