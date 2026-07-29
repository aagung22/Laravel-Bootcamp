// Mengambil data produk menu dari atribut dataset HTML utama (dikirim dari Laravel)
const products = JSON.parse(document.getElementById('dine-in-app').dataset.menus);

// Inisialisasi variabel keranjang (cart) dan kategori aktif
let cart = [];
let currentCategory = 'all';

// Fungsi pembantu untuk memformat angka nominal menjadi format mata uang Rupiah
function formatRupiah(amount) {
    return "Rp " + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Fungsi untuk menyaring tampilan produk berdasarkan tab kategori yang diklik
function filterCategory(category) {
    currentCategory = category;
    
    // Perbarui gaya visual tombol kategori aktif dan tidak aktif
    const cats = ['all', 'coffee', 'non-coffee', 'food-snack'];
    cats.forEach(cat => {
        const btn = document.getElementById(`cat-${cat}`);
        if (btn) {
            if (cat === category) {
                btn.className = "px-5 py-2.5 rounded-xl text-sm font-semibold transition-all bg-[#20622c] text-white shadow-[0_4px_12px_rgba(32,98,44,0.2)]";
            } else {
                btn.className = "px-5 py-2.5 rounded-xl text-sm font-semibold transition-all bg-white text-neutral-600 border border-[#ebdcb9]/30 hover:bg-[#f5f3ef]";
            }
        }
    });

    // Jalankan kombinasi filter kategori dan kolom pencarian
    applySearchAndFilters();
}

// Fungsi pemicu pencarian ketika pengguna mengetik di input pencarian
function searchMenu() {
    applySearchAndFilters();
}

// Fungsi inti untuk menyaring kartu produk berdasarkan kategori dan kata kunci pencarian
function applySearchAndFilters() {
    const query = document.getElementById('search-menu').value.toLowerCase().trim();
    const cards = document.querySelectorAll('.product-card');

    cards.forEach(card => {
        const category = card.getAttribute('data-category');
        const name = card.getAttribute('data-name');
        const desc = card.getAttribute('data-description');

        const matchesCategory = (currentCategory === 'all' || category === currentCategory);
        const matchesQuery = (query === '' || name.includes(query) || desc.includes(query));

        // Tampilkan kartu jika cocok, sembunyikan jika tidak cocok dengan animasi transisi
        if (matchesCategory && matchesQuery) {
            card.style.display = 'flex';
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'scale(1)';
            }, 50);
        } else {
            card.style.opacity = '0';
            card.style.transform = 'scale(0.95)';
            setTimeout(() => {
                card.style.display = 'none';
            }, 300);
        }
    });
}

// Menambahkan produk ke dalam keranjang belanja
function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) {
        console.error('Product not found:', productId);
        return;
    }
    
    const existingItem = cart.find(item => item.product.id === productId);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            product: product,
            quantity: 1
        });
    }

    // Perbarui tampilan antarmuka keranjang
    updateCartUI();
}

// Memperbarui jumlah kuantitas produk di dalam keranjang (bisa bertambah atau berkurang)
function updateQuantity(productId, amount) {
    const item = cart.find(item => item.product.id === productId);
    if (!item) return;

    item.quantity += amount;

    // Jika kuantitas habis atau kurang dari 0, hapus item dari keranjang
    if (item.quantity <= 0) {
        cart = cart.filter(i => i.product.id !== productId);
    }

    // Perbarui tampilan antarmuka keranjang
    updateCartUI();
}

