<?php
   ob_start();

   require_once 'core/init.php';
   // require_once 'view/header.php';

   if(isset($_SESSION['username'])){
      $userName = $_SESSION['username'];
      $level = cek_status($userName);
   }else{
      header('Location: index.php');
   }
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
   <div class="panel panel-default redShadowColor" style="margin: 10px 10px 10px 10px;">
      <div class="panel-heading">
         <h3 class="text-center" style="margin-top:  10px;">
            PRO PRODUCTION JOIN MEETING
         </h3>
      </div>
      <div class="panel-body">
         <table class="table-striped table-hover" id="tableSchedule" width="100%">
            <thead>
               <tr>
                  <th>Id</th>
                  <th>No</th>
                  <th>Tanggal & Jam</th>
                  <th>Deskripsi</th>
                  <th>Tempat</th>
                  <th>Produk(Style)</th>
                  <th>Total QTY</th>
                  <th>Status</th>
               </tr>
            </thead>
         </table>
         <hr/>
         <div class="center-block" style="width: 1000px;">
            <div class="panel panel-info grayShadowColor" id="joinMeeting" style="display: none">
               <div class="panel-heading bg-info">
                  
                  <h3 class="text-center" style="margin-top: 10px;">
                     <strong>Joining Pre Production Schedule Meeting</strong>
                  </h3>
               </div>
               <form id="frmJoinMeeting">
                  <div class="panel-body">
                  <!-- <div class="center-block" style="width: 500px;">
                  </div> -->
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="user_name" style="margin-bottom: 0px;">User Name:</label>
                           <input type="text" class="form-control plain-text" id="user_name" name="user_name" disabled />
                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="level" style="margin-bottom: 0px;">Level:</label>
                           <div class="input-group">
                              <input name="level" id="level" class="form-control" disabled />
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
                           <label for="catatan" style="margin-bottom: 0px;">Catatan:</label> 
                           <textarea id="catatan" name="note"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="panel-footer">
                     <button type="submit" style="margin-top: 0px; margin-right: 10px;" id="btnSaveNotes" class="btn btn-success btn-lg" disabled>
                        <span class="glyphicon glyphicon-plus-sign"></span> Save
                     </button>
                  </div>
               </form>
            </div>            
         </div>
      </div>
   </div>

</div>
<script src="assets/js/jquery.validate.min.js"></script>

<script src="assets/js/summernote/summernote.min.js"></script>

