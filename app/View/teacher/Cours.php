<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Youdemy</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white border-b">
    <div class=" flex flex-col">

<div class="hidden md:block w-full bg-blue-500 text-white">
    <div class="container mx-auto px-4 py-2">
        <div class="flex justify-between items-center text-sm">
            <div class="flex items-center space-x-6">
                <span class="flex items-center">
                    <i class="ri-phone-line mr-2"></i> +212 772508881
                </span>
                <span class="flex items-center">
                    <i class="ri-mail-line mr-2"></i> contact@youdemy.com
                </span>
            </div>
            <span class="flex items-center">
                <i class="ri-map-pin-line mr-2"></i> Massira N641 Safi, Morocco
            </span>
        </div>
    </div>
</div>

<!-- Header -->
<header class="border-b bg-white ">
    <div class="container mx-auto px-4 ">
        <div class="flex items-center justify-between py-4">
            <a href="./index.php">
                <img src="../assets/images/Youdemy_Logo.svg" alt="Youdemy Platform">
            </a>
            <nav class="hidden md:flex items-center space-x-6">
                <a href="./index.php" class="text-blue-400 font-bold hover:text-blue-500 transition-colors">Home</a>
        
                
            </nav>
            <div class="flex items-center space-x-4">
                        <button
                            class="p-2 hidden md:block px-4 bg-blue-400 text-white rounded-full hover:bg-white hover:text-blue-400 hover:border hover:border-blue-400 transition-colors">
                            <a href="./login.php">Login</a>
                        </button>
                        <button
                            class="p-2 hidden md:block px-4 border border-blue-400 text-blue-400 rounded-full hover:bg-blue-400 hover:text-white transition-colors">
                            <a href="./register.php">Register</a>
                        </button>
                        
                    
                    <button
                            class="p-2 hidden md:block px-4 border border-blue-400 text-blue-400 rounded-full hover:bg-blue-400 hover:text-white transition-colors">
                            <a href="../../Back-end/Actions/Auth/auth.php?logout=">Logout</a>
                        </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu Mobile -->
    <div id="sidebar-menu" class="fixed inset-0 bg-gray-800 bg-opacity-75 z-50 hidden">
        <div class="fixed top-0 left-0 w-64 bg-white pt-2 h-full shadow-lg">
            <div class="flex justify-end items-center px-4">
                <button id="close-sidebar" class="text-gray-700 hover:text-blue-500">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>
            <nav class="flex flex-col space-y-4 px-4 py-6">
                <a href="./index.php"
                    class="text-gray-700 hover:text-blue-500 font-bold transition-colors">Home</a>
                <div class="flex flex-col space-y-4 mt-6">
                    <button
                        class="p-2 px-4 bg-blue-400 text-white rounded-full hover:bg-white hover:text-blue-400 hover:border hover:border-blue-400 transition-colors">
                        <a href="./login.php">Login</a>
                    </button>
                    <button
                        class="p-2 px-4 border border-blue-400 text-blue-400 rounded-full hover:bg-blue-400 hover:text-white transition-colors">
                        <a href="./register.php">Register</a>
                    </button>
                </div>
            </nav>
        </div>
    </div>
</header>
</div>
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-center space-x-4">
                    <h1 class="text-2xl font-bold text-gray-800">Teacher Dashboard</h1>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            
            
            <div class="bg-white p-6 rounded-lg shadow-sm border border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Students</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?= $totalStudent ?></h3>
                    </div>
                    <i class="ri-user-line text-2xl text-blue-400"></i>
                </div>
            </div>
            
        </div>


        <!-- Courses Section -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">My Courses</h2>
                <button class="flex items-center space-x-2 bg-blue-400 text-white px-4 py-2 rounded-full hover:bg-blue-500 transition-colors" onclick="toggleModal(true)">
                    <i class="ri-add-circle-line"></i>
                    <span>Add New Course</span>
                </button>
            </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Statistiques des cours -->
        <?php foreach ($studentIn as $courseStats): ?>
            <div class="bg-white p-6 rounded-lg shadow-lg border border-blue-200 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-600 text-sm font-semibold"><?= htmlspecialchars($courseStats['titre']); ?></p>
                        <h3 class="text-3xl font-extrabold text-gray-800 mt-2">
                            <?= htmlspecialchars($courseStats['totalEtudiant']); ?> Students
                        </h3>
                        <p class="text-gray-500 text-sm mt-1">Students: <?= htmlspecialchars($courseStats['nomEtd']); ?></p>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                        <i class="ri-user-line text-3xl text-blue-500"></i>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Course Card -->
                <?php foreach ($cours as $course): ?>
                    <a href="./detailsCours.php?idCours=<?= $course->getId()?>">
                        <div class="bg-white rounded-lg shadow-sm border border-blue-400 overflow-hidden hover:shadow-md transition-shadow">
                            <img src="<?= '..' . $course->getImage() ?>" alt="Course Image" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-lg font-semibold text-gray-800"><?= $course->getTitre()?></h3>
                                    <button class="text-gray-500 hover:text-blue-500">
                                        <i class="ri-more-2-fill"></i>
                                    </button>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="ri-user-line mr-2"></i>
                                    <span>25 Students</span>
                                </div>
                                <div>
                                    <h4 class="text-lg font-light text-gray-800"><?= $course->getDescription()?></h3>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-blue-400 font-bold">$49.99</span>
                                    <div class="flex items-center text-blue-400">
                                        <i class="ri-star-fill mr-1"></i>
                                        4.8
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>

                <!-- Add more course cards here -->
            </div>
        </div>
        <!-- Modal for Adding a Course -->
    <div id="addCourseModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-[80%] p-6 overflow-y-auto h-[80%]">
            <h2 class="text-lg font-semibold text-gray-800">Add New Course</h2>
            <form id="addCourseForm" class="mt-4 space-y-4" action="../../Back-end/Actions/Cours/addCours.php"  method='POST'  enctype="multipart/form-data">
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
                    <div class="flex flex-wrap gap-4 mt-2">
                        <?php
                        foreach ($tags as $tag) {
                            echo "
                            <label class='flex items-center space-x-3 bg-gray-100 border px-4 py-2 rounded-md cursor-pointer hover:bg-gray-200'>
                                <input 
                                    type='checkbox' 
                                    name='tags[]' 
                                    value='{$tag->getId()}' 
                                    class='form-checkbox text-blue-500'>
                                <span class='text-gray-700'>{$tag->getTitre()}</span>
                            </label>";
                        }
                        ?>
                    </div>
                </div>

                <div>
                    <label for="courseCategorie" class="block text-sm font-medium text-gray-700">Categorie</label>
                    <select 
                        id="courseCategorie" 
                        name="categorie" 
                        class="block px-3 py-2 w-full mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <?php
                        foreach ($categorie as $cat) {
                            echo "<option value='".$cat->getId()."'>{$cat->getTitre()}</option>";
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
                        class="block w-full mt-1 border x-3 py-2 h-32 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
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

        
    </div>
    <script>
        function toggleModal(show) {
            const modal = document.getElementById('addCourseModal');
            modal.classList.toggle('hidden', !show);
        }
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
    </script>

</body>

</html>