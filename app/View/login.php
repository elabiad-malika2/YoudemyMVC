<?php
require_once __DIR__ ."/include/head.php";
?>
<script>
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const sidebarMenu = document.getElementById('sidebar-menu');
    const closeSidebar = document.getElementById('close-sidebar');

    mobileMenuBtn.addEventListener('click', () => {
        sidebarMenu.classList.remove('hidden');
    });

    closeSidebar.addEventListener('click', () => {
        sidebarMenu.classList.add('hidden');
    });

    sidebarMenu.addEventListener('click', (e) => {
        if (e.target === sidebarMenu) {
            sidebarMenu.classList.add('hidden');
        }
    });
</script>






<!-- Login Form -->
<section
    class="hero bg-blue-500/5 flex-grow flex justify-center items-center border-blue-400 bg-opacity-20   bg-cover bg-center">
    <div class="bg-white/10 backdrop-blur-lg rounded-lg p-8 shadow-lg w-full max-w-md">
        <h2 class="text-blue-400 text-center text-3xl font-semibold mb-6">Login</h2>
        <span class="flex justify-center text-center text-red-700 mb-5">
                    <?php if (!empty($errorMessage)): ?>
                        <?= htmlspecialchars($errorMessage) ?>
                    <?php endif; ?>
                </span>
        <form method="post" action="/Youdemy-mvc/auth/login">
            <div class="relative mb-4">
                <i class="ri-user-line text-gray-300 absolute left-4 top-2 text-xl"></i>
                <input type="text" placeholder="Username" name="username"
                       class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg bg-white/10 text-gray-600 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" />
            </div>

            <div class="relative mb-4">
                <i class="ri-lock-line text-gray-300 absolute left-4 top-2 text-xl"></i>
                <input type="password" placeholder="Password" name="password"
                       class="w-full pl-12 border border-gray-300 pr-4 py-2 rounded-lg bg-white/10 text-gray-600 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" />
            </div>

            <div class="flex justify-between text-white text-sm mb-6">
                <label class="flex items-center text-gray-600">
                    <input type="checkbox" class="mr-2 black" />
                    Remember Me
                </label>
                <a href="#" class="hover:underline text-gray-600">Forgot Password?</a>
            </div>

            <button type="submit" name="login"
                    class="w-full py-2 bg-blue-400 hover:bg-black text-white font-semibold rounded-lg transition duration-200 hover:bg-white hover:border hover:border-blue-400 hover:text-blue-400 hover:text-black">
                Login
            </button>
        </form>

        <p class="text-center text-gray-600  mt-4">
            Don't have an account?
            <a href="/Youdemy-mvc/home/signup" class="text-black hover:underline">Register</a>
        </p>
    </div>
</section>
</div>

<?php
require_once __DIR__ ."/include/footer.php";
?>
</body>
</html>