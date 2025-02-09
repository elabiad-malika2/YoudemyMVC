<?php
if (isset($_SESSION['message'])) {
        
    $message = $_SESSION['message'];
    $type = $_SESSION['message_type'] ?? 'success'; 
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                text: '$message',
                icon: '$type',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>";
    unset($_SESSION['message'], $_SESSION['message_type']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Youdemy</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 h-screen w-64 bg-white border-r shadow-sm">
        <div class="p-4">
            <img src="/api/placeholder/150/50" alt="Youdemy Logo" class="mb-8">
            <nav class="space-y-2">
                <a href="#" class="flex items-center space-x-3 p-3 text-blue-500 bg-blue-50 rounded-lg">
                    <i class="ri-dashboard-line text-lg"></i>
                    <span>Dashboard</span>
                </a>
                <a href="./teacher.php" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class="ri-user-follow-line text-lg"></i>
                    <span>Teacher Validation</span>
                </a>
                <a href="./users.php" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class="ri-user-settings-line text-lg"></i>
                    <span>User Management</span>
                </a>
                <a href="./cours.php" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class="ri-book-open-line text-lg"></i>
                    <span>Courses & Categories</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class="ri-price-tag-3-line text-lg"></i>
                    <span>Tags Management</span>
                </a>
                <a href="../../Back-end/Actions/Auth/auth.php?logout=" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <span>Logout</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 p-8">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
            <div class="flex items-center space-x-4">
                <button class="p-2 text-gray-600 hover:text-blue-500">
                    <i class="ri-notification-3-line text-xl"></i>
                </button>
                <div class="flex items-center space-x-2">
                    <img src="/api/placeholder/32/32" alt="Admin" class="w-8 h-8 rounded-full">
                    <span class="text-gray-700">Admin</span>
                </div>
            </div>
        </header>

        <!-- Global Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-blue-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Total Users</p>
                        <h3 class="text-2xl font-bold text-gray-800">1,234</h3>
                    </div>
                    <i class="ri-user-line text-2xl text-blue-400"></i>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-sm border border-blue-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Total Courses</p>
                        <h3 class="text-2xl font-bold text-gray-800">256</h3>
                    </div>
                    <i class="ri-book-open-line text-2xl text-blue-400"></i>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-sm border border-blue-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Active Teachers</p>
                        <h3 class="text-2xl font-bold text-gray-800">48</h3>
                    </div>
                    <i class="ri-teacher-line text-2xl text-blue-400"></i>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-sm border border-blue-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Total Revenue</p>
                        <h3 class="text-2xl font-bold text-gray-800">$45,678</h3>
                    </div>
                    <i class="ri-money-dollar-circle-line text-2xl text-blue-400"></i>
                </div>
            </div>
        </div>

        

        <!-- Statistics Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Top Courses -->
            <div class="bg-white rounded-lg shadow-sm border border-blue-100 p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Most Popular Courses</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <img src="/api/placeholder/48/48" alt="Course" class="w-12 h-12 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-800">Complete Web Development</p>
                                <p class="text-sm text-gray-500">548 students</p>
                            </div>
                        </div>
                        <span class="text-blue-400">4.9 ★</span>
                    </div>
                </div>
            </div>
            <!-- Statistics by Category -->
                    <div class="bg-white rounded-lg shadow-sm border border-blue-100 p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Total Courses by Category</h2>
                        <div class="space-y-4">
                            <?php foreach ($totalCoursCat as $category): ?>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-medium text-gray-800"><?= htmlspecialchars($category['titre']) ?></p>
                                        <p class="text-sm text-gray-500"><?= $category['totalCours'] ?> courses</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

            <!-- Top Teachers -->
            <div class="bg-white rounded-lg shadow-sm border border-blue-100 p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Top Teachers</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <img src="/api/placeholder/48/48" alt="Teacher" class="w-12 h-12 rounded-full">
                            <div>
                                <p class="font-medium text-gray-800">John Smith</p>
                                <p class="text-sm text-gray-500">15 courses, 1,234 students</p>
                            </div>
                        </div>
                        <span class="text-blue-400">4.8 ★</span>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Bulk Tags Management -->
        <div class="bg-white rounded-lg shadow-sm border border-blue-100 p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Bulk Tags Management</h2>
            <form id="tag-form" method="POST" action="/YoudemyMVC/public/tag/create">
                <div id="tag-inputs" class="space-y-2">
                    <input 
                        type="text"
                        name="tags[]"
                        placeholder="Enter tag " 
                        class="w-full h-20 p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400"
                    >
                </div>
                <div class="flex space-x-4 mt-4">
                    <button type ='submit' class="w-full px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500">
                        Add Tags
                    </button>
                    <button type='button' id="add-tag-input" class="w-full px-4 py-2 border border-blue-400 text-blue-400 rounded-lg hover:bg-blue-50">
                        Add Another Tag
                    </button>
                </div>
            </form>
            <div id="tag-list" class="mt-4 flex flex-wrap gap-2">
                <?php
                    foreach ($data as $tag) {
                        echo "<span class='px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm flex items-center'>#{$tag->getTitre()}
                                <a href='../../Back-end/actions/Tag/Ajouter.php?id={$tag->getId()}' class='ml-2 text-blue-600 hover:text-blue-800'>×</a>
                            </span>";
                    }
                ?>
            </div>
        </div>
        

    </main>
    <script>
        document.getElementById('add-tag-input').addEventListener('click', function() {
            const newInput = document.createElement('input');
            newInput.name = "tags[]";
            newInput.type = "text";
            newInput.placeholder = "Enter another tag";
            newInput.className = "w-full h-20 p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400";
            document.getElementById('tag-inputs').appendChild(newInput);
        });
    </script>
</body>

</html>