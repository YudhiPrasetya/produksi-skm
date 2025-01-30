<?php
require_once 'core/init.php';
$today = date('Y-m-d');


?>
<style>
  th,
  td {
    white-space: nowrap;
  }

  div.dataTables_wrapper {
    width: 100%;
    margin: 0 auto;
  }
</style>

<link rel="stylesheet" type="text/css" href="assets/FixedColumns/css/fixedColumns.dataTables.min.css">
<script type="text/javascript" src="assets/FixedColumns/js/dataTables.fixedColumns.min.js"></script>

<div style="margin: 30px">
  <div clss="dataTables_wrapper">
    <br>
    <button class="btn btn-success btn-sm" style="background: #254681" id="btnExportToExcel">Export To excel</button>
    <div id="tableContainer">
      <table id="example" class="table table-striped table-bordered row-border order-column" cellspacing="0" border="1px" width="100%" style="font-size: 11px">
        <thead>
          <tr>
            <th rowspan="3" style="vertical-align: middle; text-align: center; background: #254681; color: white; color: white">No</th>
            <th rowspan="3" style="vertical-align: middle; text-align: center; background: #254681; color: white">ORC</th>
            <th rowspan="3" style="vertical-align: middle; text-align: center; background: #254681; color: white">STYLE</th>
            <th rowspan="3" style="vertical-align: middle; text-align: center; background: #254681; color: white">ITEM</th>
            <th rowspan="3" style="vertical-align: middle; text-align: center; background: #254681; color: white">COLOR</th>
            <th rowspan="3" style="vertical-align: middle; text-align: center; background: #254681; color: white">BUYER</th>
            <th rowspan="3" style="vertical-align: middle; text-align: center; background: #254681; color: white">PO BUYER</th>
            <th rowspan="3" style="vertical-align: middle; text-align: center; background: #254681; color: white">QTY ORDER</th>
            <th rowspan="3" style="vertical-align: middle; text-align: center; background: #254681; color: white">LINE</th>
            <th rowspan="3" style="vertical-align: middle; text-align: center; background: #254681; color: white">DAYS PROSES</th>
            <th rowspan="3" style="vertical-align: middle; text-align: center; background: #254681; color: white">PLAN SEWING</th>

            <th colspan="13" style="text-align: center; background: #254681; color: white">KESIAPAN MATERIAL</th>
            <th colspan="12" style="text-align: center; background: #254681; color: white">SAMPLE</th>
            <th rowspan="2" colspan="4" style="vertical-align: middle; text-align: center; background: #254681; color: white">PPM</th>
            <th colspan="12" style="text-align: center; background: #254681; color: white">TEAM MARKER</th>
            <th rowspan="2" colspan="4" style="vertical-align: middle; text-align: center; background: #254681; color: white">CUTTING</th>
            <th rowspan="2" colspan="4" style="vertical-align: middle; text-align: center; background: #254681; color: white">TRIMSTORE</th>
            <th rowspan="2" colspan="4" style="vertical-align: middle; text-align: center; background: #254681; color: white">LAYOUT</th>
            <th rowspan="2" colspan="4" style="vertical-align: middle; text-align: center; background: #254681; color: white">MECHINES SETTING</th>


            <th rowspan="2" colspan="2" style="vertical-align: middle; text-align: center; background: #254681; color: white">FIRST PRODUKSI</th>
            <th rowspan="3" style="vertical-align: middle; text-align: center; background: #254681; color: white">ACTION</th>
          </tr>

          <tr>
            <!-- kolom warehouse -->
            <th colspan="5" style="text-align: center; background: #254681; color: white">FABRIC</th>
            <th colspan="5" style="text-align: center; background: #254681; color: white">ACC SEWING</th>
            <th colspan="3" style="text-align: center; background: #254681; color: white">ACC PACKING</th>
            <!-- kolom sample -->
            <th colspan="4" style="text-align: center; background: #254681; color: white">FIT SAMPLE</th>
            <th colspan="4" style="text-align: center; background: #254681; color: white">PPS SAMPLE</th>
            <th colspan="4" style="text-align: center; background: #254681; color: white">SIZE SET SAMPLE</th>
            <!-- kolom sample -->
            <th colspan="4" style="text-align: center; background: #254681; color: white">PATTERN CHECK</th>
            <th colspan="4" style="text-align: center; background: #254681; color: white">POLA SEWING</th>
            <th colspan="4" style="text-align: center; background: #254681; color: white">MARKER</th>
          </tr>
          <tr>
            <!-- kolom kesiapan fabric -->
            <th style="text-align: center; background: #254681; color: white">DATE ORDER</th>
            <th style="text-align: center; background: #254681; color: white">DATE INHOUSE</th>
            <th style="text-align: center; background: #254681; color: white">DATE ACTUAL</th>
            <th style="text-align: center; background: #254681; color: white">STATUS</th>
            <th style="text-align: center; background: #254681; color: white">PIC</th>
            <!-- Kolom kesiapan Acc Sewing -->
            <th style="text-align: center; background: #254681; color: white">DATE ORDER</th>
            <th style="text-align: center; background: #254681; color: white">DATE INHOUSE</th>
            <th style="text-align: center; background: #254681; color: white">DATE ACTUAL</th>
            <th style="text-align: center; background: #254681; color: white">STATUS</th>
            <th style="text-align: center; background: #254681; color: white">PIC</th>
            <!-- Kolom Kesiapan Acc Packing -->
            <th style="text-align: center; background: #254681; color: white">SHIPMENT PLAN</th>
            <th style="text-align: center; background: #254681; color: white">STATUS</th>
            <th style="text-align: center; background: #254681; color: white">PIC</th>
            <!-- Kolom Fit Sample -->
            <th style="text-align: center; background: #254681; color: white">DATE INHOUSE</th>
            <th style="text-align: center; background: #254681; color: white">DATE ACTUAL</th>
            <th style="text-align: center; background: #254681; color: white">STATUS</th>
            <th style="text-align: center; background: #254681; color: white">PIC</th>
            <!-- Kolom PPS Sample -->
            <th style="text-align: center; background: #254681; color: white">DATE INHOUSE</th>
            <th style="text-align: center; background: #254681; color: white">DATE ACTUAL</th>
            <th style="text-align: center; background: #254681; color: white">STATUS</th>
            <th style="text-align: center; background: #254681; color: white">PIC</th>
            <!-- Kolom Size Set Sample -->
            <th style="text-align: center; background: #254681; color: white">DATE INHOUSE</th>
            <th style="text-align: center; background: #254681; color: white">DATE ACTUAL</th>
            <th style="text-align: center; background: #254681; color: white">STATUS</th>
            <th style="text-align: center; background: #254681; color: white">PIC</th>
            <!-- Kolom PPM  -->
            <th style="text-align: center; background: #254681; color: white">DATE START</th>
            <th style="text-align: center; background: #254681; color: white">DATE ACTUAL</th>
            <th style="text-align: center; background: #254681; color: white">STATUS</th>
            <th style="text-align: center; background: #254681; color: white">PIC</th>
            <!-- Kolom pattern check -->
            <th style="text-align: center; background: #254681; color: white">DATE START</th>
            <th style="text-align: center; background: #254681; color: white">DATE ACTUAL</th>
            <th style="text-align: center; background: #254681; color: white">STATUS</th>
            <th style="text-align: center; background: #254681; color: white">PIC</th>
            <!-- Kolom Pola Sewing -->
            <th style="text-align: center; background: #254681; color: white">DATE START</th>
            <th style="text-align: center; background: #254681; color: white">DATE ACTUAL</th>
            <th style="text-align: center; background: #254681; color: white">STATUS</th>
            <th style="text-align: center; background: #254681; color: white">PIC</th>
            <!-- Kolom Marker -->
            <th style="text-align: center; background: #254681; color: white">DATE START</th>
            <th style="text-align: center; background: #254681; color: white">DATE ACTUAL</th>
            <th style="text-align: center; background: #254681; color: white">STATUS</th>
            <th style="text-align: center; background: #254681; color: white">PIC</th>
            <!-- Kolom Cutting -->
            <th style="text-align: center; background: #254681; color: white">DATE START</th>
            <th style="text-align: center; background: #254681; color: white">DATE ACTUAL</th>
            <th style="text-align: center; background: #254681; color: white">STATUS</th>
            <th style="text-align: center; background: #254681; color: white">PIC</th>
            <!-- Kolom Trimstore -->
            <th style="text-align: center; background: #254681; color: white">DATE START</th>
            <th style="text-align: center; background: #254681; color: white">DATE ACTUAL</th>
            <th style="text-align: center; background: #254681; color: white">STATUS</th>
            <th style="text-align: center; background: #254681; color: white">PIC</th>
            <!-- Kolom Layout -->
            <th style="text-align: center; background: #254681; color: white">DATE START</th>
            <th style="text-align: center; background: #254681; color: white">DATE ACTUAL</th>
            <th style="text-align: center; background: #254681; color: white">STATUS</th>
            <th style="text-align: center; background: #254681; color: white">PIC</th>
            <!-- Kolom Machines Setting -->
            <th style="text-align: center; background: #254681; color: white">DATE START</th>
            <th style="text-align: center; background: #254681; color: white">DATE ACTUAL</th>
            <th style="text-align: center; background: #254681; color: white">STATUS</th>
            <th style="text-align: center; background: #254681; color: white">PIC</th>
            <!-- Kolom Sewing -->
            <th style="text-align: center; background: #254681; color: white">DATE ACTUAL</th>
            <th style="text-align: center; background: #254681; color: white">PIC</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $po = $_GET['po'];
          $category = $_GET['category'];
          $orc = $_GET['orc'];
          $style = $_GET['style'];
          $status = $_GET['status'];
          $costomer = $_GET['costomer'];
          $no = 1;
          $subtotal_qty = 0;
          $preparation = tampilkan_preparartion_production($po, $category, $orc, $style, $status, $costomer);
          while ($row = mysqli_fetch_assoc($preparation)) {
          ?>
            <tr>
              <td style="text-align: center"><?= $no; ?></td>
              <td style="text-align: center"><?= $row['orc']; ?></td>
              <td style="text-align: center"><?= $row['style'];  ?> </td>
              <td style="text-align: center"><?= $row['item'];  ?> </td>
              <td style="text-align: center"><?= $row['color'];  ?> </td>
              <td style="text-align: center"><?= $row['costomer']; ?></td>
              <td style="text-align: center"><?= $row['no_po']; ?></td>
              <td style="text-align: center"><?= $row['qty_order'];  ?> </td>
              <td style="text-align: center"><?= strtoupper($row['plan_line']);  ?> </td>
              <td style="text-align: center"><?= $row['days_proses'];  ?> </td>
              <td style="text-align: center"><?= tgl_indonesia3($row['plan_production']);  ?> </td>
              <!-- kolo informasi kesiapan fabric -->
              <td style="text-align: center"><?= tgl_indonesia3($row['prepare_on']);  ?> </td>
              <td style="text-align: center"><?= tgl_indonesia3($row['inhouse_fabric_date']);  ?> </td>
              <td style="text-align: center"><?= tgl_indonesia3($row['kesiapan_fabric_date']);  ?> </td>
              <td style="text-align: center"><?= $row['kesiapan_fabric']; ?> %</td>
              <td style="text-align: center">
                <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#EditFabric"><?php if ($row['fabric_pic'] == null) { ?><i class="glyphicon glyphicon-user"> <?php } else {
                                                                                                                                                                                                                                                                    echo strtoupper($row['fabric_pic']);
                                                                                                                                                                                                                                                                  } ?></i></button>
              </td>
              <!-- kolom informasi kesiapan acc sewing -->
              <td style="text-align: center"><?= tgl_indonesia3($row['prepare_on']);  ?> </td>
              <td style="text-align: center"><?= tgl_indonesia3($row['inhouse_acc_sewing_date']);  ?> </td>
              <td style="text-align: center"><?= tgl_indonesia3($row['acc_sewing_edit_date']);  ?> </td>
              <td style="text-align: center"><?= $row['kesiapan_acc_sewing']; ?> PCS</td>
              <td style="text-align: center">
                <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#EditAcc"><?php if ($row['acc_sewing_pic'] == null) { ?><i class="glyphicon glyphicon-user"> <?php } else {
                                                                                                                                                                                                                                                                    echo strtoupper($row['acc_sewing_pic']);
                                                                                                                                                                                                                                                                  } ?></i></button>
              </td>
              <!-- kolom kesiapan acc packing                                                                                                                                                                                                                                                                 -->
              <td style="text-align: center"><?= tgl_indonesia3($row['shipment_plan']);  ?> </td>
              <td style="text-align: center"><?= $row['kesiapan_acc_packing']; ?> PCS</td>
              <td style="text-align: center">
                <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#EditPack"><?php if ($row['acc_packing_pic'] == null) { ?><i class="glyphicon glyphicon-user"> <?php } else {
                                                                                                                                                                                                                                                                      echo strtoupper($row['acc_packing_pic']);
                                                                                                                                                                                                                                                                    } ?></i></button>
              </td>
              <!-- Kolom Fit Sample -->
              <td style="text-align: center; color:<?php if (strtotime($row['date_in_fit_sample']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['date_in_fit_sample']);  ?> </td>
              <td style="text-align: center; color:<?php if (strtotime($row['fit_sample_date']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['fit_sample_date']);  ?> </td>
              <td style="text-align: center"><?= $row['kesiapan_fit_sample']; ?> %</td>
              <td style="text-align: center">
                <?php if (cek_status($_SESSION['username']) == 'fit_sample' || cek_status($_SESSION['username']) == 'admin') {  ?>
                  <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#EditFitSample"><?php if ($row['fit_sample_pic'] == null) { ?><i class="glyphicon glyphicon-user"> <?php } else {
                                                                                                                                                                                                                                                                            echo strtoupper($row['fit_sample_pic']);
                                                                                                                                                                                                                                                                          } ?></i></button>
                <?php } else {
                  echo strtoupper($row['fit_sample_pic']);
                } ?>
              </td>
              <!-- Kolom PPS Sample -->
              <td style="text-align: center; color:<?php if (strtotime($row['date_in_team_sample']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['date_in_team_sample']);  ?> </td>
              <td style="text-align: center; color:<?php if (strtotime($row['team_sample_date']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['team_sample_date']);  ?> </td>
              <td style="text-align: center"><?= $row['kesiapan_team_sample']; ?> %</td>
              <td style="text-align: center">
                <?php if (cek_status($_SESSION['username']) == 'team_sample' || cek_status($_SESSION['username']) == 'admin') {  ?>
                  <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#EditTeamSample"><?php if ($row['team_sample_pic'] == null) { ?><i class="glyphicon glyphicon-user"> <?php } else {
                                                                                                                                                                                                                                                                              echo strtoupper($row['team_sample_pic']);
                                                                                                                                                                                                                                                                            } ?></i></button>
                <?php } else {
                  echo strtoupper($row['team_sample_pic']);
                } ?>
              </td>
              <!-- Kolom Size Set Sample -->
              <td style="text-align: center; color:<?php if (strtotime($row['date_in_size_set_sample']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['date_in_size_set_sample']);  ?> </td>
              <td style="text-align: center; color:<?php if (strtotime($row['size_set_sample_date']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['size_set_sample_date']);  ?> </td>
              <td style="text-align: center"><?= $row['kesiapan_size_set_sample']; ?> %</td>
              <td style="text-align: center">
                <?php if (cek_status($_SESSION['username']) == 'size_set_sample' || cek_status($_SESSION['username']) == 'admin') {  ?>
                  <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#EditSizeSetSample"><?php if ($row['size_set_sample_pic'] == null) { ?><i class="glyphicon glyphicon-user"> <?php } else {
                                                                                                                                                                                                                                                                                      echo strtoupper($row['size_set_sample_pic']);
                                                                                                                                                                                                                                                                                    } ?></i></button>
                <?php } else {
                  echo strtoupper($row['size_set_sample_pic']);
                } ?>
              </td>
              <!-- kolom ppm  -->
              <td style="text-align: center; color:<?php if (strtotime($row['date_in_ppm']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['date_in_ppm']);  ?> </td>
              <td style="text-align: center; color:<?php if (strtotime($row['ppm_date']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['ppm_date']);  ?> </td>
              <td style="text-align: center"><?= $row['kesiapan_ppm']; ?> %</td>
              <td style="text-align: center">
                <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#EditPPM"><?php if ($row['ppm_pic'] == null) { ?><i class="glyphicon glyphicon-user"> <?php } else {
                                                                                                                                                                                                                                                              echo strtoupper($row['ppm_pic']);
                                                                                                                                                                                                                                                            } ?></i></button>
              </td>
              <!-- kolom pattern check -->
              <td style="text-align: center; color:<?php if (strtotime($row['date_in_pattern_check']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['date_in_pattern_check']);  ?> </td>
              <td style="text-align: center; color:<?php if (strtotime($row['pattern_check_date']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['pattern_check_date']);  ?> </td>
              <td style="text-align: center"><?= $row['kesiapan_pattern_check']; ?> %</td>
              <td style="text-align: center">
                <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#EditPatternCheck"><?php if ($row['pattern_check_pic'] == null) { ?><i class="glyphicon glyphicon-user"> <?php } else {
                                                                                                                                                                                                                                                                                echo strtoupper($row['pattern_check_pic']);
                                                                                                                                                                                                                                                                              } ?></i></button>
              </td>
              <!-- Kolom pola sewing -->
              <td style="text-align: center; color:<?php if (strtotime($row['date_in_template_sewing']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['date_in_template_sewing']);  ?> </td>
              <td style="text-align: center; color:<?php if (strtotime($row['template_sewing_date']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['template_sewing_date']);  ?> </td>
              <td style="text-align: center"><?= $row['kesiapan_template_sewing']; ?> %</td>
              <td style="text-align: center">
                <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#EditTemplateSewing"><?php if ($row['template_sewing_pic'] == null) { ?><i class="glyphicon glyphicon-user"> <?php } else {
                                                                                                                                                                                                                                                                                    echo strtoupper($row['template_sewing_pic']);
                                                                                                                                                                                                                                                                                  } ?></i></button>
              </td>
              <!-- Kolom Marker -->
              <td style="text-align: center; color:<?php if (strtotime($row['date_in_marker']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['date_in_marker']);  ?> </td>
              <td style="text-align: center; color:<?php if (strtotime($row['marker_date']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['marker_date']);  ?> </td>
              <td style="text-align: center"><?= $row['kesiapan_marker']; ?> %</td>
              <td style="text-align: center">
                <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#EditMarker"><?php if ($row['marker_pic'] == null) { ?><i class="glyphicon glyphicon-user"> <?php } else {
                                                                                                                                                                                                                                                                    echo strtoupper($row['marker_pic']);
                                                                                                                                                                                                                                                                  } ?></i></button>
              </td>
              <!-- Kolom Cutting / moulding-->
              <td style="text-align: center; color:<?php if (strtotime($row['moulding_date']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['moulding_date']);  ?> </td>
              <td style="text-align: center; color:<?php if (strtotime($row['start_date_cutting']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?> "><?= tgl_indonesia3($row['start_date_cutting']);  ?> </td>
              <td style="text-align: center"><?= $row['status_cutting']; ?> %</td>
              <td style="text-align: center">
                <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#EditMoulding"><?php if ($row['moulding_pic'] == null) { ?><i class="glyphicon glyphicon-user"> <?php } else {
                                                                                                                                                                                                                                                                        echo strtoupper($row['moulding_pic']);
                                                                                                                                                                                                                                                                      } ?></i></button>
              </td>
              <!-- Kolom Trimstore -->
              <td style="text-align: center; color:<?php if (strtotime($row['ready_produksi_date']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['ready_produksi_date']);  ?> </td>
              <td style="text-align: center; color:<?php if (strtotime($row['start_date_trimstore']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?> "><?= tgl_indonesia3($row['start_date_trimstore']);  ?> </td>
              <td style="text-align: center"><?= $row['status_trimstore']; ?> %</td>
              <td style="text-align: center">
                <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#EditReadyProduksi"><?php if ($row['ready_produksi_pic'] == null) { ?><i class="glyphicon glyphicon-user"> <?php } else {
                                                                                                                                                                                                                                                                                  echo strtoupper($row['ready_produksi_pic']);
                                                                                                                                                                                                                                                                                } ?></i></button>

              </td>
              <!-- kolom layout -->
              <td style="text-align: center; color:<?php if (strtotime($row['layout_date']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['layout_date']);  ?> </td>
              <td style="text-align: center; color:<?php if (strtotime($row['start_date_qc_endline']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?> "><?= tgl_indonesia3($row['start_date_qc_endline']);  ?> </td>
              <td style="text-align: center"><?= $row['status_qc_endline']; ?> %</td>
              <td style="text-align: center">
                <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#EditLayout"><?php if ($row['layout_pic'] == null) { ?><i class="glyphicon glyphicon-user"> <?php } else {
                                                                                                                                                                                                                                                                    echo strtoupper($row['layout_pic']);
                                                                                                                                                                                                                                                                  } ?></i></button>
              </td>
              <!-- Kolom Mesin Setting                                                                                                                                                                                                                                                     -->
              <td style="text-align: center; color:<?php if (strtotime($row['machines_setting_date']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?>"><?= tgl_indonesia3($row['machines_setting_date']);  ?> </td>
              <td style="text-align: center; color:<?php if (strtotime($row['start_date_qc_endline']) < strtotime($today)) {
                                                      echo 'red';
                                                    } ?> "><?= tgl_indonesia3($row['start_date_qc_endline']);  ?> </td>
              <td style="text-align: center"><?= $row['status_qc_endline']; ?> %</td>
              <td style="text-align: center">
                <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#EditMachinesSetting"><?php if ($row['machines_setting_pic'] == null) { ?><i class="glyphicon glyphicon-user"> <?php } else {
                                                                                                                                                                                                                                                                                      echo strtoupper($row['machines_setting_pic']);
                                                                                                                                                                                                                                                                                    } ?></i></button>

              </td>
              <td style="text-align: center"><?= tgl_indonesia3($row['start_date_sewing']);  ?> </td>
              <td style="text-align: center"><?= strtoupper($row['line']);  ?></td>
              <td><button type="submit" class="btn btn-sm btn-primary" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" id="edit" data-toggle="modal" data-target="#myEdit">Edit</button>
                <!-- | <button type="submit" class="hapus_size btn btn-sm btn-danger" style="margin-top: 0" data-id="<?= $row['id_prod'] ?>" onclick="return konfirmasi_kurangi()">Hapus</button> -->
              </td>
            </tr>

          <?php
            $no++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<!-- Modal Edit Data data Team Sample-->
