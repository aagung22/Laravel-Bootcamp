<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderReceiptMail; // Pastikan ini ada
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CafeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    
    public function menu()
    {
        $menus = Menu::all();
        return view('menu', compact('menus'));
    }
    
    public function dineIn()
    {
        $menus = Menu::all();
        return view('order.dine-in', compact('menus'));
    }

    public function storeOrder(Request $request)
    {
        // Validasi input
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255', // Gunakan 'email' validation
            'table_number' => 'required|integer|min:1|max:12',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string|in:cash,qris,transfer',
        ]);

        try {
            $order = DB::transaction(function () use ($request) {
                // Fetch all menus in the request to calculate price securely on server side
                $menuIds = collect($request->items)->pluck('id');
                $menus = Menu::whereIn('id', $menuIds)->get()->keyBy('id');

                $subtotal = 0;
                $orderItemsData = [];

                foreach ($request->items as $item) {
                    $menu = $menus->get($item['id']);
                    if (!$menu) {
                        throw new \Exception('Menu tidak ditemukan.');
                    }
                    
                    $itemTotal = $menu->price * $item['quantity'];
                    $subtotal += $itemTotal;

                    $orderItemsData[] = [
                        'menu_id' => $menu->id,
                        'menu_name' => $menu->name,
                        'quantity' => $item['quantity'],
                        'price' => $menu->price,
                        'subtotal' => $itemTotal,
                    ];
                }

                $tax = (int) round($subtotal * 0.1);
                $total = $subtotal + $tax;

                // Generate order code (BB-xxxx)
                $orderCode = 'BB-' . mt_rand(1000, 9999);
                while (Order::where('order_code', $orderCode)->exists()) {
                    $orderCode = 'BB-' . mt_rand(1000, 9999);
                }

                // Generate order_id untuk Midtrans
                $orderId = 'ORDER-' . time() . '-' . Str::random(6);

                // Tentukan status berdasarkan metode pembayaran
                $isCash = $request->payment_method === 'cash';
                
                $order = Order::create([
                    'order_id' => $orderId,
                    'order_code' => $orderCode,
                    'customer_name' => $request->customer_name,
                    'customer_email' => $request->customer_email,
                    'table_number' => $request->table_number,
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'total' => $total,
                    'payment_method' => $request->payment_method,
                    'status' => $isCash ? 'completed' : 'pending',
                    'payment_status' => $isCash ? 'paid' : 'pending',
                    'date' => now()->format('d/m/Y H:i'),
                ]);

                // Create order items
                foreach ($orderItemsData as $itemData) {
                    $order->items()->create($itemData);
                }

                return $order; // Return order dari transaction
            });

            // 🔥 KIRIM EMAIL SETELAH TRANSACTION BERHASIL (DI LUAR TRANSACTION)
            try {
                Log::info('Mencoba mengirim email ke: ' . $order->customer_email);
                
                Mail::to($order->customer_email)->send(new OrderReceiptMail($order));
                
                Log::info('Email berhasil dikirim ke: ' . $order->customer_email);
            } catch (\Exception $mailException) {
                // Catat di log saja agar user tidak mendapati error 500 jika SMTP offline
                Log::error('Gagal mengirimkan email struk ke ' . $order->customer_email . ': ' . $mailException->getMessage());
                Log::error('Mail error trace: ' . $mailException->getTraceAsString());
                // Email gagal tapi order tetap sukses
            }

            // 🔥 KEMBALIKAN RESPONSE SUKSES
            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil disimpan.',
                'order' => [
                    'order_code' => $order->order_code,
                    'order_id' => $order->order_id,
                    'customer_name' => $order->customer_name,
                    'customer_email' => $order->customer_email,
                    'table_number' => $order->table_number,
                    'subtotal' => $order->subtotal,
                    'tax' => $order->tax,
                    'total' => $order->total,
                    'payment_method' => $order->payment_method,
                    'payment_status' => $order->payment_status,
                    'status' => $order->status,
                    'date' => $order->date,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Order creation failed: ' . $e->getMessage());
            Log::error('Order error trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat pesanan: ' . $e->getMessage()
            ], 500);
        }
    }
}