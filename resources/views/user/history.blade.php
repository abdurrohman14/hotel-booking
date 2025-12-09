@extends('partials.user.main')

@section('content')
<div class="container py-5">

    <h2 class="mb-4 fw-bold">Riwayat Pemesanan Anda</h2>

    <div class="row g-4">

        @forelse ($reservations as $reserv)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">

                    {{-- Jika ingin pakai gambar room --}}
                    @if ($reserv->room && $reserv->room->image_url)
                        <img src="{{ asset('rooms/' . $reserv->room->image_url) }}"
                             class="card-img-top"
                             style="height: 180px; object-fit: cover;">
                    @else
                        <img src="{{ asset('default-room.jpg') }}"
                             class="card-img-top"
                             style="height:180px; object-fit:cover;">
                    @endif

                    <div class="card-body">
                        <h5 class="fw-bold">{{ $reserv->room->room_name ?? 'Room Not Found' }}</h5>

                        {{-- Status --}}
                        @if ($reserv->reservation_status == 'pending')
                            <span class="badge bg-warning mb-2">Menunggu</span>
                        @elseif ($reserv->reservation_status == 'confirmation')
                            <span class="badge bg-success mb-2">Terkonfirmasi</span>
                        @elseif ($reserv->reservation_status == 'cancel')
                            <span class="badge bg-danger mb-2">Dibatalkan</span>
                        @endif

                        <p class="mb-1">
                            <i class="bi bi-calendar-check"></i>
                            Check-in: <strong>{{ $reserv->formatted_checkin_date }}</strong>
                        </p>

                        <p class="mb-1">
                            <i class="bi bi-calendar-x"></i>
                            Check-out: <strong>{{ $reserv->formatted_checkout_date }}</strong>
                        </p>

                        <p class="text-muted small mb-0">
                            Dibuat: {{ $reserv->created_at->format('d M Y H:i') }}
                        </p>
                    </div>

                </div>
            </div>

        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Anda belum memiliki riwayat pemesanan.
                </div>
            </div>
        @endforelse

    </div>

</div>
@endsection
