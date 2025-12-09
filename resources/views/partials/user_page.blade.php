@extends('partials.user.main')
@section('content')
    <div class="position-relative mb-5">
        <img src="{{ asset('assets/img/interior_ 3 Stunning Hotels.jpg') }}" class="img-fluid w-100 rounded shadow"
            style="object-fit: cover; height: 400px;" alt="Hotel Banner">

        <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
            <h1 class="fw-bold display-5 text-shadow">Temukan Kamar Terbaik Untuk Anda</h1>
            <p class="lead text-shadow">Nikmati pengalaman menginap yang nyaman dan modern</p>
        </div>
    </div>

    {{-- Daftar Kamar --}}
    <h3 class="fw-bold mb-4">Pilihan Kamar</h3>

    <div class="row g-4">

        @foreach ($rooms as $room)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset('rooms/' . $room->image_url) }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="fw-bold">{{ $room->room_name }}</h5>
                        <h6 class="text-primary fw-bold">Rp {{ number_format($room->rates) }}</h6>
                        <a href="{{ route('booking.create', $room->id) }}" class="btn btn-primary w-100">Booking</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
