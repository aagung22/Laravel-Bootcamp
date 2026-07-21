@extends('layouts.layout')
@section('title', 'Beranda')
@section('content')

<main id="main-content">
    <!-- Hero Section -->
    <header class="relative w-full min-h-screen flex flex-col justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0 w-full h-full">
            <img 
                src="{{ asset('assets/images/Hero.jpg') }}" 
                alt="Cloud Bread Hero Background"
                class="w-full h-full object-cover object-center"
                style="width: 100%; height: 100%; object-fit: cover;"
                loading="eager"
            >
            <div class="absolute inset-0 bg-gradient-to-r from-primary/90 via-primary/60 to-primary/30"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto w-full px-6 md:px-12 pt-24 pb-16">
            <div class="max-w-2xl">
                <h1 class="font-display-lg text-5xl md:text-7xl text-white leading-tight font-bold drop-shadow-lg">
                    Crafted With <br>
                    <span class="text-tertiary-fixed-dim italic font-serif drop-shadow-lg">Love</span>, <br>
                    Baked Fresh
                </h1>
                <p class="mt-8 font-body-lg text-lg text-white/90 max-w-lg leading-relaxed drop-shadow-md">
                    Temukan kelezatan autentik dari setiap gigitan. Dari classic butter cake hingga premium pastry, semua dibuat dengan bahan pilihan dan penuh cinta.
                </p>

                <div class="mt-12 flex flex-wrap gap-4">
                    <a href="{{ url('/menu') }}" class="border border-white/30 text-white bg-tertiary-fixed-dim text-tertiary-container px-8 py-4 font-label-caps text-xs tracking-widest font-bold flex items-center gap-3 hover:bg-tertiary-fixed transition-all group active:scale-95 shadow-lg">
                        JELAJAHI MENU 
                        <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
                    </a>
                    <a href="#about" class="border border-white/30 text-white px-8 py-5 font-label-caps text-xs tracking-widest font-bold hover:bg-white/10 transition-all active:scale-95 text-center backdrop-blur-sm">
                        TENTANG KAMI
                    </a>
                </div>

                <div class="mt-20 grid grid-cols-3 gap-8 border-t border-white/20 pt-12">
                    <div>
                        <span class="block font-display-lg text-3xl md:text-4xl text-tertiary-fixed-dim font-bold drop-shadow-lg">10+</span>
                        <span class="block font-label-caps text-[10px] text-white/80 tracking-[0.2em] mt-1 font-bold">VARIAN KUE</span>
                    </div>
                    <div>
                        <span class="block font-display-lg text-3xl md:text-4xl text-tertiary-fixed-dim font-bold drop-shadow-lg">100%</span>
                        <span class="block font-label-caps text-[10px] text-white/80 tracking-[0.2em] mt-1 font-bold">BAHAN ALAMI</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Information Bar (Bento Style) -->
    <section class="max-w-7xl mx-auto px-6 md:px-12 -mt-8 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <!-- Jam Operasional -->
            <div class="md:col-span-5 bg-white p-8 shadow-xl flex items-start gap-6 border-b-4 border-on-tertiary-container rounded hover:shadow-2xl transition-shadow">
                <div class="bg-surface-container p-4 rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-tertiary-container">schedule</span>
                </div>
                <div>
                    <h3 class="font-label-caps text-xs text-secondary mb-2 tracking-widest font-bold">JAM OPERASIONAL</h3>
                    <p class="font-headline-md text-xl md:text-2xl text-primary font-bold">Setiap Hari: 08:00 — 22:00 WIB</p>
                </div>
            </div>
            <!-- Lokasi -->
            <div class="md:col-span-7 bg-white p-8 shadow-xl flex items-start gap-6 border-b-4 border-tertiary-fixed-dim rounded hover:shadow-2xl transition-shadow">
                <div class="bg-surface-container p-4 rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-tertiary-fixed-dim" style="font-variation-settings: 'FILL' 1;">location_on</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-label-caps text-xs text-secondary mb-2 tracking-widest font-bold">LOKASI KAMI</h3>
                    <p class="font-headline-md text-xl md:text-2xl text-primary font-bold">Jl. Lasem 1A No.34, Surabaya</p>
                </div>
                <div class="ml-auto hidden lg:block self-center">
                    <a href="https://maps.app.goo.gl/spLGa4XMF5aoNnZK6" target="_blank" rel="noreferrer" class="text-on-tertiary-container font-label-caps text-xs tracking-widest font-bold border-b border-on-tertiary-container/30 pb-1 hover:border-on-tertiary-container transition-all">LIHAT PETA</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Specialty Grid -->
    <section class="py-32 px-6 md:px-12 max-w-7xl mx-auto" id="menu">
        <div class="text-center mb-20">
            <span class="font-label-caps text-xs text-on-tertiary-container tracking-[0.3em] font-bold">PRODUK KAMI</span>
            <h2 class="font-headline-lg text-4xl md:text-5xl text-primary mt-4 font-bold">Best Seller</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Item 1 -->
            <div class="group cursor-pointer">
                <div class="aspect-[4/5] overflow-hidden bg-surface-container mb-6 relative rounded shadow-md hover:shadow-xl transition-shadow">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Pain Au Chocolat"  src="{{ asset('assets/images/menu/Pain_Au.jpg') }}" />
                    <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 font-label-caps text-[10px] tracking-wider font-bold text-tertiary-container shadow">Mulai Dari Rp 17.000</div>
                </div>
                <h3 class="font-headline-md text-2xl text-primary mb-2 font-bold group-hover:text-on-tertiary-container transition-colors">Pain Au Chocolat</h3>
                <p class="text-secondary text-sm leading-relaxed mb-6">Pastry lipat renyah beraroma mentega dengan isian batangan dark chocolate premium.</p>
                <a href="{{ url('/menu') }}" class="flex items-center gap-2 text-on-tertiary-container font-label-caps text-xs tracking-widest font-bold group-hover:gap-4 transition-all">
    Lihat Selengkapnya <span class="material-symbols-outlined text-sm">east</span>
