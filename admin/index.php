<?php
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "memoire_online";


    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
    
            header("Location: acueil.php");
        } else {
            echo "<script>alert('E-mail ou mot de passe invalide');</script>";
        }

    
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;       
            flex-direction: column;
      
         
         
        }
        
		.header {
            width: 100%;
            background-color: #003366;
            color: white;
            padding: 20px;
			margin: 30px;
            text-align: center;
            margin-top: 0; /* Ajustement de la marge supérieure à zéro */
        }
        .login-container {
            background-color: white;
            padding: 60px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #003366;
        }
        .login-container input[type="email"], .login-container input[type="password"] {
            width: 90%;
            padding: 15px;
            margin: 15px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .login-container input[type="submit"] {
            background-color: #003366;
            color: white;
            border: none;
            padding: 15px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 50%;
        }
        .login-container input[type="submit"]:hover {
            background-color: #00509e;
        }
    </style>
	<script>
    document.addEventListener("DOMContentLoaded", function() {
    var currentLocation = window.location.href;
    var navLinks = document.querySelectorAll('.navbar a');
    navLinks.forEach(function(link) {
        if (link.href === currentLocation) {
            link.classList.add('active');
        }
    });
});

	
	
	</script>
</head>
<body>
	 <div class="header">
        <h1>Bienvenue sur MemoPublish</h1>
    </div>
    

    <div class="login-container">
        <h2>Connexion</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input type="email" name="email" placeholder="Adresse e-mail" required><br>
            <input type="password" name="password" placeholder="Mot de passe" required><br>
            <input type="submit" name="login" value="Connecter">
        </form>
    </div>
</body>
</html>
