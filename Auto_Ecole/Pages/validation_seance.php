<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type = "text/css" href="../CSS/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation de séance</title>
</head>
<body>
    <h1> Validation d'une seance </h1>
    <?php
        //connexion à la BDD
        include("connexion.php");

        //date du jour
        date_default_timezone_set('Europe/Paris');
        $datemax = date("Y-m-d");

        //selection et affichage des seances dans le passé
        $query1 = "SELECT * FROM seances INNER JOIN themes ON seances.idtheme = themes.idtheme WHERE DATEDIFF(seances.Dateseance , '$datemax') < 0 ORDER BY themes.nom";
        // renvoie idseance/dateseances/effmax/idtheme/nom/supprime/descriptif
        $result = mysqli_query ($connect, $query1);
        
        if (!$result){
            echo "<p> La requête n'a pas pu aboutir</p>".mysqli_error($connect);
            exit;
        }

    ?>

    <FORM method = 'POST' action = 'valider_seance.php'>
    <label for = 'choixseancefaite'> Veuillez selectionnner une seance : </label><br><br>
    <select name ='choixseancefaite' id='choixseancefaite' size='4' required>
            
     <?php
        //row[0] est l'id de la seance qu'on séléctionne 
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
            echo"<option value=$row[0]> $row[5] : $row[1] </option>";
        } 
    ?>
    
    </select>
    <br><br>
    <input type=submit value= "Noter cette seance">
    </FORM>

    <?php
        mysqli_close($connect);
    ?>
</body>
</html>