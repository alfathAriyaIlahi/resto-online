@extends('layouts.app')

@section('content')
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
        <a class="inline-block rounded border border-gray-200 px-5 py-3 font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 hover:text-gray-900" href="#reservasi-form">
          Reservasi Meja
        </a>
      </div>
    </div>
  </div>
</section>

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

<section id="menu">
  <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
    <header>
      <h2 class="text-xl font-bold text-gray-900 sm:text-3xl text-left">Katalog Menu</h2>
    </header>

    <div class="mt-4 lg:mt-8 lg:grid lg:grid-cols-4 lg:items-start lg:gap-8">
      <div class="hidden space-y-4 lg:block text-left">
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

      <div class="lg:col-span-3">
        @foreach($kategoris as $kat)
          <div id="kat-{{ $kat->id }}" class="mb-12">
            <h3 class="mb-6 text-lg font-bold text-orange-600 border-b-2 border-orange-100 pb-2 uppercase tracking-widest text-left">{{ $kat->nama_kategori }}</h3>
            <ul class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
              @foreach($kat->produks as $produk)
                <li>
                  <div class="group relative block rounded-2xl border border-gray-100 overflow-hidden bg-white shadow-sm transition hover:shadow-xl product-card"
                       data-id="{{ $produk->id }}"
                       data-options='@json($produk->options)'>
                    <span class="absolute top-4 right-4 rounded-full bg-orange-600 px-4 py-1 font-bold text-white z-10 text-sm shadow-md">
                      Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </span>
                    <div class="h-56 w-full overflow-hidden">
                        <img src="{{ asset('storage/' . $produk->foto) }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                    </div>
                    <div class="p-6 text-left">
                      <strong class="text-xl font-bold text-gray-900 capitalize"> {{ $produk->nama_produk }} </strong>
                      <p class="mt-2 text-sm text-gray-600">Pilih topping dan ukuran sesukamu.</p>
                      <button type="button" onclick="addToCart({{ $produk->id }}, '{{ $produk->nama_produk }}', {{ $produk->harga }}, '{{ asset('storage/' . $produk->foto) }}')" class="mt-6 block w-full text-center rounded-lg border border-orange-600 bg-orange-600 px-5 py-3 text-sm font-bold text-white uppercase transition hover:bg-transparent hover:text-orange-600">
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

<div id="reservasi-form" class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 mb-20">
    <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
        <div class="md:py-4 text-left">
            <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">Reservasi Meja Saja</h2>
            <p class="mt-4 text-pretty text-gray-700 text-sm">Pastikan tempat Anda tersedia. Silakan isi formulir di bawah ini untuk memesan meja saja tanpa menu.</p>
        </div>
        <div>
            @auth
                <form action="{{ route('reservasi.store') }}" method="POST" class="space-y-4 rounded-2xl border border-gray-200 bg-white p-8 shadow-xl shadow-gray-200/50">
                    @csrf
                    <input type="hidden" name="alamat" value="{{ Auth::user()->alamat }}">

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="text-left">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 ml-1">Nama</label>
                            <input name="nama" class="w-full rounded-xl border-gray-200 p-4 text-sm outline-none border bg-gray-50 transition" type="text" value="{{ Auth::user()->name }}" required readonly>
                        </div>
                        <div class="text-left">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 ml-1">Email</label>
                            <input name="email" class="w-full rounded-xl border-gray-200 p-4 text-sm outline-none border bg-gray-50 transition" type="email" value="{{ Auth::user()->email }}" required readonly>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 text-left">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 ml-1">Nomor HP</label>
                            <input name="nomor_hp" class="w-full rounded-xl border-gray-200 p-4 text-sm outline-none border bg-gray-50 transition" type="tel" value="{{ Auth::user()->nomor_hp }}" required readonly>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 ml-1">Jumlah Orang</label>
                            <input name="jumlah_orang" class="w-full rounded-xl border-gray-200 p-4 text-sm outline-none border focus:border-orange-500 transition" type="number" placeholder="Contoh: 4" required>
                        </div>
                    </div>
                    <div class="text-left">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 ml-1">Waktu Reservasi</label>
                        <input name="waktu_reservasi" class="w-full rounded-xl border-gray-200 p-4 text-sm outline-none border focus:border-orange-500 transition" type="datetime-local" required>
                    </div>
                    <div class="text-left">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 ml-1">Catatan Tambahan</label>
                        <textarea name="catatan" class="w-full rounded-xl border-gray-200 p-4 text-sm outline-none border focus:border-orange-500 transition" rows="3" placeholder="Contoh: Kursi bayi, meja pojok..."></textarea>
                    </div>
                    <button class="w-full rounded-xl bg-gray-900 py-4 text-sm font-bold text-white shadow-lg transition hover:bg-black active:scale-95" type="submit">Konfirmasi Reservasi Meja</button>
                </form>
            @else
                <div class="bg-gray-50 rounded-3xl p-12 border border-dashed border-gray-300 text-center">
                    <p class="text-gray-600 mb-6 text-sm">Silakan login terlebih dahulu untuk melakukan reservasi meja.</p>
                    <div class="flex gap-2 justify-center">
                        <a href="{{ route('login') }}" class="px-10 py-4 bg-orange-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-orange-100 hover:bg-orange-700 transition">Masuk Akun</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>

