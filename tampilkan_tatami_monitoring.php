<?php
   require_once 'core/init.php';
   require_once 'view/header_dashboard.php';

   date_default_timezone_set('Asia/Jakarta');

   if( !isset($_SESSION['username']) ){
      echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
    }

    $userName = $_SESSION['username'];
    $dataUser = tampilkan_line_username($_SESSION['username']);

    $tgl = date('Y-m-d');

    $dataArray = array();
   //  $hasil = init_table_monitor_qc_endline($tgl, $line);
   $hasil = tampil_monitor_tatami($tgl);

   while($row = mysqli_fetch_assoc($hasil)){
      $data = [
         "id" => $row["id"], 
         "orc" => preg_replace("/\s+/","",$row["orc"]), 
         "status" => $row["status"], 
         "style" => $row["style"], 
         "color" => $row["color"],
         "size" => $row["size"], 
         "cup" => $row["cup"], 
         "qty_order" => $row["QTY_ORDER"], 
         "today" => $row["TODAY"],
         // "yesterday" => $row["YESTERDAY"],
         "total" => $row["TOTAL"], 
         "bal" => $row["BAL"], 
         "tanggal" => $row["tanggal"], 
         "jam" => $row["JAM"],
      ];
      array_push($dataArray, $data);
   }

   $dataInitPacking = json_encode($dataArray);

   $dataPackingYesterday = get_output_packing_yesterday($tgl);

   $dtPackingYesterday = mysqli_fetch_assoc($dataPackingYesterday);
   // var_dump($dtPackingYesterday);
?>

