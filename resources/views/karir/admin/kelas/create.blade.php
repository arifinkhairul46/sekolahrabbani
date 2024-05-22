@extends('karir.layouts.app')

@section('content')
    <div class="karir">
        <div class="container mt-3">
            <div class="row mt-4">
                @include('karir.admin.sidebar')
                <div class="col-md">
                    <div class="card">
                        <div class="card-body mb-3">
                            <h3 class="card-title">Tambah Kelas</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.store_kelas')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="pertemuan" class="form-label">Pertemuan</label>
                                    <input type="number" class="form-control" id="pertemuan" name="pertemuan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="forum_link" class="form-label">Link</label>
                                    <input type="text" class="form-control" id="forum_link" name="forum_link" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi_kelas" class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" id="deskripsi_kelas" name="deskripsi_kelas" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection