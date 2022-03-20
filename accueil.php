<?php

/*
ce script sert à inscrire un utilisateur .
les etapes :
1) on recupere les données des inputs du form  
2) on verifie s'ils ne sont pas empty en utilisant la fonction empty()
3) on initialise leurs score initial à 0 
4) enregistrer l'utilisateur
*/
if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['date_naissance']) AND !empty($_POST['email']) AND !empty($_POST['password'])){
        // initialisation des donnees
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        // we hash the password
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $confirmation = $_POST['confirmation'];
        $date_naissance = $_POST['date_naissance'];
        $score = 0; // son score au debut est à 0
        // creation de la conn 
        try{
            $conn = new PDO("mysql:host=localhost;dbname=postit","root","");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
            $sql = "INSERT INTO utilisateur (nom, prenom, email, password, date_naissance) VALUES ('$nom', '$prenom', '$email', '$password', '$date_naissance')";
            $conn->exec($sql);
            header('./homepage.php', true, 301);
        }catch(PDOException $error){
            echo $error->getMessage(); // afficher le message d'erreur 
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/accueil.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Accueil-postits</title>
</head>
<body>

<div class="accueil">
    <div class="header_section">
        <img src="./images/background_postits_image.png" alt="">
        <div class="header_cover">

        </div>
        <div class="header_text">
            <div class="header_title">
                Welcome to our post-its webpage.
            </div>
            <div class="header_para">
            is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </div>
            <a href="./user/signIn.php" class="connexion_btn">
                Connectez-vous
            </a>
            <div class="router_links">
                <div class="link">
                    <a href="#">Accueil</a>
                </div>
                <div class="link">
                    <a href="#inscription">Inscription</a>
                </div>
                <div class="link">
                    <a href="#">About</a>
                </div>
                <div class="link">
                    <a href="#">Contact</a>
                </div>
            </div>
        </div>
    </div>

    <div class="inscription_form" id="inscription">
        <div class="inscription_title">
            Toujours pas de compte ?
        </div>

        <form action="./accueil.php" method="POST">
            <input type="text" placeholder="prénom" name="prenom" id="prenom"/>
            <div id="error_letter1" class="error_section"></div>
            <input type="text" placeholder="nom" name="nom" id="nom" disabled/>
            <div id="error_letter2" class="error_section"></div>
            <label>Date de naissance : </label><input type="date" name="date_naissance" id="date_naissance" disabled/>
            <input type="email" placeholder="email" name="email" id="email" disabled/>
            <div id="error_email" class="error_section"></div>
            <input type="password" placeholder="mot de passe" name="password" id="password" disabled/>
            <div id="error_password" class="error_section"></div>
            <input type="password" placeholder="confirmation" name="confirmation" id="confirmation" disabled/> 
            <div id="error_confirmation" class="error_section"></div>
            <!-- let's make this button disabled till the fulffilment of all the inputs-->
            <input type="submit" id="inscription-btn" value="soumettre mon inscription" disabled/>
        </form>
    </div>

    <div class="about" id="about">

    </div>

    <footer id="footer">
        <div class="footer-item footer-logo">
            <p>POST-ITs</p>
        </div>
        <div class="footer-item footer-note">
            <h6>Note</h6>
            <p>nos service visent a avoir une 
                meilleure experience de POST-ITs</p>   
        </div>
        <div class="footer-item footer-rights">
            <p>All the rights are reserved</p>            
        </div>
        <div class="footer-item footer-contact">
            <h6>Contact</h6>
            <p>email : admin@admin.com</p>
            <p>tel : 000000</p>
            <p>adresse : france </p>                    
        </div>
    </footer>
</div>


<script src="./accueil.js">
    


</script>
</body>
</html>