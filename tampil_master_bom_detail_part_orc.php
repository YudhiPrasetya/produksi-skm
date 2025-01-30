<?php
  require_once 'core/init.php';
  $id = $_GET['id']; // id_bom detail 
  $id_order = $_GET['id_order'];

  $sql2 = tampilkan_master_bom_detail_orc_id($id); //
  $data2 = mysqli_fetch_array($sql2);
  

?>
<center>
    <input type="hidden" value="<?= $id; ?>" id="id_bom_detail_orc">
    <input type="hidden" value="<?= $id_order; ?>" id="id_order">
<h4><b>MATERIAL</b><br><?= $data2['material_code'] ?></h4>
<h5><?= $data2['material_name'] ?></h5>
<button class="btn btn-md btn-info cetak" id="reload"><i class="glyphicon glyphicon-refresh"></i> RELOAD</button></center>
<br>

<div id="container-fluid">
<div class="col-sm-6">
  <font color="blue"><b>SEARCH :</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-search"></i>
   </div>
   <input type="text" name="search_part1" class="form-control" placeholder="SEARCH PART"  id="search_part1">
   <!-- <input type="text" name="orc" id="orc2" hidden> -->
 </div>
 <div id="search_part_table1"></div>
</div>
  
  <div class="col-sm-6"
    <font color="blue"><b>SEARCH :</font><br></b>
    <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-search"></i>
     </div>
   <input type="text" name="search_part2" class="form-control" placeholder="SEARCH PART"  id="search_part2">
  </div>
  <div id="search_part_table2"></div>
</div>


</center>

<script type="text/javascript">
  $('#reload').on('click',function(){
       var id = $('#id_bom_detail_orc').val();
       var id_order = $('#id_order').val();
       url2 = "tampil_master_bom_detail_part_orc.php?id="+id+"&id_order="+id_order;
       $('#tampil_tabel').load(url2);

    });   

  $(document).ready(function() {
    var id = $('#id_bom_detail_orc').val();
    var Ambilsearch1 = $('#search_part1').val();
       var search1 = Ambilsearch1.replace(' ', '+');
       var Ambilsearch2 = $('#search_part2').val();
       var search2 = Ambilsearch2.replace(' ', '+');
    var id_order = $('#id_order').val();
    
    url4 = "tampil_master_bom_detail_part_orc_table.php?id="+id+"&id_order="+id_order+"&search1="+search1+"&search2="+search2;
    $('#search_part_table1').load(url4);
     url5 = "tampil_master_bom_detail_part_orc_table2.php?id="+id+"&id_order="+id_order+"&search1="+search1+"&search2="+search2;
     $('#search_part_table2').load(url5);
  });

  $('#search_part1').on('keyup',function(){
       var id = $('#id_bom_detail_orc').val();
       var Ambilsearch1 = $(this).val();
       var search1 = Ambilsearch1.replace(' ', '+');
       var Ambilsearch2 = $('#search_part2').val();
       var search2 = Ambilsearch2.replace(' ', '+');
       var id_order = $('#id_order').val();
        
        url6 = "tampil_master_bom_detail_part_orc_table.php?id="+id+"&id_order="+id_order+"&search1="+search1+"&search2="+search2;
          $('#search_part_table1').load(url6);
    });

    $('#search_part2').on('keyup',function(){
       var id = $('#id_bom_detail_orc').val();
       var Ambilsearch1 = $('#search_part1').val();
       var search1 = Ambilsearch1.replace(' ', '+');
       var Ambilsearch2 = $(this).val();
       var search2 = Ambilsearch2.replace(' ', '+');
       var id_order = $('#id_order').val();
       console.log(search2);
        url7 = "tampil_master_bom_detail_part_orc_table2.php?id="+id+"&id_order="+id_order+"&search1="+search1+"&search2="+search2;
          $('#search_part_table2').load(url7);
    }); 

    

</script>