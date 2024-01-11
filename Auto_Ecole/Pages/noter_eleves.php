<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type = "text/css" href="../CSS/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noter un eleve</title>
</head>
<body>
    <h1> Noter un élève </h1>
    <?php
      // connexion à la BDD
      include("connexion.php");

      //transmission des informations du formulaire
      $idseance = $_POST['id_seance'];

      //selection de l'inscription
      $query1 = "SELECT * FROM inscription WHERE idseance = '$idseance'";
      $result1 = mysqli_query($connect, $query1);

      if (!$result1){
        echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
        exit;
      }

      //sélection des élèves inscrits à cette séance
      //row[1] est l'id eleve de la table inscription 
      while ($row1 = mysqli_fetch_array($result1, MYSQLI_NUM)){
          $nb_fautes = $_POST["nbfautes_$row1[1]"];
          
          //verifie si tous les élèves ont bien été notés
          if (empty($nb_fautes)){ 
            echo "<p> Au moins un élève n'a pas été noté !</p>";
          }

          // si le nombre de fautes a bien été rentré
          else{ 
            $ideleve = $_POST["ideleve_$row1[1]"];
            $note = 40 - $nb_fautes;

            // change la note dans la table inscription
            $query2 = "UPDATE inscription SET note = $note WHERE ideleve = '$ideleve' AND idseance = '$idseance'";
            $result2 = mysqli_query($connect, $query2);

            //on verifie si on a une erreur
            if (!$result2){
              echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
              echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
              echo "<input type='button' onclick=\"window.location='validation_seance.php'\" value='Changer de séance' />";
              exit;
            }
          }
      }
      // message qui indique à l'utilisateur que la séance a bien été notée
      echo "<p>Les notes ont été mises à jour pour les élèves que vous avez notés</p>";

      //boutons pour naviguer entre les pages
      echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
      echo "<input type='button' onclick=\"window.location='validation_seance.php'\" value='Changer de séance' />";

      mysqli_close($connect);
    ?>

  </body>
    
</body>
</html>