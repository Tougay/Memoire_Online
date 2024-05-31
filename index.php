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
    <title>DépotMemo</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }
        #header {
            background-color: #003366;
            color: white;
            padding: 15px 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        #header img {
            height: 50px;
        }
        #header h1 {
            font-size: 24px;
            margin: 0 10px;
            letter-spacing: 1px;
        }
        #header nav {
            display: flex;
            align-items: center;
        }
        #header nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            padding: 8px 16px;
            border-radius: 3px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        #header nav a:hover {
            background-color: #00509e;
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
            border: none;
            border-radius: 3px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        #header button {
            padding: 8px 16px;
            font-size: 14px;
            border: none;
            border-radius: 3px;
            background-color: #00509e;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #header button:hover {
            background-color: #007bff;
        }
        #main {
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }
        #publication, #categories, #new {
            background-color: white;
            padding: 30px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        #publication h2, #categories h2, #new h2 {
            margin-top: 0;
            color: #003366;
        }
        #categories a {
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            color: #333;
            border-radius: 5px;
            font-size: 18px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        #categories a:hover {
            color: white;
            background-color: #003366;
            transform: scale(1.05);
        }
        #categories a.active {
            font-weight: bold;
            color: white;
            background-color: #003366;
        }
        #new table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        #new th, #new td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        #new th {
            background-color: #003366;
            color: white;
        }
        /* CSS Reset for footer */
        footer, #footer {
            display: block;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            padding: 0;
        }
        
        #footer {
            text-align: center;
            padding: 20px;
            background-color: #003366;
            color: white;
            position: relative;
            margin-top: 40px;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
        }
        #footer a {
            color: #17a2b8;
            text-decoration: none;
        }
        #footer a:hover {
            text-decoration: underline;
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
            var targetPosition = document.querySelector(targetId).offsetTop - 60; // Adjusted for header height
            window.scrollTo({
                top: targetPosition,
                behavior: "smooth"
            });
        }
        window.onload = function() {
            highlightActiveLink();
            var navLinks = document.querySelectorAll('#header nav a');
            navLinks.forEach(function(link) {
                link.addEventListener('click', smoothScroll);
            });
        };
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div id="header">
    <img src="5570061.jpg" alt="Mémoire Online Logo" width="200" height="50">
    <h1>DépotMemo</h1>
    <nav>
        <a href="#publication">Publication</a>
        <a href="#categories">Catégories</a>
        <a href="#new">Nouveau</a>
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
  <div id="footer">
        <p>© DépotMemo 2023-2024 - Pour tout problème de consultation ou si vous voulez publier un mémoire: <a href="mailto:depotmemo@gmail.com">depotmemo@gmail.com</a></p>
    </div>


</body>
</html>
