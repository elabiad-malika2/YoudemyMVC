<?php

use App\Model\Etudiant;

require_once __DIR__ . "/../include/head.php";
?>
<section class="py-16 px-4 bg-white">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">
                Explore Top Courses
                <span
                    class="bg-gradient-to-r from-blue-600 to-blue-300 bg-clip-text text-transparent">Categories</span>
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Find the perfect course to enhance your skills and advance your career. Choose from our wide range
                of professional courses designed by industry experts.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach($data['categorie'] as $categorie)
            {
                echo " <div
                    class='bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow border border-gray-100 hover:border-blue-400 hover:scale-105 transition-transform duration-300'>
                    <div class='flex items-center gap-4'>
                        <div class='p-3 bg-blue-400 text-white rounded-lg'>
                            <i class='ri-code-line text-2xl'></i>
                        </div>
                        <div>
                            <h3 class='font-semibold text-lg'>".$categorie->getTitre()."</h3>
                            <p class='text-gray-500 text-sm'>1 Course</p>
                        </div>
                    </div>
                </div>";
            }
            ?>


        </div>

    </div>
</section>

<script >
    function confirmInscription(courseId) {
        Swal.fire({
            title: 'Confirmer l\'inscription',
            text: "Voulez-vous vous inscrire à ce cours ?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, je m\'inscris!',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform the inscription
                window.location.href = `../app/actions/inscrire/add.php?idCours=${courseId}`;
            }
        });
    }
