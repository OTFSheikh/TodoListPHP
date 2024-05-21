<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List App</title>
</head>
<body>
    <h1>To Do List App</h1>
    <h3>Une ToDoList performante codé par @OTFSheikh</h3>
    <form action="" method="post">
        <table>
            <tr><td>Nom de la tache : </td><td><input type="text" name="nom" id="nom" placeholder="Entrer le nom de la tâche" size = 50></td></tr>
            <tr><td>Description de la tâche : </td><td><textarea name="description" id="description" placeholder="Entrer le nom de la tâche" cols="48"></textarea></td></tr>
            <tr><td>Date d'échéance : </td><td><input type="date" name="date" id="date"></td></tr>
            <br>
            <tr><td><input type="submit" value="Ajouter" name="ajouter"></td><td><input type="reset" value="Effacer"></td></tr>
        </table>
    </form>
</body>
</html>