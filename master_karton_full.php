<?php
  require_once 'core/init.php';
  require_once 'view/header.php';

  if( !isset($_SESSION['username']) ){
    echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
    // header('Location: index.php');    
  }
  if(cek_status($_SESSION['username'] ) == 'admin' OR cek_status($_SESSION['username'] ) == 'packing' OR 
    cek_status($_SESSION['username'] ) == 'kenzin' ) {

      $error = '';
      if(isset($_POST['tambah'])){
        $orc = $_POST['orc'];
        // $id_style = $_POST['id_style'];
        $qty_karton = $_POST['qty_karton'];
        $username = $_SESSION['username'];
    
        if(!empty(trim($orc)) && !empty(trim($qty_karton))){
            if(tambah_data_master_qty_karton_full($orc, $qty_karton, $username)){
              $error = "Data Berhasil di simpan";
            }else {
              $error = "Gagal Menyimpan data";
            }
        }else{
          $error = "Ada Data yang masih kosong";
        }
      }
    
      if(isset($_POST['update'])){
        $id   = $_POST['id'];
        $qty_karton = $_POST['qty_karton'];
        $username = $_SESSION['username'];
    
        if(!empty(trim($qty_karton)) ){
          //query data po master
          if(edit_master_qty_karton($id, $qty_karton, $username)){
            $_SESSION['pesan'] = 'Data Berhasil Diedit';
          } else {
            $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
          }
        }else{
          $_SESSION['pesan']='Ada data yang masih kosong, wajib di isi semua';
        }
      }

    }else{
    echo 'Anda tidak memiliki akses kehalaman ini';
  }      
?>

