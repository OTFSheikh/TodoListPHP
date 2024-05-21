<?php
            require_once "include/start_bdd.php";

            ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="include/Style.css">
    <style>
        
    </style>
    <title>Todo List App</title>
</head>
<body>
    <h1>OTF ToDo List</h1>
    <h3>Une ToDoList Simple codée par @OTFSheikh</h3>
    <div class="form">
    <form action="" method="post">
        <table>
            <tr><td>Nom de la tache : </td><td><input type="text" name="nom" id="nom" placeholder="Entrer le nom de la tâche" size = 50></td></tr>
            <tr><td>Description de la tâche : </td><td><textarea name="description" id="description" placeholder="Entrer la description de la tâche" cols="48" rows="5"></textarea></td></tr>
            <tr><td>Date d'échéance : </td><td><input type="date" name="date" id="date"></td></tr>
            <br>
            <tr><td><input type="submit" value="Ajouter" name="ajouter"></td><td><input type="reset" value="Effacer"></td></tr>
        </table>  
    </form>
    </div>

    <?php
    if (isset($_POST['ajouter'])) {
        if (empty($_POST["nom"])) {
            $message = "le nom de la tâches ne doit pas être vide ! ";
        } elseif (empty($_POST["description"])) {
            $message = "Entrer une courte description pour vous motivez :)";
        } elseif (empty($_POST["date"])) {
            $message = "la date d'échéance est requise !";
        } else {
            $nom = strip_tags($_POST["nom"]);
            $description = strip_tags($_POST["description"]);
            $date = strip_tags($_POST["date"]);

            $req = $bdd->prepare("INSERT INTO liste_taches(tache, description, date) VALUES (:nom, :description, :date)");

            $req->bindvalue(":nom", $nom);
            $req->bindvalue(":description", $description);
            $req->bindvalue(":date", $date);

            $resultat = $req->execute();
            if (!$resultat) {
                $message = "Erreur de connexion à la base de donnée";
            } else {
                $message = "La tâche a été ajoutée";
            }
        }
        echo "<h5 style='textalign=centre'>".$message."</h5>";
    }

    

    $req1 = $bdd->prepare("SELECT * FROM liste_taches");
    $resultat1 = $req1->execute();
    $liste = $req1->fetchAll(PDO::FETCH_ASSOC);
    $nbre = $req1->rowCount();
    ?>
    <div class="table">
    <table>
        <tr>
            <th>Tâches</th>
            <th>Description</th>
            <th>Date</th>
            <!-- <th>Status</th> -->
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    <?php

    if ($nbre!=0) {
        // echo "<pre>";
        // print_r($liste);
        foreach ($liste as $key => $value){
            ?>
            <tr>
                <td><?=$value["tache"]?></td>
                <td><?=$value["description"]?></td>
                <td><?=$value["date"]?></td>
                <!-- <td><input type="checkbox" name="isdone" id="isdone"></td> -->
                <td><a href="modifier.php?id=<?=$value["id"]?>">Modifier</a></td>
                <td><a href="supprime.php?id=<?=$value["id"]?>">Supprimer</a></td>
            </tr>
            </div>
            <?php
        }
    }
       
    
       ?>
       <!-- <input type="submit" value="Appliquer" name='appliquer'> -->
    </table>
</body>
</html>