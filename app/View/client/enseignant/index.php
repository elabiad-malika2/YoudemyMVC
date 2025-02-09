<?php
require_once __DIR__ ."/../../include/head.php";
?>
<section class="bg-blue-500/5 py-12 px-6 md:px-12">
    <div class="container mx-auto">
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Tableau de Bord
                <span class="block text-gradient">Statistiques des Cours</span>
            </h1>
            <p class="text-gray-600 md:text-lg">Aperçu de vos performances et de l'engagement des étudiants</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Students Card -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-blue-100 hover:border-blue-300 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <i class="ri-user-line text-2xl text-blue-600"></i>
                    </div>
                    <span class="text-sm text-gray-500">Total Étudiants</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">0</h3>
                <p class="text-green-500 text-sm mt-2 flex items-center">
                    <i class="ri-arrow-up-line mr-1"></i>
                    +12.5% ce mois
                </p>
            </div>

            <!-- Total Courses Card -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-blue-100 hover:border-blue-300 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <i class="ri-book-open-line text-2xl text-blue-600"></i>
                    </div>
                    <span class="text-sm text-gray-500">Total Cours</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">0</h3>
                <p class="text-green-500 text-sm mt-2 flex items-center">
                    <i class="ri-arrow-up-line mr-1"></i>
                    +5.3% ce mois
                </p>
            </div>

            <!-- Average Rating Card -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-blue-100 hover:border-blue-300 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <i class="ri-star-line text-2xl text-blue-600"></i>
                    </div>
                    <span class="text-sm text-gray-500">Note Moyenne</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">4.8</h3>
                <p class="text-green-500 text-sm mt-2 flex items-center">
                    <i class="ri-arrow-up-line mr-1"></i>
                    +0.3 ce mois
                </p>
            </div>

            <!-- Completion Rate Card -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-blue-100 hover:border-blue-300 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <i class="ri-medal-line text-2xl text-blue-600"></i>
                    </div>
                    <span class="text-sm text-gray-500">Taux Completion</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">85%</h3>
                <p class="text-green-500 text-sm mt-2 flex items-center">
                    <i class="ri-arrow-up-line mr-1"></i>
                    +2.1% ce mois
                </p>
            </div>
        </div>
    </div>
</section>



<!-- Courses Categories Section  -->


<!-- Courses Grid Section -->