<div class="container-fluid">
  <div class="row">
    <h3 class="text-center">Master Karton Full</h3>
    <div class="row" style="margin-left: 20px; margin-right: 20px">
      <div class="col-xs-12">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title"><strong>Data Master Karton Full (Solid)</strong></h3>
          </div>
          <div class="panel-body">
            <button class="btn btn-success" id="btnCreateNew" style="margin-bottom: 15px;">
              Create New
            </button>
            <table class="bg-info table table-bordered table-striped compact nowrap" id="tableKartonFull" style="width: 100%">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>No</th>
                  <th>PO</th>
                  <th>ORC</th>
                  <th>STYLE</th>
                  <th>COLOR</th>
                  <th>QTY ORDER</th>
                  <th>COSTOMER</th>
                  <th></th>            
                </tr>
              <thead>
            </table>
            <hr />

            <!-- Form -->
            <div class="panel panel-warning" id="panelMasterKarton">
              <div class="panel-heading">
                <h3 class="panel-title" id="lbAccesMode"><strong>Entry Data Master Karton Full</strong></h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-horizontal">
                      <div class="form-group" style="margin-bottom: 4px;">
                        <label for="orc" class="col-sm-3 control-label" style="padding-left: 5px; padding-right: 5px;">ORC</label>
                        <div class="col-sm-8" style="padding-left: 2px;">
                          <input type="text" class="form-control" id="orc" placeholder="Input ORC here...">
                        </div>
                      </div>
                      <div class="form-group" style="margin-bottom: 4px;">
                        <label for="no_po" class="col-sm-3 control-label" style="padding-left: 5px; padding-right: 5px;">PO</label>
                        <div class="col-sm-8" style="padding-left: 2px;">
                          <input type="text" class="form-control" id="no_po" placeholder="PO.." disabled>
                        </div>
                      </div>
                      <div class="form-group" style="margin-bottom: 4px;">
                        <label for="style" class="col-sm-3 control-label" style="padding-left: 5px; padding-right: 5px;">Style</label>
                        <div class="col-sm-8" style="padding-left: 2px;">
                          <input type="text" class="form-control" id="style" placeholder="Style..." disabled>
                        </div>
                      </div>
                      <div class="form-group" style="margin-bottom: 4px;">
                        <label for="color" class="col-sm-3 control-label" style="padding-left: 5px; padding-right: 5px;">Color</label>
                        <div class="col-sm-8" style="padding-left: 2px;">
                          <input type="text" class="form-control" id="color" placeholder="Color..." disabled>
                        </div>
                      </div>
                      <div class="form-group" style="margin-bottom: 4px;">
                        <label for="qty_order" class="col-sm-3 control-label" style="padding-left: 5px; padding-right: 5px;">Qty Order</label>
                        <div class="col-sm-8" style="padding-left: 2px;">
                          <input type="numeric" class="form-control" id="qty_order" placeholder="Qty Order..." disabled>
                        </div>
                      </div>
                    </div>
                  </div>  
                  
                  <div class="col-sm-8">
                    <table id="tableDetailSize" class="table compact nowrap table-bordered table-striped table-hover">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Size</th>
                          <th>Cup</th>
                          <th>Qty</th>
                          <th>Kapasitas Karton</th>
                          <th>Total Karton</th>
                          <th></th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>            
              <div class="panel-footer">
                <button class="btn btn-success" style="margin-top: 0px;" id="btnSave">Save</button>
                <button class="btn btn-default" style="margin-top: 0px;" id="btnClose">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" role="dialog"  id="modalQtyKarton">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>Edit Data Kapasitas Karton</strong></h4>
            </div>
            <div class="modal-body">
              <form id="formModal">
                <div class="form-horizontal">
                  <div class="form-group">
                    <label for="sizeModal" class="col-sm-3 control-label">Size</label>
                    <div class="col-sm-6">
                      <input type="hidden" id="idOrderDetail" />
                      <input type="text" class="form-control" id="sizeModal" disabled />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="cupModal" class="col-sm-3 control-label">Cup</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="cupModal" disabled />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="qty_kartonModal" class="col-sm-3 control-label">QTY</label>
                    <div class="col-sm-6">
                      <input type="numeric" class="form-control" id="qtyModal" disabled />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="qty_kartonModal" class="col-sm-3 control-label">Kapasitas Karton</label>
                    <div class="col-sm-6">
                      <input type="numeric" class="form-control" id="qty_kartonModal" />
                    </div>
                  </div>
                </div>
              </form>
            </div>
            
            <div class="modal-footer">
              <button class="btn btn-info" id="btnSelectedSize">Save untuk 'Size' yang dipilih</button>
              <button class="btn btn-default" id="btnSelectedAllSize">Save untuk semua 'Size'</button>          
              <button class="btn btn-default" id="btnCancel">Batalkan</button>          
            </div>
        </div>
      </div>
    </div>
  </div>  
</div>

</div>

