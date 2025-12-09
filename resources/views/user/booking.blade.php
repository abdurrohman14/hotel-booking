@extends('partials.user.main')

@section('content')
    <div class="container py-5">
        @if (session('error'))
            <div id="alert-error" class="alert alert-danger">
                {{ session('error') }}
            </div>

            <script>
                setTimeout(() => {
                    const alert = document.getElementById('alert-error');
                    if (alert) {
                        alert.classList.add('fade');
                        alert.style.transition = "opacity 0.5s";
                        alert.style.opacity = "0";
                        setTimeout(() => alert.remove(), 600);
                    }
                }, 3000); // 3 detik
            </script>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset('rooms/' . $room->image_url) }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="fw-bold">{{ $room->room_name }}</h5>
                        <h6 class="text-primary fw-bold">Rp {{ number_format($room->rates) }}</h6>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <h2 class="fw-bold mb-4">Form Booking Kamar</h2>

                <div class="card shadow-sm">
                    <div class="card-body">

                        <form action="{{ route('booking.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="room_id" value="{{ $room->id }}">

                            <input type="hidden" name="guest_name" value="{{ Auth::user()->name }}">
                            <input type="hidden" name="guest_email" value="{{ Auth::user()->email }}">

                            {{-- Tampilan untuk user (readonly) --}}
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                            </div>

                            {{-- Check-in --}}
                            <div class="mb-3">
                                <label class="form-label">Check-in Date</label>
                                <input type="date" name="checkin_date" class="form-control" required>
                            </div>

                            {{-- Check-out --}}
                            <div class="mb-3">
                                <label class="form-label">Check-out Date</label>
                                <input type="date" name="checkout_date" class="form-control" required>
                            </div>

                            <button class="btn btn-primary">Booking Now</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
