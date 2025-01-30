<?php
require_once 'core/init.php';
$costomer = $_POST['costomer'];
$line = $_POST['line'];
$bulan = $_POST['bulan'];

?>
<script src="assets/Chart.js"></script>
<div style=" width: 90%;  margin: 15px auto;">
    <canvas id="barchart" width="100" height="40"></canvas>
</div>

<script  type="text/javascript">
  var ctx = document.getElementById("barchart").getContext("2d");
  var data = {
            labels: [<?php 
                 $grafik = tampilkan_output_qc_endline_pilih_bulan_grafik($bulan, $line, $costomer);
                while ($p = mysqli_fetch_array($grafik)) { echo '"'.tgl_indonesia6($p['tanggal']).'",';}?>],
            datasets: [
            {
              label: "Total Output",
              data: [<?php 
              $grafik = tampilkan_output_qc_endline_pilih_bulan_grafik($bulan, $line, $costomer);
              while ($p = mysqli_fetch_array($grafik)) { echo '"' . $p['total_output'] . '",';}?>],
              backgroundColor: [
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80',
                '#007C80'
              ]
            }
            ]
            };

  var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
            legend: {
              display: false
            },
            barValueSpacing: 20,
            scales: {
              yAxes: [{
                  ticks: {
                      min: 0,
                  }
              }],
              xAxes: [{
                          gridLines: {
                              color: "rgba(0, 0, 0, 0)",
                          }
                      }]
              }
          }
        });

</script>