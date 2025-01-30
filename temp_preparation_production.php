<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>

<?php

if (
  cek_status($_SESSION['username']) == 'admin' or cek_status($_SESSION['username']) == 'warehouse' or
  cek_status($_SESSION['username']) == 'team_sample' or cek_status($_SESSION['username']) == 'ppm' or
  cek_status($_SESSION['username']) == 'team_marker' or cek_status($_SESSION['username']) == 'moulding_bounding' or
  cek_status($_SESSION['username']) == 'machines_setting' or
  cek_status($_SESSION['username']) == 'layout' or cek_status($_SESSION['username']) == 'layout' or
  cek_status($_SESSION['username']) == 'ready_produksi'
) {
  $username = $_SESSION['username'];

  if (
    isset($_POST['update_fit_sample']) or isset($_POST['update_team_sample']) or isset($_POST['update_size_set_sample']) or isset($_POST['update_ppm']) or isset($_POST['update_pattern_check'])
    or isset($_POST['update_moulding']) or isset($_POST['update_template_sewing']) or isset($_POST['update_marker']) or isset($_POST['update_machines_setting'])
    or isset($_POST['update_layout']) or isset($_POST['update_ready_produksi'])
  ) {
    $id   = $_POST['id_prod'];
    $pic_pp   = $_POST['pic_pp'];
    $date_pp   = $_POST['date_pp'];
    $remaks   = $_POST['remaks'];
    $date_in_pp   = isset($_POST['date_in_pp']) ? $_POST['date_in_pp'] : null;
    $kesiapan = isset($_POST['kesiapan_pp']) ? $_POST['kesiapan_pp'] : null;

    if (isset($_POST['update_fit_sample'])) {
      $proses = 'fit_sample';
    } elseif (isset($_POST['update_team_sample'])) {
      $proses = 'team_sample';
    } elseif (isset($_POST['update_size_set_sample'])) {
      $proses = 'size_set_sample';
    } elseif (isset($_POST['update_ppm'])) {
      $proses = 'ppm';
    } elseif (isset($_POST['update_pattern_check'])) {
      $proses = 'pattern_check';
    } elseif (isset($_POST['update_moulding'])) {
      $proses = 'moulding';
    } elseif (isset($_POST['update_template_sewing'])) {
      $proses = 'template_sewing';
    } elseif (isset($_POST['update_marker'])) {
      $proses = 'marker';
    } elseif (isset($_POST['update_machines_setting'])) {
      $proses = 'machines_setting';
    } elseif (isset($_POST['update_layout'])) {
      $proses = 'layout';
    } elseif (isset($_POST['update_ready_produksi'])) {
      $proses = 'ready_produksi';
    }

    $sql2 = tampilkan_transaksi_proses_pp_proses($proses);
    $data3 = mysqli_fetch_array($sql2);
    $kolom_date_in =  $data3['kolom_date_in'];
    $kolom_date_transaksi =  $data3['kolom_date_transaksi'];
    $kolom_pic_transaksi = $data3['kolom_pic_transaksi'];
    $kolom_username_edit = $data3['kolom_username_edit'];
    $kolom_user_date_edit = $data3['kolom_user_date_edit'];
    $status_persentase = $data3['status_persentase'];
    $kolom_persentase = $data3['kolom_persentase'];
    $remaks_kolom = $data3['remaks_kolom'];
    $urutan = $data3['urutan'];

    if (!empty(trim($pic_pp)) && !empty(trim($date_pp))) {
      if (edit_data_preparation_production($id, $pic_pp, $date_in_pp, $date_pp, $username, $kolom_date_in, $kolom_date_transaksi, $kolom_pic_transaksi, $kolom_username_edit, $kolom_user_date_edit, $remaks_kolom, $remaks, $kolom_persentase, $kesiapan, $status_persentase)) {


        //proses setelah sukses simpan generate tgl setelah nya
        // $proses = tampilkan_transaksi_proses_pp_after($urutan);
        // // $i=0;
        // while ($data2 = mysqli_fetch_assoc($proses)) {
        //   $kolom_date_transaksi = $data2['kolom_date_transaksi'];
        //   $kolom_pic_transaksi = $data2['kolom_pic_transaksi'];

        //   for ($j = $days_proses; $j >= 1; $j--) {
        //     $tanggal = date('Y-m-d', strtotime("+1 days", strtotime($tanggal)));
        //     $hari = date('l', strtotime($tanggal));

        //     if ($hari == 'Sunday') {
        //       $j = $j + 1;
        //       continue;
        //     }
        //   }
        //   $tanggals = $tanggal;
        //   if ($data[$kolom_pic_transaksi] == null) {
        //     edit_data_production_preparation_date($id, $kolom_date_transaksi, $tanggals, $username);
        //   }
        // }
        $_SESSION['pesan'] = 'Data Berhasil di Edit';
      } else {
        $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
      }
    } else {
      $_SESSION['pesan'] = 'Ada data yang masih kosong, wajib di isi semua';
    }
  }


  if (isset($_POST['update_fabric'])) {
    $id   = $_POST['id_prod'];
    $kesiapan_date   = $_POST['kesiapan_fabric_date'];
    $inhouse_fabric_date = $_POST['inhouse_fabric_date'];
    $kesiapan   = $_POST['kesiapan_fabric'];
    $pic   = $_POST['fabric_pic'];
    $remaks   = $_POST['remaks_fabric'];

    if (!empty(trim($kesiapan)) && !empty(trim($kesiapan_date))  && !empty(trim($pic)) && !empty(trim($inhouse_fabric_date))) {
      if (edit_data_kesiapan_fabric($id, $kesiapan_date, $kesiapan, $pic, $remaks, $username, $inhouse_fabric_date)) {
        $_SESSION['pesan'] = 'Data Berhasil di Edit';
      } else {
        $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
      }
    } else {
      $_SESSION['pesan'] = 'Ada data yang masih kosong, wajib di isi semua';
    }
  }

  if (isset($_POST['update_acc_sewing'])) {
    $id   = $_POST['id_prod'];
    $kesiapan_date   = $_POST['kesiapan_acc_sewing_date'];
    $kesiapan_acc_sewing_date   = $_POST['kesiapan_acc_sewing_date'];
    $kesiapan   = $_POST['kesiapan_acc_sewing'];
    $pic   = $_POST['acc_sewing_pic'];
    $remaks   = $_POST['remaks_acc'];

    if (!empty(trim($kesiapan)) && !empty(trim($kesiapan_date))  && !empty(trim($pic) && !empty(trim($kesiapan_acc_sewing_date)))) {
      if (edit_data_kesiapan_acc_sewing($id, $kesiapan_date, $kesiapan, $pic, $remaks, $username, $kesiapan_acc_sewing_date)) {
        $_SESSION['pesan'] = 'Data Berhasil di Edit';
      } else {
        $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
      }
    } else {
      $_SESSION['pesan'] = 'Ada data yang masih kosong, wajib di isi semua';
    }
  }

  if (isset($_POST['update_acc_packing'])) {
    $id   = $_POST['id_prod'];
    $kesiapan_date   = $_POST['kesiapan_acc_packing_date'];
    $kesiapan   = $_POST['kesiapan_acc_packing'];
    $pic   = $_POST['acc_packing_pic'];
    $remaks   = $_POST['remaks_pack'];

    if (!empty(trim($kesiapan)) && !empty(trim($kesiapan_date))  && !empty(trim($pic))) {
      if (edit_data_kesiapan_acc_pack($id, $kesiapan_date, $kesiapan, $pic, $remaks, $username)) {
        $_SESSION['pesan'] = 'Data Berhasil di Edit';
      } else {
        $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
      }
    } else {
      $_SESSION['pesan'] = 'Ada data yang masih kosong, wajib di isi semua';
    }
  }

  if (isset($_POST['update_prep_prod'])) {
    $id   = $_POST['id_prod'];
    $line   = $_POST['line'];
    $days_proses   = $_POST['days_proses'];
    $plan_production   = $_POST['plan_production'];

    if (!empty(trim($line)) && !empty(trim($days_proses))  && !empty(trim($plan_production))) {
      if (edit_data_preparation_production_header($id, $line, $days_proses, $plan_production, $username)) {
        $_SESSION['pesan'] = 'Data Berhasil di Edit';
      } else {
        $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
      }
    } else {
      $_SESSION['pesan'] = 'Ada data yang masih kosong, wajib di isi semua';
    }
  }

?>


  <!-- <center>
    <h3>TAMBAH DATA PREPARATION PRODUCTION</h3>
    <div style="height:55px;">
      <?php
      if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
        echo '<div id="pesan" class="alert alert-success" style="display:none;">' . $_SESSION['pesan'] . '</div>';
      }
      $_SESSION['pesan'] = '';
      ?>
    </div>
  </center>
  </div> -->

  </div>

  <!-- <div style="margin: 0 30px"> -->

    <!-- <div class="row"> -->

      <!-- <div class="col-sm-3">
        <font color="blue"><b>PILIH ORC</font><br></b>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-shopping-cart"></i>
          </div>
          <form action="simpan_master_preparation_production.php" method="post">
            <input type="text" class="form-control pilcek" id="orc" style="width: 70%; display: inline-block" disabled>
            <input type="hidden" value=<//?= $_SESSION['username']; ?> id="user">
            <input type="hidden" name="id_order" class="form-control pilcek" id="id_order">
            <button type="button" class="btn btn-info" style="margin: 0px 0 0 7px;" data-toggle="modal" data-target="#myModal"><b><span class="glyphicon glyphicon-search"></span> Cari</b></button>
        </div>
      </div> -->

      <!-- <div class="col-sm-2">
        <font color="blue"><b>Buyer</font><br></b>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
          </div>
          <input type="text" class="form-control" id="buyer" disabled>
        </div>
      </div> -->

      <!-- <div class="col-sm-3">
        <font color="blue"><b>No PO</font><br></b>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-shopping-cart"></i>
          </div>
          <input type="text" id="no_po" class="form-control" disabled />
        </div>
      </div> -->


      <!-- <div class="col-sm-2">
        <font color="blue"><b>STYLE</font><br></b>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-list"></i>
          </div>
          <input type="text" id="style" class="form-control" disabled />
        </div>
      </div> -->

      <!-- <div class="col-sm-2">
        <font color="blue"><b>COLOR</font><br></b>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-list"></i>
          </div>
          <input type="text" id="color" class="form-control" disabled />
        </div>
      </div> -->


  <!-- <tr> -->
  <!-- <//?php
  //$i = 0;
  // $proses = tampilkan_transaksi_proses_pp();
  // while ($data2 = mysqli_fetch_assoc($proses)) {
  //   $i++;
  //   $transaksi = $data2['nama_transaksi'];
  // ?//>

    // <//?php
    // if (($i % 6) == 0) {
    // ?//>
    //   </tr>
    //   <tr>
    //    <//?php
    //   }
    // } ?>
  <--</tr>
