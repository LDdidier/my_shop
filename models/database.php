<?php

function ConnectDatabase(){
    try{
       $connexion = new PDO("mysql:host=localhost;dbname=my_shop;port=3306","root","Christ1609");
       $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
       return $connexion;
       
    }catch(Exception $e){
        echo "Erreur :". $e->getMessage()."\n";
        // exit();

    }

}

//Récuparation des champs
$nomUtilisateurDB = $_POST["username"];
$emailDB = $_POST["email"];
$passwordDB = $_POST["password"];
$confirmePasswordDB = $_POST["confirm-password"];