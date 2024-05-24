<?php
// Inclure le fichier de configuration
include 'config.php';

// Vérifier si l'ID du mémoire est passé en paramètre
if(isset($_GET['id'])) {
    // Récupérer l'ID du mémoire depuis l'URL
    $memoire_id = $_GET['id'];
    
    // Préparer la requête pour récupérer le mémoire par son ID
    $sql = "SELECT * FROM memoires WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    
    // Exécuter la requête en passant l'ID du mémoire
    $stmt->execute([$memoire_id]);
    
    // Récupérer le mémoire
    $memoire = $stmt->fetch();

    // Vérifier si le mémoire existe
    if($memoire) {
        // Afficher le contenu du mémoire
        echo "<h2>{$memoire['titre']}</h2>";
        echo "<p><strong>Auteur:</strong> {$memoire['auteur']}</p>";
        echo "<p><strong>Université:</strong> {$memoire['universite']}</p>";
        echo "<p><strong>Année:</strong> {$memoire['annee']}</p>";
        echo "<p><strong>Domaine:</strong> {$memoire['domaine']}</p>";
        
        // Afficher le contenu du fichier PDF dans un lecteur PDF intégré
        echo "<iframe src='uploads/{$memoire['fichier']}' width='100%' height='500px' style='border: none;'></iframe>";
    } else {
        // Si le mémoire n'existe pas, afficher un message d'erreur
        echo "Mémoire non trouvé.";
    }
} else {
    // Si l'ID du mémoire n'est pas spécifié, afficher un message d'erreur
    echo "ID du mémoire non spécifié.";
}
?>
