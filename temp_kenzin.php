
<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');

?>
<link href="assets/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="assets/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
<?php
  if(isset($_SESSION['username'])){
    if(cek_status($_SESSION['username'] ) == 'admin' OR cek_status($_SESSION['username'] ) == 'kenzin' ) {
      $user = $_SESSION['username'];
      $tanggal = date("Y-d-m H:i:s");
?>

<style>
     .modal-dialog{
            width: 1175px;
        }

    thead input {
        width: 100%;
    }
</style>

  
<center>
<h2>TRANSAKSI NEEDLE DETECTOR</h2>
<div style="height:55px;">
  <?php
      if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
      echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
      }
      $_SESSION['pesan'] = '';
  ?>
</div>
</center>
</div>
<div style="margin: 0 30px">
<div class="row">
<div class="col-sm-3">
 <font color="blue"><b>Masukkan ORC</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <!-- <input type="text" name="orc" id="orc" class="form-control" onkeyup="this.value = this.value.toUpperCase()" placeholder="Tulis No ORC" /> -->
   <input type="text" class="form-control pilcek" id="orc2" style="width: 180px; display: inline-block" disabled >
   <input type="hidden" value = <?= $_SESSION['username']; ?> id="user" >
   <input type="hidden" name="orc" class="form-control pilcek" id="orc" >
   <button type="button" class="btn btn-info" id="search_button" style="margin: 0px 0 0 7px;" data-toggle="modal" data-target="#myModal"><b><span class="glyphicon glyphicon-search"></span> Cari</b></button>
 </div>
 <!-- <div id="orcList"></div> -->
</div>

<div class="col-sm-2">
 <font color="blue"><b>COSTOMER</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <input type="checkbox" id="check_costomer" value="pilih_costomer">
   </div>
   <input type="text" id="costomer" class="form-control"  />
 </div>
</div>

<div class="col-sm-2">
 <font color="blue"><b>No PO</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <input type="checkbox" id="check_po" value="pilih_po">
   </div>
   <input type="text" id="no_po" class="form-control"  />
 </div>
</div>

<div class="col-sm-2">
    <font color="blue"><b>STYLE</font><br></b>
    <div class="input-group">
      <div class="input-group-addon">
        <input type="checkbox" id="check_style" value="pilih_style">
      </div>
      <input type="text" class="form-control" id="style" >
    </div>
  </div>

 <div class="col-sm-1">
 <font color="blue"><b>LABEL</font><br></b>
   
   <input type="text" id="label" class="form-control" disabled />

</div>
<div class="col-sm-2">
    <font color="blue"><b>COLOR</font><br></b>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
      </div>
      <input type="text" class="form-control" id="color" disabled>
    </div>
  </div>

<br><br><br>
<div class="col-sm-2">
 <font color="blue"><b>QTY FULL KARTON</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-edit"></i>
     </div>
   <input type="number" class="form-control" placeholder="QTY FULL KARTON" name="qty_karton" id="qty_karton2">
   <input type="hidden"  id="qty_karton">
 </div>
</div>

<div class="col-sm-2">
 <font color="blue"><b>ISI KARTON</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-edit"></i>
     </div>
   <input type="number" class="form-control" placeholder="ISI KARTON" name="isi_karton" id="isi_karton2" required>
   <input type="hidden" id="isi_karton">
 </div>
</div>

<div class="col-sm-3">
 <font color="blue"><b>KELOMPOK KARTON</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-edit"></i>
     </div>
     <select class="form-control pilcek3" name="kelompok" id="kelompok2" >
          <option value="">--- Pilih Kelompok Karton ---</option>
          <option value="full">Full Karton (No Mix)</option>
          <option value="ecer">Isi Karton Tidak Full</option>
          <option value="mix">MIX SIZE</option>
          <!-- <option value="mix_color">Mix Color</option> -->
          <option value="mix_style">Mix Style / Color</option>
        </select>
        <input type="hidden" name="kelompok" id="kelompok">
  </div>
</div>

<div class="col-sm-1" style="margin-top: 20px">
<input id="toggle-event" type="checkbox" data-toggle="toggle" >
</div>

 <div class="col-sm-4">
 <font color="blue"><b>Kode Barcode</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-barcode"></i>
   </div>
   <input type="text" class="form-control" placeholder="KODE BARCODE" name="kode_barcode" id="kode_barcode" autofocus required disabled>
 </div>

   <!-- <input type="text" class="form-control" placeholder="KODE BARCODE" name="kode_barcode" id="kode_barcode" autofocus required> -->
   <input type="submit"  name="submit_barcode" value="TAMBAH" id="submit_barcode" hidden>
</div>

</div>
 

 
<!-- Modal Tambah -->
<div class="modal fade" id="myModal" class="modal-backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>Data Order</b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
      <div class="lihat-data"></div>  
    </div>
  </div>
  </div>            
</div>
<!-- Modal Tambah -->
</form>

<div id="tampil_tabel"></div>

<center>
    
    <br>
    <div>
    
    <INPUT type="submit" class="btn btn-primary" name="kirim" value="SIMPAN DATA" id="kirim" style="margin-right: 30px; margin-top: 20px">
    <!-- <INPUT type="submit" class="btn btn-primary" name="kirim" value="SIMPAN DATA" id="kirim" onclick="return konfirmasi_simpan()" style="margin-right: 40px; margin-top: 20px"> -->
    <!-- <button type="button" name="kirim" class="btn btn-primary" onclick="return konfirmasi_simpan()">SIMPAN</button> -->
    <button type="button" id="reset" class="btn btn-danger"  style="margin-right: 30px;"> RESET DATA</button>
    

    </div>

<script type="text/javascript">


  $('#toggle-event').change(function() {
    
    var cek_toogle = $(this).prop('checked');
    console.log(cek_toogle);
    var kelompok = $('#kelompok2').val();
    var qty_karton2 = $('#qty_karton2').val();
    var isi_karton2 = $('#isi_karton2').val();
    var qty_karton = new Number(qty_karton2);
    var isi_karton = new Number(isi_karton2);
   
    if(cek_toogle == true){
      if(qty_karton == ""){ 
        var audiqty_karton = new Audio('audio/error_qty_carton_kosong.mp3');
        audiqty_karton.play();
        Swal.fire({
                    type: 'error',
                    title: 'Gagal, QTY FULL karton Belum diisi',
                    text: 'Silakan isi dulu Quantity Karton',
                    allowEnterKey: false,  
        });
        $('div.toggle').removeClass('btn-primary');
        $('div.toggle').addClass('btn-default');
        $('div.toggle').addClass('off');
        $('#toggle-event').prop('checked', false);
      }else if(isi_karton == ""){
        var error_qty_isi_karton = new Audio('audio/error_qty_isi_karton.mp3');
        error_qty_isi_karton.play();
        Swal.fire({
                    type: 'error',
                    title: 'Gagal, QTY Isi karton Belum diisi',
                    text: 'Silakan isi dulu Quantity Isi Karton',
                    allowEnterKey: false,  
        });
        $('div.toggle').removeClass('btn-primary');
        $('div.toggle').addClass('btn-default');
        $('div.toggle').addClass('off');
        $('#toggle-event').prop('checked', false);
      }else if(kelompok == ""){
        var gagal_kelompok_kosong = new Audio('audio/gagal_kelompok_kosong.mp3');
        gagal_kelompok_kosong.play();
        Swal.fire({
                  type: 'error',
                  title: 'Gagal, Kelompok karton Belum dipilih',
                  text: 'Silakan Pilih terlebih dulu Kelompok Karton',
                  allowEnterKey: false,  
        });
        $('div.toggle').removeClass('btn-primary');
        $('div.toggle').addClass('btn-default');
        $('div.toggle').addClass('off');
        $('#toggle-event').prop('checked', false);
      }else if(isi_karton > qty_karton){
        var over_qty_isikarton_fullcarton = new Audio('audio/over_qty_isikarton_fullcarton.mp3');
        over_qty_isikarton_fullcarton.play();
        Swal.fire({
                    type: 'error',
                    title: 'Gagal, QTY Isi karton Lebih dari Qty Full Karton',
                    text: 'Silakan QTY Karton',
                    allowEnterKey: false,  
        });
        $('div.toggle').removeClass('btn-primary');
        $('div.toggle').addClass('btn-default');
        $('div.toggle').addClass('off');
        $('#toggle-event').prop('checked', false);

      }else if((isi_karton < qty_karton) && (kelompok == 'full')){
       
        Swal.fire({
                    type: 'error',
                    title: 'Gagal, Kelompok yang di pilih Full Karton tetepi qty Isi Karton kurang dari Full Karton',
                    text: 'Silakan Cek ulang inputan karton',
                    allowEnterKey: false,  
        });
        $('div.toggle').removeClass('btn-primary');
        $('div.toggle').addClass('btn-default');
        $('div.toggle').addClass('off');
        $('#toggle-event').prop('checked', false);

      }else{
          $('#kelompok2').attr('disabled', 'disabled');
          $('#qty_karton2').attr('disabled', 'disabled');
          $('#isi_karton2').attr('disabled', 'disabled');
          $('#kode_barcode').removeAttr('disabled');
          $("#kelompok").val(kelompok);
          $("#qty_karton").val(qty_karton);
          $("#isi_karton").val(isi_karton);
      }
    }else{
          $('#kode_barcode').attr('disabled', 'disabled');
          $('#kelompok2').removeAttr('disabled');
          $('#qty_karton2').removeAttr('disabled');
          $('#isi_karton2').removeAttr('disabled');
    }
  });

  
  $('#kode_barcode').on('change',function(){
    var barcode = $('#kode_barcode').val();
    // var barcode = kodeBarcode.replace(/-/g, "");
    // console.log('barcode', barcode);
    var orc = $('#orc').val();
    var user = $('#user').val();
    var kelompok = $('#kelompok2').val();
    var qty_karton2 = $('#qty_karton2').val();
    var isi_karton2 = $('#isi_karton2').val();
    var qty_karton = new Number(qty_karton2);
    var isi_karton = new Number(isi_karton2);
    
    if(orc == ""){
      var gagal_orc = new Audio('audio/gagal_orc.mp3');
      gagal_orc.play();
      Swal.fire({
                  type: 'error',
                  title: 'Gagal, ORC BELUM DI PILIH',
                  text: 'Silakan isi pilih orc terlebih dahulu',
                  allowEnterKey: false,  
      });
    }else if(qty_karton == ""){ 
      var audiqty_karton = new Audio('audio/error_qty_carton_kosong.mp3');
      audiqty_karton.play();
      Swal.fire({
                  type: 'error',
                  title: 'Gagal, QTY FULL karton Belum diisi',
                  text: 'Silakan isi dulu Quantity Karton',
                  allowEnterKey: false,  
      });
    }else if(isi_karton == ""){
      var error_qty_isi_karton = new Audio('audio/error_qty_isi_karton.mp3');
      error_qty_isi_karton.play();
      Swal.fire({
                  type: 'error',
                  title: 'Gagal, QTY Isi karton Belum diisi',
                  text: 'Silakan isi dulu Quantity Isi Karton',
                  allowEnterKey: false,  
      });
    }else if(isi_karton > qty_karton){
      var over_qty_isikarton_fullcarton = new Audio('audio/over_qty_isikarton_fullcarton.mp3');
      over_qty_isikarton_fullcarton.play();
      Swal.fire({
                  type: 'error',
                  title: 'Gagal, QTY Isi karton Lebih dari Qty Full Karton',
                  text: 'Silakan QTY Karton',
                  allowEnterKey: false,  
      });
    }else{
      if(kelompok == ""){ 
        var gagal_kelompok_kosong = new Audio('audio/gagal_kelompok_kosong.mp3');
        gagal_kelompok_kosong.play();
        Swal.fire({
                  type: 'error',
                  title: 'Gagal, Kelompok karton Belum dipilih',
                  text: 'Silakan Pilih terlebih dulu Kelompok Karton',
                  allowEnterKey: false,  
        });
      }else{
        $.ajax({
          method: "POST",
          url: "proses_kenzin.php",
          data: { isi_barcode : barcode,
                  orc : orc,
                  user : user,
                  type : "scan",
                  kelompok : kelompok, 
                  qty_karton : qty_karton,
                  isi_karton : isi_karton,
          },
          success: function(data){
            console.log(data.trim()); 
            if(data.trim() == "success"){
              $('#tampil_tabel').load("tampil_kenzin.php");
            }else if(data.trim() == "errorDb"){
              alert("Gagal Ada masalah dengan kode barcode");
            }else if(data.trim() == "errorQtyBefore"){
              alert("Gagal Qty Tatami Habis");
            }else if(data.trim() == "errorQtyOrder"){
              var audioQtyOrder = new Audio('audio/qty_order.mp3');
              audioQtyOrder.play();
              Swal.fire({
                  type: 'error',
                  title: 'Gagal, Qty Sudah FULL Order untuk size ini!',
                  text: 'Periksa Kembali Data Order',
                  allowEnterKey: false,  
              });
            }else if(data.trim() == "errorQtyOrder_notsize"){
              var audioNotQtyOrder = new Audio('audio/not_qty_order.mp3');
              audioNotQtyOrder.play();
              Swal.fire({
                  type: 'error',
                  title: 'Gagal, Tidak ada Orderan untuk size ini!',
                  text: 'Periksa Kembali Data Order',
                  allowEnterKey: false,  
              });
            }else if(data.trim() == "color"){
                var audioColor = new Audio('audio/color.mp3');
                audioColor.play();
                Swal.fire({
                  type: 'error',
                  title: 'Gagal, Color master Order berbeda dengan color master barang!',
                  text: 'Periksa kembali barang nya',
                  allowEnterKey: false,  
              });
            }else if(data.trim() == "style"){
                var audioStyle = new Audio('audio/error_style.mp3');
                audioStyle.play();
                Swal.fire({
                  type: 'error',
                  title: 'Gagal, ORC yang dipilih style nya tidak sesuai dengan barang.!',
                  text: 'Periksa kembali barang nya atau pilih orc yg sesuai',
                  allowEnterKey: false,  
                });
            }else if(data.trim() == "error_mix_style"){
                var error_mix_style = new Audio('audio/error_full_mix_style.mp3');
                error_mix_style.play();
                Swal.fire({
                  type: 'error',
                  title: 'Gagal, Style Barang yg discan ini berbeda dari data sebelumnya.!',
                  text: 'Pilih Mix Style jika barangnya memang mix di 1 karton',
                  allowEnterKey: false,  
                });
            }else if(data.trim() == "error_2orc"){
              var error_2orc = new Audio('audio/error_2orc.mp3');
              error_2orc.play();
                Swal.fire({
                  type: 'error',
                  title: 'Gagal, ORC barang yg discan sebelumnya berbeda atau lebih dari 1 orc!',
                  text: 'Pilih Mix Style jika barangnya lebih dari 1 orc utk 1 karton',
                  allowEnterKey: false,  
                });
            }else if(data.trim() == "error_mix_size"){
              var error_mix_size = new Audio('audio/error_mix_size.mp3');
              error_mix_size.play();
                Swal.fire({
                  type: 'error',
                  title: 'Gagal, Barang berbeda size cek kembali barang nya!',
                  text: 'Pilih Mix Size jika barangnya lebih dari 1 size utk 1 karton',
                  allowEnterKey: false,  
                });
            }else if(data.trim() == "error_over_carton"){
              var error_over_carton = new Audio('audio/error_over_carton.mp3');
              error_over_carton.play();
              Swal.fire({
                  type: 'error',
                  title: 'Gagal, QTY lebih dari qty isi full karton ',
                  text: 'Silakan simpan dahulu, kemudian scan lagi',
                  allowEnterKey: false,  
                });
            }else if(data.trim() == "error_over_isi_carton"){
              var error_over_isi_carton = new Audio('audio/error_over_isi_carton.mp3');
              error_over_isi_carton.play();
              Swal.fire({
                  type: 'error',
                  title: 'Gagal, QTY lebih dari qty isi karton ',
                  text: 'Silakan simpan dahulu, kemudian scan lagi',
                  allowEnterKey: false,  
                });
            }else if(data.trim() == "error_buyer"){
              var error_buyer = new Audio('audio/error_buyer.mp3');
              error_buyer.play();
              Swal.fire({
                  type: 'error',
                  title: 'Gagal, Barang yg di scan berbeda kepemilikan buyer',
                  text: 'Silakan Cek terlebih dahulu',
                  allowEnterKey: false,  
              });
            }
          }
        });
      }
    }
    document.getElementById("kode_barcode").value = "";
  });


  $(document).ready(function(){
    $('#tampil_tabel').load("tampil_kenzin.php");
  });

  $('#kirim').on('click',function(){
    var kelompok = $('#kelompok').val();
    var qty_karton2 = $('#qty_karton2').val();
    var isi_karton2 = $('#isi_karton2').val();
    var qty_karton = new Number(qty_karton2);
    var isi_karton = new Number(isi_karton2);
    if(qty_karton == ""){ 
      var audiqty_karton = new Audio('audio/error_qty_carton_kosong.mp3');
      audiqty_karton.play();
      swal("Gagal, QTY FULL karton Belum diisi", "Silakan isi dulu Quantity Karton", "error");
    }else if(isi_karton == ""){
      var error_qty_isi_karton = new Audio('audio/error_qty_isi_karton.mp3');
      error_qty_isi_karton.play();
      Swal.fire({
                  type: 'error',
                  title: 'Gagal, QTY Isi karton Belum diisi',
                  text: 'Silakan isi dulu Quantity Isi Karton',
                  allowEnterKey: false,  
      });
    }else if(isi_karton > qty_karton){
      var over_qty_isikarton_fullcarton = new Audio('audio/over_qty_isikarton_fullcarton.mp3');
      over_qty_isikarton_fullcarton.play();
      Swal.fire({
                  type: 'error',
                  title: 'Gagal, QTY Isi karton Lebih dari Qty Full Karton',
                  text: 'Silakan QTY Karton',
                  allowEnterKey: false,  
      }); 
    }else{
      if(kelompok == ""){ 
        var gagal_kelompok_kosong = new Audio('audio/gagal_kelompok_kosong.mp3');
        gagal_kelompok_kosong.play();
        swal("Gagal, Kelompok karton Belum dipilih", "Silakan Pilih terlebih dulu Kelompok Karton", "error");
      }else{
        swal.fire({
        title: "Anda Yakin ingin Menyimpan hasil scan ini?",
        text: "Data yang disimpan tidak bisa di edit lagi!",
        type: "info",

        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Simpan',
        cancelButtonText: "Cancel",
        showCancelButton: true,
        reverseButtons: false,
      }).then((result) => {
        console.log(result);
        if (result.dismiss !== 'cancel') {
          $.ajax({
            method: "POST",
            url: "proses_kenzin.php",
            data: { type : "simpan",
              kelompok : kelompok,
              qty_karton : qty_karton,
              isi_karton : isi_karton,
            },
            success: function(data){
              console.log(data.trim()); 
              if(data.trim() == "success"){
                swal("Data Berhasil Disimpan!", "Klik Ok untuk melanjutkan!", "success");
                $('#kode_barcode').attr('disabled', 'disabled');
                $('#kelompok2').removeAttr('disabled');
                $('#qty_karton2').removeAttr('disabled');
                $('#isi_karton2').removeAttr('disabled');
                document.getElementById("kelompok").value = "";
                document.getElementById("isi_karton").value = "";
                document.getElementById("kelompok2").value = "";
                document.getElementById("isi_karton2").value = "";
                $('div.toggle').removeClass('btn-primary');
                $('div.toggle').addClass('btn-default');
                $('div.toggle').addClass('off');
                $('#toggle-event').prop('checked', false);
                $('#tampil_tabel').load("tampil_kenzin.php");
              }else if(data.trim() == "over_order"){
                var audioQtyOrder = new Audio('audio/qty_order.mp3');
                audioQtyOrder.play();
                swal("Gagal Qty Sudah FULL Order!", "Periksa Kembali Data Order", "error");
              }else if(data.trim() == "error_no_order"){
                  Swal.fire({
                  type: 'error',
                  title: 'Gagal, Ada orderan yang tidak sesuai !',
                  text: 'Periksa Kembali Data Order',
                  allowEnterKey: false,  
              });
              }else if(data.trim() == "errorDb"){
                swal("Gagal Ada masalah dengan kode barcode", "Hubungi IT untuk minta bantuan", "error");
              }else if(data.trim() == "error_full_ecer"){
                swal("Gagal, Qty Scan Kurang dari QTY isi Full Karton", "Silahkan Cek Ulang atau pilih Kelompok Isi Karton Tidak Full !", "error");
              }else if(data.trim() == "error_ecer_full"){
                swal("Gagal, Salah pilih Harusnya Full Karton, kelompok yg dipilih malah Isi Carton Tidak Full.", "Silahkan Cek Ulang atau pilih Kelompok Full Carton !", "error");
              }else if(data.trim() == "error_mix_full"){
                swal("Gagal, Salah pilih Harusnya Full Karton, kelompok yg dipilih malah MIX SIZE", "Silahkan Cek Ulang atau pilih Kelompok Full Carton !", "error");
              }else if(data.trim() == "error_mix_ecer"){
                swal("Gagal, Salah pilih Harusnya ISI KARTON TIDAK FULL, kelompok yg dipilih malah MIX SIZE", "Silahkan Cek Ulang atau pilih Kelompok Isi Karton Tidak Full !", "error");
              }else if(data.trim() == "error_mixstyle_ecer"){
                swal("Gagal, Salah pilih Harusnya ISI KARTON TIDAK FULL, kelompok yg dipilih malah MIX STYLE.", "Silahkan Cek Ulang atau pilih Kelompok ISI KARTON TIDAK FULL !", "error");
              }else if(data.trim() == "error_mixstyle_full"){
                swal("Gagal, Salah pilih Harusnya Full Karton, kelompok yg dipilih malah MIX STYLE.", "Silahkan Cek Ulang atau pilih Kelompok Mix Style !", "error");
              }else if(data.trim() == "error_full_mix"){
                swal("Gagal, Salah pilih Harusnya MIX SIZE, kelompok yg dipilih malah FULL KARTON.", "Silahkan Cek Ulang atau pilih Kelompok MIX SIZE !", "error");
              }else if(data.trim() == "error_ecer_mix"){
                swal("Gagal, Salah pilih Harusnya MIX SIZE, kelompok yg dipilih malah ISI KARTON TIDAK FULL.", "Silahkan Cek Ulang atau pilih Kelompok Isi Karton Tidak Full!", "error");
              }else if(data.trim() == "error_mixstyle_mix"){
                swal("Gagal, Salah pilih Harusnya MIX SIZE, kelompok yg dipilih malah MIX STYLE.", "Silahkan Cek Ulang atau pilih Kelompok Isi Karton Mix Size", "error");
              }else if(data.trim() == "error_full_mixstyle"){
                swal("Gagal, Salah pilih Harusnya MIX STYLE, kelompok yg dipilih malah FULL KARTON.", "Silahkan Cek Ulang atau pilih Kelompok Mix Style!", "error");
              }else if(data.trim() == "error_ecer_mixstyle"){
                swal("Gagal, Salah pilih Harusnya MIX STYLE, kelompok yg dipilih malah ISI KARTON TIDAK FULL KARTON.", "Silahkan Cek Ulang atau pilih Kelompok Mix Style!", "error");
              }else if(data.trim() == "error_mix_mixstyle"){
                swal("Salah pilih Harusnya MIX STYLE, kelompok yg dipilih malah MIX SIZE.", "Silahkan Cek Ulang atau pilih Kelompok Mix Style", "error");
              }else if(data.trim() == "over_carton"){
                swal("QTY Lebih dari Qty isi Full Carton.", "Cek Aktual Barang !", "error");
              }else if(data.trim() == "error_over_isi_carton"){
                Swal.fire({
                  type: 'error',
                  title: 'Gagal, QTY lebih dari qty isi karton ',
                  text: 'Silakan simpan dahulu, kemudian scan lagi',
                  allowEnterKey: false,  
                });
              }else if(data.trim() == "error_kurang_isi_carton"){
                Swal.fire({
                  type: 'error',
                  title: 'Gagal, QTY Scan Kurang dari Isi Karton',
                  text: 'Silakan Cek aktual barang dan isi karton',
                  allowEnterKey: false,  
                });
              }
              }
          });
        }else{
          swal.close();
        }
    });
    }
  }
});


  $('#reset').on('click',function(){
    swal.fire({
      title: "Anda Yakin ingin Reset hasil scan ini?",
      text: "Data yang Sudah di Reset Tidak Dapat diKembalikan Lagi!",
      type: "warning",

      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Reset',
      cancelButtonText: "Cancel",
      showCancelButton: true,
      reverseButtons: false,
    }).then((result) => {
      if (result.dismiss !== 'cancel') {
      $.ajax({
        method: "POST",
        url: "proses_kenzin.php",
        data: { type : "reset"
        },
        success: function(data){
          console.log(data.trim()); 
          if(data.trim() == "success"){
            swal("Data Berhasil di Reset!", "Klik Ok untuk melanjutkan!", "success");
            $('#tampil_tabel').load("tampil_kenzin.php");
          }else if(data.trim() == "errorDb"){
            alert("Gagal Ada masalah dengan kode barcode");
          }
        }
      });
    }else {
      swal.close();
    }
    // document.getElementById("orc").value = "";
    // document.getElementById("orc2").value = "";
    // document.getElementById("no_po").value = "";
    // document.getElementById("label").value = "";
    // document.getElementById("color").value = "";
    // document.getElementById("style").value = "";
  });
});

$('#reset_header').on('click',function(){
    var pilihan =  $('#pilihan_reset').val();
    pilihan2 = pilihan.toUpperCase();
    console.log(pilihan2);
    swal.fire({
      title: "Anda Yakin ingin Mengosongkan Header"+ pilihan2+" ?",
      text: "Anda Harus Isikan header "+pilihan2+" !",
      type: "warning",

      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Reset',
      cancelButtonText: "Cancel",
      showCancelButton: true,
      reverseButtons: false,
    }).then((result) => {
      if (result.dismiss !== 'cancel') {

    }else {
      swal.close();
    }
    // document.getElementById("orc").value = "";
    // document.getElementById("orc2").value = "";
    // document.getElementById("no_po").value = "";
    // document.getElementById("label").value = "";
    // document.getElementById("color").value = "";
    // document.getElementById("style").value = "";
  });
});
</script>





<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#myModal', function (e) {
        var check_po = $("#check_po:checked").val();
        var check_style = $("#check_style:checked").val();
        var check_costomer = $("#check_costomer:checked").val();
        if(check_po == 'pilih_po'){
          var no_po = $('#no_po').val();
        }else{
          var no_po = '';
        }
        if(check_style == 'pilih_style'){
          var style = $('#style').val();
        }else{
          var style = '';
        }
        
        if(check_costomer == 'pilih_costomer'){
          var costomer = $('#costomer').val();
        }else{
          var costomer = '';
          
        }
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'temp_kenzin_orc.php',
			data: { 
               no_po : no_po,
               style : style,
               costomer : costomer
            },
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>
<!-- <script src="style/jquery.min.js"></script> -->
<script>
  $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
  setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
</script>

<!-- // penutup hak akses level -->
<?php } else {
    echo 'Anda tidak memiliki akses kehalaman ini'; } 
  }else{
    header('index.php');
  }
?>
</body>
</html>
