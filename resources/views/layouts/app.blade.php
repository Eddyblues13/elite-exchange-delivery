<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Elite Exchange Delivery - Global Logistics & Shipping')</title>
    <script src="https://cdn.tailwindcss.com/"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        :root {
            --bg-dark-primary: #111827;
            --bg-dark-secondary: #1F2937;
            --accent-primary: #4F46E5;
            --accent-secondary: #6366F1;
            --text-primary: #F3F4F6;
            --text-secondary: #9CA3AF;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark-primary);
            color: var(--text-primary);
        }

        .card {
            background-color: var(--bg-dark-secondary);
            border: 1px solid #374151;
        }

        .desktop-nav {
            transition: width 0.3s ease;
        }

        .desktop-nav .nav-text {
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .desktop-nav:hover .nav-text {
            opacity: 1;
        }

        .fab-menu-button {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
        }

        .fab-menu-button.active {
            transform: rotate(45deg);
        }

        .fab-menu-items {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
            transform-origin: bottom center;
        }

        .fab-menu-item {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .page-header-bg {
            position: relative;
            background-size: cover;
            background-position: center;
        }

        .page-header-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(17, 24, 39, 1), rgba(17, 24, 39, 0.6));
            z-index: 1;
        }

        .page-header-content {
            position: relative;
            z-index: 2;
        }

        .hero-bg {
            position: relative;
            background-size: cover;
            background-position: center;
        }

        .hero-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background-color: rgba(17, 24, 39, 0.7);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .form-input {
            background-color: #374151;
            border: 1px solid #4B5563;
            color: var(--text-primary);
        }

        .form-input:focus {
            background-color: var(--bg-dark-secondary);
            border-color: var(--accent-secondary);
            ring: 0;
            outline: none;
        }
    </style>
    @stack('styles')
</head>

