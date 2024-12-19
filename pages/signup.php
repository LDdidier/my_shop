<?php 
include_once('../models/user.php');
include_once('../models/database.php');

    
    //Expression reguliere de l'email
    $Express = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    //Expression reguliere du nom
    $ExpressName = '/[a-zA-Zéèâôî_]/';



    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //Verification et envoie des données à la BD
        if(empty($nomUtilisateurDB) ||  empty($emailDB) ||  empty($passwordDB) ||  empty($confirmePasswordDB)){

            $errCh = "
            <p class='font-medium text-sm text-red-800 text-center '>Veuillez remplir tous les champs !</p>" 
            ;
        }else{
            if(strlen($nomUtilisateurDB)<3 || !preg_match($ExpressName,$nomUtilisateurDB)){

                $errName = "
                <p class='font-medium text-sm text-red-800 text-center '>Veuillez entrer un nom d'utilisateur correct !</p>" 
                ;

            }elseif(!preg_match($Express,$emailDB) ){

                $errEmail = "<p class='font-medium text-sm text-red-800 text-center '>Veuillez entrer une addresse email correcte !</p>";

            }elseif(strlen($passwordDB)<6){

                $errPass = "<p class='font-medium text-sm text-red-800 text-center '>Veuillez entrer un mot de passe supérieur à 6 charactères !</p>";

            }elseif($passwordDB != $confirmePasswordDB){

                $errPassCn = "<p class='font-medium text-sm text-red-800 text-center '>Mot de passe non-conforme !</p>";

            }else{
               //Appelle de la methode d'inscription
                $user = new Users();
                $user->inscription($nomUtilisateurDB,$emailDB,$passwordDB);       
            }
        }
    }
    

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insription</title>
    <!-- Script pour tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Script pour flowbite -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <!-- Script pour penguin -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" type="image/vnd.icon" href="./assets/logo.png">
</head>
<body>
<section class="bg-gray-50 dark:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
          <img class="w-8 h-8 mr-2" src="./assets/logo.png" alt="logo">
          Myriam's TEAM    
      </a>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <?php echo $errCh ?>
          
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                 Créer un compte
              </h1>
              <form class="space-y-4 md:space-y-6" action="" method="post">
              <div>
                      <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre nom d'utilisateur</label>
                      <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Robert01" required="">
                      <?php echo $errName ?>
                  </div>
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre adresse e-mail</label>
                      <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@gmail.com">
                      <?php echo $errEmail ?>
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre mot de passe</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                      <?php echo $errPass ?>
                  </div>
                  <div>
                      <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmer le mot de passe</label>
                      <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                      <?php echo $errPassCn ?>
                  </div>
                  <div class="flex items-start">
                      <div class="flex items-center h-5">
                        <input id="terms" name="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                      </div>
                      <div class="ml-3 text-sm">
                        <label for="terms" class="font-light text-gray-500 dark:text-gray-300">J'accepte les <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Conditions générales d'utilisation</a></label>
                      </div>
                  </div>
                  <button type="submit" class="w-full text-white bg-sky-400 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Créer un compte</button>
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    Vous avez déjà un compte ? <a href="signin.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Se connecter ici</a>
                  </p>
              </form>
          </div>
      </div>
  </div>
</section>
</body>
</html>