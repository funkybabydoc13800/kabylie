<?php
include_once "database.class.php";

class Contact {

    private $nom;
    private $prenom;
    private $email;
    private $message;
   

    // Méthode statique qui supprime les espaces en début et fin de chaîne, les antislashes, convertit les
    // caractères spéciaux en entités HTML 
    public static function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data, ENT_QUOTES);
      return $data;
    }

    // Fonction qui vérifie qu'un enregistrement n'est pas déjà en Base. Si le retour est 1 on redirige vers index.php
    // sinon on insert en BDD.
    public function verifier_doublon($nom, $prenom, $email, $message){

      $this->nom      = self::test_input($nom);
      $this->prenom   = self::test_input($prenom);
      $this->email    = self::test_input($email);
      $this->message  = self::test_input($message);

      $pdo = Database::connect();
      $req = "SELECT * FROM contact WHERE nom= :nom AND prenom=:prenom and email=:email AND message= :message";
      $reponse = $pdo->prepare($req);
      $reponse->bindValue(":nom",  $this->nom, PDO::PARAM_STR);
      $reponse->bindValue(":prenom", $this->prenom, PDO::PARAM_STR);
      $reponse->bindValue(":email", $this->email, PDO::PARAM_STR);
      $reponse->bindValue(":message", $this->message, PDO::PARAM_STR);
      $reponse->execute();
      Database::disconnect();

    return $reponse->rowCount();
    }
    
    public function insertContact($nom, $prenom, $email, $message){
      
      $this->nom      = self::test_input($nom);
      $this->prenom   = self::test_input($prenom);
      $this->email    = self::test_input($email);
      $this->message  = self::test_input($message);
      
      $pdo = Database::connect();
      $sql = "INSERT INTO contact(nom, prenom, email, message) VALUES (:nom, :prenom, :email, :message)";
      $reponse = $pdo->prepare($sql);
      $reponse->bindParam(':nom', $this->nom);
      $reponse->bindParam(':prenom', $this->prenom);
      $reponse->bindParam(':email', $this->email);
      $reponse->bindParam(':message', $this->message);
      
      $reponse->execute();
      Database::disconnect();

    }
      
}