</table> -->

<!-- </div> -->

      <!-- <div class="col-sm-2" style="margin-top: 20px">
        <font color="blue"><b>PLAN LINE</font><br></b>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-barcode"></i>
          </div>
          <select id="line" class="form-control" name="line" required>
            <option value="">- Pilih LINE -</option>
            <//?php
            // $line = tampilkan_master_line();
            // while ($hasil = mysqli_fetch_assoc($line)) {
            //   echo "<option value = '$hasil[nama_line]'>Line $hasil[nama_line]</option>";
            // }
            ?>
          </select>
        </div>
      </div>

      <div class="col-sm-2" style="margin-top: 20px">
        <font color="blue"><b>Days Proses</font><br></b>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-list"></i>
          </div>
          <input type="number" name="days_proses" id="days_proses" class="form-control" required />
        </div>
      </div>

      <div class="col-sm-2" style="margin-top: 20px">
        <font color="blue"><b>PLAN SEWING DATE</font><br></b>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-list"></i>
          </div>
          <input type="date" name="plan_date" id="plan_date" class="form-control" required />
        </div>
      </div> -->

      <!-- <div class="col-sm-2" style="margin-top: 20px">

        <INPUT type="submit" class="btn btn-primary" name="kirim" value="SIMPAN DATA" id="submit_barang" onclick="return konfirmasi_simpan()" style="margin-right: 40px; margin-top: 20px">
        </form>
      </div>

    </div> -->

    <!-- Modal show -->
    <div class="modal fade" id="myModal" class="modal-backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <!-- konten modal-->
        <div class="modal-content">
          <!-- heading modal -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">
              <font face="Calibri" color="red"><b>Data Order</b></font>
            </h4>
          </div>
          <!-- body modal -->
          <div class="modal-body">
            <form name="modal_popup" enctype="multipart/form-data" method="post">

              <table border="1px" id="lookup" class="table table-striped table-hover table-bordered data" style="font-size: 13px">
                <thead>
                  <tr>
                    <th class="tengah theader" width=5%>NO</th>
                    <th class="tengah theader">COSTOMER</th>
                    <th class="tengah theader">ORC</th>
                    <th class="tengah theader">NO PO</th>
                    <th class="tengah theader">STYLE</th>
                    <th class="tengah theader">LABEL</th>
                    <th class="tengah theader">COLOR</th>
                    <!-- <th class="tengah theader">QTY ORDER</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $shipment = tampilkan_master_order_prod_prep();
                  while ($row = mysqli_fetch_assoc($shipment)) {
                  ?>
                    <tr class="pilih" data-order="<?= $row['orc']; ?>" data-po="<?= $row['no_po']; ?>" data-style="<?= $row['style']; ?>" data-color="<?= $row['color']; ?>" data-costomer="<?= $row['costomer']; ?>" data-id="<?= $row['id_order']; ?>" data-dismiss="modal">
                      <td class="tengah"><?= $no; ?></td>
                      <td class="tengah"><?= $row['costomer']; ?></td>
                      <td class="tengah"><?= $row['orc']; ?></td>
                      <td class="tengah"><?= $row['no_po']; ?></td>
                      <td class="tengah"><?= $row['style']; ?></td>
                      <td class="tengah"><?= $row['label']; ?></td>
                      <td class="tengah"><?= $row['color']; ?></td>
                      <!-- <td class="tengah"><?= $row['total']; ?></td> -->
                    </tr>
                  <?php
                    $no++;
                  }
                  ?>
                </tbody>
              </table>

              <div class="modal-footer">
                <input name="tambah" type="button" value="Close" id="button" class="btn btn-success" data-dismiss="modal" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Tambah -->
  <!-- </form> -->
  <!-- <hr width="100%"> -->

  <!-- <div class="container"> -->
    <!-- <div class="row"> -->
      <center>
        <h3>DATA PLAN PRODUCTION</h3>
      </center>
    <!-- </div> -->

    <!-- <font color="red"><u><b> Filter Data Table : </b></u></font> -->


    <!-- <div style="margin: 10px"> -->

    <!-- <div class="row"> -->
      <div class="col-sm-2">
        <font color="#254681"><b>PILIH BUYER</font><br></b>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-shopping-cart"></i>
          </div>
          <select id="costomer" class="form-control ganti" name="costomer" required>
            <option value="">- Pilih Costomer -</option>
            <?php
            $costomer = tampilkan_master_costomer();
            while ($pilih = mysqli_fetch_assoc($costomer)) {
              echo '<option value=' . $pilih['costomer'] . '>' . $pilih['costomer'] . '</option>';
            }
            ?>
          </select>
        </div>
      </div>

      <div class="col-sm-2">
        <font color="#254681"><b>CATEGORY ITEMS</font><br></b>
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
        <font color="#254681"><b>NO ORC</font><br></b>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-edit"></i>
          </div>
          <input type="text" name="orc" class="form-control ganti" placeholder="ORC" id="orc3">
          <!-- <input type="text" name="orc" id="orc2" hidden> -->
        </div>
      </div>

      <div class="col-sm-2">
        <font color="#254681"><b>NO PO</font><br></b>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-shopping-cart"></i>
          </div>
          <input type="text" name="po" class="form-control ganti" placeholder="INPUT PO NUMBER" id="po">
        </div>
      </div>

      <div class="col-sm-2">
        <font color="#254681"><b>Style</font><br></b>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-list-alt"></i>
          </div>
          <input type="text" name="style" class="form-control ganti" placeholder="INPUT STYLE" id="style2">
        </div>
      </div>

      <div class="col-sm-2">
        <font color="#254681"><b>STATUS</font><br></b>
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

    <!-- </div> -->

    <br />

    <div class="row text-center">
        <div id="loading" style="display: none;">
          Loading...
          <img src="assets/images/loader.gif" alt="Loading" width="142" height="71" />
        </div>
    </div>
  <!-- </div>   -->

  <div id="tampil_tabel"></div>

  <!-- <center> -->

    <script type="text/javascript">
      $('.ganti').on('change', function() {
        var category = $('#category').val();
        var orc = $('#orc3').val();
        var style = $('#style2').val();
        var po = $('#po').val();
        var costomer = $('#costomer').val();
        var status = $('#status').val();
        console.log(category);
        var url = "tampil_preparation_production.php?category=" + category + "&orc=" + orc + "&style=" + style + "&status=" + status + "&costomer=" + costomer + "&po=" + po;
        console.log(url);
        $('#example').hide();
        $('#loading').show();
        $('#tampil_tabel').load(url, function(response, status, xhr){
          if(status == 'success'){
            $('#loading').hide();
            $('#example').show();
          }
        });
      });

      $(document).ready(function() {
        var category = $('#category').val();
        var orc = $('#orc3').val();
        var style = $('#style2').val();
        var po = $('#po').val();
        var costomer = $('#costomer').val();
        var status = $('#status').val();
        var url = "tampil_preparation_production.php?category=" + category + "&orc=" + orc + "&style=" + style + "&status=" + status + "&costomer=" + costomer + "&po=" + po;
        console.log(url);
        $('#loading').show();
        $('#exanple').hide()
        $('#tampil_tabel').load(url, function(response, status, xhr){
          $('#loading').hide();
          $('#example').show();
        });
        // setInterval(function() { $(".tempat").load("file.txt"); }, 5000);=
      });
    </script>



    <script type="text/javascript">
      $(document).on('click', '.pilih', function(e) {
        document.getElementById("orc").value = $(this).attr('data-order');
        document.getElementById("id_order").value = $(this).attr('data-id');
        document.getElementById("no_po").value = $(this).attr('data-po');
        document.getElementById("style").value = $(this).attr('data-style');
        document.getElementById("color").value = $(this).attr('data-color');
        document.getElementById("buyer").value = $(this).attr('data-costomer');
        $('#myModal').modal('hide');
      });


      // tabel lookup mahasiswa
      $(function() {
        $("#lookup").dataTable();
      });
    </script>

    <script src="assets/js/select2.min.js"></script>
    <script>
      $(document).ready(function() {
        $("#line").select2({
          theme: 'bootstrap4',
          placeholder: "Please Select"
        });


      });
    </script>





    <!-- <script src="style/jquery.min.js"></script> -->
    <script>
      $(document).ready(function() {
        setTimeout(function() {
          $("#pesan").fadeIn('slow');
        }, 500);
      });
      setTimeout(function() {
        $("#pesan").fadeOut('slow');
      }, 3600);
    </script>

    <!-- // penutup hak akses level -->
  <?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini';
} ?>
  </body>

  </html>