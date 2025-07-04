<?php 
  require_once 'core/init.php';
  require_once 'view/header.php';

  $tglawal = $_POST['tgl_awal'];
  $tglakhir = $_POST['tgl_akhir'];
?>
<!-- <body onLoad="window.print()"> -->
<title>Laporan SCAN KENZIN</title>
<center>
<h1>PT. Globalindo Intimates</h1>
<h3>LAPORAN HASIL SCAN KENZIN</h3>
Periode Tanggal : <?= tanggal_indo2($tglawal, false) ?> s/d <?= tanggal_indo2($tglakhir, false) ?>
</center>

<br>
<br>

<?php 
$qty_total_a = 0;
$qty_total_semua = 0;
  $ctk =array(); 
  $laporan = tampilkan_hasil_kenzin_periode_hari($tglawal, $tglakhir);
    while($pilih = mysqli_fetch_array($laporan)){
      $ctk[$pilih['tanggal']][$pilih['costomer']][]=array(
        'orc'=>$pilih['orc'],
        'no_po'=>$pilih['no_po'],
        'size'=>$pilih['size'],
        'cup'=>$pilih['cup'],
        'warna'=>$pilih['warna'],
        'label'=>$pilih['label'],
        'style'=>$pilih['style'],
        'kode_barcode'=>$pilih['kode_barcode'],
        'qtya'=>$pilih['qtya']
      );                                                    
    } 

    foreach($ctk as $tanggal=>$kdcostomer)
    foreach($kdcostomer as $costomer=>$data){
 ?>



<table width = 100%>
  <tr style="font-weight:bold">
    
    <td width=5%>COSTOMER</td> <td>:</td> <td width=8%><?= $costomer ?></td>
    <td width=65%></td>
    <td width=5%>TANGGAL</td> <td>:</td> <td width=13%><?= $tanggal ?></td></strong>
  </tr>
</table>

<div style="margin-left: 20px; margin-right: 20px; margin-bottom: 20px;">
  <button class="btn btn-info" style="background: #254681" id="btnExportToExcel">Export To Excel</button>
</div>

<!-- <center> -->

<div id="tableContainer">
<table border='1' class='table table-hover display' width=100% cellpadding=6 id="tableHasilKenzin">
  <thead>
    <tr>
      <th style="background-color:#f4f4f4; "><center>NO</center></th>
      <th style="background-color:#f4f4f4; "><center>ORC</center></th>
      <th style="background-color:#f4f4f4; "><center>NO PO</center></th>
      <th style="background-color:#f4f4f4; "><center>LABEL</center></th>
      <th style="background-color:#f4f4f4; "><center>KODE BARCODE</center></th>
      <th style="background-color:#f4f4f4; "><center>STYLE</center></th>
      <th style="background-color:#f4f4f4; "><center>COLOR</center></th>
      <th style="background-color:#f4f4f4; "><center>SIZE</center></th>
      <th style="background-color:#f4f4f4; "><center>SCAN</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
        $no=0;
        foreach($data as $pilih){
        $no++;
    ?>
    <tr>
      <td align='center'><?php echo $no; ?> </td>
      <td align='center'><?php echo $pilih['orc'] ?></td>
      <td align='center'><?php echo $pilih['no_po'] ?></td>
      <td align='center'><?php echo $pilih['label'] ?></td>
      <td align='center'><?php echo $pilih['kode_barcode'] ?></td>
      <td align='center'><?php echo $pilih['style'] ?></td>
      <td align='center'><?php echo $pilih['warna'] ?></td>
      <td align='center'><?php echo $pilih['size'].$pilih['cup'] ?></td>
      <td align='center'><?php echo $pilih['qtya']; ?></td>
    </tr>
      <?php
        $qty_total_a += $pilih['qtya'];
        $qty_total_semua += $pilih['qtya'];
      }
       ?>
    <!-- <tr>
      <td style='background-color:#f4f4f4;' colspan='8' >Total Semua QTY :</td>
      <td style='background-color:#f4f4f4;' align='center'><//?= $qty_total_a ?></td>
      
    </tr> -->
  </tbody>
  <tfoot>
    <tr>
      <th colspan=8 style="text-align: right; background: #254681; color: white;"></th>
      <th style="text-align: center; background: #254681; color: white;"></th>
    </tr>
  </tfoot>
</table>
</div>
<br>
<br>
    <?php   
       $qty_total_a=0; 
      }
    ?>
</center>
<br>
<div style="background-color: lightblue; padding: 10px;">
<b>Total Scan Tatami : <?= $qty_total_semua ?> PCS </b>
</div>
<br>
<table width="100%">
<tr>
  <td width="20%" align="center"></td>
  <td width="60%"></td>
  <td width="20%" align="center">Checked By</td>
</tr>
<tr>
  <td width="20%" align="center"></td>
  <td width="60%"></td>
  <td width="20%" align="center">PACKING</td>
</tr>
</table>



<script type="text/javascript">
  $(document).ready(function(){
    var tglawal = '<?= $tglawal; ?>';
    var tglakhir = '<?= $tglakhir; ?>';

    $('#tableHasilKenzin').DataTable({
      "paging": false,
      "deferRender": true,
      "scrollY": 500,
      "scrollCollapse": true,
      "scroller": true,
      "scrollX": true,
      "footerCallback": function(row, data, start, end, display){
        var api = this.api(), data;
        // converting to interger to find total
        var intVal = function ( i ) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '')*1 :
                typeof i === 'number' ?
                    i : 0;
        };

        var totalScan = api.column(8).data().reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0
        );                    

        $( api.column( 0 ).footer() ).html('Total : ');
        $( api.column( 8 ).footer() ).html(totalScan);
      }        
    });

    $('#btnExportToExcel').click(function(e) {
      // let fileName = $('#proses').val();
      // console.log($('#tableContainer').html());
      let file = new Blob([$('#tableContainer').html()], {
          type: "application/vnd.ms-excel"
      });
      let url = URL.createObjectURL(file);
      let a = $("<a />", {
          href: url,
          download: `laporan_kenzin_${tglawal}-${tglakhir}` + ".xls"
          // download: "lap_kenzin.xls"
      }).appendTo("body").get(0).click();
      e.preventDefault();
    });    

  });
</script>
<!-- </body> -->
