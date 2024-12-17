<?php
        try {
            $connexion = new PDO("mysql:host=localhost;dbname=bootstrap;port=3306","root","Christ1609");
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST["name"]; 
                $email = $_POST["email"]; 
                $password = $_POST["password"]; 
                $confirm_password = $_POST["confirm_password"]; 
    
                if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
                    echo "<p> Veuillez remplir tous les champs.</p>";
                } else {
                    if (strlen($name) < 3 || strlen($name) > 10) {
                        echo "<p>Invalid name.</p>";
                    } else {
                    // *********************
                    if (!preg_match( "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
                        echo "<p>Invalid email.</p>";
                        } else {
                            if (strlen($password) < 3 || strlen($password) > 10) {
                                echo "<p>Invalid Mot de passe.</p>";
                            } else {
                                if ($password != $confirm_password) {
                                    echo "<p>Invalid password or password confirmation.</p>";
                                } else {
                                        
                                        $CryPass = password_hash($password, PASSWORD_BCRYPT);
                                        $req = "INSERT INTO users (name,email,password) VALUES (:name,:email,:password);";
                                        $Env = $connexion->prepare($req);
                                        $Env->bindParam(":name",$name,PDO::PARAM_STR);
                                        $Env->bindParam(":email",$email,PDO::PARAM_STR);
                                        $Env->bindParam(":password",$CryPass,PDO::PARAM_STR);
                                        $Env->execute();
                                        echo "<p>User created.</p>";
                                        
                                    } 
                                }
                            }
                        }
                    }
                }
            }catch (Exception $e) {
            echo"". $e->getMessage() ."";
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body  class=" bg-gradient-to-r from-orange-500 to-yellow-50">
    <form action="" method="post" class="max-sm:w-80 w-96 p-8 mx-auto my-auto bg-gray-100 rounded-md shadow-black shadow-lg mt-6 my-auto border-2 border-gray-200">

        <div class="grid place-content-center">
            <h1 class="text-3xl mb-6 grid content-center text-orange-500 font-bold ">Inscription</h1>
        </div>
        <div class=" my-auto my-auto grid items-center items-center	">
            <div class="mx-auto my-auto">
                <label for="name">Entrer votre Nom</label><br>
                <input type="name" name="name" id="name" placeholder="Entrer votre Nom" class="p-1 border-2 px-10  mx-auto my-2">
            </div>
            <div class="mx-auto my-auto">
                <label for="email">Entrer votre Email</label><br>
                <input type="email" name="email" id="email" placeholder="Adresse email" class="p-1 border-2 px-10 mx-auto my-2">
            </div >
            <div class="mx-auto my-auto">
                <label for="password">Entre un mot de passe</label><br>
                <input type="password" name="password" id="password" class="p-1 border-2 px-10 mx-auto my-2">
            </div>
            <div class="mx-auto my-auto">
                <label for="confirm_password">Confirmer le mot de passe</label><br>
                <input type="password" name="confirm_password" id="confirm_password" class="p-1 border-2 px-10 mx-auto my-2"><br>
            </div>
            <div class="mx-auto my-auto my-2">
                <button type="submit" name="envoyer" class="text-white border-2 py-1 px-4 bg-orange-500 mt-4 rounded-md">envoyer</button>
            </div>
        </div>
    </form>
</body>
</html>