// Fungsi untuk menggambar ulang antarmuka keranjang belanja berdasarkan data terbaru
function updateCartUI() {
    const cartEmpty = document.getElementById('cart-empty');
    const cartItems = document.getElementById('cart-items');
    const cartTotalsSection = document.getElementById('cart-totals-section');
    const cartCount = document.getElementById('cart-count');

    // Jika keranjang kosong, tampilkan ilustrasi kosong dan sembunyikan rincian harga
    if (cart.length === 0) {
        if (cartEmpty) cartEmpty.classList.remove('hidden');
        if (cartItems) cartItems.classList.add('hidden');
        if (cartTotalsSection) cartTotalsSection.classList.add('hidden');
        if (cartCount) cartCount.innerText = '0 item';
        return;
    }

    if (cartEmpty) cartEmpty.classList.add('hidden');
    if (cartItems) cartItems.classList.remove('hidden');
    if (cartTotalsSection) cartTotalsSection.classList.remove('hidden');

    // Kosongkan daftar item di HTML lalu isi ulang secara dinamis
    cartItems.innerHTML = '';
    let totalCount = 0;
    let subtotal = 0;

    cart.forEach(item => {
        totalCount += item.quantity;
        const itemTotal = item.product.price * item.quantity;
        subtotal += itemTotal;

        cartItems.innerHTML += `
            <div class="flex items-center justify-between gap-3 bg-neutral-50 p-3 rounded-2xl border border-neutral-100">
                <div class="flex items-center gap-3">
                    <img src="/${item.product.image}" alt="${item.product.name}" class="w-12 h-12 rounded-xl object-cover">
                    <div>
                        <h4 class="text-xs font-bold text-neutral-800">${item.product.name}</h4>
                        <span class="text-[10px] text-neutral-500 block mt-0.5">${formatRupiah(item.product.price)}</span>
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <div class="flex items-center gap-2 border border-neutral-200 bg-white rounded-lg p-1">
                        <button onclick="updateQuantity(${item.product.id}, -1)" class="w-6 h-6 flex items-center justify-center hover:bg-neutral-100 rounded text-neutral-600 font-bold transition-all text-xs">-</button>
                        <span class="text-xs font-bold text-neutral-800 min-w-4 text-center">${item.quantity}</span>
                        <button onclick="updateQuantity(${item.product.id}, 1)" class="w-6 h-6 flex items-center justify-center hover:bg-neutral-100 rounded text-neutral-600 font-bold transition-all text-xs">+</button>
                    </div>
                    <span class="text-xs font-bold text-neutral-800 min-w-16 text-right">${formatRupiah(itemTotal)}</span>
                </div>
            </div>
        `;
    });

    // Hitung Pajak Pembangunan 1 (PB1) sebesar 10% dan total akhir
    const tax = Math.round(subtotal * 0.1);
    const total = subtotal + tax;

    cartCount.innerText = `${totalCount} item`;
    document.getElementById('cart-subtotal').innerText = formatRupiah(subtotal);
    document.getElementById('cart-tax').innerText = formatRupiah(tax);
    document.getElementById('cart-total').innerText = formatRupiah(total);
}

