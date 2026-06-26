<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/config/global.php";

$_SESSION["logado"] = false;
unset($_SESSION["id_usuario"]);
unset($_SESSION["tipo_usuario"]);

header("Location: /pages/auth/login.php");
exit();