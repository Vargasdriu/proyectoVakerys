<?php

session_start();


unset($_SESSION["pedido"]);


header("Location: productos.php");
exit;

?>