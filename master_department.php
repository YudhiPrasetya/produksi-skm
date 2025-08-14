<?php
   ob_start();

   require_once 'core/init.php';
   require_once 'view/header.php';

   $dataLine;

   if(isset($_SESSION['username'])){
      if(cek_status($_SESSION['username']) == 'admin'){
         $temp = tampilkan_line_username($_SESSION['username']);
         $dataLine = mysqli_fetch_array($temp);

?>

<style>
   .dataTable tbody tr:hover {
    cursor: pointer;
   }

   .disabled-table{
      opacity: 0.6;
      pointer-events: none;
   }

</style>

</div>
<div class="container">
   <div class="row">
      <div class="panel panel-default">
         <div class="panel-body">
            <h3 class="text-center" style="margin-bottom: 30px; margin-top: 5px;"><strong>Data Departemen</strong></h3>
            <div class="col-md-6">
               <div class="panel panel-primary">
                  <div class="panel-heading">Entry Data Departemen</div>
                  <div class="panel-body">
                     <table class="table table-striped table-hover compact nowrap display" id="tableDepartment" width="100%">
                        <thead>
                           <tr>
                              <th></th>
                              <th>Id</th>
                              <th>Nama Departemen</th>
                              <th>Deskripsi</th>
                           </tr>
                        </thead>
                     </table>
                     <hr />
                     <!-- <div class="form-inline"> -->
                        <div class="form-group">
                           <button class="btn btn-primary btn-sm" style="margin-top: 0px; margin-right: 10px;" id="btnAddDepartment">
                              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                           </button>
                           <button class="btn btn-primary btn-sm" style="margin-top: 0px; margin-right: 10px;" id="btnEditDepartment" disabled>
                              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                           </button>
                        </div>
                        <input type="hidden" id="idDepartemen" />
                        <div class="form-group" style="margin-right: 10px;">
                           <label for="namaDepartemen">Nama Departemen:</label>
                           <input type="text" class="form-control input-sm departmentControl" id="namaDepartemen" />
                        </div>
                        <div class="form-group" style="margin-right: 10px;">
                           <label for="descDepartemen">Deskiripsi:</label>
                           <input type="text" class="form-control input-sm departmentControl" id="descDepartemen" />
                        </div>

                        <div class="form-group" style="margin-right: 10px;">

                           <button class="btn btn-success btn-sm" style="margin-top: 0px;" id="btnSaveDepartment" disabled>Save</button>
                           <button class="btn btn-default btn-sm" style="margin-top: 0px;" id="btnCancelDepartment" disabled>Cancel</button>
                        </div>

                        <div class="form-group">
                           
                        </div>
                     <!-- </div> -->
                  </div>

               </div>
            </div>

            <div class="col-md-6">
               <div class="panel panel-info">
                  <div class="panel-heading">Departemen Member</div>
                  <div class="panel-body">
                     <table class="table table-striped table-hover compact" id="tableMember">
                        <thead>
                           <tr>
                              <th></th>
                              <th>Id</th>
                              <th>Nama</th>
                           </tr>
                        </thead>
                     </table>
                     <hr />
                     <!-- <div class="form-inline"> -->
                        <div class="form-group">
                           <button class="btn btn-primary btn-sm" style="margin-top: 0px; margin-right: 10px;" id="btnAddMember" disabled>
                              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                           </button>
                           <button class="btn btn-primary btn-sm" style="margin-top: 0px; margin-right: 10px;" id="btnEditMember" disabled>
                              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                           </button>
                        </div>
                        <input type="hidden" id="idMember" />
                        <div class="form-group" style="margin-right: 10px;">
                           <label for="namaDepartemen">Nama:</label>
                           <input type="text" class="form-control input-sm memberControl" id="namaMember" />
                        </div>
                        <div class="form-group" style="margin-right: 10px;">
                           <button class="btn btn-success" style="margin-top: 0px;" id="btnSaveMember" disabled>Save</button>
                           <button class="btn btn-default" style="margin-top: 0px;" id="btnCancelMember" disabled>Cancel</button>
                        </div>
                     <!-- </div> -->
                  </div>

               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script src="assets/js/select2.min.js"></script>

<script>
   
   $(document).ready(function(){
      var selectedData = null;
      var selectedRowTableDepartmentCount = 0;
      var selectedRowTableMemberCount = 0;
      var idDepartment = '';
      var idMember = '';
      var mode = "";

      var tableDepartment = $('#tableDepartment').DataTable({
         keys: true,
         destroy: true,
         paging: false,
         searching: false,         
         autoWidth: true,
         fixedColumns: true,
         responsvie: true,
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
         // order: [[1, 'desc']],
         select: {
            style: 'single'
         }         
      });

      var tableMember = $('#tableMember').DataTable({
         destroy: true,
         paging: false,
         searching: false,
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
         // order: [[1, 'desc']],
         select: {
            style: 'single'
         }         
      });

      toggleDepartmentControls();
      toggleMemberControls();

      loadAllDepartment();
      function loadAllDepartment(){
         $.ajax({
            type: 'GET',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_getAllDepartment'
            }
         }).done(function(response){
            tableDepartment.clear().draw();
            if(response.length > 0){
               for(let x = 0; x < response.length; x++){
                  let num = x +1;
                  tableDepartment.row.add([
                     num,
                     response[x].id,
                     response[x].namaDepartemen,
                     response[x].descDepartemen ?? "-"
                  ]).draw();
               }

               // let selectedRow = tableDepartment.row(0).select();
               // selectedData = selectedRow.data();
               // idDepartemen = selectedData[1];
               // fillDepartmentControls(selectedData);
               
               // loadMemberDepartment(idDepartemen);
            }
         });
      }
      
      function fillDepartmentControls(selData){
         $('#namaDepartemen').val(selData[2]);
         $('#descDepartemen').val(selData[3]);
      }

      function loadMemberDepartment(idDept){
         $.ajax({
            type: 'GET',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_getMemberByIdDepartment',
               'param': {'id': idDept}
            }
         }).done(function(rsp){
            tableMember.clear().draw();
            if(rsp.length > 0){
               $.each(rsp, function(i, itm){
                  tableMember.row.add([
                     i+1,
                     itm.id,
                     itm.Nama
                  ]).draw();
               })
            }
         })
      }

      $('#tableDepartment tbody').on('click', 'tr', function(){
         if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedRowTableDepartmentCount = 0;
         }
         else {
            tableDepartment.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedRowTableDepartmentCount = 1;
         }

         $('#btnEditDepartment').prop('disabled', !selectedRowTableDepartmentCount > 0);
         if(selectedRowTableDepartmentCount > 0){
            let rowData = tableDepartment.row($(this)).data();
            idDepartment = rowData[1];
            fillDepartmentControls(rowData);
            loadMemberDepartment(idDepartment);
            $('#btnAddMember').prop('disabled', false);
            
            $('#btnCancelDepartment').prop('disabled', false);
            $('#btnAddDepartment').prop('disabled', true);
         }else{
            $('#btnCancelDepartment').trigger('click');
         }
      });

      function toggleDepartmentControls(){
         $('.departmentControl').prop('disabled', function(i, val){
            return !val;
         });
      }

      function toggleMemberControls(){
         $('.memberControl').prop('disabled', function(i, val){
            return !val;
         });
      }

      $('#btnAddDepartment').click(function(){
         $('#btnEditDepartment').prop('disabled', true);
         mode = "Add";
         toggleDepartmentControls();
         clearDepartmentControls();
         $('#namaDepartemen').focus();
         $(this).prop('disabled', true);
         $('#tableDepartment').addClass("disabled-table");
         $('#btnCancelDepartment').prop('disabled', false);
      });

      $('#btnEditDepartment').click(function(){
         mode = 'Edit';
         toggleDepartmentControls();
         $('#btnSaveDepartment').prop('disabled', false);
      });

      function clearDepartmentControls(){
         $('#namaDepartemen').val('');
         $('#descDepartemen').val('');
      }

      $('#namaDepartemen').change(function(){
         setDepartmentValidation();
      });

      function setDepartmentValidation(){
         let namaVal = $('#namaDepartemen').val();
         $('#btnSaveDepartment').prop('disabled', namaVal == '');
      }

      $('#btnCancelDepartment').click(function(){
         $('#btnAddDepartment').prop('disabled', false);
         tableMember.clear().draw();
         idDepartment = '';
         clearDepartmentControls();
         $('#btnCancelDepartment').prop('disabled', true);
         $('#namaDepartemen').prop('disabled', true);
         $('#descDepartemen').prop('disabled', true);

         $('#btnSaveDepartment').prop('disabled', true);
         $('#btnEditDepartment').prop('disabled', true);
         // tableDepartment.rows().deselect();
         $('#tableDepartment tbody tr').removeClass('selected');
         $('#btnAddMember').prop('disabled', true);
         $('#tableDepartment').removeClass("disabled-table");
      });

      $('#btnSaveDepartment').click(function(){
         switch(mode){
            case 'Add':
               addDepartment();
               break;
            case 'Edit':
               let dataDepartemen = {
                  'id' : idDepartment,
                  'namaDepartemen': $('#namaDepartemen').val(),
                  'descDepartemen': $('#descDepartemen').val(),
               }
               updateDepartment(dataDepartemen);
               break;
         }
      });

      function addDepartment(){
         let dataDepartment = {
            'namaDepartemen': $('#namaDepartemen').val(),
            'descDepartemen': $('#descDepartemen').val()
         };

         $.ajax({
            type: 'POST',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data:{
               'action': 'ajax_PostDepartment',
               'param': {
                  'dataDepartment': dataDepartment
               }
            }
         }).done(function(id){
            if(id > 0){
               Swal.fire({
                  title: 'success',
                  text: 'Data departemen berhasil di tambahkan',
                  type: 'success',
                  onAfterClose: () => {
                     // clearDepartmentControls();
                     // loadAllDepartment();
                     // toggleDepartmentControls();
                     $('#btnCancelDepartment').trigger('click');
                     $('#tableDepartment').removeClass('disabled-table');
                  }                  
               })               
            }
         });
      }

      function updateDepartment(dt){
         $.ajax({
            type: 'POST',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data:{
               'action': 'ajax_UpdateDepartment',
               'param': {
                  'dataDepartemen': dt
               }
            }
         }).done(function(id){
            if(id > 0){
               Swal.fire({
                  title: 'success',
                  text: 'Data departemen berhasil di update',
                  type: 'success',
                  onAfterClose: () => {
                     // clearDepartmentControls();
                     // toggleDepartmentControls();
                     // loadAllDepartment();
                     $('#btnCancelDepartment').trigger('click');
                  }                  
               });
            }
         })
      }
      
      // Member area
      $('#tableMember tbody').on('click', 'tr', function(){
         if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedRowTableMemberCount = 0;
         }
         else {
            tableMember.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedRowTableMemberCount = 1;
         }

         $('#btnEditMember').prop('disabled', !selectedRowTableMemberCount > 0);
         if(selectedRowTableMemberCount > 0){
            let rowData = tableMember.row($(this)).data();
            idMember = rowData[1];
            $('#namaMember').val(rowData[2]);
            $('#btnCancelMember').prop('disabled', false);
            $('#btnAddMember').prop('disabled', true);
         }else{
            $('#btnCancelMember').trigger('click');
         }
      });

      $('#btnCancelMember').click(function(){
         $('#btnAddMember').prop('disabled', false);
         idMember = '';
         $('#namaMember').val('');
         $('#btnCancelmember').prop('disabled', true);
         $('#namaMember').prop('disabled', true);

         $('#btnSaveMember').prop('disabled', true);
         $('#btnEditMember').prop('disabled', true);
         // tableDepartment.rows().deselect();
         $('#tableMember tbody tr').removeClass('selected');
      });

      $('#btnEditMember').click(function(){
         mode = 'Edit';
         $('#namaMember').prop('disabled', false);
         $('#btnSaveMember').prop('disabled', false);
      });

      $('#btnAddMember').click(function(){
         $('#btnEditMember').prop('disabled', true);
         mode = "Add";
         $('#namaMember').prop('disabled', false);
         $('#namaMember').val('');
         $('#namaMember').focus();
         $(this).prop('disabled', true);
         $('#btnCancelMember').prop('disabled', false);
         $('#tableMember').addClass('disabled-table');
      });
      
      $('#btnSaveMember').click(function(){
         switch(mode){
            case 'Add':
               addMember();
               break;
            case 'Edit':
               let dataMember = {
                  'id' : idMember,
                  'Nama': $('#namaMember').val(),
               }
               updateMember(dataMember);
               break;
         }
      });
      
      function updateMember(dtMember){
         $.ajax({
            type: 'POST',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_UpdateMemberDepartment',
               'param': {
                  'dataMember': dtMember
               }
            }
         }).done(function(id){
            if(id){
               Swal.fire({
                  title: 'success',
                  text: 'Data member berhasil di update',
                  type: 'success',
                  onAfterClose: () => {
                     loadMemberDepartment(idDepartment);
                     $('#btnCancelMember').trigger('click');
                     $('#tableMember').removeClass('disabled-table');
                  }                  
               });               
            }
         })
      }

      function addMember(){
         let dataMember = {
            'idDepartemen': idDepartment,
            'namaMember': $('#namaMember').val()
         }
         $.ajax({
            type: 'POST',
            url: 'functions/ajax_functions_handler.php',
            dataType: 'JSON',
            data: {
               'action': 'ajax_PostMemberDepartment',
               'param': {
                  'dataMember': dataMember
               }
            }
         }).done(function(id){
            if(id > 0){
               Swal.fire({
                  title: 'success',
                  text: 'Data member berhasil di update',
                  type: 'success',
                  onAfterClose: () => {
                     loadMemberDepartment(idDepartment);
                     $('#btnCancelMember').trigger('click');
                     $('#tableMember').removeClass('disabled-table');
                  }                  
               });
            }
         })
      }

      $('#namaMember').change(function(){
         setMemberValidation();
      });

      function setMemberValidation(){
         let namaMemberVal = $('#namaMember').val();
         $('#btnSaveMember').prop('disabled', namaMemberVal == '');
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