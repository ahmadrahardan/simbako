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
                        02-03-2025
                    </div>

                    <!-- Judul -->
                    <h2 class="text-center text-xl font-semibold mt-12">
                        Cara Melinting Rokok Kretek
                    </h2>

                    <!-- Isi Paragraf -->
                    <p class="mt-4 text-justify text-sm leading-relaxed text-white/90">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit quo provident magni! Ad impedit pariatur iusto culpa amet soluta ullam nihil cum dolore? Quasi laboriosam alias quidem atque expedita qui impedit repellendus reprehenderit, minus hic possimus eius illo excepturi officia praesentium error quod aspernatur corporis. At totam nihil harum vero eveniet officiis reiciendis suscipit quae explicabo, ipsam, doloribus, cumque qui! Maxime possimus itaque cupiditate esse dolor neque assumenda ex rerum deleniti, tempora in odio obcaecati et omnis, sed nemo amet ipsum, impedit eius. Debitis aliquam dolorum nihil quas veritatis doloribus quidem labore quod molestiae. Exercitationem nihil corrupti, dolorum dolores nostrum quisquam harum voluptatum commodi deleniti soluta doloremque dicta illum pariatur voluptatibus officia? Deleniti tenetur saepe omnis voluptates repellendus! Consequatur optio, suscipit ipsum officiis magni quos doloremque necessitatibus esse error illo saepe dolores nemo quasi exercitationem accusantium qui quas nisi, repudiandae harum provident itaque sequi quae? Cumque culpa consequuntur voluptatibus suscipit reiciendis molestias voluptates nemo vel deserunt qui dolores enim alias voluptas tempora provident, cum reprehenderit velit quae debitis accusamus ab autem. Impedit nam cum, maxime soluta fugit cupiditate expedita voluptatem tempora explicabo aperiam sapiente eveniet omnis asperiores cumque laudantium ab aliquid, quasi ut et vel deserunt provident quae veritatis. Tenetur minima recusandae dolor sequi, atque reiciendis, culpa consequuntur ad mollitia, exercitationem illo optio sunt distinctio veritatis totam nobis. Doloremque similique quidem tempore molestiae nostrum quae ad deleniti hic non eaque, earum quos mollitia omnis voluptates veritatis, officiis exercitationem ab deserunt animi dicta consequuntur molestias voluptate. Optio voluptates aliquid dolore obcaecati vel architecto est repellendus odio ratione asperiores, aut sequi necessitatibus repellat hic corrupti tempore perferendis, veniam nam facilis nostrum porro et voluptate delectus tenetur? Eos, quam culpa quos distinctio repellat, a non necessitatibus ea fugit maxime saepe incidunt laudantium doloribus, dolor voluptatibus at dolores placeat. Obcaecati consequuntur quis error deserunt.
                    </p>

                    <!-- Video Preview -->
                    <div class="flex justify-center mt-6">
                        <div
                            class="relative w-[320px] h-[180px] rounded-2xl overflow-hidden border border-white/30 bg-white/10 backdrop-blur">
                            <img src="{{ asset('assets/cigar.png') }}" alt="Video Thumbnail"
                                class="w-full h-full object-cover">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div
                                    class="w-14 h-14 bg-white/30 rounded-full flex items-center justify-center hover:bg-white/50 transition">
                                    <i class="fa fa-play text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
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
