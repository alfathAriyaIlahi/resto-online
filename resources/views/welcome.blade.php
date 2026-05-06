@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-white lg:h-screen lg:grid lg:place-content-center">
  <div class="mx-auto w-screen max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8 lg:py-32">
    <div class="mx-auto max-w-prose text-center">
      <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl">
        Nikmati Hidangan Lezat &
        <strong class="text-orange-600"> Berkualitas </strong>
        Setiap Hari
      </h1>
      <p class="mt-4 text-base text-pretty text-gray-700 sm:text-lg/relaxed">
        Kami menyajikan berbagai menu pilihan dengan bahan segar dan bumbu autentik untuk memanjakan lidah Anda.
      </p>
      <div class="mt-4 flex justify-center gap-4 sm:mt-6">
        <a class="inline-block rounded border border-orange-600 bg-orange-600 px-5 py-3 font-medium text-white shadow-sm transition-colors hover:bg-orange-700" href="#menu">
          Pesan Sekarang
        </a>
        <a class="inline-block rounded border border-gray-200 px-5 py-3 font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 hover:text-gray-900" href="#">
          Tentang Kami
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Features Section -->
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
  <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
    <div class="flex items-start gap-4 rounded-lg border border-gray-200 p-6">
      <div class="inline-flex rounded-lg bg-gray-100 p-3 text-orange-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"></path>
        </svg>
      </div>
      <div>
        <h3 class="text-lg font-semibold text-gray-900">Pelayanan Cepat</h3>
        <p class="mt-2 text-pretty text-gray-700 text-sm">Pesanan Anda akan segera diproses oleh tim kami.</p>
      </div>
    </div>
    <div class="flex items-start gap-4 rounded-lg border border-gray-200 p-6">
      <div class="inline-flex rounded-lg bg-gray-100 p-3 text-orange-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"></path>
        </svg>
      </div>
      <div>
        <h3 class="text-lg font-semibold text-gray-900">Bahan Higienis</h3>
        <p class="mt-2 text-pretty text-gray-700 text-sm">Kualitas dan kebersihan bahan makanan selalu terjaga.</p>
      </div>
    </div>
  </div>
</div>

<!-- Katalog Menu Dinamis -->
<section id="menu">
  <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
    <header>
      <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">Katalog Menu</h2>
      <p class="mt-4 max-w-md text-gray-500">Pilih hidangan favorit Anda dari daftar menu kami.</p>
    </header>

    <div class="mt-4 lg:mt-8 lg:grid lg:grid-cols-4 lg:items-start lg:gap-8">
      <!-- Sidebar Kategori -->
      <div class="hidden space-y-4 lg:block">
        <div>
          <p class="block text-xs font-medium text-gray-700">Kategori</p>
          <ul class="mt-1 space-y-1">
            <li><a href="/" class="block rounded-sm bg-gray-100 p-2 text-sm font-medium">Semua Menu</a></li>
            @foreach($kategoris as $kat)
              <li>
                <a href="#kat-{{ $kat->id }}" class="block rounded-sm p-2 text-sm text-gray-700 hover:bg-gray-50">
                  {{ $kat->nama_kategori }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="lg:col-span-3">
        @foreach($kategoris as $kat)
          <div id="kat-{{ $kat->id }}" class="mb-12">
            <h3 class="mb-6 text-lg font-bold text-orange-600 border-b-2 border-orange-100 pb-2 uppercase tracking-widest">{{ $kat->nama_kategori }}</h3>
            <ul class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
              @foreach($kat->produks as $produk)
                <li>
                  <div class="group relative block rounded-2xl border border-gray-100 overflow-hidden bg-white shadow-sm transition hover:shadow-xl">
                    <span class="absolute top-4 right-4 rounded-full bg-orange-600 px-4 py-1 font-bold text-white z-10 text-sm shadow-md">
                      Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </span>
                    <div class="h-56 w-full overflow-hidden">
                        <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama_produk }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                    </div>
                    <div class="p-6 text-left">
                      <strong class="text-xl font-bold text-gray-900 capitalize"> {{ $produk->nama_produk }} </strong>
                      <p class="mt-2 text-sm text-gray-600">Disajikan segar dengan standar kualitas Resto Kita.</p>
                      <button onclick="addToCart({{ $produk->id }}, '{{ $produk->nama_produk }}', {{ $produk->harga }}, '{{ asset('storage/' . $produk->foto) }}')" class="mt-6 block w-full text-center rounded-lg border border-orange-600 bg-orange-600 px-5 py-3 text-sm font-bold text-white uppercase transition hover:bg-transparent hover:text-orange-600">
                        Tambah ke Keranjang
                      </button>
                    </div>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- Section Reservasi -->
