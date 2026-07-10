@extends('layouts.layout')
@section('title', 'Tentang Kami')
@section('content')

    <div class="relative overflow-hidden bg-[#faf8f5] py-20 border-b border-[#ebdcb9]/30">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Grid layout: Kiri teks, kanan gambar-->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <!-- Kiri: teks -->
                <div class="space-y-6 text-left">
                    <!-- Judul -->
                    <h1
                        class="text-4xl md:text-5xl font-extrabold leading-tight bg-gradient-to-r from-yellow-600 via-orange-500 to-red-500 bg-clip-text text-transparent">
                        Tentang Kami
                    </h1>

                    <!-- Deskripsi -->
                    <div class="space-y-4 text-red-600 text-lg leading-relaxed">
                        <p>
                            STK (Sedulur Tunggal Kopi) adalah wadah cangkrukan digital dari Himatifta Universitas Dr.
                            Soetomo Surabaya. Tempat di mana filosofi satu cangkir sejuta saudara itu nyata. Di sini, gak
                            ada sekat antara senior, junior, atau yang jago coding sama yang programnya masih sering
                            error—karena di depan kopi, kita semua adalah sedulur.
                        </p>
                        <p>
                            Kami berkomitmen menyediakan ruang kreatif yang nyaman buat sharing, kolaborasi, atau sekadar
                            sambat bareng soal tugas kuliah. Dengan dukungan fasilitas teknologi modern, kita maju
                            bareng-bareng. Ingat rek, tugas iso ditunda, tapi paseduluran kudu tetep dipelihara!
                        </p>
                    </div>
                </div>

                <!-- Kanan: Gambar -->
                <div class="flex justify-center">
                    <img src="{{ asset('assets/images/BERTO STK.jpg') }}" alt="Suasana Cafe Byte & Brew"
                        class="w-full max-w-md h-[500px] object-cover rounded-3xl shadow-md">
                </div>

            </div>

        </div>
    </div>
@endsection
