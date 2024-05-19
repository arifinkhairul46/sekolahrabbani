@extends('karir.layouts.app')

@section('content')
    <div class="karir">
        <div class="container mt-3">
            <div class="row mt-4">
                @include('karir.admin.sidebar')
                <div class="col-md">
                    <div class="card">
                        <div class="card-body mb-3">
                            <h3 class="card-title">Edit modul</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.update_modul', $modulDiklat->id)}}" method="post">
                                @csrf @method('PUT')
                                <div class="mb-3">
                                    <label for="judul_modul" class="form-label">Judul Modul</label>
                                    <input type="text" class="form-control" id="judul_modul" name="judul_modul" value="{{$modulDiklat->judul_modul}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi_modul" class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" id="deskripsi_modul" name="deskripsi_modul" value="{{$modulDiklat->deskripsi_modul}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="file_modul" class="form-label">File Modul</label>
                                    <input type="file" class="form-control" id="file_modul" name="file_modul" value="{{$modulDiklat->file_modul}}">
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