<?php 
    $title = $title ?? 'Task Collaboration App';
    $currentPage = $currentPage ?? '';


    use App\Utils\Auth;
    use App\Utils\Session;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $title ?> </title>
</head>

<body>


    <?php 
    /*

    <nav
        class="relative bg-blue-500 after:pointer-events-none after:absolute after:inset-x-0 after:bottom-0 after:h-px after:bg-white/10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">


                    <a href="/" class="text-white font-bold text-xl">TaskCollab</a>


                      <div class="hidden md:block flex-1">
                        <div class="ml-10 flex justify-between w-full"> 
                           
                            <div>
                                 <a href="/"
                                    class="px-3 py-2 rounded-md text-sm font-medium <?= $currentPage === 'home' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?>">
                                    Home
                                </a>

                                <?php if(Auth::check() && Auth::user()->getRole() === 'owner') : ?>

                                <a href="/projects"
                                    class="px-3 py-2 rounded-md text-sm font-medium <?= $currentPage === 'projects' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?>">
                                    Projects
                                </a>
                            
                            <?php endif; ?>

                                <a href="/tasks"
                                    class="px-3 py-2 rounded-md text-sm font-medium <?= $currentPage === 'tasks' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?>">
                                    Tasks
                                </a>
                            </div>

                            <div>

                                <?php if (Auth::check()) :  ?>

                            <a href="/logout"
                                class="px-3 py-2 border rounded-lg  text-sm font-medium <?= $currentPage === 'logout' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?>">
                                Logout
                            </a>

                           
                           
                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium">   
                            <?= Auth::user()->getFullname() ?>     
                            </a>
                            
                            <?php  else : ?>

                            <a href="/login"
                                class="px-3 py-2 rounded-md text-sm font-medium <?= $currentPage === 'login' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?>">Login</a>
                           
                            <a href="/register"
                                class="px-3 py-2 rounded-md text-sm font-medium <?= $currentPage === 'register' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?>">Register</a>

                             <?php  endif ?>
                                    
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </nav>
    */
    ?>


    <!--Main Navigation-->
