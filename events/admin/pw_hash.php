<?php
    $pw="lab-002";
    $pass=password_hash($pw,PASSWORD_DEFAULT);
    echo($pass);    
?>