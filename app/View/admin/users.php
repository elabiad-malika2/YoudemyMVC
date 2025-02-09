<?php
require_once __DIR__ ."./header.php";
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
            Reservation
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
            <input class="search outline-none border-none w-72 px-4 py-2 rounded-2xl" type="search" name="search-input" id="search-input" placeholder="Search reservation by name...">
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
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($data as $user): ?>
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            <?php echo htmlspecialchars($user->getNom()); ?>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">
                            <?php echo htmlspecialchars($user->getEmail()); ?>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                            <?php
                        if ($user instanceof \App\Model\Admin) echo 'bg-purple-100 text-purple-800';
                        elseif ($user instanceof \App\Model\Enseignant) echo 'bg-blue-100 text-blue-800';
                        elseif ($user instanceof \App\Model\Etudiant) echo 'bg-green-100 text-green-800';
                        ?>">
                            <?php
                            if ($user instanceof \App\Model\Admin) echo 'Administrateur';
                            elseif ($user instanceof \App\Model\Enseignant) echo 'Enseignant';
                            elseif ($user instanceof \App\Model\Etudiant) echo 'Étudiant';
                            ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <?php if (!($user instanceof \App\Model\Admin)): ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    <?php echo $user->isBanned()
                                    ? 'bg-red-100 text-red-800'
                                    : 'bg-green-100 text-green-800'; ?>">
                                    <?php echo $user->isBanned() ? 'Banni' : 'Actif'; ?>
                                </span>
                            <?php endif; ?>

                            <?php if ($user instanceof \App\Model\Enseignant): ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    <?php echo $user->isActive()
                                    ? 'bg-blue-100 text-blue-800'
                                    : 'bg-yellow-100 text-yellow-800'; ?>">
                                    <?php echo $user->isActive() ? 'Activé' : 'Désactivé'; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if (!($user instanceof \App\Model\Admin)): ?>
                            <div class="flex space-x-2">
                                <!-- Ban/Unban Action -->
                                <form method="POST" action="/youdemy-mvc/user/setban" class="inline">
                                    <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>">
                                    <input type="hidden" name="ban" value="<?php echo $user->isBanned() ? 'unban' : 'ban'; ?>">
                                    <button type="submit" class="inline-flex items-center px-3 py-1 border rounded-md text-sm font-medium
                                        <?php echo $user->isBanned()
                                        ? 'border-green-600 text-green-600 hover:bg-green-50'
                                        : 'border-red-600 text-red-600 hover:bg-red-50'; ?>
                                        transition-colors duration-200">
                                        <?php if ($user->isBanned()): ?>
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Débloquer
                                        <?php else: ?>
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                            </svg>
                                            Bloquer
                                        <?php endif; ?>
                                    </button>
                                </form>

                                <!-- Teacher Active/Inactive Toggle -->
                                <?php if ($user instanceof \App\Model\Enseignant): ?>
                                    <form method="POST" action="/youdemy-mvc/user/setactive" class="inline">
                                        <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>">
                                        <input type="hidden" name="active" value="<?php echo $user->isActive() ? 'deactivate' : 'activate'; ?>">
                                        <button type="submit" class="inline-flex items-center px-3 py-1 border rounded-md text-sm font-medium
                                            <?php echo $user->isActive()
                                            ? 'border-red-500 text-red-600 hover:bg-red-50'
                                            : 'border-green-500 text-green-600 hover:bg-green-50'; ?>
                                            transition-colors duration-200">
                                            <?php if ($user->isActive()): ?>
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Désactiver
                                            <?php else: ?>
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Activer
                                            <?php endif; ?>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
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
