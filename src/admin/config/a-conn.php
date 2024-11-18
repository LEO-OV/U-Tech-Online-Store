<?php
    $host = 'localhost';
    $username = 'root';
    $pwd = '';
    $db = 'u-tech';

    $con = mysqli_connect($host, $username, $pwd, $db);

    if (mysqli_connect_errno()){
        echo "<h4> Failed to connecto yo MySQL: " . mysqli_connect_error() . "</h4>";
    }