@extends('layouts.layout')
@section('title', 'Pembayaran Berhasil')
@section('content')
<div class="min-h-screen bg-[#faf8f5] flex items-center justify-center px-4 py-12">
    <div class="bg-white rounded-3xl border border-[#20622c]/20 p-8 max-w-md w-full shadow-sm text-center">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-neutral-800">Pembayaran Berhasil! 🎉</h2>
        <p class="text-neutral-500 text-sm mt-2">Terima kasih, pesanan Anda sudah kami terima.</p>
        
        <div class="mt-6 bg-neutral-50 rounded-xl p-4 text-left text-sm">
            <div class="flex justify-between py-1">
                <span class="text-neutral-500">Order ID</span>
                <span class="font-bold text-neutral-800">{{ $order->order_code }}</span>
            </div>
            <div class="flex justify-between py-1 border-t border-neutral-200">
                <span class="text-neutral-500">Total</span>
                <span class="font-bold text-[#20622c]">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between py-1 border-t border-neutral-200">
                <span class="text-neutral-500">Metode</span>
                <span class="font-semibold text-neutral-700">{{ ucfirst($order->payment_method) }}</span>
            </div>
            <div class="flex justify-between py-1 border-t border-neutral-200">
                <span class="text-neutral-500">Status</span>
                <span class="font-semibold text-green-600">✅ LUNAS</span>
            </div>
        </div>

        <a href="{{ route('order.dine-in') }}" class="block w-full mt-6 bg-[#20622c] hover:bg-[#184620] text-white py-3 rounded-xl font-bold transition-all text-center">
            Kembali ke Menu
        </a>
    </div>
</div>
@endsection