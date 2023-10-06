<?php
require_once "config_sesion.php";
session_unset();
session_destroy();

header('Location:index.php');
die();

?>