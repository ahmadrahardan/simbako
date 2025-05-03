@extends('master.public')
@section('title', 'Jadwal')
@section('content')

    <section x-data="jadwalModal" class="font-sans min-h-screen bg-cover bg-center relative"
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
                        @php
                            $currentYear = now()->year;
                            $currentMonth = now()->month;
                        @endphp
                        <label class="block text-sm font-light mb-1 text-white">Pilih Bulan & Tahun:</label>
                        <select name="bulan_tahun" x-model="selectedMonthYear" @change="filterByMonthYear"
                            class="bg-green-500 text-white border border-white/40 px-3 py-1 rounded-md focus:outline-none focus:ring-2 focus:ring-white/50">
                            @for ($y = $currentYear; $y <= $currentYear + 2; $y++)
                                @for ($m = 1; $m <= 12; $m++)
                                    @php
                                        $value = sprintf('%04d-%02d', $y, $m);
                                        $label = \Carbon\Carbon::createFromDate($y, $m, 1)->translatedFormat('F Y');
                                    @endphp
                                    <option value="{{ $value }}" @selected($value === request('bulan', now()->format('Y-m')))>
                                        {{ $label }}
                                    </option>
                                @endfor
                            @endfor
                        </select>
                    </div>
                </div>
            </div>

            <!-- Container Scroll Kartu Pelatihan -->
            <div class="w-full max-w-5xl h-[240px] overflow-y-auto px-2 custom-scrollbar space-y-4">
                @foreach ($data as $item)
                    <!-- Simulasi 5 card, akan scroll -->
                    <div class="bg-white/10 border border-white/30 backdrop-blur-md h-[110px] rounded-xl p-5 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-white/70"><i class="fa fa-calendar mr-1"></i>
                                    {{ $item->tanggal }}</p>
                                <h4 class="text-lg font-semibold">{{ $item->topik }}</h4>
                                <p class="text-sm text-white/70"><i class="fa fa-map-marker mr-1"></i>
                                    {{ $item->lokasi }}</p>
                            </div>
                            <button
                                @click="openDetail({
                                    topik: '{{ $item->topik }}',
                                    deskripsi: '{{ $item->deskripsi }}',
                                    tanggal: '{{ $item->tanggal }}',
                                    lokasi: '{{ $item->lokasi }}',
                                    kuota: '{{ $item->kuota }}'
                                })"
                                class="bg-green-500 hover:bg-green-700 text-white px-4 py-1 rounded-md transition">
                                Detail
                            </button>
                        </div>
                    </div>
                @endforeach
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

        <!-- Modal Detail Jadwal -->
        <div x-show="showDetailModal" x-cloak x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
            <div @click.outside="showDetailModal = false"
                class="bg-white rounded-2xl p-8 w-[400px] max-w-full relative text-gray-800 shadow-xl bg-fit bg-center"
                style="background-image: url('{{ asset('assets/bg_form_2.png') }}')">

                <h2 class="text-2xl font-bold text-center mb-6">Detail Pelatihan</h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1">Topik</label>
                        <input type="text" x-model="detailJadwal.topik" readonly
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Deskripsi</label>
                        <input type="text" x-model="detailJadwal.deskripsi" readonly
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Tanggal</label>
                        <input type="text" x-model="detailJadwal.tanggal" readonly
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Lokasi</label>
                        <input type="text" x-model="detailJadwal.lokasi" readonly
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Kuota</label>
                        <input type="text" x-model="detailJadwal.kuota" readonly
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100">
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button @click="showDetailModal = false"
                        class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg font-semibold">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('master.footer')
    </section>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("jadwalModal", () => ({
                showTambahPengajuan: @json($errors->any()),
                showDetailModal: false,
                selectedMonthYear: '{{ request()->get('bulan', now()->format('Y-m')) }}',
                detailJadwal: {
                    topik: '',
                    deskripsi: '',
                    tanggal: '',
                    lokasi: '',
                    kuota: '',
                },
                openDetail(data) {
                    this.detailJadwal = data;
                    this.showDetailModal = true;
                },
                filterByMonthYear() {
                    const url = new URL(window.location.href);
                    url.searchParams.set('bulan', this.selectedMonthYear);
                    window.location.href = url.toString();
                }
            }))
        });

        if (performance.getEntriesByType("navigation")[0].type === "back_forward") {
            history.replaceState(null, '', location.href);
            location.reload();
        }
    </script>
@endsection
