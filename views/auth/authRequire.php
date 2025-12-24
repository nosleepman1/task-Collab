<?php 

    $currentPage = 'authRequire';
    $title = 'unauthorized';

    ob_start();

?>

            <div class="bg-gray-100 flex items-center justify-center h-screen">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800">403 - Access non autorisée</h1>
                    <p class="text-gray-600 mt-2">La page que vous recherchez n'est pas accessible veuillez vous authentifier.</p>
                    <a href="/login" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Se connecter
                    </a>
                </div>
            </div>


<?php
    $content = ob_get_clean();
    require_once __DIR__ . '/../layouts/main.php';
?>