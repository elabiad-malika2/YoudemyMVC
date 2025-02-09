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
        <h1>
            Cars
        </h1>
        <div class="flex gap-4">
            <button class="flex gap-2 items-center border px-4 py-2 rounded-lg text-[#0E2354] ">
                <img src="./img/Downlaod.svg" alt="">Export
            </button>
        </div>
    </div>

    <div class="flex justify-between items-center px-4 border py-4 rounded-lg">
        <div class="flex gap-2">
            <img src="./img/Search.svg" alt="">
            <input class="search outline-none border-none w-72 px-4 py-2 rounded-2xl" type="search"
                   name="search-input" id="search-input" placeholder="Search car by name...">
        </div>
        <div class="flex gap-4 items-center">
            <button class="flex gap-2 items-center border px-4 py-2 rounded-lg">
                <img src="./img/Filters lines.svg" alt="">Filters
            </button>
            <div class="flex gap-2">
                <img class="px-4 py-3 border rounded-lg cursor-pointer" src="./img/Vector.svg" alt="">
                <img class="px-4 py-2 border rounded-lg cursor-pointer" src="./img/element-3.svg" alt="">
            </div>
        </div>
    </div>



    <!-- Car Display Grid -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cours</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enseignant</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Étudiants</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($data as $cours): ?>
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <!-- Course Info -->
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 flex-shrink-0">
                                <img class="h-10 w-10 rounded-lg object-cover"
                                     src="../<?php echo htmlspecialchars($cours->getImagePath()); ?>"
                                     alt="<?php echo htmlspecialchars($cours->getTitre()); ?>">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    <?php echo htmlspecialchars($cours->getTitre()); ?>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <?php echo htmlspecialchars(substr($cours->getDescription(), 0, 50)) . '...'; ?>
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Teacher -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo htmlspecialchars($cours->getFullName()); ?></div>
                    </td>

                    <!-- Content Type -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                            <?php echo $cours->getType() === 'video'
                            ? 'bg-purple-100 text-purple-800'
                            : 'bg-blue-100 text-blue-800'; ?>">
                            <?php echo $cours->getType() === 'video' ? 'video' : 'texte'; ?>
                        </span>
                    </td>

                    <!-- Students Count -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <?php echo rand(10, 150); ?> étudiants
                        </div>
                    </td>

                    <!-- Status -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                            <?php
                        switch($cours->getStatus()) {
                            case 'En Attente':
                                echo 'bg-yellow-100 text-yellow-800';
                                break;
                            case 'Accepte':
                                echo 'bg-green-100 text-green-800';
                                break;
                            case 'Archive':
                                echo 'bg-gray-100 text-gray-800';
                                break;
                        }
                        ?>">
                            <?php echo htmlspecialchars($cours->getStatus()); ?>
                        </span>
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <?php if ($cours->getStatus() === 'En Attente'): ?>
                                <form method="POST" action="/youdemy-mvc/cours/updatestatus" class="inline">
                                    <input type="hidden" name="cours_id" value="<?php echo $cours->getId(); ?>">
                                    <input type="hidden" name="action" value="Accepte">
                                    <button type="submit" class="inline-flex items-center px-3 py-1 border border-green-500 text-green-600
                                           hover:bg-green-50 rounded-md text-sm font-medium transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Accepter
                                    </button>
                                </form>
                                <form method="POST" action="/youdemy-mvc/cours/updatestatus" class="inline">
                                    <input type="hidden" name="cours_id" value="<?php echo $cours->getId(); ?>">
                                    <input type="hidden" name="action" value="Archive">
                                    <button type="submit" class="inline-flex items-center px-3 py-1 border border-gray-500 text-gray-600
                                           hover:bg-gray-50 rounded-md text-sm font-medium transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                        </svg>
                                        Archiver
                                    </button>
                                </form>
                            <?php elseif ($cours->getStatus() === 'Archive'): ?>
                                <form method="POST" action="/youdemy-mvc/cours/updatestatus" class="inline">
                                    <input type="hidden" name="cours_id" value="<?php echo $cours->getId(); ?>">
                                    <input type="hidden" name="action" value="Accepte">
                                    <button type="submit" class="inline-flex items-center px-3 py-1 border border-green-500 text-green-600
                                           hover:bg-green-50 rounded-md text-sm font-medium transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Accepter
                                    </button>
                                </form>
                            <?php elseif ($cours->getStatus() === 'Accepte'): ?>
                                <form method="POST" action="/youdemy-mvc/cours/updatestatus" class="inline">
                                    <input type="hidden" name="cours_id" value="<?php echo $cours->getId(); ?>">
                                    <input type="hidden" name="action" value="Archive">
                                    <button type="submit" class="inline-flex items-center px-3 py-1 border border-gray-500 text-gray-600
                                           hover:bg-gray-50 rounded-md text-sm font-medium transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                        </svg>
                                        Archiver
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>




</section>
</div>
</body>
</html>
