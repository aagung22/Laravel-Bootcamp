@extends('layouts.layout')
@section('title', 'Pembayaran Online')
@section('content')
<div class="min-h-screen bg-[#faf8f5] flex items-center justify-center px-4 py-12">
    <div class="bg-white rounded-3xl border border-[#ebdcb9]/40 p-8 max-w-md w-full shadow-sm">
        <div class="text-center">
            <div class="w-16 h-16 bg-[#20622c]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-[#20622c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-neutral-800" style="font-family: 'Outfit', sans-serif;">Selesaikan Pembayaran</h2>
            <p class="text-neutral-500 text-sm mt-2">Total: <span class="font-bold text-[#20622c]">Rp {{ number_format($order->total, 0, ',', '.') }}</span></p>
            <p class="text-neutral-400 text-xs mt-1">Order: {{ $order->order_code }}</p>
        </div>

        <div class="mt-6 space-y-3">
            <div class="bg-neutral-50 rounded-xl p-4 text-sm">
                <div class="flex justify-between py-1">
                    <span class="text-neutral-500">Metode Pembayaran</span>
                    <span class="font-semibold text-neutral-700">{{ ucfirst($order->payment_method) }}</span>
                </div>
                <div class="flex justify-between py-1 border-t border-neutral-200">
                    <span class="text-neutral-500">Status</span>
                    <span class="font-semibold text-yellow-600">⏳ Menunggu Pembayaran</span>
                </div>
            </div>
        </div>

        <button id="pay-button" class="w-full mt-6 bg-[#20622c] hover:bg-[#184620] text-white py-4 rounded-2xl font-bold transition-all shadow-md flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            Bayar Sekarang
        </button>

        <p class="text-xs text-neutral-400 text-center mt-4">Klik tombol di atas untuk melanjutkan ke halaman pembayaran</p>
    </div>
</div>

<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    document.getElementById('pay-button').addEventListener('click', function() {
        const snapToken = '{{ $snapToken }}';
        const orderId = '{{ $order->order_id }}';

        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                window.location.href = "{{ route('payment.success', ['order_id' => $order->order_id]) }}";
            },
            onPending: function(result) {
                window.location.href = "{{ route('payment.pending', ['order_id' => $order->order_id]) }}";
            },
            onError: function(result) {
                window.location.href = "{{ route('payment.error', ['order_id' => $order->order_id]) }}";
            },
            onClose: function() {
                alert('Anda menutup popup pembayaran. Silakan coba lagi.');
            }
        });
    });
</script>
@endsection