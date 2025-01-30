<?php
require_once 'core/init.php';
$costomer = $_GET['costomer'];
$lantai = $_GET['lantai'];
$tanggal = $_GET['tanggal'];

?>
<script src="assets/Chart.js"></script>
<div style=" width: 90%;  margin: 15px auto;">
    <canvas id="barchart" width="100" height="40"></canvas>
</div>


<script  type="text/javascript">
  var ctx = document.getElementById("barchart").getContext("2d");
  var data = {
            labels: [<?php 
                 $grafik = tampilkan_output_qc_endline_pilih_tanggal_grafik($tanggal, $lantai, $costomer);
                while ($p = mysqli_fetch_array($grafik)) { echo '"'.$p['line'].'",';}?>],
            datasets: [
            {
              label: "Total Output",
              data: [<?php 
              $grafik = tampilkan_output_qc_endline_pilih_tanggal_grafik($tanggal, $lantai, $costomer);
              while ($p = mysqli_fetch_array($grafik)) { echo '"' . $p['total_output'] . '",';}?>],
              backgroundColor: [
                '#29B0D0',
                '#2A516E',
                '#F07124',
                '#800000',
                '#808000',
                '#008000',
                '#DAA520',
                '#A42A04',
                '#770737',
                '#FF7F50',
                '#40B5AD',
                '#009E60',
                '#228B22',
                '#088F8F',
                '#4169E1'
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