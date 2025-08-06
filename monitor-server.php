<?php
require_once __DIR__ . "/vendor/autoload.php";

$ds = new \Fr\DiffSocket(array(
   "server" => array(
      // "host" => "127.0.0.1",
      "host" => "192.168.90.100",
      // "host" => "192.168.2.120",
      "port" => "10000"
   ),
   "services" => array(
         "qc_endline" => __DIR__ . "/monitor-services/qc_endline_monitor_service.php",
         "packing" => __DIR__ . "/monitor-services/packing_monitor_service.php",
         "ouput_target" => __DIR__ . "/monitor-services/output_target_monitor_service.php"
         // "send_message" => __DIR__ . "/monitor-services/send_message_monitor_service.php"
      )
   ));

$ds->run();