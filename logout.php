<?php
session_start();
session_destroy();
session_write_close(); // Agrega esta línea
header("Location: index.php");
exit;
?>