<?php 
    $title = $title ?? 'Task Collaboration App';
    $currentPage = $currentPage ?? '';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $title ?> </title>
</head>

<body>


    <nav
        class="relative bg-gray-800/50 after:pointer-events-none after:absolute after:inset-x-0 after:bottom-0 after:h-px after:bg-white/10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items center">
                    <a href="/" class="text-white font-bold text-xl">TaskCollab</a>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="/"
                                class="px-3 py-2 rounded-md text-sm font-medium <?= $currentPage === 'home' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?>">Home</a>

                            <?php 
                use App\Utils\Auth;
                                                                                use App\Utils\Session;

                if (Auth::check()) {
            ?>
                            <a href="/logout"
                                class="px-3 py-2 rounded-md text-sm font-medium <?= $currentPage === 'logout' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?>">Logout</a>
                            <a href="/tasks"
                                class="px-3 py-2 rounded-md text-sm font-medium <?= $currentPage === 'tasks' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?>">Tasks</a>
                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium">
                                <?= Auth::user()->getFullname() ?> </a>
                            <?php } else { ?>
                            <a href="/login"
                                class="px-3 py-2 rounded-md text-sm font-medium <?= $currentPage === 'login' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?>">Login</a>
                            <a href="/register"
                                class="px-3 py-2 rounded-md text-sm font-medium <?= $currentPage === 'register' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?>">Register</a>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
    </nav>






    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: {
                        50: '#f5f5f5ff',
                        100: '#f5f5f5ff',
                        500: '#0e9ff9ff',
                        600: '#10659bff',
                        700: '#1e6ea1ff',
                    },
                    500: '#14171A',
                },
            },
        },
    }
    </script>
    <style type="text/tailwindcss">
        .gradient-primary {
            background: linear-gradient(135deg, #1DA1F2 0%, #a9bac5ff 100%);
        }
    </style>


    <?php
        $erreurs = Session::getFlash('error');
        $success = Session::getFlash('success');
 

    if(isset($erreurs)) { ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Erreur:</strong>
        <span class="block sm:inline"> <?= $erreurs ?> </span>
        <a href="#" class="
                    float-right
                    text-red-600
                    hover:text-red-900
                    absolute
                    right-2
                    top-2
                    text-2xl">&times;</a>
    </div>
    <?php   } 
 

    if(isset($success)) {
        ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Succès:</strong>
        <span class="block sm:inline"> <?= $success ?> </span>
        <a href="#" class="
                    float-right
                    text-green-600
                    hover:text-green-900
                    absolute
                    right-2
                    top-2
                    text-2xl">&times;</a>
    </div>
    <?php     }
     ?>
    <main class="flex-1">
        <?= $content; ?>
    </main>



    <?php require_once __DIR__ . '/../components/footer.php'; ?>


</body>

</html>