</a>
            </div>
            <!-- Item 2 -->
            <div class="group cursor-pointer">
                <div class="aspect-[4/5] overflow-hidden bg-surface-container mb-6 relative rounded shadow-md hover:shadow-xl transition-shadow">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Specialty Coffee" src="{{ asset('assets/images/menu/Donat_Kampung.jpg') }}"/>
                    <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 font-label-caps text-[10px] tracking-wider font-bold text-tertiary-container shadow">Mulai Dari Rp 6.000</div>
                </div>
                <h3 class="font-headline-md text-2xl text-primary mb-2 font-bold group-hover:text-on-tertiary-container transition-colors">Donat Kampung Gula Halus</h3>
                <p class="text-secondary text-sm leading-relaxed mb-6">Donat kentang klasik bertekstur sangat empuk dengan balutan gula donat dingin yang manis dan bernostalgia.</p>
                <a href="{{ url('/menu') }}" class="flex items-center gap-2 text-on-tertiary-container font-label-caps text-xs tracking-widest font-bold group-hover:gap-4 transition-all">
    Lihat Selengkapnya <span class="material-symbols-outlined text-sm">east</span>
</a>
            </div>
            <!-- Item 3 -->
            <div class="group cursor-pointer">
                <div class="aspect-[4/5] overflow-hidden bg-surface-container mb-6 relative rounded shadow-md hover:shadow-xl transition-shadow">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="French Pastries" src="{{ asset('assets/images/menu/Croissant.jpg') }}" />
                    <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 font-label-caps text-[10px] tracking-wider font-bold text-tertiary-container shadow">Mulai Dari Rp 18.000</div>
                </div>
                <h3 class="font-headline-md text-2xl text-primary mb-2 font-bold group-hover:text-on-tertiary-container transition-colors">Croissant</h3>
                <p class="text-secondary text-sm leading-relaxed mb-6">Pastry berlapis khas Prancis yang flaky (renyah beremah) dan kaya aroma butter.</p>
                <a href="{{ url('/menu') }}" class="flex items-center gap-2 text-on-tertiary-container font-label-caps text-xs tracking-widest font-bold group-hover:gap-4 transition-all">
    Lihat Selengkapnya <span class="material-symbols-outlined text-sm">east</span>
</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="bg-surface-container-low py-32 overflow-hidden" id="about">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
                <div class="relative">
                    <div class="aspect-[1/1.2] relative z-10 rounded overflow-hidden shadow-2xl hover:shadow-3xl transition-shadow">
                        <img class="w-full h-full object-cover" alt="Master Baker" src="{{ asset('assets/images/Bakerman.jpg') }}" />
                    </div>
                    <!-- Decorative element -->
                    <div class="absolute top-1/2 -right-20 w-40 h-40 bg-tertiary-fixed-dim/10 rounded-full blur-3xl"></div>
                </div>

                <div class="space-y-8">
                    <span class="font-label-caps text-xs text-on-tertiary-container tracking-[0.3em] font-bold">TENTANG KAMI</span>
                    <h2 class="font-headline-lg text-4xl md:text-5xl text-primary leading-tight font-bold">Toko Roti Cloud Bread</h2>
                    <p class="font-body-lg text-lg text-secondary leading-relaxed">
                        Berawal dari kecintaan pada aroma roti yang baru keluar dari oven, Cloud Bread hadir sebagai perpaduan antara tradisi artisan dan kenyamanan modern. Kami percaya bahwa kualitas tidak bisa diburu-buru.
                    </p>
                    <p class="font-body-md text-base text-secondary leading-relaxed">
                        Kami menyajikan roti kualitas premium yang dipadukan dengan kemudahan pemesanan digital langsung dari meja Anda. Setiap cangkir dan setiap potong roti adalah janji kami akan kesempurnaan rasa.
                    </p>

                    <div class="pt-8">
                        <div class="flex items-center gap-8">
                            <div class="text-center">
                                <span class="material-symbols-outlined text-on-tertiary-container text-[40px] mb-2 block">eco</span>
                                <span class="block font-label-caps text-[10px] tracking-widest text-primary font-bold">ORGANIC</span>
                            </div>
                            <div class="text-center">
                                <span class="material-symbols-outlined text-on-tertiary-container text-[40px] mb-2 block">restaurant</span>
                                <span class="block font-label-caps text-[10px] tracking-widest text-primary font-bold">HANDMADE</span>
                            </div>
                            <div class="text-center">
                                <span class="material-symbols-outlined text-on-tertiary-container text-[40px] mb-2 block">verified</span>
                                <span class="block font-label-caps text-[10px] tracking-widest text-primary font-bold">CERTIFIED</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection