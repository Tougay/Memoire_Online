<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $universite = $_POST['universite'];
    $annee = $_POST['annee'];
    $domaine = $_POST['domaine'];
    $fichier = $_FILES['fichier']['name'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($fichier);

    if (move_uploaded_file($_FILES['fichier']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO memoires (titre, auteur, universite, annee, domaine, fichier) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titre, $auteur, $universite, $annee, $domaine, $fichier]);
        echo "Mémoire soumis avec succès.";
        // Redirection vers la page principale après soumission réussie
        header("Location: index.php");
        exit();
    } else {
        echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Publier un mémoire sur MemoireOnline</title>
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js" defer></script>
</head>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h2 {
    text-align: center;
    color: #333;
}

.instructions {
    margin-bottom: 20px;
}

.instructions p, .instructions ul, .instructions h3 {
    color: #555;
    margin-bottom: 10px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
    color: #555;
}

input[type="text"],
input[type="number"],
input[type="file"],
select {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
    box-sizing: border-box;
}

button {
    padding: 10px 15px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

input[type="checkbox"] {
    margin-right: 10px;
}

a {
    color: #007BFF;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

footer {
    text-align: center;
    margin-top: 20px;
    color: #555;
}

footer a {
    color: #007BFF;
    text-decoration: none;
}

footer a:hover {
    text-decoration: underline;
}

</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('memoireForm');

    form.addEventListener('submit', function (e) {
        const conditions = document.getElementById('conditions');
        if (!conditions.checked) {
            e.preventDefault();
            alert('Vous devez accepter les conditions de publication avant de soumettre votre mémoire.');
        }
    });
});	
</script>
<body>
    <div class="container">
        <h1>Publier un mémoire sur MemoPublish</h1>
        <form action="submit.php" method="post" enctype="multipart/form-data" id="memoireForm">
            <label for="titre">Titre du mémoire :</label>
            <input type="text" name="titre" id="titre" required><br><br>

            <label for="auteur">Nom de l'auteur :</label>
            <input type="text" name="auteur" id="auteur" required><br><br>

            <label for="universite">Université :</label>
            <input type="text" name="universite" id="universite" required><br><br>

            <label for="annee">Année :</label>
            <input type="number" name="annee" id="annee" required><br><br>

            <label for="domaine">Domaine :</label>
            <select name="domaine" id="domaine" required>
                <option value="Arts, Philosophie et Sociologie">Arts, Philosophie et Sociologie</option>
                <option value="Communication et Journalisme">Communication et Journalisme</option>
                <option value="Enseignement">Enseignement</option>
                <option value="Informatique et Télécommunications">Informatique et Télécommunications</option>
                <option value="Sport">Sport</option>
                <option value="Biologie et Médecine">Biologie et Médecine</option>
                <option value="Droit et Sciences Politiques">Droit et Sciences Politiques</option>
                <option value="Géographie">Géographie</option>
                <option value="Ressources humaines">Ressources humaines</option>
                <option value="Tourisme">Tourisme</option>
                <option value="Commerce et Marketing">Commerce et Marketing</option>
                <option value="Économie et Finance">Économie et Finance</option>
                <option value="Histoire">Histoire</option>
                <option value="Sciences">Sciences</option>
                <option value="Rapports de stage">Rapports de stage</option>
            </select><br><br>

            <label for="fichier">Fichier à publier :</label>
            <input type="file" name="fichier" id="fichier" required><br><br>

            <input type="checkbox" name="conditions" id="conditions" required>
            <label for="conditions">J'accepte les <a href="conditions_de_publication.html">conditions de publication</a></label><br><br>

            <button type="submit">J'accepte les conditions et je publie mon mémoire</button>
        </form>
    </div>
    <footer>
        <p>Si vous rencontrez des difficultés pour utiliser ce formulaire, n'hésitez pas à prendre contact avec le <a href="mailto:webmaster@memoireonline.com">webmaster</a>.</p>
        <p><a href="index.php">Retour page d'accueil</a></p>
    </footer>
</body>
</html>

