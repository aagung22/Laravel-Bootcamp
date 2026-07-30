<!-- laravel/navbar.blade.php -->
<nav class="fixed top-0 w-full z-50 flex justify-between items-center px-6 md:px-12 py-6 max-w-7xl mx-auto left-0 right-0 transition-all duration-300" id="top-nav">
    <!-- Logo and Brand -->
    <div class="flex items-center gap-2">
        <img src="{{ asset('assets/images/Logo.png') }}" alt="Logo Cloud Bread" class="h-10 w-auto object-contain">
        <span class="font-display-lg text-2xl text-white tracking-tight font-bold transition-colors duration-300" id="brand-text">
            Cloud Bread
        </span>
    </div>

    <!-- Desktop Navigation -->
    <div class="hidden md:flex gap-8 items-center">
        <a href="{{ url('/') }}" class="font-label-caps text-xs font-bold tracking-widest pb-1 transition-all duration-300 border-b-2 text-white border-white/30 hover:border-white/70 {{ Request::is('/') ? 'border-white' : 'border-transparent hover:border-white/70' }}" id="link-beranda">
            Beranda
        </a>
        <a href="{{ url('/menu') }}" class="font-label-caps text-xs font-bold tracking-widest pb-1 transition-all duration-300 border-b-2 text-white border-white/30 hover:border-white/70 {{ Request::is('menu') ? 'border-white' : 'border-transparent hover:border-white/70' }}" id="link-menu">
            Menu
        </a>
        <a href="{{ url('/order/dine-in') }}" class="inline-flex items-center justify-center px-6 py-2.5 font-label-caps text-xs tracking-widest font-bold rounded-xl text-primary bg-white hover:bg-white/90 transition-all duration-300 shadow-sm {{ Request::is('order/dine-in') ? 'ring-2 ring-[#ebdcb9]' : '' }}" id="btn-order">
            Pesan Sekarang
        </a>
    </div>

    <!-- Mobile Menu Toggle Button -->
    <button class="md:hidden text-white p-1 focus:outline-none transition-colors duration-300" id="menu-toggle-btn" aria-label="Toggle menu">
        <span class="material-symbols-outlined text-white" id="menu-toggle-icon">menu</span>
    </button>
</nav>

<!-- Mobile Drawer Menu -->
<div id="mobile-drawer" class="fixed inset-0 z-40 bg-background/98 backdrop-blur-md flex flex-col justify-center items-center gap-8 md:hidden hidden transition-all duration-300">
    <a href="{{ url('/') }}" class="font-display-lg text-3xl text-white font-bold hover:text-on-tertiary-container transition-colors relative group" data-close-menu>
        Beranda
        <span class="absolute -bottom-2 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
    </a>
    <a href="{{ url('/menu') }}" class="font-display-lg text-3xl text-white font-bold hover:text-on-tertiary-container transition-colors relative group" data-close-menu>
        Menu
        <span class="absolute -bottom-2 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
    </a>
    <a href="{{ url('/order/dine-in') }}" class="bg-primary text-white px-8 py-3.5 font-label-caps text-sm tracking-widest font-bold hover:bg-primary/90 transition-all active:scale-95 rounded-xl" data-close-menu>
        PESAN SEKARANG
    </a>
</div>

