<?php
   ob_start();

   require_once 'core/init.php';
   require_once 'view/header.php';

   if(isset($_SESSION['username'])){
      $userName = $_SESSION['username'];
      $level = cek_status($userName);
   }else{
      header('Location: index.php');
   }
?>
<style>
   .redShadowColor{
      box-shadow: 0 0 10px rgba(255, 0, 0, 0.5)
   }   
   .grayShadowColor{
      box-shadow: 0 0 10px rgba(60, 60,60 , 0.5)
   }   
</style>

<link rel="stylesheet" href="assets/css/summernote.min.css" /> 

</div>

<div class="container-fluid">
   <div class="panel panel-default redShadowColor" style="margin: 10px 10px 10px 10px;">
      <div class="panel-heading">
         <h3 class="text-center" style="margin-top:  10px;">
            PRO PRODUCTION JOIN MEETING
         </h3>
      </div>
      <div class="panel-body">
         <table class="table-striped table-hover" id="tableSchedule">
            <thead>
               <tr>
                  <th>Id</th>
                  <th>No</th>
                  <th>Tanggal & Jam</th>
                  <th>Deskripsi</th>
                  <th>Tempat</th>
                  <th>Produk(Style)</th>
                  <th>Total QTY</th>
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
               <div class="panel-body">
                  <div class="center-block" style="width: 500px;">
                  </div>
                  <form id="frmJoinMeeting">
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
                           <input type="date" id="eff_date" name="eff_date" class="form-control" />
                        </div>
                     </div>
                     <hr/>

                     <div class="col-md-12">
                        <div class="form-group">
                           <label style="margin-bottom: 0px;">Catatan:</label> 
                           <div id="catatan"></div>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="panel-footer">
                  <button type="button" style="margin-top: 0px; margin-right: 10px;" id="btnSave" class="btn btn-success btn-lg">
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
      </div>
   </div>

</div>

<script src="assets/js/summernote/summernote.min.js"></script>

<script>
   $(document).ready(function(){
      var level = '<?= $level; ?>';
      var userName = '<?= $userName; ?>';
      var idSchedule = '';

      var tableSchedule = $('#tableSchedule').DataTable({
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
         ],
         height: 200,
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
                  tableSchedule.row.add([
                     s.id,
                     i+1,
                     s.meeting_date,
                     s.description,
                     s.place,
                     s.meeting_style,
                     s.total_qty_order + `&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button style="margin-top: 0px;" class="btn btn-sm btn-success btnJoin" data-row-id="${s.id}" id="btnJoin-${s.id}"><span class="glyphicon glyphicon-play"></span>Join</button>`
                  ]).draw();
               });
            }
         })
      }

      $('#tableSchedule tbody').on('click', '.btnJoin' ,function(){
         Swal.fire({
            title: 'Konfirmasi',
            text: 'Yakin akan join meeting?',
            type: 'question',
            showCancelButton: true
         }).then((result) => {
            if(result){
               console.log('Level: ', level);
               // jika login admin, langsung bisa ikut join
               // jika login sebagai selain admin, di periksa dulu diudang meeting atau tidak
               idSchedule = $(this).data('row-id');
               var diundang = cekDiundang(idSchedule, level);
               diundang.done(function(dt){
                  console.log('dt: ', dt);
                  if(!dt){
                     Swal.fire({
                        title: 'Peringatan',
                        text: 'Anda tidak diundang dalam meeting',
                        type: 'warning',
                        showConfirmButton: true
                     })                     
                  }else{
                     $('#joinMeeting').slideDown(1000, function(){
                        $('#user_name').val(userName);
                        $('#level').val(level);
                        $('#btnShowdetailMeeting').prop('disabled', false);
                        $(`#btnJoin-${dt.id}`).removeClass('btn-success').addClass('btn-danger').text("Joining...");

                     });
                  }
               })
               // }

            }
         });
      });

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

      $('#btnSave').click(function(){
         Swal.fire({
            title: 'Konfirmasi',
            html: `<h2>Yakin akan disimpan?</h2> <br> <h3>Jika iya, maka Anda dianggap keluar dari meeting/meeting sudah selesai!</h3>`,
            type: 'question',
            showCancelButton: true
         }).then((result) => {
            if(result){
               let catatanText = $('#catatan').summernote('code');
               let content = {
                  'id_meeting_schedule': idSchedule,
                  'user_name': userName,
                  'level': level,
                  'effective_date': $('#eff_date').val(),
                  'notes': catatanText
               };
      
               $.ajax({
                  type: 'POST',
                  url: 'functions/ajax_functions_handler.php',
                  dataType: 'JSON',
                  data: {
                     'action': 'ajax_postPPMResult',
                     'param': {
                        'content': content
                     }
                  },
                  success: function(id){
                     console.log('id: ', id);
                     if(id > 0){
                        $('#joinMeeting').slideUp(1000, function(){
                           $(`#btnJoin-${idSchedule}`).prop('disabled', true).text('had joined');
                           $('#user_name').val('');
                           $('#level').val('');
                           $('#eff_date').val('');
                        })

                     }
                  }
               });
            }
         });

      })
   });
</script>
