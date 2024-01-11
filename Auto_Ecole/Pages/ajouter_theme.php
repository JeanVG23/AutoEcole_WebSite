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
<h1>Ajouter un thème</h1><br><br>
<?php
    //connexion à la BDD
    include("connexion.php");

    //récuperer les infos du formulaire
    $nom = $_POST['nom_theme'];
    $descript= $_POST['descrip'];

    //verification si une des données est vide
    //onclick est une fonction javascript lorsqu'on clique sur le boutton la fonction javascript windows... est exécuté
    if(empty($nom)|| empty($descript) ){
        echo"<p>Un champ est vide </p>";
        echo"<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
        echo"<input type='button' onclick=\"window.location='ajout_theme.html'\" value='Ajouter un thème' />";
        exit;
    }

    //verifie si un theme avec le même nom et la valeur de supprime =0 ou supprime= 1 est déjà enregistré
    $verif1 = "SELECT * FROM themes WHERE nom = '$nom' AND supprime ='0'";
    $result1 = mysqli_query($connect, $verif1);
    $verif2 = "SELECT * FROM themes WHERE nom = '$nom' AND supprime ='1'";
    $result2 = mysqli_query($connect, $verif2);
    if (!$result1){
        echo "<p> La requête n'a pas pu aboutir</p>".mysqli_error($connect);
        exit;
    }
    if (!$result2){
        echo "<p> La requête n'a pas pu aboutir</p>".mysqli_error($connect);
        exit;
    }


    if (mysqli_num_rows($result1) > 0) {
        //le theme existe déjà dans les theme actifs
        echo"<p> Le thème $nom existe déjà, impossible de le rajouter </p>";
        exit;
    }


    else{//le theme n'est pas dans les theme actifs
        if (mysqli_num_rows($result2) > 0){// le theme est dans les themes désactivés
            echo "<p> Le theme avait été désactivé, vous venez de le réactiver. </p>";
            $query3 = "UPDATE themes SET supprime ='0' where nom='$nom'";
            $result3 = mysqli_query($connect, $query3);
            
            if (!$result3){
                echo"<p> La requête n'a pas pu aboutir</p>".mysqli_error($connect);
            }         

        } 

        else{//Le theme n'est ni dans les themes actifs ni dans les themes désactivés
            $query = "INSERT INTO themes VALUES (NULL,'$nom', '0', '$descript')";
            $result = mysqli_query($connect, $query);
            
            if (!$result){
                echo"<p> La requête n'a pas pu aboutir</p>".mysqli_error($connect);
            } 
            else{
                echo "<p> Le thème '$nom' a bien été rajouté. </p>";
            } 
        }
    } 

    //boutons pour naviguer entre les pages
    echo"<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
    echo"<input type='button' onclick=\"window.location='ajout_theme.html'\" value='Enregistrer un autre thème' />";

    mysqli_close($connect);
?>
</body>
</html>