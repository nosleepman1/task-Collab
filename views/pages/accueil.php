<?php 
    $title = 'home';
    $currentPage = 'home';
    ob_start();

?>


<section class="gradient-primary text-primary-600 py-20 mb-8">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <!-- Text Content -->
            <div>
                <h1 class="text-5xl font-bold mb-6 leading-tight">
                    Gérez vos tâches en equipe,
                    <span class="block text-yellow-300">en toute simplicité</span>
                </h1>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">
                    Bienvenue sur TaskCollab, votre solution ultime pour la gestion de tâches en équipe.
                    Simplifiez la collaboration, améliorez la productivité et atteignez vos objectifs ensemble.
                </p>
                <div class="flex gap-4">
                    <a href="/register"
                        class="bg-white text-primary-600 px-8 py-8 rounded-lg font-semicold hover:bg-gray-100 transition transform hover:-translate-y-1">
                        Commencer maintenant
                    </a>
                    <a href="/login"
                        class="bg-white/10 backdrop-blur font-semibold px-8 py-8 rounded shadow hover:bg-white/10 transition border-2 border-white/20 hover:border-white">
                        Se connecter
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>


<?php 
 
    $content = ob_get_clean();
    require_once __DIR__ . '/../layouts/main.php';
?>