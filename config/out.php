<?php 
    session_start();

    session_destroy();
    
    header("location: /U-Tech/index.php");