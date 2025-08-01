<?php
   require_once 'core/init.php';
   require_once 'view/header_dashboard.php';
?>

<html>
   <head>
      <style>
         body{
            overflow: hidden;
         }

         .hideUpdate{
            display: none;
         }
         .showUpdate{
            display: block;
         }

         .hideNew{
            display: none;
         }
         .showNew{
            display: block;
         }

         @keyframes bounce {
         0%, 100% {
            transform: translateY(0);
         }
         50% {
            transform: translateY(-20px); /* Adjust for desired bounce height */
         }
         }

         .bouncing-animation {
         animation: bounce 0.6s ease-in-out; /* Adjust duration and easing */
         }         
      </style>
   </head>
   <body class="g-sidenav-show" onload="showTime()">
      <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
         <div class="container-fluid py-2">
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

            <div class="row mb-1 px-1">
               <h3 class="mb-0 h4 font-weight-bolder" id="textTitle">Sewing Screen Output Result All Line</h3>
               <p class="mb-4">
                  (Menampilkan Hasil Output Sewing Semua Line).
               </p>
            </div>

            <div class="row" id="cardContainer">

               <!-- <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
                  <div class="card shadow">
                     <div class="card-header p-2 ps-3 bg-gradient-dark">
                     <div class="d-flex justify-content-between">
                        <div>
                           <p class="text-sm mb-0 text-capitalize text-white">Sewing Today</p>
                           <h4 class="mb-0 text-white">234</h4>
                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-lg">
                           <i class="material-symbols-rounded opacity-10">person</i>
                        </div>
                     </div>
                     </div>
                     <hr class="dark horizontal my-0">
                     <div class="card-footer p-2 ps-3">
                     <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">Line </span>11B</p>
                     </div>
                  </div>
               </div>                -->
            </div>
         </div>

      </main>
      <script src="assets/Chart.js"></script>
      <script>
         var textTitle = $('#textTitle').text();
         var lines = [];
         $(document).ready(function(){
            initOutputLines();

            function initOutputLines(){
               $.when(fetch_allQCEndlineOutputToday(), fetch_allQCEndlineOutputYesterday()).done(function(rst1, rst2){
                  loadInitOutputLines(rst1[0], rst2[0]);
               });
            }
            
            function fetch_allQCEndlineOutputToday(){
               try{
                  var response1 = $.ajax({
                     type: 'GET',
                     url: 'functions/ajax_functions_handler.php',
                     data: {action: 'ajax_getAllQcEndlineOutputToday'},
                     dataType: 'JSON'
                  });
                  return response1;
               }catch(err){
                  throw err;
               }
            }

            function fetch_allQCEndlineOutputYesterday(){
               try{
                  var response2 = $.ajax({
                     type: 'GET',
                     url: 'functions/ajax_functions_handler.php',
                     data: {action: 'ajax_getAllQcEndlineOutputYesterday'},
                     dataType: 'JSON'
                  });
                  return response2;
               }catch(err){
                  throw err;
               }
            }
   
            function loadInitOutputLines(resp1, resp2){
               const summedByLineToday = resp1.reduce((acc1, curr1) => {
                  const found1 = acc1.find(val1 => val1.line === curr1.line);
                  if(found1){
                     found1.qty += parseInt(curr1.qty);
                  }else{
                     acc1.push({...curr1, qty: parseInt(curr1.qty)});
                  }
                  return acc1;
               }, []);

               const summedByLineYesterday = resp2.reduce((acc2, curr2) => {
                  const found2 = acc2.find(val2 => val2.line === curr2.line);
                  if(found2){
                     found2.qty += parseInt(curr2.qty);
                  }else{
                     acc2.push({...curr2, qty: parseInt(curr2.qty)});
                  }
                  return acc2;
               }, []);
               
               $.each(summedByLineToday, function(i, itoday){
                  $.each(summedByLineYesterday, function(x, iyesterday){
                     if(itoday.line == iyesterday.line){
                        let idOutputLine = itoday.line.replace(" ","");
                        lines.push(idOutputLine);
                        $('#cardContainer').append(
                           `<div class="col-xl-2 col-sm-6 mb-4" id="${idOutputLine}">
                                 <div class="card shadow">
                                    <div class="card-header p-2 ps-3 bg-gradient-dark">
                                       <div class="d-flex justify-content-between">
                                          <div>
                                             <p class="text-sm mb-0 text-white">Target</p>
                                             <h4 class="mb-0 text-white text-center" id="target-${idOutputLine}">0</h4>
                                          </div>
                                          <div>
                                             <p class="text-sm mb-0 text-capitalize text-warning">Today</p>
                                             <h4 class="mb-0 text-warning text-center" id="output-today-${idOutputLine}"><strong>${itoday.qty}</strong></h4>
                                          </div>
                                          <div>
                                             <p class="text-sm mb-0 text-white">Yesterday</p>
                                             <h4 class="mb-0 text-white text-center" id="output-yesterday-${idOutputLine}">${iyesterday.qty}</h4>
                                          </div>
                                          <div class="icon icon-sm icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-lg">
                                          <i class="material-symbols-rounded opacity-10">person</i>
                                          </div>
                                       </div>
                                    </div>
                                    <hr class="dark horizontal my-0">
                                    <div class="card-footer p-2 ps-3">
                                       <div class="row">
                                          <div class="col-sm-6">
                                             <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">${itoday.line}</span></p>
                                          </div>
                                          <div class="col-sm-6">
                                             <span class="badge bg-warning hideUpdate" id="updated-${idOutputLine}">Updated</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>`
                        );

                     }
                  })

                  // let ctxToday =document.getElementById(`chart-today-${idOutputLine}`).getContext("2d");
                  // let dataToday={
                  //    labels: [''],
                  //    datasets: [{
                  //       label: '',
                  //       data: [item.qty],

                  //       backgroundColor: ['rgba(255, 99, 132, 0.2)']
                  //    }]
                  // };
                  // let barOutputToday = new Chart(ctxToday, {
                  //    type: 'bar',
                  //    data: dataToday,
                  //    options: {
                  //       animations: true,
                  //       plugins: {
                  //          legend: {
                  //             display: false
                  //          },
                  //          tooltip: {
                  //             enabled: false
                  //          }
                  //       },
                  //       scales: {
                  //          xAxes:[
                  //             {
                  //                gridLines: {
                  //                   display: false
                  //                }
                  //             }
                  //          ],
                  //          yAxes: [
                  //             {
                  //                min: 0,
                  //                max: 100,
                  //                // gridLines: {
                  //                //    display: false,
                  //                // },
                  //                ticks: {
                  //                   beginAtZero: true,
                  //                }
                  //             }
                  //          ]
                  //       }
                  //    }
                  // });

               });

            }
   
            var qc_endline = new WebSocket("ws://192.168.90.100:10000/?service=qc_endline");         
   
            // var qc_endline = new WebSocket("ws://localhost:10000/?service=qc_endline");
           
            qc_endline.onmessage = function(msg){
               var objDataQCEndlineOnMessage = JSON.parse(msg.data);
               // console.log('objDataQCEndlineOnMessage', objDataQCEndlineOnMessage);
   
               // console.log('lines: ', lines);
               var line = objDataQCEndlineOnMessage.dataOutput[0].line.replace(" ", "");
               
               let found = lines.find(o => o === line);
               if(found != undefined){
                  let newQTY = 0;
                  $.each(objDataQCEndlineOnMessage.dataOutput, function(i, item){
                     newQTY += parseInt(item.today);
                  });
                  $(`#output-today-${line}`).text(newQTY);
                  $(`#output-today-${line}`).addClass('bouncing-animation');
                  setTimeout(() => {
                     $(`#output-today-${line}`).removeClass('bouncing-animation');
                  }, 1000);
                  $(`#updated-${line}`).removeClass('hideUpdate');
                  $(`#updated-${line}`).addClass('showUpdate');
                  $(`#updated-${line}`).fadeOut(5*60*1000, function(){
                     $(`#updated-${line}`).removeClass('showUpdate');
                     $(`#updated-${line}`).addClass('hideUpdate');
                  });

               }else{
                  AddOutputLine(line, objDataQCEndlineOnMessage.dataOutput[0].today);
               }
   
               // $('#cardContainer').append(template)
            }
            
            function AddOutputLine(ln,output){
               var realLine = ln.slice(0,4) + " " + ln.slice(4);
               console.log('realLine: ', realLine);

               $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  data: {
                     action: 'ajax_getQCEndlinePerLineYesterday',
                     param: {
                        'line': realLine
                     }
                  },
                  dataType: 'JSON'
               }).done(function(result){
                  console.log('result: ', result);
                  var qtyYesterday = 0;
                  
                  if(result.length > 0){
                     const summedByLineYesterday1 = result.reduce((a, c) => {
                        const f = a.find(v => v.line === c.line);
                        if(f){
                           f.qty += parseInt(c.qty);
                        }else{
                           a.push({...c, qty: parseInt(c.qty)});
                        }
                        return a;
                     }, []);

                     qtyYesterday = summedByLineYesterday1[0].qty;
   
                     console.log('summedByLineYesterday1: ', summedByLineYesterday1);
                     lines.push(ln);
                  }
                  $('#cardContainer').append(
                     `<div class="col-xl-2 col-sm-6 mb-4" id="${ln}">
                           <div class="card shadow">
                              <div class="card-header p-2 ps-3 bg-gradient-dark">
                                 <div class="d-flex justify-content-between">
                                    <div>
                                       <p class="text-sm mb-0 text-white">Target</p>
                                       <h4 class="mb-0 text-white text-center" id="target-${ln}">0</h4>
                                    </div>
                                    <div>
                                       <p class="text-sm mb-0 text-capitalize text-warning">Today</p>
                                       <h4 class="mb-0 text-warning text-center" id="output-today-${ln}"><strong>${output}</strong></h4>
                                    </div>
                                    <div>
                                       <p class="text-sm mb-0 text-white">Yesterday</p>
                                       <h4 class="mb-0 text-white text-center" id="output-yesterday-${ln}">${qtyYesterday}</h4>
                                    </div>
                                    <div class="icon icon-sm icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">person</i>
                                    </div>
                                 </div>
                              </div>
                              <hr class="dark horizontal my-0">
                              <div class="card-footer p-2 ps-3">
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">${realLine}</span></p>
                                    </div>
                                    <div class="col-sm-6">
                                       <span class="badge bg-danger hideNew" id="updated-${ln}">New</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>`
                  );
                  
                  $(`#${ln}`).addClass('bouncing-animation');
                  setTimeout(() => {
                     $(`#${ln}`).removeClass('bouncing-animation');
                  }, 1000);

                  $(`#updated-${ln}`).removeClass('hideNew');

                  $(`#updated-${ln}`).addClass('showNew');

                  $(`#updated-${ln}`).fadeOut(5*60*1000, function(){
                     $(`#updated-${ln}`).removeClass('showNew');
                     $(`#updated-${ln}`).addClass('hideUpdate');
                  });
                  // $(`#updated-${line}`).addClass('showUpdate');
               });

            }
         });

         function showTime(){
            const date = new Date();
            let h = date.getHours();
            let m = date.getMinutes();
            let s = date.getSeconds();

            h = (h < 10) ? h = "0" + h : h;
            m = (m < 10) ? m = "0" + m : m;
            s = (s < 10) ? s = "0" + s : s;

            let time = h + ":" + m + ":" + s;
            $('#textTitle').text(textTitle + " - <?=date('d/m/Y'); ?> " + "(" + time + ")");
            setTimeout(showTime, 1000);            
         }
      </script>
   </body>
</html>
