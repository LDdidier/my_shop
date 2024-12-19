<?php
require_once("database.php");
include_once("../popup/popup.php");

class Users {
    private $db;

    public function __construct(){
        $this->db = ConnectDatabase();
    }

    public function inscription($nom, $email, $password) {
        //Verification si le user existe
        $query = $this->db->prepare("SELECT email from users where email = :email");
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $resultat = $query->fetch();
        if(is_bool($resultat)) {
            //Préparation et création de l'utilisateur
            $passCrypter = password_hash($password,PASSWORD_BCRYPT);// Cryptage du mot de passe
            $Identifant = uniqid();// Génération de l'id
            $dateCreation = date("Y-m-d H:i:s"); // Date et heure actuelles

            $requete = $this->db->prepare("INSERT INTO users (id, username, email, password,created_at) VALUES (:identifiant,:username, :email, :password,:created_at);");
            $requete->bindParam(':identifiant', $Identifant);
            $requete->bindParam(':username', $nom);
            $requete->bindParam(':email', $email);
            $requete->bindParam(':password', $passCrypter);
            $requete->bindParam(':created_at', $dateCreation);
            $requete->execute();
             //Fenêtre PopUp de redirection
            echo popupSucces($nom);
        }else{
             //Fenêtre PopUp de ruser existe
            echo popupUserExist();
        }
    }

    public function connexion($email, $password) {
        $query = $this->db->prepare('SELECT * from users where email = :email');
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $resultat = $query->fetch();
        if(is_bool($resultat)) {
            echo "<div class='p-4  text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center' role='alert'>
            <span class='font-medium'>L'utilisateur est introuvable,Veuillez verifier votre adresse email !</span> 
            </div>";
        }elseif(password_verify($password, $resultat["password"])){
            setcookie("userInfo",serialize($resultat),time() + 365*24*3600);
            header("Location: admin.php");
            exit();
        }else{
            echo "<div class='p-4  text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center' role='alert'>
            <span class='font-medium'>Mot de passe incorrect !</span> 
            </div>";
        }
    }

    public function deconnexion(){
        setcookie("userInfo", "", time() - 3600);
        header("Location: index.php");
    }
        
}