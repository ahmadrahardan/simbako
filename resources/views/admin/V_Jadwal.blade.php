@extends('master.public')
@section('title', 'Jadwal')
@section('content')

    <section x-data="pengajuanModal" class="font-sans min-h-screen bg-cover bg-center relative"
        style="background-image: url({{ asset('assets/background_1.png') }})">

        <!-- Header -->
        @include('master.navbar')

        <!-- Main Content -->
        <div class="flex flex-col items-center justify-center min-h-screen pt-28 px-8 relative z-10">
            <div class="h-[5%] w-full bg-gradient-to-t from-slate-950 to-transparent absolute bottom-0 z-10"></div>
            <img src="{{ asset('assets/Ornament.png') }}" alt="" class="h-[1012px] w-[1440px] absolute bottom-0">
        </div>

        <!-- Footer -->
        @include('master.footer')
    </section>
@endsection
