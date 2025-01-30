
<?php
require_once 'core/init.php'; 

  $proses = $_GET['trx'];
  $tgl = $_GET['tgl'];
  $orc = $_GET['orc'];
  $style = $_GET['style'];
  $status = $_GET['status'];
  $costomer = $_GET['costomer'];
  $no_po = $_GET['no_po'];
  $category = $_GET['category'];
  $line = $_GET['line'];
  $color = $_GET['color'];
    if($line == 'all'){
        $line = '';
    }


  $temp_sewing = mencari_data_master_transaksi('sewing');
  $datasewing = mysqli_fetch_array($temp_sewing);
  $urutansewing = $datasewing['urutan'];

  $temp1 = mencari_data_master_transaksi($proses);
  $datatransaksi = mysqli_fetch_array($temp1);
  $table = $datatransaksi['table_transaksi'];
  $urutan = $datatransaksi['urutan'];

  if($urutan < $urutansewing){
    $kategori_line = 'before_input_sewing';
  }else{
    $kategori_line = 'after_input_sewing';
  }

  if($kategori_line == 'before_input_sewing'){
    $plan_line = $line;
    $jalan_line = '';
  }else{
    $plan_line ='';
    $jalan_line = $line;
  }
?>
<!-- <style>
  #float {
        position: fixed;
        top: 2em;
        left: 1em;
        z-index: 100;
    }
</style> -->
<!-- <div id="float">
        <button id="enable">Enable</button> <button id="disable">Disable</button>
    </div> -->
<div style="margin: 30px; margin-right: 45px">
  <table border="1px"  class="table table-striped table-bordered row-border order-column display nowrap" id="example" style="font-size: 12px;">
  
  <thead>
      <tr>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>NO</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>ORC</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>STYLE</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>COLOR</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>COSTOMER</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>NO PO</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2><?php if($kategori_line == 'before_input_sewing'){ echo 'PLAN LINE'; }else{ echo 'LINE'; } ?></th>
      <th  style="text-align: center; background: #1E90FF" colspan=4>QTY</th>
      <th  style="text-align: left; background: #1E90FF" >BUNDLE</th>
   
    </tr>
    <tr>
    <th style="text-align: center; background: #1E90FF">ORDER</th>
    <th style="text-align: center; background: #1E90FF">DAILY</th>
    <th style="text-align: center; background: #1E90FF">TOTAL</th>
    <th style="text-align: center; background: #1E90FF">BALANCE</th>
    <th style="text-align: left; background: #1E90FF">RECORD</th>
   
  </tr>
</thead>
<tbody>
<?php
$no=1;
$subtotal_qty=0;
$total_daily= 0;
$total_qty_order = 0;
$total_output = 0;
$total_balance = 0;
if($kategori_line == "before_input_sewing"){
  $sql = tampilkan_laporan_bundle_record_before_sewing($table, $tgl, $orc, $style, $status, $costomer, $category, $plan_line, $no_po, $color);
}else{
  $sql = tampilkan_laporan_bundle_record_after_sewing($table, $tgl, $orc, $style, $status, $costomer, $category, $jalan_line, $no_po, $color);
}
while($row=mysqli_fetch_assoc($sql))
{ 
    ?>
    <tr>
        <td align="center"><?= $no ?></td>

        <td align="center"><?= $row['orc'] ?></td>
        <td align="center"><?= $row['style'] ?></td>
        <td align="center"><?= $row['color'] ?></td>
        <td align="center"><?= $row['costomer'] ?></td>
        <td align="center"><?= $row['no_po'] ?></td>
        <td align="center"><?php if($kategori_line == 'before_input_sewing'){ echo  strtoupper($row['plan_line']); }else{ echo strtoupper($row['line']); } ?></td>
        <td align="center"  <?php if($row['output_total'] == $row['qty_order']){ ?> style="background: #82F903" <?php } ?>><?= $row['qty_order'] ?></td>
        <td align="center" ><?= $row['daily'] ?></td>
        <td align="center" <?php if($row['output_total'] == $row['qty_order']){ ?> style="background: #82F903" <?php } ?>><?= $row['output_total'] ?></td>
        <td align="center" <?php if($row['output_total'] == $row['qty_order']){ ?> style="background: #82F903" <?php } ?>><?= $row['balance_order'] ?></td>
        <td align="center">
          <button  id="edit" data-toggle="modal" data-target="#myEdit" style="width: 30px; padding: 0; margin: 0" class="edit_material btn btn-primary edit_komentar kecil" data-id="<?= $row['id_order']; ?>" data-table="<?= $table; ?>"><i class="glyphicon glyphicon-zoom-in"></i></button> | 
          <a href="bundle_record.php?id=<?= $row['id_order']."&tgl=".$tgl."&proses=".$proses; ?>" target="_blank"><i class="glyphicon glyphicon-open"></i></a> 
          <?php if($proses == 'qc_endline'){ ?>
            | <a href="bundle_record_sewing.php?id=<?= $row['id_order']."&tgl=".$tgl."&proses=".$proses; ?>" target="_blank"><i class="glyphicon glyphicon-th-large"></i></a>
          <?php }?>
          <?php if($proses == 'qc_buyer'){ ?>
            | <a href="bundle_record_qc_buyer.php?id=<?= $row['id_order']."&tgl=".$tgl."&proses=".$proses; ?>" target="_blank"><i class="glyphicon glyphicon-th-large"></i></a>
          <?php }?>
          
        </td>
    </tr>

<?php
    $total_qty_order += $row['qty_order'];
    $total_daily += $row['daily'];
    $total_output += $row['output_total'];
    $total_balance += $row['balance_order'];

$no++;
 } ?>
</tbody>
 <tfoot>
    <tr>
        <td align="right" colspan="7" style="background: #1E90FF; color: white"><b>TOTAL:</b></td>
        <td align="center"  style="background: #1E90FF; color: white"><b><center><?= $total_qty_order; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_daily; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_output; ?></b></center></td>
        <td align="center"  style="background: #1E90FF; color: white"><center><b><?= $total_balance; ?></b></center></td>
       
        <td align="center"  style="background: #1E90FF; color: white"><center><b></b></center></td>
       
    </tr>
</tfoot>
</table>
</div>


<!-- Modal Edit Data data kelas-->
<div id="myEdit" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
  <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>DETAIL SIZE PROSES <?php if($proses == 'sewing'){ echo "INPUT SEWING"; }else{
          echo strtoupper($proses); 
        } ?></b></font></h4>
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
	$('body').on('show.bs.modal','#myEdit', function (e) {
		    var rowedit = $(e.relatedTarget).data('id');
        var proses =  $('#proses').val();
        var tanggal = $('#tanggal').val();
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'tampil_laporan_hasil_scan_global_detail.php',
			data: { rowedit : rowedit,
                proses : proses,
                tanggal : tanggal
            },
			success : function(data) {
				setTimeout(function(){$('.lihat-data').html(data);}, 1000);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>


<script>
  var lebar = window.innerWidth;
  if(lebar < 993){
    console.log(lebar);
  var table = $('#example').DataTable( {
      scrollY:        "490px",
          scrollX:        true,
          scrollCollapse: true,
          paging:         false,
          searching : false, 
          fixedColumns:   {
              left: 4,
          }
        
      });
    }else{
      var table = $('#example').DataTable( {

        paging: false,
        deferRender:    true,
        scrollY:        490,
        scrollCollapse: true,
        scroller:       true,
        searching: false,

        } );
    }
</script>
