<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type = "text/css" href="../CSS/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualisation calendrier élève</title>
</head>
<body>
    <h1>Visualiser le calendrier d'un élève </h1>

    <?php
        //connexion à la BDD
        include('connexion.php');

        //selection des eleves
        $query = "SELECT * FROM eleves ORDER BY nom";
        $result = mysqli_query($connect, $query);

        if (!$result){
            echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
            exit;
        }


        //formulaire qui affiche les eleves
        echo "<FORM method='POST' action='visualiser_calendrier_eleve.php'";
        echo "<label for='ideleve'> Selectionnez un élève. </label><br><br>";
        echo "<select name='ideleve' id='ideleve' size=7>";

        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){ //affiche nom, prenom, date anniversaire pour pas confondre les individus
            echo"<option value = $row[0]>$row[1] $row[2], né.e le $row[3] </option>";    
        } 
        echo "</select>";
        echo "<br><br>";
        echo "<input type='submit' value='Visualiser le calendrier'>";
        echo"</FORM>";

        mysqli_close($connect);
    ?>
</body>
</html>