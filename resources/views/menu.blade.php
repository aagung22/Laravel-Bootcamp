@extends('layouts.layout')
@section('title', 'Menu - Toko Roti Cloud Bread')
@section('content')

<!-- Hero Section Menu -->
<header class="relative w-full min-h-[45vh] flex flex-col justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0 w-full h-full">
        <img 
            src="{{ asset('assets/images/Hero.jpg') }}" 
            alt="Menu Cloud Bread"
            class="w-full h-full object-cover object-center"
            style="width: 100%; height: 100%; object-fit: cover;"
            loading="eager"
        >
        <div class="absolute inset-0 bg-gradient-to-r from-primary/90 via-primary/70 to-primary/40"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto w-full px-6 md:px-12 py-16">
        <div class="max-w-2xl">
            <span class="font-label-caps text-xs text-tertiary-fixed-dim tracking-[0.3em] font-bold bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full inline-block">
                MENU KAMI
            </span>
            <h1 class="font-display-lg text-4xl md:text-6xl text-white leading-tight font-bold drop-shadow-lg mt-6">
                Temukan <br>
                <span class="text-tertiary-fixed-dim italic font-serif drop-shadow-lg">Kelezatan</span> Kami
            </h1>
            <p class="mt-4 font-body-lg text-lg text-white/90 max-w-lg leading-relaxed drop-shadow-md">
                Dari roti klasik yang lembut hingga pastry renyah, setiap produk kami dibuat dengan bahan berkualitas dan penuh cinta.
            </p>
        </div>
    </div>
</header>

<!-- Menu Content -->
<div class="relative bg-gradient-to-b from-[#f5f0e8] to-[#faf8f5] py-16 px-4 sm:px-6 lg:px-8">

    <!-- Tombol Penyaring Kategori (Filter) -->
    <div class="max-w-7xl mx-auto mb-12 flex justify-center gap-3 overflow-x-auto pb-2 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
        <button onclick="filterMenu('all')" id="tab-all" class="px-6 py-3 rounded-full text-sm font-semibold transition-all bg-[#8B6B4A] text-white shadow-lg shadow-[#8B6B4A]/20 border border-transparent hover:shadow-xl hover:shadow-[#8B6B4A]/30 hover:bg-[#7A5D3F]">
            Semua Menu
        </button>
        <button onclick="filterMenu('Roti Klasik')" id="tab-roti-klasik" class="px-6 py-3 rounded-full text-sm font-semibold transition-all bg-white/80 backdrop-blur-sm text-neutral-700 border border-neutral-200/50 hover:border-[#8B6B4A]/30 hover:bg-[#8B6B4A]/10 hover:text-[#8B6B4A] shadow-sm hover:shadow-md">
            Roti Klasik
        </button>
        <button onclick="filterMenu('Donat')" id="tab-donat" class="px-6 py-3 rounded-full text-sm font-semibold transition-all bg-white/80 backdrop-blur-sm text-neutral-700 border border-neutral-200/50 hover:border-[#8B6B4A]/30 hover:bg-[#8B6B4A]/10 hover:text-[#8B6B4A] shadow-sm hover:shadow-md">
            Donat
        </button>
        <button onclick="filterMenu('Pastry')" id="tab-pastry" class="px-6 py-3 rounded-full text-sm font-semibold transition-all bg-white/80 backdrop-blur-sm text-neutral-700 border border-neutral-200/50 hover:border-[#8B6B4A]/30 hover:bg-[#8B6B4A]/10 hover:text-[#8B6B4A] shadow-sm hover:shadow-md">
            Pastry
        </button>
    </div>

    <!-- Kisi Katalog Menu -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="menu-grid">
        @foreach ($menus as $menu)
            <div class="menu-card bg-white rounded-2xl border border-neutral-200/50 overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 flex flex-col group hover:border-[#8B6B4A]/30 hover:-translate-y-1" data-category="{{ $menu->category }}">
                <div class="h-64 w-full overflow-hidden relative bg-neutral-100">
                    <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <span class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm text-sm font-bold text-[#8B6B4A] px-4 py-1.5 rounded-full shadow-lg border border-neutral-100">
                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                    </span>
                    <span class="absolute top-4 left-4 bg-[#8B6B4A] text-white text-[10px] uppercase font-bold tracking-wider px-3 py-1 rounded-full shadow-lg">
                        {{ $menu->category }}
                    </span>
                    <!-- Decorative overlay on hover -->
                    <div class="absolute inset-0 bg-gradient-to-t from-[#8B6B4A]/0 via-[#8B6B4A]/0 to-[#8B6B4A]/0 group-hover:from-[#8B6B4A]/10 group-hover:via-transparent group-hover:to-transparent transition-all duration-700"></div>
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                    <div>
                        <h3 class="font-bold text-xl text-neutral-800 group-hover:text-[#8B6B4A] transition-colors" style="font-family: 'Outfit', sans-serif;">
                            {{ $menu->name }}
                        </h3>
                        <p class="text-sm text-neutral-500 mt-2 leading-relaxed line-clamp-2">
                            {{ $menu->description }}
                        </p>
                    </div>
                    <div class="pt-2">
                        <a href="{{ url('/order/dine-in') }}" class="w-full inline-flex items-center justify-center bg-[#8B6B4A]/10 hover:bg-[#8B6B4A] text-[#8B6B4A] hover:text-white py-3 rounded-xl text-sm font-bold tracking-wide transition-all border border-[#8B6B4A]/30 hover:border-[#8B6B4A] gap-2 shadow-sm hover:shadow-lg hover:shadow-[#8B6B4A]/20 group-btn">
                            <span>Pesan Sekarang</span>
                            <span class="material-symbols-outlined text-base transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/menu-filter.js') }}"></script>
@endpush

@endsection