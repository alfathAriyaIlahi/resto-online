<section id="reservasi-form" class="relative overflow-hidden bg-gradient-to-br from-orange-50 via-white to-yellow-50 py-24">

  <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-orange-300/20 blur-3xl"></div>
  <div class="absolute -bottom-40 -left-40 h-[500px] w-[500px] rounded-full bg-yellow-300/20 blur-3xl"></div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <div class="mb-14 text-center">
      <span class="rounded-full bg-orange-100 px-5 py-2 text-sm font-bold tracking-wide text-orange-600 shadow-sm">
        RESERVASI
      </span>

      <h2 class="mt-5 text-4xl font-black tracking-tight text-gray-900">
        Reservasi Meja
      </h2>

      <p class="mx-auto mt-4 max-w-2xl text-sm leading-relaxed text-gray-600">
        Pastikan tempat Anda tersedia dengan melakukan reservasi meja secara cepat dan praktis.
      </p>
    </div>

    <div class="grid grid-cols-1 gap-10 lg:grid-cols-3">

      <div class="rounded-3xl border border-white/60 bg-white/75 p-8 shadow-2xl backdrop-blur-xl lg:col-span-1">
        <h3 class="text-2xl font-black text-gray-900">
          Informasi Reservasi
        </h3>

        <p class="mt-4 text-sm leading-relaxed text-gray-600">
          Isi data reservasi dengan benar agar tim kami dapat menyiapkan meja sesuai kebutuhan Anda.
        </p>

        <div class="mt-8 space-y-5">
          <div class="rounded-2xl bg-orange-50 p-5">
            <h4 class="font-bold text-gray-900">
              Reservasi Praktis
            </h4>
            <p class="mt-2 text-sm text-gray-600">
              Pesan meja tanpa harus datang langsung ke restoran.
            </p>
          </div>

          <div class="rounded-2xl bg-yellow-50 p-5">
            <h4 class="font-bold text-gray-900">
              Data Otomatis
            </h4>
            <p class="mt-2 text-sm text-gray-600">
              Nama, email, dan nomor HP akan otomatis mengikuti akun Anda.
            </p>
          </div>

          <div class="rounded-2xl bg-gray-50 p-5">
            <h4 class="font-bold text-gray-900">
              Konfirmasi Cepat
            </h4>
            <p class="mt-2 text-sm text-gray-600">
              Reservasi akan tersimpan dan dapat dikelola oleh pihak restoran.
            </p>
          </div>
        </div>
      </div>

      <div class="lg:col-span-2">
        @auth
          <form action="{{ route('reservasi.store') }}" method="POST" class="space-y-6 rounded-3xl border border-white/60 bg-white/85 p-8 shadow-2xl backdrop-blur-xl">
            @csrf

            <input type="hidden" name="alamat" value="{{ Auth::user()->alamat }}">

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
              <div>
                <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                  Nama
                </label>
                <input name="nama" class="w-full rounded-2xl border border-gray-200 bg-gray-50 p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100" type="text" value="{{ Auth::user()->name }}" required readonly>
              </div>

              <div>
                <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                  Email
                </label>
                <input name="email" class="w-full rounded-2xl border border-gray-200 bg-gray-50 p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100" type="email" value="{{ Auth::user()->email }}" required readonly>
              </div>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
              <div>
                <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                  Nomor HP
                </label>
                <input name="nomor_hp" class="w-full rounded-2xl border border-gray-200 bg-gray-50 p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100" type="tel" value="{{ Auth::user()->nomor_hp }}" required readonly>
              </div>

              <div>
                <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                  Jumlah Orang
                </label>
                <input name="jumlah_orang" class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100" type="number" placeholder="Contoh: 4" required>
              </div>
            </div>

            <div>
              <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                Waktu Reservasi
              </label>
              <input name="waktu_reservasi" class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100" type="datetime-local" required>
            </div>

            <div>
              <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                Catatan Tambahan
              </label>
              <textarea name="catatan" class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100" rows="4" placeholder="Contoh: Kursi bayi, meja pojok, dekat jendela..."></textarea>
            </div>

            <button class="w-full rounded-2xl bg-orange-600 py-4 text-sm font-black uppercase tracking-wide text-white shadow-lg shadow-orange-200 transition-all duration-300 hover:-translate-y-1 hover:bg-orange-700 active:scale-95" type="submit">
              Konfirmasi Reservasi Meja
            </button>
          </form>
        @else
          <div class="rounded-3xl border border-dashed border-orange-200 bg-white/80 p-12 text-center shadow-2xl backdrop-blur-xl">
            <h3 class="text-2xl font-black text-gray-900">
              Login Diperlukan
            </h3>

            <p class="mx-auto mt-4 max-w-md text-sm leading-relaxed text-gray-600">
              Silakan login terlebih dahulu untuk melakukan reservasi meja.
            </p>

            <div class="mt-8 flex justify-center">
              <a href="{{ route('login') }}" class="rounded-2xl bg-orange-600 px-10 py-4 text-sm font-bold text-white shadow-lg shadow-orange-200 transition hover:bg-orange-700 active:scale-95">
                Masuk Akun
              </a>
            </div>
          </div>
        @endauth
      </div>

    </div>

  </div>

</section>