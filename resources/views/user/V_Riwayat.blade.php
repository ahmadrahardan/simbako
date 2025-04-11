@extends('master.public')
@section('title', 'Riwayat')
@section('content')

    <section class="font-sans min-h-screen bg-cover bg-center"
        style="background-image: url({{ asset('assets/background_1.png') }})">

        <!-- Header -->
        @include('master.navbar')

        <!-- Main Content -->
        <div class="flex flex-col items-center justify-center min-h-screen pt-20 px-8 relative z-10">
            <div class="h-[5%] w-full bg-gradient-to-t from-slate-950 to-transparent absolute bottom-0 z-10"></div>
            <img src="{{ asset('assets/Ornament.png') }}" alt="" class="h-[1012px] w-[1440px] absolute bottom-0">

            <div class="bg-white/10 backdrop-blur-md border border-white/60 rounded-2xl shadow-lg p-6 w-full max-w-5xl">
                <h2 class="text-xl font-semibold text-white pl-4 mb-4">Riwayat Pengajuan</h2>
                <div class="overflow-y-auto max-h-[300px] min-h-[300px] px-4 custom-scrollbar">
                    <table class="min-w-full text-sm text-white">
                        <thead>
                            <tr class="border-b border-white/60 text-left">
                                <th class="p-3">No.</th>
                                <th class="p-3">Tanggal</th>
                                <th class="p-3">Kode Pengajuan</th>
                                <th class="p-3">Status</th>
                                <th class="p-3">Topik</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/60">
                            @forelse ($data as $index => $item)
                                <tr class="hover:bg-white/10 transition">
                                    <td class="p-3">{{ $index + 1 }}</td>
                                    <td class="p-3">
                                        <div class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-md text-sm">
                                            {{ $item->created_at->format('d-m-Y') }}
                                        </div>
                                    </td>
                                    <td class="p-3">{{ $item->id }}</td> {{-- atau $item->kode jika ada --}}
                                    <td class="p-3 flex items-center gap-2">
                                        @php
                                            $warna = match($item->status) {
                                                'Disetujui' => 'bg-green-500',
                                                'Ditolak' => 'bg-red-500',
                                            };
                                        @endphp
                                        <span class="w-3 h-3 rounded-full {{ $warna }}"></span>
                                        {{ $item->status }}
                                    </td>
                                    <td class="p-3">{{ $item->topik }}</td>
                                    <td class="p-3 text-center">
                                        <a href="#"
                                            class="bg-green-500 hover:bg-green-700 text-white px-4 py-1 rounded-md transition">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-3 text-center text-gray-400">Belum ada riwayat pengajuan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <style>
                    /* Scrollbar container */
                    .custom-scrollbar::-webkit-scrollbar {
                        width: 6px;
                    }

                    /* Track (latar belakang) */
                    .custom-scrollbar::-webkit-scrollbar-track {
                        background: transparent;
                    }

                    /* Thumb (batangnya) */
                    .custom-scrollbar::-webkit-scrollbar-thumb {
                        background-color: rgba(255, 255, 255, 0.4);
                        /* warna putih transparan */
                        border-radius: 9999px;
                    }
                </style>
            </div>
        </div>

        {{-- Footer --}}
        @include('master.footer')
    </section>
@endsection
