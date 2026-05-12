@extends('layouts.admin')

@section('admin_content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h1>
    <p class="text-gray-600 mt-1">Total pelanggan terdaftar: <span class="font-bold text-orange-600 text-lg">{{ $total_users }}</span> orang</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="py-4 px-6 text-sm font-semibold text-gray-600">No</th>
                    <th class="py-4 px-6 text-sm font-semibold text-gray-600">Nama Lengkap</th>
                    <th class="py-4 px-6 text-sm font-semibold text-gray-600">Email</th>
                    <th class="py-4 px-6 text-sm font-semibold text-gray-600">No. HP</th>
                    <th class="py-4 px-6 text-sm font-semibold text-gray-600">Alamat Lengkap</th>
                    <th class="py-4 px-6 text-sm font-semibold text-gray-600">Tgl. Daftar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($users as $index => $user)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="py-4 px-6 text-sm text-gray-700">{{ $index + 1 }}</td>
                    <td class="py-4 px-6 text-sm font-bold text-gray-800 capitalize">{{ $user->name }}</td>
                    <td class="py-4 px-6 text-sm text-gray-600">{{ $user->email }}</td>
                    <td class="py-4 px-6 text-sm text-gray-600">{{ $user->nomor_hp ?? '-' }}</td>
                    <td class="py-4 px-6 text-sm text-gray-600 max-w-xs truncate" title="{{ $user->alamat }}">
                        {{ $user->alamat ?? 'Belum diisi' }}
                    </td>
                    <td class="py-4 px-6 text-sm text-gray-600">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-12 text-center text-gray-500 italic">Belum ada pengguna yang mendaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
