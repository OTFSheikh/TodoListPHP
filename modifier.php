<?php
            require_once "include/start_bdd.php";

            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Tâches</title>
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
    <h1>To Do List App</h1>
    <h3>Page de modification</h3>
    <form action="" method="post">
        <table>
            <tr><td>Nom de la tache : </td><td><input type="text" name="nom" id="nom" placeholder="Entrer le nom de la tâche" size = 50 value="<?=$liste['tache']?>"></td></tr>
            <tr><td>Description de la tâche : </td><td><textarea name="description" id="description" placeholder="Entrer la description de la tâche" cols="48" rows="5" ><?=$liste['description']?></textarea></td></tr>
            <tr><td>Date d'échéance : </td><td><input type="date" name="date" id="date" value="<?=$liste['date']?>"></td></tr>
            <tr><td><input type="submit" value="Modifier" name="modifier"></td><td><input type="reset" value="Effacer"></td></tr>
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