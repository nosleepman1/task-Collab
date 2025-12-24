
<?php 
    $currentPage = '404';
    $title = "Page Not Found";
    ob_start();
?>


            <div class="bg-gray-100 flex items-center justify-center h-screen">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800">404 - Page non trouvée</h1>
                    <p class="text-gray-600 mt-2">La page que vous recherchez n'existe pas.</p>
                    <a href="/" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Retour à l'accueil
                    </a>
                </div>
            </div>


<?php
    $content = ob_get_clean();
    require_once __DIR__ . '/../layouts/main.php';
?>
