@php
$navItems = [
    ['route' => 'inventory', 'label' => 'INVENTORY', 'roles' => [1, 2, 3]],
    ['route' => 'supplier', 'label' => 'SUPPLIER', 'roles' => [1, 2, 3]],
    ['route' => 'material', 'label' => 'MATERIAL', 'roles' => [1, 2, 3]],
    ['route' => 'order', 'label' => 'ORDER', 'roles' => [1, 2, 3]],
    ['route' => 'pos', 'label' => 'POS', 'roles' => [1, 2, 4]],
    ['route' => 'menu', 'label' => 'MENU', 'roles' => [1, 2, 4]],
    ['route' => 'add-on', 'label' => 'ADD-ON', 'roles' => [1, 2, 4]],
    ['route' => 'expense', 'label' => 'EXPENSE', 'roles' => [1, 2]],
    ['route' => 'report', 'label' => 'REPORT', 'roles' => [1, 2]],
    ['route' => 'profit_lose', 'label' => 'PROFIT / LOSE', 'roles' => [1, 2]],
];
@endphp
@vite('resources/css/app.css')
{{-- <link rel="icon" href="{{ asset('storage/' . Auth::user()->invshop->S_logo) }}" type="image/x-icon"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="min-h-screen flex flex-col bg-background text-foreground">
    <header class="flex flex-row items-center space-x-4 mt-2 relative">
        <div class="ml-5">
            <div class="ml-0">
                @if(Auth::check() && Auth::user()->invshop && Auth::user()->invshop->S_logo)
                    <a href="/home">
                        <img src="{{ asset('storage/' . Auth::user()->invshop->S_logo) }}" alt="Shop Logo" class="h-10 w-12 rounded">
                    </a>
                @else
                    <a href="/home">
                        <img src="{{ asset('images/official_logo.png') }}" alt="Default Logo" class="h-10 w-12 rounded">
                    </a>
                @endif
            </div>            
        </div>
    
        <div class="bg-primary p-3 shadow-md flex items-end justify-end flex-1">
            <div class="space-x-2 items-end justify-end">
                <h1 class="text-sm font-bold text-primary-foreground">{{ Auth::user()->sys_name }}</h1>
            </div>
        </div>
    
        <div class="relative">
            @include('profile.profile')
        </div>
        @include('popups.edit-profile-popup')
    
        <!-- Success and error messages inside the navbar -->
        @if (session('success'))
            <div id="success-message" class="absolute inset-0 flex justify-center items-center">
                <div class="py-2 px-4 bg-green-500 text-white rounded-lg">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session('error'))
            <div id="error-message" class="absolute inset-0 flex justify-center items-center">
                <div class="py-2 px-4 bg-red-500 text-white rounded-lg">
                    {{ session('error') }}
                </div>
            </div>
        @endif
    </header>

    <div class="flex flex-col items-center py-6 -mt-4 flex-grow">
        <!-- Hamburger Icon for Small Screens -->
        <button id="menuToggleButton" class="block md:hidden mb-1" onclick="toggleMenu()">
            <i id="menuToggleIcon" class="fas fa-bars text-1xl bg-bsicolor py-1 px-2"></i>
        </button> 

        <div class="w-full flex flex-col items-center">
            @if(request()->is('home'))
            @else
                <div id="navMenu" class="flex flex-wrap justify-center space-x-2 hidden md:flex">
                    @foreach($navItems as $item)
                        @if(in_array(Auth::user()->InvRole->R_id, $item['roles']))
                            <a href="{{ $item['route'] }}" class="{{ request()->is($item['route']) ? 'bg-primary text-white text-' : 'bg-bsicolor text-white' }} rounded-lg px-4 py-2 text-sm mb-2 font-bold">
                                {{ $item['label'] }}
                            </a>
                        @endif
                    @endforeach
                </div>
                <div id="menuLine" class="h-1 bg-gray-500 rounded-sm"></div>
            @endif
        </div>
    </div>

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('layouts.footer')
</div>

<script>
    function toggleMenu() {
        var navMenu = document.getElementById('navMenu');
        var menuToggleIcon = document.getElementById('menuToggleIcon');
        var menuLine = document.getElementById('menuLine');
        
        navMenu.classList.toggle('hidden');
        
        if (navMenu.classList.contains('hidden')) {
            menuToggleIcon.classList.remove('fa-times');
            menuToggleIcon.classList.add('fa-bars');
        } else {
            menuToggleIcon.classList.remove('fa-bars');
            menuToggleIcon.classList.add('fa-times');
        }
        setMenuLineWidth();
    }

    function setMenuLineWidth() {
        var navMenu = document.getElementById('navMenu');
        var menuLine = document.getElementById('menuLine');

        if (window.innerWidth < 768 && navMenu.classList.contains('hidden')) {
            var menuToggleButton = document.getElementById('menuToggleButton');
            menuLine.style.width = menuToggleButton.offsetWidth + 'px';
        } else {
            menuLine.style.width = navMenu.offsetWidth + 'px';
        }
    }

    window.onload = function() {
        setMenuLineWidth();
    }

    window.onresize = function() {
        setMenuLineWidth();
    }
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');

        if (successMessage) {
            setTimeout(() => {
                successMessage.style.opacity = '0';
                setTimeout(() => successMessage.remove(), 500); // Remove after fade-out
            }, 5000); // 5 seconds
        }

        if (errorMessage) {
            setTimeout(() => {
                errorMessage.style.opacity = '0';
                setTimeout(() => errorMessage.remove(), 500); // Remove after fade-out
            }, 5000); // 5 seconds
        }
    });
</script>
