<section id="menu" class="relative overflow-hidden bg-gradient-to-br from-orange-50 via-white to-orange-100 py-20">

  {{-- BACKGROUND GLOW --}}
  <div class="absolute top-0 right-0 h-[500px] w-[500px] rounded-full bg-orange-300/20 blur-3xl"></div>

  <div class="absolute bottom-0 left-0 h-[500px] w-[500px] rounded-full bg-yellow-300/20 blur-3xl"></div>

  {{-- CONTENT --}}
  <div class="relative z-10 mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <header class="mb-14 text-center">

      <span class="rounded-full bg-orange-100 px-5 py-2 text-sm font-bold tracking-wide text-orange-600 shadow-sm">
        OUR MENU
      </span>

      <h2 class="mt-5 text-5xl font-black tracking-tight text-gray-900">
        Katalog Menu
      </h2>

      <p class="mx-auto mt-4 max-w-2xl text-base leading-relaxed text-gray-600">
        Temukan berbagai pilihan makanan dan minuman favorit dengan kualitas terbaik.
      </p>

    </header>

    <div class="grid gap-10 lg:grid-cols-4">

      {{-- SIDEBAR --}}
      <aside class="hidden lg:block">

        <div class="sticky top-28 rounded-3xl border border-white/50 bg-white/70 p-6 shadow-2xl backdrop-blur-xl">

          <p class="mb-5 text-xs font-black uppercase tracking-[0.25em] text-gray-500">
            Kategori
          </p>

          <ul class="space-y-3">

            <li>
              <a href="#menu"
                 class="block rounded-2xl bg-orange-100 px-5 py-4 text-sm font-bold text-orange-600 shadow-sm transition-all duration-300 hover:bg-orange-200 hover:translate-x-1">
                Semua Menu
              </a>
            </li>

            @foreach($kategoris as $kat)

              <li>
                <a href="#kat-{{ $kat->id }}"
                   class="block rounded-2xl px-5 py-4 text-sm font-semibold text-gray-700 transition-all duration-300 hover:bg-orange-50 hover:text-orange-600 hover:translate-x-1">

                  {{ $kat->nama_kategori }}

                </a>
              </li>

            @endforeach

          </ul>

        </div>

      </aside>

      {{-- PRODUCT --}}
      <div class="lg:col-span-3">

        @forelse($kategoris as $kat)

          <div id="kat-{{ $kat->id }}" class="mb-16">

            <div class="mb-8 flex items-center gap-4">

              <div class="h-10 w-2 rounded-full bg-orange-500"></div>

              <h3 class="text-2xl font-black text-gray-900">
                {{ $kat->nama_kategori }}
              </h3>

            </div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

              @forelse($kat->produks as $produk)

                <div class="group overflow-hidden rounded-[28px] border border-white/60 bg-white/80 shadow-2xl backdrop-blur-xl transition-all duration-500 hover:-translate-y-3 hover:shadow-orange-200/60">

                  {{-- IMAGE --}}
                  <div class="relative h-56 overflow-hidden">

                    @if($produk->foto)

                      <img src="{{ asset('storage/' . $produk->foto) }}"
                           alt="{{ $produk->nama_produk }}"
                           class="h-full w-full object-cover transition duration-700 group-hover:scale-110">

                    @else

                      <div class="flex h-full items-center justify-center bg-gray-100 text-sm font-semibold text-gray-400">
                        Tidak ada gambar
                      </div>

                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>

                    <span class="absolute right-4 top-4 rounded-full bg-orange-600 px-4 py-2 text-xs font-black tracking-wide text-white shadow-xl">

                      Rp {{ number_format($produk->harga, 0, ',', '.') }}

                    </span>

                  </div>

                  {{-- CONTENT --}}
                  <div class="p-6">

                    <h4 class="text-xl font-black capitalize text-gray-900">

                      {{ $produk->nama_produk }}

                    </h4>

                    <p class="mt-3 text-sm leading-relaxed text-gray-600">
                      Nikmati cita rasa terbaik dengan pilihan topping dan ukuran favorit Anda.
                    </p>

                    <button type="button"
                            onclick="addToCart(
                              {{ $produk->id }},
                              @js($produk->nama_produk),
                              {{ $produk->harga }},
                              @js(asset('storage/' . $produk->foto))
                            )"
                            class="mt-6 w-full rounded-2xl bg-orange-600 px-5 py-4 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-orange-200 transition-all duration-300 hover:-translate-y-1 hover:bg-orange-700 active:scale-95">

                      Tambah ke Keranjang

                    </button>

                  </div>

                </div>

              @empty

                <div class="rounded-3xl border border-dashed border-gray-300 bg-white/80 p-14 text-center shadow-xl backdrop-blur-xl sm:col-span-2 lg:col-span-3">

                  <h4 class="text-2xl font-black text-gray-900">
                    Menu belum tersedia
                  </h4>

                  <p class="mt-4 text-sm text-gray-600">
                    Produk pada kategori ini belum ditambahkan.
                  </p>

                </div>

              @endforelse

            </div>

          </div>

        @empty

          <div class="rounded-3xl border border-dashed border-gray-300 bg-white/80 p-16 text-center shadow-2xl backdrop-blur-xl">

            <h3 class="text-3xl font-black text-gray-900">
              Katalog menu masih kosong
            </h3>

            <p class="mt-4 text-sm text-gray-600">
              Belum ada kategori atau produk yang ditambahkan.
            </p>

          </div>

        @endforelse

      </div>

    </div>

  </div>

</section>