<div id="reservasi-form" class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 mb-20">
    <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
        <div class="md:py-4">
            <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">Reservasi Meja</h2>
            <p class="mt-4 text-pretty text-gray-700 text-sm">Pastikan tempat Anda tersedia. Silakan isi formulir di bawah ini untuk memesan meja saja.</p>
        </div>
        <div>
            @auth
                <form action="{{ route('reservasi.store') }}" method="POST" class="space-y-4 rounded-2xl border border-gray-200 bg-gray-50 p-8 shadow-sm">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <input name="nama" class="w-full rounded-lg border-gray-300 p-3 text-sm outline-none border" type="text" value="{{ Auth::user()->name }}" required readonly>
                        <input name="email" class="w-full rounded-lg border-gray-300 p-3 text-sm outline-none border" type="email" value="{{ Auth::user()->email }}" required readonly>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <input name="nomor_hp" class="w-full rounded-lg border-gray-300 p-3 text-sm outline-none border" type="tel" placeholder="Nomor HP" required>
                        <input name="jumlah_orang" class="w-full rounded-lg border-gray-300 p-3 text-sm outline-none border" type="number" placeholder="Jumlah Orang" required>
                    </div>
                    <input name="waktu_reservasi" class="w-full rounded-lg border-gray-300 p-3 text-sm outline-none border" type="datetime-local" required>
                    <textarea name="catatan" class="w-full rounded-lg border-gray-300 p-3 text-sm outline-none border" rows="3" placeholder="Catatan"></textarea>
                    <button class="w-full rounded-lg bg-gray-800 py-4 text-sm font-bold text-white shadow-lg transition hover:bg-gray-900" type="submit">Reservasi Meja Saja</button>
                </form>
            @else
                <div class="bg-gray-50 rounded-2xl p-8 border border-dashed border-gray-300 text-center">
                    <p class="text-gray-600 mb-4">Silakan login terlebih dahulu untuk melakukan reservasi meja.</p>
                    <div class="flex gap-2 justify-center">
                        <a href="{{ route('login') }}" class="px-6 py-3 bg-gray-800 text-white rounded-xl text-sm font-bold">Masuk</a>
                        <a href="{{ route('register') }}" class="px-6 py-3 border border-gray-800 rounded-xl text-sm font-bold">Daftar</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>

<!-- Tombol Floating Keranjang -->
<button onclick="toggleCart()" class="fixed bottom-10 right-10 z-50 flex items-center gap-2 rounded-full bg-orange-600 px-6 py-4 text-white shadow-2xl hover:bg-orange-700 transition-all active:scale-95">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
    <span id="cart-count" class="font-bold">0</span>
</button>

