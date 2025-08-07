<?php
   ob_start();

   require_once 'core/init.php';
   require_once 'view/header.php';

   $dataLine;

   if(isset($_SESSION['username'])){
      if(cek_status($_SESSION['username']) == 'admin' OR cek_status($_SESSION['username']) == 'qc_endline'){
         $temp = tampilkan_line_username($_SESSION['username']);
         $dataLine = mysqli_fetch_array($temp);
         // var_dump($dataLine);
?>

<style>
   #tableTarget tbody tr:hover {
    cursor: pointer;
   }

</style>

<div class="container">
   <div class="row">
      <div class="panel panel-default">
         <div class="panel-body">
            <h3 class="text-center" style="margin-bottom: 30px; margin-top: 5px;"><strong>Target Harian Output Sewing</strong></h3>
            <div class="col-md-3">
               <div class="panel panel-primary">
                  <div class="panel-heading">Entry Data Target Line</div>
                  <div class="panel-body">
                     <div class="form-group">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="hidden" id="id" />
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="glyphicon glyphicon-calendar"></i>
                           </div>
                           <input type="date" class="form-control" id="tanggal" name="tanggal" disabled />
                        </div>
                     </div>
            
                     <div class="form-group">
                        <label for="line" class="form-label">Line</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="glyphicon glyphicon-user"></i>
                           </div>
                           <select class="form-control inputControl validation" id="line" name="line" placeholder="Silahkan pilih line"></select>
                        </div>
                     </div>
            
                     <div class="form-group">
                        <label for="target" class="form-label">Target</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="glyphicon glyphicon-dashboard"></i>
                           </div>
                           <input type="number" class="form-control inputControl validation" id="target" name="target" placeholder="Isikan target disini" />
                        </div>
                     </div>
      
                  </div>
                  <div class="panel-footer">
                     <button class="btn btn-success" style="margin-top: 0px;" id="btnSave">Save</button>
                     <button class="btn btn-default" style="margin-top: 0px;" id="btnCancel">Cancel</button>
                  </div>
               </div>
      
      
            </div>

            <div class="col-md-9">
               <div class="panel panel-primary">
                  <div class="panel-heading">Data Target Line</div>
                  <div class="panel-body">
                     <table class="table table-striped table-hover" id="tableTarget">
                        <thead>
                           <tr>
                              <th></th>
                              <th>id</th>
                              <th>Tanggal</th>
                              <th>Line</th>
                              <th>Target</th>
                              <th></th>
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>      
            </div>
         </div>
      </div>

   </div>
</div>

<script src="assets/js/select2.min.js"></script>
<script>
   let currentState = false;
   $(document).ready(function(){
      var line = $('#line').select2();
      var mode = '';
      var btnSaveText = 'Add';
      var editText = "Edit";
      var noRow = 0;
      var idTarget = 0;

      var tableTarget = $('#tableTarget').DataTable({
         destroy: true,
         columnDefs:[
            {
               searchable: false,
               orderable: false,
               targets: 0
            },
            {
               targets: 1,
               visible: false
            }
         ],
         order: [[1, 'desc']],
         select: {
            style: 'single'
         }
      });      

      let nowDate = new Date();
      let year = nowDate.getFullYear();
      let month = nowDate.getMonth()+1;
      let day = nowDate.getDate();
      let strDay = day < 10 ? `0${day}` : `${day}`;
      let strMonth = month < 10 ? `0${month}` : `${month}`;
      var strDate = `${year}-${strMonth}-${strDay}`;
      $('#tanggal').val(strDate);

      loadLines();
      function loadLines(){
         $.ajax({
            type: "GET",
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_getLines'
            }
         }).done(function(dataLines){
            $('#line').append($('<option></option>').val('').text("Silahkan pilih line"));
            $.each(dataLines, function(i,item){
               $('#line').append($('<option></option>').val(item.nama_line).text(item.nama_line));
            });
         })
      }

      init();
      function init(){
         mode='Add';
         $('#target').val(0);
         $('#btnSave').text(btnSaveText);
         $('#btnCancel').prop('disabled', true);
         toggleInputControls();
      }

      function toggleInputControls(){
         $('.inputControl').prop('disabled', function(i, val){
            return !val;
         });
      }

      getDataTargetLine();
      function getDataTargetLine(){
         try{
            $.ajax({
               type: 'GET',
               url: 'functions/ajax_functions_handler.php',
               dataType: 'JSON',
               data: {action: 'ajax_getAllQCEndlineTarget'}
            }).done(function(rst){
               tableTarget.clear();
               loadDataTableTarget(rst);
            })
         }catch(err){
            throw err;
         }
      }      

      function loadDataTableTarget(result){
         if(result.length > 0){
            for(let x = 0; x < result.length; x++){
               noRow = x+1;
               let tgl = result[x].tanggal.slice(-2);
               let bln = result[x].tanggal.slice(5,7);
               let thn = result[x].tanggal.slice(0,4);
               let strTgl = `${tgl}/${bln}/${thn}`;

               tableTarget.row.add([
                  '',
                  result[x].id,
                  strTgl,
                  result[x].line,
                  result[x].target,
                  // (strTgl == strDate ? `<button class="btn btn-warning btn-sm" id="btnEdit-${rst[x].id}">Edit</button>` : "")
                  (strDate == result[x].tanggal ? `<button class="btn btn-warning btn-sm btn-edit" style="margin-top: 0px; padding-top: 0px; padding-bottom: 0px;" id="btnEdit-${result[x].id}">Edit</button>` : "")
               ]).draw();

            }
         }else{
            $('#target').val(0);
         }         
      }

      tableTarget.on('order.dt search.dt', function(){
         var i = 1;
         tableTarget
            .cells(null, 0, {search: 'applied', order: 'applied'})
            .every(function(cell){
               this.data(i++);
         });
      }).draw();
      

      $('#tableTarget tbody').on('click', '.btn-edit', function () {
         let rowData = tableTarget.row($(this).parents('tr')).data();
         idTarget = parseInt(rowData[1]);
         $('#line').val(rowData[3]);
         $('#line').trigger('change');
         $('#target').val(rowData[4]);
         $('.inputControl').prop('disabled', false);
         mode = 'Edit';
         btnSaveText = 'Save';
         $('#btnSave').text(btnSaveText);
         $('#btnSave').prop('disabled', false);
         $('#btnCancel').prop('disabled', false);

      });

      $('#btnSave').click(function(){
         switch(mode){
            case "Add":
               toggleInputControls();
               $('#line').focus();
               $('#line').select2('open');
               btnSaveText = 'Save';
               mode = 'Save';
               $('#btnSave').text(btnSaveText);
               $('#btnSave').removeClass('btn-success');
               $('#btnSave').addClass('btn-info');
      
               $('#btnCancel').prop('disabled', false);
               $(this).prop('disabled', true);
               break;
            case "Save":
               saveTarget();
               break;
            case "Edit":
               updateTarget();
               break;
         }

      });

      $('#btnCancel').click(function(){
         if(mode == 'Save' || mode == 'Edit'){
            mode = 'Add';
            btnSaveText = 'Add';
            $('#btnSave').text(btnSaveText);
            $('#btnSave').removeClass('btn-info');
            $('#btnSave').addClass('btn-success');
            clearInputControls();
            toggleInputControls();
            $(this).prop('disabled', true);
            $('#btnSave').prop('disabled', false);
         }
      });

      function clearInputControls(){
         $('#line').val('');
         $('#line').trigger('change');
         $('#target').val('');
      }

      $('#line').change(function(){
         setValidation();
      });

      $('#target').change(function(){
         setValidation();
      });

      function setValidation(){
         let lineVal = $('#line').val();
         let targetVal = $('#target').val();

         if( (lineVal != '' && targetVal != '') || (lineVal != 0 && targetVal != '')){
            $('#btnSave').prop('disabled', false);
         }else{
            $('#btnSave').prop('disabled', true);
         }

      }

      function saveTarget(){
         var dataTarget = {
            'tanggal': $('#tanggal').val(),
            'line': $('#line').val(),
            'target': $('#target').val()
         };

         $.ajax({
            type: 'POST',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_postTargetOuputLine',
               'param': {
                  'dataTarget': dataTarget
               }
            }
         }).done(function(result){
            if(result){
               Swal.fire({
                  title: 'success',
                  text: 'Data target berhasil di tambahkan',
                  type: 'success',
                  onAfterClose: () => {
                     noRow = 0;
                     mode = 'Add';
                     getDataTargetLine();

                     clearInputControls();
                     toggleInputControls();
                     $('#btnSave').text('Add');
                     $('#btnSave').removeClass('btn-info');
                     $('#btnSave').addClass('btn-success');

                     $('#btnSave').prop('disabled', false);
                     $('#btnCancel').prop('disabled', true);
                     let msg = JSON.stringify(dataTarget);
                     sendTargetOuputLineMessage(msg);

                  }                  
               })
            }
         })
      }

      function sendTargetOuputLineMessage(data){
         var qcEndlineTargetMsg = new WebSocket("ws://192.168.90.100:10000/?service=ouput_target");
         // var qcEndlineTargetMsg = new WebSocket("ws://127.0.0.1:10000/?service=ouput_target");

         qcEndlineTargetMsg.onopen = function(){
            qcEndlineTargetMsg.send(data);
         }
      }

      function updateTarget(){
         var target = $('#target').val();
         var dataTarget = {
            'id': idTarget,
            'line': $('#line').val(),
            'target': target
         };

         $.ajax({
            type: 'POST',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_updateTargetOutputLine',
               'param': {
                  'dataTarget': dataTarget
               }
            }
         }).done(function(result){
            if(result){
               getDataTargetLine();
               Swal.fire({
                  title: 'success',
                  text: 'Data target berhasil di update',
                  type: 'success',
                  onAfterClose: () => {
                     btnSaveText = "Add";
                     mode = 'Add';
                     $('#btnSave').text(btnSaveText);
                     $('#btnSave').removeClass('btn-info');
                     $('#btnSave').addClass('btn-success');
                     clearInputControls();
                     toggleInputControls();
                     $('#btnCancel').prop('disabled', true);
                     $('#btnSave').prop('disabled', false);
                     let message = JSON.stringify(dataTarget)
                     sendTargetOuputLineMessage(message);
                     
                  }
               })
            }
         })
      }

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
