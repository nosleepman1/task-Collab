<?php 

    $currentPage = "tasks";
    $title = "tasks";
    
    ob_start();

    ?>
      


        <div class="bg-gray-100  ">

            <div class="grid grid-cols-1 md:grid-cols-2 min-h-screen">

            <div class="p-6">
                        
                <h2 class="text-2xl font-bold mb-4">Mes tâches</h2>

                
                 <ul class="space-y-3">

                    <!-- 🟦 Carte tâche -->
                     <?php foreach ($tasks as $task): ?>
                    <li class="bg-white p-4 rounded-xl shadow flex flex-col gap-2">

                        <div>
                        <h4 class="task-title font-semibold text-lg">
                            <?php echo $task->getTitle(); ?>
                        </h4>

                        <p class="task-desc text-sm text-gray-600">
                            <?php echo $task->getDescription(); ?>               
                        </p>
                        </div>

                        <!-- Boutons actions -->
                        <div class="flex gap-2 justify-end">

                        <button
                            class="editBtn px-3 py-1 rounded-lg border">
                            Modifier
                        </button>

                        <button
                            class="deleteBtn px-3 py-1 rounded-lg bg-red-600 text-white">
                            Supprimer
                        </button>

                        </div>
                    </li>

                    <?php endforeach; ?>


                    </ul>

                    
            </div>

            <?php require_once __DIR__ . '/create.php' ?>


<?php 
            


    $content = ob_get_clean();
    require_once __DIR__ ."/../layouts/main.php";
?>


