<?php
require_once ('config.php');


$id = $_GET['edit'];
$sql = "SELECT * FROM memoires WHERE id='$id'";
$stmt = $pdo->prepare($sql);
$stmt->execute();

if (isset($_POST['modifier'])) {
    $id = $_GET['edit'];
    
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $universite = $_POST['universite'];
    $annee = $_POST['annee'];
    $domaine = $_POST['domaine'];
    $fichier = $_FILES['fichier']['name'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($fichier);
    
    $sql2 = "UPDATE `memoires` SET  titre=:titre, auteur=:auteur, universite=:universite, annee=:annee, domaine=:domaine,fichier=:fichier WHERE  id='$id'";
    $stmt2 = $pdo->prepare($sql2);

     $stmt2 ->bindParam(":titre",$titre); 
     $stmt2 ->bindParam(":auteur",$auteur); 
     $stmt2 ->bindParam(":universite",$universite); 
     $stmt2 ->bindParam(":annee",$annee); 
     $stmt2 ->bindParam(":domaine",$domaine); 
     $stmt2 ->bindParam(":fichier",$fichier); 
     $stmt2->execute();header("location:acueil.php");
}
?>
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
<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
  <title>Gestion</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css" >
    <script src="scripts.js" defer></script>
</head>
<body>
 <div class="container">
        <h1>Publier un mémoire sur MemoPublish</h1>
        
        
    
        <?php foreach ($stmt as $memoire){ ?>
        
        <form action="" method="POST" enctype="multipart/form-data" id="memoireForm">
            <label for="titre">Titre du mémoire :</label>
            <input type="text" name="titre" id="titre" value="<?php  echo $memoire['titre'] ?>"><br><br>

            <label for="auteur">Nom de l'auteur :</label>
            <input type="text" name="auteur" id=""  value="<?php echo $memoire['auteur'] ?>"><br><br>

            <label for="universite">Université :</label>
            <input type="text" name="universite" id="universite"  required  value="<?php echo $memoire['universite'] ?> "><br><br>

            <label for="annee">Année :</label>
            <input type="number" name="annee" id="annee" required value="<?php echo $memoire['annee'] ?> "><br><br>

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
            <input type="file" name="fichier" id="fichier" required value="<?php echo $memoire['fichier'] ?> "><br><br>

            <button type="submit" name="modifier" class="btn btn-success">Modifier</button>
            
        </form>
    <?php } ?>
    </div>
 
 
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
  <script src="js/bootstrap.js"></script>
<script src="js/Jquery.js"></script>
</body>
<div id="footer">
    <p>© MemoPublish 2023-2024 - Pour tout problème de consultation ou si vous voulez publier un mémoire: <a href="mailto:memopublish@gmail.com">memopublish@gmail.com</a></p>
</div>
</html>