// Mengirimkan data transaksi ke server (Checkout) menggunakan metode HTTP POST
function processCheckout() {
    const nameInput = document.getElementById('customer-name').value.trim();
    const emailInput = document.getElementById('customer-email').value.trim(); // 🔥 PERBAIKI: ambil dari input email
    const tableSelect = document.getElementById('table-number').value;
    const paymentMethod = document.querySelector('input[name="payment-method"]:checked')?.value;
    const checkoutBtn = document.getElementById('btn-checkout');

    // Validasi input
    if (!nameInput) {
        alert('Silakan masukkan nama Anda terlebih dahulu!');
        return;
    }
    if (!emailInput) {
        alert('Silakan masukkan email Anda terlebih dahulu!');
        return;
    }
    // Validasi format email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailInput)) {
        alert('Silakan masukkan email yang valid!');
        return;
    }
    if (!tableSelect) {
        alert('Silakan pilih nomor meja Anda terlebih dahulu!');
        return;
    }
    if (cart.length === 0) {
        alert('Keranjang Anda kosong!');
        return;
    }
    if (!paymentMethod) {
        alert('Silakan pilih metode pembayaran!');
        return;
    }

    // Ubah tombol menjadi mode memproses (mencegah klik ganda)
    checkoutBtn.disabled = true;
    checkoutBtn.innerText = 'Memproses...';

    // Susun payload daftar belanjaan yang akan dikirim
    const itemsPayload = cart.map(item => ({
        id: item.product.id,
        quantity: item.quantity
    }));

    // Menghitung total otomatis dari keranjang
    const subtotal = cart.reduce((sum, item) => sum + (item.product.price * item.quantity), 0);
    const tax = Math.round(subtotal * 0.1);
    const grandTotal = subtotal + tax;

    // Mengambil Token CSRF untuk keamanan request Laravel
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                      document.getElementById('dine-in-app')?.dataset.csrf;

    // 🔥 PERBAIKI: Kirim customer_email yang benar
    const payload = {
        customer_name: nameInput,
        customer_email: emailInput, // 🔥 PERBAIKI: ini yang benar
        table_number: parseInt(tableSelect),
        payment_method: paymentMethod,
        items: itemsPayload,
        subtotal: subtotal,
        tax: tax,
        grand_total: grandTotal
    };

    console.log('Sending payload:', payload);

    // Lakukan pengiriman data ke server menggunakan Fetch API
    fetch('/order/store', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest' // 🔥 TAMBAHKAN: untuk deteksi AJAX
        },
        body: JSON.stringify(payload)
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response redirected:', response.redirected);
        
        // 🔥 PERBAIKI: Handle redirect
        if (response.redirected) {
            console.log('Request was redirected to:', response.url);
            if (response.url.includes('login')) {
                alert('Sesi Anda habis. Silakan refresh halaman.');
                window.location.href = response.url;
                return;
            }
            throw new Error('Request redirected to: ' + response.url);
        }
        
        // 🔥 PERBAIKI: Cek content-type
        const contentType = response.headers.get('content-type');
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Error response:', text);
                throw new Error(`HTTP error! status: ${response.status}`);
            });
        }
        
        if (contentType && contentType.includes('application/json')) {
            return response.json();
        } else {
            return response.text().then(text => {
                console.error('Non-JSON response:', text);
                throw new Error('Server returned non-JSON response');
            });
        }
    })
    .then(data => {
        // Kembalikan status tombol setelah proses selesai
        checkoutBtn.disabled = false;
        checkoutBtn.innerHTML = `Pesan Sekarang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>`;

        if (data.success) {
            // Jika payment method adalah qris atau transfer, redirect ke halaman pembayaran
            if (paymentMethod === 'qris' || paymentMethod === 'transfer') {
                window.location.href = `/payment/${data.order.order_code}`;
            } else {
                // Untuk Tunai (cash), tampilkan struk seperti biasa
                renderReceipt(data.order, paymentMethod);
            }
        } else {
            alert('Gagal membuat pesanan: ' + (data.message || 'Terjadi kesalahan'));
        }
    })
    .catch(error => {
        checkoutBtn.disabled = false;
        checkoutBtn.innerHTML = `Pesan Sekarang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>`;
        console.error('Error:', error);
        alert('Terjadi kesalahan: ' + error.message);
    });
}

