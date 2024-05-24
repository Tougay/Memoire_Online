<?php
include 'config.php';

$domaine_filter = isset($_GET['domaine']) ? $_GET['domaine'] : '';

$sql = "SELECT * FROM memoires";
if ($domaine_filter) {
    $sql .= " WHERE domaine = ?";
}
$sql .= " ORDER BY annee DESC";

$stmt = $pdo->prepare($sql);
if ($domaine_filter) {
    $stmt->execute([$domaine_filter]);
} else {
    $stmt->execute();
}
$memoires = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mémoire Online</title>
  <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        #header {
            background-color: #343a40;
            color: white;
            padding: 15px 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        #header img {
            height: 50px;
        }
        #header h1 {
            font-size: 24px;
            margin: 0 10px;
        }
        #header form {
            display: flex;
            align-items: center;
        }
        #header input[type="text"] {
            padding: 5px;
            font-size: 14px;
            margin-right: 10px;
        }
        #header button {
            padding: 5px 10px;
            font-size: 14px;
        }
        #main {
            padding: 20px;
        }
        #publication, #categories, #new {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        #categories a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            border-radius: 3px;
        }
        #categories a:hover {
            background-color: #ddd;
        }
        #categories a.active {
            font-weight: bold;
            color: white;
            background-color: #343a40;
        }
        #new table {
            width: 100%;
            border-collapse: collapse;
        }
        #new th, #new td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        #new th {
            background-color: #343a40;
            color: white;
        }
        #footer {
            text-align: center;
            padding: 10px;
            background-color: #f2f2f2;
        }
    </style>
    <script>
        function highlightActiveLink() {
            var links = document.querySelectorAll('#categories a');
            links.forEach(function(link) {
                if (link.href === window.location.href) {
                    link.classList.add('active');
                }
            });
        }
        window.onload = highlightActiveLink;
    </script>
</head>
<body>
<div id="header">
    <img src="5570061.jpg" alt="Mémoire Online Logo" width="200" height="50">
    <h1>Mémoire Online</h1>
    <form method="get" action="">
        <input type="text" name="search" placeholder="Rechercher sur le site">
        <button type="submit">Recherche</button>
    </form>
</div>

<div id="main">
    <section id="publication">
        <h2>PUBLIEZ VOTRE MÉMOIRE</h2>
        <p>Envoyez votre mémoire rapidement et sans inscription en <a href="submit.php">cliquant ici</a></p>
    </section>

    <section id="categories">
        <h2>Catégories</h2>
        <table>
            <tr>
                <td>
                    <a href="index.php?domaine=Arts, Philosophie et Sociologie">Arts, Philosophie et Sociologie</a>
                    <a href="index.php?domaine=Communication et Journalisme">Communication et Journalisme</a>
                    <a href="index.php?domaine=Enseignement">Enseignement</a>
                    <a href="index.php?domaine=Informatique et Télécommunications">Informatique et Télécommunications</a>
                    <a href="index.php?domaine=Sport">Sport</a>
                </td>
                <td>
                    <a href="index.php?domaine=Biologie et Médecine">Biologie et Médecine</a>
                    <a href="index.php?domaine=Droit et Sciences Politiques">Droit et Sciences Politiques</a>
                    <a href="index.php?domaine=Géographie">Géographie</a>
                    <a href="index.php?domaine=Ressources humaines">Ressources humaines</a>
                    <a href="index.php?domaine=Tourisme">Tourisme</a>
                </td>
                <td>
                    <a href="index.php?domaine=Commerce et Marketing">Commerce et Marketing</a>
                    <a href="index.php?domaine=Économie et Finance">Économie et Finance</a>
                    <a href="index.php?domaine=Histoire">Histoire</a>
                    <a href="index.php?domaine=Sciences">Sciences</a>
                    <a href="index.php?domaine=Rapports de stage">Rapports de stage</a>
                </td>
            </tr>
        </table>
    </section>

   <section id="new">
    <h2>NOUVEAU</h2>
    <table>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Université</th>
            <th>Année</th>
            <th>Domaine</th>
            <th>Voir</th>
            <th>Télécharger</th>
        </tr>
        <?php foreach ($memoires as $memoire): ?>
            <tr>
                <td><?php echo htmlspecialchars($memoire['titre']); ?></td>
                <td><?php echo htmlspecialchars($memoire['auteur']); ?></td>
                <td><?php echo htmlspecialchars($memoire['universite']); ?></td>
                <td><?php echo htmlspecialchars($memoire['annee']); ?></td>
                <td><?php echo htmlspecialchars($memoire['domaine']); ?></td>
                <!-- Lien pour voir le mémoire -->
                <td><a href="view.php?id=<?php echo $memoire['id']; ?>" target="_blank">Voir</a></td>
                <!-- Lien pour télécharger le mémoire -->
                <td><a href="uploads/<?php echo htmlspecialchars($memoire['fichier']); ?>" download>Télécharger</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
</div>

<div id="footer">
    <p>Ce site Web utilise des cookies pour vous garantir la meilleure expérience sur notre site Web. Apprendre encore plus <a href="#">Apprendre encore plus</a></p>
</div>

</body>
</html>
