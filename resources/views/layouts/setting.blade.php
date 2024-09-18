<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        aside {
            transition: transform 0.3s ease;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        .sidebar-active {
            transform: translateX(0);
        }
        .sidebar-inactive {
            transform: translateX(-100%);
        }
        @media(min-width: 1024px) {
            .sidebar-inactive {
                transform: translateX(0);
            }
            .sidebar-active {
                display: none;
            }
            .overlay {
                display: none;
            }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-background text-foreground">
    <header class="flex flex-row items-center space-x-4 mt-2">
        <div class="ml-5">
            <a href="{{ route('home') }}">
                @if(Auth::check() && Auth::user()->invshop && Auth::user()->invshop->S_logo)
                    <img src="{{ asset('storage/' . Auth::user()->invshop->S_logo) }}" alt="Shop Logo" class="h-10 w-12 rounded">
                @else
                    <img src="{{ asset('images/official_logo.png') }}" alt="Default Logo" class="h-10 w-12 rounded">
                @endif
            </a>
        </div>
        <div class="bg-primary p-3 shadow-md flex items-end justify-end flex-1">
            <h1 class="text-sm font-bold text-primary-foreground">{{ Auth::user()->U_name }}</h1>
        </div>
        <div class="relative">
            @include('profile.profile')
        </div>
        @include('popups.edit-profile-popup')
    </header>
    <div class="flex flex-col items-center py-6">
        <div class="flex space-x-2 -mt-4">
            <a href="{{ route('setting') }}" class="bg-primary text-white rounded-lg px-4 py-2 text-sm font-bold">
                SETTING
            </a>
        </div>
        <hr class="w-10 h-1 bg-gray-500 mt-2 rounded-sm">
    </div>
    <div class="flex flex-1 h-screen overflow-hidden">
        <div class="relative z-9">
            <button class="lg:hidden p-4 text-primary" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <!-- <div class="fixed inset-0 bg-black bg-opacity-50 hidden lg:hidden z-50" id="menu-overlay"></div> -->
            <aside class="text-gray-500 w-64 h-auto bg-gray-200 z-20 lg:z-0 lg:block sidebar-inactive p-4 lg:p-4" id="sidebar">
                <nav class="flex flex-col py-4 text-sm">
                    <!-- General Settings -->
                    <div class="mb-2">
                        <p class="font-semibold mb-2 flex items-center cursor-pointer px-4 py-2 hover:bg-bsicolor hover:text-white rounded-lg" data-toggle="general-settings">
                            <i class="fas fa-cogs mr-2"></i> GENERAL SETTING
                            <i class="fas fa-chevron-down ml-auto" id="icon-general-settings"></i>
                        </p>
                        <div id="general-settings" class="submenu hidden pl-4">
                            <a href="/uom" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('uom') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-ruler-combined mr-2"></i> UNIT OF MEASURE
                            </a>
                            <a href="/currency" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('currency') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-money-bill-alt mr-2"></i> CURRENCY
                            </a>
                            <a href="/size" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('size') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-ruler mr-2"></i> SIZE
                            </a>
                            <a href="/payment" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('payment') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-credit-card mr-2"></i> PAYMENT METHOD
                            </a>
                        </div>
                    </div>
                    <!-- Company Info -->
                    <div class="mb-2">
                        <p class="font-semibold mb-2 flex items-center cursor-pointer px-4 py-2 hover:bg-bsicolor hover:text-white rounded-lg" data-toggle="company-info">
                            <i class="fas fa-building mr-2"></i> COMPANY INFO
                            <i class="fas fa-chevron-down ml-auto" id="icon-company-info"></i>
                        </p>
                        <div id="company-info" class="submenu hidden pl-4">
                            <a href="/owner" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('owner') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-user-tie mr-2"></i> OWNER
                            </a>
                            <a href="#" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('employee') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-users mr-2"></i> EMPLOYEE
                            </a>
                            <a href="/shop" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('shop') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-store mr-2"></i> SHOP
                            </a>
                            <a href="#" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('location') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-map-marker-alt mr-2"></i> LOCATION
                            </a>
                            <a href="/user" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('user') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-user mr-2"></i> USER
                            </a>
                            <a href="/role" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('role') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-user-shield mr-2"></i> ROLE
                            </a>
                        </div>
                    </div>
                    <!-- Menu Info -->
                    <div class="mb-2">
                        <p class="font-semibold mb-2 flex items-center cursor-pointer px-4 py-2 hover:bg-bsicolor hover:text-white rounded-lg" data-toggle="menu-info">
                            <i class="fas fa-utensils mr-2"></i> MENU INFO
                            <i class="fas fa-chevron-down ml-auto" id="icon-menu-info"></i>
                        </p>
                        <div id="menu-info" class="submenu hidden pl-4">
                            <a href="/menu_group" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('menu_group') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-cube mr-2"></i> GROUP
                            </a>
                            <a href="/menu_category" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('menu_category') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-tags mr-2"></i> CATEGORY
                            </a>
                            <a href="/ingredient" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('ingredient') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-lemon mr-2"></i> INGREDIENT
                            </a>
                            <a href="/add-on" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('add-ons') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-plus-circle mr-2"></i> ADD-ONS
                            </a>
                            <a href="#" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('import_create_menu') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-file-import mr-2"></i> IMPORT / CREATE
                            </a>
                        </div>
                    </div>
                    <!-- Material Info -->
                    <div class="mb-2">
                        <p class="font-semibold mb-2 flex items-center cursor-pointer px-4 py-2 hover:bg-bsicolor hover:text-white rounded-lg" data-toggle="material-info">
                            <i class="fas fa-box mr-2"></i> MATERIAL INFO
                            <i class="fas fa-chevron-down ml-auto" id="icon-material-info"></i>
                        </p>
                        <div id="material-info" class="submenu hidden pl-4">
                            <a href="/material_group" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('material_group') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-cube mr-2"></i> GROUP
                            </a>
                            <a href="/material_category" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('material_category') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-tags mr-2"></i> CATEGORY
                            </a>
                            <a href="#" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('expiry_date') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-calendar-alt mr-2"></i> EXPIRY DATE
                            </a>
                            <a href="#" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('import_create_material') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-file-import mr-2"></i> IMPORT / CREATE
                            </a>
                        </div>
                    </div>
                    <!-- Expense Info -->
                    <div class="mb-2">
                        <p class="font-semibold mb-2 flex items-center cursor-pointer px-4 py-2 hover:bg-bsicolor hover:text-white rounded-lg" data-toggle="expense-info">
                            <i class="fas fa-file-invoice-dollar mr-2"></i> EXPENSE INFO
                            <i class="fas fa-chevron-down ml-auto" id="icon-expense-info"></i>
                        </p>
                        <div id="expense-info" class="submenu hidden pl-4">
                            <a href="/expense_category" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('expense_category') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-tags mr-2"></i> CATEGORY
                            </a>
                        </div>
                    </div>
                    <!-- Module Info -->
                    <div class="mb-2">
                        <p class="font-semibold mb-2 flex items-center cursor-pointer px-4 py-2 hover:bg-bsicolor hover:text-white rounded-lg" data-toggle="module-info">
                            <i class="fas fa-cogs mr-2"></i> MODULE INFO
                            <i class="fas fa-chevron-down ml-auto" id="icon-module-info"></i>
                        </p>
                        <div id="module-info" class="submenu hidden pl-4">
                            <a href="/system_module" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('module') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-cogs mr-2"></i> SYSTEM MODULE
                            </a>
                            <a href="/authentication" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('authentication') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-lock mr-2"></i> AUTHENTICATION
                            </a>
                        </div>
                    </div>
                    <!-- System Logs -->
                    <div class="mb-2">
                        <p class="font-semibold mb-2 flex items-center cursor-pointer px-4 py-2 hover:bg-bsicolor hover:text-white rounded-lg" data-toggle="system-logs">
                            <i class="fas fa-file-alt mr-2"></i> SYSTEM LOGS
                            <i class="fas fa-chevron-down ml-auto" id="icon-system-logs"></i>
                        </p>
                        <div id="system-logs" class="submenu hidden pl-4">
                            <a href="/login_logs" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg {{ request()->routeIs('login_logs') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-sign-in-alt mr-2"></i> LOGIN LOGS
                            </a>
                            <a href="/operation_logs" class="nav-link flex items-center py-2 px-4 hover:bg-bsicolor hover:text-white rounded-lg my-1 {{ request()->routeIs('operation_logs') ? 'bg-bsicolor text-white' : '' }}">
                                <i class="fas fa-clipboard-list mr-2"></i> OPERATION LOGS
                            </a>
                        </div>
                    </div>
                </nav>
            </aside>
        </div>
            <!-- Overlay -->
        <div class="overlay" id="overlay"></div>
        <main class="flex-1 px-6 lg:ml-64 overflow-x-auto">
            @yield('content')
        </main>
    </div>
    @include('layouts.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const icons = {
                generalSettings: document.getElementById('icon-general-settings'),
                companyInfo: document.getElementById('icon-company-info'),
                menuInfo: document.getElementById('icon-menu-info'),
                materialInfo: document.getElementById('icon-material-info'),
                expenseInfo: document.getElementById('icon-expense-info'),
                moduleInfo: document.getElementById('icon-module-info'),
                systemLog: document.getElementById('icon-system-logs')
            };
    
            menuToggle.addEventListener('click', function () {
                sidebar.classList.toggle('sidebar-active');
                sidebar.classList.toggle('sidebar-inactive');
                // overlay.style.display = sidebar.classList.contains('sidebar-active') ? 'block' : 'none';
            });
    
            overlay.addEventListener('click', function () {
                sidebar.classList.add('sidebar-inactive');
                sidebar.classList.remove('sidebar-active');
                overlay.style.display = 'none';
                closeAllSubmenus();
            });
    
            function toggleSection(sectionId) {
                const section = document.getElementById(sectionId);
                const icon = icons[sectionId.replace('-', '')];
                
                if (section.classList.contains('hidden')) {
                    closeAllSubmenus();
                    section.classList.remove('hidden');
                    if (icon) {
                        icon.classList.remove('fa-chevron-down');
                        icon.classList.add('fa-chevron-up');
                    }
                } else {
                    section.classList.add('hidden');
                    if (icon) {
                        icon.classList.remove('fa-chevron-up');
                        icon.classList.add('fa-chevron-down');
                    }
                }
            }
    
            function closeAllSubmenus() {
                document.querySelectorAll('.submenu').forEach(function (submenu) {
                    submenu.classList.add('hidden');
                });
                document.querySelectorAll('[id^="icon-"]').forEach(function (icon) {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                });
            }
    
            // Add event listeners to toggle sections
            document.querySelectorAll('[data-toggle]').forEach(function (toggleButton) {
                toggleButton.addEventListener('click', function () {
                    const sectionId = this.getAttribute('data-toggle');
                    toggleSection(sectionId);
                });
            });
        });
    </script>
</body>
</html>
