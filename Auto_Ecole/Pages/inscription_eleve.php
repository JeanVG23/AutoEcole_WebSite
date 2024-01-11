<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription d'un élève</title>
    <link rel="stylesheet" type = "text/css" href="../CSS/style.css">
  </head>
  <body>
    <h1> Inscription d'un élève à une séance</h1>
    <h2>Veuillez sélectionnez un élève et une séance</h2>
    <?php
      //connexion à la BDD
      include("connexion.php");

      //mise en place de la date
      date_default_timezone_set('Europe/Paris');
      $datemin = date("Y-m-d");

      //sélection et affichage des séances dans le futur
      $query1 = "SELECT * FROM seances INNER JOIN themes ON seances.idtheme = themes.idtheme WHERE DATEDIFF( `Dateseance` , '$datemin' ) >=0 ORDER BY themes.nom";
      // renvoie idseance dateseance effmax idtheme idtheme nom supprime descriptif
      $result1 = mysqli_query($connect, $query1);
      if(!$result1){
        echo "<p>La requête 1 n'a pas pu aboutir : </p>".mysqli_error($connect);
        exit;
      }
    ?>

    <FORM METHOD='POST' ACTION='inscrire_eleve.php' >
    <label for='choixseance'>Choix du thème et de la date :</label><br>
    <select name='choixseance' id='choixseance' size='4'>

    <?php
        while ($row1 = mysqli_fetch_array($result1, MYSQLI_NUM)) {
          echo "<option value=$row1[0]>$row1[5] : $row1[1]</option>";
        }
        echo "</select>";
        echo "<br>";

        //sélection et affichage des élèves dans un select
        $query2 = "SELECT * FROM eleves ORDER BY nom";
        $result2 = mysqli_query($connect, $query2);
    ?>

        <label for='choixeleve'>Choix de l'élève à inscrire : </label><br>
        <select name='choixeleve' id='choixeleve' size='5'>
    <?php
        while ($row2 = mysqli_fetch_array($result2, MYSQLI_NUM)) {
              echo "<option value=$row2[0]>$row2[1] $row2[2], né(e) le $row2[3]</option>";
            }
        echo "</select>";
        echo "<br>";
    ?>
        <input type='submit' value='Valider cette inscription '>

        </FORM>
    <?php
        mysqli_close($connect);
    ?>
  </body>
</html>