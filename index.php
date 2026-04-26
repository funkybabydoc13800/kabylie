<?php

require('contact.class.php');

// Si le Formulaire a été soumis
if (!empty($_POST)) {

    //extract($_POST);
    //extract($_POST) : Cette fonction PHP assigne automatiquement les valeurs du formulaire comme par exemple 
    //$_POST["nom"] à la variable du même nom $nom ... c'est une écriture raccourcie de ce qui suit.

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Opérateur Ternaire qui permet d'obtenir une écriture simplifiée pour le Test des conditions.
    $valid = (empty($nom) || empty($prenom) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) ? false : true;
    $erreurnom = (empty($nom)) ? 'Indiquez votre Nom' : null;
    $erreuremail = (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) ? 'Indiquez une adresse Email valide' : null;
    $erreurmessage = (empty($message)) ? 'Indiquez votre Message' : null;

    if ($valid) {
        // On peut créer l'objet Contact
        $contact = new Contact();

        if ($contact->verifier_doublon($nom, $prenom, $email, $message) == 1) {
            $success = 'Données déjà insérées en BDD';
        } else {

            $contact->insertContact($nom, $prenom, $email, $message);

            // La fonction unset() permet de détruire les variables et les objets
            unset($nom);
            unset($prenom);
            unset($email);
            unset($message);
            unset($contact);

            $success = 'Données insérées avec succès !!!';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre avis est précieux</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <style>
        h1{
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    font-size: 4em;
    color: red;
    text-align: center;
}

main
{
   
background-color: rgb(42, 43, 46);
height: 3000px;
max-height: 2000px;
min-height: 1100px;
margin-left: 200px;
    margin-right: 200px;
}


h2
{
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    font-size: 3.2em;
    color: blue;
    text-align: center;
}

</style>
</head>

<body>

<main>

    <h2>Votre avis est précieux !</h2>
    <div>
        <h4>FORMULAIRE</h4>
        <br />
        <hr />
        <br />
    <br><br>
    <div class="container">
        <?php if (isset($success)) : ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <form method="POST" action="<?php echo $_SERVER["SCRIPT_NAME"] ?>">
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="nom">Nom</label>
                    <span class="error"><?php if (isset($erreurnom)) echo $erreurnom; ?></span>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php if (isset($nom)) echo $nom; ?>">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?php if (isset($prenom)) echo $prenom; ?>">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="email">Email</label>
                    <span class="error"><?php if (isset($erreuremail)) echo $erreuremail; ?></span>
                    <input type="text" class="form-control" id="email" name="email" value="<?php if (isset($email)) echo $email; ?>">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="message">Message</label>
                    <span class="error"><?php if (isset($erreurmessage)) echo $erreurmessage; ?></span>
                    <textarea class="form-control" id="message" name="message"><?php if (isset($message)) echo $message; ?></textarea>
                </div>
            </div>
            <button class="btn btn-light" type="reset" id="annuler">Annuler</button>
            <button class="btn btn-success" type="submit" id="submit">Envoyer</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#nom").on("keyup", function() {

            $(this).val($(this).val().toUpperCase());
        });

        $("#prenom").on("keyup", function() {

            $(this).val($(this).val().charAt(0).toUpperCase() + $(this).val().substr(1).toLowerCase());

        });
        $("#annuler").on("click", function() {

            location.href = location.href;
  
        });
    </script>
    </main>
</body>

</html>