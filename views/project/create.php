<?php 
    $currentPage = '404';
    $title = "Page Not Found";
    ob_start();
?>


<!--Create Project Form-->
<div class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Create New Project</h2>


        <form action="/project/create" method="POST">


            <div class="mb-4">
                <label for="project_name" class="block text-gray-700">Project Name</label>
                <input type="text" id="project_name" name="project_name" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
            </div>


            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500"></textarea>
            </div>


            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">Create
                Project</button>
        </form>




    </div>
</div>
<?php 
    $content = ob_get_clean();
    require_once __DIR__ . '/../layouts/main.php';
?>