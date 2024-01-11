<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="../CSS/style.css">
    <title> Désinscrire à une séance</title>
</head>
<body>
    <h1> Désinscrire un élève à la séance demandé</h1>

    <?php
        //connexion à la BDD
        include("connexion.php");

        //données du formulaire
        $ideleve= $_POST[ "ideleve" ] ;
        $idseance= $_POST[ "idseance" ] ;


        //vérification de la saisie des données
        if (empty($ideleve)){
            echo "<p>Il faut sélectionner un élève !</p>";
            exit;
        }
        elseif (empty($idseance)){
            echo "<p>Il faut sélectionner une séance !</p>";
            exit;
        } 

        //si données sont bien transmises
        else{
            //delete inscription
            $query = "DELETE FROM inscription WHERE ideleve = '$ideleve' AND idseance='$idseance'";
            $result = mysqli_query($connect, $query);
        
        
        if (!$result){
            echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
            //boutons qui renvoient vers d'autres pages
            echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
            echo "<input type='button' onclick=\"window.location='desinscription_seance.php'\" value='Retour' />";
            exit;
           }
        else{
            echo"<p> L'élève a bien été retiré de la séance </p>";
        } 
    }
        // boutons pour aller à l'accueil ou désinscrire un autre élève
        echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
        echo "<input type='button' onclick=\"window.location='desinscription_seance.php'\" value='Désinscrire un autre élève' />";

        mysqli_close($connect);
        
        
    ?>


    
</body>
</html>