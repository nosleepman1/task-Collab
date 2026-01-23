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

        <a href="/create" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
            Creer une tache
        </a>
    </div>

    <div>
        <?php if(!$tasks): ?>
        <h1 class="text-4xl text-center text-bold">Pas de tache disponible</h1>
        <div class="h-[500px] flex justify-center items-center">
            <a href="/create"
                class="text-center bg-blue-500 text-2xl text-bold text-white px-8 py-4 rounded-lg hover:bg-white hover:border hover:text-black transition duration-400">
                Commencez en une
            </a>
        </div>
        <?php else: ?>


        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($tasks as $task): ?>
                <tr>
                    <td>
                        <?=  $task->getTitle(); ?>
                    </td>
                    <td>
                        <?=  $task->getDescription(); ?>
                    </td>
                    <td>
                        <?=  $task->getStatus();  ?>
                    </td>
                    <td>
                        <form action="/task" method="put">
                            <input type="hidden" name="id" value="<?= $task->getId() ?>">
                            <button class="btn btn-primary">Modifier</button>
                        </form>
                    </td>
                    <td>
                        <form action="/task" method="delete">
                            <input type="hidden" name="id" value="<?= $task->getId(); ?>">
                            <button class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>

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