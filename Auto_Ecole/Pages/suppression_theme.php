<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="../CSS/style.css">
    <title>Supprimer un thème</title>
</head>
<body>
    <h1> Supprimer un thème </h1>
    <?php

        //connexion à la BDD
        include("connexion.php");

        //recupere les themes actifs pour les afficher ensuite
        $query = "SELECT * FROM themes WHERE supprime='0' ORDER BY nom";
        $result = mysqli_query($connect, $query);

        if (!$result){
            echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
            exit;
        }
        
        //formulaire pour afficher les themes récupéré
        echo "<FORM method='POST' action='supprimer_theme.php'";
        echo "<label for='idtheme'> Selectionnez un thème à supprimer. </label><br><br>";
        echo "<select name='idtheme' id='idtheme' size=4>";
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
            echo"<option value = $row[0]>$row[1] </option>";    
        } 
        echo "</select>";
        echo "<br><br>";
        echo "<input type='submit' value='Supprimer ce thème'>";
        echo "</FORM>";

        mysqli_close($connect);
    ?>
    
</body>
</html>