<html>
   <head>
      <style>
         body{
            overflow: hidden;
         }
         th.dt-center, td.dt-center { text-align: center; }

         #qcEndlineEffTable.table td{
            font-size: 0.9em;
            padding-left: 2px;
            padding-right: 2px;
            padding-top: 8px;
            padding-bottom: 8px;
         }         
         #qcEndlineEffTable.table th{
            font-size: 0.8em;
            padding-left: 2px;
            padding-right: 2px;
            padding-top: 4px;
            padding-bottom: 4px;
         }         
      </style>
   </head>
   <body class="g-sidenav-show" onload="showTime()">
      <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
         <div class="container-fluid py-2">

            <!-- Background -->
            <svg class="position-absolute top-0" width="2000" height="2000" viewBox="0 0 1231 1421" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g opacity="0.12786" filter="url(#filter0_f_31_15)">
                  <ellipse cx="811.5" cy="602.5" rx="675.5" ry="682.5" fill="url(#paint0_linear_31_15)" />
               </g>
               <defs>
                  <filter id="filter0_f_31_15" x="0.085907" y="-215.914" width="1622.83" height="1636.83" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                     <feFlood flood-opacity="0" result="BackgroundImageFix" />
                     <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
                     <feGaussianBlur stdDeviation="67.957" result="effect1_foregroundBlur_31_15" />
                  </filter>
                  <linearGradient id="paint0_linear_31_15" x1="804.405" y1="-136.203" x2="160.281" y2="643.776" gradientUnits="userSpaceOnUse">
                     <stop stop-color="#7B4CFF" />
                     <stop offset="0.469471" stop-color="#EC407A" />
                     <stop offset="1" stop-color="white" />
                  </linearGradient>
               </defs>
            </svg>
            
            <div class="row mx-0 px-1">
               <div class="col-md-12 pl-2">
                  <div class="ms-3">
                     <h3 class="mb-0 h4 font-weight-bolder">Packing Screen Result</h3>
                     <p class="mb-4">
                        (Menampilkan Hasil Packing).
                     </p>
                  </div>

                  <div class="row">

                     <div class="col-xl-3 col-md-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card shadow">
                           <div class="card-header p-2 ps-3 bg-gradient-dark">
                              <div class="d-flex justify-content-between">
                                 <div>
                                    <p class="text-sm mb-0 text-capitalize text-white">Date</p>
                                    <h4 class="mb-0 text-white"><?= date('d/m/Y') ?></h4>
                                 </div>
                                 <div class="icon icon-md icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">timer</i>
                                 </div>
                              </div>
                           </div>
                           <hr class="dark horizontal my-0">
                           <div class="card-footer p-2 ps-3">
                              <p class="mb-0 text-sm">
                                 <span class="text-success font-weight-bolder" id="jam"></span>
                              </p>
                           </div>
                        </div>
                     </div>

                     <div class="col-xl-3 col-md-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card shadow">
                           <div class="card-header p-2 ps-3 bg-gradient-dark">
                           <div class="d-flex justify-content-between">
                              <div>
                                 <p class="text-sm mb-0 text-capitalize text-white">User</p>
                                 <h4 class="mb-0 text-white"><?= $userName; ?></h4>
                              </div>
                              <div class="icon icon-md icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-lg">
                                 <i class="material-symbols-rounded opacity-10">person</i>
                              </div>
                           </div>
                           </div>
                           <hr class="dark horizontal my-0">
                           <div class="card-footer p-2 ps-3">
                           <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">PACKING </span></p>
                           </div>
                        </div>
                     </div>

                     <div class="col-xl-3 col-md-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card shadow">
                           <div class="card-header p-2 ps-3 bg-gradient-dark">
                              <div class="d-flex justify-content-between">
                                 <div>
                                    <p class="text-sm mb-0 text-capitalize text-white">Packing Today</p>
                                    <h4 class="mb-0 text-white" id="packingToday">0</h4>
                                 </div>
                                 <div class="icon icon-md icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">manufacturing</i>
                                 </div>
                              </div>
                           </div>
                           <hr class="dark horizontal my-0">
                           <div class="card-footer p-2 ps-3">
                           <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">Show </span></p>
                           </div>
                        </div>
                     </div>

                     <div class="col-xl-3 col-md-3 col-sm-6 mb-xl-0 mb-2 mt-2">
                        <div class="card shadow">
                           <div class="card-header p-2 ps-3 bg-gradient-dark">
                              <div class="d-flex justify-content-between">
                                 <div>
                                    <p class="text-sm mb-0 text-capitalize text-white">Packing Yesterday</p>
                                    <h4 class="mb-0 text-white" id="packingYesterday"></h4>
                                 </div>
                                 <div class="icon icon-md icon-shape bg-gradient-info shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">manufacturing</i>
                                 </div>
                              </div>
                           </div>
                           <hr class="dark horizontal my-0">
                           <div class="card-footer p-2 ps-3">
                           <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">Show </span></p>
                           </div>
                        </div>
                     </div>
                  </div>                     

                  <div class="row pt-3">
                     <div class="card">
                           <div class="card-header p-0 position-relative mt-4 mx-3 z-index-2">
                              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-2 pb-1">
                                 <h6 class="text-white text-capitalize ps-3">Packing Result</h6>
                              </div>
                           </div>
                           <div class="card-body px-0 pb-2">
                              <!-- <div class="table-responsive p-0"> -->
                                 <table class="table align-items-center mb-0" id="packingTable">
                                    <thead>
                                       <tr>
                                          <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">ID</th>
                                          <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">ORC</th>
                                          <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">Style</th>
                                          <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">Qty Order</th>
                                          <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">Today</th>
                                          <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">Total</th>
                                          <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">Balance</th>
                                          <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">Tanggal</th>
                                          <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">Jam</th>
                                       </tr>
                                    </thead>
                                 </table>
                              <!-- </div> -->
                           </div> 
                        </div>

                        
                     </div>
                  </div>
               </div>                     
            </div>

            <footer class="footer py-4  ">
               <div class="container-fluid">
                  <div class="row align-items-center justify-content-lg-between">
                     <div class="col-lg-6 mb-lg-0 mb-4">
                     <div class="copyright text-center text-sm text-muted text-lg-start">
                        © <script>
                           document.write(new Date().getFullYear())
                        </script>,
                        made with <i class="fa fa-heart"></i> by
                        <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Globalindo - MIS</a>
                        for a better future.
                     </div>
                     </div>
                  </div>
               </div>
            </footer>
         </div>
      </main>
      <!--   Core JS Files   -->
      <script>
         var todayPackingSUM = 0, yesterdayPackingSUM = 0;
         var packingTable;
         var dataInitPacking = '<?= $dataInitPacking; ?>';
         var objDataPackingInit = JSON.parse(dataInitPacking);

         var strCurrentDate = new Date().toJSON().slice(0, 10);

         // var dtQCEndLineYesterday = '<//?= $dtQCEndLineYesterday['Output_Yesterday']; ?>';

         // $('#sewingYesterday').text(dtQCEndLineYesterday);
         var dtPackingYesterday = "<?= $dtPackingYesterday['Packing_Yesterday']; ?>";
         $('#packingYesterday').text(dtPackingYesterday == "" ? 0 : dtPackingYesterday);
        
         var today = new Date();
         
         // var packing = new WebSocket("ws://localhost:10000/?service=send_message");
         var packing = new WebSocket("ws://192.168.90.100:10000/?service=send_message");
         // var qc_endline = new WebSocket("ws://192.168.90.100:10000/?service=packing");
         // var objDataQCEndlineOnMessage;

         $(document).ready(function(){
            initPacking();

            function initPacking(){
               packingTable = $('#packingTable').DataTable({
                  autoWidth: true,
                  processing: true,
                  destroy: true,
                  info: false,
                  searching: false,
                  paging: true,
                  fixedHeader: true,
                  order: [[0, 'desc']],
                  columnDefs: [
                     {'className': 'dt-center', 'targets': '_all'},
                     {'targets': [0,7,8], 'visible': false},
                  ]
               });
               var x = 0, arrLength = objDataPackingInit.length;
               while(x < arrLength){
                  todayPackingSUM += parseInt(objDataPackingInit[x].today);
                  packingTable.row.add([
                     objDataPackingInit[x].id,
                     objDataPackingInit[x].orc,
                     objDataPackingInit[x].style,
                     objDataPackingInit[x].qty_order,
                     objDataPackingInit[x].today,
                     objDataPackingInit[x].total,
                     objDataPackingInit[x].bal,
                     objDataPackingInit[x].tanggal,
                     objDataPackingInit[x].jam,
                  ]).draw();
                  ++x;
               }
               $('#packingToday').text(todayPackingSUM)
               // qcEndlineOutputTable.columns([6,7]).visible(false);
            }
         });
         
         packing.onmessage = function(msg){
            var objDataPackingOnMessage = JSON.parse(msg.data);
            console.table(objDataPackingOnMessage);

            todayPackingSUM = 0;
            packingTable.clear().draw();

            var y = 0, arrPackingLengthOnMessage = objDataPackingOnMessage.length;
            while(y < arrPackingLengthOnMessage){
               todayPackingSUM += parseInt(objDataPackingOnMessage[y].today);
               packingTable.row.add([
                  objDataPackingOnMessage[y].id,
                  objDataPackingOnMessage[y].orc,
                  objDataPackingOnMessage[y].style,
                  objDataPackingOnMessage[y].qty_order,
                  objDataPackingOnMessage[y].today,
                  objDataPackingOnMessage[y].total,
                  objDataPackingOnMessage[y].bal,
                  objDataPackingOnMessage[y].tanggal,
                  objDataPackingOnMessage[y].jam
               ]).draw();                  
               ++y;
            }
            $('#packingToday').text(todayPackingSUM);

         }

         function showTime(){
            const date = new Date();
            let h = date.getHours();
            let m = date.getMinutes();
            let s = date.getSeconds();

            h = (h < 10) ? h = "0" + h : h;
            m = (m < 10) ? m = "0" + m : m;
            s = (s < 10) ? s = "0" + s : s;

            let time = h + ":" + m + ":" + s;
            // console.log('time: ' + time);
            document.getElementById('jam').innerHTML = time;
            setTimeout(showTime, 1000);            
         }

      </script>
      

   </body>

</html>
