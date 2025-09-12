<?php
   require_once 'core/init.php';
   require_once 'view/header.php';
   if( !isset($_SESSION['username']) ){
      echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
  // header('Location: index.php');    
   }
?>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->


   <style>
      hr {
         display: block;
         margin-top: 0.5em;
         margin-bottom: 0.5em;
         border-style: inset;
         border-width: 1px;
         border-color:blue;
      }
   </style>

   </div>

   <div class="container-fluid">
      <center>
         <h2>.:<strong>LAPORAN W I P</strong>:.</h2>
         <br>
      </center>
      <br>
      <div class="row">
         <div class="col-md-2">
            <div class="form-group">
               <label>Pilih WIP Grup</label>
               <select name="selectWIPGroup" id="selectWIPGroup" class="form-control">
                  <option value="" selected>--Silahkan pilih WIP Grup--</option>
                  <option value="groupCutting">Cutting Grup</option>
                  <option value="groupSewing">Sewing Grup</option>
               </select>
            </div>
         </div>
         <div class="col-md-1">
            <button class="btn btn-success" id="btnTampilkan" disabled>
               <span class="glyphicon glyphicon-print">
               </span>
               &nbsp;Tampilkan
            </button>
         </div>
         <div class="col-md-1">
            <button class="btn btn-warning" id="btnExportToExcel" disabled>
               <span class="glyphicon glyphicon-excel">
               </span>
               &nbsp;Export To Excel
            </button>
         </div>
      </div>
   
      <div class="row">
         <div class="col-md-12">
            <div class="table-container">
               <table id="tableSewingGroup" class="table table-bordered" width="100%" cellpadding="6">
                  <thead>
                     <tr>
                        <th rowspan="2" style="background-color: #f4f4f4"><center>Style</center></th>
                        <th rowspan="2" style="background-color: #f4f4f4"><center>ORC</center></th>
                        <th rowspan="2" style="background-color: #f4f4f4"><center>Size</center></th>
                        <th rowspan="2" style="background-color: #f4f4f4"><center>Qty</center></th>
                        <th colspan="2" style="background-color: #f4f4f4"><center>IN Sewing</center></th>
                        <th colspan="2" style="background-color: #f4f4f4"><center>Qc Line</center></th>
                        <th colspan="2" style="background-color: #f4f4f4"><center>Packing</center></th>
                     </tr>
                     <tr>
                        <th style="background-color: #f4f4f4"><center>Total</center></th>
                        <th style="background-color: #f4f4f4"><center>WIP</center></th>
                        <th style="background-color: #f4f4f4"><center>Total</center></th>
                        <th style="background-color: #f4f4f4"><center>WIP</center></th>
                        <th style="background-color: #f4f4f4"><center>Total</center></th>
                        <th style="background-color: #f4f4f4"><center>WIP</center></th>
                     </tr>
                  </thead>
               </table>

            </div>
         </div>
      </div>

   </div>


   <script>
      $(document).ready(function(){

         var selectedWIPGroupVal="";
         var tableSewingGroup = $('#tableSewingGroup').DataTable({
            destroy: true,
         });
   
         $('#selectWIPGroup').change(function(){
            selectedWIPGroupVal = $(this).val();
   
            $('#btnTampilkan').prop('disabled', selectedWIPGroupVal == "");
         });
   
         $('#btnTampilkan').click(function(){
            switch(selectedWIPGroupVal){
               case "groupSewing":
                  loadWIPSewingGroup();
                  break;
               case "groupCutting":
                  lodWIPCuttingGroup();
            }
         });
   
         function loadWIPSewingGroup(){
            $.when(fetchTrimstoreQtySize(), fetchSewingQtySize(), fetchQCQtySize(), fetchPackingQtySize()).done(function(rstTrimstore, rstSewing, rstQc, rstPacking){
               // console.log('rstTrimstore', rstTrimstore);
               // console.log('rstSewing', rstSewing);
               // console.log('rstQc', rstQc);
               // console.log('rstPacking', rstPacking);
               showWIPSewingGroup(rstTrimstore[0], rstSewing[0], rstQc[0], rstPacking[0]);
                
            });
         }
   
         function fetchTrimstoreQtySize(){
            try{
               var respTrimstore = $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  dataType: 'JSON',
                  data: {
                     'action': 'ajax_getTrimstoreQtySize'
                  }
               });
               return respTrimstore;
            }catch(err){
               throw err;
            }
         }
   
         function fetchSewingQtySize(){
            try{
               var respSewing = $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  dataType: 'JSON',
                  data: {
                     'action': 'ajax_getSewingQtySize'
                  }
               });
               return respSewing;
            }catch(err){
               throw err;
            }
         }
   
         function fetchQCQtySize(){
            try{
               var respQc = $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  dataType: 'JSON',
                  data: {
                     'action': 'ajax_getQcEndlineQtySize'
                  }
               });
               return respQc;
            }catch(err){
               throw err;
            }         
         }
   
         function fetchPackingQtySize(){
            try{
               var respPacking = $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  dataType: 'JSON',
                  data: {
                     'action': 'ajax_getPackingQtySize'
                  }
               });
               return respPacking;
            }catch(err){
               throw err;
            }         
         }
   
         function showWIPSewingGroup(rTrimstore, rSewing, rQC, rPacking){
            // var dt = '';
            tableSewingGroup.clear().draw();
         
            const arrWIPCombined = rTrimstore.map(function(trimstore, i) {
               const sewingPreference = rSewing.find((sewingPref) => sewingPref.orc == trimstore.orc && sewingPref.size == trimstore.size);
               // console.log('sewingPreference: ', sewingPreference);

               const qcPreference = rQC.find((qcPref) => qcPref.orc == trimstore.orc && qcPref.size == trimstore.size);

               const packingPreference = rPacking.find((packingPref) => packingPref.orc == trimstore.orc && packingPref.size == trimstore.size);

               return {
                  style: trimstore.style,
                  orc: trimstore.orc,
                  size: trimstore.size,
                  qty: trimstore.sum_qty_trimstore,
                  sum_qty_sewing: sewingPreference == undefined ? "-" : sewingPreference.sum_qty_sewing,

                  wip_sewing: sewingPreference == undefined ? "-" : parseInt(trimstore.sum_qty_trimstore) - parseInt(sewingPreference.sum_qty_sewing),

                  sum_qty_qc_endline: qcPreference == undefined ? "-" : qcPreference.sum_qty_qc_endline,

                  wip_qc_endline: qcPreference == undefined ? "-" : parseInt(sewingPreference.sum_qty_sewing) - parseInt(qcPreference.sum_qty_qc_endline),

                  sum_qty_packing: packingPreference == undefined ? "-" : packingPreference.sum_qty_tatami,
                  wip_packing: packingPreference == undefined ? "-" : parseInt(qcPreference.sum_qty_qc_endline) - parseInt(packingPreference.sum_qty_tatami)
               }
            });
            
            $.each(arrWIPCombined, function(i, item){
               tableSewingGroup.row.add([
                  item.style,
                  item.orc,
                  item.size,
                  item.qty,
                  item.sum_qty_sewing,
                  item.wip_sewing,
                  item.sum_qty_qc_endline,
                  item.wip_qc_endline,
                  item.sum_qty_packing,
                  item.wip_packing
               ]).draw();   
            });
         }
      });
   </script>

   </body>
</html>
