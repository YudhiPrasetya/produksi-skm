<?php
  require_once 'core/init.php';
  $id_order = $_GET['id'];

  ?>
  <input type="hidden" value="<?= $id_order; ?>" id="id">

  <center>
  <?php if(cek_temp_part_cutting_id_order($id_order) != 0){ ?>
    <button style="margin-right:15px"  type="button" id="simpan_temp" class="btn btn-danger" ><i class="glyphicon glyphicon-refresh"></i> PERBARUI DATA TEMP </button>
    <button style="margin-right:15px" type="button" id="tampil_temp" class="btn btn-warning" ><i class="glyphicon glyphicon-fullscreen"></i> TAMPIL DATA TEMP </button>
    <?php }else{ ?>
    <button  type="button" id="simpan_temp" class="btn btn-danger" ><i class="glyphicon glyphicon-save"></i> SIMPAN DATA TEMP </button>
    <?php } ?>
   
</center>
<br>
 <div id="row">
  
  <div class="col-sm-3">
    <div class="col-sm-6">
    <font color="blue"><b>SIZE SEARCH :</font><br></b>
     <div class="input-group">
       <div class="input-group-addon">
       <i class="glyphicon glyphicon-search"></i>
       </div>
     <input type="text" name="search_size" class="form-control search_size1" placeholder="SIZE"  id="search_size1">
    </div>
    </div>
    <div class="col-sm-6">
    <font color="blue"><b>FILTER CUP :</font><br></b>
     <div class="input-group">
       <div class="input-group-addon">
       <i class="glyphicon glyphicon-search"></i>
       </div>
     <input type="text" name="search_cup" class="form-control search_size1" placeholder="CUP"  id="search_cup1">
    </div>
  </div>
  <br><br><br>
  <div id="search_size_table1"></div>
</div>

<div class="col-sm-5">
    <div class="col-sm-6">
    <font color="blue"><b>SIZE SEARCH :</font><br></b>
     <div class="input-group">
       <div class="input-group-addon">
       <i class="glyphicon glyphicon-search"></i>
       </div>
     <input type="text" name="search_size" class="form-control search_size2" placeholder="SEARCH SIZE"  id="search_size2">
    </div>
    </div>
    <div class="col-sm-6">
    <font color="blue"><b>FILTER CUP :</font><br></b>
     <div class="input-group">
       <div class="input-group-addon">
       <i class="glyphicon glyphicon-search"></i>
       </div>
     <input type="text" name="search_cup" class="form-control search_size2" placeholder="FILTER CUP"  id="search_cup2">
    </div>
  </div>
  <br><br><br>
  <div id="search_size_table2"></div>
</div>

<div class="col-sm-4">

      <font color="blue"><b>PART ORC TERPILIH :</font><br></b>
      <div class="input-group">
       <div class="input-group-addon">
       <i class="glyphicon glyphicon-search"></i>
       </div>
     <input type="text" class="form-control" placeholder="SEARCH PART"  id="search_part3">
    </div>
    <div id="search_part_table3"></div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
		var id_order = $('#id').val();
        var AmbilSize1 = $('#search_size1').val();
        var searchSize1 = AmbilSize1.replace(' ', '+');
        var AmbilCup1 = $('#search_cup1').val();
        var searchCup1 = AmbilCup1.replace(' ', '+');
        var AmbilSize2 = $('#search_size2').val();
        var searchSize2 = AmbilSize2.replace(' ', '+');
        var AmbilCup2 = $('#search_cup2').val();
        var searchCup2 = AmbilCup2.replace(' ', '+');
        var Ambilsearch3 = $('#search_part3').val();
        var search3 = Ambilsearch3.replace(' ', '+');
        var layer = $('#jmlh_layer').val();
        
         url10 = "tampil_part_cutting_orc_size.php?id="+id_order+"&size1="+searchSize1+"&cup1="+searchCup1+"&size2="+searchSize2+"&cup2="+searchCup2;
         $('#search_size_table1').load(url10);
         url11 = "tampil_part_cutting_orc_size2.php?id="+id_order+"&size1="+searchSize1+"&cup1="+searchCup1+"&size2="+searchSize2+"&cup2="+searchCup2+"&layer="+layer;
         $('#search_size_table2').load(url11);
         url12 = "tampil_part_cutting_orc_size_part.php?id="+id_order+"&search3="+search3;
         $('#search_part_table3').load(url12);
	});

    
  $('.search_size1').on('keyup',function(){

       var AmbilSize1 = $('#search_size1').val();
       var searchSize1 = AmbilSize1.replace(' ', '+');
       var AmbilCup1 = $('#search_cup1').val();
       var searchCup1 = AmbilCup1.replace(' ', '+');
       var id_order = $('#id_order').val();

        url13 = "tampil_part_cutting_orc_size.php?id="+id_order+"&size1="+searchSize1+"&cup1="+searchCup1;
          $('#search_size_table1').load(url13);
    });

    $('.search_size2').on('keyup',function(){

        var AmbilSize2 = $('#search_size2').val();
        var searchSize2 = AmbilSize2.replace(' ', '+');
        var AmbilCup2 = $('#search_cup2').val();
        var searchCup2 = AmbilCup2.replace(' ', '+');
        var id_order = $('#id_order').val();
        var layer = $('#jmlh_layer').val();
        url14 = "tampil_part_cutting_orc_size2.php?id="+id_order+"&size2="+searchSize2+"&cup2="+searchCup2+"&layer="+layer;
        $('#search_size_table2').load(url14);
    });

    $('#search_part3').on('keyup',function(){
       var Ambilsearch3 = $(this).val();
       var search3 = Ambilsearch3.replace(' ', '+');
       var id_order = $('#id_order').val();
        
        url6 = "tampil_part_cutting_orc_size_part.php?id="+id_order+"&search3="+search3;
          $('#search_part_table3').load(url6);
    });


    $('#simpan_temp').on('click',function(){
    var yakin = confirm("Anda Yakin Akan Menyimpan atau Memperbarui data Transaksi Ini ?");
    if (yakin) {
       var id_order = $('#id_order').val();
       var layer = $('#jmlh_layer').val();
       var tgl_potong = $('#tgl_potong').val();
       $.ajax({
        method: "POST",
        url: "proses_part_cutting.php",
        data: { id_order : id_order,
              layer : layer,
            type : "save_temp_part"
        },
        success: function(data){
          url15 = "tampil_part_cutting.php?id="+id_order+"&tanggal="+tgl_potong;
          console.log(data.trim());
            if(data.trim() == "success"){ 
              document.getElementById("jmlh_layer").disabled = true;
                alert("Data Berhasil disimpan");
                $('#tampil_tabel').load(url15);
              }else if(data.trim() == "part_kosong"){
                alert("Gagal, PART masih belum di pilih");
            }else if(data.trim() == "size_kosong"){
                alert("Gagal, SIZE belum dipilih");
            }else if(data.trim() == "rasio_kosong"){
                alert("Gagal, Rasio masih ada yang 0 nilainya");
            }
        }
        });
        }
    });

    $('#tampil_temp').on('click',function(){
      var tgl_potong = $('#tgl_potong').val();
      var id_order = $('#id_order').val();
      url15 = "tampil_part_cutting.php?id="+id_order+"&tanggal="+tgl_potong;
      $('#tampil_tabel').load(url15);
    });

</script>



