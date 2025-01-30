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
      ul.list-unstyled{
        background-color:#eee;
        cursor:pointer;
        position: absolute;
        width:25%;
        padding-left:0px;
        z-index: 2;
      }
      li.po{
        padding:7px;
        border:thin solid #F0F8FF;
        z-index: 2;
        padding-left:15px;
      }
      li.po:hover{
        background-color:#1E90FF;
        z-index: 2;
        padding-left:15px;
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

<center>
<h2>CETAK LAPORAN PACKING</h2>

<h3 align="left">Cetak Per Nomer Purchasing Order</h3>
</center>
<br> 
<form action="laporan_packing_po.php" method="POST">
<table width="70%">
<tr>
    <td width="42%" style="margin:10" >
      <font color="blue"><b>No Order</font><br></b>
      <input type="text" name="po" id="po" class="form-control" onkeyup="this.value.toUpperCase()" placeholder="Tulis No Order" required />
      <div id="poList"></div>
    </td>
   <td width="70%" style="padding-top:20px; padding-left: 25px">
     <button type="submit" class="btn btn-md btn-success cetak">Cetak / Print</button>
   </td>
 </tr>
</form>
</table>
<!-- ================================================================================================= -->


</div>

<script>   
  $(document).ready(function(){  
    $('#po').keyup(function(){  
      var query = $(this).val();  
      if(query != ''){  
        $.ajax({  
          url:"search-po-packing.php",   
          method:"POST",  
          data:{query:query},  
          success:function(data){  
            $('#poList').fadeIn();  
            $('#poList').html(data);  
          }  
        });  
      }  
    });  
      
    $(document).on('click', 'li.po', function(){  
      $('#po').val($(this).text());  
      $('#poList').fadeOut(); 
    });
  });
</script>

<!-- validasi level user -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
  
</body>
</html>
