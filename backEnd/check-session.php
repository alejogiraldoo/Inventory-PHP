<?php
    if(empty($_SESSION["user"]) && empty($_SESSION["rol"])) {
        header("location: login.php");
    }
?>