// Fungsi untuk mencetak dan menampilkan modal resi struk setelah pembayaran sukses
function renderReceipt(order, paymentMethod) {
    let receiptItemsHtml = '';
    cart.forEach(item => {
        const itemTotal = item.product.price * item.quantity;
        receiptItemsHtml += `
            <div class="flex justify-between text-xs py-1.5 border-b border-neutral-100">
                <div>
                    <span class="font-semibold text-neutral-800">${item.product.name}</span>
                    <span class="text-neutral-400 ml-1">x${item.quantity}</span>
                </div>
                <span class="font-medium text-neutral-700">${formatRupiah(itemTotal)}</span>
            </div>
        `;
    });

    const paymentLabels = {
        'cash': 'Tunai di Kasir',
        'qris': 'QRIS',
        'transfer': 'Transfer Bank'
    };

    // Status pembayaran
    const paymentStatus = order.payment_status || 'pending';
    const statusLabels = {
        'paid': '✅ LUNAS',
        'pending': '⏳ MENUNGGU',
        'challenge': '⚠️ CHALLENGE',
        'denied': '❌ DITOLAK',
        'expired': '⏰ KADALUARSA',
        'canceled': '🚫 DIBATALKAN'
    };

    // Render rincian data struk belanja ke dalam modal
    const receiptContent = document.getElementById('receipt-content');
    receiptContent.innerHTML = `
        <div class="text-center border-b border-dashed border-neutral-200 pb-4 mb-4">
            <h4 class="text-base font-bold text-neutral-800">Cloud Bread</h4>
            <p class="text-[10px] text-neutral-400 mt-0.5">Toko Roti Cloud Bread</p>
            ${paymentMethod !== 'cash' ? `
                <div class="mt-2 inline-block px-3 py-1 rounded-full text-xs font-bold ${order.payment_status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'}">
                    ${statusLabels[order.payment_status] || 'MENUNGGU'}
                </div>
            ` : ''}
        </div>
        
        <div class="grid grid-cols-2 gap-y-2 text-xs border-b border-neutral-100 pb-3 mb-3">
            <div>
                <span class="text-neutral-400 block">ID PESANAN</span>
                <span class="font-bold text-neutral-700">${order.order_code}</span>
            </div>
            <div class="text-right">
                <span class="text-neutral-400 block">WAKTU</span>
                <span class="font-medium text-neutral-700">${order.date}</span>
            </div>
            <div>
                <span class="text-neutral-400 block">NAMA PELANGGAN</span>
                <span class="font-semibold text-neutral-700">${order.customer_name}</span>
            </div>
            <div class="text-right">
                <span class="text-neutral-400 block">NOMOR MEJA</span>
                <span class="font-bold text-[#20622c]">Meja ${order.table_number.toString().padStart(2, '0')}</span>
            </div>
        </div>

        <div class="space-y-1 mb-4">
            <span class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider block mb-2">Daftar Item</span>
            ${receiptItemsHtml}
        </div>

        <div class="space-y-2 border-t border-neutral-100 pt-3 text-xs">
            <div class="flex justify-between">
                <span class="text-neutral-400">Subtotal</span>
                <span class="font-medium text-neutral-700">${formatRupiah(order.subtotal)}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-neutral-400">PPN 10%</span>
                <span class="font-medium text-neutral-700">${formatRupiah(order.tax)}</span>
            </div>
            <div class="flex justify-between text-sm font-bold pt-2 border-t border-neutral-100">
                <span class="text-neutral-800">Total Pembayaran</span>
                <span class="text-[#20622c]">${formatRupiah(order.total)}</span>
            </div>
            <div class="flex justify-between text-xs pt-1">
                <span class="text-neutral-400">Metode Pembayaran</span>
                <span class="font-semibold text-neutral-700">${paymentLabels[paymentMethod]}</span>
            </div>
        </div>
        
        ${paymentMethod === 'qris' ? `
            <div class="bg-neutral-50 rounded-2xl p-4 flex flex-col items-center justify-center border border-neutral-100 mt-4">
                <span class="text-[10px] font-bold text-[#20622c] uppercase tracking-wider mb-2">QRIS DYNAMIC PAYMENT</span>
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=qris-byte-and-brew-invoice-${order.order_code}" class="w-32 h-32 rounded-xl object-contain border border-white shadow-sm">
                <span class="text-[9px] text-neutral-400 mt-2 text-center">Silakan scan kode QR di atas untuk menyelesaikan pemesanan</span>
            </div>
        ` : ''}
    `;

    // Menyimpan catatan pesanan ke riwayat penyimpanan lokal browser (Local Storage)
    saveOrderToHistory({
        id: order.order_code,
        date: order.date,
        customer: order.customer_name,
        table: order.table_number,
        items: cart.map(i => ({ name: i.product.name, quantity: i.quantity, price: i.product.price })),
        subtotal: order.subtotal,
        tax: order.tax,
        total: order.total,
        paymentMethod: paymentLabels[paymentMethod],
        status: order.payment_status || 'pending'
    });

    // Munculkan jendela modal struk dengan efek transisi fade-in
    const modal = document.getElementById('receipt-modal');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('opacity-0');
        modal.querySelector('div').classList.remove('scale-95');
    }, 50);

    // Hanya bersihkan keranjang jika payment method adalah cash
    if (paymentMethod === 'cash') {
        cart = [];
        updateCartUI();
        document.getElementById('customer-name').value = '';
        document.getElementById('customer-email').value = '';
        document.getElementById('table-number').value = '';
    }
}

