<?php
  require_once 'core/init.php';
  $today = date('Y-m-d');
  $po = $_GET['po'];
  $category = $_GET['category'];
  $orc = $_GET['orc'];
  $style = $_GET['style'];
  $status = $_GET['status'];
  $costomer = $_GET['costomer'];
  $layar = $_GET['layar'];
 
?>
<style>
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }

    .modal-dialog {
    width: 80%;
  }
</style>

<input type="hidden" value="<?= $layar ?>">

<div style="margin: 10px">
<div clss="dataTables_wrapper">
<br>
<input type="hidden" value="">
<table id="example" class="table table-striped table-bordered row-border order-column" cellspacing="0" border="1px" width="100%" style="font-size: 12px">
  <thead>
    <tr>
        <th rowspan="3" style="text-align: center; background: #1E90FF; color: white">No</th>
        <th rowspan="3" style="text-align: center; background: #1E90FF; color: white">ORC</th>
        <th rowspan="3" style="text-align: center; background: #1E90FF; color: white">STYLE</th>
        <th rowspan="3" style="text-align: center; background: #1E90FF; color: white">ITEM</th>
        <th rowspan="3" style="text-align: center; background: #1E90FF; color: white">COLOR</th> 
        <th rowspan="3" style="text-align: center; background: #1E90FF; color: white">BUYER</th>
        <th rowspan="3" style="text-align: center; background: #1E90FF; color: white">PO BUYER</th>
        <th rowspan="3" style="text-align: center; background: #1E90FF; color: white">QTY ORDER</th>
        <th rowspan="3" style="text-align: center; background: #1E90FF; color: white">LINE</th>
        <th rowspan="3" style="text-align: center; background: #1E90FF; color: white">DAYS PROSES</th>
        <th rowspan="2" style="text-align: center; background: #1E90FF; color: white">PLAN</th>
        <th colspan="9" style="text-align: center; background: #1E90FF; color: white">KESIAPAN MATERIAL</th>
        <th rowspan="2" colspan="2" style="text-align: center; background: #1E90FF; color: white">PPS SAMPLE</th>
        <th rowspan="2" colspan="2" style="text-align: center; background: #1E90FF; color: white">PPM</th>
        <th  colspan="9" style="text-align: center; background: #1E90FF; color: white">TEAM MARKER</th>
        <th rowspan="2" colspan="2" style="text-align: center; background: #1E90FF; color: white">CUTTING</th>
        <th rowspan="2" colspan="2" style="text-align: center; background: #1E90FF; color: white">MECHINES SETTING</th>
        <th rowspan="2" colspan="2" style="text-align: center; background: #1E90FF; color: white">LAYOUT</th>
        <th rowspan="2" colspan="2" style="text-align: center; background: #1E90FF; color: white">TRIMSTORE</th>
        <th rowspan="2" colspan="2" style="text-align: center; background: #1E90FF; color: white">FIRST PRODUKSI</th>
        <!-- <th rowspan="2" style="text-align: center; background: #1E90FF">ACTION</th> -->
    </tr>
    <tr>
      <th colspan="3" style="text-align: center; background: #1E90FF; color: white">FABRIC</th>
      <th colspan="3" style="text-align: center; background: #1E90FF; color: white">ACC SEWING</th>
      <th colspan="3" style="text-align: center; background: #1E90FF; color: white">ACC PACKING</th>
      <th colspan="3" style="text-align: center; background: #1E90FF; color: white">PATTERN CHECK</th>
      <th colspan="3" style="text-align: center; background: #1E90FF; color: white">POLA SEWING</th>
      <th colspan="3" style="text-align: center; background: #1E90FF; color: white">MARKER</th>
    </tr>
    <tr>
      <th style="text-align: center; background: #1E90FF; color: white">DATE</th>
      <th style="text-align: center; background: #1E90FF; color: white">DATE</th>
      <th style="text-align: center; background: #1E90FF; color: white">STATUS</th>
      <th style="text-align: center; background: #1E90FF; color: white">PIC</th>
      <th style="text-align: center; background: #1E90FF; color: white">DATE</th>
      <th style="text-align: center; background: #1E90FF; color: white">STATUS</th>
      <th style="text-align: center; background: #1E90FF; color: white">PIC</th>
      <th style="text-align: center; background: #1E90FF; color: white">DATE</th>
      <th style="text-align: center; background: #1E90FF; color: white">STATUS</th>
      <th style="text-align: center; background: #1E90FF; color: white">PIC</th>
      <th style="text-align: center; background: #1E90FF; color: white">DATE</th>
      <th style="text-align: center; background: #1E90FF; color: white">PIC</th>
      <th style="text-align: center; background: #1E90FF; color: white">DATE</th>
      <th style="text-align: center; background: #1E90FF; color: white">PIC</th>
      <th style="text-align: center; background: #1E90FF; color: white">DATE</th>
      <th style="text-align: center; background: #1E90FF; color: white">STATUS</th>
      <th style="text-align: center; background: #1E90FF; color: white">PIC</th>
      <th style="text-align: center; background: #1E90FF; color: white">DATE</th>
      <th style="text-align: center; background: #1E90FF; color: white">STATUS</th>
      <th style="text-align: center; background: #1E90FF; color: white">PIC</th>
      <th style="text-align: center; background: #1E90FF; color: white">DATE</th>
      <th style="text-align: center; background: #1E90FF; color: white">STATUS</th>
      <th style="text-align: center; background: #1E90FF; color: white">PIC</th>
      <th style="text-align: center; background: #1E90FF; color: white">DATE</th>
      <th style="text-align: center; background: #1E90FF; color: white">PIC</th>
      <th style="text-align: center; background: #1E90FF; color: white">DATE</th>
      <th style="text-align: center; background: #1E90FF; color: white">PIC</th>
      <th style="text-align: center; background: #1E90FF; color: white">DATE</th>
      <th style="text-align: center; background: #1E90FF; color: white">PIC</th>
      <th style="text-align: center; background: #1E90FF; color: white">DATE</th>
      <th style="text-align: center; background: #1E90FF; color: white">PIC</th>
      <th style="text-align: center; background: #1E90FF; color: white">DATE</th>
      <th style="text-align: center; background: #1E90FF; color: white">PIC</th>
    </tr>
  </thead>
  <tbody>
    <?php
        
        $no=1;
        $subtotal_qty=0;
        $preparation = tampilkan_preparartion_production($po, $category, $orc, $style, $status, $costomer);
        while($row=mysqli_fetch_assoc($preparation))
        { 
    ?>
  <tr>
  <td style="text-align: center"><button class="btn btn-link" style="margin : -5px -10px -5px -10px" data-toggle="modal" data-target="#myEdit2" data-id="<?= $row['id_prod']; ?>"><span class="glyphicon glyphicon-zoom-in"></span></button></td>
  <td style="text-align: center"><?= $row['orc']; ?></td>
  <td style="text-align: center"><?= $row['style'];  ?> </td>
  <td style="text-align: center"><?= $row['item'];  ?> </td>
  <td style="text-align: center"><?= $row['color'];  ?> </td>
  <td style="text-align: center"><?= $row['costomer']; ?></td>
  <td style="text-align: center"><?= $row['no_po']; ?></td>
  <td style="text-align: center"><?= $row['qty_order'];  ?> </td>
  <td style="text-align: center"><?= strtoupper($row['plan_line']);  ?> </td>
  <td style="text-align: center"><?= $row['days_proses'];  ?> </td>
  <td style="text-align: center"><?= tgl_indonesia4($row['plan_production']);  ?> </td>
  <td style="text-align: center"><?= tgl_indonesia4($row['fabric_edit_date']);  ?> </td>
  <td style="text-align: center"><?= $row['kesiapan_fabric']; ?> %</td>
  <td style="text-align: center"><?= strtoupper($row['fabric_pic']); ?></td>
  <td style="text-align: center"><?= tgl_indonesia4($row['acc_sewing_edit_date']);  ?> </td>
  <td style="text-align: center"><?= $row['kesiapan_acc_sewing']; ?> %</td>
  <td style="text-align: center"><?= strtoupper($row['acc_sewing_pic']); ?></td>
  <td style="text-align: center"><?= tgl_indonesia4($row['acc_packing_edit_date']);  ?> </td>
  <td style="text-align: center"><?= $row['kesiapan_acc_packing']; ?> %</td>
  <td style="text-align: center"><?= strtoupper($row['acc_packing_pic']); ?></td>
  <td style="text-align: center; color:<?php if(strtotime($row['team_sample_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia4($row['team_sample_date']);  ?> </td>
  <td style="text-align: center"><?= strtoupper($row['team_sample_pic']);?></td>
  <td style="text-align: center; color:<?php if(strtotime($row['ppm_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia4($row['ppm_date']);  ?> </td>
  <td style="text-align: center"><?= strtoupper($row['ppm_pic']); ?></td>
  <td style="text-align: center; color:<?php if(strtotime($row['pattern_check_date']) < strtotime($today) ){ echo 'red'; } ?>"><?= tgl_indonesia4($row['pattern_check_date']);  ?> </td>
  <td style="text-align: center"><?= $row['kesiapan_pattern_check']; ?> %</td>
  <td style="text-align: center"><?= strtoupper($row['pattern_check_pic']); ?></td>
  <td style="text-align: center; color:<?php if(strtotime($row['template_sewing_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia4($row['template_sewing_date']);  ?> </td>
  <td style="text-align: center"><?= $row['kesiapan_template_sewing']; ?> %</td>
  <td style="text-align: center"><?= strtoupper($row['template_sewing_pic']); ?></td>
  <td style="text-align: center; color:<?php if(strtotime($row['marker_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia4($row['marker_date']);  ?> </td>
  <td style="text-align: center"><?= $row['kesiapan_marker']; ?> %</td>
  <td style="text-align: center"><?= strtoupper($row['marker_pic']); ?></td>
  <td style="text-align: center; color:<?php if(strtotime($row['moulding_date']) < strtotime($today)){ echo 'red'; } ?> "><?= tgl_indonesia4($row['moulding_date']);  ?> </td>
  <td style="text-align: center"><?= strtoupper($row['moulding_pic']); ?></td>
  <td style="text-align: center; color:<?php if(strtotime($row['machines_setting_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia4($row['machines_setting_date']);  ?> </td>
  <td style="text-align: center"><?= strtoupper($row['machines_setting_pic']); ?></td>
  <td style="text-align: center; color:<?php if(strtotime($row['layout_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia4($row['layout_date']);  ?> </td>
  <td style="text-align: center"><?= strtoupper($row['layout_pic']); ?></td>
  <td style="text-align: center; color:<?php if(strtotime($row['ready_produksi_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia4($row['ready_produksi_date']);  ?> </td>
  <td style="text-align: center"><?= strtoupper($row['ready_produksi_pic']); ?></td>
  <td style="text-align: center"><?= tgl_indonesia4($row['plan_production']);  ?> </td>
  <td style="text-align: center"><?= strtoupper($row['plan_line']);  ?> </td>
  <!-- <td ><button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#myEdit" >Edit</button> | 
  <button type="submit" class="hapus_size btn btn-sm btn-danger" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" onclick="return konfirmasi_kurangi()">Hapus</button></td> -->
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
<div id="myEdit2" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header" style="background: #1E90FF">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><font face="Calibri" color="white"><b>TAMPIL DETAIL REPORT PREPARATION</b></font></h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
           <div class="lihat-data"></div>
        </div>

    </div>
</div>
</div>
<!-- Modal Edit data kelas-->

<?php if($layar == 'laptop'){ ?>
<script type="text/javascript">
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        searching : false,
        fixedColumns:   {
            left: 5,
        }
    } );
} );
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#myEdit2', function (e) {
		var rowedit = $(e.relatedTarget).data('id');
    console.log(rowedit);
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'tampil_detail_laporan_preparation_orc.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>
<?php }else{ ?>
  <script type="text/javascript">
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        scrollY:        "1000px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        ordering: false,
        searching : false,
        fixedColumns:   {
            left: 3,
        }
    } );
} );
</script>
<?php } ?>
