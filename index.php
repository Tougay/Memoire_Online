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
    <title>MemoPublish</title>
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
        #header nav {
            display: flex;
            align-items: center;
        }
        #header nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            padding: 5px 10px;
            border-radius: 3px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        #header nav a:hover {
            background-color: #495057;
            transform: scale(1.1);
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
            padding: 15px 20px;
            text-decoration: none;
            color: #333;
            border-radius: 5px; 
            font-size: 25px; 
            margin-bottom: 10px; 
            transition: background-color 0.3s ease, transform 0.3s ease; 
        }
        #categories a:hover {
            background-color: #ddd;
            transform: scale(1.05); 
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
            background-color: #343a40;
            color: white;
            position: relative;
        }
        #footer a {
            color: #17a2b8;
            text-decoration: none;
        }
        #footer a:hover {
            text-decoration: underline;
        }
        #contact {
            background-color: white;
            padding: 20px;
            margin: 20px auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
        }
        #contact h2 {
            margin-top: 0;
            color: #343a40;
        }
        #contact form {
            display: flex;
            flex-direction: column;
        }
        #contact label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        #contact input[type="text"],
        #contact input[type="email"],
        #contact textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 3px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }
        #contact button {
            padding: 10px 20px;
            background-color: #343a40;
            color: white;
            border: none;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #contact button:hover {
            background-color: #495057;
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
        function smoothScroll(event) {
            event.preventDefault();
            var targetId = event.currentTarget.getAttribute("href");
            var targetPosition = document.querySelector(targetId).offsetTop;
            window.scrollTo({
                top: targetPosition,
                behavior: "smooth"
            });
        }
        window.onload = function() {
            highlightActiveLink();
            var navLinks = document.querySelectorAll('#header nav a, #footer a');
            navLinks.forEach(function(link) {
                link.addEventListener('click', smoothScroll);
            });
        };
    </script>
</head>
<body>
<div id="header">
    <img src="5570061.jpg" alt="Mémoire Online Logo" width="200" height="50">
    <h1>MemoPublish</h1>
    <nav>
        <a href="#publication">Publication</a>
        <a href="#categories">Catégories</a>
        <a href="#new">Nouveau</a>
        <a href="#contact">Contact</a>
    </nav>
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

<!--
<div id="footer">
    <p>Ce site Web utilise des cookies pour vous garantir la meilleure expérience sur notre site Web. Apprendre encore plus <a href="#contact">Contact</a></p>
</div>
-->

<section id="contact">
    <h2>Contactez-nous</h2>
    <form>
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>
        <br>
        <button type="submit">Envoyer</button>
    </form>
</section>

</body>
</html>
