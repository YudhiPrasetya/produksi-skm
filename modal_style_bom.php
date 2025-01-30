<?php require_once 'core/init.php'; 
    $keterangan = $_POST['keterangan'];
?>
<!-- body modal -->
<div class="modal-body">
        <form name="modal_popup"  enctype="multipart/form-data" method="post">
      
        <table border="1px" id="lookup" class="table table-striped table-hover table-bordered modal_bom" style="font-size: 13px">
          <thead>
            <tr>
              <th class="tengah theader" width=5%>NO</th>
              <th class="tengah theader">STYLE</th>
              <th class="tengah theader">DESCRIPTION</th>
              <th class="tengah theader">BOM</th>
              <!-- <th class="tengah theader">QTY ORDER</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
              $no=1;
              $data2 = tampilkan_master_style_bom($keterangan);
              while($row=mysqli_fetch_assoc($data2))
              {
            ?>
            <tr class="pilih" data-style="<?= $row['style']; ?>" data-id="<?= $row['id_style']; ?>" data-description="<?= $row['description']; ?>" data-dismiss="modal">
              <td class="tengah"><?= $no; ?></td>
              <td class="tengah"><?= $row['style']; ?></td>
              <td class="tengah"><?= $row['description']; ?></td>
              <td class="tengah"><?= $row['keterangan']; ?></td>
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
    </div>

    <script type="text/javascript">
	$(document).ready(function(){
		$('.modal_bom').DataTable();
	});

</script>