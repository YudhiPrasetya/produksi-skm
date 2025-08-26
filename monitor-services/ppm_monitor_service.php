<?php
namespace FR\DiffSocket\Service;

require dirname(__DIR__) . "/vendor/autoload.php";

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use SplObjectStorage;

class PPMMonitorService implements MessageComponentInterface{
   public $data;
   protected $clients;

   public function __construct()
   {
      $this->clients = new SplObjectStorage;
   }

   public function onOpen(ConnectionInterface $conn){
      $this->clients->attach($conn);

      echo "New Connection - ppm" . $conn->resourceId;
   }

   public function onClose(ConnectionInterface $conn){}

   public function onError(ConnectionInterface $conn, \Exception $error){
      $conn->close();
   }

   public function onMessage(ConnectionInterface $from, $message){
      foreach($this->clients as $client){
         // $this->send($client, 'single', array('msg' => $msg, 'posted' => date('d-m-Y H:i:s')));
         $this->send($client, $message);
      }
   }

   // public function send($client, $type, $data){
   //    $send = array("type" => $type, "data" => $data);
   //    $send = json_encode($send, true);
   //    $client->send($send);
   // }

   public function send($client, $data){
      // $send = array("type" => $type, "data" => $data);
      // $send = json_encode($send, true);
      $client->send($data);
   }

   // public function getMessage(){
   //    echo $this->data;
   //    return $this->data;
   // }
}
?>

 