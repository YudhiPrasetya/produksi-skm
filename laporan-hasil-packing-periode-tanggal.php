<?php 
  require_once 'core/init.php';    
  $tglawal = $_POST['tgl_awal'];
  $tglakhir = $_POST['tgl_akhir'];
?>

<head>
  <script src="/produksi-skm/assets/js/jquery.js"></script>
  <link rel="stylesheet" type="text/css" href="/produksi-skm/assets/css/bootstrap.css">
</head>

<!-- <body onLoad="window.print()"> -->
<title>Laporan SCAN PACKING (READY KARTON)</title>

<div style="margin-left: 20px; margin-right: 20px; margin-bottom: 20px; margin-top: 20px">
  <button class="btn btn-info" style="background: #254681" id="btnExportToExcel">Export To Excel</button>
</div>
<div id="tableContainer">
<center>
<h1>PT. Globalindo Intimates</h1>
<h3>LAPORAN HASIL SCAN PACKING</h3>
Periode Tanggal : <?= tanggal_indo2($tglawal, false) ?> s/d <?= tanggal_indo2($tglakhir, false) ?>
</center>

<br>
<br>

<?php 
$qty_total_a = 0;
$qty_total_semua = 0;
  $ctk =array(); 
  $laporan = tampilkan_hasil_packing_periode_hari($tglawal, $tglakhir);
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

<center>
<table  border='1' class='table table-hover' width=100% cellpadding=6 >
  <thead>
    <tr>
      <th style="background-color:#f4f4f4; "><center>NO</center></th>
      <th style="background-color:#f4f4f4; "><center>ORC</center></th>
      <th style="background-color:#f4f4f4; "><center>NO PO</center></th>
      <th style="background-color:#f4f4f4; "><center>LABEL</center></th>
      <!-- <th style="background-color:#f4f4f4; "><center>KODE BARCODE</center></th> -->
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
      <!-- <td align='center'><?php echo $pilih['kode_barcode'] ?></td> -->
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
    <tr>
      <td style='background-color:#f4f4f4;' colspan='7' >Total Semua QTY :</td>
      <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_a ?></td>
      
    </tr>
  </tbody>
</table>
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
</div>

<script>
  $(document).ready(function(){
    $('#btnExportToExcel').click(function(e) {
      let file = new Blob([$('#tableContainer').html()], {
          type: "application/vnd.ms-excel"
      });
      let url = URL.createObjectURL(file);
      let a = $("<a />", {
          href: url,
          download: "lap_packing_tgl.xls"
      }).appendTo("body").get(0).click();
      e.preventDefault();
    });    
  });
</script>