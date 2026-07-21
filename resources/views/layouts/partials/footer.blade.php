<!-- laravel/footer.blade.php -->
<footer class="bg-surface-container-high border-t border-outline-variant/10" id="main-footer">
    <div class="w-full px-6 md:px-12 py-16 grid grid-cols-1 md:grid-cols-4 gap-12 max-w-7xl mx-auto">
        <!-- Brand Information -->
        <div class="col-span-1">
            <div class="flex items-center gap-2 mb-6">
                <span class="material-symbols-outlined text-on-tertiary-container" style="font-variation-settings: 'FILL' 1;">
                    bakery_dining
                </span>
                <span class="font-display-lg text-2xl text-primary tracking-tight font-bold">
                    Cloud Bread
                </span>
            </div>
            <p class="text-secondary text-sm leading-relaxed">
                Menyajikan kehangatan dari oven ke meja Anda sejak 2020.
            </p>
        </div>

        <!-- Tautan Cepat -->
        <div>
            <h4 class="font-label-caps text-xs text-primary mb-6 tracking-widest font-bold">
                TAUTAN CEPAT
            </h4>
            <ul class="space-y-4">
                <li>
                    <a class="text-sm text-secondary hover:text-primary hover:underline underline-offset-4 transition-all" href="{{ url('/') }}">
                        Beranda
                    </a>
                </li>
                <li>
                    <a class="text-sm text-secondary hover:text-primary hover:underline underline-offset-4 transition-all" href="{{ url('/#about') }}">
                        Tentang Kami
                    </a>
                </li>
                <li>
                    <a class="text-sm text-secondary hover:text-primary hover:underline underline-offset-4 transition-all" href="{{ url('/menu') }}">
                        Menu Kopi &amp; Roti
                    </a>
                </li>
                <li>
                    <a class="text-sm text-secondary hover:text-primary hover:underline underline-offset-4 transition-all" href="{{ url('/order/dine-in') }}">
                        Pesan Dine-In
                    </a>
                </li>
            </ul>
        </div>

        <!-- Lokalitas -->
        <div>
            <h4 class="font-label-caps text-xs text-primary mb-6 tracking-widest font-bold">
                LOKALITAS
            </h4>
            <ul class="space-y-4">
                <li>
                    <a class="text-sm text-secondary hover:text-primary hover:underline underline-offset-4 transition-all" href="#privacy">
                        Privacy Policy
                    </a>
                </li>
                <li>
                    <a class="text-sm text-secondary hover:text-primary hover:underline underline-offset-4 transition-all" href="#terms">
                        Terms of Service
                    </a>
                </li>
                <li>
                    <a class="text-sm text-secondary hover:text-primary hover:underline underline-offset-4 transition-all" href="#sustainability">
                        Sustainability
                    </a>
                </li>
                <li>
                    <a class="text-sm text-secondary hover:text-primary hover:underline underline-offset-4 transition-all" href="#careers">
                        Careers
                    </a>
                </li>
            </ul>
        </div>

        <!-- Temukan Kami -->
        <div>
            <h4 class="font-label-caps text-xs text-primary mb-6 tracking-widest font-bold">
                TEMUKAN KAMI
            </h4>
            <p class="text-secondary text-sm mb-6 leading-relaxed">
                Jl. Lasem 1A No.36, Surabaya, Jawa Timur 60179
            </p>
            <div class="flex gap-4">
                <a class="w-10 h-10 border border-outline-variant rounded-full flex items-center justify-center text-secondary hover:border-primary hover:text-primary transition-all bg-white/50" href="https://google.com" target="_blank" rel="noreferrer" aria-label="Website">
                    <span class="material-symbols-outlined text-[20px]">public</span>
                </a>
                <a class="w-10 h-10 border border-outline-variant rounded-full flex items-center justify-center text-secondary hover:border-primary hover:text-primary transition-all bg-white/50" href="mailto:info@cloudbread.com" aria-label="Email">
                    <span class="material-symbols-outlined text-[20px]">mail</span>
                </a>
                <a class="w-10 h-10 border border-outline-variant rounded-full flex items-center justify-center text-secondary hover:border-primary hover:text-primary transition-all bg-white/50" href="tel:+6231234567" aria-label="Call Phone">
                    <span class="material-symbols-outlined text-[20px]">call</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Copyright Bar -->
    <div class="max-w-7xl mx-auto px-6 md:px-12 py-8 border-t border-outline-variant/10 text-center">
        <p class="font-label-caps text-[11px] text-secondary tracking-widest uppercase font-bold">
            © 2026 CLOUD BREAD. ALL RIGHTS RESERVED.
        </p>
    </div>
</footer>
