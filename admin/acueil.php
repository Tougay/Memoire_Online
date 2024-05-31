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

if (isset($_GET['sup'])) {
    $id = $_GET['sup'];
    $sql2 = "DELETE FROM `memoires` WHERE id='$id'";
    $stmt = $pdo->prepare($sql2);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MemoPublish</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
            background-color: #f0f0f0;
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
        .action-buttons a {
            margin-right: 10px;
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
                <th>Action</th>
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
                 <td>
            <a href="update.php?edit=<?php echo $memoire['id']; ?>" class="m-2">
              <i class="fa fa-edit fa-1x"></i>
            </a>
            <i class="fa fa-trash fa-1x red-icon"
             data-bs-toggle="modal"
             data-bs-target="#exampleModal<?php echo $memoire['id']; ?>" class="m-2">
             
             </i>

             <div class="modal fade" id="exampleModal<?php echo $memoire['id']; ?>" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body">
                    <p>Etes vous sur de vouloir supprimer?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                    data-bs-dismiss="modal">Annuler</button>
                    <a href="acueil.php?sup=<?php echo $memoire['id']; ?>">
                      <button class="btn btn-danger" type="button">Confirmer</button>
                    </a>
                  </div>
                </div>
              </div>
             </div>
          </td>
            </tr>
            
              
        <?php endforeach; ?>
    </table>
</section>
    </div>
               

<div id="footer">
    <p>© MemoPublish 2023-2024 - Pour tout problème de consultation ou si vous voulez publier un mémoire: <a href="mailto:memopublish@gmail.com">memopublish@gmail.com</a></p>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Jquery.js"></script>
</body>
</html>
