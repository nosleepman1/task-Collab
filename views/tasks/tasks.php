<?php 
    $currentPage = "tasks";
    $title = "tasks";
    ob_start();
    ?>


<div class="container">

    <div class="flex justify-between">
        <p>
            Liste des tâches
        </p>

        <a href="/create" class="btn">
            Creer une tache
        </a>
    </div>

    <div>

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
                        <form action="/update" method="post">
                            <input type="hidden" name="id" value="<?= $task->getId() ?>">
                            <button class="btn btn-primary">Modifier</button>
                        </form>
                    </td>
                    <td>
                        <form action="/delete" method="post">
                            <input type="hidden" name="id" value="<?= $task->getId(); ?>">
                            <button class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>

                    <?php endforeach ?>
            </tbody>

        </table>

    </div>

</div>

<?php 
    $content = ob_get_clean();
    require_once __DIR__ ."/../layouts/main.php";
?>