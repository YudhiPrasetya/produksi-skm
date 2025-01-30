<?php require_once 'core/init.php'; ?>
<!-- <body onLoad="window.print()"> -->
<title>Laporan PACKING LIST</title>
<style>
hr {
    display: block;
    margin-top: 0.5em; 
    margin-bottom: 0.5em;
    border-style: inset;
    border-width: 1px;
    border-color:blue; 
    }

 tr.belang:nth-child(even) {
   background-color: #cccccc;
}
</style>

<?php
  $tgl = $_GET['tgl'];
  $orc = $_GET['orc'];
  $costomer = $_GET['costomer'];
  $no_po = $_GET['no_po'];
  $style = $_GET['style'];

?>
 

<?php


    $subtotal =0;
    $qty_total=0;
    $qty_total_semua=0;
    $no_karton2=0;
    $no_karton3=0;

  ?>
<center>
<table>
    <tr>
<?php

    if(cek_jumlah_size_transaksi_packing($tgl, $costomer) !=0) { 
        

        $ListSize = tampilkan_size_transaksi_packing($tgl, $orc, $costomer, $no_po, $style);
        while($size = mysqli_fetch_array($ListSize)){
           ${$size['total_size']} = 0;
           $sumsize[] = $size['sum_size'];
          
        }
        
        
        $var_sumsize =implode(", ",$sumsize); 
        
?>    
    <td>
    <form action="tampil_laporan_stok_packing_outerware2.php" method="post" target="_blank">
    <input type="hidden" value="<?= $tgl ?>" name="tgl" id="tgl3">
    <input type="hidden" value="<?= $orc ?>" name="orc" id="orc3">
    <input type="hidden" value="<?= $costomer ?>" name="costomer"  id="costomer3">
    <input type="hidden" value="<?= $style ?>" name="style" id="style3">
    <input type="hidden" value="<?= $no_po ?>" name="no_po" id="no_po3">
    <input type="hidden" value="<?= $var_sumsize ?>" name="var_sumsize" id="var_sumsize">
    <center><button type="submit" class="btn btn-primary" >TAMPIL</button></center>
    </form>
    </td>
<?php } ?>
<?php if($costomer != '') { 
    if(cek_jumlah_size_transaksi_packing_mixstyle($tgl, $costomer) !=0) {
     $ListSizeMix = tampilkan_size_transaksi_packing_mixstyle($tgl, $costomer);
        while($size2 = mysqli_fetch_array($ListSizeMix)){
            ${$size2['total_size']} = 0;
            $sumsize2[] = $size2['sum_size'];
        
        }
        
        
        $var_sumsize2 =implode(", ",$sumsize2);
    
    ?>


    <td style="padding-left: 30px">
<form action="tampil_laporan_stok_packing_outerware_mixstyle.php" method="post" target="_blank">
<input type="hidden" value="<?= $tgl ?>" name="tgl" id="tgl3">
<input type="hidden" value="<?= $costomer ?>" name="costomer"  id="costomer3">

<input type="hidden" value="<?= $var_sumsize2 ?>" name="var_sumsize" id="var_sumsize">
<center><button type="submit" class="btn btn-danger" >TAMPIL MIX SIZE</button></center>
</form>
</td>
<?php } } ?>
</tr>
</table>
</center>
<div id="tampil_tabel2"></div>

<script type="text/javascript">

$('#click').on('click', function () {
    var orc = $('#orc3').val();
    var tgl = $('#tgl3').val();
    var style = $('#style3').val();
    var costomer = $('#costomer3').val();
    var po = $('#no_po3').val();
    var var_sumsize = $('#var_sumsize').val();
    console.log(var_sumsize);
    // var url2 = "tampil_laporan_stok_packing_outerware2.php?tgl="+tgl+"&orc="+orc+"&style="+style+"&costomer="+costomer+"&no_po="+po+"&var_sumsize="+var_sumsize;
    // console.log(url2);
    //   $('#tampil_tabel2').load(url2);

    $.ajax({

        method: "POST",
        url:'tampil_laporan_stok_packing_outerware2.php',
                        //  (or whatever your url is)
        data:{ orc : orc,
            tgl : tgl,
            style : style,
            costomer : costomer,
            po : po,
            var_sumsize : var_sumsize
        },
        //can send multipledata like {data1:var1,data2:var2,data3:var3
        //can use dataType:'text/html' or 'json' if response type expected 
        success:function(html){
            $('#tampil_tabel2').load("tampil_laporan_stok_packing_outerware2.php");
            

        }
        });


    // $.ajax({
    //   method: "POST",
    //   url: "tampil_laporan_stok_packing_outerware2.php",
    //   data: { orc : orc,
    //           tgl : tgl,
    //           style : style,
    //           costomer : costomer,
    //           no_po : po,
    //           var_sumsize = var_sumsize
    //   },
    //   success: function(html){
    //       $('#tampil_tabel2').load("tampil_laporan_stok_packing_outerware2.php");
    //     },
    //   });
    
    // 
    // $('#tampil_tabel').load(url);
});

</script>







