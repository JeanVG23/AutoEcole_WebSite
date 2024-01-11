<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulter un élève</title>
    <link href="../CSS/style.css" rel="stylesheet">
</head>
<body>
    <h1> Consulter un elève </h1>
    <?php
        //connexion à la BDD
        include("connexion.php");

        //récuperer les infos du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $naissance = $_POST['naissance'];

        if(empty($nom) && empty($prenom) && empty($naissance)){
            echo"<p> Vous devez entrer au moins l'un des trois. </p>";
            exit;
        }  

        //selection de l'élève
        $query = "SELECT * FROM eleves WHERE nom ='$nom' || prenom= '$prenom' || dateNaiss ='$naissance'";
        $result = mysqli_query($connect, $query);
        if (!$result){
            echo "<p> La requête n'a pas pu aboutir</p>".mysqli_error($connect);
            echo"<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
            echo"<input type='button' onclick=\"window.location='consultation_eleve.php'\" value='Consulter un élève' />";
            exit;
        }
        echo <<< HTML
        <table border=1>
        <tr> <th>ID</th> <th>Nom</th> <th>Prénom</th> <th>Date de naissance</th> <th>Date d'inscription</th> </tr>
        HTML;

        while($row = mysqli_fetch_array($result, MYSQLI_NUM)){ //affiche info eleve
            echo <<< HTML
            <tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
            <td>$row[2]</td>
            <td>$row[3]</td>
            <td>$row[4]</td>
            </tr>
        HTML;
        }
        echo"</table>";

        mysqli_close($connect);
    ?>


    
</body>
</html>