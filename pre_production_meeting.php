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
   <!-- <div class="row"> -->
      <div class="panel panel-default redShadowColor" style="margin: 10px 10px 10px 10px">
         <div class="panel-heading">
            <h3 class="text-center" style="margin-top: 10px;"><strong>PRE PRODUCTION MEETING</strong></h3>
         </div>
         <div class="panel-body">
            <div class="form-group">
               <div class="btn-group" style="margin-right: 25px;">
                  <button type="button" class="btn btn-warning btn-lg">
                     <span class="glyphicon glyphicon-list-alt"></span>
                  </button>

                  <button type="button" class="btn btn-warning btn-lg">
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
            <div class="center-block" style="width: 800px;">
               <div class="panel panel-default grayShadowColor" id="addForm" style="display: none;">
                  <div class="panel-heading bg-info">
                     
                     <h3 class="text-center" style="margin-top: 10px;">
                        <strong>Pre Production Meeting</strong>
                        <span class="badge label label-success">
                           Add New
                        </span>
                     </h3>
                  </div>
                  <div class="panel-body">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="meetingDate" style="margin-bottom: 0px;">Tanggal Meeting</label>
                           <input type="date" class="form-control" id="meetingDate" name="meetingDate" />
                        </div>
                        <div class="form-group">
                           <label for="place" style="margin-bottom: 0px;">Tempat</label>
                           <select name="place" id="place" class="form-control">
                              <option value="">--Silahkan pilih tempat meeting--</option>
                              <option value="Globalindo 1">Globalindo 1 (Jombor)</option>
                              <option value="Globalindo 2">Globalindo 2 (Mlese)</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="style" style="margin-bottom: 0px;">Style</label>
                           <select name="style" id="style" class="form-control select2" width="100%">
                              <option>--Silahkan pilih style--</option>
                           </select>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="deptAttendees" style="margin-bottom: 0px;">Departemen yg diundang</label>
                           <select name="deptAttendees" id="deptAttendees" class="form-control select2" width="100%">
                              <option>--Silahkan pilih departemen yang diundang--</option>                              
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="description" style="margin-bottom: 0px;">Deskripsi</label>
                           <textarea name="description" id="description" class="form-control" rows="5" cols="5"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="panel-footer">
                     <button type="button" style="margin-top: 0px; margin-right: 10px;" class="btn btn-success btn-lg" disabled>
                        <span class="glyphicon glyphicon-plus-sign"></span> Save
                     </button>

                     <button type="button" style="margin-top: 0px;" class="btn btn-default btn-lg" disabled>
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
<!-- </div> -->

<script src="assets/js/select2.min.js"></script>

<script>
   $(document).ready(function(){
      $('.select2').select2({
         width: "100%"
      });

      // loadStyleAndDepartment();

      // function loadStyleAndDepartment(){
      //    $.when(loadStyles(), loadDepartments()).done(function(rstStyles, rstDepartments){

      //    });
      // }

      // function loadStyles(){
      //    try{
      //       var rspStyles = $.ajax({

      //       });
      //       return rspStyles;
      //    }cacth(err){
      //       throw err
      //    }
      // }

      // function loadDepartments(){
      //    try{
      //       var rspDepartments = $.ajax({

      //       });
      //       return rspDepartments;
      //    }cacth(err){
      //       throw err
      //    }
      // }


      $('#btnAdd').click(function(){
         $('#addForm').fadeIn(1000);
      });

      $('#btnExit').click(function(){
         $('#addForm').fadeOut(1000);
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