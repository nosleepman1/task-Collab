<?php 
    $currentPage = "tasks";
    $title = "tasks";
    ob_start();
    ?>



<div class="p-5">

    <div class="flex justify-center">
        <h1 class="text-3xl text-bold">Creation de tache</h1>
    </div>

    <div class="flex justify-center mt-10 p-5">


        <form action="/create" method="post" class="form border rounded-lg p-20">

            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Titre</label>
                <input type="text" id="title" name="title"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea id="description" name="description"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </textarea>
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="bg-blue-500 mt-8 px-8 py-2 text-2xl text-bold text-white rounded-lg">Creer</button>
            </div>


        </form>


    </div>

</div>






<?php

    $content = ob_get_clean();
    require_once __DIR__ . '/../layouts/main.php';
?>