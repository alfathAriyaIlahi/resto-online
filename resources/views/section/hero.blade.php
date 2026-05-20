<section class="relative overflow-hidden bg-gradient-to-br from-orange-50 via-white to-orange-100 lg:min-h-screen lg:grid lg:place-content-center">

  <style>
    @keyframes moveBlob {
      0%, 100% { transform: translate(0, 0) scale(1); }
      50% { transform: translate(40px, -30px) scale(1.15); }
    }

    @keyframes bgZoom {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.08); }
    }

    .blob-animate {
      animation: moveBlob 7s ease-in-out infinite;
    }

    .bg-zoom {
      animation: bgZoom 12s ease-in-out infinite;
    }
  </style>

  <div class="absolute inset-0">
    <img src="{{ asset('images/makanann.webp') }}"
         alt="Background Food"
         class="h-full w-full object-cover opacity-50 bg-zoom">
  </div>

  <div class="absolute inset-0 bg-white/75"></div>

  <div class="absolute -top-24 -left-24 h-72 w-72 rounded-full bg-orange-300/30 blur-3xl blob-animate"></div>
  <div class="absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-yellow-300/30 blur-3xl blob-animate"></div>

  <div class="relative mx-auto w-screen max-w-7xl px-4 py-20 sm:px-6 sm:py-28 lg:px-8 lg:py-36">
    <div class="mx-auto max-w-3xl text-center">

      <span class="inline-flex items-center rounded-full border border-orange-200 bg-white/80 px-5 py-2 text-sm font-bold tracking-wide text-orange-600 shadow-lg backdrop-blur-sm">
        PREMIUM FOOD EXPERIENCE
      </span>

      <h1 class="mt-8 text-4xl font-black leading-tight tracking-tight text-gray-900 sm:text-6xl">
        Nikmati Hidangan Lezat &
        <strong class="bg-gradient-to-r from-orange-500 to-orange-700 bg-clip-text text-transparent">
          Berkualitas
        </strong>
        Setiap Hari
      </h1>

      <p class="mx-auto mt-6 max-w-2xl text-base leading-relaxed text-gray-600 sm:text-lg">
        Kami menyajikan berbagai menu pilihan dengan bahan segar dan bumbu autentik untuk memanjakan lidah Anda.
      </p>

      <div class="mt-10 flex flex-col justify-center gap-4 sm:flex-row">
        <a class="inline-flex items-center justify-center rounded-2xl bg-orange-600 px-8 py-4 font-bold text-white shadow-2xl shadow-orange-200 transition-all duration-300 hover:-translate-y-1 hover:bg-orange-700 active:scale-95"
           href="#menu">
          Pesan Sekarang
        </a>

        <a class="inline-flex items-center justify-center rounded-2xl border border-white/40 bg-white/70 px-8 py-4 font-bold text-gray-700 shadow-xl backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:text-orange-600 active:scale-95"
           href="#reservasi-form">
          Reservasi Meja
        </a>
      </div>

    </div>
  </div>

</section>