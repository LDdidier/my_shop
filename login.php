<?php 

    $email = $_POST["email"];
    $password = $_POST["password"];
    try{
        $connexion = new PDO("mysql:host=localhost;dbname=bootstrap;port=3306","root","");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(!empty($email) && !empty($password)) {
            $req = "";
        }else{
            echo "Remplissez tous les champs";
        }
    }catch(Exception $e){

    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class=" bg-gradient-to-r from-orange-500 to-yellow-50">
    <form action="" method="post" class="max-sm:w-80 w-96 py-10 mx-auto my-auto bg-gray-100 rounded-sm shadow-black shadow-lg mt-6 my-auto border-2 border-gray-200">

        <div class="grid place-content-center">
            <h1 class="text-3xl mb-6 mt-6 grid content-center text-orange-500 font-bold ">Se connecter</h1>
        </div>
        <div class=" my-auto my-auto grid items-center items-center	">
            <div class="mx-auto my-auto">
                <label for="email">Entrer votre Email</label><br>
                <input type="email" name="email" id="email" placeholder="Adresse email" class="p-1 border-2 px-10 mx-auto my-2">
            </div >
            <div class="mx-auto my-auto">
                <label for="password">Entre un mot de passe</label><br>
                <input type="password" name="password" id="password" class="p-1 border-2 px-10 mx-auto my-2">
            </div>
            <div class="mx-auto my-auto my-2 mb-8">
                <button type="submit" name="envoyer" class="text-white border-2 py-1 px-4 bg-orange-500 mt-4 rounded-md">Connexion</button>
            </div>
        </div>
    </form>
</body>
</html>