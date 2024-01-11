<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="../CSS/style.css">
    <title>Ajout seance</title>
</head>
<body>
    <h1> Creation d'une nouvelle séance </h1>
<?php
    //connexion à la BDD
    include("connexion.php");

    //sélection et affichage des thèmes actifs
    $query = "SELECT * FROM themes WHERE supprime ='0'";
    $result = mysqli_query($connect, $query);

    if (!$result){
        echo "<p> La requête n'a pas pu aboutir </p>".mysqli_error($connect);
        exit;
    }  
?>

<FORM METHOD='POST' ACTION= ajouter_seance.php>
<label for='menuChoixTheme'>Thème de la séance :</label><br>
<select name='menuChoixTheme' id='menuChoixTheme' size='4' required>

<?php
    //met le resultat de la query dans un tableau php qu'on affiche dans une liste déroulante
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            echo "<option value=$row[0]>".$row[1]."</option>";
        }
    echo "</select>";
    echo "<br><br>";
?>
    
<label for='dates'> Date de la séance :</label><br>
<input type='date' name='dates' id='dates' ><br><br>
<label for='effmax'>Effectif maximum de la séance:</label><br>
<input type='number' min='1' id='effmax' name='effmax'><br>
<input type='submit' value='Enregistrer séance'>
</FORM>

<?php
    mysqli_close($connect);
?>
    </body>
    </html>