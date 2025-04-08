<?php
   require_once 'core/init.php';
   require_once 'view/header_dashboard.php';
   date_default_timezone_set('Asia/Jakarta');

   if( !isset($_SESSION['username']) ){
      echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
    }

    $userName = $_SESSION['username'];
    $dataUser = tampilkan_line_username($_SESSION['username']);

    $tempLine = mysqli_fetch_array($dataUser);
    $line = $tempLine['line'];

    $dataSPV = tampilkan_spv_by_namaline($line);
    $tempSPV = mysqli_fetch_array($dataSPV);
    $spv = $tempSPV['supervisor'];

?>

<html>
   <head>
      <style>
         th.dt-center, td.dt-center { text-align: center; }
      </style>
   </head>
   <body class="g-sidenav-show" onload="showTime()">
      <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
         <div class="container-fluid py-2">

            <!-- Background -->
            <svg class="position-absolute top-0" width="1421" height="1421" viewBox="0 0 1231 1421" fill="none" xmlns="http://www.w3.org/2000/svg">
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
            
            <div class="row">
               <div class="col-md-8 pl-2">
                  <div class="ms-3">
                     <h3 class="mb-0 h4 font-weight-bolder">Sewing Screen Output Result</h3>
                     <p class="mb-4">
                        (Menampilkan Hasil Output Sewing).
                     </p>
                  </div>

                  <div class="row">

                     <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
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

                     <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card shadow">
                           <div class="card-header p-2 ps-3 bg-gradient-dark">
                           <div class="d-flex justify-content-between">
                              <div>
                                 <p class="text-sm mb-0 text-capitalize text-white">Line</p>
                                 <h4 class="mb-0 text-white"><?= $line; ?></h4>
                              </div>
                              <div class="icon icon-md icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-lg">
                                 <i class="material-symbols-rounded opacity-10">person</i>
                              </div>
                           </div>
                           </div>
                           <hr class="dark horizontal my-0">
                           <div class="card-footer p-2 ps-3">
                           <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">SPV </span><?= $spv; ?></p>
                           </div>
                        </div>
                     </div>

                     <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card shadow">
                           <div class="card-header p-2 ps-3 bg-gradient-dark">
                              <div class="d-flex justify-content-between">
                                 <div>
                                    <p class="text-sm mb-0 text-capitalize text-white">Operators</p>
                                    <h4 class="mb-0 text-white">0</h4>
                                 </div>
                                 <div class="icon icon-md icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">groups</i>
                                 </div>
                              </div>
                           </div>
                           <hr class="dark horizontal my-0">
                           <div class="card-footer p-2 ps-3">
                              <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">Show </span></p>
                           </div>
                        </div>
                     </div>

                     <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card shadow">
                           <div class="card-header p-2 ps-3 bg-gradient-dark">
                              <div class="d-flex justify-content-between">
                                 <div>
                                    <p class="text-sm mb-0 text-capitalize text-white">Machines Fixed</p>
                                    <h4 class="mb-0 text-white">0</h4>
                                 </div>
                                 <div class="icon icon-md icon-shape bg-gradient-warning shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">build</i>
                                 </div>
                              </div>
                           </div>
                           <hr class="dark horizontal my-0">
                           <div class="card-footer p-2 ps-3">
                              <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">Show </span></p>
                           </div>
                        </div>
                     </div>

                     <!-- Table -->
                     <div class="row">
                        <div class="mt-4">
                           <div class="card">
                              <div class="card-header p-0 position-relative mt-4 mx-3 z-index-2">
                                 <div class="bg-gradient-dark shadow-dark border-radius-lg pt-2 pb-1">
                                    <h6 class="text-white text-capitalize ps-3">Output Result</h6>
                                 </div>
                              </div>
                              <div class="card-body px-0 pb-2">
                                 <!-- <div class="table-responsive p-0"> -->
                                    <table class="table align-items-center mb-0" id="qcEndlineOutputTable">
                                       <thead>
                                          <tr>
                                             <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">ORC</th>
                                             <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">Style</th>
                                             <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">Qty Order</th>
                                             <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">Today</th>
                                             <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">Total</th>
                                             <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">Balance</th>
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

               <div class="col-md-4 px-0">
                  <div class="row mb-6"></div>
                  <div class="row pt-3">

                     <!-- Line Performanfe -->
                     <div class="col-md-6 col-sm-6 mb-xl-0 mb-2">
                        <div class="card shadow">
                           <div class="card-header p-2 ps-3 bg-gradient-dark">
                              <div class="d-flex justify-content-between">
                                 <div>
                                    <p class="text-sm mb-0 text-capitalize text-white">Today Line Efficiency</p>
                                    <h4 class="mb-0 text-white"></h4>
                                 </div>
                                 <div class="icon icon-md icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">percent</i>
                                 </div>
                              </div>
                           </div>
                           <hr class="dark horizontal my-0">
                           <div class="card-footer p-2 ps-3">
                              <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">Show </span></p>
                           </div>
                        </div>
                     </div>

                     <div class="col-xl-6 col-sm-6 mb-xl-0 mb-2">
                        <div class="card shadow">
                           <div class="card-header p-2 ps-3 bg-gradient-dark">
                              <div class="d-flex justify-content-between">
                                 <div>
                                    <p class="text-sm mb-0 text-capitalize text-white">Today Downtime Machine</p>
                                    <h4 class="mb-0 text-white">00:00:00</h4>
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

                     <div class="col-md-6 col-sm-6 mb-xl-0 mb-2 mt-2">
                        <div class="card shadow">
                           <div class="card-header p-2 ps-3 bg-gradient-dark">
                              <div class="d-flex justify-content-between">
                                 <div>
                                    <p class="text-sm mb-0 text-capitalize text-white">Sewing Today</p>
                                    <h4 class="mb-0 text-white" id="sewingToday"></h4>
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

                     <div class="col-md-6 col-sm-6 mb-xl-0 mb-2 mt-2">
                        <div class="card shadow">
                           <div class="card-header p-2 ps-3 bg-gradient-dark">
                              <div class="d-flex justify-content-between">
                                 <div>
                                    <p class="text-sm mb-0 text-capitalize text-white">Sewing Yesterday</p>
                                    <h4 class="mb-0 text-white" id="sewingYesterday"></h4>
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

                     <div class="col-md-6 col-sm-6 mb-xl-0 mb-2 mt-2">
                        <div class="card shadow">
                           <div class="card-header p-2 ps-3 bg-gradient-dark">
                              <div class="d-flex justify-content-between">
                                 <div>
                                    <p class="text-sm mb-0 text-capitalize text-white">Packing Today</p>
                                    <h4 class="mb-0 text-white" id="packingToday"></h4>
                                 </div>
                                 <div class="icon icon-md icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">inventory_2</i>
                                 </div>
                              </div>
                           </div>
                           <hr class="dark horizontal my-0">
                           <div class="card-footer p-2 ps-3">
                           <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">Show </span></p>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6 col-sm-6 mb-xl-0 mb-2 mt-2">
                        <div class="card shadow">
                           <div class="card-header p-2 ps-3 bg-gradient-dark">
                              <div class="d-flex justify-content-between">
                                 <div>
                                    <p class="text-sm mb-0 text-capitalize text-white">Packing Yesterday</p>
                                    <h4 class="mb-0 text-white" id="packingYesterday"></h4>
                                 </div>
                                 <div class="icon icon-md icon-shape bg-gradient-info shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">inventory_2</i>
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

               </div>
            </div>

            <div class="row">
               <div class="mt-4">
                  <div class="card">
                     <div class="card-header p-0 position-relative mt-4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-2 pb-1">
                           <h6 class="text-white text-capitalize ps-3">Line Output Hourly</h6>
                        </div>
                     </div>
                     <div class="card-body px-0 pb-2">
                        <!-- <div class="table-responsive p-0"> -->
                           <table class="table align-items-center mb-0">
                              <thead>
                                 <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">#</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">1st</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">2nd</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">3rd</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">4th</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">5th</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">6th</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">7th</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">8th</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">9th</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder align-middle text-center">10th</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td class="align-middle text-center">Target</td>
                                    <td class="align-middle text-center">100</td>
                                    <td class="align-middle text-center">100</td>
                                    <td class="align-middle text-center">100</td>
                                    <td class="align-middle text-center">100</td>
                                    <td class="align-middle text-center">100</td>
                                    <td class="align-middle text-center">100</td>
                                    <td class="align-middle text-center">100</td>
                                    <td class="align-middle text-center">100</td>
                                    <td class="align-middle text-center">100</td>
                                    <td class="align-middle text-center">100</td>
                                 </tr>
                                 <tr>
                                    <td class="align-middle text-center">Output Sewing</td>
                                    <td class="align-middle text-center">25</td>
                                    <td class="align-middle text-center">50</td>
                                    <td class="align-middle text-center">70</td>
                                    <td class="align-middle text-center">85</td>
                                 </tr>
                                 <tr>
                                 <td class="align-middle text-center">Eficiency(%)</td>
                                    <td class="align-middle text-center">25</td>
                                    <td class="align-middle text-center">50</td>
                                    <td class="align-middle text-center">70</td>
                                    <td class="align-middle text-center">85</td>                                    
                                 </tr>   
                              </tbody>                        
                           </table>
                        <!-- </div> -->
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
      <div class="fixed-plugin">
         <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="material-symbols-rounded py-2">settings</i>
         </a>
         <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
            <div class="float-start">
               <h5 class="mt-3 mb-0">Material UI Configurator</h5>
               <p>See our dashboard options.</p>
            </div>
            <div class="float-end mt-4">
               <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                  <i class="material-symbols-rounded">clear</i>
               </button>
            </div>
            <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
            <!-- Sidebar Backgrounds -->
            <div>
               <h6 class="mb-0">Sidebar Colors</h6>
            </div>
            <a href="javascript:void(0)" class="switch-trigger background-color">
               <div class="badge-colors my-2 text-start">
                  <span class="badge filter bg-gradient-primary" data-color="primary" onclick="sidebarColor(this)"></span>
                  <span class="badge filter bg-gradient-dark active" data-color="dark" onclick="sidebarColor(this)"></span>
                  <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                  <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                  <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                  <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
               </div>
            </a>
            <!-- Sidenav Type -->
            <div class="mt-3">
               <h6 class="mb-0">Sidenav Type</h6>
               <p class="text-sm">Choose between different sidenav types.</p>
            </div>
            <div class="d-flex">
               <button class="btn bg-gradient-dark px-3 mb-2" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
               <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
               <button class="btn bg-gradient-dark px-3 mb-2  active ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
            </div>
            <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
            <!-- Navbar Fixed -->
            <div class="mt-3 d-flex">
               <h6 class="mb-0">Navbar Fixed</h6>
               <div class="form-check form-switch ps-0 ms-auto my-auto">
                  <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
               </div>
            </div>
            <hr class="horizontal dark my-3">
            <div class="mt-2 d-flex">
               <h6 class="mb-0">Light / Dark</h6>
               <div class="form-check form-switch ps-0 ms-auto my-auto">
                  <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
               </div>
            </div>
            <hr class="horizontal dark my-sm-4">
            <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard-pro">Free Download</a>
            <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View documentation</a>
            <div class="w-100 text-center">
               <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
               <h6 class="mt-3">Thank you for sharing!</h6>
               <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                  <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
               </a>
               <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                  <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
               </a>
            </div>
            </div>
         </div>
      </div>
      <!--   Core JS Files   -->
      <script>
         var qcEndlineOutputTable = $('#qcEndlineOutputTable').DataTable({
            autoWidth: false,
            processing: true,
            destroy: true,
            info: false,
            searching: false,
            paging: false,
            fixedHeader: false,
            columnDefs: [
               {'className': 'dt-center', 'targets': '_all'}
            ]
         });

         var qc_endline = new WebSocket("ws://localhost:10000/?service=qc_endline");
         // var packing = new WebSocket("ws://localhost:10000/?service=packing");

         qc_endline.onmessage = function(msg){
            // console.log('msg: ', msg);
            var objDataQCEndline = JSON.parse(msg.data);
            // var objDataQCEndline = JSON.parse(msg);
            // console.log('objDataQCEndline: ',objDataQCEndline);

            qcEndlineOutputTable.rows().remove().draw();

            var x = 0, arrLength = objDataQCEndline.length;
            var todayQCEndLineSUM = 0, yesterdayQCEndLineSUM = 0;
            while(x < arrLength){
               if(parseInt(objDataQCEndline[x].today) > 0){
                  todayQCEndLineSUM += parseInt(objDataQCEndline[x].today);
                  yesterdayQCEndLineSUM += parseInt(objDataQCEndline[x].yesterday);

                  qcEndlineOutputTable.row.add([
                     objDataQCEndline[x].orc,
                     objDataQCEndline[x].style,
                     objDataQCEndline[x].qty_order,
                     objDataQCEndline[x].today,
                     objDataQCEndline[x].total,
                     objDataQCEndline[x].bal
                  ]).draw();
               }
               ++x;
            }
            $('#sewingToday').text(todayQCEndLineSUM);
            $('#sewingYesterday').text(yesterdayQCEndLineSUM);
         }

         // packing.onmessage = function(msg){
         //    var objDataPacking = JSON.parse(msg.data);
         //    var x = 0, arrLength = objDataPacking.length;
         //    var todayPackingSUM = 0, yesterdayPackingSUM = 0;
         //    while(x < arrLength){
         //       if(objDataPacking[x].today > 0){
         //          todayPackingSUM += parseInt(objDataPacking[x].today);
         //          yesterdayPackingSUM += parseInt(objDataPacking[x].yesterday);
         //       }
         //       ++x;
         //    }
         //    $('#packingToday').text(todayPackingSUM);
         //    $('#packingYesterday').text(yesterdayPackingSUM);
         // }

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
