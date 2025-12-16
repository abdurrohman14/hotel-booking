@extends('partials.admin.main')
@section('content')
    <main class="app-content">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Reservation</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reservation</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <div class="app-content">
            <div class="contaner-fluid">
                <div class="card mb-4">
                    <div class="card-header">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Room Name</th>
                                    <th>Guest Name</th>
                                    <th>Guest Email</th>
                                    <th>Checkin Date</th>
                                    <th>Checkout Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservation as $key => $reserv)
                                    <tr class="align-middle">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $reserv->room->room_name }}</td>
                                        <td>{{ $reserv->guest_name }}</td>
                                        <td>{{ $reserv->guest_email }}</td>
                                        <td>{{ $reserv->formatted_checkin_date }}</td>
                                        <td>{{ $reserv->formatted_checkout_date }}</td>
                                        {{-- Status Badge --}}
                                        <td>
                                            @if ($reserv->reservation_status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif ($reserv->reservation_status == 'confirmation')
                                                <span class="badge bg-success">Confirmation</span>
                                            @elseif ($reserv->reservation_status == 'cancel')
                                                <span class="badge bg-secondary">Cancel</span>
                                            @endif
                                        </td>

                                        {{-- Dropdown Update Status --}}
                                        <td class="text-center">
                                            {{-- CONFIRM --}}
                                            <form action="{{ route('reservation.updateStatus', $reserv->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="confirmation">

                                                <button type="submit"
                                                    class="btn btn-sm
                {{ $reserv->reservation_status == 'confirmation' ? 'btn-success' : 'btn-outline-success' }}"
                                                    title="Confirm"
                                                    {{ $reserv->reservation_status == 'confirmation' ? 'disabled' : '' }}>
                                                    <i class="bi bi-check-lg"></i>
                                                </button>
                                            </form>

                                            {{-- CANCEL --}}
                                            <form action="{{ route('reservation.updateStatus', $reserv->id) }}"
                                                method="POST" class="d-inline ms-1">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="cancel">

                                                <button type="submit"
                                                    class="btn btn-sm
                {{ $reserv->reservation_status == 'cancel' ? 'btn-danger' : 'btn-outline-danger' }}"
                                                    title="Cancel"
                                                    {{ $reserv->reservation_status == 'cancel' ? 'disabled' : '' }}>
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-end">
                            <li class="page-item">
                                <a class="page-link" href="#">&laquo;</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">&raquo;</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
