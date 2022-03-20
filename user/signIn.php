<?php
    session_start();

    // on initialise l'email et le mot de passe 
    $email = "";
    $password = "";
    
    //on verifier que les inputs ne sont pas vides 
    $email_vide_error = "";
    $password_vide_error = "";
    $password_verified = FALSE;
    //erreur
    $erreur_a_afficher = "";
    
    // on verifier si la methode du form est "post" 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // on verifie que tout les input sont bien remplis 
        if ( empty ($_POST["email"]) ){
            $email_vide_error = "veuillez inserer l'email de l'utilisateur";
        } else {
            $email = $_POST['email'];
        }

        if ( empty ($_POST["password"]) ){
            $password_vide_error = "veuillez inserer le mot de passe";
        } else {
            $password = $_POST['password'];
        }
    
    
        // si il n'y a pas d'erreur 
        if(empty($email_vide_error) AND empty($password_vide_error)){
            //connexion à la base de donnee 
               //connexion à la base de donnee 
               $bdd = new PDO('mysql:host=localhost;dbname=postit;charset=utf8', 'root', '');
               $reponse = $bdd->query('SELECT * FROM utilisateur');
               $donnees = $reponse->fetchAll();
    
               foreach($donnees as $donnee){
                // on verifie l'existance de l'email et son password
                if($email == $donnee['email']){
                    $hash = $donnee['password'];
                    if(password_verify($password, $hash)){
                        $password_verified = TRUE;
                        $_SESSION['email'] = $donnee['email'];
                        $_SESSION['id'] = $donnee['id'];
                        echo "bienvenue";
                        header("Location: ./profile.php", true, 301);
                    } else{
                        $erreur_a_afficher = "mot de passe est erronés";
                    }
                   
                } else {
                    $erreur_a_afficher = "email ou mot de passe sont erronés";
                }
            }    
        }
        else {
            $erreur_a_afficher = " veuillez verifier que tout les input sont rempli";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/signin.css">
    <title>SignIn postits</title>
</head>
<body>
    <div class="signIn_background">
        <img src="../images/signin_background.png" alt="">
        <div class="signin_cover"></div>
        <div class="signIn_form">
            
            <form action="./signIn.php" method="POST">
                <p id="error_identification"><?php echo($erreur_a_afficher) ?></p>
                <label for="email">Email :</label>
                <input type="email" name="email" placeholder="votre email">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" placeholder="mot de passe">
                <input type="submit" value="se connecter" id="signIn-btn">
            </form>
        </div>
    </div>
</body>
</html>