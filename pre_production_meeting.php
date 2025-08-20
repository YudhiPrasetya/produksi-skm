<?php
   ob_start();

   require_once 'core/init.php';
   require_once 'view/header.php';

   if(isset($_SESSION['username'])){
      if(cek_status($_SESSION['username']) == 'admin'){
         $temp = tampilkan_line_username($_SESSION['username']);
         $dataLine = mysqli_fetch_array($temp);
?>         
<style>
   .redShadowColor{
      box-shadow: 0 0 10px rgba(255, 0, 0, 0.5)
   }   
   .grayShadowColor{
      box-shadow: 0 0 10px rgba(60, 60,60 , 0.5)
   }   
</style>
</div>

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

               <button type="button" class="btn btn-warning btn-lg" id="btnCardView">
                  <span class="glyphicon glyphicon-file"></span>
               </button>

               <button type="button" class="btn btn-warning btn-lg" id="btnRefresh">
                  <span class="glyphicon glyphicon-refresh"></span>
               </button>                  
            </div>
            
            <button type="button" class="btn btn-success btn-lg" id="btnAdd">
               <span class="glyphicon glyphicon-plus"></span>
            </button>


         </div>
         <!-- <div class="row"> -->
            <div id="viewContainer">
               <table class="table table-striped table-hover" id="tablePPMSchedule" width="100%">
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
                     </tr>
                  </thead>
               </table>
            </div>
         <!-- </div> -->

         <div class="center-block" style="width: 800px;">
            <div class="panel panel-default grayShadowColor" id="addForm" style="display: none;">
               <div class="panel-heading bg-info">
                  
                  <h3 class="text-center" style="margin-top: 10px;">
                     <strong>Pre Production Schedule Meeting</strong>
                     <span class="badge label label-success">
                        Add New
                     </span>
                  </h3>
               </div>
               <div class="panel-body">
                  <form id="frmAddNew">
                     <div class="col-md-6">
                        <div class="form-group">
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
                           <select name="deptAttendees" id="deptAttendees" class="form-control select2">
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
                  <button type="button" style="margin-top: 0px; margin-right: 10px;" id="btnSave" class="btn btn-success btn-lg" disabled>
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
   </dv>
   </div>

<script src="assets/js/select2.min.js"></script>

<script>
   $(document).ready(function(){
      var arrDeptAttendees = [];
      var totalQTYOrder = 0;
      var arrData = [];
      var tablePPMSchedule = $('#tablePPMSchedule').DataTable({
         destroy: true,
         columnDefs: [
            {
               'targets': [0],
               'visible': false
            }
         ]         
      });
      var tableDetail = $('#tableDetail').DataTable({
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
                  'action': 'ajax_getMeetingSchedule7Days'
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
         $('#addForm').fadeIn(1000);
      });

      $('#btnExit').click(function(){
         clearControls();
         setValidationButton();
         $('#addForm').fadeOut(1000);
      });

      $('#meetingDate').change(function(){
         setValidationButton();
      });

      $('#place').change(function(){
         setValidationButton();
      });

      $('#style').change(function(){
         setValidationButton();
      });

      $('#deptAttendees').change(function(){
         setValidationButton();
      });

      function setValidationButton(){
         let meetingDate = $('#meetingDate').val();
         let place = $('#place').val();
         let style = $('#style').val();
         let deptAttendees = $('#deptAttendees').val();

         let valid = meetingDate != '' && place != '' && style != '' && deptAttendees != null;
         $('#btnSave').prop('disabled', !valid);
         $('#btnCancel').prop('disabled', !valid);
      }

      $('#deptAttendees').change(function(){
         arrDeptAttendees = $('#deptAttendees').select2('data');
      });

      $('#btnSave').click(function(){
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
                     setValidationButton();
                  }                  
               })               
            }
         });
      });

      $('#btnCancel').click(function(){
         clearControls();
         setValidationButton();
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
            }

         })
      });

      // Data view section

      // Table View
      $('#btnCardView').click(function(){
         console.log('arrData: ', arrData);
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
            console.log('data: ', data);
            $.each(data, function(i, item){
               tablePPMSchedule.row.add([
                  item.id,
                  i+1,
                  item.description,
                  new Date(item.meeting_date).toLocaleString("id-ID"),
                  item.place,
                  item.meeting_style,
                  item.total_qty_order,
                  item.status + `&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="btnJoin-${item.id}" class="btn btn-success btn-sm" style="margin-top: 0px;"><span class="glyphicon glyphicon-play"></span>&nbsp;Start</button>`
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

      })
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