<?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "memoire_online";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Login button clicked
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Query to check if email and password match in database
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User found, redirect to dashboard or homepage
            header("Location: index1.php");
        } else {
            echo "E-mail ou mot de passe invalide";
        }

        // Close connection
        $conn->close();
    }
?>

<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" href="style.css">
    <title>Login Form</title>
</head>
<body>
    <ul class="navbar">
        <li><a href="#home">Accueil</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="index.php">Inscrire</a></li>
    </ul>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        Adresse e-mail: <input type="email" name="email"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" name="login" value="Connecter">
    </form>
</body>
</html>