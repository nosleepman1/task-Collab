<div class="flex items-center justify-center p-6 bg-white">
                <button id="openFormBtn"
                class="px-6 py-4 text-lg font-semibold rounded-xl bg-blue-600 text-white hover:bg-blue-700">
                Ajouter une tâche
                </button>
            </div>
            </div>


            <!-- 🟡 Overlay formulaire -->
            <div id="taskOverlay"
            class="fixed inset-0 bg-black/50 hidden flex items-center justify-center w-full h-[100vh]">

            <div class="bg-white w-[90%] max-w-lg rounded-2xl p-6 shadow-lg ">

                <h3 class="text-xl font-bold mb-4">Nouvelle tâche</h3>

                <form id="taskForm" class="space-y-4"  method="post" action="/tasks">

                <input id="titleInput"
                    type="text"
                    placeholder="Titre"
                    required
                    name="title"
                    class="w-full border rounded-lg px-3 py-2">

                <textarea id="descInput"
                    placeholder="Description"
                    rows="3"
                    name="description"
                    class="w-full border rounded-lg px-3 py-2"></textarea>

                <div class="flex justify-end gap-3">
                    <button type="button" id="cancelBtn"
                    class="px-4 py-2 rounded-lg border">
                    Annuler
                    </button>

                    <button type="submit"
                            name="submit"
                    class="px-4 py-2 rounded-lg bg-green-600 text-white">
                    Ajouter
                    </button>
                </div>

                </form>
            </div>
            </div>


            <script>
            const openFormBtn = document.getElementById("openFormBtn");
            const taskOverlay = document.getElementById("taskOverlay");
            const cancelBtn = document.getElementById("cancelBtn");
            const taskForm = document.getElementById("taskForm");
            const taskList = document.getElementById("taskList");

            openFormBtn.onclick = () => taskOverlay.classList.remove("hidden");
            cancelBtn.onclick = () => taskOverlay.classList.add("hidden");

            taskForm.addEventListener('submit',  (e) => {

            taskOverlay.classList.add("hidden");
            }) ;
            </script>

            </body>