</script>
<!-- Courses Grid Section -->
<section>
    <div class=" py-10 md:px-12 px-6">
        <h2 class="text-4xl font-bold text-gray-800 mb-6 text-center md:mb-11">
            Our Recent <span
                class="text-gradient bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-600">Courses</span>
        </h2>
        <div class="mb-10 flex justify-center">
            <div class="relative w-full max-w-lg">
                <form id="searchForm" >
                    <input
                        name="search"
                        type="text"
                        id="searchInput"
                        placeholder="Search for a course..."
                        class="w-full py-3 px-6 rounded-full border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 ease-in-out"
                    />
                </form>
                <div class="absolute right-4 top-3.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-blue-500 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M18 10a8 8 0 11-16 0 8 8 0 0116 0z" />
                    </svg>
                </div>
            </div>

        </div>
        <script>
            document.getElementById('searchInput').addEventListener('change', function(){
                const value = document.getElementById('searchInput').value.trim(); // Ensure value is retrieved properly
                if(value !== '') { // Prevent empty submissions
                    document.getElementById('searchForm').action = '/youdemy-mvc/home/cours/' + encodeURIComponent(value);
                    document.getElementById('searchForm').submit();
                }
            });
        </script>
        <div class="flex flex-wrap gap-6 justify-center items-center">
            <?php

            foreach($data['cours'] as $cou)
            {
                $tags = $cou->getTags();

                if($cou instanceof \App\Model\CoursVideo)
                {
                    ?>

                    <div class="bg-white rounded-2xl w-[30%] shadow-lg overflow-hidden transform transition-transform hover:scale-[1.02] hover:shadow-xl">
                        <div class="relative">
                            <div class="">
                                <img src="/youdemy-mvc/public/<?php echo $cou->getImagePath() ?>" alt="Course thumbnail" class="">
                            </div>
                            <div class="absolute top-4 right-4">
                                        <span class="bg-blue-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-md">
                                            Video Course
                                        </span>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-2 mb-4">
                                <?php foreach($tags as $tag) {?>
                                    <span class="text-sm font-medium px-3 py-1 rounded-full bg-blue-100 text-blue-600">
                                           <?php echo $tag->getTitre(); ?>
                                        </span>
                                <?php }?>
                            </div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-800">
                                <?php echo $cou->getTitre() ?>
                            </h3>
                            <p class="text-gray-600 mb-6 line-clamp-2">
                                <?php echo $cou->getDescription() ?>
                            </p>
                            <div class="flex items-center justify-between mb-4"> <!-- Added margin bottom -->
                                <div class="flex items-center gap-2">
                                    <img src="./assets/images/userimage.png" alt="Instructor" class="w-10 h-10 object-contain rounded-full">
                                    <span class="text-sm font-medium text-gray-700">
                                            Dr. <?php echo ($cou->getFullName()) ?>
                                            </span>
                                </div>
                            </div>

                            <!-- Actions Container -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <?php if (isset($_SESSION['logged_id'])): ?>
                                    <a href="/Youdemy-mvc/home/viewCours/<?php echo $cou->getId(); ?>" class="text-blue-500 hover:text-blue-700 font-medium">
                                        View Course →
                                    </a>
                                <?php else: ?>
                                    <a  href="login.php" class="text-gray-500 font-medium">
                                        Login to view course
                                    </a>
                                <?php endif; ?>

                                <?php  if( $data['$isEtudiant'] && Etudiant::checkCourse($data['$idLog'],$cou->getId()) == 0 ): ?>
                                    <button
                                        onclick="confirmInscription(<?php echo $cou->getId();?>)"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                                        <i class="ri-user-add-line"></i>
                                        S'inscrire
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="bg-white rounded-2xl w-[30%] shadow-lg overflow-hidden transform transition-transform hover:scale-[1.02] hover:shadow-xl">
                        <div class="relative">
                            <div class="">
                                <img src="/youdemy-mvc/public/<?php echo $cou->getImagePath() ?> " alt="<?php echo $cou->getImagePath() ?> ">
                            </div>
                            <div class="absolute top-4 right-4">
                            <span class="bg-emerald-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-md">
                                Text Course
                            </span>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-2 mb-4">

                                <?php foreach($tags as $tag) {?>
                                    <span class="text-sm font-medium px-3 py-1 rounded-full bg-emerald-100 text-emerald-600">
                                <?php echo $tag->getTitre(); ?>
                                        </span>
                                <?php }?>
                            </div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-800">
                                <?php echo $cou->getTitre() ?>
                            </h3>
                            <p class="text-gray-600 mb-6 line-clamp-2">
                                <?php echo $cou->getDescription() ?>
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <img src="./assets/images/userimage.png" alt="Instructor" class="w-10 h-10 object-contain rounded-full">
                                    <span class="text-sm font-medium text-gray-700">
                                Dr. <?php echo ($cou->getFullName()) ?>
                                </span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <?php if (isset($_SESSION['logged_id'])): ?>
                                    <a href="/Youdemy-mvc/home/viewCours/<?php echo $cou->getId(); ?>" class="text-blue-500 hover:text-blue-700 font-medium">
                                        View Course →
                                    </a>
                                <?php else: ?>
                                    <a  href="login.php" class="text-gray-500 font-medium">
                                        Login to view course
                                    </a>
                                <?php endif; ?>

                                <?php  if( $data['$isEtudiant'] && Etudiant::checkCourse($data['$idLog'],$cou->getId()) == 0 ): ?>
                                    <button
                                        onclick="confirmInscription(<?php echo $cou->getId();?>)"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                                        <i class="ri-user-add-line"></i>
                                        S'inscrire
                                    </button>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                    <?php
                }
            }


            ?>
        </div>

    </div>
    <div class="flex w-full justify-center items-center gap-2">
        <?php
        for($i =1;$i<=$data['totalpage'];$i++)
            echo " <a href='/youdemy-mvc/home/cours/$i' class='py-1 px-3 rounded-xl hover:bg-blue-500 hover:text-white  border'>$i</a>
"
        ?>

    </div>
</section>
<script >
    function confirmInscription(courseId) {
        Swal.fire({
            title: 'Confirmer l\'inscription',
            text: "Voulez-vous vous inscrire à ce cours ?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, je m\'inscris!',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform the inscription
                window.location.href = `/youdemy-mvc/etudiant/inscrire/${courseId}`;
            }
        });
    }
</script>
<?php
require_once __DIR__ . "./../include/footer.php";
?>
</body>
</html>