<button onclick="toggleCart()" class="fixed bottom-10 right-10 z-50 flex items-center gap-2 rounded-full bg-orange-600 px-6 py-4 text-white shadow-2xl hover:bg-orange-700 transition-all active:scale-95">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
    <span id="cart-count" class="font-bold">0</span>
</button>

<div id="option-modal" class="fixed inset-0 z-[80] hidden bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-3xl p-8 shadow-2xl relative animate-fadeIn">
        <h3 id="modal-product-name" class="text-xl font-black text-gray-900 uppercase mb-6 text-left">Pilih Opsi</h3>

        <div id="option-container" class="max-h-[50vh] overflow-y-auto">
            </div>

        <div class="mt-8 flex gap-3">
            <button onclick="document.getElementById('option-modal').classList.add('hidden')" class="flex-1 py-4 text-sm font-bold text-gray-400">Batal</button>
            <button id="confirm-option-btn" class="flex-[2] py-4 bg-orange-600 text-white rounded-2xl font-bold shadow-lg shadow-orange-100 transition hover:bg-orange-700">Tambahkan</button>
        </div>
    </div>
</div>

<div id="cart-modal" class="fixed inset-0 z-[60] hidden bg-gray-900/50 backdrop-blur-sm transition-opacity text-left">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative w-full max-w-2xl rounded-2xl bg-white p-8 shadow-2xl overflow-y-auto max-h-[85vh]">
            <button onclick="toggleCart()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>

            <header class="text-center mb-8 border-b border-gray-100 pb-4">
                <h1 class="text-2xl font-bold text-gray-900">Keranjang Belanja</h1>
            </header>

            <div id="cart-items-container">
                <div id="cart-empty" class="text-center py-16">
                    <p class="text-gray-500 mb-4 text-lg">Yah, keranjangnya masih kosong...</p>
                </div>

                <ul id="cart-list" class="space-y-6 hidden mb-8"></ul>

                <div id="cart-footer" class="mt-8 border-t border-gray-100 pt-8 hidden text-left">
                    <form id="form-pesanan">
                        @csrf

                        <div class="mb-6">
                            <label class="block text-xs font-bold text-gray-500 mb-3 uppercase tracking-wider">Metode Pengantaran</label>
                            <div class="flex gap-4">
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="metode_pengiriman" value="ambil_sendiri" class="peer hidden" checked onclick="toggleAlamat(false)">
                                    <div class="text-center p-3 rounded-xl border-2 peer-checked:border-orange-600 peer-checked:bg-orange-50 font-bold text-gray-700 text-sm">Ambil Sendiri</div>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="metode_pengiriman" value="pesan_antar" class="peer hidden" onclick="toggleAlamat(true)">
                                    <div class="text-center p-3 rounded-xl border-2 peer-checked:border-orange-600 peer-checked:bg-orange-50 font-bold text-gray-700 text-sm">Pesan Antar</div>
                                </label>
                            </div>
                        </div>

                        <div id="alamat-container" class="hidden mb-6">
                            <label class="block text-xs font-bold text-gray-500 mb-1 uppercase tracking-wider">Alamat Lengkap Pengiriman</label>
                            <textarea name="alamat_lengkap" id="input_alamat" class="w-full rounded-xl border-gray-200 p-3 text-sm border outline-none focus:border-orange-500" rows="2" placeholder="Masukkan alamat pengantaran...">@auth {{ Auth::user()->alamat }} @endauth</textarea>
                        </div>

                        <div class="mb-6">
                            <label class="block text-xs font-bold text-gray-500 mb-1 uppercase tracking-wider">Kode Promo</label>
                            <div class="flex gap-2">
                                <input type="text" id="input_promo" name="kode_promo" class="flex-1 rounded-xl border-gray-200 p-3 text-sm border outline-none" placeholder="Masukkan kode promo...">
                                <button type="button" onclick="cekPromo()" class="bg-gray-800 text-white px-5 rounded-xl text-sm font-bold transition hover:bg-gray-900">Cek</button>
                            </div>
                            <p id="promo-msg" class="text-[10px] mt-1 hidden font-medium"></p>
                        </div>

                        <div id="hidden-inputs"></div>

                        <div class="flex justify-between items-center text-xl font-bold text-gray-900 mb-8 bg-gray-50 p-4 rounded-xl">
                            <span class="text-gray-600">Total Harga</span>
                            <span id="total-harga-display" class="text-orange-600">Rp 0</span>
                            <input type="hidden" name="total_harga" id="total-harga-input">
                        </div>

                        @auth
                            <button type="submit" id="btn-konfirmasi" class="w-full rounded-xl bg-orange-600 px-5 py-4 font-bold text-white shadow-lg transition hover:bg-orange-700">
                                Konfirmasi & Bayar Sekarang
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="block w-full text-center py-4 bg-gray-800 text-white rounded-xl font-bold">Login untuk Memesan</a>
                        @endauth
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let cart = [];

    window.toggleCart = function() {
        document.getElementById('cart-modal').classList.toggle('hidden');
    }

    window.addToCart = function(id, name, price, img) {
        const productCard = document.querySelector(`.product-card[data-id="${id}"]`);

        let options = [];
        try {
            options = JSON.parse(productCard.getAttribute('data-options') || '[]');
        } catch (e) {
            console.error("Error parsing options", e);
        }

        if (options && options.length > 0) {
            showOptionModal(id, name, price, img, options);
        } else {
            const cartId = `prod-${id}`;
            const item = cart.find(i => i.cartId === cartId);
            if (item) {
                item.jumlah++;
            } else {
                cart.push({ cartId, id, name, price, img, jumlah: 1 });
            }
            renderCart();
        }
    }

    function showOptionModal(id, name, price, img, options) {
        const modal = document.getElementById('option-modal');
        const container = document.getElementById('option-container');
        document.getElementById('modal-product-name').innerText = name;
        container.innerHTML = '';

        const groups = options.reduce((acc, opt) => {
            (acc[opt.jenis] = acc[opt.jenis] || []).push(opt);
            return acc;
        }, {});

        for (const [jenis, items] of Object.entries(groups)) {
            let html = `<div class="mb-5 text-left">
                <h4 class="text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">${jenis}</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">`;

            items.forEach(item => {
                html += `
                    <label class="cursor-pointer group">
                        <input type="${jenis === 'size' ? 'radio' : 'checkbox'}"
                               name="${jenis}"
                               value="${item.id}"
                               data-nama="${item.nama_opsi}"
                               data-harga="${item.harga_tambahan}"
                               class="peer hidden" ${jenis === 'size' ? 'required' : ''}>
                        <div class="p-4 border border-gray-100 rounded-2xl text-sm font-bold transition peer-checked:border-orange-600 peer-checked:bg-orange-50 group-hover:bg-gray-50">
                            <div class="flex justify-between items-center">
                                <span>${item.nama_opsi}</span>
                                <span class="text-orange-600 text-[10px]">+Rp ${parseInt(item.harga_tambahan).toLocaleString('id-ID')}</span>
                            </div>
                        </div>
                    </label>`;
            });
            html += `</div></div>`;
            container.innerHTML += html;
        }

        document.getElementById('confirm-option-btn').onclick = () => finalizeAddToCart(id, name, price, img);
        modal.classList.remove('hidden');
    }

    function finalizeAddToCart(id, name, price, img) {
        const selected = [];
        let extraPrice = 0;

        const inputs = document.querySelectorAll('#option-container input:checked');

        // Cek jika ada group 'size' tapi belum dipilih
        const hasSize = document.querySelector('#option-container input[name="size"]');
        const sizeSelected = document.querySelector('#option-container input[name="size"]:checked');

        if (hasSize && !sizeSelected) {
            alert("Silakan pilih ukuran terlebih dahulu!");
            return;
        }

        inputs.forEach(input => {
            selected.push(input.getAttribute('data-nama'));
            extraPrice += parseFloat(input.getAttribute('data-harga'));
        });

        const finalPrice = price + extraPrice;
        const optionString = selected.join(', ');
        const cartId = `prod-${id}-${selected.sort().join('-')}`;

        const item = cart.find(i => i.cartId === cartId);
        if (item) {
            item.jumlah++;
        } else {
            cart.push({
                cartId, id,
                name: name + (optionString ? ` [${optionString}]` : ''),
                price: finalPrice,
                img, jumlah: 1
            });
        }

        document.getElementById('option-modal').classList.add('hidden');
        renderCart();
    }

    window.updateQty = function(id, delta) {
        const item = cart.find(i => i.cartId === id);
        if (item) {
            item.jumlah += delta;
            if (item.jumlah < 1) cart = cart.filter(i => i.cartId !== id);
        }
        renderCart();
    }

    window.toggleAlamat = function(show) {
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

    window.cekPromo = function() {
        const kodeInput = document.getElementById('input_promo');
        const kode = kodeInput.value.toUpperCase();
        const totalAsli = cart.reduce((sum, item) => sum + (item.price * item.jumlah), 0);
        const msg = document.getElementById('promo-msg');

        if (!kode) return alert("Masukkan kode promo!");
        if (totalAsli <= 0) return alert("Keranjang masih kosong!");

        fetch('/cek-kupon', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ kode: kode, total_belanja: totalAsli })
        })
        .then(res => res.json())
        .then(data => {
            msg.classList.remove('hidden');
            if (data.valid) {
                let diskon = data.nilai;
                if (data.jenis === 'persen') {
                    diskon = (totalAsli * data.nilai) / 100;
                }

                let totalBaru = totalAsli - diskon;

                document.getElementById('total-harga-display').innerText = 'Rp ' + totalBaru.toLocaleString('id-ID');
                document.getElementById('total-harga-input').value = totalBaru;

                msg.innerText = data.message + " (Potongan: Rp " + diskon.toLocaleString('id-ID') + ")";
                msg.className = 'text-[10px] mt-1 font-medium text-green-600';
                kodeInput.readOnly = true;
            } else {
                msg.innerText = data.message;
                msg.className = 'text-[10px] mt-1 font-medium text-red-500';
            }
        })
        .catch(() => alert("Terjadi kesalahan sistem saat cek kupon."));
    }

    function renderCart() {
        const cartList = document.getElementById('cart-list');
        const cartEmpty = document.getElementById('cart-empty');
        const cartFooter = document.getElementById('cart-footer');
        const cartCount = document.getElementById('cart-count');
        const hiddenInputs = document.getElementById('hidden-inputs');

        let total = 0;
        let count = 0;
        cartList.innerHTML = '';
        hiddenInputs.innerHTML = '';

        cart.forEach((item, index) => {
            total += (item.price * item.jumlah);
            count += item.jumlah;
            cartList.innerHTML += `
                <li class="flex items-center gap-4 py-2 border-b border-gray-50 text-left">
                    <img src="${item.img}" class="size-16 rounded-xl object-cover shadow-sm">
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-900 text-sm leading-tight">${item.name}</h3>
                        <p class="text-xs text-orange-600 font-semibold mt-1">Rp ${item.price.toLocaleString('id-ID')}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="updateQty('${item.cartId}', -1)" class="size-7 rounded-full border border-gray-200 hover:bg-gray-100">-</button>
                        <span class="font-bold text-sm">${item.jumlah}</span>
                        <button type="button" onclick="updateQty('${item.cartId}', 1)" class="size-7 rounded-full border border-orange-200 text-orange-600 hover:bg-orange-50">+</button>
                    </div>
                </li>`;

            hiddenInputs.innerHTML += `
                <input type="hidden" name="items[${index}][produk_id]" value="${item.id}">
                <input type="hidden" name="items[${index}][nama_produk]" value="${item.name}">
                <input type="hidden" name="items[${index}][jumlah]" value="${item.jumlah}">
                <input type="hidden" name="items[${index}][subtotal]" value="${item.price * item.jumlah}">`;
        });

        cartCount.innerText = count;
        document.getElementById('total-harga-display').innerText = 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('total-harga-input').value = total;

        const inputPromo = document.getElementById('input_promo');
        const msgPromo = document.getElementById('promo-msg');
        if (inputPromo.readOnly) {
            inputPromo.readOnly = false;
            inputPromo.value = '';
            msgPromo.classList.add('hidden');
        }

        if (cart.length > 0) {
            cartList.classList.remove('hidden');
            cartFooter.classList.remove('hidden');
            cartEmpty.classList.add('hidden');
        } else {
            cartList.classList.add('hidden');
            cartFooter.classList.add('hidden');
            cartEmpty.classList.remove('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('btn-konfirmasi');
        if (btn) {
            btn.onclick = function(e) {
                e.preventDefault();
                const total = document.getElementById('total-harga-input').value;
                if (total <= 0) return alert("Keranjang masih kosong!");

                btn.innerText = "Memproses...";
                btn.disabled = true;

                const form = document.getElementById('form-pesanan');
                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());
                data.items = cart;

                fetch('/pesan', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                })
                .then(res => res.json())
                .then(resData => {
                    btn.innerText = "Konfirmasi & Bayar Sekarang";
                    btn.disabled = false;
                    if (resData.snap_token) {
                        window.snap.pay(resData.snap_token, {
                            onSuccess: function() { window.location.href = '/dashboard'; },
                            onPending: function() { window.location.reload(); }
                        });
                    }
                })
                .catch(() => {
                    btn.innerText = "Konfirmasi & Bayar Sekarang";
                    btn.disabled = false;
                    alert("Kesalahan koneksi.");
                });
            };
        }
    });
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-fadeIn { animation: fadeIn 0.2s ease-out forwards; }
    [x-cloak] { display: none !important; }
</style>
@endsection
