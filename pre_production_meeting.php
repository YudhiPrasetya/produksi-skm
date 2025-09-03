<?php
   ob_start();

   require_once 'core/init.php';
   // require_once 'view/header.php';

   if(isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      $level = cek_status($_SESSION['username']);
      if($level == 'admin' || $level == 'ppic'){
?>

  <script src="/produksi-skm/assets/js/jquery.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
  <script type="text/javascript" src="/produksi-skm/assets/DataTables/js/jquery.js"></script>
  <script type="text/javascript" src="/produksi-skm/assets/js/bootstrap.js"></script>
  <script type="text/javascript" src="/produksi-skm/assets/DataTables/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="/produksi-skm/assets/popper.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/produksi-skm/assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/produksi-skm/assets/DataTables/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="/produksi-skm/assets/DataTables/css/dataTables.bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/produksi-skm/assets/DataTables/css/select2.min.css" />

  <!-- jika menggunakan bootstrap4 gunakan css ini  -->
  <link rel="stylesheet" href="/produksi-skm/assets/css/select2-bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="/produksi-skm/assets/FixedColumns/css/fixedColumns.dataTables.min.css">
  <script type="text/javascript" src="/produksi-skm/assets/FixedColumns/js/dataTables.fixedColumns.min.js"></script>
  <!-- <link rel="stylesheet" type="text/css" href="assets/row-reorder/css/rowReorder.dataTables.min.css">
<script type="text/javascript" src="assets/row-reorder/js/dataTables.rowReorder.min.js"></script> -->
  <link rel="stylesheet" type="text/css" href="/produksi-skm/assets/FixedHeader/css/fixedHeader.dataTables.min.css">
  <script type="text/javascript" src="/produksi-skm/assets/FixedHeader/js/dataTables.fixedHeader.min.js"></script>

  <!-- <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.min.css" /> -->
  <script src="/produksi-skm/assets/sweetalert2/sweetalert2.all.min.js"></script>
  <!-- <script src="assets/sweetalert2/sweetalert2.all.min.js"></script> -->

  <!-- cdn bootstrap4 -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
            integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> -->

  <!-- <link rel="stylesheet" href="view/nav_style.css"> -->
  <link rel="stylesheet" href="/produksi-skm/view/style.css">
  <!-- <link rel="icon" href="img/skm_icon.png"> -->
  <!-- <link rel="icon" href="img/gi-logo-removebg.png"> -->
  <link rel="icon" href="img/icon.PNG">

  <link rel="stylesheet" href="/produksi-skm/assets/Datatables2/css/cdn.datatables.net_1.13.5_css_jquery.dataTables.min.css">
  <link rel="stylesheet" href="/produksi-skm/assets/Datatables2/css/cdn.datatables.net_buttons_2.4.1_css_buttons.dataTables.min.css">
  <link rel="stylesheet" href="/produksi-skm/assets/Datatables2/css/cdn.datatables.net_select_1.7.0_css_select.dataTables.min.css">

  <!-- <script src="assets/Datatables2/js/code.jquery.com_jquery-3.7.0.js"></script> -->
  <script src="/produksi-skm/assets/Datatables2/js/cdn.datatables.net_1.13.5_js_jquery.dataTables.min.js"></script>

  <script src="/produksi-skm/assets/Datatables2/js/cdn.datatables.net_buttons_2.4.1_js_dataTables.buttons.min.js"></script>

  <script src="/produksi-skm/assets/Datatables2/js/cdnjs.cloudflare.com_ajax_libs_jszip_3.10.1_jszip.min.js"></script>
  <script src="/produksi-skm/assets/Datatables2/js/cdnjs.cloudflare.com_ajax_libs_pdfmake_0.1.53_pdfmake.min.js"></script>
  <script src="/produksi-skm/assets/Datatables2/js/cdnjs.cloudflare.com_ajax_libs_pdfmake_0.1.53_vfs_fonts.js"></script>
  <!--<script src="assets/Datatables2/js/cdn.datatables.net_buttons_2.4.1_js_buttons.html5.min.js"></script>-->
  <script src="/produksi-skm/assets/Datatables2/js/cdn.datatables.net_buttons_2.4.1_js_buttons.html5.js"></script>
  <script src="/produksi-skm/assets/Datatables2/js/cdn.datatables.net_buttons_2.4.1_js_buttons.print.min.js"></script>
  <script src="/produksi-skm/assets/Datatables2/js/cdn.datatables.net_select_1.7.0_js_dataTables.select.min.js"></script>
         
<style>
   .redShadowColor{
      box-shadow: 0 0 10px rgba(255, 0, 0, 0.5)
   }   
   .grayShadowColor{
      box-shadow: 0 0 10px rgba(60, 60,60 , 0.5)
   }
   th, td {
      white-space: nowrap;
   }
   .disabled-table{
      opacity: 0.6;
      pointer-events: none;
   }
    .swal2-modal {
      width: 40%;
    }

    .swal2-popup {
      padding: 3em;
    }

    .swal2-icon-text {
      font-size: 5em;
    }

    .swal2-icon {
      width: 5em;
      height: 5em;
    }

    .swal2-icon {
      line-height: 5em;
      font-size: 1.3em;
    }

    .swal2-popup .swal2-title {
      font-size: 2.5em;
    }

    .swal2-popup .swal2-content {
      font-size: 1.5em;
    }

    .swal2-popup .swal2-styled.swal2-confirm {
      font-size: 1.5em;
    }

    .swal2-popup .swal2-styled.swal2-cancel {
      font-size: 1.5em;
    }

    .nav-link:after {
      content: "|";
      position: absolute;
      color: white;
      top: 15px;
      margin-left: -5px;

    }
    td ul {
        padding-left: 20px;
    }                
    td ol {
        padding-left: 20px;
    }                
</style>

<link rel="stylesheet" href="assets/css/summernote.min.css" />

</div>

<nav>
   <ul style="background: #254681">
      <li style="float:right; background:#254681 ;"><a href="logout.php">LOG OUT</a></li>   
   </ul>
</nav>

<div class="container-fluid">
   <div class="panel panel-default redShadowColor" style="margin: 10px 10px 10px 10px">
      <div class="panel-heading">
         <h3 class="text-center" style="margin-top: 10px;"><strong>PRE PRODUCTION SCHEDULE MEETING</strong></h3>
      </div>
      <div class="panel-body">
         <div class="form-group">
            <div class="btn-group" style="margin-right: 25px;">
               <button type="button" class="btn btn-warning btn-lg" id="btnTableView">
                  <span class="glyphicon glyphicon-list-alt"></span>
               </button>

               <button type="button" class="btn btn-warning btn-lg" id="btnCardView" disabled>
                  <span class="glyphicon glyphicon-file"></span>
               </button>

               <button type="button" class="btn btn-warning btn-lg" id="btnRefresh" disabled>
                  <span class="glyphicon glyphicon-refresh"></span>
               </button>                  
            </div>
            
            <button type="button" class="btn btn-success btn-lg" id="btnAdd">
               <span class="glyphicon glyphicon-plus"></span>
            </button>


         </div>

         <!-- <div class="row"> -->
         <div id="viewContainer">
            <table class="table table-hover nowrap compact" id="tablePPMSchedule" width="100%">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>No</th>
                     <th>Description</th>
                     <th>Meeting Date</th>
                     <th>Place</th>
                     <th>Item Meeting(style)</th>
                     <th>Total QTY Order</th>
                     <th>Status</th>
                     <th>Attendees</th>
                     <th>meetingStyle</th>
                  </tr>
               </thead>
            </table>
         </div>
         <hr />
         <!-- </div> -->



         <div class="center-block" style="width: 800px;">
            <div class="panel panel-default grayShadowColor" id="addForm" style="display: none;">
               <div class="panel-heading bg-info">
                  
                  <h3 class="text-center" style="margin-top: 10px;">
                     <strong>Pre Production Schedule Meeting</strong>
                     <span class="badge label label-success" id="badgeMode"></span>
                  </h3>
               </div>
               <div class="panel-body">
                  <form id="frmAddNew">
                     <div class="col-md-6">
                        <div class="form-group">
                           <input type="hidden" id="idSchedule" />
                           <label for="meetingDate" style="margin-bottom: 0px;">Tanggal Meeting</label>
                           <input type="datetime-local" class="form-control" id="meetingDate" name="meetingDate" />
                        </div>
                        <div class="form-group">
                           <label for="place" style="margin-bottom: 0px;">Tempat</label>
                           <select name="place" id="place" class="form-control">
                              <option value="">--Silahkan pilih tempat meeting--</option>
                              <option value="Globalindo 1">Globalindo 1 (Jombor)</option>
                              <option value="Globalindo 2">Globalindo 2 (Mlese)</option>
                           </select>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                           <label for="style" style="margin-bottom: 0px;">Style</label>
                           <select name="style" id="style" class="form-control select2" width="100%">
                              <option value=''>--Silahkan pilih style--</option>
                           </select>
                        </div>
                        <div class="panel panel-info" id="detail">
                           <div class="panel-body" id="bodyDetail">
                              <table id="tableDetail" class="table table-striped">
                                 <thead>
                                    <tr>
                                       <th>ORC</th>
                                       <th>QTY</th>
                                    </tr>
                                 </thead>
                                 <tfoot>
                                    <tr>
                                       <th>Total</th>
                                       <th></th>                                          
                                    </tr>
                                 </tfoot>
                              </table>
                           </div>
                        </div>                           
                     </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="deptAttendees" style="margin-bottom: 0px;">Level yg diundang</label>
                           <select name="deptAttendees" id="deptAttendees" class="form-control select2" width="100%">
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="description" style="margin-bottom: 0px;">Deskripsi</label>
                           <textarea name="description" id="description" class="form-control" rows="4" cols="5"></textarea>
                        </div>

                     </div>
                  </form>
               </div>
               <div class="panel-footer">
                  <button type="button" style="margin-top: 0px; margin-right: 10px;" id="btnSaveSchedule" class="btn btn-success btn-lg" disabled>
                     <span class="glyphicon glyphicon-plus-sign"></span> Save
                  </button>

                  <button type="button" style="margin-top: 0px;" id="btnCancel" class="btn btn-default btn-lg" disabled>
                     <span class="glyphicon glyphicon-ban-circle"></span> Cancel
                  </button>

                  <button id="btnExit" type="button" style="margin-top: 0px;" class="btn btn-default btn-lg pull-right">
                     <span class="glyphicon glyphicon-log-out"></span> Exit
                  </button>
               </div>
            </div>
         </div>

         <div class="startMeeting center-block" style="width: 200px; display: none">
            <h4 class="text-center" id="jam"></h4>
         </div>

         <form id="frmJoinMeeting">
            <div class="col-md-8 startMeeting" style="display: none;">
               <div class="panel-group" id="accStartMeeting" role="tablist">
                  <div class="panel panel-info grayShadowColor" id="joinMeeting">
                     <div class="panel-heading bg-info" role="tab" id="headingOne">
                        <h4 class="panel-title">
                           <a role="button" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              <strong>Joining Pre Production Schedule Meeting</strong>
                           </a>
                        </h4>
                     </div>
                     <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        
                           <div class="panel-body">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label for="user_name" style="margin-bottom: 0px;">User Name:</label>
                                    <input type="text" class="form-control plain-text" id="user_name" name="user_name" disabled />
                                 </div>
                              </div>
      
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label for="level1" style="margin-bottom: 0px;">Level:</label>
                                    <div class="input-group">
                                       <input name="level1" id="level1" class="form-control" disabled />
                                       <span class="input-group-btn">
                                          <button class="btn btn-info" style="margin-top: 0px;" id="btnShowdetailMeeting" disabled><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Show Detail</button>
                                       </span>
                                    </div>
                                 </div>
                              </div>
      
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label for="eff_date" class="form-label">Tanggal Efektif:</label>
                                    <input type="date" id="eff_date" name="eff_date" class="form-control" required />
                                 </div>
                              </div>
                              <hr/>
      
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label style="margin-bottom: 0px;">Catatan:</label> 
                                    <div id="catatan"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="panel-footer">
                              <button type="submit" style="margin-top: 0px; margin-right: 10px;" id="btnSaveNotes" class="btn btn-success btn-lg" disabled>
                                 <span class="glyphicon glyphicon-plus-sign"></span> Save
                              </button>
                           </div>
                        
                     </div>
                  </div>
               </div>
            </div>

            <div class="col-md-4 startMeeting" style="display: none;">
               <div class="panel-group" id="accDaftarHadir" role="tablist">
                  <div class="panel panel-info grayShadowColor" id="daftarHadir">
                     <div class="panel-heading bg-info" role="tab" id="headingTow">
                        <h4 class="panel-title">
                           <a role="button" data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                              <strong>Daftar Hadir</strong>
                           </a>
                        </h4>
                     </div>
                     <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTow">
                        <div class="panel-body">
                           <table class="table table-striped table-hover" id="tableDaftarHadir">
                              <thead>
                                 <tr>
                                    <th>No</th>
                                    <th>Departemen(level)</th>
                                    <th>Join</th>
                                 </tr>
                              </thead>
                           </table>
                        </div>
                        <div class="panel-footer">

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </dv>
</div>

<div id="printPreviewArea1" style="display: none;">

   <div class="btn-group" style="margin-bottom: 25px;">
      <button class="btn btn-default" id="btnExportToExcel1" style="margin-bottom: 20px;">
         <span class="glyphicon glyphicon-print"></span>&nbsp;Export To Excel
      </button>

      <button type="button" class="btn btn-default" id="btnExitPrintPreview1">
         <span class="glyphicon glyphicon-log-out"></span>&nbsp;Exit Print Preview
      </button>

   </div>
   <div id="printPreviewContainer1" style="margin-bottom: 20px;">
      <center>
         <h1 style="margin-bottom: 5px;">PT. Globalindo Intimates</h1>
         <h3 style="margin-top: 5px;">Laporan Hasil Pre Production Meeting</h3>
      </center>
      <table id="tablePPMResultHeader" style="margin-bottom: 20px;" width="100%" cellpadding="3" cellspacing="0">
      </table>
      
      <table id="tablePPMResultContent" border="1" width="100%" cellpadding="3" cellspacing="0">
      </table>
   
   </div>
</div>

<div id="printPreviewArea2" style="display: none;">
   <div class="btn-group" style="margin-bottom: 25px;">
      <button class="btn btn-default" id="btnExportToExcel2" style="margin-bottom: 20px;">
         <span class="glyphicon glyphicon-print"></span>&nbsp;Export To Excel
      </button>

      <button type="button" class="btn btn-default" id="btnExitPrintPreview2">
         <span class="glyphicon glyphicon-log-out"></span>&nbsp;Exit Print Preview
      </button>

   </div>  
   
   <div id="printPreviewContainer2" style="margin-bottom: 20px;">
      <center>
         <h1 style="margin-bottom: 5px;">PT. Globalindo Intimates</h1>
         <h3 style="margin-top: 5px;">Laporan Daftar Hadir PPM</h3>
      </center>
      <div class="row">
      <div class="col-xs-12">
         <div class="center-block" style="width: 500px;">
            <table class="table" id="tableYangHadir" width="100%" border="1">
            </table>
         </div>
      </div>
   </div>
   </div>
</div>



<script src="assets/js/select2.min.js"></script>
<script src="assets/js/summernote/summernote.min.js"></script>

<!-- <script src="assets/js/tableToExcel.js"> </script> -->

<!-- <script src="assets/js/tableExport/Blob.min.js"></script> -->
<!-- <script src="assets/js/tableExport/xlsx.core.min.js"></script>
<script src="assets/js/tableExport/FileSaver.min.js"></script>
<script src="assets/js/tableExport/tableexport.min.js"></script> -->

<script src="assets/js/tableExport/tableExport.js"></script>
<script src="assets/js/tableExport/jquery.base64.js"></script>

<!-- <script src="assets/js/xlsx.full.min.js"></script> -->
 <script src="assets/js/tableExport/jquery.table2excel.js"></script>

<script>
   $(document).ready(function(){
      var userName = '<?= $username; ?>'
      var level = '<?= $level; ?>'
      var arrDeptAttendees = [];
      var totalQTYOrder = 0;
      var arrData = [];
      var idMeeting = '';
      var idMeetingNote = '';
      var mode = '';

      // var ppmToClient_ws = new WebSocket("ws://192.168.90.100:10000/?service=ppm_running");

      var tablePPMSchedule = $('#tablePPMSchedule').DataTable({
         responsive: true,
         destroy: true,
         columnDefs: [
            {
               'targets': [0,8,9],
               'visible': false
            },
         ]         
      });

      var tableDaftarHadir = $('#tableDaftarHadir').DataTable({
         responsive: true,
         destroy: true,
         paging: false,
         searching: false
      });

      var tableDetail = $('#tableDetail').DataTable({
         responsive: true,
         destroy: true,
         paging: false,
         searching: false,
         "footerCallback": function(row, data, start, end, display) {
            var api = this.api();

            var totalAmount = api
               .column(1, { page: 'current' }) 
               .data()
               .reduce(function(a, b) {
                  return parseInt(a) + parseInt(b);
               }, 0);

            $(api.column(1).footer()).html(totalAmount); // Format as needed
         }         
      });

      var catatan = $('#catatan').summernote({
         toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen']],
         ],
         height: 200,
         tableClassName: function(){
            $(this).addClass('table table-bordered')
               .attr('cellpadding', 12)
               .attr('cellspacing', 0)
               .attr('border', 1)
               .css('borderCollapse', 'collapse');

               $(this).find('td')
                  .css('borderColor', '#ccc')
                  .css('padding', '15px');

         },
         callbacks: {
            onImageUpload: function(files){
               var formData = new FormData();
               formData.append('file', files[0]);
               $.ajax({
                  url: 'upload_image_ppm.php', // Server-side script for image upload
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false,
                  type: 'POST',
                  success: function(imageUrl) {
                     $('#catatan').summernote('insertImage', imageUrl);
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                     console.error('Image upload failed:', textStatus, errorThrown);
                  }
               });               
            }
         }
      });

      // var ppmToClient_ws = new WebSocket("ws://192.168.90.100:10000/?service=ppm");
      var ppm_running_ws = new WebSocket("ws://192.168.90.100:10000/?service=ppm");

      initializeData();
      function initializeData(){
         $.when(loadStyles(), loadLevels()).done(function(rstStyles, rstLevels){

            // initTampilkanData(arrData);

            $('#style').select2({
               width: "100%"
            });
            $.each(rstStyles[0], function(i, st){
               let newOption = new Option(st.style, st.id_style, false, false);
               $('#style').append(newOption).trigger('change');
            });

            $('#deptAttendees').select2({
               width: "100%",
               placeholder: $(this).attr('placeholder'),
               multiple: true,
               allowClear: true
            });
            $.each(rstLevels[0], function(z, l){
               let newOption = new Option(l.level, l.level, false, false);
               $('#deptAttendees').append(newOption).trigger('change');               
            });

            // $('#btnCardView').trigger('click');
            $('#btnTableView').trigger('click');
         });
      }
      
      function loadData(){
         try{
            var rData = $.ajax({
               type: 'GET',
               url: 'functions/ajax_functions_handler.php',
               dataType: 'JSON',
               data: {
                  'action': 'ajax_getMeetingSchedules'
               }
            });
            return rData;
         }catch(e){
            throw e;
         }
      }

      function loadStyles(){
         try{
            var rspStyles = $.ajax({
               type: 'GET',
               url: 'functions/ajax_functions_handler.php',
               dataType: 'JSON',
               data: {
                  'action': 'ajax_getStylePreProduction'
               }
            });
            return rspStyles;
         }catch(err){
            throw err;
         }
      }

      function loadLevels(){
         try{
            var rspLevels = $.ajax({
               type: 'GET',
               url: 'functions/ajax_functions_handler.php',
               dataType: 'JSON',
               data : {
                  'action': 'ajax_getAllLevel'
               }
            });
            return rspLevels;
         }catch(err){
            throw err;
         }
      }

      // function initTampilkanData(ds){

      // }

      $('#btnAdd').click(function(){
         mode = 'Add'
         $('#badgeMode').text('Add New')
         $('#addForm').fadeIn(1000);
      });

      $('#btnExit').click(function(){
         clearControls();
         setValidationButtonSaveSchedule();
         $('#addForm').fadeOut(1000);
      });

      $('#meetingDate').change(function(){
         setValidationButtonSaveSchedule();
      });

      $('#place').change(function(){
         setValidationButtonSaveSchedule();
      });

      $('#deptAttendees').change(function(){
         setValidationButtonSaveSchedule();
      });

      function setValidationButtonSaveSchedule(){
         let meetingDate = $('#meetingDate').val();
         let place = $('#place').val();
         let style = $('#style').val();
         let deptAttendees = $('#deptAttendees').val();

         let valid = meetingDate != '' && place != '' && style != '' && deptAttendees != null;
         $('#btnSaveSchedule').prop('disabled', !valid);
         $('#btnCancel').prop('disabled', !valid);
      }

      $('#deptAttendees').change(function(){
         arrDeptAttendees = $('#deptAttendees').select2('data');
      });

      $('#btnSaveSchedule').click(function(){
         switch(mode){
            case "Add":
               AddScheduleMeeting();
               break;
            case "Edit":
               UpdateScheduleMeeting();
               break;
         }
      });
      
      function AddScheduleMeeting(){
         var arrSelectedOptions = [];
         $.each(arrDeptAttendees, function(n, itm){
            arrSelectedOptions.push(itm.text);
         });
   
         let dataPreProdSchedule = {
            'meeting_date': $('#meetingDate').val(),
            'place': $('#place').val(),
            'meeting_style': $('#style').val(),
            'dept_attendees': arrSelectedOptions,
            'description': $('#description').val(),
            'total_qty_order': totalQTYOrder
         };
         $.ajax({
            type: 'POST',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_postPreProductionMeetingSchedule',
               'param': {
                  'dataPreProdSchedule': dataPreProdSchedule
               }
            }
         }).done(function(id){
            if(id){
               Swal.fire({
                  title: 'success',
                  text: 'Data jadwal meeting pre production berhasil di tambahkan',
                  type: 'success',
                  onAfterClose: () => {
                     clearControls();
                     setValidationButtonSaveSchedule();
                     $('#btnTableView').trigger('click');
                  }                  
               })               
            }
         });

      }

      function UpdateScheduleMeeting(){
         var arrOptions = [];
         $.each(arrDeptAttendees, function(n, itm){
            arrOptions.push(itm.text);
         });
   
         let dataPPMSchedule = {
            'id' : $('#idSchedule').val(),
            'meeting_date': $('#meetingDate').val(),
            'place': $('#place').val(),
            'meeting_style': $('#style').val(),
            'dept_attendees': arrOptions,
            'description': $('#description').val(),
            'total_qty_order': totalQTYOrder
         };
         $.ajax({
            type: 'POST',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_updatePPMSchedule',
               'param': {
                  'dataPPMSchedule': dataPPMSchedule
               }
            }
         }).done(function(rsp){
            if(rsp){
               Swal.fire({
                  title: 'success',
                  text: 'Data jadwal meeting pre production berhasil di update',
                  type: 'success',
                  onAfterClose: () => {
                     clearControls();
                     setValidationButtonSaveSchedule();

                     $('#btnTableView').trigger('click');

                     let jsonAttendees = JSON.parse(rsp.dept_attendees);
                     tableDaftarHadir.clear().draw();
                     $.each(jsonAttendees, function(z, itm){
                        tableDaftarHadir.row.add([
                           z+1,
                           itm,
                           (itm == level ? 1 : 0)
                        ]).draw();
                     });                     

                     sendUpdateMeetingMessageToClients(rsp);
                  }                  
               })               
            }
         });         
      }

      $('#btnCancel').click(function(){
         clearControls();
         setValidationButtonSaveSchedule();
      })

      function clearControls(){
         $('#frmAddNew').trigger('reset');
         $('#style').select2().val('');
         $('#deptAttendees').select2().val(null);
         totalQTYOrder = 0;
         tableDetail.clear().draw();
         $('#bodyDetail').css('display', 'none');
      }

      $('#style').change(function(){
         $('#bodyDetail').css('display', 'none');
         let idStyle = $(this).val();
         $.ajax({
            type: 'GET',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_getQtyPreProdByStyle',
               'param': {
                  'idStyle': idStyle
               }
            }
         }).done(function(dataPP){
            if(dataPP.length > 0){
               var html ='';
               totalQTYOrder = 0;
               tableDetail.clear().draw();
               $.each(dataPP, function(i, item){
                  totalQTYOrder += parseInt(item.qty_order);
                  tableDetail.row.add([
                     item.orc,
                     item.qty_order
                  ]).draw();
               });

               $('#bodyDetail').slideDown(1000);
               setValidationButtonSaveSchedule();
            }

         })
      });

      // Data view section

      // Table View
      $('#btnCardView').click(function(){
         var panelHTML = '';
         $.each(arrData, function(x, item){
            // load cards but hide all of it first
            panelHTML += `<div class="col-md-2" id="panel-${item.id}">
               <div class="panel panel-default grayShadowColor">
                  <div class="panel-heading" style="padding: 5px 5px 5px 5px;">
                     <div class="row">
                        <div class="col-xs-6">
                           <p style="margin-bottom: 0px;">${new Date(item.meeting_date).toLocaleDateString("id-ID")}</p>
                        </div>
                        <div class="col-xs-6">
                           <button class="btn btn-warning btn-sm" type="button" style="margin-top: 0px;"><span class="glyphicon glyphicon-pencil"></span></button>
                           <button class="btn btn-danger btn-sm" type="button" style="margin-top: 0px;"><span class="glyphicon glyphicon-trash"></span></button>
                        </div>
                     </div>
                  </div>
                  <div class="panel-body" style="display: flex; height: 100px; min-height: 0; min-height: 100%;">
                     <div style="flex-direction: column;">
                        <p>Tanggal</p>
                        <p>${item.meeting_date}</p>
                     </div>
                  </div>
               </div>
            </div>`;

         });
         $('#viewContainer').append(panelHTML);

         // and then show and animated it

      });

      $('#btnTableView').click(function(){
         arrData = [];
         var rstData = loadData();
         rstData.done(function(data){
            tablePPMSchedule.clear().draw();
            $.each(data, function(i, item){
               let buttonEdit = "";
               let buttonExec = "";

               switch(item.status){
                  case "on hold":
                     buttonEdit = `&nbsp;&nbsp;&nbsp;<button id="btnEdit-${item.id}" class="btn btn-warning btn-sm btnEdit" data-row-id="${item.id}" style="margin-top: 0px;"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</button>`;

                     buttonExec = `&nbsp;&nbsp;&nbsp;<button id="btnStart-${item.id}" class="btn btn-success btn-sm btnStart" data-row-id="${item.id}" style="margin-top: 0px;"><span class="glyphicon glyphicon-play"></span>&nbsp;Start</button>`;
                     break;
                  case "on progress":
                     buttonEdit = `&nbsp;&nbsp;&nbsp;<button id="btnEdit-${item.id}" class="btn btn-warning btn-sm btnEdit" data-row-id="${item.id}" style="margin-top: 0px;"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</button>`;

                     buttonExec = `&nbsp;&nbsp;&nbsp;<button id="btnFinish-${item.id}" class="btn btn-info btn-sm btnFinish" data-row-id="${item.id}" style="margin-top: 0px;"><span class="glyphicon glyphicon-ok"></span>&nbsp;Finish</button>`;
                     
                     break;
                  case "finish":
                     $(`#btnEdit-${item.id}`).remove();
                     buttonExec = `&nbsp;&nbsp;&nbsp;<button id="btnPreview-${item.id}" class="btn btn-info btn-sm btnPreview" data-row-id="${item.id}" style="margin-top: 0px; margin-left: 5px;"><span class="glyphicon glyphicon-print"></span>&nbsp;Preview</button>

                     <button id="btnDaftarHadir-${item.id}" class="btn btn-default btn-sm btnDaftarHadir" data-row-id="${item.id}" style="margin-top: 0px;"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Daftar Hadir</button>`;
                     break;

               }
               // let formattedDate = new Date(item.meeting_date).toLocaleString("id-ID");
               let meetingDate = new Date(item.meeting_date);
               let year = meetingDate.getFullYear();
               let strMonth = (meetingDate.getMonth() + 1).toString().padStart(2, '0');
               let strDay = meetingDate.getDate().toString().padStart(2, '0');
               let strHours = meetingDate.getHours().toString().padStart(2, '0');
               let strMinutes = meetingDate.getMinutes().toString().padStart(2, '0');

               let strMeetingDate = `${strDay}-${strMonth}-${year} ${strHours}:${strMinutes}`;

               tablePPMSchedule.row.add([
                  item.id.trim(),
                  i+1,
                  item.description.trim(),
                  strMeetingDate,
                  item.place.trim(),
                  item.style.trim(),
                  item.total_qty_order.trim(),
                  `<p class="${item.status == 'on hold' ? "text-muted" : "text-danger"}" style="margin-bottom: 0px;"><strong>${item.status}</strong>${buttonEdit} ${buttonExec}</p>`,
                  item.dept_attendees,
                  item.meeting_style
               ]).draw();

               let dSchedule = {
                  'id': item.id,
                  'meeting_date': item.meeting_date,
                  'place': item.place,
                  'meeting_style': item.meeting_style,
                  'dept_attendees': item.dept_attendees,
                  'description': item.description,
                  'total_qty_order': item.total_qty_order,
                  'status': item.status
               }
               arrData.push(dSchedule);
            });
         });

      });

      function formatDateTime(date) {
         const year = date.getFullYear();
         const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is 0-indexed
         const day = String(date.getDate()).padStart(2, '0');
         const hours = String(date.getHours()).padStart(2, '0');
         const minutes = String(date.getMinutes()).padStart(2, '0');
         const seconds = String(date.getSeconds()).padStart(2, '0');

         return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
      }      

      $('#tablePPMSchedule tbody').on('click', '.btnStart', function(){
         Swal.fire({
            title: 'Konfirmasi',
            html: '<h3>Yakin akan memulai meeting?</h3>',
            type: 'question',
            showCancelButton: true
         }).then((result) => {
            if(result.value == true){
               idMeeting = $(this).data('row-id');
               let dateNow = new Date();
               let formattedDate = formatDateTime(dateNow);

               let dataMeeting = {
                  'idSchedule': idMeeting,
                  'user_name': userName,
                  'level': level,
                  'start': formattedDate,
                  'status': 'Joining'
               };

               insertJoiningMeeting(dataMeeting);
               startMeeting(idMeeting);
            }
         });
      });

      $('#tablePPMSchedule tbody').on('click', '.btnPreview', function(){
         idMeeting = $(this).data('row-id');
         printPreview(idMeeting);
      });
      function printPreview(id){
         $.ajax({
            type: 'GET',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_getPPMResult',
               'param': {
                  'id': id
               }
            }
         }).done(function(data){
            var tableHeader = '';
            var tableContent = '';
            $('#tablePPMResultHeader').empty();
            $('#tablePPMResultContent').empty();

            // $.each(data, function(i, itm){
            let arrDateHeader = data[0].effective_date.split('-');
            let dayHeader = arrDateHeader[2];
            let monthHeader = arrDateHeader[1];
            let yearHeader = arrDateHeader[0];
            let strDateHeader = `${dayHeader}-${monthHeader}-${yearHeader}`;

            tableHeader += `
                                 <tr>
                                    <td style="padding-bottom: 5px;" width="8%"><strong>Factory</strong></td>
                                    <td style="padding-bottom: 5px;" width="1%">:</td>
                                    <td style="padding-bottom: 5px;">${data[0].place}</td>
                                 </tr>
                                 <tr>
                                    <td style="padding-bottom: 5px;"><strong>Vendor</strong></td>
                                    <td style="padding-bottom: 5px;">:&nbsp;</td>
                                    <td style="padding-bottom: 5px;">${data[0].vendor}</td>
                                 </tr>
                                 <tr>
                                    <td style="padding-bottom: 5px;"><strong>Style</strong></td>
                                    <td style="padding-bottom: 5px;">:&nbsp;</td>
                                    <td style="padding-bottom: 5px;">${data[0].style}</td>
                                 </tr>
                                 <tr>
                                    <td style="padding-bottom: 5px;"><strong>Effective Date</strong></td>
                                    <td style="padding-bottom: 5px;">:&nbsp;</td>
                                    <td style="padding-bottom: 5px;">${strDateHeader}</td>
                                 </tr>
                              `;
            // });
            $('#tablePPMResultHeader').append(tableHeader);

            $.each(data, function(i, item){
               let note = item.notes.split('"').join('');
               // let newNote = note.replace("images_ppm", "http://localhost/produksi-skm/images_ppm");
               let newNote = note.replace("images_ppm", "http://192.168.90.100/produksi-skm/images_ppm");
               tableContent += `
                                 <tr>
                                    <td style="padding-top: 5px; padding-bottom: 5px; background:rgb(37,70,129); color: white"><center><h4 style="margin-top: 5px; margin-bottom: 5px;">${item.level.toUpperCase()}</h4></center></td>
                                 </tr>
                                 <tr>
                                    <td style="padding: 8px; padding-right: 8px;">${newNote}</td>
                                 </tr>
                               `
            });
            $('#tablePPMResultContent').append(tableContent);
            $('#printPreviewArea2').slideUp(500, function(){
               $('#printPreviewArea1').slideDown(1000);
            });
         })
      }

      function insertJoiningMeeting(dm){
         $.ajax({
            type: 'POST',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_postJoiningPPM',
               'param': {
                  'dataMeeting': dm
               }
            }
         }).done(function(id){
            if(id > 0){
               idMeetingNote = id;
            }
         });
      }      

      $('#tablePPMSchedule tbody').on('click', '.btnFinish', function(){
         Swal.fire({
            title: 'Konfirmasi',
            html: '<h3>Yakin akan mengakhiri meeting?</h3>',
            type: 'question',
            showCancelButton: true
         }).then((result) => {
            if(result.value == true){
               idMeeting = $(this).data('row-id');
               // update status jadwal meeting
               let dateNow = new Date();
               let formatedDate = formatDateTime(dateNow);
               let dataMeeting = {
                  // id: idMeetingNote,
                  id: idMeeting,
                  status: 'Finish',
                  end: formatedDate
               };
               $.when(updatePPMStatusClient(dataMeeting), finishMeeting(idMeeting)).done(function(rst1, rst2){
                  if(rst1[0] && rst2[0]){
                     Swal.fire({
                        title: 'Info',
                        html: `<h3>
                                    Meeting sudah berakhir. <br/><br/>
                                    Anda bisa menyimpan catatan dengan klik tombol 'Save'.
                                 </h3>`,
                        type: 'info',
                        onAfterClose: () =>{
                           $('#btnSaveNotes').prop('disabled', false);
                           $('#btnTableView').trigger('click');
                           // sendFinishMeetingMessageToClients(id);
                           sendFinishMeetingMessageToClients(rst1[0]);
                        }
                     })                     
                  }
               });
               // updatePPMStatusClient(dataMeeting);

               // finishMeeting(idMeeting);
            }
         });
      });

      $('#tablePPMSchedule tbody').on('click', '.btnDaftarHadir', function(){
         idMeeting = $(this).data('row-id');
         daftarHadir(idMeeting);
      });
      function daftarHadir(id){
         $.ajax({
            type: 'GET',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_getPPMDaftarHadir',
               'param': {
                  'id': id
               }
            }
         }).done(function(data){
            if(data.length > 0){
               var tableHadirHTML = `<thead>
                                       <tr>
                                          <th class="text-center">No</th>
                                          <th class="text-center">Level</th>
                                          <th class="text-center">Nama</th>
                                          <th class="text-center">Start Join</th>
                                          <th class="text-center">End Join</th>
                                       </tr>
                                    </thead>`;
               $.each(data, function(x, dt){
                  tableHadirHTML += `
                                       <tr>
                                          <td>${x+1}</td>
                                          <td>${dt.level.toUpperCase()}</td>
                                          <td>${dt.user_name.toUpperCase()}</td>
                                          <td>${dt.start_join}</td>
                                          <td>${dt.end_join}</td>
                                       </tr>`;
               });
               $('#tableYangHadir').empty();
               $('#tableYangHadir').append(tableHadirHTML);
               $('#printPreviewArea1').slideUp(500, function(){
                  $('#printPreviewArea2').slideDown(1000);
               });
            }
         });
      }

      function updatePPMStatusClient(dm){
         try{
            var client = $.ajax({
               type: 'POST',
               url: 'functions/ajax_functions_handler.php',
               dataType: 'JSON',
               data: {
                  'action': 'ajax_postUpdatePPMStatusClient',
                  'param': {
                     'dataMeeting': dm
                  }
               }
            });
            return client;
         }catch(err){
            throw err;
         }
      }

      $('#tablePPMSchedule tbody').on('click', '.btnEdit', function(){
         mode = 'Edit';
         let selectedRow = $(this).parents('tr');
         let rowData = tablePPMSchedule.row(selectedRow).data();
         $('#idSchedule').val(rowData[0]);

         let meetingDate = localeDateStringToDate(rowData[3]);
         let y = meetingDate.getFullYear();
         let m = (meetingDate.getMonth() + 1).toString().padStart(2, '0');
         let d = meetingDate.getDate().toString().padStart(2, '0');
         let h = meetingDate.getHours().toString().padStart(2, '0');
         let min = meetingDate.getMinutes().toString().padStart(2, '0');
         let strMeetingDate = `${y}-${m}-${d}T${h}:${min}`;

         $('#meetingDate').val(strMeetingDate);
         // new Date(item.meeting_date).toLocaleString("id-ID").trim()
         $('#place').val(rowData[4]);
         // $('#style').select2().val(rowData[5]).trigger('change');
         $('#style').select2().val(rowData[9]).trigger('change');
         let jsonAttendees = JSON.parse(rowData[8]);
         $('#deptAttendees').select2().val(jsonAttendees).trigger('change');
         $('#description').val(rowData[2]);

         $('#badgeMode').text('Edit Data');
         $('#addForm').fadeIn(1000);         
      });

      function localeDateStringToDate(dateStr){
         const parts = dateStr.match(/(\d{2})-(\d{2})-(\d{4}) (\d{2}):(\d{2})/);
         if(!parts){
            return null;
         }

         const day = parseInt(parts[1], 10);
         const month = parseInt(parts[2], 10) - 1; // Month is 0-indexed in JavaScript Date
         const year = parseInt(parts[3], 10);
         const hours = parseInt(parts[4], 10);
         const minutes = parseInt(parts[5], 10);

         return new Date(year, month, day, hours, minutes);         
      }

      function startMeeting(id){
         // $('#tablePPMSchedule').addClass('disabled-table');
         $.ajax({
            type: 'POST',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_postStartPPM',
               'param': {
                  'idMeeting': id
               }
            }
         }).done(function(resp){
            if(resp){
               $('#btnTableView').trigger('click');
               showTime();
               $('.startMeeting').slideDown(1000, function(){
                  $('#user_name').val(userName);
                  $('#level1').val(level);
               });

               let jsonAttendees = JSON.parse(resp.dept_attendees);
               tableDaftarHadir.clear().draw();
               $.each(jsonAttendees, function(z, itm){
                  tableDaftarHadir.row.add([
                     z+1,
                     itm,
                     (itm == level ? 1 : 0)
                  ]).draw();
               });

               sendStartMeetingMessageToClients(resp);
            }
         });
      }

      function finishMeeting(id){
         try{
            var fm = $.ajax({
               type: 'POST',
               url: 'functions/ajax_functions_handler.php',
               dataType: 'JSON',
               data: {
                  'action': 'ajax_postFinishPPM',
                  'param': {
                     'id': id
                  }
               }
            });
            return fm;
         }catch(err){
            throw err
         }
      }

      function sendStartMeetingMessageToClients(dt){
         const ppmStartToClient_ws = new WebSocket("ws://192.168.90.100:10000/?service=ppm_running");
         const metaData = {
            type: "start meeting",
            data: dt
         };
         ppmStartToClient_ws.onopen = function(){
            const jsonMetaData = JSON.stringify(metaData);
            ppmStartToClient_ws.send(jsonMetaData);

         }
      }

      function sendFinishMeetingMessageToClients(id){
         const ppmFinishToClient_ws = new WebSocket("ws://192.168.90.100:10000/?service=ppm_running");
         const metaData = {
            type: "finish meeting",
            data: id
         };
         ppmFinishToClient_ws.onopen = function(){
            const jsonMetaData = JSON.stringify(metaData);
            ppmFinishToClient_ws.send(jsonMetaData);

         }         
      }

      function sendUpdateMeetingMessageToClients(dt){
         const ppmUpdateToClient_ws = new WebSocket("ws://192.168.90.100:10000/?service=ppm_running");
         const metaData = {
            type: "update meeting",
            data: dt
         };
         ppmUpdateToClient_ws.onopen = function(){
            const jsonMetaData = JSON.stringify(metaData);
            ppmUpdateToClient_ws.send(jsonMetaData);

         }         
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
         $('#jam').text(time);
         setTimeout(showTime, 1000);            
      }
      
      ppm_running_ws.onmessage = function(msg){
         var jsonMsg = JSON.parse(msg.data);
         let row = tableDaftarHadir.row(`:contains(${jsonMsg})`).select();
         let rowData = tableDaftarHadir.row(row[0]).data();
         let oldValue = parseInt(rowData[2])
         let newValue = oldValue +1
         tableDaftarHadir.cell(row,2).data(newValue).draw();

      }

      $('#frmJoinMeeting').submit(function(e){
         e.preventDefault();

         let catatanText = $('#catatan').summernote('code');
         let content = {
            'id': idMeetingNote,
            'effective_date': $('#eff_date').val(),
            'notes': catatanText
         };
         
         $.ajax({
            type: 'POST',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_postPPMUpdateNotes',
               'param': {
                  'content': content
               }
            }
         }).done(function(dt){
            if(dt){
               Swal.fire({
                  title: 'Sukses',
                  html: `<h3>Catatan PPM berhasil disimpan.</h3>`,
                  type: 'success',
                  onAfterClose: () => {
                     $('#catatan').summernote('reset');
                     $('#frmJoinMeeting')[0].reset;
                     tableDaftarHadir.clear().draw();
                     $('.startMeeting').slideUp();
                  }                  
               })               
            }
         });         
      });


      $('#btnExportToExcel1').click(function(e){
         // window.open('data:application/vnd.ms-excel,' + encodeURIComponent( $('$printPreviewContainer1').html()));
            
         let file = new Blob([$('#printPreviewContainer1').html()], {
            type: 'application/vnd.ms-excel'
         });
         let url = URL.createObjectURL(file);
         let a = $('<a ></a>', {
            href: url,
            download: ("ppmResult.xls")
         }).appendTo("body").get(0).click();            

         e.preventDefault();

      });

      $('#btnExportToExcel2').click(function(e){
         e.preventDefault();
         let file = new Blob([$('#printPreviewContainer2').html()], {
            type: 'application/vnd.ms-excel'
         });
         let url = URL.createObjectURL(file);
         let a = $('<a ></a>', {
            href: url,
            download: ("ppmHadir.xls")
         }).appendTo("body").get(0).click();
      });


      $('#btnExitPrintPreview1').click(function(){
         $('#printPreviewArea1').fadeOut(1000);
      });

      $('#btnExitPrintPreview2').click(function(){
         $('#printPreviewArea2').fadeOut(1000);
      });
   });
   
</script>

<?php
  } else {
    echo 'Anda tidak memiliki akses kehalaman ini';} 
  } 
  else{
    header('Location: index.php');
  } 
?>