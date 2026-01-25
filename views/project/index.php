<!-- Header -->
<div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Mes Projets</h1>
                <p class="mt-1 text-sm text-gray-500">Gérez vos projets et leurs tâches</p>
            </div>
            <button
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-lg font-medium shadow-sm transition duration-150 ease-in-out">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Nouveau Projet
                </span>
            </button>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <?php if (empty($projects)): ?>
    <!-- Empty State -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
        <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <h3 class="mt-4 text-lg font-semibold text-gray-900">Aucun projet</h3>
        <p class="mt-2 text-sm text-gray-500">Commencez par créer votre premier projet.</p>
        <button class="mt-6 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg font-medium transition">
            Créer un projet
        </button>
    </div>
    <?php else: ?>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <?php foreach ($projects as $project): ?>
        <div
            class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-300">

            <!-- Project Header -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-5">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-white">
                            <?= htmlspecialchars($project->getTitle()) ?>
                        </h2>
                        <p class="mt-1 text-indigo-100 text-sm line-clamp-2">
                            <?= htmlspecialchars($project->getDescription()) ?>
                        </p>
                    </div>
                    <button class="text-white hover:text-indigo-100 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>
                </div>

                <?php 
                            $tasks = $projectTasks[$project->getId()] ?? [];
                            $totalTasks = count($tasks);
                            $completedTasks = count(array_filter($tasks, fn($t) => $t->getStatus() === 'completed'));
                            $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
                            ?>

                <!-- Progress Bar -->
                <div class="mt-4">
                    <div class="flex items-center justify-between text-sm text-white mb-2">
                        <span class="font-medium">Progression</span>
                        <span class="font-semibold"><?= $completedTasks ?>/<?= $totalTasks ?> tâches</span>
                    </div>
                    <div class="w-full bg-indigo-400 bg-opacity-30 rounded-full h-2.5">
                        <div class="bg-white h-2.5 rounded-full transition-all duration-500"
                            style="width: <?= $progress ?>%"></div>
                    </div>
                </div>
            </div>

            <!-- Tasks Section -->
            <div class="px-6 py-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wide">
                        Tâches
                    </h3>
                    <button class="text-indigo-600 hover:text-indigo-700 text-sm font-medium transition">
                        + Ajouter
                    </button>
                </div>

                <?php if (empty($tasks)): ?>
                <div class="text-center py-8 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="mt-2 text-sm text-gray-500">Aucune tâche pour ce projet</p>
                </div>
                <?php else: ?>
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    <?php foreach ($tasks as $task): ?>
                    <?php
                                        $priorityColors = [
                                            'high' => 'bg-red-100 text-red-800 border-red-200',
                                            'medium' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                            'low' => 'bg-green-100 text-green-800 border-green-200'
                                        ];
                                        $statusColors = [
                                            'pending' => 'bg-gray-100 text-gray-700',
                                            'in_progress' => 'bg-blue-100 text-blue-700',
                                            'completed' => 'bg-green-100 text-green-700'
                                        ];
                                        $priorityIcons = [
                                            'high' => '🔴',
                                            'medium' => '🟡',
                                            'low' => '🟢'
                                        ];
                                        ?>

                    <div
                        class="border border-gray-200 rounded-lg p-4 hover:border-indigo-300 hover:shadow-sm transition-all duration-200 <?= $task->getStatus() === 'completed' ? 'opacity-60' : '' ?>">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <input type="checkbox" <?= $task->getStatus() === 'completed' ? 'checked' : '' ?>
                                        class="w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500">
                                    <h4
                                        class="font-semibold text-gray-900 <?= $task->getStatus() === 'completed' ? 'line-through' : '' ?>">
                                        <?= htmlspecialchars($task->getTitle()) ?>
                                    </h4>
                                </div>
                                <p class="text-sm text-gray-600 ml-6 mb-3">
                                    <?= htmlspecialchars($task->getDescription()) ?>
                                </p>

                                <!-- Task Meta -->
                                <div class="flex flex-wrap items-center gap-2 ml-6">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusColors[$task->getStatus()] ?? $statusColors['pending'] ?>">
                                        <?= ucfirst(str_replace('_', ' ', $task->getStatus())) ?>
                                    </span>

                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?= $priorityColors[$task->getPriority()] ?? $priorityColors['medium'] ?>">
                                        <?= $priorityIcons[$task->getPriority()] ?? '⚪' ?>
                                        <?= ucfirst($task->getPriority()) ?>
                                    </span>

                                    <?php if ($task->getDeadline()): ?>
                                    <?php 
                                                            $now = new DateTime();
                                                            $deadline = $task->getDeadline();
                                                            $isOverdue = $deadline < $now && $task->getStatus() !== 'completed';
                                                            ?>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $isOverdue ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-700' ?>">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <?= $deadline->format('d/m/Y') ?>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <button class="text-gray-400 hover:text-gray-600 transition ml-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Project Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">
                        Propriétaire: <span
                            class="font-medium text-gray-900"><?= htmlspecialchars($project->getOwner()->getUsername()) ?></span>
                    </span>
                    <button class="text-indigo-600 hover:text-indigo-700 font-medium transition">
                        Voir détails →
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>