<script>
    // Scroll background interaction
    window.addEventListener('scroll', () => {
        const nav = document.getElementById('top-nav');
        const brandText = document.getElementById('brand-text');
        const links = document.querySelectorAll('#link-beranda, #link-menu, #link-about');
        const btnOrder = document.getElementById('btn-order');
        const menuToggle = document.getElementById('menu-toggle-btn');
        const menuIcon = document.getElementById('menu-toggle-icon');
        
        if (window.scrollY > 50) {
            // Saat di-scroll - tampilan normal dengan background putih
            nav.classList.add('bg-white/95', 'backdrop-blur-md', 'shadow-sm', 'border-b', 'border-outline-variant/10');
            nav.classList.remove('bg-transparent');
            
            // Ubah warna teks menjadi primary (hijau/coklat)
            if (brandText) brandText.className = 'font-display-lg text-2xl text-primary tracking-tight font-bold transition-colors duration-300';
            links.forEach(link => {
                if (link) {
                    // Pertahankan active state jika sedang di halaman tersebut
                    if (link.classList.contains('border-white') || link.classList.contains('border-primary')) {
                        link.className = link.className.replace(/text-white/g, 'text-primary').replace(/border-white/g, 'border-primary');
                    } else {
                        link.className = link.className.replace(/text-white/g, 'text-primary').replace(/border-white\/30/g, 'border-primary/30').replace(/hover:border-white\/70/g, 'hover:border-primary/70');
                    }
                }
            });
            
            // Ubah tombol order
            if (btnOrder) {
                btnOrder.className = btnOrder.className.replace(/bg-white/g, 'bg-primary').replace(/text-primary/g, 'text-on-primary').replace(/hover:bg-white\/90/g, 'hover:bg-primary/90');
                if (window.location.pathname === '/order/dine-in') {
                    btnOrder.className += ' ring-2 ring-[#ebdcb9]';
                }
            }
            
            // Ubah icon menu toggle
            if (menuToggle) menuToggle.className = 'md:hidden text-primary p-1 focus:outline-none transition-colors duration-300';
            if (menuIcon) menuIcon.className = 'material-symbols-outlined text-primary';
            
        } else {
            // Saat di atas - tampilan transparan dengan teks putih
            nav.classList.remove('bg-white/95', 'backdrop-blur-md', 'shadow-sm', 'border-b', 'border-outline-variant/10');
            nav.classList.add('bg-transparent');
            
            // Kembalikan ke warna putih
            if (brandText) brandText.className = 'font-display-lg text-2xl text-white tracking-tight font-bold transition-colors duration-300';
            links.forEach(link => {
                if (link) {
                    if (link.classList.contains('border-primary')) {
                        link.className = link.className.replace(/text-primary/g, 'text-white').replace(/border-primary/g, 'border-white');
                    } else {
                        link.className = link.className.replace(/text-primary/g, 'text-white').replace(/border-primary\/30/g, 'border-white/30').replace(/hover:border-primary\/70/g, 'hover:border-white/70');
                    }
                }
            });
            
            // Kembalikan tombol order
            if (btnOrder) {
                btnOrder.className = btnOrder.className.replace(/bg-primary/g, 'bg-white').replace(/text-on-primary/g, 'text-primary').replace(/hover:bg-primary\/90/g, 'hover:bg-white/90');
                if (window.location.pathname === '/order/dine-in') {
                    btnOrder.className = btnOrder.className.replace(/ring-2 ring-\[\#ebdcb9\]/g, '');
                }
            }
            
            // Kembalikan icon menu toggle
            if (menuToggle) menuToggle.className = 'md:hidden text-white p-1 focus:outline-none transition-colors duration-300';
            if (menuIcon) menuIcon.className = 'material-symbols-outlined text-white';
        }
    });

    // Mobile Drawer Toggle Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggleBtn = document.getElementById('menu-toggle-btn');
        const mobileDrawer = document.getElementById('mobile-drawer');
        const menuIcon = document.getElementById('menu-toggle-icon');
        const closeMenuButtons = document.querySelectorAll('[data-close-menu]');
        
        // Fungsi untuk toggle drawer
        function toggleDrawer() {
            mobileDrawer.classList.toggle('hidden');
            
            // Ganti icon antara menu dan close
            if (mobileDrawer.classList.contains('hidden')) {
                menuIcon.textContent = 'menu';
            } else {
                menuIcon.textContent = 'close';
            }
        }
        
        // Event listener untuk tombol toggle
        if (menuToggleBtn) {
            menuToggleBtn.addEventListener('click', toggleDrawer);
        }
        
        // Event listener untuk menutup drawer saat klik link di dalamnya
        closeMenuButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Tutup drawer
                if (!mobileDrawer.classList.contains('hidden')) {
                    mobileDrawer.classList.add('hidden');
                    if (menuIcon) menuIcon.textContent = 'menu';
                }
            });
        });
        
        // Tutup drawer saat klik di luar drawer
        document.addEventListener('click', function(e) {
            const isClickInsideDrawer = mobileDrawer.contains(e.target);
            const isClickOnToggle = menuToggleBtn.contains(e.target);
            
            if (!isClickInsideDrawer && !isClickOnToggle && !mobileDrawer.classList.contains('hidden')) {
                mobileDrawer.classList.add('hidden');
                if (menuIcon) menuIcon.textContent = 'menu';
            }
        });
        
        // Tutup drawer saat resize ke desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768 && !mobileDrawer.classList.contains('hidden')) {
                mobileDrawer.classList.add('hidden');
                if (menuIcon) menuIcon.textContent = 'menu';
            }
        });
    });
</script>