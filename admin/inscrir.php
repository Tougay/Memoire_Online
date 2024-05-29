<?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "DB";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Register button clicked
    if(isset($_POST['register'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
   // Check if password is at least 8 characters long
//        if(strlen($password) < 8){
//            echo "Le mot de passe doit contenir au moins 8 caractères.";
         if (strlen($password) < 8 || !ctype_upper($password[0]) || !preg_match('/[0-9]/', $password) || !preg_match('/[a-zA-Z]/', $password)) {
            echo "Erreur: Password must contain at least 8 characters, start with a capital letter, and contain at least one number and one letter.";
            
        }else{
        // Insert data into database
        $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$nom', '$prenom', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Niveau Utilisateur créer avec succés";
        } else {
            echo "Erreur: " . $sql . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    }
    }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
    <title>Registration Form</title>
</head>
<body>
   <ul class="navbar">
        <li><a href="#home">Accueil</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="co.php">Se connecter</a></li>
    </ul>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        Nom: <input type="text" name="firstname"><br>
        Prénom: <input type="text" name="lastname"><br>
        Adresse e-mail: <input type="email" name="email"><br>
        Mot de passe: <input type="password" name="password"><br>
        <input type="submit" name="register" value="Inscription"  >
    </form>
    
</body>
</html>