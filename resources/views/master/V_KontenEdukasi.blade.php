@extends('master.public')
@section('title', 'Konten')
@section('content')

    <section x-data="pengajuanModal" class="font-sans min-h-screen bg-cover bg-center relative"
        style="background-image: url({{ asset('assets/background_1.png') }})">

        <!-- Header -->
        @include('master.navbar')

        <!-- Main Content -->
        <div class="flex flex-col items-center justify-center min-h-screen pt-20 px-8 relative z-10">
            <div class="h-[5%] w-full bg-gradient-to-t from-slate-950 to-transparent absolute bottom-0 z-10"></div>
            <img src="{{ asset('assets/Ornament.png') }}" alt="" class="h-[1012px] w-[1440px] absolute bottom-0">

            <div class="bg-white/10 backdrop-blur-md border border-white/60 rounded-2xl shadow-lg p-6 w-full max-w-5xl">
                <div class="overflow-y-auto h-[450px] px-6 custom-scrollbar relative text-white font-sans">

                    <!-- Tombol Back -->
                    <button onclick="history.back()"
                        class="absolute top-0 left-0 mt-4 ml-2 bg-white/20 hover:bg-white/30 py-1 px-3 rounded-lg backdrop-blur">
                        <i class="fa fa-arrow-left"></i>
                    </button>

                    <!-- Tanggal -->
                    <div
                        class="absolute top-0 right-0 mt-4 mr-4 bg-white/20 text-sm text-gray-100 px-3 py-1 rounded-md backdrop-blur">
                        {{ $edukasi->created_at->diffForHumans() }}
                    </div>

                    <!-- Judul -->
                    <h2 class="text-center text-xl font-semibold mt-12">
                        {{ $edukasi->topik }}
                    </h2>

                    <!-- Isi Paragraf -->
                    <p class="mt-4 text-justify text-sm leading-relaxed text-white/90">
                        {!! nl2br(e(file_get_contents(public_path($edukasi->konten)))) !!}
                    </p>

                    @php
                        function youtubeEmbed($url)
                        {
                            if (Str::contains($url, 'watch?v=')) {
                                return Str::replace('watch?v=', 'embed/', $url);
                            } elseif (Str::contains($url, 'youtu.be/')) {
                                $id = Str::after($url, 'youtu.be/');
                                return 'https://www.youtube.com/embed/' . $id;
                            }
                            return $url;
                        }
                    @endphp

                    @if ($edukasi->link)
                        <div class="flex justify-center mt-6">
                            <iframe class="w-[320px] h-[180px] rounded-2xl border border-white/30"
                                src="{{ youtubeEmbed($edukasi->link) }}" frameborder="0" allowfullscreen>
                            </iframe>
                        </div>
                    @endif
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


        <!-- Footer -->
        @include('master.footer')
    </section>
@endsection
