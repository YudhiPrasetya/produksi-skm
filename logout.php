<?php

session_start();
// session_destroy();
unset($_SESSION['username']);
// session_destroy();
header('Location: index.php');

?>