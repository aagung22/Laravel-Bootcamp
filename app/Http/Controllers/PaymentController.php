<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Menampilkan halaman pembayaran Midtrans
     */
    public function show($order_code)
    {
        try {
            // 🔥 DEBUG 1: Cek function dipanggil
            \Log::info('=== PAYMENT SHOW CALLED ===');
            \Log::info('Order Code: ' . $order_code);

            // Cari order berdasarkan order_code
            $order = Order::where('order_code', $order_code)->first();

            // 🔥 DEBUG 2: Cek order ditemukan
            if (!$order) {
                \Log::error('Order NOT FOUND: ' . $order_code);
                return redirect()->route('order.dine-in')->with('error', 'Order tidak ditemukan!');
            }

            \Log::info('Order FOUND: ' . $order->order_code);
            \Log::info('Payment Status: ' . $order->payment_status);
            \Log::info('Items Count: ' . $order->items->count());

            // Cek apakah order sudah lunas
            if ($order->payment_status === 'paid') {
                \Log::info('Order already paid, redirect to success');
                return redirect()->route('payment.success', ['order_id' => $order->order_id]);
            }

            // 🔥 DEBUG 3: Cek items
            if ($order->items->count() === 0) {
                \Log::error('Order has NO items!');
                return redirect()->route('order.dine-in')->with('error', 'Order tidak memiliki item!');
            }

            // Siapkan parameter untuk Snap
            $itemDetails = $order->items->map(function($item) {
                return [
                    'id' => $item->menu_id,
                    'price' => (int) $item->price,
                    'quantity' => (int) $item->quantity,
                    'name' => $item->menu_name ?? 'Menu Item',
                ];
            })->toArray();

            \Log::info('Item Details: ', $itemDetails);

            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_id,
                    'gross_amount' => (int) $order->total,
                ],
                'customer_details' => [
                    'first_name' => $order->customer_name,
                    'email' => $order->customer_email ?? 'customer@kafe.com',
                ],
                'item_details' => $itemDetails,
            ];

            \Log::info('Midtrans Params: ', $params);

            // 🔥 DEBUG 4: Generate Snap Token
            \Log::info('Generating Snap Token...');
            $snapToken = Snap::getSnapToken($params);
            \Log::info('Snap Token: ' . $snapToken);

            // 🔥 DEBUG 5: Cek view exists
            \Log::info('Rendering view: pay.payment');

            // Kirim ke view - path: pay.payment (karena di folder pay)
            return view('pay.payment', [
                'snapToken' => $snapToken,
                'order' => $order,
            ]);

        } catch (\Exception $e) {
            // 🔥 DEBUG 6: Log error detail
            \Log::error('=== PAYMENT ERROR ===');
            \Log::error('Message: ' . $e->getMessage());
            \Log::error('File: ' . $e->getFile());
            \Log::error('Line: ' . $e->getLine());
            \Log::error('Trace: ' . $e->getTraceAsString());
            
            return redirect()->route('order.dine-in')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Halaman setelah pembayaran sukses
     */
    public function success($order_id)
    {
        $order = Order::where('order_id', $order_id)->firstOrFail();
        
        $order->update([
            'payment_status' => 'paid',
            'status' => 'completed',
        ]);

        return view('pay.payment-success', compact('order'));
    }

    /**
     * Halaman setelah pembayaran pending
     */
    public function pending($order_id)
    {
        $order = Order::where('order_id', $order_id)->firstOrFail();
        
        return view('pay.payment-pending', compact('order'));
    }

    /**
     * Halaman setelah pembayaran error/gagal
     */
    public function error($order_id)
    {
        $order = Order::where('order_id', $order_id)->firstOrFail();
        
        return view('pay.payment-error', compact('order'));
    }

    /**
     * Webhook untuk menerima notifikasi dari Midtrans
     */
    public function notification(Request $request)
    {
        try {
            $notification = new Notification();

            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;

            $order = Order::where('order_id', $orderId)->first();

            if (!$order) {
                return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
            }

            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    $order->payment_status = 'challenge';
                } else if ($fraudStatus == 'accept') {
                    $order->payment_status = 'paid';
                    $order->status = 'completed';
                }
            } else if ($transactionStatus == 'settlement') {
                $order->payment_status = 'paid';
                $order->status = 'completed';
            } else if ($transactionStatus == 'pending') {
                $order->payment_status = 'pending';
            } else if ($transactionStatus == 'deny') {
                $order->payment_status = 'denied';
                $order->status = 'canceled';
            } else if ($transactionStatus == 'expire') {
                $order->payment_status = 'expired';
                $order->status = 'canceled';
            } else if ($transactionStatus == 'cancel') {
                $order->payment_status = 'canceled';
                $order->status = 'canceled';
            }

            $order->save();

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}