<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'kenzin' OR 
cek_status($_SESSION['username'] ) == 'kenzin2' OR 
cek_status($_SESSION['username'] ) == 'kenzin3' ) {
  ?>

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
</style>
</div>
<div style="margin: 0 30px">
<center>
<h2>Transaksi Adjuzt Stok</h2>
<div style="height:55px;">
                 <?php
                    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                    echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
                    }
                    $_SESSION['pesan'] = '';
                ?>
            </div>
</center>
<div class="row">
 <div class="col-sm-3">
 <font color="blue"><b>Dari ORC</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <input type="text" name="orc" id="orc" class="form-control" onkeyup="this.value = this.value.toUpperCase()" placeholder="Tulis No ORC" />
 </div>
 <div id="orcList"></div>
</div>

<div class="col-sm-3">
 <font color="blue"><b>Ke Label</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <select id="ke_label" class="form-control" name="ke_label" required>
     <option value="">--- Pilih Keterangan ---</option>
     <option value="Permak">--- Permak ---</option>
     <option value="Stok Over">--- Stok Over ---</option>
     <option value="Adjuzt Stok">--- Adjuzt Stok ---</option>
     <option value="Salah Kelompok Size">--- Salah Kelompok Size ---</option>
   </select>
 </div>
</div>
 <div class="col-sm-6">
 <font color="blue"><b>Kode Barcode</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-barcode"></i>
   </div>
   <input type="text" class="form-control" placeholder="KODE BARCODE" name="kode_barcode" id="kode_barcode" autofocus required>
 </div>

   <!-- <input type="text" class="form-control" placeholder="KODE BARCODE" name="kode_barcode" id="kode_barcode" autofocus required> -->
   <input type="submit"  name="submit_barcode" value="TAMBAH" id="submit_barcode" hidden>
</div>

</div>

</form>
<!-- <div id="hasil"></div> -->
<div id="tampil_tabel"></div>
<script type="text/javascript">
  $('#kode_barcode').on('change',function(){
    var barcode = $('#kode_barcode').val();
    var orc = $('#orc').val();
    var ke_label = $('#ke_label').val();
    $.ajax({
      method: "POST",
      url: "proses_ganti_label.php",
      data: { isi_barcode : barcode,
        orc : orc,
        to_label   : ke_label
       },
      success: function(data){
        console.log(data.trim());
        if(data.trim() == "success"){
          $('#tampil_tabel').load("tampil_ganti_label.php");
        }else if(data.trim() == "errorDb"){
          alert("Gagal Ada masalah dengan kode barcode");
        }else if(data.trim() == "errorQty"){
          alert("Gagal Qty Sudah 0");
        }else{
          alert("Label Belum dipilih");
        }
      }
    });
    document.getElementById("kode_barcode").value = "";
  });

$(document).ready(function(){
    $('#tampil_tabel').load("tampil_ganti_label.php");
});
</script>

<script>  
  $(document).ready(function(){  
    $('#orc').keyup(function(){  
      var query = $(this).val();  
      if(query != ''){  
        $.ajax({  
          url:"search.php",  
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
    });
  });
</script>


<script src="style/jquery.min.js"></script>
        <script>
            $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
            setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
        </script>

<!-- // penutup hak akses level -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>
