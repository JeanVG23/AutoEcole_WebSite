<?php
    $dbhost = 'tuxa***';
    $dbuser = 'nf92****';
    $dbpass = 'a1a*****';
    $dbname = 'nf92****';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql'); //la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le server mysql
    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
?>
