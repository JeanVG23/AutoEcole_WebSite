<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type = "text/css" href="../CSS/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valider la séance</title>
</head>
<body>
    <h1> Valider une seance dans le passé </h1>
    <h2> Notez les eleves pour la seance que vous avez selectionné </h2>
    <?php
        //connexion a la BDD
        include('connexion.php');

        //transmission donnée du formulaire
        $seance = $_POST['choixseancefaite'];
        
        //verif de la saisie
        if (empty($seance)){
          echo "<p> Il faut sélectionner une séance</p>";
          echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
          echo "<input type='button' onclick=\"window.location='validation_seance.php'\" value='Valider une séance' />";
          exit;
        }
        
        // selection des inscription de la seance
        $query1 = "SELECT * FROM inscription INNER JOIN eleves ON inscription.ideleve = eleves.ideleve WHERE inscription.idseance = '$seance'";
        // renvoie idseance/ideleve/note/ideleve/nom/prenom/datenaiss
        // le contenu est tous les eleves inscrit a la seance
        $result1 = mysqli_query($connect, $query1);

        if (!$result1){
            echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
            echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
            echo "<input type='button' onclick=\"window.location='validation_seance.php'\" value='Retour' />";
        exit;
        }

        //on renvoie un erreur si aucun élève n'est inscrit à la séance
        if (mysqli_num_rows($result1) == 0){
            echo"<p> Aucun eleve n'est inscrit à cette séance. </p>";
        } 

        else{
            // il y a des eleves inscrits
            //formulaire qui affiche les eleves 1 a 1 et on donne la possibilité de rentrer le nombre d'erreur des eleves de la seance  
            echo"<FORM action='noter_eleves.php' method='post'><br>";
            echo"<table border=1>";
            echo"<tr> <th> Nom:</th> <th> Prenom: </th> <th>Nombre de fautes:</th> </tr>";

            while ($row1 = mysqli_fetch_array($result1, MYSQLI_NUM)){ // pour chaques eleves inscrits

              echo "<input type='hidden' value='$row1[1]' name='ideleve_$row1[1]'>"; // transmet l'id de l'élève pour le traitement des informations
              echo "<tr><td> $row1[4]</td><td> $row1[5]</td>";

              // si l'élève n'est pas encore noté, le champ est vide
              // row1[2] est le nombre de faute que l'on met. Sa valeur par default est -1
              if($row1[2] == -1){ 
                echo "<td><input type='number' name='nbfautes_$row1[1]'  max='40' id='nombre'></td>";
              }
              
              //si l'élève est noté, on affiche sa note
              else{ 
                $fautes = 40 - $row1[2];
                echo "<td><input type='number' name='nbfautes_$row1[1]'  max='40' id='nombre' value='$fautes'></td>";
              }
              echo "</tr>";
            }

            echo "</table>";
            //transmission de l'id de la séance pour le traitement en php
            echo "<input type='hidden' name='id_seance' value='$seance'>";
            echo "<br>";
            echo "<input type='submit' value='Valider les notes pour cette séance'>";
            echo "</FORM>";
        }
  
        //boutons pour naviguer entre les séances
        echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
        echo "<input type='button' onclick=\"window.location='validation_seance.php'\" value='Valider une autre séance' />";
    
        mysqli_close($connect);
  
    ?>
    
</body>
</html>