<body>

    <!-- Preloader -->
    <div id="preloader"
        class="fixed inset-0 bg-gray-900 z-50 flex justify-center items-center transition-opacity duration-500">
        <div class="flex flex-col items-center">
            <svg class="h-16 w-16 text-indigo-400" viewBox="0 0 24 24" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5-10-5-10 5z" />
            </svg>
            <p class="mt-4 text-lg font-semibold text-gray-300">Elite Exchange Delivery</p>
        </div>
    </div>

    <div class="flex">
        <!-- Desktop Sidebar Navigation -->
        <nav
            class="desktop-nav hidden md:block fixed left-0 top-0 h-full bg-gray-800 shadow-lg w-20 hover:w-56 z-30 group">
            <ul class="flex flex-col h-full py-4 space-y-2">
                <li class="px-5 py-3 mb-4">
                    <a href="{{ route('homepage') }}" class="flex items-center space-x-2">
                        <svg class="h-10 w-10 text-indigo-400 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5-10-5-10 5z" />
                        </svg>
                        <span class="nav-text text-xl font-extrabold text-white whitespace-nowrap">Elite Exchange
                            Delivery</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('homepage') }}"
                        class="flex items-center py-3 px-6 {{ request()->routeIs('homepage') ? 'text-indigo-400 bg-gray-900' : 'text-gray-300 hover:bg-indigo-600 hover:text-white' }} rounded-r-full transition-colors duration-200">
                        <i data-feather="home" class="h-6 w-6 flex-shrink-0"></i>
                        <span class="nav-text ml-4 font-semibold whitespace-nowrap">Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('services') }}"
                        class="flex items-center py-3 px-6 {{ request()->routeIs('services') ? 'text-indigo-400 bg-gray-900' : 'text-gray-300 hover:bg-indigo-600 hover:text-white' }} rounded-r-full transition-colors duration-200">
                        <i data-feather="grid" class="h-6 w-6 flex-shrink-0"></i>
                        <span class="nav-text ml-4 font-semibold whitespace-nowrap">Services</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('about') }}"
                        class="flex items-center py-3 px-6 {{ request()->routeIs('about') ? 'text-indigo-400 bg-gray-900' : 'text-gray-300 hover:bg-indigo-600 hover:text-white' }} rounded-r-full transition-colors duration-200">
                        <i data-feather="info" class="h-6 w-6 flex-shrink-0"></i>
                        <span class="nav-text ml-4 font-semibold whitespace-nowrap">About</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}"
                        class="flex items-center py-3 px-6 {{ request()->routeIs('contact') ? 'text-indigo-400 bg-gray-900' : 'text-gray-300 hover:bg-indigo-600 hover:text-white' }} rounded-r-full transition-colors duration-200">
                        <i data-feather="phone" class="h-6 w-6 flex-shrink-0"></i>
                        <span class="nav-text ml-4 font-semibold whitespace-nowrap">Contact</span>
                    </a>
                </li>
                <li class="mt-auto">
                    <a href="{{ route('track') }}"
                        class="flex items-center py-3 px-6 {{ request()->routeIs('track') ? 'text-indigo-400 bg-gray-900' : 'text-gray-300 hover:bg-indigo-600 hover:text-white' }} rounded-r-full transition-colors duration-200">
                        <i data-feather="compass" class="h-6 w-6 flex-shrink-0"></i>
                        <span class="nav-text ml-4 font-semibold whitespace-nowrap">Track Shipment</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div id="app-content" class="opacity-0 transition-opacity duration-500 w-full md:pl-20">
            <!-- Mobile Header -->
            <header class="md:hidden bg-gray-800/80 backdrop-blur-sm sticky top-0 z-10">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center py-4">
                        <div class="flex items-center space-x-2">
                            <svg class="h-8 w-8 text-indigo-400" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5-10-5-10 5z" />
                            </svg>
                            <span class="text-xl font-extrabold text-white">Elite Exchange Delivery</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Floating Action Button Menu -->
    <div class="fixed md:hidden bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md px-4 pb-4 z-20">
        <div class="relative flex items-center justify-center">
            <!-- Menu Items -->
            <div id="fab-menu-items"
                class="fab-menu-items absolute bottom-0 flex justify-center items-end gap-4 mb-20 opacity-0 transform scale-90 pointer-events-none">
                <a href="{{ route('homepage') }}"
                    class="fab-menu-item flex flex-col items-center text-text-secondary hover:text-white transition-all transform hover:-translate-y-1"
                    style="transition-delay: 0.2s">
                    <div class="bg-white rounded-full p-3 shadow-lg"><i data-feather="home"
                            class="h-6 w-6 text-indigo-600"></i></div>
                    <span class="text-xs font-semibold mt-1">Home</span>
                </a>
                <a href="{{ route('services') }}"
                    class="fab-menu-item flex flex-col items-center text-text-secondary hover:text-white transition-all transform hover:-translate-y-1"
                    style="transition-delay: 0.1s">
                    <div class="bg-white rounded-full p-3 shadow-lg"><i data-feather="grid"
                            class="h-6 w-6 text-indigo-600"></i></div>
                    <span class="text-xs font-semibold mt-1">Services</span>
                </a>
                <a href="{{ route('about') }}"
                    class="fab-menu-item flex flex-col items-center text-text-secondary hover:text-white transition-all transform hover:-translate-y-1"
                    style="transition-delay: 0.1s">
                    <div class="bg-white rounded-full p-3 shadow-lg"><i data-feather="info"
                            class="h-6 w-6 text-indigo-600"></i></div>
                    <span class="text-xs font-semibold mt-1">About</span>
                </a>
                <a href="{{ route('contact') }}"
                    class="fab-menu-item flex flex-col items-center text-text-secondary hover:text-white transition-all transform hover:-translate-y-1"
                    style="transition-delay: 0.2s">
                    <div class="bg-white rounded-full p-3 shadow-lg"><i data-feather="phone"
                            class="h-6 w-6 text-indigo-600"></i></div>
                    <span class="text-xs font-semibold mt-1">Contact</span>
                </a>
            </div>
            <!-- Main Button -->
            <button id="fab-menu-button"
                class="fab-menu-button relative bg-indigo-600 text-white rounded-full h-16 w-16 flex items-center justify-center shadow-xl hover:shadow-2xl hover:shadow-indigo-500/50 hover:bg-indigo-700">
                <i data-feather="plus" class="h-8 w-8 transition-transform duration-300"></i>
            </button>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 border-t border-gray-700">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h4 class="font-bold text-white mb-4">Elite Exchange Delivery</h4>
                    <p class="text-sm text-text-secondary">Your trusted partner in global logistics. Delivering
                        excellence, one shipment at a time.</p>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('about') }}" class="text-text-secondary hover:text-white">About Us</a>
                        </li>
                        <li><a href="{{ route('services') }}" class="text-text-secondary hover:text-white">Services</a>
                        </li>
                        <li><a href="{{ route('track') }}" class="text-text-secondary hover:text-white">Track
                                Shipment</a></li>
                        <li><a href="{{ route('contact') }}" class="text-text-secondary hover:text-white">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-sm text-text-secondary">
                        <li class="flex items-start"><i data-feather="map-pin" class="h-4 w-4 mr-2 mt-1"></i><span>123
                                Logic Drive, </span></li>
                        <li class="flex items-center"><i data-feather="phone" class="h-4 w-4 mr-2"></i><span>+234 800
                                123 4567</span></li>
                        <li class="flex items-center"><i data-feather="mail"
                                class="h-4 w-4 mr-2"></i><span>contact@elite-exchange-delivery.com</span></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-text-secondary hover:text-white"><i data-feather="twitter"></i></a>
                        <a href="#" class="text-text-secondary hover:text-white"><i data-feather="facebook"></i></a>
                        <a href="#" class="text-text-secondary hover:text-white"><i data-feather="linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-sm text-text-secondary">
                <p>&copy; 2025 Elite Exchange Delivery. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // --- Feather Icons ---
        feather.replace();

        // --- PRELOADER SCRIPT ---
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            const content = document.getElementById('app-content');
            setTimeout(() => {
                preloader.style.opacity = '0';
                content.style.opacity = '1';
                setTimeout(() => preloader.style.display = 'none', 500);
            }, 500); 
        });

        // --- FLOATING MENU SCRIPT ---
        const fabButton = document.getElementById('fab-menu-button');
        const fabMenuItemsContainer = document.getElementById('fab-menu-items');
        if (fabButton) {
            fabButton.addEventListener('click', () => {
                const isActive = fabButton.classList.toggle('active');
                if (isActive) {
                    fabMenuItemsContainer.classList.remove('opacity-0', 'scale-90', 'pointer-events-none');
                } else {
                    fabMenuItemsContainer.classList.add('opacity-0', 'scale-90');
                     setTimeout(() => {
                        fabMenuItemsContainer.classList.add('pointer-events-none');
                    }, 300);
                }
            });
        }
    </script>
    @stack('scripts')
</body>

</html>