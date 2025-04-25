<?php
require_once "vendor/autoload.php";

$ds = new \Fr\DiffSocket(array(
   "server" => array(
      // "host" => "127.0.0.1",
      "host" => "192.168.90.100",
      // "host" => "192.168.2.120",
      "port" => "10000"
   ),
   "services" => array(
      "qc_endline" => __DIR__ . "/monitor-services/qc_endline_monitor_service.php",
      "packing_in" => __DIR__ . "/monitor-services/packing_in_monitor_service.php"
   )
   ));

$ds->run();