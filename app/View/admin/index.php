<?php
require_once __DIR__ ."/header.php";
?>
<div class="p-6 bg-gray-50">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Total Courses -->
    <div class="transform hover:scale-105 transition-transform duration-300">
        <div class="bg-white rounded-lg shadow-md p-6 animate-fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total des cours</p>
                    <p class="text-3xl font-bold text-gray-900"><?php echo $data['totalCours'] ?></p>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Categories -->
    <div class="transform hover:scale-105 transition-transform duration-300">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Catégories</p>
                    <p class="text-3xl font-bold text-gray-900"><?php echo $data['totalCoursByCategory'][0]['totalcategorie'] ?></p>
                    <div class="mt-2 text-sm text-gray-500">
                        <span class="font-medium text-green-600"><?php echo $data['totalCoursByCategory'][0]['titre'] ?> (<?php echo $data['totalCoursByCategory'][0]['totalcours'] ?>)</span>
                        <?php for($i = 1; $i<count($data['totalCoursByCategory']);$i++){ ?>
                            <span class="block"><?php echo $data['totalCoursByCategory'][$i]['titre'] ?> (<?php echo $data['totalCoursByCategory'][$i]['totalcours'] ?>)</span>
                        <?php }?>
                    </div>
                </div>
                <div class="p-3 bg-purple-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Most Popular Course -->
    <div class="transform hover:scale-105 transition-transform duration-300">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Cours le plus populaire</p>
                    <p class="text-xl font-bold text-gray-900"><?php echo $data['mostInscriptions']['titre'] ?? 0?></p>
                    <p class="text-sm text-gray-500"><?php echo $data['mostInscriptions']['totalinscription'] ?? 0?> étudiants</p>
                </div>
                <div class="p-3 bg-yellow-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Teachers -->
    <div class="transform hover:scale-105 transition-transform duration-300">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <p class="text-sm font-medium text-gray-600">Top 3 Enseignants</p>
                </div>
                <div class="space-y-2">
                    <?php foreach($data['topCoursesWithInstructor'] as $top) {?>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium">Prof. <?php echo $top['fullname'] ?></span>
                            <span class="text-sm text-green-600"><?php echo $top['totalinscriptions'] ?> Inscription</span>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</div>
</body>
</html>