<?php 
    $currentPage  = 'projects';
    $title = "Mes Projets";
    ob_start();
?>


<!-- Projects List -->
<div class="container mx-auto p-4"></div>
<h1 class="text-2xl font-bold mb-4">Mes Projets</h1>

<div class="mb-4">
    <a href="/project/create"
        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Créer un
        nouveau projet</a>
</div>

<?php if (empty($projects)): ?>
<p class="text-gray-600">Vous n'avez pas encore de projets. Créez-en un nouveau pour commencer!</p>
<?php else: ?>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    <?php foreach ($projects as $project): ?>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-2"><?= htmlspecialchars($project->getTitle()) ?></h2>
        <p class="text-gray-700 mb-4"><?= htmlspecialchars($project->getDescription()) ?></p>
        <a href="/project/<?= $project->getId() ?>" class="text-blue-500 hover:underline">Voir les détails</a>
    </div>
    <?php endforeach; ?>

</div>
<?php endif; ?>

<?php
    $content = ob_get_clean();
    require_once __DIR__ . '/../layouts/main.php';
?>