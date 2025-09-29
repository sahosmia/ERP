<header class="bg-white shadow-sm flex items-center justify-between px-6 py-3">

    {{-- Sidebar Toggle Button --}}
    <button id="sidebar-toggle" class="text-gray-500 hover:text-gray-700 focus:outline-none">
        <i class="fas fa-bars fa-lg"></i>
    </button>

    {{-- User Profile Dropdown --}}
    <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center text-gray-700 focus:outline-none">
            <span class="mr-2">Admin</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        {{-- Dropdown Menu --}}
        <div x-show="open" @click.away="open = false"
            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
            <div class="border-t border-gray-100"></div>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
        </div>
    </div>

</header>
