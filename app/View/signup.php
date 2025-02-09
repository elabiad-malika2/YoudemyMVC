<?php
require_once __DIR__ ."/include/head.php";
?>
<section
    class="hero bg-blue-500/5 flex-grow flex justify-center items-center border-blue-400 bg-opacity-20 bg-cover bg-center">
    <div class="bg-white/10 backdrop-blur-lg rounded-lg p-8 shadow-lg w-full max-w-md">
        <h2 class="text-blue-400 text-center text-3xl font-semibold mb-6">Register</h2>
        <form method="post" action="/Youdemy-mvc/auth/signup" name="signup-form" id="registerForm" enctype="multipart/form-data">
            <div class="relative mb-4">
                <i class="ri-user-line text-gray-300 absolute left-4 top-2.5 text-xl"></i>
                <input type="text" placeholder="Username" name="fullName-signup" id="username" required
                       class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg bg-white/10 text-gray-600 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" />
            </div>

            <div class="relative mb-4">
                <i class="ri-mail-line text-gray-300 absolute left-4 top-2.5 text-xl"></i>
                <input type="email" placeholder="Email" name="email-signup" id="email" required
                       class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg bg-white/10 text-gray-600 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" />
            </div>

            <div class="relative mb-4">
                <i class="ri-lock-line text-gray-300 absolute left-4 top-2.5 text-xl"></i>
                <input type="password" placeholder="Password" name="password-signup" id="password" required
                       class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg bg-white/10 text-gray-600 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" />
            </div>
            <div class="relative mb-4">
                <i class="ri-lock-line text-gray-300 absolute left-4 top-2.5 text-xl"></i>
                <select name="role-signup" id="" class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg bg-white/10 text-gray-600 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    <option value="etudiant">Etudiant</option>
                    <option value="enseignant">Enseignant</option>
                </select>
            </div>

            <button type="button" id="submitBtn" name="signup"
                    class="w-full py-2 bg-blue-400 hover:bg-black text-white font-semibold rounded-lg transition duration-200 hover:bg-white hover:border hover:border-blue-400 hover:text-blue-400 hover:text-black">
                Register
            </button>
        </form>

        <p class="text-center text-gray-600 mt-4">
            Already have an account?
            <a href="/Youdemy-mvc/home/login" class="text-black hover:underline text-black">Login</a>
        </p>
    </div>
</section>
<script>
    document.getElementById('submitBtn').addEventListener('click', function () {
        const username = document.getElementById('username').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        // Regex patterns
        const usernameRegex = /^[a-z A-Z]{3,20}$/;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const passwordRegex = /^[a-zA-Z0-9]{3,20}$/;

        if (!usernameRegex.test(username)) {
            Swal.fire('Invalid Username', 'Username must be 3-20 characters and can include letters', 'error');
            return;
        }

        if (!emailRegex.test(email)) {
            Swal.fire('Invalid Email', 'Please enter a valid email address.', 'error');
            return;
        }

        if (!passwordRegex.test(password)) {
            Swal.fire('Invalid Password', 'Password must be at least 8 characters long and include a letter, number', 'error');
            return;
        }

        // Success
        Swal.fire({
            title: 'Registration Successful',
            text: 'Your registration details are valid.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            document.getElementById('registerForm').submit();
        });
    });
</script>

<?php
require_once __DIR__ ."/include/footer.php";
?>
</body>
</html>