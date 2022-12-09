<?php
session_start();
session_destroy();
echo "<SCRIPT>window.location='index.php';</SCRIPT>";
?>