// Menutup jendela modal resi struk belanja
function closeReceiptModal() {
    const modal = document.getElementById('receipt-modal');
    modal.classList.add('opacity-0');
    modal.querySelector('div').classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Menyimpan pesanan baru ke riwayat lokal Local Storage
function saveOrderToHistory(order) {
    let history = JSON.parse(localStorage.getItem('dine_in_history') || '[]');
    if (!order.status) {
        order.status = 'pending';
    }
    history.unshift(order);
    localStorage.setItem('dine_in_history', JSON.stringify(history));
    updateHistoryUI();
}

// Memperbarui jumlah indikator riwayat pesanan (badge angka merah/abu-abu)
function updateHistoryUI() {
    let history = JSON.parse(localStorage.getItem('dine_in_history') || '[]');
    const badge = document.getElementById('history-badge');
    if (badge) {
        badge.innerText = history.length;
    }
}

// Membuka atau menutup modal riwayat pemesanan lokal
function toggleHistoryModal() {
    const modal = document.getElementById('history-modal');
    const isHidden = modal.classList.contains('hidden');

    if (isHidden) {
        const historyContent = document.getElementById('history-content');
        let history = JSON.parse(localStorage.getItem('dine_in_history') || '[]');

        // Jika riwayat kosong, tampilkan pesan informatif
        if (history.length === 0) {
            historyContent.innerHTML = `
                <div class="text-center py-12 text-neutral-400">
                    <p class="text-sm">Anda belum memiliki riwayat pemesanan.</p>
                </div>
            `;
        } else {
            // Gambar ulang baris data riwayat pesanan dari Local Storage
            historyContent.innerHTML = '';
            history.forEach(order => {
                let itemsSummary = order.items.map(i => `${i.name} (${i.quantity}x)`).join(', ');
                const statusBadge = order.status === 'paid' ? '🟢 Lunas' : 
                                     order.status === 'pending' ? '🟡 Menunggu' : 
                                     order.status === 'denied' ? '🔴 Ditolak' : 
                                     order.status === 'expired' ? '⏰ Kadaluarsa' :
                                     order.status === 'canceled' ? '🚫 Dibatalkan' :
                                     '⚪ ' + (order.status || 'pending');
                historyContent.innerHTML += `
                    <div class="bg-neutral-50 border border-neutral-100 rounded-2xl p-4 hover:border-[#20622c]/30 transition-all">
                        <div class="flex justify-between items-start gap-4 mb-2">
                            <div>
                                <span class="text-xs font-bold text-neutral-800">${order.id}</span>
                                <span class="text-[10px] text-neutral-400 block mt-0.5">${order.date}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-bold text-[#20622c]">Meja ${order.table.toString().padStart(2, '0')}</span>
                                <span class="text-[10px] font-medium text-neutral-600 block mt-0.5">${formatRupiah(order.total)}</span>
                                <span class="text-[9px] ${order.status === 'paid' ? 'text-green-600' : 'text-yellow-600'} font-semibold block">${statusBadge}</span>
                            </div>
                        </div>
                        <div class="border-t border-neutral-200/50 pt-2 text-xs text-neutral-500 mt-2">
                            <span class="font-medium text-neutral-700">Daftar item:</span> ${itemsSummary}
                        </div>
                        <div class="mt-2 text-[10px] text-neutral-400 flex justify-between">
                            <span>Metode: ${order.paymentMethod}</span>
                            <span>Pemesan: ${order.customer}</span>
                        </div>
                    </div>
                `;
            });
        }

        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.querySelector('div').classList.remove('scale-95');
        }, 50);
    } else {
        modal.classList.add('opacity-0');
        modal.querySelector('div').classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
}

// Inisialisasi halaman saat dokumen selesai dimuat
document.addEventListener('DOMContentLoaded', () => {
    updateHistoryUI();
    
    // Cek apakah ini redirect dari Midtrans
    const urlParams = new URLSearchParams(window.location.search);
    const transactionStatus = urlParams.get('transaction_status');
    const orderId = urlParams.get('order_id');
    
    if (transactionStatus && orderId) {
        // Ini adalah redirect dari Midtrans, arahkan ke route yang sesuai
        const statusMap = {
            'settlement': 'success',
            'capture': 'success',
            'pending': 'pending',
            'deny': 'error',
            'expire': 'error',
            'cancel': 'error'
        };
        const status = statusMap[transactionStatus] || 'error';
        window.location.href = `/payment/${status}/${orderId}`;
    }
});

// Mengekspos fungsi secara global ke objek window agar pemanggilan inline HTML tetap bekerja
window.addToCart = addToCart;
window.updateQuantity = updateQuantity;
window.filterCategory = filterCategory;
window.searchMenu = searchMenu;
window.processCheckout = processCheckout;
window.closeReceiptModal = closeReceiptModal;
window.toggleHistoryModal = toggleHistoryModal;