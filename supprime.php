<?php
            require_once "include/start_bdd.php";

if ($_GET) {
    $id =$_GET["id"];

    $req = $bdd->prepare("DELETE FROM liste_taches Where id=:id");
    $req->bindvalue(":id", $id);
    $req -> execute();

    header("location:index.php");
}