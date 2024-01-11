<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="../CSS/style.css">
    <title>Valider élève</title>
</head>
<body>
    <h1>Ajouter un élève: </h1>
    <h2> Ajouter un élève ayant le même nom qu'un autre </h2>
<?php

    //connexion à BDD
    include("connexion.php");

    //date d'aujourd'hui pour l'inscription de l'eleve
    date_default_timezone_set('Europe/Paris');
    $date = date("Y-m-d");

    //récuperer les infos du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $naissance = $_POST['naissance'];

    //Les données ont été obligatoirement rentré car la vérif a été faite dans ajouter_eleve.php

    //insère élève dans la table
    $query = "INSERT INTO eleves VALUES (NULL,'$nom', '$prenom', '$naissance', '$date')";
    $result = mysqli_query($connect, $query);

    if (!$result){
        echo"<p> La requête n'a pas pu aboutir:</p>".mysqli_error($connect);
    } 
    else{
        echo"<p> L'eleve $nom $prenom né le $naissance a bien été ajouté.</p>";
    }

    //boutons pour naviguer entre les pages
    echo"<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
    echo"<input type='button' onclick=\"window.location='ajouter_eleve.html'\" value='Ajouter un autre élève' />";

    mysqli_close($connect);
?>
</body>
</html>