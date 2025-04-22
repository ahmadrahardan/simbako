@extends('master.public')
@section('title', 'Jadwal')
@section('content')

    <section x-data="pengajuanModal" class="font-sans min-h-screen bg-cover bg-center relative"
        style="background-image: url({{ asset('assets/background_1.png') }})">

        <!-- Header -->
        @include('master.navbar')

        <!-- Main Content -->
        <div class="flex flex-col items-center justify-center min-h-screen pt-20 px-8 relative z-10">
            <div class="h-[5%] w-full bg-gradient-to-t from-slate-950 to-transparent absolute bottom-0 z-10"></div>
            <img src="{{ asset('assets/Ornament.png') }}" alt="" class="h-[1012px] w-[1440px] absolute bottom-0">

            <!-- Box Header Jadwal -->
            <div class="w-full max-w-5xl bg-white/10 border border-white/30 backdrop-blur-md rounded-xl p-6 mb-6 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold">Jadwal Pelatihan</h3>
                        <p class="text-sm text-white/80">Temukan jadwal pelatihan sesuai dengan agendamu!</p>
                    </div>
                    <div>
                        <label class="block text-sm font-light mb-1">Pilih Bulan:</label>
                        <select
                            class="bg-white/20 text-white border border-white/40 px-3 py-1 rounded-md focus:outline-none focus:ring-2 focus:ring-white/50">
                            <option>Bulan ini</option>
                            <option>Bulan depan</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Container Scroll Kartu Pelatihan -->
            <div class="w-full max-w-5xl h-[250px] overflow-y-auto px-2 custom-scrollbar space-y-4">
                @for ($i = 0; $i < 3; $i++)
                    <!-- Simulasi 5 card, akan scroll -->
                    <div class="bg-white/10 border border-white/30 backdrop-blur-md rounded-xl p-5 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="h-2 w-2 bg-green-500 rounded-full"></span>
                                    <span class="text-sm text-white/80">Buka</span>
                                </div>
                                <h4 class="text-lg font-semibold">Strategi Pemasaran Cerutu Global</h4>
                                <p class="text-sm text-white/70">Dinas Perindustrian dan Perdagangan Jember</p>
                            </div>
                            <a href="#"
                                class="bg-green-600 hover:bg-green-700 px-4 py-1 rounded-md text-sm font-medium text-white shadow">
                                Detail
                            </a>
                        </div>
                    </div>
                @endfor
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
            {{-- @foreach ($pelatihans as $item)
                <div
                    class="w-full max-w-5xl bg-white/10 border border-white/30 backdrop-blur-md rounded-xl p-5 mb-4 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="h-2 w-2 bg-green-500 rounded-full"></span>
                                <span class="text-sm text-white/80">Buka</span>
                            </div>
                            <h4 class="text-lg font-semibold">{{ $item->judul }}</h4>
                            <p class="text-sm text-white/70">{{ $item->penyelenggara }}</p>
                        </div>
                        <a href="{{ route('pelatihan.detail', $item->id) }}"
                            class="bg-green-600 hover:bg-green-700 px-4 py-1 rounded-md text-sm font-medium text-white shadow">
                            Detail
                        </a>
                    </div>
                </div>
            @endforeach --}}
        </div>

        <!-- Footer -->
        @include('master.footer')
    </section>
@endsection