<section>
    <div class="py-10 md:px-12 px-6">
        <button
                class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition"
                onclick="toggleModal(true)">
            Add Coursed
        </button>
        <script>
            function toggleModal(show) {
                const modal = document.getElementById('addCourseModal');
                modal.classList.toggle('hidden', !show);
            }
        </script>

        <!-- Existing Course Card -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <?php foreach($data[1] as $courItem) { ?>
                <div class="group relative bg-white border border-blue-200 rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300">
                    <!-- Course Image Container -->
                    <div class="relative">
                        <img
                                src="../<?php echo $courItem->getImagePath();?>"
                                alt="Course Image"
                                class="w-full h-48 object-cover"
                        >
                        <!-- Overlay Actions -->
                        <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center space-x-4">
                            <a
                                    href="/youdemy-mvc/home/viewCours/<?php echo $courItem->getId();?>"
                                    class="bg-white text-blue-600 p-2 rounded-full hover:bg-blue-50 transition-colors">
                                <i class="ri-eye-line text-xl"></i>
                            </a>
                            <button
                                    onclick="confirmDelete(<?php echo $courItem->getId();?>)"
                                    class="bg-white text-red-500 p-2 rounded-full hover:bg-red-50 transition-colors">
                                <i class="ri-delete-bin-line text-xl"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Course Content -->
                    <div class="p-5">
                        <!-- Course Status Badge -->
                        <div class="flex justify-between items-center mb-3">
                <span class="bg-blue-50 text-blue-600 text-xs font-medium px-2.5 py-1 rounded-full">
                    <?php echo ($courItem->getStatus()) ?>
                </span>
                            <span class="text-gray-500 text-sm">
                    <i class="ri-calendar-line"></i>
                    <?php echo date('d M, Y'); ?>
                </span>
                        </div>

                        <!-- Course Title -->
                        <h3 class="text-xl font-semibold text-gray-800 mb-2 line-clamp-1">
                            <?php echo $courItem->getTitre();?>
                        </h3>

                        <!-- Course Description -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            <?php echo $courItem->getDescription();?>
                        </p>

                        <!-- Course Stats -->
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                <span class="flex items-center">
                    <i class="ri-file-list-line mr-1"></i> 3 Lessons
                </span>
                            <span class="flex items-center">
                    <i class="ri-time-line mr-1"></i> 2.5 hrs
                </span>
                            <span class="flex items-center">
                    <i class="ri-group-line mr-1"></i> 7 Students
                </span>
                        </div>

                        <!-- Course Footer -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center space-x-1">
                                <i class="ri-star-fill text-yellow-400"></i>
                                <span class="font-semibold">4.4</span>
                                <span class="text-gray-500 text-sm">(128)</span>
                            </div>
                            <span class="text-blue-600 font-semibold">Free</span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Delete Confirmation Modal Script -->
        <script>
            function confirmDelete(courseId) {
                Swal.fire({
                    title: 'Delete Course?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `/youdemy-mvc/cours/supprimer/${courseId}`;
                    }
                });
            }

            function editCourse(courseId) {
                // Add your edit course logic here
                // window.location.href = `edit_course.php?id=${courseId}`;
            }
        </script>
    </div>

    <!-- Modal for Adding a Course -->
    <div id="addCourseModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-[80%] p-6 overflow-y-auto h-[80%]">
            <h2 class="text-lg font-semibold text-gray-800">Add New Course</h2>
            <form id="addCourseForm" class="mt-4 space-y-4"  enctype="multipart/form-data">
                <div>
                    <label for="courseTitle" class="block text-sm font-medium text-gray-700">Title</label>
                    <input
                            type="text"
                            id="courseTitle"
                            name="title"
                            class="block w-full  px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="courseDescription" class="block  text-sm font-medium text-gray-700">Description</label>
                    <textarea
                            id="courseDescription"
                            name="description"
                            class="block w-full mt-1 border px-3 py-2 h-32 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </textarea>
                </div>
                <div>
                    <label for="courseImage" class="block  text-sm font-medium text-gray-700">Image</label>
                    <input
                            type="file"
                            id="courseImage"
                            name="image"
                            accept="image/*"
                            class="block w-full mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">                </div>
                <div>
                    <label for="courseTags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <input
                            type="text"
                            id="courseTags"
                            name="tags"
                            class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="Type and press Enter to add tags">
                    <div id="tagsList" class="hidden bg-white border mt-1 rounded-md shadow-md overflow-y-auto max-h-32 w-full"></div>
                    <div id="selectedTags" class="mt-2 flex flex-wrap gap-2"></div>
                    <input type="hidden" name="[]" id="tags">
                </div>
                <div>
                    <label for="courseCategorie" class="block text-sm font-medium text-gray-700">Categorie</label>
                    <select
                            id="courseCategorie"
                            name="categorie"
                            class="block px-3 py-2 w-full mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <?php
                        foreach($data[0] as $categorie)
                        {
                            echo "<option value ='".$categorie->getId()."'>".$categorie->getTitre()."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="courseType" class="block text-sm font-medium text-gray-700">Type</label>
                    <select
                            id="courseType"
                            name="type"
                            class="block px-3 py-2 w-full mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            onchange="toggleContentField()">
                        <option value="text">Text</option>
                        <option value="video">Video</option>
                    </select>
                </div>
                <div id="textContentField" class="hidden">
                    <label for="courseText" class="block text-sm font-medium text-gray-700">Text Content</label>
                    <textarea
                            id="courseText"
                            name="content"
                            class="block w-full mt-1 border x-3 py-2 h-32 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </textarea>
                </div>
                <div id="videoContentField" class="hidden">
                    <label for="courseVideo" class="block text-sm font-medium text-gray-700">Video File</label>
                    <input
                            type="file"
                            id="courseVideo"
                            name="video"
                            accept="video/*"
                            class="block w-full mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="flex justify-end space-x-4">
                    <button
                            type="button"
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-md hover:bg-gray-400 transition"
                            onclick="toggleModal(false)">
                        Cancel
                    </button>
                    <button
                            id="addCours"
                            type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition">
                        Add Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>



<script>

    function toggleModal(show) {
        const modal = document.getElementById('addCourseModal');
        modal.classList.toggle('hidden', !show);
    }
    console.log("ana test")
    function toggleContentField() {
        const type = document.getElementById('courseType').value;
        const textField = document.getElementById('textContentField');
        const videoField = document.getElementById('videoContentField');

        if (type === 'text') {
            textField.classList.remove('hidden');
            videoField.classList.add('hidden');
        } else if (type === 'video') {
            textField.classList.add('hidden');
            videoField.classList.remove('hidden');
        }
    }

    const courseTagsInput = document.getElementById('courseTags');
    const tagsList = document.getElementById('tagsList');
    const selectedTagsContainer = document.getElementById('selectedTags');
    let selectedTags = [];

    function fetchTags(query) {
        fetch(`/Youdemy-mvc/Tag/getalljson/${query}`)
            .then(response => response.json())
            .then(tags => {
                tagsList.innerHTML = '';
                tags.forEach(tag => {
                    const tagItem = document.createElement('div');
                    tagItem.classList.add('px-4', 'py-2', 'cursor-pointer', 'hover:bg-gray-100');
                    tagItem.textContent = tag.titre;
                    tagItem.setAttribute('data-id', tag.id);
                    tagItem.setAttribute('data-name', tag.titre);
                    tagsList.appendChild(tagItem);
                    tagItem.addEventListener('click', function () {
                        addTag(tag);
                    });
                });
                tagsList.classList.remove('hidden');
            });
    }

    function addTag(tag) {
        if (!selectedTags.some(t => t.id === tag.id || t.titre.toLowerCase() === tag.titre.toLowerCase())) {
            selectedTags.push(tag);
            updateSelectedTags();

        }
        courseTagsInput.value = '';
        tagsList.classList.add('hidden');
    }

    function removeTag(tag) {
        selectedTags = selectedTags.filter(t => t.id !== tag.id);
        console.log(selectedTags)
        updateSelectedTags();
    }

    function updateSelectedTags() {
        selectedTagsContainer.innerHTML = '';
        selectedTags.forEach(tag => {
            const tagElement = document.createElement('div');
            tagElement.classList.add('bg-blue-500', 'text-white', 'px-4', 'py-1', 'rounded-full', 'flex', 'items-center', 'gap-2');
            tagElement.textContent = tag.titre;
            const removeIcon = document.createElement('span');
            removeIcon.textContent = '×';
            removeIcon.classList.add('cursor-pointer');
            removeIcon.addEventListener('click', () => removeTag(tag));
            tagElement.appendChild(removeIcon);
            selectedTagsContainer.appendChild(tagElement);
        });

    }

    courseTagsInput.addEventListener('input', function () {
        const query = courseTagsInput.value.trim();
        if (query.length >= 1) {
            fetchTags(query);
        } else {
            tagsList.classList.add('hidden');
        }
    });

    courseTagsInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && courseTagsInput.value.trim() !== '') {
            e.preventDefault();
            const newTag = { id: 'new' + selectedTags.length, titre: courseTagsInput.value.trim() };
            addTag(newTag);
        }
    });
    document.getElementById('addCourseForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('selectedTags', JSON.stringify(selectedTags));
        fetch('/youdemy-mvc/cours/ajouter', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                window.location.href ='/youdemy-mvc/enseignant'

            })
            .catch(error => {
                console.error('Error occurred:', error);
                alert(`An unexpected error occurred: ${error.message}`);
            });

    });
    // Open the modal and populate course data




</script>

<?php
require_once __DIR__ ."/../../include/footer.php";
?>
</body>
</html>