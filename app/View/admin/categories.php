<?php
require_once __DIR__ ."/header.php";
?>
<section class="p-4 w-full flex flex-col gap-8">
    <?php
    if (isset($_SESSION['error'])) {
        set_time_limit(2);
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    ?>

    <div class="flex justify-between items-center px-8">
        <h1>Cars</h1>
        <div class="flex gap-4">
            <button
                class="flex gap-2 items-center border px-4 py-2 rounded-lg text-[#0E2354]"
            >
                <img src="/youdemy-mvc/public/img/Downlaod.svg" alt="" />Export
            </button>
            <button
                id="add-etd"
                class="flex gap-2 items-center bg-primary px-4 py-2 rounded-lg text-white"
            >
                <img src="/youdemy-mvc/public/img/_Avatar add button.svg" alt="" />New Category
            </button>
        </div>
    </div>

    <div
        class="flex justify-between items-center px-4 border py-4 rounded-lg"
    >
        <div class="flex gap-2">
            <img src="/youdemy-mvc/public/img/Search.svg" alt="" />
            <input
                class="search outline-none border-none w-72 px-4 py-2 rounded-2xl"
                type="search"
                name="search-input"
                id="search-input"
                placeholder="Search car by name..."
            />
        </div>
        <div class="flex gap-4 items-center">
            <button
                class="flex gap-2 items-center border px-4 py-2 rounded-lg"
            >
                <img src="/youdemy-mvc/public/img/Filters lines.svg" alt="" />Filters
            </button>
            <div class="flex gap-2">
                <img
                    class="px-4 py-3 border rounded-lg cursor-pointer"
                    src="/youdemy-mvc/public/img/Vector.svg"
                    alt=""
                />
                <img
                    class="px-4 py-2 border rounded-lg cursor-pointer"
                    src="/youdemy-mvc/public/img/element-3.svg"
                    alt=""
                />
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach($data as $category){ ?>

            <div
                class="bg-white rounded-lg shadow-md p-6 flex justify-between items-center"
            >
                <div class="flex-1">
                    <h3 class="text-xl font-semibold text-gray-800">
                        <?php echo $category->getTitre(); ?>
                    </h3>
                </div>
                <div class="flex gap-4">
                    <button
                        onclick="openEditModal('<?php echo $category->getTitre(); ?>', <?php echo $category->getId(); ?>)">
                        <img src="/youdemy-mvc/public/img/editinggh.png" alt="Edit" class="w-5 h-5" />
                    </button>

                    <a
                        href="/youdemy-mvc/categorie/supprimer/<?php echo $category->getId(); ?>"
                    ><img src="/youdemy-mvc/public/img/delete.png" alt="Delete" class="w-5 h-5"
                        /></a>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
</div>

<div
    id="categoryModal"
    class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg w-96 p-6">
        <h2 class="text-2xl font-semibold mb-4">Add New Category</h2>
        <form
            id="categoryForm"
            method="POST"
            action="/youdemy-mvc/categorie/ajouter"
        >
            <label
                for="categoryName"
                class="block text-sm font-medium text-gray-700"
            >Category Name</label
            >
            <input
                type="text"
                id="categoryName"
                name="nom-category"
                class="w-full p-3 mt-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary"
                placeholder="Enter category name"
                required
            />
            <div class="mt-6 flex justify-end gap-4">
                <button
                    type="button"
                    id="closeModal"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    name="submit"
                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark"
                >
                    Add Category
                </button>
            </div>
        </form>
    </div>
</div>
</div>
<div
    id="categoryModal-edit"
    class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg w-96 p-6">
        <h2 class="text-2xl font-semibold mb-4">Modify Category</h2>
        <form
            id="categoryForm-edit"
            method="POST"
            action="/youdemy-mvc/categorie/modifier"
        >
            <input
                type="hidden"
                id="id-category-edit"
                name="id-category-edit"

            />
            <label
                for="nom-category-edit"
                class="block text-sm font-medium text-gray-700"
            >Category Name</label
            >
            <input
                type="text"
                id="nom-category-edit"
                name="nom-category-edit"
                class="w-full p-3 mt-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary"
                placeholder="Enter category name"
                required
            />
            <div class="mt-6 flex justify-end gap-4">
                <button
                    type="button"
                    id="closeModal-edit"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    name="edit"
                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark"
                >
                    Modify Category
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const modalEdit = document.getElementById("categoryModal-edit");
    const modal = document.getElementById("categoryModal");
    const addCategoryButton = document.getElementById("add-etd");
    const closeModalButton = document.getElementById("closeModal");
    const categoryForm = document.getElementById("categoryForm");

    addCategoryButton.addEventListener("click", () => {
        modal.classList.remove("hidden");
    });

    closeModalButton.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.classList.add("hidden");
        }
    });
    function openEditModal(titre,id) {
        const catTtire = <?php echo json_encode($category->getTitre()) ?>;
        const carid = <?php echo json_encode($category->getId()) ?>;

        modalEdit.classList.remove("hidden");
        document.getElementById("nom-category-edit").value = titre;
        document.getElementById("id-category-edit").value = id;
    }
    document.getElementById("closeModal-edit").addEventListener("click", () => {
        modalEdit.classList.add("hidden");
    });
</script>
</body>
</html>
