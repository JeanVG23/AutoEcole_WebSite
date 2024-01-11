<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../CSS/style.css" rel="stylesheet">
    <title>Consultation élève</title>
</head>
<body>
<h1> Consulter un elève </h1>
<h2> Entrez la (ou les) informations que vous connaissez sur l'élève que vous recherchez </h2>
<div class="form">
            <form class="form.style" action="consulter_eleve.php" method="POST">
                <label for="nom"> Nom:</label><br>
                <input type="text" name="nom" id="nom" ><br>
                <label for="prenom"> Prénom:</label><br>
                <input type="text" name="prenom" id="prenom" ><br>
                <label for="naissance"> Date de naissance:</label><br>
                <input type="date" name="naissance" id="naissance" ><br><br>
                <input type="submit" value="Envoyer">
            </form>
</body>
</html>