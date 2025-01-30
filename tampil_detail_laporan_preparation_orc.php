<?php
  require_once 'core/init.php';
  $today = date('Y-m-d');

?>
<!-- Script untuk menampilkan kalender -->
<?php
if($_POST['rowedit']) {
        $edit = @$_POST['rowedit'];
       
              $sql = tampilkan_data_preparation_production_id($edit); // memilih entri nim pada database
		      $data = mysqli_fetch_array($sql);
?> 

<table >
    <tr>
        
        <td width="5%"><b>ORC</b></td>
        <td width="2%"><b> : </b></td>
        <td width="12%"><b><?= $data['orc']; ?></b></td>
        <td width="5%"><b>STYLE</b></td>
        <td width="2%"><b> : </b></td>
        <td width="12%"><b><?= $data['style']; ?></b></td>
        <td width="7%"><b>COLOR</b></td>
        <td width="2%"><b> : </b></td>
        <td width="12%"><b><?= $data['color']; ?></b></td>
        <td width="7%"><b>ITEM</b></td>
        <td width="2%"><b> : </b></td>
        <td width="12%"><b><?= $data['item']; ?></b></td>
    </tr>
    <tr>
        <td width="8%"><b>COSTOMER</b></td>
        <td width="2%"><b> : </b></td>
        <td width="13%"><b><?= $data['costomer']; ?></b></td>
        <td width="8%"><b>PO BUYER</b></td>
        <td width="2%"><b> : </b></td>
        <td width="10%"><b><?= $data['no_po']; ?></b></td>
        <td width="8%"><b>PLAN LINE</b></td>
        <td width="2%"><b> : </b></td>
        <td width="10%"><b><?= strtoupper($data['plan_line']); ?></b></td>
    </tr>
</table>
<br>
<table id="example" class="table table-striped table-bordered row-border order-column" cellspacing="0" border="1px" width="100%" style="font-size: 12px">
    <thead>
        <tr>
            <th style="text-align: center; background: #1E90FF; color: white" width="20%">PROSES</th>
            <th style="text-align: center; background: #1E90FF; color: white" width="10%">DATE</th>
            <th style="text-align: center; background: #1E90FF; color: white" width="10%">PIC</th>
            <th style="text-align: center; background: #1E90FF; color: white">KETERANGAN</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><b>KESIAPAN FABRIC <?= $data['kesiapan_fabric'] ?> %</b></td>
            <td style="text-align: center;"><?= tgl_indonesia3($data['kesiapan_fabric_date']) ?></td>
            <td style="text-align: center;"><?= $data['fabric_pic'] ?></td>
            <td><?= $data['remaks_fabric'] ?></td>
        </tr>
        <tr>
            <td><b>KESIAPAN ACC SEWING <?= $data['kesiapan_acc_sewing'] ?> %</b></td>
            <td style="text-align: center;"><?= tgl_indonesia3($data['kesiapan_acc_sewing_date']) ?></td>
            <td style="text-align: center;"><?= $data['acc_sewing_pic'] ?></td>
            <td><?= $data['remaks_acc_sewing'] ?></td>
        </tr>
        <tr>
            <td><b>KESIAPAN ACC PACKING <?= $data['kesiapan_acc_packing'] ?> %</b></td>
            <td style="text-align: center;"><?= tgl_indonesia3($data['kesiapan_acc_packing_date']) ?></td>
            <td style="text-align: center;"><?= $data['acc_packing_pic'] ?></td>
            <td><?= $data['remaks_acc_packing'] ?></td>
        </tr>
        <tr>
            <td><b>PPS SAMPLE </b></td>
            <td style="text-align: center; color:<?php if(strtotime($data['team_sample_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia3($data['team_sample_date']) ?></td>
            <td style="text-align: center;"> <?= $data['team_sample_pic'] ?></td>
            <td><?= $data['remaks_team_sample'] ?></td>
        </tr>
        <tr>
            <td><b>PPM</b></td>
            <td style="text-align: center; color:<?php if(strtotime($data['ppm_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia3($data['ppm_date']) ?></td>
            <td style="text-align: center;"><?= $data['ppm_pic'] ?></td>
            <td><?= $data['remaks_ppm'] ?></td>
        </tr>
        <tr>
            <td><b>PATTERN CHECK <?= $data['kesiapan_pattern_check'] ?> %</b></td>
            <td style="text-align: center; color:<?php if(strtotime($data['pattern_check_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia3($data['pattern_check_date']) ?></td>
            <td style="text-align: center;"><?= $data['pattern_check_pic'] ?></td>
            <td><?= $data['remaks_pattern_check'] ?></td>
        </tr>
        <tr>
            <td><b>POLA SEWING <?= $data['kesiapan_template_sewing'] ?> %</b></td>
            <td style="text-align: center; color:<?php if(strtotime($data['template_sewing_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia3($data['template_sewing_date']) ?></td>
            <td style="text-align: center;"><?= $data['template_sewing_pic'] ?></td>
            <td><?= $data['remaks_template_sewing'] ?></td>
        </tr>
        <tr>
            <td><b>MARKER <?= $data['kesiapan_marker'] ?> %</b></td>
            <td style="text-align: center; color:<?php if(strtotime($data['marker_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia3($data['template_sewing_date']) ?></td>
            <td style="text-align: center;"><?= $data['marker_pic'] ?></td>
            <td><?= $data['remaks_marker'] ?></td>
        </tr>
        <tr>
            <td><b>CUTTING</b></td>
            <td style="text-align: center; color:<?php if(strtotime($data['moulding_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia3($data['moulding_date']) ?></td>
            <td style="text-align: center;"><?= $data['moulding_pic'] ?></td>
            <td><?= $data['remaks_moulding'] ?></td>
        </tr>
        <tr>
            <td><b>MECHINES SETTING</b></td>
            <td style="text-align: center; color:<?php if(strtotime($data['machines_setting_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia3($data['machines_setting_date']) ?></td>
            <td style="text-align: center;"><?= $data['machines_setting_pic'] ?></td>
            <td><?= $data['remaks_machines_setting'] ?></td>
        </tr>
        <tr>
            <td><b>LAYOUT</b></td>
            <td style="text-align: center; color:<?php if(strtotime($data['layout_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia3($data['layout_date']) ?></td>
            <td style="text-align: center;"><?= $data['layout_pic'] ?></td>
            <td><?= $data['remaks_layout'] ?></td>
        </tr>
        <tr>
            <td><b>TRIMSTORE</b></td>
            <td style="text-align: center; color:<?php if(strtotime($data['ready_produksi_date']) < strtotime($today)){ echo 'red'; } ?>"><?= tgl_indonesia3($data['ready_produksi_date']) ?></td>
            <td style="text-align: center;"><?= $data['ready_produksi_pic'] ?></td>
            <td><?= $data['remaks_ready_produksi'] ?></td>
        </tr>
    </tbody>    
</table>

<?php } ?>
