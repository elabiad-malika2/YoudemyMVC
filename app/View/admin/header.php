<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style >
 
        input[type="search"]::-webkit-search-cancel-button
        {
        -webkit-appearance:none;
        }
        td {
            border-bottom-width: 1px ;
            border-collapse: collapse;
            

        }
       
    </style>
    <script>
        tailwind.config = {
            theme: {
            extend: {
                colors: {
                primary: '#003366',
                borderColor: '#5f5d5d',
                bgcolor: '#F3F3F3',
                },
                fontFamily: {
                // primary: ['Consolas', 'monospace'],
                primary: ['Playfair Display', 'serif'],
                // primary: ['EB Garamond', 'serif'],
                secondary: ['Pattaya', 'sans-serif'],
                },
            },
            },
        };
        </script>
</head>

<body >

<div class="flex min-h-screen h-full ">
    <aside class="w-52 border-r min-h-full  flex flex-col items-center gap-16 ">
        <div class="mt-16">
            <img class="w-32" src="/youdemy-mvc/public/assets/images/logo-youdemy.png" alt="logo">
        </div>
        <div class="">
                <div class="grid gap-4 w-[100%]">
                    <a href="/Youdemy-mvc/admin" class="flex gap-4 px-4 py-2 rounded-2xl">
                        <img src="/youdemy-mvc/public/img/home.svg" alt="aa">
                        Dashboard
                    </a>
                    <!-- Cars Link -->
                    <div class="relative">
                        <button class="flex gap-4 px-4 py-2 rounded-2xl w-full">
                            <img src='/youdemy-mvc/public/img/briefcase.svg' alt=''> Cours
                        </button>
                        <!-- Dropdown Options for Cars -->
                        <div id="carsDropdown" class="hidden absolute left-0 mt-2 bg-white shadow-lg rounded-xl w-full">
                            <a href="/Youdemy-mvc/admin/categories" class="flex gap-4 px-4 py-2 rounded-2xl hover:bg-gray-100">
                                <img src='/youdemy-mvc/public/img/category.svg' alt=''> Categories
                            </a>
                            <a href="/Youdemy-mvc/admin/cours" class="flex gap-4 px-4 py-2 rounded-2xl hover:bg-gray-100">
                                <img src='/youdemy-mvc/public/img/car.svg' alt=''> Cours
                            </a>
                        </div>
                    </div>
                    <a href='/Youdemy-mvc/admin/users' class='flex gap-4 px-4 py-2 rounded-2xl'>
                        <img id='btn-icon' class='mt-1' src='/youdemy-mvc/public/img/3 User.svg' alt=''> Users
                    </a>
                    <a href='/Youdemy-mvc/admin/tags' class='flex gap-4 px-4 py-2 rounded-2xl'>
                        <img id='btn-icon' class='mt-1' src='/youdemy-mvc/public/img/3 User.svg' alt=''> Tags
                    </a>
            </div>
        </div>
            <script>
        const carsButton = document.querySelector('button');
        const carsDropdown = document.getElementById('carsDropdown');

        carsButton.addEventListener('click', () => {
            carsDropdown.classList.toggle('hidden');
        });

        window.addEventListener('click', (e) => {
            if (!e.target.closest('div.relative')) {
                carsDropdown.classList.add('hidden');
            }
        });
    </script>
    </aside>
    <div class="grow">
        <header class=" h-20 border-b">
            <nav class=" h-full flex justify-between mx-8 items-center">
                <div class="flex gap-2">
                    <img src="/youdemy-mvc/public/img/Search.svg" alt="">
                    <input class="search outline-none border-none w-64 px-4 py-2 rounded-2xl" type="search" name="search-input" id="search-input" placeholder="Search anything here">
                </div>
                <div class="flex w-72 justify-between  items-center ">
                    <img class="cursor-pointer" src="/youdemy-mvc/public/img/settings.svg" alt="">
                    <img class="cursor-pointer" src="/youdemy-mvc/public/img/Icon.svg" alt="">
                    
                        <a href="/Youdemy-mvc/auth/logout"><img src="/youdemy-mvc/public/img/logout.png" class="h-4 w-4" alt="logout"></a>
                   
                    <div class="flex items-center gap-2 cursor-pointer">
                        <div class=" cursor-pointer w-10 h-10 bg-black bg-cover rounded-full text-white relative ">
                        <div class="bg-[#228B22] h-3 w-3 rounded-full absolute bottom-0 right-0  "></div>
                        </div>
                       <p class="text-[#606060] font-bold">Hamza </p>
                    </div>
                   
                </div>
    
            </nav>
        </header>
