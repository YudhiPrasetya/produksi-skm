<?php
require_once 'core/init.php';
require_once 'view/header_tv.php';
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
<title>LAPORAN PREPARATION PRODUCTION</title>
<h3>LAPORAN PREPARATION PRODUCTION TV</h3>
</center>
    
<!-- <div style="margin: 10px"> -->
</div>
<div id="tampil_tabel"></div>


<script type="text/javascript">


$(document).ready(function(){
    var url = "tampil_laporan_preparation_production.php?category=&orc=&style=&status=open&costomer=&po=&layar=tv";
    console.log(url);
    $('#tampil_tabel').load(url);
    setInterval(function() { $("#tampil_tabel").load(url); }, 5000);
    
});
</script>



</body>
</html>
