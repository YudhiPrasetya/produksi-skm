<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>

<?php

if (
    cek_status($_SESSION['username']) == 'admin'
) {
    $username = $_SESSION['username'];

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


    <center>
        <h3>TAMBAH DATA PLAN PRODUCTION</h3>
        <div style="height:55px;">
            <?php
            if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                echo '<div id="pesan" class="alert alert-success" style="display:none;">' . $_SESSION['pesan'] . '</div>';
            }
            $_SESSION['pesan'] = '';
            ?>
        </div>
    </center>
    </div>
    <div style="margin: 0 30px">
        <div class="row">
            <div class="col-sm-3">
                <font color="blue"><b>PILIH ORC</font><br></b>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                    </div>
                    <form action="simpan_master_preparation_production.php" method="post">
                        <input type="text" class="form-control pilcek" id="orc" style="width: 70%; display: inline-block" disabled>
                        <input type="hidden" value=<?= $_SESSION['username']; ?> id="user">
                        <input type="hidden" name="id_order" class="form-control pilcek" id="id_order">
                        <button type="button" class="btn btn-info" style="margin: 0px 0 0 7px;" data-toggle="modal" data-target="#myModal"><b><span class="glyphicon glyphicon-search"></span> Cari</b></button>
                </div>
                <!-- <div id="orcList"></div> -->
            </div>

            <div class="col-sm-2">
                <font color="blue"><b>Buyer</font><br></b>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
                    </div>
                    <input type="text" class="form-control" id="buyer" disabled>
                </div>
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
                <font color="blue"><b>STYLE</font><br></b>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-list"></i>
                    </div>
                    <input type="text" id="style" class="form-control" disabled />
                </div>
            </div>

            <div class="col-sm-2">
                <font color="blue"><b>COLOR</font><br></b>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-list"></i>
                    </div>
                    <input type="text" id="color" class="form-control" disabled />
                </div>
            </div>
            <!-- 
<div class="col-sm-1" style="margin-top: 33px">
 <font color="blue"><b>Proses ==> </font><br></b>
 
</div>


<div class="col-sm-11" style="margin-top: 20px">
<table>
  <tr>
  <?php
    $i = 0;
    $proses = tampilkan_transaksi_proses_pp();
    while ($data2 = mysqli_fetch_assoc($proses)) {
        $i++;
        $transaksi = $data2['nama_transaksi'];
    ?>
    <td  width="190px">
      <input class="form-check-input" type="checkbox" name="proses[]" id="inlineCheckbox<?= $i; ?>" value="<?= $transaksi; ?>" 
      checked >
   
    <label class="form-check-label" style="font-weight: normal" for="inlineCheckbox<?= $i; ?>"><?= strtoupper($transaksi) ?></label>
    </td>
    <?php
        if (($i % 6) == 0) {
    ?>
      </tr>
      <tr>
       <?php
        }
    } ?>
  </tr>
</table>

</div> -->

            <div class="col-sm-2" style="margin-top: 20px">
                <font color="blue"><b>PLAN LINE</font><br></b>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-barcode"></i>
                    </div>
                    <select id="line" class="form-control" name="line" required>
                        <option value="">- Pilih LINE -</option>
                        <?php
                        // $line = tampilkan_master_line();
                        $line = tampilkan_master_line_open();
                        while ($hasil = mysqli_fetch_assoc($line)) {
                            echo "<option value = '$hasil[nama_line]'>Line $hasil[nama_line]</option>";
                        }
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
            </div>

            <div class="col-sm-2" style="margin-top: 20px">

                <INPUT type="submit" class="btn btn-primary" name="kirim" value="SIMPAN DATA" id="submit_barang" onclick="return konfirmasi_simpan()" style="margin-right: 40px; margin-top: 20px">
                </form>
            </div>

        </div>

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
    </form>
    <hr width="100%">
    <center>
        <h3>DATA PREPARATION PRODUCTION</h3>
    </center>
    <!-- <font color="red"><u><b> Filter Data Table : </b></u></font> -->


    <!-- <div style="margin: 10px"> -->

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
                while ($pilih = mysqli_fetch_assoc($costomer)) {
                    echo '<option value=' . $pilih['costomer'] . '>' . $pilih['costomer'] . '</option>';
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
            <input type="text" name="orc" class="form-control ganti" placeholder="ORC" id="orc3">
            <!-- <input type="text" name="orc" id="orc2" hidden> -->
        </div>
    </div>

    <div class="col-sm-2">
        <font color="blue"><b>NO PO</font><br></b>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-shopping-cart"></i>
            </div>
            <input type="text" name="po" class="form-control ganti" placeholder="INPUT PO NUMBER" id="po">
        </div>
    </div>

    <div class="col-sm-2">
        <font color="blue"><b>Style</font><br></b>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-list-alt"></i>
            </div>
            <input type="text" name="style" class="form-control ganti" placeholder="INPUT STYLE" id="style2">
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

    <!-- <div class="col-sm-3">
      <font color="#254681"><b>LINE</font><br></b>
      <select id="line" class="form-control ganti" name="line" required >
        <option value="" selected>-- Pilih Line --</option>
        <option value="not_yet" >BLM JALAN SEWING</option>
            <?php
              // $line = tampilkan_master_line();
              $line = tampilkan_master_line_open();
              while($hasil = mysqli_fetch_assoc($line)){ ?>
                  <option value = "<?= $hasil['nama_line'] ?>">LINE <?= strtoupper($hasil['nama_line']) ?></option>
            <?php } ?>
      </select>
    </div> -->

    </div>
    <br/>
    <div class="row text-center">
      <div id="loading" style="display: none;">
         Loading...
         <img src="assets/images/loader.gif" alt="Loading" width="142" height="71" />
      </div>
   </div>    
    <div id="tampil_tabel"></div>

    <center>

        <script type="text/javascript">
            $('.ganti').on('change', function() {
                var category = $('#category').val();
                var orc = $('#orc3').val();
                var style = $('#style2').val();
                var po = $('#po').val();
                var costomer = $('#costomer').val();
                var status = $('#status').val();
                console.log(category);
                var url = "tampil_plan_production.php?category=" + category + "&orc=" + orc + "&style=" + style + "&status=" + status + "&costomer=" + costomer + "&po=" + po;
                console.log(url);
                $('#loading').show();
                $('#example').hide();
                $('#tampil_tabel').load(url, function(response, status, xhr) {
                    if (status == 'success') {
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
                var url = "tampil_plan_production.php?category=" + category + "&orc=" + orc + "&style=" + style + "&status=" + status + "&costomer=" + costomer + "&po=" + po;
                console.log(url);
                $('#tampil_tabel').load(url);
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