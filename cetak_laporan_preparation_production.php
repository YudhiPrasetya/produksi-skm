<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->


  
<style>
  hr {
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    border-style: inset;
    border-width: 1px;
    border-color:blue;
    }
    
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
  
  </style>
  </div>
<center>

<h3>PREPARATION PRODUCTION</h3>
</center><br>
 

    
<div style="margin: 10px">

<div class="col-sm-2">
 <font color="blue"><b>PILIH BUYER</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <select id="costomer" class="form-control ganti" name="costomer" required>
     <option value="">- Pilih Costomer -</option>
       <?php
       $costomer = tampilkan_master_costomer();
       while($pilih = mysqli_fetch_assoc($costomer)){
       echo '<option value='.$pilih['costomer'].'>'.$pilih['costomer'].'</option>';

       }
       ?>
     </select>
 </div>
</div>

<div class="col-sm-2">
 <font color="blue"><b>CATEGORY ITEMS</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <select id="category" class="form-control ganti" name="category" required>
     <option value="">- Category -</option>
     <option value="UNDERWEAR">UNDERWEAR</option>
     <option value="OUTERWEAR">OUTERWEAR</option>
     </select>
 </div>
</div>

<div class="col-sm-2">
 <font color="blue"><b>NO ORC</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-edit"></i>
   </div>
   <input type="text" name="orc" class="form-control ganti" placeholder="ORC"  id="orc">
   <!-- <input type="text" name="orc" id="orc2" hidden> -->
 </div>
 </div>
 
 <div class="col-sm-2">
 <font color="blue"><b>NO PO</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" name="po" class="form-control ganti" placeholder="INPUT PO NUMBER"  id="po">
 </div>
</div>

<div class="col-sm-2">
 <font color="blue"><b>Style</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-list-alt"></i>
   </div>
   <input type="text" name="style" class="form-control ganti" placeholder="INPUT STYLE"  id="style">
 </div>
</div>
</div>

<div class="col-sm-2">
 <font color="blue"><b>STATUS</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <select id="status" class="form-control ganti" name="status" required>
     <option value="open" selected>OPEN</option>
     <option value="close">CLOSE</option>
     </select>
 </div>
</div>

</div>
<br><br><br>
<div id="tampil_tabel"></div>


<script type="text/javascript">
    $('.ganti').on('change',function(){
    var category = $('#category').val();
    var orc = $('#orc').val();
    var style = $('#style').val();
    var po = $('#po').val();
    var costomer = $('#costomer').val();
    var status = $('#status').val();
    console.log(category);
    var url = "tampil_laporan_preparation_production.php?category="+category+"&orc="+orc+"&style="+style+"&status="+status+"&costomer="+costomer+"&po="+po+"&layar=laptop";
    console.log(url);
    $('#tampil_tabel').load(url);
  });

$(document).ready(function(){
    var category = $('#category').val();
    var orc = $('#orc').val();
    var style = $('#style').val();
    var po = $('#po').val();
    var costomer = $('#costomer').val();
    var status = $('#status').val();
    var url = "tampil_laporan_preparation_production.php?category="+category+"&orc="+orc+"&style="+style+"&status="+status+"&costomer="+costomer+"&po="+po+"&layar=laptop";
    console.log(url);
    $('#tampil_tabel').load(url);
});
</script>



</body>
</html>