<script>
   $(document).ready(function(){
      var level = '<?= $level; ?>';
      var userName = '<?= $userName; ?>';
      var idSchedule = '';
      var idMeeting = '';
      var ppmOnMessage_ws = new WebSocket("ws://192.168.90.100:10000/?service=ppm_running");
      var noIdx = 0;

      var tableSchedule = $('#tableSchedule').DataTable({
         responsive: true,
         destroy: true,
         columnDefs: [
            {
               'targets': [0],
               'visible': false
            }
         ]
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
            ['undo', ['undo']],
            ['redo', ['redo']],
            ['height', ['height']],
         ],
         height: 200,
         tabDisable: false,
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

      $.validator.addMethod('requiredSummernote', function(value, element){
         return $('#catatan').summernote('isEmpty');
      }, 'This field is required');

      $('#joinMeeting').validate({
         rules: {
            note: {
               requiredSummernote: true
            }
         }
      });

      initScheduleMeeting();
      function initScheduleMeeting(){
         $.ajax({
            type: 'GET',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_getScheduleMeeting'
            }
         }).done(function(dataSchedule){
            if(dataSchedule.length > 0){
               $.each(dataSchedule, function(i, s){
                  noIdx = i + 1;
                  tableSchedule.row.add([
                     s.id,
                     noIdx+1,
                     s.meeting_date,
                     s.description,
                     s.place,
                     s.meeting_style,
                     s.total_qty_order,
                     s.status + `&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button style="margin-top: 0px;" class="btn btn-sm btn-success btnJoin" data-row-id="${s.id}" id="btnJoin-${s.id}"><span class="glyphicon glyphicon-play"></span>Join</button>`
                  ]).draw();
               });
            }
         })
      }

      $('#tableSchedule tbody').on('click', '.btnJoin' ,function(){
         Swal.fire({
            title: 'Konfirmasi',
            html: '<h3>Yakin akan join meeting?</h3>',
            type: 'question',
            showCancelButton: true
         }).then((result) => {
            if(result.value == true){
               // jika login admin, langsung bisa ikut join
               // jika login sebagai selain admin, di periksa dulu diudang meeting atau tidak
               idSchedule = $(this).data('row-id');
               var diundang = cekDiundang(idSchedule, level);
               diundang.done(function(dt){
                  if(!dt){
                     Swal.fire({
                        title: 'Peringatan',
                        html: '<h3>Anda tidak diundang dalam meeting!</h3>',
                        type: 'warning',
                        showConfirmButton: true
                     })                     
                  }else{
                     $('#joinMeeting').slideDown(1000, function(){
                        $('#user_name').val(userName);
                        $('#level').val(level);
                        $('#btnShowdetailMeeting').prop('disabled', false);
                        $(`#btnJoin-${dt.id}`).removeClass('btn-success').addClass('btn-danger')
                              .text("Joining...").prop('disabled', true);
                        let row = $(this).parents('tr');
                        let rowData = tableSchedule.row(row).data();
                        let dateNow = new Date();
                        let formattedDate = formatDateTime(dateNow);
                        let dataMeeting = {
                           'idSchedule': idSchedule,
                           'user_name': $('#user_name').val(),
                           'level': level,
                           'start': formattedDate,
                           'status': 'Joining'
                        };
                        insertJoiningMeeting(dataMeeting);
                        sendPPMMessage(level);
                     });
                  }
               })
               // }

            }
         });
      });

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
               idMeeting = id;
            }
         })
      }

      function formatDateTime(date) {
         const year = date.getFullYear();
         const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is 0-indexed
         const day = String(date.getDate()).padStart(2, '0');
         const hours = String(date.getHours()).padStart(2, '0');
         const minutes = String(date.getMinutes()).padStart(2, '0');
         const seconds = String(date.getSeconds()).padStart(2, '0');

         return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
      }

      function cekDiundang(id, lvl){
         try{
            var cek = $.ajax({
               type: 'GET',
               url: 'functions/ajax_functions_handler.php',
               dataType: 'JSON',
               data: {
                  'action': 'ajax_cekDiundangMeeting',
                  'param': {
                     'idSchedule': id,
                     'level': lvl
                  }
               }
            });
            return cek;

         }catch(err){
            throw err;
         }
         
      }

      $('#joinMeeting').submit(function(e){
         e.preventDefault();

         let catatanText = $('#catatan').summernote('code');
         let content = {
            'id': idMeeting,
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
                     $('#joinMeeting').slideUp(1000, function(){
                        tableSchedule.clear().draw();
                     });
                  }                  
               })               
            }
         });         
      })

      $('#btnSaveNotes').click(function(){
         // let catatanText = $('#catatan').summernote('code');
         // let content = {
         //    'id': idMeeting,
         //    'effective_date': $('#eff_date').val(),
         //    'notes': catatanText
         // };
         
         // $.ajax({
         //    type: 'POST',
         //    url: 'functions/ajax_functions_handler.php',
         //    dataType: 'JSON',
         //    data: {
         //       'action': 'ajax_postPPMUpdateNotes',
         //       'param': {
         //          'content': content
         //       }
         //    }
         // }).done(function(dt){
         //    if(dt){

         //    }
         // });

      });

      function sendPPMMessage(lvl){
         var ppmRunning_ws = new WebSocket("ws://192.168.90.100:10000/?service=ppm");
         ppmRunning_ws.onopen = function(){
            ppmRunning_ws.send(JSON.stringify(lvl));
         }
      }

      ppmOnMessage_ws.onmessage = function(msg){
         var objMessage = JSON.parse(msg.data);
         switch(objMessage.type){
            case "start meeting":
               addJoinMeeting(objMessage.data);
               break;
            case "update meeting":
               updateJoinedDataMeeting(objMessage.data);
               break
            case "finish meeting":
               finishMeeting(objMessage.data);
               break;
         }
      }
      
      function formatDateTimeDDMMYYYHHmm(dt){
         let newDate = new Date(dt);
         let year = newDate.getFullYear();
         let strMonth = (newDate.getMonth() + 1).toString().padStart(2, '0');
         let strDay = newDate.getDate().toString().padStart(2, '0');
         let strHours = newDate.getHours().toString().padStart(2, '0');
         let strMinutes = newDate.getMinutes().toString().padStart(2, '0');

         return `${strDay}-${strMonth}-${year} ${strHours}:${strMinutes}`;

      }

      function addJoinMeeting(data) {
         noIdx++;
         let strDate = formatDateTimeDDMMYYYHHmm(data.meeting_date);
         tableSchedule.row.add([
            data.id,
            noIdx,
            strDate,
            data.description,
            data.place,
            data.style,
            data.total_qty_order,
            data.status + `&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button style="margin-top: 0px;" class="btn btn-sm btn-success btnJoin" data-row-id="${data.id}" id="btnJoin-${data.id}"><span class="glyphicon glyphicon-play"></span>Join</button>`
         ]).draw();            
      }

      function updateJoinedDataMeeting(dt){
         let strDate = formatDateTimeDDMMYYYHHmm(dt.meeting_date);

         tableSchedule.rows().every(function(rowIdx, tableLoop, rowLoop){
            var data = this.data();
            console.log('data rows in every:', data);
            if(parseInt(dt.id) == parseInt(data[0])){
               tableSchedule.cell(rowIdx,2).data(strDate).draw();
               tableSchedule.cell(rowIdx,3).data(dt.description).draw();
               tableSchedule.cell(rowIdx,4).data(dt.place).draw();
               tableSchedule.cell(rowIdx,5).data(dt.style).draw();
               tableSchedule.cell(rowIdx,6).data(dt.total_qty_order).draw();

            }
         });

      }

      function finishMeeting(dt) {
         Swal.fire({
            title: 'Info',
            html: `<h3>Pre Production Meeting sudah selesai.<br/><br/>
                   Terimakasih atas waktu dan partisipasinya.<br/><br/>
                   Semoga hasil PPM ini bisa bermanfaat.<br/><br/>
                   Jangan lupa untuk menyimpan catatan dengan klik tombol 'Save'.</h3>`,
            type: 'info',
            onAfterClose: () => {
               tableSchedule.rows().every(function(rowIdx, tableLoop, rowLoop){
                  var data = this.data();
                  console.log('dt: ', dt);
                  console.log('data[0]: ', data[0]);
                  if(parseInt(dt) == parseInt(data[0])){
                     tableSchedule.cell(rowIdx,7).data("finish").draw();
                     $(`#btnJoin-${data[0]}`).css("display", "none");
                     $('#btnSaveNotes').prop('disabled', false);
                  }
               });
            }                  
         })
      }
   });
</script>