<!-- Modal Keranjang -->
<div id="cart-modal" class="fixed inset-0 z-[60] hidden bg-gray-900/50 backdrop-blur-sm transition-opacity">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative w-full max-w-2xl rounded-2xl bg-white p-8 shadow-2xl overflow-y-auto max-h-[85vh]">
            <button onclick="toggleCart()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <header class="text-center mb-8 border-b border-gray-100 pb-4">
                <h1 class="text-2xl font-bold text-gray-900">Pesan Menu (Keranjang)</h1>
            </header>

            <div id="cart-items-container">
                <div id="cart-empty" class="text-center py-16">
                    <p class="text-gray-500 mb-4 text-lg">Yah, keranjangnya masih kosong...</p>
                    <button onclick="toggleCart()" class="text-orange-600 font-bold hover:underline">Pesan Yuk!</button>
                </div>

                <ul id="cart-list" class="space-y-6 hidden mb-8"></ul>

                <div id="cart-footer" class="mt-8 border-t border-gray-100 pt-8 hidden">
                    <form action="{{ route('pesan.store') }}" method="POST">
                        @csrf

                        <!-- Pilihan Metode (Indonesian) -->
                        <div class="mb-6">
                            <label class="block text-xs font-bold text-gray-500 mb-3 uppercase tracking-wider text-left">Pilih Cara Mendapatkan Pesanan</label>
                            <div class="flex gap-4">
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="metode_pengiriman" value="ambil_sendiri" class="peer hidden" checked onclick="toggleAlamat(false)">
                                    <div class="text-center p-3 rounded-xl border-2 peer-checked:border-orange-600 peer-checked:bg-orange-50 font-bold text-gray-700">Ambil Sendiri</div>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="metode_pengiriman" value="pesan_antar" class="peer hidden" onclick="toggleAlamat(true)">
                                    <div class="text-center p-3 rounded-xl border-2 peer-checked:border-orange-600 peer-checked:bg-orange-50 font-bold text-gray-700">Pesan Antar</div>
                                </label>
                            </div>
                        </div>

                        <!-- Alamat Container -->
                        <div id="alamat-container" class="hidden mb-6 text-left">
                            <label class="block text-xs font-bold text-gray-500 mb-1 uppercase tracking-wider">Alamat Lengkap Pengiriman</label>
                            <textarea name="alamat_lengkap" id="input_alamat" class="w-full rounded-xl border-gray-200 p-3 text-sm focus:border-orange-500 outline-none border" rows="3" placeholder="Masukkan alamat lengkap pengantaran..."></textarea>
                        </div>

                        <!-- Promo Section -->
                        <div class="mb-6 text-left">
                            <label class="block text-xs font-bold text-gray-500 mb-1 uppercase tracking-wider">Punya Kode Promo?</label>
                            <div class="flex gap-2">
                                <input type="text" id="input_promo" name="kode_promo" class="flex-1 rounded-xl border-gray-200 p-3 text-sm outline-none border" placeholder="Contoh: MAKANHEMAT">
                                <button type="button" onclick="cekPromo()" class="bg-gray-800 text-white px-5 rounded-xl text-sm font-bold">Cek</button>
                            </div>
                            <p id="promo-msg" class="text-[10px] mt-1 hidden font-medium"></p>
                        </div>

                        <div id="hidden-inputs"></div>

                        <div class="flex justify-between items-center text-xl font-bold text-gray-900 mb-8 bg-gray-50 p-4 rounded-xl">
                            <span class="text-gray-600">Total Harga</span>
                            <span id="cart-total-display" class="text-orange-600">Rp 0</span>
                            <input type="hidden" name="total_harga" id="total-harga-input">
                        </div>

                        @auth
                            <button type="submit" class="w-full rounded-xl bg-orange-600 px-5 py-4 font-bold text-white shadow-lg transition hover:bg-orange-700">
                                Konfirmasi & Kirim Pesanan
                            </button>
                        @else
                            <div class="p-4 border border-dashed border-gray-300 rounded-xl bg-gray-50 text-center">
                                <p class="text-sm text-gray-600 mb-3">Login dulu untuk memesan menu.</p>
                                <div class="flex gap-2">
                                    <a href="{{ route('login') }}" class="flex-1 py-3 bg-gray-800 text-white rounded-xl text-sm font-bold">Masuk</a>
                                    <a href="{{ route('register') }}" class="flex-1 py-3 border border-gray-800 rounded-xl text-sm font-bold text-gray-800">Daftar</a>
                                </div>
                            </div>
                        @endauth
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let cart = [];

    function toggleCart() {
        const modal = document.getElementById('cart-modal');
        modal.classList.toggle('hidden');
    }

    function addToCart(id, name, price, img) {
        const existingItem = cart.find(item => item.id === id);
        if (existingItem) {
            existingItem.jumlah++;
        } else {
            cart.push({ id, name, price, img, jumlah: 1 });
        }
        renderCart();
    }

    function updateQty(id, delta) {
        const item = cart.find(item => item.id === id);
        if (item) {
            item.jumlah += delta;
            if (item.jumlah < 1) {
                cart = cart.filter(i => i.id !== id);
            }
        }
        renderCart();
    }

    function toggleAlamat(show) {
        const container = document.getElementById('alamat-container');
        const input = document.getElementById('input_alamat');
        if (show) {
            container.classList.remove('hidden');
            input.setAttribute('required', 'true');
        } else {
            container.classList.add('hidden');
            input.removeAttribute('required');
            input.value = '';
        }
    }

    function cekPromo() {
        const kode = document.getElementById('input_promo').value.toUpperCase();
        const msg = document.getElementById('promo-msg');
        if (kode === 'MAKANHEMAT') {
            msg.innerText = 'Promo Aktif! Diskon akan dihitung saat konfirmasi.';
            msg.className = 'text-[10px] mt-1 font-medium text-green-600';
            msg.classList.remove('hidden');
        } else {
            msg.innerText = 'Kode tidak valid.';
            msg.className = 'text-[10px] mt-1 font-medium text-red-500';
            msg.classList.remove('hidden');
        }
    }

    function renderCart() {
        const cartList = document.getElementById('cart-list');
        const cartEmpty = document.getElementById('cart-empty');
        const cartFooter = document.getElementById('cart-footer');
        const cartCount = document.getElementById('cart-count');
        const hiddenInputs = document.getElementById('hidden-inputs');

        const currentCount = cart.reduce((sum, item) => sum + item.jumlah, 0);
        cartCount.innerText = currentCount;

        if (cart.length === 0) {
            cartList.classList.add('hidden');
            cartFooter.classList.add('hidden');
            cartEmpty.classList.remove('hidden');
            return;
        }

        cartEmpty.classList.add('hidden');
        cartList.classList.remove('hidden');
        cartFooter.classList.remove('hidden');

        cartList.innerHTML = '';
        hiddenInputs.innerHTML = '';
        let total = 0;

        cart.forEach((item, index) => {
            const subtotal = item.price * item.jumlah;
            total += subtotal;

            cartList.innerHTML += `
                <li class="flex items-center gap-4 py-2 border-b border-gray-50 last:border-0 text-left">
                    <img src="${item.img}" class="size-20 rounded-xl object-cover shadow-sm">
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-900 text-base">${item.name}</h3>
                        <p class="text-sm text-orange-600 font-semibold">Rp ${item.price.toLocaleString('id-ID')}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="button" onclick="updateQty(${item.id}, -1)" class="size-8 rounded-full border border-gray-200 flex items-center justify-center hover:bg-gray-100 text-gray-600 shadow-sm">-</button>
                        <span class="font-bold text-lg w-4 text-center">${item.jumlah}</span>
                        <button type="button" onclick="updateQty(${item.id}, 1)" class="size-8 rounded-full border border-orange-200 text-orange-600 flex items-center justify-center hover:bg-orange-50 font-bold shadow-sm">+</button>
                    </div>
                </li>
            `;

            hiddenInputs.innerHTML += `
                <input type="hidden" name="items[${index}][produk_id]" value="${item.id}">
                <input type="hidden" name="items[${index}][jumlah]" value="${item.jumlah}">
                <input type="hidden" name="items[${index}][subtotal]" value="${subtotal}">
            `;
        });

        document.getElementById('cart-total-display').innerText = 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('total-harga-input').value = total;
    }
</script>
@endsection
