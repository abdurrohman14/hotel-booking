@extends('partials.admin.main')
@section('content')
<main class="app-content">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Room</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Room</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Room</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('room.update', $roomType->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="room_name" class="form-label">Room Name</label>
                                    <input type="text" class="form-control" id="room_name" name="room_name" placeholder="" value="{{ $roomType->room_name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="rates" class="form-label">Rates</label>
                                    <input type="text" class="form-control" id="rates" name="rates" placeholder="" value="{{ $roomType->rates }}">
                                </div>
                                <div class="mb-3">
                                    <label for="dokumen" class="form-label">Dokumen</label>
                                    <input type="file" name="image_url" class="form-control" id="dokumen">
                                    @if ($roomType->image_url)
                                            <p>Current Document: <a href="{{ asset('rooms/' . $roomType->image_url) }}"
                                                    target="_blank">{{ $roomType->image_url }}</a></p>
                                        @endif
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="{{ route('room.index') }}" class="btn btn-secondary float-end">
                                            Batal
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
