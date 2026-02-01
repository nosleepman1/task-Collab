<?php 
    $currentPage = "tasks";
    $title = "tasks";
    ob_start();
    ?>


<div class="mt-5">
    <!-- En-tête  classes tailwind css-->
    <div class="flex justify-between bg-gray-100 p-4 mb-4 rounded-lg">
        <p class="text-2xl font-bold text-gray-800">
            Liste des tâches
        </p>

        <a href="/tasks/create" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
            Creer une tache
        </a>
    </div>

    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <?php if(!$tasks): ?>
        <h1 class="text-4xl text-center text-bold">Pas de tache disponible</h1>
        <div class="h-[500px] flex justify-center items-center">
            <a href="/tasks/create"
                class="text-center bg-blue-500 text-2xl text-bold text-white px-8 py-4 rounded-lg hover:bg-white hover:border hover:text-black transition duration-400">
                Commencez en une
            </a>
        </div>
        <?php else: ?>




        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Titre
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Descrtiption
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Statut
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        <span class="sr-only">Modifier</span>
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        <span class="sr-only">Supprimer</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tasks as $task): ?>
                <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                    <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                        <?= $task->getTitle(); ?>
                    </th>
                    <td class="px-6 py-4">
                        <?=  $task->getDescription(); ?>
                    </td>
                    <td class="px-6 py-4">
                        <?=  $task->getStatus(); ?>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="font-medium text-fg-brand hover:underline">Modifier</a>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="font-medium text-fg-brand hover:underline">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>


        <?php endif ?>

    </div>

</div>

<?php 
    $content = ob_get_clean();
    require_once __DIR__ ."/../layouts/main.php";
?>