<?php 
include_once('../models/user.php');
$userInfoTab = unserialize($_COOKIE['userInfo']);

 // Vérifier si l'utilisateur est connecté
if (!isset($userInfoTab["id"])) {
  header('Location: signin.php');
  exit;
}
//Création d'instance de user
$user = new Users();

//Informations de l'utilisateur
$id = $userInfoTab["id"];
$nom = $userInfoTab["username"];    

//Bouton deconnexion
if($_POST['btnDeconnexion']){
    $user->deconnexion();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
     <!-- Script pour tailwind -->
     <script src="https://cdn.tailwindcss.com"></script>
    <!-- Script pour flowbite -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <!-- Script pour penguin -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" type="image/vnd.icon" href="./assets/logo.png">
</head>
<body>
         <!-- Header -->
         <header class='flex bg-white border-b py-3 sm:px-6 px-4 font-[sans-serif] min-h-[75px] tracking-wide relative z-50'>
      <div class='flex max-w-screen-xl mx-auto w-full'>
        <div class='flex flex-wrap items-center lg:gap-y-2 gap-4 w-full'>
          <a href="javascript:void(0)"><img src="assets/logo.png"  alt="logo" class='w-10' />
          </a>

          <div id="collapseMenu"
            class='lg:ml-6 max-lg:hidden lg:!block max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50'>
            <button id="toggleClose" class='lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white w-9 h-9 flex items-center justify-center border'>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-black" viewBox="0 0 320.591 320.591">
                <path
                  d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                  data-original="#000000"></path>
                <path
                  d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                  data-original="#000000"></path>
              </svg>
            </button>

            <ul
              class='lg:flex lg:gap-x-3 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50'>
              <li class='mb-6 hidden max-lg:block'>
                <div class="flex items-center justify-between gap-4">
                  <a href="javascript:void(0)"><img src="https://readymadeui.com/readymadeui.svg" alt="logo" class='w-36' />
                  </a>
                  <button
                    class='px-4 py-2 text-sm rounded-full text-white border-2 border-[#007bff] bg-[#007bff] hover:bg-[#004bff]'>Sign
                    In</button>
                </div>
              </li>
              <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='text-[#38b6ff] hover:text-[#007bff] text-[15px] block font-semibold'>Utilisateurs</a></li>
              <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='text-[#333] hover:text-[#007bff] text-[15px] block font-semibold'>Categorie</a></li>
              <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='text-[#333] hover:text-[#007bff] text-[15px] block font-semibold'>Produits</a></li>
              <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='text-[#333] hover:text-[#007bff] text-[15px] block font-semibold'>Dashbord</a></li>
            </ul>
          </div>

          <div class="flex items-center gap-x-6 gap-y-4 ml-auto">
            <div
              class='flex bg-gray-50 border focus-within:bg-transparent focus-within:border-gray-400 rounded-full px-4 py-2.5 overflow-hidden max-w-52 max-lg:hidden'>
              <input type='text' placeholder='Search something...' class='w-full text-sm bg-transparent outline-none pr-2' />
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px"
                class="cursor-pointer fill-gray-600">
                <path
                  d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                </path>
              </svg>
            </div>
            <form action="" method="POST">
            <input type="submit" name="btnDeconnexion" value="Deconnexion" class='max-lg:hidden px-4 py-2 text-sm rounded-full text-white border-2 border-[#f10a14] bg-[#f10a14] hover:bg-[#f54951]'>
            </form>
           


              <button id="toggleOpen" class='lg:hidden'>
                <svg class="w-7 h-7" fill="#333" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div>
        
    </div>
</body>
</html>