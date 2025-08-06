<?php
namespace FR\DiffSocket\Service;

require dirname(__DIR__) . "/vendor/autoload.php";

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use SplObjectStorage;

class QCEndlineTarget implements MessageComponentInterface{
   public $data;
   protected $clients;

   public function __construct()
   {
      $this->clients = new SplObjectStorage;
   }

   public function onOpen(ConnectionInterface $conn){
      $this->clients->attach($conn);

      echo "New Connection - onOpen(QCEndline target) - " . $conn->resourceId;
   }

   public function onClose(ConnectionInterface $conn){}

   public function onError(ConnectionInterface $conn, \Exception $error){
      $conn->close();
   }

   public function onMessage(ConnectionInterface $from, $message){
      foreach($this->clients as $client){
         $this->send($client, $message);
      }
   }

   public function send($client, $data){
      $client->send($data);
   }

}