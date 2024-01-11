<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="../CSS/style.css">
    <title> Visualisation calendrier</title>
</head>
<body>
    <h1> Visualiser le calendrier d'un élève : </h1>

    <?php
        //connexion à la BDD
        include("connexion.php");

        //mise en place de la date d'aujourd'hui
        date_default_timezone_set('Europe/Paris');
        $curr_date = date("Y-m-d");

        //données du formulaire
        $ideleve= $_POST[ "ideleve" ];


        //vérification de la saisie des données
        if (empty($ideleve)){
            echo "<p>Il faut sélectionner un élève !</p>";
            echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
            echo "<input type='button' onclick=\"window.location='visualisation_calendrier_eleve.php'\" value='Retour' />";
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
            echo "<input type='button' onclick=\"window.location='visualisation_calendrier_eleve.php'\" value='Retour' />";
            exit;
           }

        //s'il n'y a pas de seance dans le futur

        if (mysqli_num_rows($result)==0){ // il n'y a pas d'inscription dans le futur pour cet élève
            echo"<p>L'élève n'est inscrit à aucune séance dans le futur.</p>";
            //boutons qui renvoient vers d'autres pages
            echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
            echo "<input type='button' onclick=\"window.location='visualisation_calendrier_eleve.php'\" value='Retour' />";
          }

        else{  // il y a des séance dans le futur
          // renvoie un table avec les seances et les dates de seances de l'élève
          echo"<table border=1>";
          echo"<tr><th> Thème de la séance </th> <th> Date de la séance </th>";
          while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
            echo"<tr>";
            echo"<td>$row[8]</td>";
            echo"<td>$row[4]</td>";
            echo"</tr>";      
          }  
          echo"</table>";
          echo "<br>";
          echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
          echo "<input type='button' onclick=\"window.location='visualisation_calendrier_eleve.php'\" value='Visualiser un autre calendrier'/>";
        } 
          
        
        mysqli_close($connect);
        ?>
    
</body>
</html>