<?php

$sql4 = tampilkan_transaksi_proses_pp();
while ($data4 = mysqli_fetch_assoc($sql4)) {
?>
  <div id="<?= $data4['transaksi_modal_id'] ?>" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
            <font face="Calibri" color="red"><b><?= $data4['nama_modal'] ?></b></font>
          </h4>
        </div>
        <div class="modal-body">
          <div class="lihat-data"></div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<!-- Modal Fabric -->
<div id="EditFabric" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          <font face="Calibri" color="red"><b>KESIAPAN FABRIC</b></font>
        </h4>
      </div>
      <div class="modal-body">
        <div class="lihat-data"></div>
      </div>
    </div>
  </div>
</div>

<!-- Modal ACC -->
<div id="EditAcc" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          <font face="Calibri" color="red"><b>KESIAPAN ACC SEWING</b></font>
        </h4>
      </div>
      <div class="modal-body">
        <div class="lihat-data"></div>
      </div>
    </div>
  </div>
</div>

<!-- Modal ACC -->
<div id="EditPack" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          <font face="Calibri" color="red"><b>KESIAPAN ACC PACKING</b></font>
        </h4>
      </div>
      <div class="modal-body">
        <div class="lihat-data"></div>
      </div>
    </div>
  </div>
</div>

<!-- Modal edit preparation -->
<div id="myEdit" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          <font face="Calibri" color="red"><b>EDIT PREPARATION PRODUCTION</b></font>
        </h4>
      </div>
      <div class="modal-body">
        <div class="lihat-data"></div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#example').DataTable({
      scrollY: "300px",
      scrollX: true,
      scrollCollapse: true,
      paging: false,
      searching: false,
      fixedColumns: {
        left: 5,
      }
    });
  });
