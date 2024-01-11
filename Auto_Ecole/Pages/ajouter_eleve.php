<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="../CSS/style.css">
    <title>Ajouter élève</title>
</head>
<body>
<h1> Ajouter un élève </h1>
<?php

    //connexion à la BDD
    include("connexion.php");

    //date d'aujourd'hui pour dateInscription
    date_default_timezone_set('Europe/Paris');
    $date = date("Y-m-d");

    //récuperer les infos du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $naissance = $_POST['naissance'];

    //verification si une des données est vide
    //onclick est une fonction javascript lorsqu'on clique sur le bouton la fonction javascript windows... est exécuté
    if(empty($nom)|| empty($prenom) || empty($naissance) ){
        echo"<p>Un champ est vide </p>";
        echo"<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
        echo"<input type='button' onclick=\"window.location='ajout_eleve.html'\" value='Ajouter un élève' />";
        exit;
    }

    //verifie si un élève avec le même nom et prénom est enregistré
    $verif = "SELECT nom, prenom FROM eleves WHERE nom = '$nom' AND prenom ='$prenom'";
    $result1 = mysqli_query($connect, $verif);
    if (!$result1){
        echo "<p> La requête n'a pas pu aboutir</p>".mysqli_error($connect);
        exit;
    }


    //mysqli_num_rows($result1) > 0 si  lors de la vérification on a trouvé une autre personne avec le même nom et prenom
    if (mysqli_num_rows($result1) > 0) {
        //si l'élève existe déjà, génère une table qui récapitule les infos et demande s'il veut vraiment l'ajouter
        //input type hidden sert a stocker les valeurs dans le formulaire pour être utilisé dans la base de donnée sans le montrer à l'utilisateur
        echo <<< HTML
        <p> Un élève avec le même nom et prénom existe déjà, êtes vous sûr de vouloir l'ajouter ? </p>

            <!--tr est pour passer à la colonne suivante
                th est pour les main-cellules qui sont les noms des colonnes/lignes
                td est pour les données dans ces colonnes/lignes
            -->
        <table>
            <tr> <th> Nom </th> <th> Prénom </th> <th> Date de naissance </th> </tr>
            <tr> <td>$nom</td> <td>$prenom</td>  <td>$naissance</td> </tr>
        </table><br>

            <form action = 'valider_eleve.php' method = 'post'>
            <input name='nom' type='hidden' value='$nom'>
            <input name='prenom' type='hidden' value='$prenom'>
            <input name='naissance' type='hidden' value='$naissance'>

            <input type='submit' value='Valider'>
        HTML;

            echo"<input type='button' onclick=\"window.location='accueil.html'\" value='Ne pas rajouter' />";
            echo"</form>";
        
    } 

    else{//dans ce cas l'élève n'est pas dans la base
        if ($naissance > $date){// la date de naissance est dans le futur 
            echo "<p> Vous avez saisi une date de naissance dans le futur. </p>";
            echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
            echo "<input type='button' onclick=\"window.location='ajout_eleve.html'\" value='Ajouter un élève' />";
            exit;

        } 
        //insère l'élève dans la BDD
        $query2 = "INSERT INTO eleves VALUES (NULL,"."'$nom'"." , "."'$prenom'"." , "."'$naissance'"." ,"."'$date'".")";
        $result2 = mysqli_query($connect, $query2);
        if (!$result2){
            echo "<p> La requête n'a pas pu abotuir </p>".mysqli_error($connect);
            exit;
        } 
        //message qui indique à l'utilisateur que l'élève a bien été ajouté
        echo"<p>L'élève $nom $prenom né le $naissance a bien été ajouté. </p>";
        echo "<input type='button' onclick=\"window.location='ajout_eleve.html'\" value='Ajouter un autre élève' />";
        echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";

    } 

    mysqli_close($connect);
?>
    
</body>
</html>


