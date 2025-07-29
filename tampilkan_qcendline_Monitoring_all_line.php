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
      <script>
         var textTitle = $('#textTitle').text();
         var lines = [];
         // var line = '';
         $(document).ready(function(){
            initOutputLines();

            function initOutputLines(){
               $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  data: {action: 'ajax_getAllQcEndlineOutputToday'},
                  dataType: 'JSON'
               }).done(function(response){
                  loadInitOutputLines(response);
                  
               });
            }
   
            function loadInitOutputLines(resp){
               const summedByLine = resp.reduce((acc, curr) => {
                  const found = acc.find(val => val.line === curr.line);
                  if(found){
                     found.qty += parseInt(curr.qty);
                  }else{
                     acc.push({...curr, qty: parseInt(curr.qty)});
                  }
                  return acc;
               }, []);
   
               $.each(summedByLine, function(i, item){
                  let idOutputLine = item.line.replace(" ","");
                  lines.push(idOutputLine);
                  $('#cardContainer').append(
                        `<div class="col-xl-2 col-sm-6 mb-4" id="${item.line}">
                              <div class="card shadow">
                                 <div class="card-header p-2 ps-3 bg-gradient-dark">
                                 <div class="d-flex justify-content-between">
                                    <div>
                                       <p class="text-sm mb-0 text-capitalize text-white">Sewing Today</p>
                                       <h4 class="mb-0 text-white" id="output-${idOutputLine}">${item.qty}</h4>
                                    </div>
                                    <div class="icon icon-md icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-lg">
                                       <i class="material-symbols-rounded opacity-10">person</i>
                                    </div>
                                 </div>
                                 </div>
                                 <hr class="dark horizontal my-0">
                                 <div class="card-footer p-2 ps-3">
                                 <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">${item.line}</span></p>
                                 </div>
                              </div>
                           </div>`
                  );
                  // $(`#${item.line}:hidden`).first().fadeIn('slow');
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
                     // console.log('item: ', item);
                     newQTY += parseInt(item.today);
                  });
                  console.log('line2:', line);
                  $(`#output-${line}`).text(newQTY);
               }else{
                  AddOutputLine(line, objDataQCEndlineOnMessage.dataOutput[0].today);
               }
   
               // $('#cardContainer').append(template)
            }
            
            function AddOutputLine(ln,output){
               $('#cardContainer').append(
                  `<div class="col-xl-2 col-sm-6 mb-xl-0 mb-4" id="${ln}">
                        <div class="card shadow">
                           <div class="card-header p-2 ps-3 bg-gradient-dark">
                           <div class="d-flex justify-content-between">
                              <div>
                                 <p class="text-sm mb-0 text-capitalize text-white">Sewing Today</p>
                                 <h4 class="mb-0 text-white" id="output-${ln}">${output}</h4>
                              </div>
                              <div class="icon icon-md icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-lg">
                                 <i class="material-symbols-rounded opacity-10">person</i>
                              </div>
                           </div>
                           </div>
                           <hr class="dark horizontal my-0">
                           <div class="card-footer p-2 ps-3">
                           <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">${ln}</span></p>
                           </div>
                        </div>
                     </div>`
               );
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
