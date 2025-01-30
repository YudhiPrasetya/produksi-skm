<style>
      ul.list-unstyled{
        background-color:#eee;
        cursor:pointer;
        position: absolute;
        width: 93%;
        padding-left:40px;
        z-index: 2;
      }
      li.orc{
        padding:7px;
        border:thin solid #F0F8FF;
        z-index: 2;
        padding-left:30px;
      }
      li.orc:hover{
        background-color:#1E90FF;
        z-index: 2;
        padding-left:30px;
      }

      
  hr {
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    border-style: inset;
    border-width: 1px;
    border-color:blue;
    }
    
</style>




<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

  <?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'packing' ) {
  ?>

<style>
  hr {
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    border-style: inset;
    border-width: 1px;
    border-color:blue;
    }    
</style>

<center>
<h2>CETAK LAPORAN PACKING</h2>

<h3 align="left">Cetak Per ORC</h3>
</center>
<br>
<form action="laporan-packing-orc.php" method="POST">
<div class="row">
 <div class="col-sm-3" >
 <font color="blue"><b>Pilih ORC</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-edit"></i>
   </div>
   <input type="text" name="orc" id="orc" class="form-control" onkeyup="this.value.toUpperCase()" placeholder="Tulis No ORC" />
 </div>
 <div id="orcList"></div>
</div>

 <div class="col-sm-3">
 <font color="blue"><b>No PO</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" id="no_po" class="form-control" disabled />
 </div>
</div>


 <div class="col-sm-2">
 <font color="blue"><b>LABEL</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-list"></i>
   </div>
   <input type="text" id="label" class="form-control" disabled />
 </div>
</div>

<div class="col-sm-2" style="margin-top: 15px">
     <button type="submit" class="btn btn-md btn-success cetak">Cetak / Print</button>
</div>
</form>
</table>

<!-- ================================================================================================= -->
<br><br><br><br>
<hr width="70%"></hr> 
<br><br>
<h3 style="display: inline" align="left">Cetak Laporan MIX ORC === > </h3>
<button class="btn btn-md btn-success cetak"><a href="laporan-packing-orc-mix.php" style="color: white">Cetak / Print</a></button>

<script>  
  $(document).ready(function(){  
    $('#orc').keyup(function(){  
      var query = $(this).val();  
      if(query != ''){  
        $.ajax({  
          url:"search-orc-packing.php",  
          method:"POST",  
          data:{query:query},  
          success:function(data){  
            $('#orcList').fadeIn();  
            $('#orcList').html(data);  
          }  
        });  
      }   
    });  
      
    $(document).on('click', 'li.orc', function(){  
      $('#orc').val($(this).text());  
      $('#orcList').fadeOut();  
      var orc = $("#orc").val();
        $.ajax({
          url: 'proses-orc-po-label.php',
          data:"orc="+orc ,
          }).success(function (data) {
          // console.log(data);
          var json = data,
               obj = JSON.parse(json);
            $('#no_po').val(obj.no_po);
            $('#label').val(obj.label);
        });
      });  
    });  
 </script>

<script type="text/javascript">
  $('#orc').on('keyup',function(){
  var orc = $("#orc").val();
    $.ajax({
      url: 'proses-orc-po-label.php',
     data:"orc="+orc ,
    }).success(function (data) {
      // console.log(data);
      var json = data,
      obj = JSON.parse(json);
      $('#no_po').val(obj.no_po);
      $('#label').val(obj.label);
    });
  });
</script>

</div>
<!-- validasi level user -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>
