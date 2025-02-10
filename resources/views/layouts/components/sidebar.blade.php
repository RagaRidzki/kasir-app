<section
    class="fixed left-0 top-0 w-64 h-full bg-white shadow-sm p-4 z-50 sidebar-menu transition-transform -translate-x-full md:translate-x-0">
    <a href="/dashboard" class="flex items-center pb-4 border-b border-b-gray-300">
        <img src="{{ asset('assets/images/wikrama-logo.png') }}" alt="logo" class="w-8 h-8 rounded object-cover">
        <span class="text-md font-bold text-textColor ml-1">Aplikasi Kasir</span>
    </a>
    <ul class="mt-4">
        <li class="mb-1 group {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard"
                class="flex items-center py-2 px-4 text-textColor hover:bg-hoverBg hover:text-hoverText rounded-md group-[.active]:bg-hoverBg group-[.active]:text-hoverText">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-md font-semibold">Dashboard</span>
            </a>
        </li>
        <li class="mb-1 group {{ Request::is(patterns: 'product') ? 'active' : '' }}">
            <a href="/product"
                class="flex items-center py-2 px-4 text-textColor hover:bg-hoverBg hover:text-hoverText rounded-md group-[.active]:bg-hoverBg group-[.active]:text-hoverText">
                <i class="ri-bar-chart-box-line mr-3 text-lg"></i>
                <span class="text-md font-semibold">Produk</span>
            </a>
        </li>
        <li class="mb-1 group {{ Request::is(patterns: 'sale') ? 'active' : '' }}">
            <a href="/sale"
                class="flex items-center py-2 px-4 text-textColor hover:bg-hoverBg hover:text-hoverText rounded-md group-[.active]:bg-hoverBg group-[.active]:text-hoverText">
                <i class="ri-bar-chart-box-line mr-3 text-lg"></i>
                <span class="text-md font-semibold">Pembelian</span>
            </a>
        </li>
        <li class="mb-1 group {{ Request::is(patterns: 'user') ? 'active' : '' }}">
            <a href="/user"
                class="flex items-center py-2 px-4 text-textColor hover:bg-hoverBg hover:text-hoverText rounded-md group-[.active]:bg-hoverBg group-[.active]:text-hoverText">
                <i class="ri-bar-chart-box-line mr-3 text-lg"></i>
                <span class="text-md font-semibold">User</span>
            </a>
        </li>
    </ul>
</section>
<div class="fixed top-0 left-0 w-full h-full z-40 hidden sidebar-overlay"></div>