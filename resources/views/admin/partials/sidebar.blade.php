<aside id="sidebar" class="w-64 bg-gray-800 text-white flex flex-col sidebar-transition min-h-screen">

    {{-- Logo / Branding --}}
    <div class="h-16 flex items-center justify-center border-b border-gray-700">
        <h1 class="text-lg font-semibold">Admin Panel</h1>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto" x-data="{ openFabric: false, openSupplier: false }">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 transition">
            <div class="w-6 h-6 mr-3">
                <i class="fa-solid fa-house"></i>
            </div>
            <span>Dashboard</span>
        </a>

        {{-- Fabrics Dropdown --}}
        <div>
            <button @click="openFabric = !openFabric"
                class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-gray-700 transition">
                <div class="flex items-center">
                    <div class="w-6 h-6 mr-3">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <span>Fabrics</span>
                </div>
                <svg :class="{'rotate-180': openFabric}" class="w-4 h-4 transition-transform duration-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="openFabric" class="ml-8 space-y-1 mt-1">
                <a href="{{ route('admin.fabrics.index') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-600 transition">All Fabrics</a>
                <a href="{{ route('admin.fabrics.create') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-600 transition">Add New Fabric</a>
                <a href="{{ route('admin.fabrics.trash') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-600 transition">All Trashed Fabrics</a>
            </div>
        </div>

        {{-- Suppliers Dropdown --}}
        <div>
            <button @click="openSupplier = !openSupplier"
                class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-gray-700 transition">
                <div class="flex items-center">
                    <div class="w-6 h-6 mr-3">
                        <i class="fa-solid fa-truck-field"></i>
                    </div>
                    <span>Suppliers</span>
                </div>
                <svg :class="{'rotate-180': openSupplier}" class="w-4 h-4 transition-transform duration-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="openSupplier" class="ml-8 space-y-1 mt-1">
                <a href="{{ route('admin.suppliers.index') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-600 transition">All Suppliers</a>
                <a href="{{ route('admin.suppliers.create') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-600 transition">Add New Supplier</a>
                <a href="{{ route('admin.suppliers.trash') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-600 transition">All Trashed Suppliers</a>
            </div>
        </div>

    </nav>
</aside>
