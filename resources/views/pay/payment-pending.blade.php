@extends('layouts.layout')
@section('title', 'Pembayaran Pending')
@section('content')
<div class="min-h-screen bg-[#faf8f5] flex items-center justify-center px-4 py-12">
    <div class="bg-white rounded-3xl border border-yellow-300/30 p-8 max-w-md w-full shadow-sm text-center">
        <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-neutral-800">Menunggu Pembayaran ⏳</h2>
        <p class="text-neutral-500 text-sm mt-2">Pembayaran Anda sedang diproses. Silakan selesaikan pembayaran.</p>
        
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
                <span class="text-neutral-500">Status</span>
                <span class="font-semibold text-yellow-600">⏳ PENDING</span>
            </div>
        </div>

        <a href="{{ route('payment.show', ['order_code' => $order->order_code]) }}" class="block w-full mt-6 bg-[#20622c] hover:bg-[#184620] text-white py-3 rounded-xl font-bold transition-all text-center">
            Coba Bayar Lagi
        </a>
        <a href="{{ route('order.dine-in') }}" class="block w-full mt-2 text-neutral-500 hover:text-neutral-700 text-sm py-2">
            Kembali ke Menu
        </a>
    </div>
</div>
@endsection