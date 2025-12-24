<?php
$title = "Inscription - TaskColllab";
$currentPage = 'Register';
require_once __DIR__ .'/../components/alert.php';
ob_start();
?>

<div class="min-h-[80vh] flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gray-50">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <!-- En-tête -->
         <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-900">Creer votre compte</h1>
            <p class="mt-2 text-gray-600">
                Creer votre compte pour gérer vos tâches et collaborer avec votre équipe.
            </p>
         </div>
        <!-- Formulaire -->

        <?php 
                if(isset($_SESSION['UserMiddleware']) ) {

                    foreach($_SESSION['UserMiddleware'] as $key => $errors) {

                        AlertMessage('erreur', $errors);
                    }
                    unset($_SESSION['UserMiddleware']);
                }
        ?>


         <div class="mt-8 bg-white py-8 px-6 shadow rounded-lg sm:px-10">
            <form class="space-y-6" action="/register" method="POST">
                <!-- Email -->
                <div class="mb-4">
                    <label for="text" class="block text-gray-700 font-medium mb-2">Username</label>
                    <input type="text" id="username" name="username"  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" id="email" name="email"  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Mot de passe -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" id="password" name="password"  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Bouton de connexion -->
                <div class="mb-4">
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                        S'inscrire
                    </button>
                </div>
            </form>
         </div>
    </div>
</div>

<?php


$content = ob_get_clean();
require_once __DIR__ . '/../../views/layouts/main.php';

?>