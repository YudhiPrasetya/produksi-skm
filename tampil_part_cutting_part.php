<?php
  require_once 'core/init.php';
  $id_order = $_GET['id'];

  ?>
<!-- <input type="hidden" value="<?= $id_order; ?>" id="id"> -->
<br>
 <div id="row">
  
  <div class="col-sm-6">
    <font color="blue"><b>PART ORC SEARCH :</font><br></b>
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
      <font color="blue"><b>PART ORC TERPILIH :</font><br></b>
      <div class="input-group">
       <div class="input-group-addon">
       <i class="glyphicon glyphicon-search"></i>
       </div>
     <input type="text" name="search_part2" class="form-control" placeholder="SEARCH PART"  id="search_part2">
    </div>
    <div id="search_part_table2"></div>
  
</div>
<script type="text/javascript">
    $(document).ready(function(){
		    var id_order = $('#id_order').val();
        var Ambilsearch1 = $('#search_part1').val();
        var search1 = Ambilsearch1.replace(' ', '+');
        var Ambilsearch2 = $('#search_part2').val();
        var search2 = Ambilsearch2.replace(' ', '+');
        url4 = "tampil_part_cutting_orc_part.php?id="+id_order+"&search1="+search1+"&search2="+search2;
         $('#search_part_table1').load(url4);
         url5 = "tampil_part_cutting_orc_part2.php?id="+id_order+"&search1="+search1+"&search2="+search2;
         $('#search_part_table2').load(url5);
	});

  $('#search_part1').on('keyup',function(){
       var Ambilsearch1 = $(this).val();
       var search1 = Ambilsearch1.replace(' ', '+');
       var Ambilsearch2 = $('#search_part2').val();
       var search2 = Ambilsearch2.replace(' ', '+');
       var id_order = $('#id_order').val();
        
        url6 = "tampil_part_cutting_orc_part.php?id="+id_order+"&search1="+search1+"&search2="+search2;
          $('#search_part_table1').load(url6);
    });

    $('#search_part2').on('keyup',function(){
       var Ambilsearch1 = $('#search_part1').val();
       var search1 = Ambilsearch1.replace(' ', '+');
       var Ambilsearch2 = $(this).val();
       var search2 = Ambilsearch2.replace(' ', '+');
       var id_order = $('#id_order').val();
        url7 = "tampil_part_cutting_orc_part2.php?id="+id_order+"&search1="+search1+"&search2="+search2;
          $('#search_part_table2').load(url7);
    }); 

</script>