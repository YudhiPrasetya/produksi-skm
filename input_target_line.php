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
                           <input type="text" class="form-control" id="line" name="line" disabled />
                        </div>
                     </div>
            
                     <div class="form-group">
                        <label for="target" class="form-label">Target</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="glyphicon glyphicon-dashboard"></i>
                           </div>
                           <input type="number" class="form-control" id="target" name="target" />
                        </div>
                     </div>
      
                  </div>
                  <div class="panel-footer">
                     <button class="btn btn-success" style="margin-top: 0px;" id="btnSave">Save</button>
                     <button class="btn btn-warning" style="margin-top: 0px;" id="btnEdit">Edit</button>
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
                              <th>No</th>
                              <th>Tanggal</th>
                              <th>Line</th>
                              <th>Target</th>
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

<script>
   
   $(document).ready(function(){
      var mode = 'Add';
      var editText = "Edit";
      var noRow = 0;
      $('#editBtn').text(editText);
      var idTarget = 0;
      var line = '<?= $dataLine[0]; ?>';
      $('#line').val(line);

      var tableTarget = $('#tableTarget').DataTable({
         destroy: true,
      });
      
      let nowDate = new Date();
      let year = nowDate.getFullYear();
      let month = nowDate.getMonth()+1;
      let day = nowDate.getDate();
      let strDay = day < 10 ? `0${day}` : `${day}`;
      let strMonth = month < 10 ? `0${month}` : `${month}`;
      var strDate = `${year}-${strMonth}-${strDay}`;
      $('#tanggal').val(strDate);

      getDataTargetLine(line);
      function getDataTargetLine(ln){
         try{
            $.ajax({
               type: 'GET',
               url: 'functions/ajax_functions_handler.php',
               dataType: 'JSON',
               data: {
                  action: 'ajax_getQCEndlineTarget',
                  param: {
                     line: ln
                  }
               }
            }).done(function(rst){
               console.log('rst.length: ', rst.length);
               tableTarget.clear();
               if(rst.length > 0){
                  for(let x = 0; x < rst.length; x++){
                     noRow = x+1;
                     tableTarget.row.add([
                        noRow,
                        rst[x].tanggal,
                        rst[x].line,
                        rst[x].target
                     ]).draw();

                     if(rst[x].tanggal === strDate){
                        idTarget = parseInt(rst[x].id);
                        $('#id').val(id);
                        $('#target').val(rst[x].target);
                        $('#target').prop('disabled', true);
                        $('#btnEdit').prop('disabled', false);
                        $('#btnSave').prop('disabled', true);
                     }else{
                        // $('#btnEdit').prop('disabled', true);
                        // $('#btnSave').prop('disabled', false);
                        // $('#target').focus();
                     }

                  }
               }else{
                  $('#btnEdit').prop('disabled', true);
                  $('#target').val(0);
                  $('#target').focus();
               }
            })
         }catch(err){
            throw err;
         }
      }

      $('#btnEdit').click(function(){
         if(editText == "Edit"){
            mode = 'Edit';
            $('#btnSave').prop('disabled', false);
            $('#target').prop('disabled', false);
            $('#target').focus();
            editText = "Cancel Edit";
            $('#btnEdit').text(editText);
         }else{
            mode = 'Add';
            $('#btnSave').prop('disabled', true);
            $('#target').prop('disabled', true);
            editText = "Edit";
            $('#btnEdit').text(editText);            
         }

      })
      $('#btnSave').click(function(){
         if(mode === "Add"){
            saveTarget()
         }else{
            updateTarget();
         }
      });

      function saveTarget(){
         var dataTarget = {
            'tanggal': $('#tanggal').val(),
            'line': line,
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
               noRow++;
               tableTarget.row.add([
                  noRow,
                  $('#tanggal').val(),
                  line,
                  $('#target').val()
               ]).draw();
               $('#target').prop('disabled', true);
               $('#btnEdit').prop('disabled', false);
               $('#btnSave').prop('disabled', true);
               let msg = JSON.stringify(dataTarget);
               sendTargetOuputLineMessage(msg);
            }
         })
      }

      function sendTargetOuputLineMessage(data){
         console.log('data: ', data);
         var qcEndlineTargetMsg = new WebSocket("ws://192.168.90.100:10000/?service=ouput_target");

         qcEndlineTargetMsg.onopen = function(){
            qcEndlineTargetMsg.send(data);
         }
      }

      function updateTarget(){
         var target = $('#target').val();
         var dataTarget = {
            'id': idTarget,
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
               getDataTargetLine(line);
               editText = "Edit";
               mode = 'Add';
               $('#btnEdit').text(editText);
               dataTarget.line = line;
               let message = JSON.stringify(dataTarget)
               sendTargetOuputLineMessage(message);
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
