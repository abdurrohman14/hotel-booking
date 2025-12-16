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
                        <h3 class="mb-0">Room Type</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Room</li>
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
                        {{-- <h3 class="card-title">Bordered Table</h3> --}}
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6x">
                                <button type="button" class="btn btn-primary btn-sm float-end">
                                    <a href="{{ route('room.create') }}" class="text-decoration-none text-white">Tambah</a>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Room Name</th>
                                    <th>Rates</th>
                                    <th style="width: 40px">Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roomType as $key => $rooms)
                                    <tr class="align-middle">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $rooms->room_name }}</td>
                                        <td>Rp. {{ number_format($rooms->rates) }}</td>
                                        <td><span class="badge text-bg-danger">{{ $rooms->image_url }}</span></td>
                                        <td><a href="{{ route('room.edit', $rooms->id) }}"
                                                class="btn btn-sm btn-warning text-white">
                                                <i class="bi bi-pencil-square text-white"></i> Edit
                                            </a>
                                            <form action="{{ route('room.delete', $rooms->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?');">
                                                    <i class="bi bi-trash"></i> Delete
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
