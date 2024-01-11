<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type = "text/css" href="../CSS/style.css">
        <title>Inscrire un élève</title>
    </head>
    <body>
        <h1> Inscription d'une élève à une séance </h1>
        <?php

            //connexion à la BDD
            include("connexion.php");

            //récuperer les infos du formulaire
            $idseance = $_POST['choixseance'];  
            $ideleve= $_POST['choixeleve'];    

            //verification qu'aucune donnée soit vide
            //onclick est une fonction javascript lorsqu'on clique sur le boutton la fonction javascript windows... est exécuté
            if(empty($idseance)|| empty($ideleve) ){
                echo"<p>Un champ est vide </p>";
                echo"<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
                echo"<input type='button' onclick=\"window.location='inscription_eleve.php'\" value='Ajouter un eleve' />";
                exit;
            }

            //selection de la bonne seance pour verif l'effectif max
            $query1 = "SELECT * FROM seances WHERE idseance = '$idseance'";
            $result1 = mysqli_query($connect, $query1);
            if (!$result1){
                echo "<p> La requête n'a pas pu aboutir </p>".mysqli_error($connect);
                exit;
            }

            while ($row1 = mysqli_fetch_array($result1, MYSQLI_NUM)){
                $effmax = $row1[2]; // c'est l'effectif max

                // on selectionne toutes les inscriptions a la seance
                $query2 = "SELECT * FROM inscription WHERE idseance ='$idseance'";
                $resultat2 = mysqli_query($connect, $query2);

                if(!$resultat2){
                    echo "<p> La requête n'a pas pu aboutir </p>".mysqli_error($connect);
                    exit;
                } 
            }

            if (mysqli_num_rows($resultat2) >= $effmax){
                //Impossible d'ajouter de nouveaux eleve
                echo"<p>Cette seance est deja complete, aucun eleve ne peut être ajouté.</p>";

            } 
            else{
                while ($row2 = mysqli_fetch_array($resultat2, MYSQLI_NUM) ){
                    if ($row2[1] == $ideleve){
                        echo "<p> Cet eleve est déjà ajouté </p>";
                        exit;
                    } 
                } 
            
                //Si les verifications sont passées alors on peut inscrire l'eleve
                $query3 = "INSERT INTO inscription VALUES ('$idseance', '$ideleve', -1)";
                $resultat3 = mysqli_query($connect, $query3);
                if(!$resultat3 ){
                    echo "<p> La requête n'a pas pu aboutir</p>".mysqli_error($connect);
                } 
                else{
                    echo "<p> L'élève a bien été inscrit.</p><br><br>";
                } 
            } 


            //boutons de navigation
            echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
            echo "<input type='button' onclick=\"window.location='inscription_eleve.php'\" value='Enregistrer un autre élève' />";


            mysqli_close($connect);

        ?>
    </body>
</html>