<header>
  <!-- Main navigation container -->
  <nav
    class="flex-no-wrap relative flex w-full items-center justify-between bg-neutral-100 py-2 shadow-md shadow-black/5 dark:bg-neutral-600 dark:shadow-black/10 lg:flex-wrap lg:justify-start lg:py-4"
    data-twe-navbar-ref>
    <div class="flex w-full flex-wrap items-center justify-between px-3">
      <!-- Hamburger button for mobile view -->
      <button
        class="block border-0 bg-transparent px-2 text-neutral-500 hover:no-underline hover:shadow-none focus:no-underline focus:shadow-none focus:outline-none focus:ring-0 dark:text-neutral-200 lg:hidden"
        type="button"
        data-twe-collapse-init
        data-twe-target="#navbarSupportedContent1"
        aria-controls="navbarSupportedContent1"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <!-- Hamburger icon -->
        <span class="[&>svg]:w-7">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="h-7 w-7">
            <path
              fill-rule="evenodd"
              d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
              clip-rule="evenodd" />
          </svg>
        </span>
      </button>

      <!-- Collapsible navigation container -->
      <div
        class="!visible hidden flex-grow basis-[100%] items-center lg:!flex lg:basis-auto"
        id="navbarSupportedContent1"
        data-twe-collapse-item>
        <!-- Logo -->
        <a
          class="mb-4 me-2 mt-3 flex items-center text-neutral-900 hover:text-neutral-900 focus:text-neutral-900 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400 lg:mb-0 lg:mt-0"
          href="#">
          <img
            src="https://tecdn.b-cdn.net/img/logo/te-transparent-noshadows.webp"
            style="height: 15px"
            alt=""
            loading="lazy" />
        </a>
        <!-- Left navigation links -->
        <ul
          class="list-style-none me-auto flex flex-col ps-0 lg:flex-row"
          data-twe-navbar-nav-ref>
          <li class="mb-4 lg:mb-0 lg:pe-2" data-twe-nav-item-ref>
            <!-- Dashboard link -->
            <a
              class="text-neutral-500 hover:text-neutral-700 focus:text-neutral-700 disabled:text-black/30 dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300 lg:px-2 [&.active]:text-black/90 dark:[&.active]:text-zinc-400"
              href="#"
              data-twe-nav-link-ref
              >Dashboard</a
            >
          </li>
          <!-- Team link -->
          <li class="mb-4 lg:mb-0 lg:pe-2" data-twe-nav-item-ref>
            <a
              class="text-neutral-500 hover:text-neutral-700 focus:text-neutral-700 disabled:text-black/30 dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300 lg:px-2 [&.active]:text-black/90 dark:[&.active]:text-neutral-400"
              href="#"
              data-twe-nav-link-ref
              >Team</a
            >
          </li>
          <!-- Projects link -->
          <li class="mb-4 lg:mb-0 lg:pe-2" data-twe-nav-item-ref>
            <a
              class="text-neutral-500 hover:text-neutral-700 focus:text-neutral-700 disabled:text-black/30 dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300 lg:px-2 [&.active]:text-black/90 dark:[&.active]:text-neutral-400"
              href="#"
              data-twe-nav-link-ref
              >Projects</a
            >
          </li>
        </ul>
      </div>

      <!-- Right elements -->
      <div class="relative flex items-center">
        <!-- Cart Icon -->
        <a
          class="me-4 text-neutral-500 hover:text-neutral-700 focus:text-neutral-700 disabled:text-black/30 dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300 [&.active]:text-black/90 dark:[&.active]:text-neutral-400"
          href="#">
          <span class="[&>svg]:w-5">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              fill="currentColor"
              class="h-5 w-5">
              <path
                d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
            </svg>
          </span>
        </a>

        <!-- Container with two dropdown menus -->
        <div class="relative" data-twe-dropdown-ref>
          <!-- First dropdown trigger -->
          <a
            class="hidden-arrow me-4 flex items-center text-neutral-500 hover:text-neutral-700 focus:text-neutral-700 disabled:text-black/30 dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300 [&.active]:text-black/90 dark:[&.active]:text-neutral-400"
            href="#"
            id="dropdownMenuButton1"
            role="button"
            data-twe-dropdown-toggle-ref
            aria-expanded="false">
            <!-- Dropdown trigger icon -->
            <span class="[&>svg]:w-5">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="h-5 w-5">
                <path
                  fill-rule="evenodd"
                  d="M5.25 9a6.75 6.75 0 0113.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 01-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 11-7.48 0 24.585 24.585 0 01-4.831-1.244.75.75 0 01-.298-1.205A8.217 8.217 0 005.25 9.75V9zm4.502 8.9a2.25 2.25 0 104.496 0 25.057 25.057 0 01-4.496 0z"
                  clip-rule="evenodd" />
              </svg>
            </span>
            <!-- Notification counter -->
            <span
              class="absolute -mt-2.5 ms-2 rounded-[0.37rem] bg-danger px-[0.45em] py-[0.2em] text-[0.6rem] leading-none text-white"
              >1</span
            >
          </a>
          <!-- First dropdown menu -->
          <ul
            class="absolute left-auto right-0 z-[1000] float-left m-0 mt-1 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg data-[twe-dropdown-show]:block dark:bg-neutral-700"
            aria-labelledby="dropdownMenuButton1"
            data-twe-dropdown-menu-ref>
            <!-- First dropdown menu items -->
            <li>
              <a
                class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30"
                href="#"
                data-twe-dropdown-item-ref
                >Action</a
              >
            </li>
            <li>
              <a
                class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30"
                href="#"
                data-twe-dropdown-item-ref
                >Another action</a
              >
            </li>
            <li>
              <a
                class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30"
                href="#"
                data-twe-dropdown-item-ref
                >Something else here</a
              >
            </li>
          </ul>
        </div>

        <!-- Second dropdown container -->
        <div class="relative" data-twe-dropdown-ref>
          <!-- Second dropdown trigger -->
          <a
            class="hidden-arrow flex items-center whitespace-nowrap transition duration-150 ease-in-out motion-reduce:transition-none"
            href="#"
            id="dropdownMenuButton2"
            role="button"
            data-twe-dropdown-toggle-ref
            aria-expanded="false">
            <!-- User avatar -->
            <img
              src="https://tecdn.b-cdn.net/img/new/avatars/2.jpg"
              class="rounded-full"
              style="height: 25px; width: 25px"
              alt=""
              loading="lazy" />
          </a>
          <!-- Second dropdown menu -->
          <ul
            class="absolute left-auto right-0 z-[1000] float-left m-0 mt-1 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg data-[twe-dropdown-show]:block dark:bg-neutral-700"
            aria-labelledby="dropdownMenuButton2"
            data-twe-dropdown-menu-ref>
            <!-- Second dropdown menu items -->
            <li>
              <a
                class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30"
                href="#"
                data-twe-dropdown-item-ref
                >Action</a
              >
            </li>
            <li>
              <a
                class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30"
                href="#"
                data-twe-dropdown-item-ref
                >Another action</a
              >
            </li>
            <li>
              <a
                class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30"
                href="#"
                data-twe-dropdown-item-ref
                >Something else here</a
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>
<!--Main Navigation-->






    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: {
                        50: '#f5f5f5ff',
                        100: '#f5f5f5ff',
                        500: '#0e9ff9ff',
                        600: '#10659bff',
                        700: '#1e6ea1ff',
                    },
                    500: '#14171A',
                },
            },
        },
    }
    </script>
    <style type="text/tailwindcss">
        .gradient-primary {
            background: linear-gradient(135deg, #1DA1F2 0%, #a9bac5ff 100%);
        }
    </style>


    <?php
        $erreurs = Session::getFlash('error');
        $success = Session::getFlash('success');
 

    if(isset($erreurs)) { ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Erreur:</strong>
        <span class="block sm:inline"> <?= $erreurs ?> </span>
        <a href="#" class="
                    float-right
                    text-red-600
                    hover:text-red-900
                    absolute
                    right-2
                    top-2
                    text-2xl">&times;</a>
    </div>
    <?php   } 
 

    if(isset($success)) {
        ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Succès:</strong>
        <span class="block sm:inline"> <?= $success ?> </span>
        <a href="#" class="
                    float-right
                    text-green-600
                    hover:text-green-900
                    absolute
                    right-2
                    top-2
                    text-2xl">&times;</a>
    </div>
    <?php     }
     ?>
    <main class="flex-1">
        <?= $content; ?>
    </main>



    <?php require_once __DIR__ . '/../components/footer.php'; ?>


</body>

</html>