<?php
            require_once "include/start_bdd.php";

            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Tâches</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
}

h5 {
    text-align: center;
    color: #333;
}
h1 {
    font-size: 2em;
    color: #333;
    text-align: center;
    margin-bottom: 0.5em;
}

h3 {
    font-size: 1.5em;
    color: #666;
    text-align: center;
    margin-bottom: 1em;
}

form {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.1);
}

form input[type="text"], form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
}

form input[type="submit"], input[type="reset"]  {
    padding: 10px 20px;
    background-color: #007BFF;
    border: none;
    color: #fff;
    cursor: pointer;
    margin-top: 10px;
}

form input[type="submit"]:hover {
    background-color: #0056b3;
}
.lien-retour {
    display: inline-block;
    padding: 10px 20px;
    background-color: #f44336; 
    color: #fff; 
    text-decoration: none; 
    margin-top : 10px;
}

.lien-retour:hover {
    background-color: #d32f2f; 
}
    </style>
</head>
<body>
<?php
if ($_GET) {
    $id = $_GET['id'];
    $req1 = $bdd->prepare("SELECT * FROM liste_taches where id=:id");
    $req1->bindvalue(":id",$id);
    $resultat1 = $req1->execute();
    $liste = $req1->fetch(PDO::FETCH_ASSOC);
    ?>
    <h1>OTF ToDo List</h1>
    <h3>Modification des tâches</h3>
    <form action="" method="post">
        <table>
            <tr><td>Nom de la tache : </td><td><input type="text" name="nom" id="nom" placeholder="Entrer le nom de la tâche" size = 50 value="<?=$liste['tache']?>"></td></tr>
            <tr><td>Description de la tâche : </td><td><textarea name="description" id="description" placeholder="Entrer la description de la tâche" cols="48" rows="5" ><?=$liste['description']?></textarea></td></tr>
            <tr><td>Date d'échéance : </td><td><input type="date" name="date" id="date" value="<?=$liste['date']?>"></td></tr>
            <tr><td><input type="submit" value="Modifier" name="modifier"></td><td><a href="index.php" class="lien-retour">Retour</a></td></tr>
        </table>
    </form>
    <?php
    if (isset($_POST["modifier"])) {
        if (empty($_POST['nom']) || empty($_POST['date'])|| empty($_POST['description'])) {
            $message = "Tous les champs sont requis !";
        }else {
            $nom = strip_tags($_POST['nom']);
            $description = strip_tags($_POST['description']);
            $date = strip_tags($_POST['date']);

            $req = $bdd->prepare("UPDATE liste_taches SET tache=:nom, description=:description, date=:date WHERE id=:id");

            $req ->bindvalue(":nom", $nom);
            $req ->bindvalue(":description", $description);
            $req ->bindvalue(":date", $date);
            $req ->bindvalue(":id", $id);

            $result = $req->execute();

            if (!$result) {
                $message = "Probleme de connexion à la base de donnée";
            }else {
                $message = "La tâche a été modifiée";
                echo "<script>alert('$message'); document.location.href = 'index.php';</script>";
            }
        }
        echo "<h5>".$message."</h5>";

    }

?>
    <?php
}
?>
</body>
</html>