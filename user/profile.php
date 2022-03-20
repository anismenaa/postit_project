<?php
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_proprio = $_SESSION['id'];
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $date_ajout = date("Y/m/d h:i:sa");

    try{
        $conn = new PDO("mysql:host=localhost;dbname=postit","root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
        $sql = "INSERT INTO postit (id_proprietaire, titre, contenu, date_ajout) VALUES ('$id_proprio', '$titre', '$contenu', '$date_ajout')";
        $conn->exec($sql);
        header('./homepage.php', true, 301);
    }catch(PDOException $error){
        echo $error->getMessage(); // afficher le message d'erreur 
    }
}


// get personal postits 

// get shared postits


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/profile.css">
    <title>profile</title>
</head>
<body>
    <div class="postits">

        <div class="chose">
            <div class="chose_item" id="shared">
                shared postits
            </div>
            <div class="chose_item" id="personal">
                personal postits
            </div>
        </div>
        <div class="lists">
            <div id="shared_postits_list">
                shared
            </div>
            <div id="personal_postits_list">
                <?php
                    $conn = new PDO('mysql:host=localhost;dbname=postit;charset=utf8', 'root', '');
                    $sql = "SELECT * FROM postit";
                    $resultat = $conn->query($sql);
                    while($row = $resultat->fetch()){
                        if($row['id_proprietaire'] == $_SESSION['id']){
                        ?>
                        <div class="card w-75">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row["titre"] ?></h5>
                                <a href="#" class="btn btn-primary">partager</a>
                                <a href="#" class="btn btn-warning">modifier</a>
                                <a href="#" class="btn btn-danger">supprimer</a>
                            </div>
                         </div>
                        <?php
                        }
                    }
                ?>
            </div>
        </div>
        <div class="buttons">
            <button id="signout-btn" type="button" class="btn btn-danger">
                signout
            </button>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                add postit
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add postit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./profile.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">titre</label>
                            <input name="titre" type="text" class="form-control" id="exampleFormControlInput1" placeholder="titre de votre postit">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">contenu</label>
                            <textarea name="contenu" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save changes"/>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="./profile.js">

</script>
</body>
</html>