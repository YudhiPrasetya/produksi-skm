<?php
require_once 'core/init.php';
// date_default_timezone_set('Asia/Jakarta');
?>


<?php
  $invoice = $_GET['pl'];
  $data_ship = tampilkan_master_shipment_id($invoice); 
  $pilih4 = mysqli_fetch_array($data_ship);

?>
<center>
<button id="kembalikan" class="btn btn-md btn-danger"><i class="glyphicon glyphicon-minus"></i> KEMBALIKAN KE PACKING</button>
<h3>No Invoice : <?= $pilih4['no_invoice'] ?></h3>
</center>
<br> 

<div style="margin-left: 15px; margin-right:15px">
  <!-- <form method="post" action="kirim-shipment.php" id="form-kirim"> -->
  <?php 
  $laporan2 = tampilkan_laporan_temp_shipment_hidesize($invoice);
  $pilih3 = mysqli_fetch_array($laporan2);
?>
<center>
  <table border="1px" id="tabel2" class="table table-striped table-bordered data">
    <thead>
      <tr>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><input type="checkbox" id="check-all2"></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>No TRX</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>TANGGAL</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>NO PO</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>ORC</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>LABEL</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>STYLE</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" colspan="
         <?php 
            if($pilih3['size_w70'] > 0){ $w70 = 0; }else{ $w70 = 1; }
            if($pilih3['size_w71'] > 0){ $w71 = 0; }else{ $w71 = 1; }
            if($pilih3['size_w72'] > 0){ $w72 = 0; }else{ $w72 = 1; }
            if($pilih3['size_w73'] > 0){ $w73 = 0; }else{ $w73 = 1; }
            if($pilih3['size_w74'] > 0){ $w74 = 0; }else{ $w74 = 1; }
            if($pilih3['size_w75'] > 0){ $w75 = 0; }else{ $w75 = 1; }
            if($pilih3['size_w76'] > 0){ $w76 = 0; }else{ $w76 = 1; }
            if($pilih3['size_w77'] > 0){ $w77 = 0; }else{ $w77 = 1; }
            if($pilih3['size_w78'] > 0){ $w78 = 0; }else{ $w78 = 1; }
            if($pilih3['size_w79'] > 0){ $w79 = 0; }else{ $w79 = 1; }
            if($pilih3['size_w80'] > 0){ $w80 = 0; }else{ $w80 = 1; }
            if($pilih3['size_w81'] > 0){ $w81 = 0; }else{ $w81 = 1; }
            if($pilih3['size_w82'] > 0){ $w82 = 0; }else{ $w82 = 1; }
            if($pilih3['size_w83'] > 0){ $w83 = 0; }else{ $w83 = 1; }
            if($pilih3['size_w84'] > 0){ $w84 = 0; }else{ $w84 = 1; }
            if($pilih3['size_w85'] > 0){ $w85 = 0; }else{ $w85 = 1; }
            if($pilih3['size_w86'] > 0){ $w86 = 0; }else{ $w86 = 1; }
            if($pilih3['size_w87'] > 0){ $w87 = 0; }else{ $w87 = 1; }
            if($pilih3['size_w88'] > 0){ $w88 = 0; }else{ $w88 = 1; }
            if($pilih3['size_w89'] > 0){ $w89 = 0; }else{ $w89 = 1; }
            if($pilih3['size_w90'] > 0){ $w90 = 0; }else{ $w90 = 1; }
            if($pilih3['size_w91'] > 0){ $w91 = 0; }else{ $w91 = 1; }
            if($pilih3['size_w95'] > 0){ $w95 = 0; }else{ $w95 = 1; }
            if($pilih3['size_w96'] > 0){ $w96 = 0; }else{ $w96 = 1; }
            if($pilih3['size_w100'] > 0){ $w100 = 0; }else{ $w100 = 1; }
            if($pilih3['size_w105'] > 0){ $w105 = 0; }else{ $w105 = 1; }
            if($pilih3['size_w106'] > 0){ $w106 = 0; }else{ $w106 = 1; }
            if($pilih3['size_w110'] > 0){ $w110 = 0; }else{ $w110 = 1; }
            if($pilih3['size_w115'] > 0){ $w115 = 0; }else{ $w115 = 1; }
            if($pilih3['size_w120'] > 0){ $w120 = 0; }else{ $w120 = 1; }
            if($pilih3['size_w125'] > 0){ $w125 = 0; }else{ $w125 = 1; }
            if($pilih3['size_w130'] > 0){ $w130 = 0; }else{ $w130 = 1; }
            if($pilih3['size_70'] > 0){ $s70 = 0; }else{ $s70 = 1; }
            if($pilih3['size_73'] > 0){ $s73 = 0; }else{ $s73 = 1; }
            if($pilih3['size_76'] > 0){ $s76 = 0; }else{ $s76 = 1; }
            if($pilih3['size_79'] > 0){ $s79 = 0; }else{ $s79 = 1; }
            if($pilih3['size_82'] > 0){ $s82 = 0; }else{ $s82 = 1; }
            if($pilih3['size_85'] > 0){ $s85 = 0; }else{ $s85 = 1; }
            if($pilih3['size_88'] > 0){ $s88 = 0; }else{ $s88 = 1; }
            if($pilih3['size_91'] > 0){ $s91 = 0; }else{ $s91 = 1; }
            if($pilih3['size_95'] > 0){ $s95 = 0; }else{ $s95 = 1; }
            if($pilih3['size_100'] > 0){ $s100 = 0; }else{ $s100 = 1; }
            if($pilih3['size_105'] > 0){ $s105 = 0; }else{ $s105 = 1; }
            if($pilih3['size_110'] > 0){ $s110 = 0; }else{ $s110 = 1; }
            if($pilih3['size_115'] > 0){ $s115 = 0; }else{ $s115 = 1; }
            if($pilih3['size_120'] > 0){ $s120 = 0; }else{ $s120 = 1; }
            if($pilih3['size_130'] > 0){ $s130 = 0; }else{ $s130 = 1; }
            if($pilih3['size_140'] > 0){ $s140 = 0; }else{ $s140 = 1; }
            if($pilih3['size_150'] > 0){ $s150 = 0; }else{ $s150 = 1; }
            if($pilih3['size_86_3'] > 0){ $s86_3 = 0; }else{ $s86_3 = 1; }
            if($pilih3['size_90_4'] > 0){ $s90_4 = 0; }else{ $s90_4 = 1; }
            if($pilih3['size_94_5'] > 0){ $s94_5 = 0; }else{ $s94_5 = 1; }
            if($pilih3['size_98_6'] > 0){ $s98_6 = 0; }else{ $s98_6 = 1; }
            if($pilih3['size_ss'] > 0){ $c_ss = 0; }else{ $c_ss = 1; }
            if($pilih3['size_s'] > 0){ $c_s = 0; }else{ $c_s = 1; }
            if($pilih3['size_m'] > 0){ $c_m = 0; }else{ $c_m = 1; }
            if($pilih3['size_l'] > 0){ $c_l = 0; }else{ $c_l = 1; }
            if($pilih3['size_ll'] > 0){ $c_ll = 0; }else{ $c_ll = 1; }
            if($pilih3['size_3l'] > 0){ $c_3l = 0; }else{ $c_3l = 1; }
            if($pilih3['size_4l'] > 0){ $c_4l = 0; }else{ $c_4l = 1; }
            if($pilih3['size_5l'] > 0){ $c_5l = 0; }else{ $c_5l = 1; }
            if($pilih3['size_6l'] > 0){ $c_6l = 0; }else{ $c_6l = 1; }
            if($pilih3['size_7l'] > 0){ $c_7l = 0; }else{ $c_7l = 1; }
            if($pilih3['size_8l'] > 0){ $c_8l = 0; }else{ $c_8l = 1; }
            if($pilih3['size_0'] > 0){ $s0 = 0; }else{ $s0 = 1; }
             if($pilih3['size_1'] > 0){ $s1 = 0; }else{ $s1 = 1; }
             if($pilih3['size_2'] > 0){ $s2 = 0; }else{ $s2 = 1; }
             if($pilih3['size_3'] > 0){ $s3 = 0; }else{ $s3 = 1; }
             if($pilih3['size_4'] > 0){ $s4 = 0; }else{ $s4 = 1; }
             if($pilih3['size_5'] > 0){ $s5 = 0; }else{ $s5 = 1; }
             if($pilih3['size_6'] > 0){ $s6 = 0; }else{ $s6 = 1; }
             if($pilih3['size_7'] > 0){ $s7 = 0; }else{ $s7 = 1; }
             if($pilih3['size_8'] > 0){ $s8 = 0; }else{ $s8 = 1; }
             if($pilih3['size_9'] > 0){ $s9 = 0; }else{ $s9 = 1; }
             if($pilih3['size_10'] > 0){ $s10 = 0; }else{ $s10 = 1; }
             if($pilih3['size_11'] > 0){ $s11 = 0; }else{ $s11 = 1; }
             if($pilih3['size_12'] > 0){ $s12 = 0; }else{ $s12 = 1; }
             if($pilih3['size_13'] > 0){ $s13 = 0; }else{ $s13 = 1; }
             if($pilih3['size_14'] > 0){ $s14 = 0; }else{ $s14 = 1; }
             if($pilih3['size_15'] > 0){ $s15 = 0; }else{ $s15 = 1; }
             if($pilih3['size_16'] > 0){ $s16 = 0; }else{ $s16 = 1; }
             if($pilih3['size_17'] > 0){ $s17 = 0; }else{ $s17 = 1; }
             if($pilih3['size_18'] > 0){ $s18 = 0; }else{ $s18 = 1; }
             if($pilih3['size_19'] > 0){ $s19 = 0; }else{ $s19 = 1; }
            $total_hide = 84 - ($c_ss + $c_s + $c_m + $c_l + $c_ll + $c_3l + $c_4l + $c_5l + $c_6l + $c_7l + $c_8l + $w70 + $w71 + $w72 + $w73 + $w74 + $w75 + $w76 + $w77 + $w78 + $w79 + $w80 + $w81 + 
            $w82 + $w83 + $w84 + $w85 + $w86 + $w87 + $w88 + $w89 + $w90 + $w91 + $w95 + $w96 + $w100
        + $w105 + $w106 + $w110 + $w115 + $w120 + $w125 + $w130+ $s70 + $s73 + $s76 + $s79 + $s82 + $s85 + $s88 + $s91 +  $s95 + 
        $s100 + $s105 + $s110 + $s115 + $s120 + $s130 + $s140 + $s150 + $s86_3 + $s90_4 +
        $s94_5 + $s98_6 + $s0 + $s1 + $s2 + $s3 + $s4 + $s5 + $s6 + $s7 + $s8 + $s9 + $s10 + $s11 + $s12 + 
        $s13 + $s14 + $s15 + $s16 + $s17 + $s18 + $s19);
            echo $total_hide;
     ?>"><center>SIZE</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>TOT</center></th>
      </tr>  
      <tr>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;"><center>W70</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w71'] == 0){ echo "none"; } ?>;"><center>W71</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w72'] == 0){ echo "none"; } ?>;"><center>W72</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;"><center>W73</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w74'] == 0){ echo "none"; } ?>;"><center>W74</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w75'] == 0){ echo "none"; } ?>;"><center>W75</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;"><center>W76</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w77'] == 0){ echo "none"; } ?>;"><center>W77</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w78'] == 0){ echo "none"; } ?>;"><center>W78</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;"><center>W79</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w80'] == 0){ echo "none"; } ?>;"><center>W80</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w81'] == 0){ echo "none"; } ?>;"><center>W81</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;"><center>W82</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w83'] == 0){ echo "none"; } ?>;"><center>W83</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w84'] == 0){ echo "none"; } ?>;"><center>W84</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;"><center>W85</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w86'] == 0){ echo "none"; } ?>;"><center>W86</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w87'] == 0){ echo "none"; } ?>;"><center>W87</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;"><center>W88</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w89'] == 0){ echo "none"; } ?>;"><center>W89</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w90'] == 0){ echo "none"; } ?>;"><center>W90</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w91'] == 0){ echo "none"; } ?>;"><center>W91</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w95'] == 0){ echo "none"; } ?>;"><center>W95</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w96'] == 0){ echo "none"; } ?>;"><center>W96</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w100'] == 0){ echo "none"; } ?>;"><center>W100</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w105'] == 0){ echo "none"; } ?>;"><center>W105</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w106'] == 0){ echo "none"; } ?>;"><center>W106</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w110'] == 0){ echo "none"; } ?>;"><center>W110</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w115'] == 0){ echo "none"; } ?>;"><center>W115</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w120'] == 0){ echo "none"; } ?>;"><center>W120</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w125'] == 0){ echo "none"; } ?>;"><center>W125</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w130'] == 0){ echo "none"; } ?>;"><center>W130</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_70'] == 0){ echo "none"; } ?>;"><center>70</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_73'] == 0){ echo "none"; } ?>;"><center>73</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_76'] == 0){ echo "none"; } ?>;"><center>76</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_79'] == 0){ echo "none"; } ?>;"><center>79</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_82'] == 0){ echo "none"; } ?>;"><center>82</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_85'] == 0){ echo "none"; } ?>;"><center>85</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_88'] == 0){ echo "none"; } ?>;"><center>88</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_91'] == 0){ echo "none"; } ?>;"><center>91</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_95'] == 0){ echo "none"; } ?>;"><center>95</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_100'] == 0){ echo "none"; } ?>;"><center>100</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_105'] == 0){ echo "none"; } ?>;"><center>105</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_110'] == 0){ echo "none"; } ?>;"><center>110</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_115'] == 0){ echo "none"; } ?>;"><center>115</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_120'] == 0){ echo "none"; } ?>;"><center>120</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_130'] == 0){ echo "none"; } ?>;"><center>130</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_140'] == 0){ echo "none"; } ?>;"><center>140</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_150'] == 0){ echo "none"; } ?>;"><center>150</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if( $pilih3['size_86_3'] == 0){ echo "none"; } ?>;"><center>86-3</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_90_4'] == 0){ echo "none"; } ?>;"><center>90-4</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_94_5'] == 0){ echo "none"; } ?>;"><center>94-5</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_98_6'] == 0){ echo "none"; } ?>;"><center>98-6</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_ss'] == 0){ echo "none"; } ?>;"><center>SS</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_s'] == 0){ echo "none"; } ?>;"><center>S</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_m'] == 0){ echo "none"; } ?>;"><center>M</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_l'] == 0){ echo "none"; } ?>;"><center>L</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_ll'] == 0){ echo "none"; } ?>;"><center>LL</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_3l'] == 0){ echo "none"; } ?>;"><center>3L</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_4l'] == 0){ echo "none"; } ?>;"><center>4L</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_5l'] == 0){ echo "none"; } ?>;"><center>5L</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_6l'] == 0){ echo "none"; } ?>;"><center>6L</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_7l'] == 0){ echo "none"; } ?>;"><center>7L</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_8l'] == 0){ echo "none"; } ?>;"><center>8L</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_0'] == 0){ echo "none"; } ?>;"><center>FREE</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_1'] == 0){ echo "none"; } ?>;"><center>1</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_2'] == 0){ echo "none"; } ?>;"><center>2</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_3'] == 0){ echo "none"; } ?>;"><center>3</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_4'] == 0){ echo "none"; } ?>;"><center>4</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_5'] == 0){ echo "none"; } ?>;"><center>5</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_6'] == 0){ echo "none"; } ?>;"><center>6</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_7'] == 0){ echo "none"; } ?>;"><center>7</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_8'] == 0){ echo "none"; } ?>;"><center>8</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_9'] == 0){ echo "none"; } ?>;"><center>9</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_10'] == 0){ echo "none"; } ?>;"><center>10</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_11'] == 0){ echo "none"; } ?>;"><center>11</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_12'] == 0){ echo "none"; } ?>;"><center>12</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_13'] == 0){ echo "none"; } ?>;"><center>13</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_14'] == 0){ echo "none"; } ?>;"><center>14</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_15'] == 0){ echo "none"; } ?>;"><center>15</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_16'] == 0){ echo "none"; } ?>;"><center>16</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_17'] == 0){ echo "none"; } ?>;"><center>17</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_18'] == 0){ echo "none"; } ?>;"><center>18</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_19'] == 0){ echo "none"; } ?>;"><center>19</center></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no=1;
        $laporan3 = transaksi_temp_shipment($invoice);
        while($pilih2 = mysqli_fetch_array($laporan3)){ 
      ?>
      <tr class="belang">
        <td align='center'><input type="checkbox" class="check-item2" name="idtrx" value="<?= $pilih2['no_trx']; ?>"></td>
        <td align='center'><?= $pilih2['no_trx']; ?></td>
        <td align='center'><?= tanggal_indo3($pilih2['tanggal'], true) ?></td>
        <td align='center'><?= $pilih2['no_po']; ?></td>
        <td align='center'><?= $pilih2['orc']; ?></td>
        <td align='center' ><?= $pilih2['label']; ?></td>
        <td align='center'><?= $pilih2['style'] . ' ( ' . $pilih2['warna'] .' ) ' ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w70'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w71'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w71'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w72'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w72'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w73'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w74'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w74'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w75'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w75'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w76'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w77'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w77'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w78'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w78'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w79'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w80'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w80'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w81'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w81'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w82'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w83'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w83'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w84'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w84'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w85'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w86'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w86'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w87'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w87'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w88'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w89'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w89'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w90'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w90'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w91'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w91'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w95'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w95'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w96'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w96'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w100'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w100'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w105'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w105'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w106'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w106'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w110'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w110'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w115'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w115'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w120'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w120'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w125'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w125'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w130'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w130'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_70'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_70'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_73'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_73'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_76'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_76'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_79'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_79'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_82'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_82'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_85'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_85'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_88'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_88'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_91'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_91'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_95'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_95'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_100'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_100'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_105'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_105'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_110'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_110'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_115'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_115'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_120'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_120'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_130'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_130'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_140'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_140'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_150'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_150'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_86_3'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_86_3'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_90_4'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_90_4'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_94_5'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_94_5'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_98_6'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_98_6'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_ss'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_ss']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_s'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_s']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_m'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_m']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_l'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_l']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_ll'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_ll']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_3l'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_3l']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_4l'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_4l']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_5l'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_5l']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_6l'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_6l']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_7l'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_7l']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_8l'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_8l']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_0'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_0'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_1'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_1'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_2'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_2'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_3'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_3'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_4'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_4'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_5'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_5'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_6'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_6'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_7'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_7'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_8'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_8'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_9'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_9'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_10'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_10'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_11'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_11'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_12'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_12'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_13'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_13'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_14'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_14'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_15'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_15'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_16'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_16'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_17'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_17'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_18'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_18'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_19'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_19'] ?></td>
        <td align='center' style="background-color: #87CEEB;"><b><?= $pilih2['jumlah_size']; ?></b></td>
        
       </tr>
      <?php
        $no++;
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th class="tengah"></th>
        <th class="tengah">No TRX</th>
        <th class="tengah">TANGGAL</th>
        <th class="tengah">NO PO</th>
        <th class="tengah">ORC</th>
        <th class="tengah">LABEL</th>
        <th class="tengah">STYLE</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;">W70</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w71'] == 0){ echo "none"; } ?>;">W71</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w72'] == 0){ echo "none"; } ?>;">W72</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;">W73</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w74'] == 0){ echo "none"; } ?>;">W74</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w75'] == 0){ echo "none"; } ?>;">W75</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;">W76</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w77'] == 0){ echo "none"; } ?>;">W77</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w78'] == 0){ echo "none"; } ?>;">W78</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;">W79</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w80'] == 0){ echo "none"; } ?>;">W80</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w81'] == 0){ echo "none"; } ?>;">W81</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;">W82</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w83'] == 0){ echo "none"; } ?>;">W83</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w84'] == 0){ echo "none"; } ?>;">W84</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;">W85</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w86'] == 0){ echo "none"; } ?>;">W86</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w87'] == 0){ echo "none"; } ?>;">W87</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;">W88</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w89'] == 0){ echo "none"; } ?>;">W89</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w90'] == 0){ echo "none"; } ?>;">W90</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w91'] == 0){ echo "none"; } ?>;">W91</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w95'] == 0){ echo "none"; } ?>;">W95</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w96'] == 0){ echo "none"; } ?>;">W96</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w100'] == 0){ echo "none"; } ?>;">W100</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w105'] == 0){ echo "none"; } ?>;">W105</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w106'] == 0){ echo "none"; } ?>;">W106</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w110'] == 0){ echo "none"; } ?>;">W110</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w115'] == 0){ echo "none"; } ?>;">W115</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w120'] == 0){ echo "none"; } ?>;">W120</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w125'] == 0){ echo "none"; } ?>;">W125</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w130'] == 0){ echo "none"; } ?>;">W130</th>
        <th class="tengah" style="display: <?php if($pilih3['size_70'] == 0){ echo "none"; } ?>;">70</th>
        <th class="tengah" style="display: <?php if($pilih3['size_73'] == 0){ echo "none"; } ?>;">73</th>
        <th class="tengah" style="display: <?php if($pilih3['size_76'] == 0){ echo "none"; } ?>;">76</th>
        <th class="tengah" style="display: <?php if($pilih3['size_79'] == 0){ echo "none"; } ?>;">79</th>
        <th class="tengah" style="display: <?php if($pilih3['size_82'] == 0){ echo "none"; } ?>;">82</th>
        <th class="tengah" style="display: <?php if($pilih3['size_85'] == 0){ echo "none"; } ?>;">85</th>
        <th class="tengah" style="display: <?php if($pilih3['size_88'] == 0){ echo "none"; } ?>;">88</th>
        <th class="tengah" style="display: <?php if($pilih3['size_91'] == 0){ echo "none"; } ?>;">91</th>
        <th class="tengah" style="display: <?php if($pilih3['size_95'] == 0){ echo "none"; } ?>;">95</th>
        <th class="tengah" style="display: <?php if($pilih3['size_100'] == 0){ echo "none"; } ?>;">100</th>
        <th class="tengah" style="display: <?php if($pilih3['size_105'] == 0){ echo "none"; } ?>;">105</th>
        <th class="tengah" style="display: <?php if($pilih3['size_110'] == 0){ echo "none"; } ?>;">110</th>
        <th class="tengah" style="display: <?php if($pilih3['size_115'] == 0){ echo "none"; } ?>;">115</th>
        <th class="tengah" style="display: <?php if($pilih3['size_120'] == 0){ echo "none"; } ?>;">120</th>
        <th class="tengah" style="display: <?php if($pilih3['size_130'] == 0){ echo "none"; } ?>;">130</th>
        <th class="tengah" style="display: <?php if($pilih3['size_140'] == 0){ echo "none"; } ?>;">140</th>
        <th class="tengah" style="display: <?php if($pilih3['size_150'] == 0){ echo "none"; } ?>;">150</th>
        <th class="tengah" style="display: <?php if($pilih3['size_86_3'] == 0){ echo "none"; } ?>;">86-3</th>
        <th class="tengah" style="display: <?php if($pilih3['size_90_4'] == 0){ echo "none"; } ?>;">90-4</th>
        <th class="tengah" style="display: <?php if($pilih3['size_94_5'] == 0){ echo "none"; } ?>;">94-5</th>
        <th class="tengah" style="display: <?php if($pilih3['size_98_6'] == 0){ echo "none"; } ?>;">98-6</th>
        <th class="tengah" style="display: <?php if($pilih3['size_ss'] == 0){ echo "none"; } ?>;">SS</th>
        <th class="tengah" style="display: <?php if($pilih3['size_s'] == 0){ echo "none"; } ?>;">S</th>
        <th class="tengah" style="display: <?php if($pilih3['size_m'] == 0){ echo "none"; } ?>;">M</th>
        <th class="tengah" style="display: <?php if($pilih3['size_l'] == 0){ echo "none"; } ?>;">L</th>
        <th class="tengah" style="display: <?php if($pilih3['size_ll'] == 0){ echo "none"; } ?>;">LL</th>
        <th class="tengah" style="display: <?php if($pilih3['size_3l'] == 0){ echo "none"; } ?>;">3L</th>
        <th class="tengah" style="display: <?php if($pilih3['size_4l'] == 0){ echo "none"; } ?>;">4L</th>
        <th class="tengah" style="display: <?php if($pilih3['size_5l'] == 0){ echo "none"; } ?>;">5L</th>
        <th class="tengah" style="display: <?php if($pilih3['size_6l'] == 0){ echo "none"; } ?>;">6L</th>
        <th class="tengah" style="display: <?php if($pilih3['size_7l'] == 0){ echo "none"; } ?>;">7L</th>
        <th class="tengah" style="display: <?php if($pilih3['size_8l'] == 0){ echo "none"; } ?>;">8L</th>
        <th class="tengah" style="display: <?php if($pilih3['size_0'] == 0){ echo "none"; } ?>;">0</th>
        <th class="tengah" style="display: <?php if($pilih3['size_1'] == 0){ echo "none"; } ?>;">1</th>
        <th class="tengah" style="display: <?php if($pilih3['size_2'] == 0){ echo "none"; } ?>;">2</th>
        <th class="tengah" style="display: <?php if($pilih3['size_3'] == 0){ echo "none"; } ?>;">3</th>
        <th class="tengah" style="display: <?php if($pilih3['size_4'] == 0){ echo "none"; } ?>;">4</th>
        <th class="tengah" style="display: <?php if($pilih3['size_5'] == 0){ echo "none"; } ?>;">5</th>
        <th class="tengah" style="display: <?php if($pilih3['size_6'] == 0){ echo "none"; } ?>;">6</th>
        <th class="tengah" style="display: <?php if($pilih3['size_7'] == 0){ echo "none"; } ?>;">7</th>
        <th class="tengah" style="display: <?php if($pilih3['size_8'] == 0){ echo "none"; } ?>;">8</th>
        <th class="tengah" style="display: <?php if($pilih3['size_9'] == 0){ echo "none"; } ?>;">9</th>
        <th class="tengah" style="display: <?php if($pilih3['size_10'] == 0){ echo "none"; } ?>;">10</th>
        <th class="tengah" style="display: <?php if($pilih3['size_11'] == 0){ echo "none"; } ?>;">11</th>
        <th class="tengah" style="display: <?php if($pilih3['size_12'] == 0){ echo "none"; } ?>;">12</th>
        <th class="tengah" style="display: <?php if($pilih3['size_13'] == 0){ echo "none"; } ?>;">13</th>
        <th class="tengah" style="display: <?php if($pilih3['size_14'] == 0){ echo "none"; } ?>;">14</th>
        <th class="tengah" style="display: <?php if($pilih3['size_15'] == 0){ echo "none"; } ?>;">15</th>
        <th class="tengah" style="display: <?php if($pilih3['size_16'] == 0){ echo "none"; } ?>;">16</th>
        <th class="tengah" style="display: <?php if($pilih3['size_17'] == 0){ echo "none"; } ?>;">17</th>
        <th class="tengah" style="display: <?php if($pilih3['size_18'] == 0){ echo "none"; } ?>;">18</th>
        <th class="tengah" style="display: <?php if($pilih3['size_19'] == 0){ echo "none"; } ?>;">19</th>
        <th class="tengah">TOTAL</th>
      </tr>
    </tfoot>
  </table>

  <center>
    <table>
      <tr>
        <td>
          <form action="simpan_transaksi_shipment.php" method="post" >
          <input type="hidden" name="invoice" value="<?= $invoice ?>">
          <input type="submit" class="btn btn-md btn-primary" name="kirim" value="APPROVE" onclick="return konfirmasi_simpan()" style="margin-right: 40px; margin-top: 20px">    
          </form>
        </td>
        <td>
        <a href="laporan_shipment.php?id=<?= $invoice ?>" name="print" target=”_blank”><button type="button" class="btn btn-danger" >PRINT</button></a>
        </td>
      </tr>
    </table>
  </center>
 

