<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajouter une séance</title>
    <link rel="stylesheet" href="../CSS/style.css">
  </head>
<body>
  <h1>Création d'une nouvelle séance</h1>
  <h2> Ajout d'une séance dans la base</h2>
  <?php

    //connexion à BDD
    include("connexion.php");


    //date minimum
    date_default_timezone_set('Europe/Paris');
    $datemin = date("Y-m-d");


    //transmission des valeurs du formulaire
    $date = $_POST['dates'];
    $effmax = $_POST['effmax'];
    $idtheme = $_POST['menuChoixTheme'];


    //vérification qu'aucune donnée est vide
    if (empty($date) || empty($effmax) || empty($idtheme)){
      echo "<p>Un champ est vide.</p>";
      exit;
      }

    if ($date < $datemin){ //vérification que la séance n'est pas dans le passé
      echo "<p>La séance ne peut pas être créée, vous avez choisi une date dans le passé. Veuillez revenir à l'accueil.</p>";
      echo"<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
      echo"<input type='button' onclick=\"window.location='ajout_seance.php'\" value='Ajouter une seance' />";
      exit;
    }
    
    //vérification de la présence ou non d'une séance avec le même thème le même jour
    $verif = "SELECT * FROM seances WHERE idtheme = '$idtheme' AND dateseance = '$date'";
    $result = mysqli_query($connect, $verif);
    if (!$result){
      echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
      exit;
    }

    if (mysqli_num_rows($result) > 0){ // il y a déjà, une séance avec ce thème ce jour là
      echo "<p>Il existe déjà une séance pour ce thème à cette date, vous ne pouvez pas en créer une autre.</p>";
    
    }

    else {// il n'existe pas de séance avec le même thème le même jour
      $query = "INSERT INTO seances values (NULL, '$date', '$effmax', '$idtheme')";
      $result2 = mysqli_query($connect, $query);

      if (!$result2){
        echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
        exit;
      }

      echo "<p>Une nouvelle séance a été créée à la date $date.</p>";
    }
    echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
    echo "<input type='button' onclick=\"window.location='ajout_seance.php'\" value='Enregistrer une autre séance' />";

    mysqli_close($connect);
  ?>
</body>
</html>