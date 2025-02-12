<?php
require_once __DIR__ . "/../include/head.php";
?>
<section>
    <div class="container mx-auto px-4 py-12">
        <!-- Course Header -->
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg mb-8">
                <div class="p-8">
                    <div class="flex gap-3 mb-4">
                        <?php $tags = $data['cours']->getTags();
                        foreach($tags as $tag)
                        {
                            ?>
                            <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium">
                                <?php echo $tag->getTitre() ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div>
                    <?php if($data['mine']): ?>
                        <div class="flex gap-2">
                            <button
                                onclick="confirmDelete(<?php echo $data['cours']->getId(); ?>)"
                                class="flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                                <i class="ri-delete-bin-line"></i>
                                Delete
                            </button>
                        </div>
                    <?php endif; ?>
                    <h1 class="text-3xl font-bold text-gray-800 mb-4"><?php echo $data['cours']->getTitre() ?></h1>
                    <p class="text-gray-600 text-lg mb-6"><?php echo $data['cours']->getDescription() ?>.</p>

                    <!-- Instructor Info -->
                    <div class="flex items-center gap-4 pb-4 border-b">
                        <img src="https://placehold.co/48x48" alt="Instructor" class="w-12 h-12 rounded-full">
                        <div>
                            <p class="font-medium text-gray-800">Dr. <?php echo $data['cours']->getFullName() ?></p>
                            <p class="text-gray-500 text-sm">Senior Web Development Instructor</p>
                        </div>
                    </div>
                </div>

                <?php  $data['cours']->afficherCours() ?>




                <!-- Course Content -->
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Main Content -->
                        <div class="md:col-span-2">
                            <h2 class="text-2xl font-bold mb-6">Course Overview </h2>

                            <div class="prose max-w-none">
                                <p class="text-gray-600 mb-4">In this comprehensive course, you'll learn:</p>
                                <ul class="space-y-2 text-gray-600">
                                    <li>HTML5 semantic elements and modern markup</li>
                                    <li>CSS3 layouts, animations, and responsive design</li>
                                    <li>JavaScript ES6+ and DOM manipulation</li>
                                    <li>Modern framework integration and best practices</li>
                                </ul>
                            </div>

                            <!-- Text Content Example -->
                            <div class="mt-8 p-6 bg-gray-50 rounded-xl">
                                <h3 class="text-xl font-bold mb-4">Introduction to Web Development</h3>
                                <div class="prose max-w-none text-gray-600">
                                    <p>Web development is the process of building and maintaining websites. It encompasses several different aspects, including web design, web publishing, web programming, and database management...</p>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="md:col-span-1">
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h3 class="font-bold mb-4">Course Modules</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                                        <i class="ri-play-circle-line text-xl text-blue-500"></i>
                                        <span class="flex-1 font-medium">Getting Started</span>
                                        <span class="text-sm text-gray-500">15:00</span>
                                    </div>
                                    <div class="flex items-center gap-3 p-3 hover:bg-gray-100 rounded-lg">
                                        <i class="ri-file-text-line text-xl text-gray-400"></i>
                                        <span class="flex-1">HTML Basics</span>
                                        <span class="text-sm text-gray-500">20:30</span>
                                    </div>
                                    <div class="flex items-center gap-3 p-3 hover:bg-gray-100 rounded-lg">
                                        <i class="ri-file-text-line text-xl text-gray-400"></i>
                                        <span class="flex-1">CSS Fundamentals</span>
                                        <span class="text-sm text-gray-500">25:15</span>
                                    </div>
                                </div>

                                <!-- Course Resources -->
                                <div class="mt-6">
                                    <h3 class="font-bold mb-4">Course Resources</h3>
                                    <div class="space-y-3">
                                        <div class="flex items-center gap-3 p-3 bg-white rounded-lg shadow-sm">
                                            <i class="ri-file-pdf-line text-xl text-red-500"></i>
                                            <span class="flex-1 text-sm">Course Syllabus</span>
                                            <i class="ri-download-line text-gray-400"></i>
                                        </div>
                                        <div class="flex items-center gap-3 p-3 bg-white rounded-lg shadow-sm">
                                            <i class="ri-file-zip-line text-xl text-orange-500"></i>
                                            <span class="flex-1 text-sm">Project Files</span>
                                            <i class="ri-download-line text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if($data['mine']) {?>
    <div class="p-8 border-t">
        <h2 class="text-2xl font-bold mb-6">Enrolled Students</h2>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Table Header -->
            <div class="grid grid-cols-3 gap-4 p-4 bg-gray-50 border-b text-sm font-medium text-gray-600">
                <div>Student Name</div>
                <div>Email</div>
                <div>Inscription Date</div>
            </div>

            <!-- Table Body -->
            <div class="divide-y">
                <?php foreach($data['etudiant'] as $etudiant): ?>
                    <div class="grid grid-cols-3 gap-4 p-4 items-center hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 font-medium">
                            <?php echo substr($etudiant['fullname'], 0, 1); ?>
                        </span>
                            </div>
                            <span class="font-medium text-gray-800"><?php echo $etudiant['fullname']; ?></span>
                        </div>
                        <div class="text-gray-600"><?php echo $etudiant['email']; ?></div>
                        <div class="text-gray-600">
                            <?php echo date('d M Y', strtotime($etudiant['date_inscription'])); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php } ?>


<?php
require_once __DIR__ . "./../include/footer.php";
?>
</body>
</html>