<script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all2").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item2").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item2").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
    
    $("#btn-kirim").click(function(){ // Ketika user mengklik tombol delete
      var confirm = window.confirm("Apakah Anda yakin Ingin Approve Data ini utk Shipment?"); // Buat sebuah alert konfirmasi
      
      if(confirm) // Jika user mengklik tombol "Ok"
        $("#form-kirim").submit(); // Submit forM
    });
  });
</script>


<script type="text/javascript">
  $('#kembalikan').on('click',function(){
    var yakin = confirm("Anda Yakin Akan Menyimpan Data ?");
    if (yakin) {
      var user = $('#user').val();
      var packinglist = $('#packinglist').val();
      var po = $('#po').val();
      var orc = $('#orc').val();
      var style = $('#style').val();
      var costomer = $('#costomer').val();
      var url = "tampil_shipment.php?costomer="+costomer+"&po="+po+"&orc="+orc+"&style="+style+"&pl="+packinglist;
      var url2 = "tampil_temp_shipment.php?pl="+packinglist;
      console.log(url);
      var selectedId = new Array();
        $('input[name="idtrx"]:checked').each(function() {
          selectedId.push(this.value);
        });
      $.ajax({
        method: "POST",
        url: "temp_shipment_to_packing.php",
        data: { id : selectedId,
          user : user,
          packinglist : packinglist
        },
        success: function(data){
          console.log(data.trim());
          if(data.trim() == "success"){
            $('#tampil_tabel2').load(url2);
            $('#tampil_tabel').load(url);
            
          }else if(data.trim() == "error"){
            alert("Gagal Ada masalah dengan kode barcode");
          }else if(data.trim() == "errorQtyOrder"){
            alert("Gagal Qty Sudah Memenuhi Order Atau Tidak Ada Orderan untuk Label ini");
          }
        }
      });
    } else {
      return false;
    }
    // document.getElementById("kode_barcode").value = "";
  });

  </script>

<script type="text/javascript" language="JavaScript">
function konfirmasi_simpan()
{
tanya2 = confirm("Yakin Data Sudah Benar dan ingin disimpan?");
if (tanya2 == true) return true;
else return false;
}</script>


<script type="text/javascript">
	$(document).ready(function() {
    $('#tabel2').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );
</script>
