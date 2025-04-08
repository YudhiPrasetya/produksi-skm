<input type="text" id="txtMessage" style="width: 120px; height:30px;" />
<button type="button" id="btnSend" onclick="sendMessage()">Send</button>


<script>
   var qcEndline = new WebSocket("ws://localhost:10000/?service=qc_endline");
   // qcEndline.send("hallo server");
   function sendMessage(){
      let msg = document.getElementById("txtMessage").value;

      qcEndline.send(msg);

   }

   qcEndline.onmessage = function(msg){
      console.log(msg);
   }

   
</script>