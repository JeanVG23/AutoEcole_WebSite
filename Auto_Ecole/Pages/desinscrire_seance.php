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
    <h1> Désinscrire un élève à une séance </h1>

    <?php
        //connexion à la BDD
        include("connexion.php");

        //données du formulaire
        $ideleve= $_POST[ "ideleve" ] ;

        //mise en place de la date d'aujourd'hui
        date_default_timezone_set('Europe/Paris');
        $curr_date = date("Y-m-d");

        //vérification de la saisie des données
        if (empty($ideleve)){
            echo "<p>Il faut sélectionner un élève !</p>";
            exit;
  }
        
        //selection des inscriptions de l'eleve
        $query = "SELECT *
                    FROM inscription i 
                    INNER JOIN seances s ON s.idseance = i.idseance 
                    INNER JOIN themes t ON s.idtheme = t.idtheme WHERE DATEDIFF(s.Dateseance, '$curr_date') >=0 AND ideleve=$ideleve";
        $result = mysqli_query($connect, $query);

        if (!$result){
            echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
            //boutons qui renvoient vers d'autres pages
            echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
            echo "<input type='button' onclick=\"window.location='desinscription_seance.php'\" value='Retour' />";
            exit;
           }

        //s'il n'y a pas de seance dans le futur

        if (mysqli_num_rows($result)==0){ // il n'y a pas de séance dans le futur pour vet élève
            echo"<p>L'élève n'est inscrit à aucune séance dans le futur<p>";
            //boutons qui renvoient vers d'autres pages
            echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
            echo "<input type='button' onclick=\"window.location='desinscription_seance.php'\" value='Désinscrire un autre élève' />";;
            exit;
          }
          // il y a des séance dans le futur
          // génère un select avec les séances dans le futur
          echo "<FORM METHOD='post' ACTION='desinscrire_seance_suite.php'>";
          echo "<label for='idseance'> Sélectionnez la séance</label><br>";
          echo "<select name='idseance' id='idseance' size='4'>";
          while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){// pour chaque séance affiche son thème et sa date
              echo "<option value='$row[0]'> $row[8] : $row[4]</option>";
            }
          echo"</select>";
        
          echo "<input type='hidden' value='$ideleve' name='ideleve'>"; // transmet l'id de l'élève
          echo "<br>";
          echo "<input type='submit' value='Désinscrire de cette séance'>";
        
          echo "</FORM>";
        
          mysqli_close($connect);
        
        
    ?>


    
</body>
</html>