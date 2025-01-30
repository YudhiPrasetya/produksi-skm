<?php
require_once 'core/init.php';

  $tgl = $_GET['tgl'];
  $orc = $_GET['orc'];
  $style = $_GET['style'];
  $status = $_GET['status'];
  $costomer = $_GET['costomer'];
  $jalan_line = $_GET['line'];
  $plan_line = $_GET['line'];
  $no_po = $_GET['no_po'];
  $color = $_GET['color'];

  
 
?>

<div class="row">

</div>
<div style="margin: 20px">
  <button class="btn btn-success pb-1" style="background: #254681; margin-bottom:5px;" id="btnExportToExcel">Export To Excel</button>
  <div id="tableContainer">
  <table border="1px"  class="table table-striped table-bordered row-border order-column display" id="example" style="font-size: 12px;">
  
  <thead>
      <tr>
      <th  style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2>NO</th>
      <th  style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2>LINE</th>
      <th  style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2>CUSTOMER</th>
      <th  style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2>NO PO</th>
      <th  style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2>STYLE</th>
      <th  style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2>ORC</th>
      <th  style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2>COLOR</th>
      <th  style="text-align: center; background: #254681; vertical-align: middle; color: white;" rowspan=2>ORDER</th>
        <?php
          $proses = tampilkan_transaksi_all_proses($orc, $style, $status, $costomer, $no_po, $color);
          while($data2 = mysqli_fetch_assoc($proses)){ ?>
          <th style='text-align: center; background: #254681;; color: white;' colspan='4'>
            <?php
              if($data2['nama_transaksi'] == 'sewing'){
                echo 'INPUT SEWING';
              }else{
                echo str_replace('_', ' ', strtoupper($data2['nama_transaksi']));
              }
             ?>
          </th>
        <?php } ?>
    </tr>
    <tr>
    
    <?php
          $proses = tampilkan_transaksi_all_proses($orc, $style, $status, $costomer, $no_po, $color);
          while($data2 = mysqli_fetch_assoc($proses)){
        ?>
    <th style="text-align: center; background: #254681; color: white;">DAILY OUTPUT</th>
    <th style="text-align: center; background: #254681; color: white;">TOTAL OUTPUT</th>
    <th style="text-align: center; background: #254681; color: white;">IN WIP</th>
    <th style="text-align: center; background: #254681; color: white; vertical-align: middle;" width="10%">READY</th>
    <?php } ?>
    <!-- <th style="text-align: left; background: #254681">RECORD</th> -->
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
$sql = tampilkan_laporan_bundle_record_allproses($tgl, $orc, $style, $status, $costomer, $jalan_line, $no_po, $color);
while($row=mysqli_fetch_assoc($sql))
{ 
   //print_r($row);
    ?>
    <tr>
        <td align="center"><?= $no ?></td>
        <td align="center"><?= $row['line'] ?></td>
        <td align="center"><?= $row['costomer'] ?></td>
        <td align="center"><?= $row['no_po'] ?></td>
        <td align="center"><?= $row['style'] ?></td>
        <td align="center"><?= $row['orc'] ?></td>
        <td align="center"><?= $row['color'] ?></td>

        <td align="center">
          <?= strtoupper($row['qty_order']);?>
          </td>
        <?php 
          $proses = tampilkan_transaksi_all_proses($orc, $style, $status, $costomer, $no_po, $color);
          $jumlah_data = mysqli_num_rows($proses);
          
          foreach($proses as $key => $data2){
          $key+=1;
          $check_ada = check_proses_transaksi($row['id_order'], $data2['nama_transaksi']);
          $data3 = mysqli_fetch_assoc($check_ada);

          if($key < $jumlah_data){
            $check_after_proses = check_after_proses_transaksi($row['id_order'], $data3['urutan']);
            $data4 = mysqli_fetch_assoc($check_after_proses);
          }

        ?>
        <td align="center" style="<?php if($row[$data2['kolom_total']] == $row['qty_order']){ echo "background:  #82F903"; } ?>" ><?= $row[$data2['kolom_today']] ?></td>
        <td align="center" style="<?php if($row[$data2['kolom_total']] == $row['qty_order']){ echo "background:  #82F903"; } ?>"><?= $row[$data2['kolom_total']] ?></td>
        <td align="center" style="<?php if($row[$data2['kolom_total']] == $row['qty_order']){ echo "background:  #82F903"; } ?>">
        <?php 
        if($data3) {
          echo $row[$data2['kolom_balance']];
        }else{
          echo 0;
        }
        ?>
        </td>
        <td align="center" style="<?php if($row[$data2['kolom_total']] == $row['qty_order']){ echo "background:  #82F903"; } ?>">
        <?php
            if($data3){
              if(($key < $jumlah_data) && ($data4 != null)){
                echo $row[$data2['kolom_total']] - $row[$data4['kolom_total']];
              }else{
                echo $row[$data2['kolom_total']] - 0;
              }
            }else{
              echo 0;
            }
         ?>
      </td>
        <?php } ?>
       
    </tr>

<?php
    
$no++;
 } ?>
</tbody>
 
</table>
</div>
</div>

<!-- <script type="text/javascript">
    $(document).ready(function() {
    $('#example').dataTable( {
      rowReorder: true,
      paging: false,
      fixedHeader: {
            header: true,
            footer: true
        }
    } );
} );
</script> -->

<script type="text/javascript">
    $(document).ready(function() {
      var table = $('#example').DataTable( {
          // columnDefs: [
          //     {
          //         searchable: false,
          //         orderable: false,
          //         targets: 0
          //     }
          // ],          
          scrollY:        "400px",
          scrollX:        true,
          scrollCollapse: true,
          paging:         true,
          lengthMenu: [
            [50, 75, 100, -1],
            [50, 75, 100, 'All']
          ],
          searching : false, 
          fixedColumns:   {
              left: 6,
          },
          // rowCallback: function( row, data, index ) {
          //   if (data[8] == 0 && data[11] == 0 && data[14] == 0 && data[17] == 0 & data[20] == 0) {
          //     $(row).hide();
          //     // table.draw();
          //   }
          // },        
      });

      // table.on('order.dt search.dt', function () {
      //   let i = 1;
 
      //   table
      //     .cells(null, 0, { search: 'applied', order: 'applied' })
      //     .every(function (cell) {
      //           this.data(i++);
      //     });
      // }).draw();      

      $('#btnExportToExcel').click(function(e) {
          // let fileName = '<//?= $data4['no_invoice'] ?>';
          let file = new Blob([$('#tableContainer').html()], {
              type: "application/vnd.ms-excel"
          });
          let url = URL.createObjectURL(file);
          let a = $("<a />", {
              href: url,
              download: "hasil_scan_global_all_proses" + ".xls"
          }).appendTo("body").get(0).click();
          e.preventDefault();
      });    
    });
</script>