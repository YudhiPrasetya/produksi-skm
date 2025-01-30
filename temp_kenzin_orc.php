<?php

require_once 'core/init.php';
$style = $_POST['style'];
$no_po = $_POST['no_po'];
$costomer = $_POST['costomer'];
?>


<form name="modal_popup"  enctype="multipart/form-data" method="post">
      
        <table border="1px" id="example" class="table table-striped table-hover table-bordered display" style="font-size: 13px; width: 100%">
          <thead>
            <tr>
              <th style="background: #0000FF">NO</th>
              <th style="background: #0000FF; text-align: center">COSTOMER</th>
              <th style="background: #0000FF; text-align: center">ORC</th>
              <th style="background: #0000FF; text-align: center">NO PO</th>
              <th style="background: #0000FF; text-align: center">STYLE</th>
              <th style="background: #0000FF; text-align: center">LABEL</th>
              <th style="background: #0000FF; text-align: center">COLOR</th>
              <th style="background: #0000FF; text-align: center">ORDER</th>
              <th style="background: #0000FF; text-align: center">BAL</th>
              <!-- <th class="tengah theader">BALANCE</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
              $no=1;
              $shipment = tampilkan_master_order_barcode_buyer_kenzin($style, $no_po, $costomer);
              while($row=mysqli_fetch_assoc($shipment))
              {
            ?>
            <tr class="pilih" data-order="<?= $row['orc']; ?>" data-po="<?= $row['no_po']; ?>" data-label="<?= $row['label']; ?>" data-style="<?= $row['style']; ?>" data-color="<?= $row['color']; ?>" data-qtykarton="<?= $row['qty_karton']; ?>" data-costomer="<?= $row['costomer']; ?>" data-dismiss="modal">
              <td class="tengah"><?= $no; ?></td>
              <td class="tengah"><?= $row['costomer']; ?></td>
              <td class="tengah"><?= $row['orc']; ?></td>
              <td class="tengah"><?= $row['no_po']; ?></td>
              <td class="tengah"><?= $row['style']; ?></td>
              <td class="tengah"><?= $row['label']; ?></td>
              <td class="tengah"><?= $row['color']; ?></td>
              <td class="tengah"><?= $row['qty_order']; ?></td>
              <td class="tengah"><?= $row['balance']; ?></td>
               <!-- <td class="tengah"> -->
              <!-- <?php
              // $sql = tampilkan_balance_order_lookup_orc($row['id_order']);
              // while($row2=mysqli_fetch_assoc($sql))
              // {
              //   echo $row2['size']." : ".$row2['balance'].", ";
              // }
              ?> -->
              <!-- </td> -->
            </tr>
              <?php
                $no++;
                }
              ?>
            </tbody>  
          </table> 
             
      <div class="modal-footer">
        <input name="tambah" type="button" value="Close" id="button" class="btn btn-success" data-dismiss="modal"/>     
        </form>    
      </div>       

    
<script type="text/javascript">
  $(document).on('click', '.pilih', function (e) {
    document.getElementById("orc").value = $(this).attr('data-order');
    document.getElementById("orc2").value = $(this).attr('data-order');
    document.getElementById("no_po").value = $(this).attr('data-po');
    document.getElementById("label").value = $(this).attr('data-label');
    document.getElementById("color").value = $(this).attr('data-color');
	document.getElementById("style").value = $(this).attr('data-style');
    document.getElementById("qty_karton").value = $(this).attr('data-qtykarton');
    document.getElementById("qty_karton2").value = $(this).attr('data-qtykarton');
    document.getElementById("costomer").value = $(this).attr('data-costomer');
    $('#myModal').modal('hide');
  });
			

// tabel lookup mahasiswa
$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#example thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#example thead');
 
    var table = $('#example').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });
});


</script>

