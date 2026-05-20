<x-app-layout>

    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-yellow-50 py-14">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="rounded-[36px] bg-gradient-to-br from-orange-500 via-orange-400 to-yellow-300 p-10 shadow-2xl">

                <h1 class="text-4xl font-black text-white">
                    Selamat Datang, {{ Auth::user()->name }}!
                </h1>

                <p class="mt-3 text-orange-50">
                    Akun Anda berhasil masuk. Silakan  ke halaman utama untuk memesan menu atau melakukan reservasi.
                </p>

                <div class="mt-8">
                    <a href="{{ route('home') }}"
                       class="inline-flex rounded-2xl bg-white px-6 py-4 text-sm font-black text-orange-600 shadow-lg transition hover:bg-orange-50">
                        Pesan Sekarang!
                    </a>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>