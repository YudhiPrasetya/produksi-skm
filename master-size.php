<?php
require_once 'core/init.php';
require_once 'view/header.php';
require_once 'functions/fungsi.php';

// date_default_timezone_set('Asia/Jakarta');
$error = '';

// cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['username'])) {
   echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
   // header('Location: index.php');

}
?>

<?php
if (
   cek_status($_SESSION['username']) == 'admin' or
   cek_status($_SESSION['username']) == 'packing' or
   cek_status($_SESSION['username']) == 'kenzin' or
   cek_status($_SESSION['username']) == 'kenzin2' or
   cek_status($_SESSION['username']) == 'kenzin3' or
   cek_status($_SESSION['username']) == 'ppic'
) {
?>
   <center>
      <br>

      <?php
      if (isset($_POST['tambah'])) {
         $size = $_POST['size'];
         // $kelompok = $_POST['kelompok'];

         if (!empty(trim($size)) ) {
            //memasukkan ke database
            if (cek_size($size) == 0) {
               if (tambah_data_size($size)) {
                  $error = 'Data Berhasil diinput';
               } else {
                  $error = 'gagal';
               }
            } else {
               $error = 'Size sudah Ada didata';
            }
         } else {
            $error = 'Data tidak boleh ada yang kosong';
         }
         // if (!empty(trim($size)) && !empty(trim($kelompok))) {
         //    //memasukkan ke database
         //    if (cek_size($size) == 0) {
         //       if (tambah_data_size($size, $kelompok)) {
         //          $error = 'Data Berhasil diinput';
         //       } else {
         //          $error = 'gagal';
         //       }
         //    } else {
         //       $error = 'Size sudah Ada didata';
         //    }
         // } else {
         //    $error = 'Data tidak boleh ada yang kosong';
         // }
      }
      ?>


      <?php
      if (isset($_POST['update'])) {
         $id   = $_POST['id_size'];
         $size = $_POST['size'];
         $kelompok = $_POST['kelompok'];

         if (!empty(trim($size)) && !empty(trim($kelompok))) {
            if (edit_data_size($id, $size, $kelompok)) {
               // header('Location: master-style.php');
               $_SESSION['pesan'] = 'Data Berhasil di Edit';
            } else {
               $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
            }
         } else {
            $_SESSION['pesan'] = 'Ada data yang masih kosong, wajib di isi semua';
         }
      }
      ?>
   </center>

   <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-3 tetep">
         <br><br><br><br><br><br><br>
         <h3>
            <center>Tambah Data Master Label</center>
         </h3>
         <br>

         <form method="post" action="master-size.php">
            <div class="form-group">
               <label>SIZE BARU</label>
               <div class="input-group">
                  <div class="input-group-addon">
                     <i class="glyphicon glyphicon-tag"></i>
                  </div>
                  <input type="text" class="form-control" placeholder="SIZE BARU" onkeyup="this.value = this.value.toUpperCase()" name="size" id="size" required>
               </div>
            </div>

            <div class="form-group">
               <label for="kelompok">Kelompok Size</label>
               <div class="input-group">
                  <div class="input-group-addon">
                     <i class="glyphicon glyphicon-tag"></i>
                  </div>
                  <!-- <select name="kelompok" id="kelompok" class="form-control">
                     <option value=""> -- Pilih Kelompok Size -- </option>
                     <option value="a">Kelompok Size : S-M-L</option>
                     <option value="b">Kelompok Size : W</option>
                     <option value="c">Kelompok Size : 7-9-11-13</option>
                  </select> -->
               </div>

               <br>
               <span class="error" style="background-color: lightblue;">
                  <?= $error; ?>
               </span>
            </div>
            <center>
               <INPUT type="submit" class="btn btn-primary" name="tambah" value="SIMPAN DATA">
            </center>
         </form>
      </div>

      <!-- <div id="hasil"></div> -->
      <div class="col-sm-8 diam">
         <center>
            <h2>MASTER LABEL </h2>
         </center>
         <div style="height:55px;">
            <?php
            if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
               echo '<div id="pesan" class="alert alert-success" style="display:none;">' . $_SESSION['pesan'] . '</div>';
            }
            $_SESSION['pesan'] = '';
            ?>
         </div>
         <br>

         <table border="1px" class="table table-striped table-bordered data">
            <thead>
               <tr>
                  <th class="tengah theader"style="background: #254681"><CENTER>ID</th>
                  <th class="tengah theader"style="background: #254681"><center>Size</th>
                  <th class="tengah theader"style="background: #254681"><center>Kelompok</th>
                  <th class="tengah theader"style="background: #254681"><Center>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $no = 1;
               $size = tampilkan_master_size();
               while ($row = mysqli_fetch_assoc($size)) {
               ?>
                  <tr>
                     <td class="tengah"><?= $row['id_size']; ?></td>
                     <td class="tengah"><?= $row['size']; ?></td>
                     <td class="tengah">
                        <?php
                        if ($row['size'] == 'a') {
                           echo "Kelompok Size : S-M-L";
                        } elseif ($row['size'] == 'b') {
                           echo "Kelompok Size : W";
                        } elseif ($row['size'] == 'c') {
                           echo "Kelompok Size : 7-9-11-13";
                        }
                        ?>
                     </td>
                     <td class="tengah">
                        <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" data-id="<?= $row['size']; ?>">
                           <i class="glyphicon glyphicon-edit"></i>
                        </button>

                        <a href="hapus_size_satu.php?id=<?= $row['id_size']; ?>">
                           <button type="button" class="btn btn-xs btn-danger kecil">
                              <i class="glyphicon glyphicon-trash"></i>
                           </button>
                        </a>
                     </td>
                  </tr>
               <?php
                  $no++;
               }
               ?>
            </tbody>
         </table>
      </div>

      <!-- Modal Edit Data data kelas-->
      <div id="myEdit" class="modal fade" tabindex="-1" role="dialog">
         <div class="modal-dialog">
            <!-- konten modal-->
            <div class="modal-content">
               <!-- heading modal -->
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">
                     <font face="Calibri" color="red"><b>Edit Data Master Size</b></font>
                  </h4>
               </div>
               <!-- body modal -->
               <div class="modal-body">
                  <div class="lihat-data"></div>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal Edit data kelas-->

      <script type="text/javascript">
         $(document).ready(function() {
            $('.data').DataTable();
         });
      </script>

      <!-- Script ajax menampilkan Edit  -->
      <script type="text/javascript">
         $(document).ready(function() {
            $('body').on('show.bs.modal', '#myEdit', function(e) {
               var rowedit = $(e.relatedTarget).data('id');
               //menggunakan fungsi ajax untuk pengembalian data
               $.ajax({
                  type: 'post',
                  url: 'edit-size.php',
                  data: 'rowedit=' + rowedit,
                  success: function(data) {
                     $('.lihat-data').html(data); //menampilkan data ke dalam modal
                  }
               });
            });
         });
      </script>
      <!-- Script ajax menampilkan Edit -->
   </div>
   </div>

   <!-- penutup hak akses level -->

<?php } else {
   echo 'Anda tidak memiliki akses kehalaman ini';
} ?>

<script src="style/jquery.min.js"></script>
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
</body>

</html>