</script>



<script type="text/javascript">
  $(document).ready(function() {

    $('body').on('show.bs.modal', '#EditTeamSample', function(e) {
      var rowedit = $(e.relatedTarget).data('id');
      //menggunakan fungsi ajax untuk pengembalian data
      $.ajax({
        type: 'post',
        url: 'edit_team_sample.php',
        data: 'rowedit=' + rowedit,
        success: function(data) {
          $('.lihat-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });

    $('body').on('show.bs.modal', '#EditFitSample', function(e) {
      var rowedit = $(e.relatedTarget).data('id');
      //menggunakan fungsi ajax untuk pengembalian data
      $.ajax({
        type: 'post',
        url: 'edit_fit_sample.php',
        data: 'rowedit=' + rowedit,
        success: function(data) {
          $('.lihat-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });

    $('body').on('show.bs.modal', '#EditSizeSetSample', function(e) {
      var rowedit = $(e.relatedTarget).data('id');
      //menggunakan fungsi ajax untuk pengembalian data
      $.ajax({
        type: 'post',
        url: 'edit_size_set_sample.php',
        data: 'rowedit=' + rowedit,
        success: function(data) {
          $('.lihat-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });

    $('body').on('show.bs.modal', '#EditPPM', function(e) {
      var rowedit = $(e.relatedTarget).data('id');
      //menggunakan fungsi ajax untuk pengembalian data
      $.ajax({
        type: 'post',
        url: 'edit_ppm.php',
        data: 'rowedit=' + rowedit,
        success: function(data) {
          $('.lihat-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });

    $('body').on('show.bs.modal', '#EditPatternCheck', function(e) {
      var rowedit = $(e.relatedTarget).data('id');
      //menggunakan fungsi ajax untuk pengembalian data
      $.ajax({
        type: 'post',
        url: 'edit_pattern_check.php',
        data: 'rowedit=' + rowedit,
        success: function(data) {
          $('.lihat-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });

    $('body').on('show.bs.modal', '#EditTemplateSewing', function(e) {
      var rowedit = $(e.relatedTarget).data('id');
      //menggunakan fungsi ajax untuk pengembalian data
      $.ajax({
        type: 'post',
        url: 'edit_template_sewing.php',
        data: 'rowedit=' + rowedit,
        success: function(data) {
          $('.lihat-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });

    $('body').on('show.bs.modal', '#EditMarker', function(e) {
      var rowedit = $(e.relatedTarget).data('id');
      //menggunakan fungsi ajax untuk pengembalian data
      $.ajax({
        type: 'post',
        url: 'edit_marker.php',
        data: 'rowedit=' + rowedit,
        success: function(data) {
          $('.lihat-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });

    $('body').on('show.bs.modal', '#EditMoulding', function(e) {
      var rowedit = $(e.relatedTarget).data('id');
      //menggunakan fungsi ajax untuk pengembalian data
      $.ajax({
        type: 'post',
        url: 'edit_moulding.php',
        data: 'rowedit=' + rowedit,
        success: function(data) {
          $('.lihat-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });

    $('body').on('show.bs.modal', '#EditMachinesSetting', function(e) {
      var rowedit = $(e.relatedTarget).data('id');
      //menggunakan fungsi ajax untuk pengembalian data
      $.ajax({
        type: 'post',
        url: 'edit_machines_setting.php',
        data: 'rowedit=' + rowedit,
        success: function(data) {
          $('.lihat-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });

    $('body').on('show.bs.modal', '#EditLayout', function(e) {
      var rowedit = $(e.relatedTarget).data('id');
      //menggunakan fungsi ajax untuk pengembalian data
      $.ajax({
        type: 'post',
        url: 'edit_layout.php',
        data: 'rowedit=' + rowedit,
        success: function(data) {
          $('.lihat-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });

    $('body').on('show.bs.modal', '#EditReadyProduksi', function(e) {
      var rowedit = $(e.relatedTarget).data('id');
      //menggunakan fungsi ajax untuk pengembalian data
      $.ajax({
        type: 'post',
        url: 'edit_ready_produksi.php',
        data: 'rowedit=' + rowedit,
        success: function(data) {
          $('.lihat-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });

    $('body').on('show.bs.modal', '#EditFabric', function(e) {
      var rowedit = $(e.relatedTarget).data('id');
      //menggunakan fungsi ajax untuk pengembalian data
      $.ajax({
        type: 'post',
        url: 'edit_fabric.php',
        data: 'rowedit=' + rowedit,
        success: function(data) {
          $('.lihat-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });

    $('body').on('show.bs.modal', '#EditAcc', function(e) {
      var rowedit = $(e.relatedTarget).data('id');
      //menggunakan fungsi ajax untuk pengembalian data
      $.ajax({
        type: 'post',
        url: 'edit_acc_sewing.php',
        data: 'rowedit=' + rowedit,
        success: function(data) {
          $('.lihat-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });

    $('body').on('show.bs.modal', '#EditPack', function(e) {
      var rowedit = $(e.relatedTarget).data('id');
      //menggunakan fungsi ajax untuk pengembalian data
      $.ajax({
        type: 'post',
        url: 'edit_acc_packing.php',
        data: 'rowedit=' + rowedit,
        success: function(data) {
          $('.lihat-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });

    $('body').on('show.bs.modal', '#myEdit', function(e) {
      var rowedit = $(e.relatedTarget).data('id');
      //menggunakan fungsi ajax untuk pengembalian data
      $.ajax({
        type: 'post',
        url: 'edit_preparation_production.php',
        data: 'rowedit=' + rowedit,
        success: function(data) {
          $('.lihat-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });

    $('#btnExportToExcel').click(function(e) {
         // let fileName = '<//?= $data4['no_invoice'] ?>';
         let file = new Blob([$('#tableContainer').html()], {
            type: "application/vnd.ms-excel"
         });
         let url = URL.createObjectURL(file);
         let a = $("<a />", {
            href: url,
            download: "pre_production" + ".xls"
         }).appendTo("body").get(0).click();
         e.preventDefault();
      });    

  });
</script>