<script>
  var accessMode = "Input";
  var idCostomer;
  var idOrder;
  var tableKartonFull = $('#tableKartonFull').DataTable({
    destroy: true,
    columnDefs: [
      {target: 0, visible: false, searchable: false}
    ]
    // select: {
    //   style: 'single'
    // }
  });
  var tableDetailSize = $('#tableDetailSize').DataTable({
    destroy: true,
    // select: {
    //   style: 'single'
    // },    
    columnDefs: [
      {target: 0, visible: false, searchable: false}
    ]    
  });

  var selectedRowTableDetailSizeData;
  var selectedRowTableDetailSize;

	$(document).ready(function(){
    $('#panelMasterKarton').hide();
    initTable();

    function initTable(){
      $.ajax({
        method: 'GET',
        url: 'functions/ajax_functions_handler.php',
        data: {
          action: 'tampilkanPackingKartonFull'
        },
        dataType: 'json',
        success: function(response){
          tableKartonFull.clear().draw();
          for(var x=0; x < response.length; x++){
            tableKartonFull.row.add([
              response[x].id,
              x+1,
              response[x].no_po,
              response[x].orc,
              response[x].style,
              response[x].color,
              response[x].qty_order,
              response[x].costomer,
              '<div class="btn-group" role="group">'+
              '<button style="margin-top:1px;" type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action '+
              '<span class="caret"></span>'+
              '</button>'+
              '<ul class="dropdown-menu">'+
              // '<li><button class="btn btn-link">Detail</button></li>'+
              `<li><a class="btn btn-link" href="functions/packing_karton_full_qrcode.php?id=${response[x].id}" target="_blank">QRCode</a></li>`+
              `<li><a class="btn btn-link" href="functions/packing_karton_full_daftarkarton.php?id=${response[x].id}" target="_blank">Daftar Karton</a></li>`+
              '<li></li>'+
              '</ul>'+
              '</div>'
            ]).draw();
          }

        },
        error: function(xhr, status, error){
          console.log(status, error);
        }
      });
    }

    $('#btnCreateNew').click(function(){
      accessMode = "Input";
      let accessModeText = $('#lbAccesMode').text();

      $('#lbAccesMode').text(accessModeText + " - " + accessMode + " Data");
      $('#panelMasterKarton').slideDown('slow');
    });

    $('#orc').change(function(){
      let orc = $(this).val();
      if(orc != null || orc != ''){
        tableDetailSize.clear().draw();
        $.ajax({
          method: 'GET',
          url: 'functions/ajax_functions_handler.php',
          dataType: 'json',
          data: {
            action: 'getDetailDataMasterOrderByOrc',
            param: orc
          },
          success: function(response){
            if(response[0].data == "invalid"){
              Swal.fire({
                type: 'warning',
                title: `ORC ${orc} sudah dibuatkan kartonnya!`,
                text: 'Peringatan!',
                onAfterClose: () => {
                  $('#orc').val('');
                }
              });
            }else{
              var qty_order = 0; 
              for(let y = 0; y < response.length-1; y++){
                $('#no_po').val(response[0].style);
                $('#style').val(response[0].style);
                $('#color').val(response[0].color);
                $('#qty_order').val(response[0].qty_order);
                idOrder = response[0].id_order;
                idCostomer = response[0].id_costomer;
                // 
                qty_order += parseInt(response[y].qty);
                tableDetailSize.row.add([
                  response[y].id_order_detail,
                  response[y].size,
                  response[y].cup == (null || "") ? "-" : response[y].cup,
                  response[y].qty,
                  0,
                  0,
                  '<button id="btnEditKarton" class="btn btn-sm btn-success text-center" style="margin-top: 2px; padding: 2px;"><i class="glyphicon glyphicon-edit"></i> Edit Karton</button>'
                ]).draw();
              }
            }
          },
          error: function(xhr, status, error){
            console.log(status, error);
          }
        });
      }
    })

    $('#btnClose').click(function(){
      $('#panelMasterKarton').slideUp('slow');
    });


    $('#tableDetailSize tbody').on('click', '#btnEditKarton', function(){
      selectedRowTableDetailSizeData = tableDetailSize.row($(this).parents('tr')).data();
      selectedRowTableDetailSize = tableDetailSize.row($(this).parents('tr'));

      $('#idOrderDetail').val(selectedRowTableDetailSizeData[0]);
      $('#sizeModal').val(selectedRowTableDetailSizeData[1]);
      $('#cupModal').val(selectedRowTableDetailSizeData[2]);
      $('#qtyModal').val(selectedRowTableDetailSizeData[3]);
      $('#modalQtyKarton').modal('show');
    });

    // $('#tableKartonFull tbody').on('click', '#tampilkanQRCode', function(){
    //   let selectedDataRow = tableKartonFull.row($(this).parents('tr')).data();
    //   let idPacking = selectedDataRow[0];

    //   $.ajax({
    //     type: 'GET',
    //     url: 'functions/ajax_functions_handler.php',
    //     dataType: 'json',
    //     data: {
    //       action: 'cariPackingKartonFullById',
    //       param: idPacking
    //     },
    //     success: function(response){
    //       if(response != null){
    //         $.ajax({
    //           type: 'GET',
    //           url: 'functions/packing_karton_full_qrcode.php',
    //           dataType: 'json',
    //           data: {
    //             param: response
    //           }
    //         });
    //       }
    //     },
    //     error: function(xhr, status, error){
    //       console.log(status, error);
    //     }
    //   })
    // });

    $('#btnSelectedAllSize').click(function(){
      var qty_kartonModal = parseInt($('#qty_kartonModal').val());
      tableDetailSize.rows().every(function(rowIdx, tableLoop, rowLoop){
        let selectedData = this.data();
        let qty = parseInt(selectedData[3]);
        selectedData[4] = qty_kartonModal;
        let kapasitas_karton = parseInt(selectedData[4]);

        let totalKarton = qty/kapasitas_karton;
        selectedData[5] = Math.ceil(totalKarton);
        this.data(selectedData);
        closeModal();
      });

    });

    $('#btnSelectedSize').click(function(){
      var qty_kartonModal = parseInt($('#qty_kartonModal').val());

      let rowIdx = selectedRowTableDetailSize.index();
      let qty = parseInt(selectedRowTableDetailSize.data()[3]);
      selectedRowTableDetailSize.data()[4] = qty_kartonModal;

      let kapasitasKarton = selectedRowTableDetailSize.data()[4];
      let totalKarton = qty/kapasitasKarton;
      selectedRowTableDetailSize.data()[5] = Math.ceil(totalKarton);

      tableDetailSize.row(rowIdx).data(selectedRowTableDetailSize.data());

      closeModal();

    });

    $('#btnCancel').click(function(){
      Swal.fire({
        type: 'warning',
        title: 'Pembatalan Input',
        text: 'Yakin akan membatalkan?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, batalkan'
      }).then((result) => {
        if(result.value){
          closeModal();
        }
      });
    });

    $('#btnSave').click(function(){
      var dataPackingKartonFull = {
        id_order: idOrder,
        id_costomer: idCostomer,
        orc: $('#orc').val(),
        style: $('#style').val(),
        color: $('#color').val()
      };
      $.ajax({
        method: 'POST',
        url: 'functions/ajax_functions_handler.php',
        dataType: 'json',
        data: {
          action: 'simpanPackingKartoFull',
          param: dataPackingKartonFull
        },
        success: function(id){
          // insert packing karton full          
          if(id != null){
            // insert detail packing karton full
            var arrPackingKartonFull = [];
            var tableDetailSizeRows = tableDetailSize.rows();
            for(let z = 0; z < tableDetailSizeRows.count(); z++){
              let dataPackingKartonFull = {
                id_packing_karton_full: id,
                size: tableDetailSize.cell(z, 1).data(),
                cup:  tableDetailSize.cell(z, 2).data(),
                qty: parseInt(tableDetailSize.cell(z, 3).data()),
                kapasitas_karton: parseInt(tableDetailSize.cell(z, 4).data()),
                total_karton: parseInt(tableDetailSize.cell(z, 5).data())
              };
              arrPackingKartonFull.push(dataPackingKartonFull);
            }
            // console.table(arrPackingKartonFull);
            $.ajax({
              method: 'POST',
              url: 'functions/ajax_functions_handler.php',
              dataType: 'json',
              data: {
                action: 'simpanDetailPackingKartoFull',
                param: arrPackingKartonFull
              },
              success: function(response){
                if(response == true){
                  Swal.fire({
                    type: 'info',
                    title: 'Konfirmasi',
                    text: 'Simpan Data Data Packing Karton Full Berhasil',
                    onAfterClose: () => {
                      // $('form')[0].reset();
                      $('#orc').val('');
                      $('#no_po').val('');
                      $('#style').val('');
                      $('#color').val('');
                      $('#qty_order').val('0');
                      tableDetailSize.clear().draw();
                      initTable();
                      $('#orc').focus();
                    }
                  });                  
                }
              },
              error: function(xhr, status, error){
                console.log(status, error);
              }

            })
          }
        },
        error: function(xhr, status, error){
          console.log(status, error);
        }
      });

    });

    
	});
  
  function closeModal(){
    $('form')[0].reset();
    $('#modalQtyKarton').modal('hide');
  }
</script>

</body>
