<?php
   if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){
    $targetDir = "images_ppm/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        echo $targetFilePath; // Return the URL of the saved image
    } else {
        http_response_code(500);
        echo "Error uploading file.";
    }      
   }else{
    http_response_code(400);
    echo "No file uploaded or an error occurred.";      
   }
?>