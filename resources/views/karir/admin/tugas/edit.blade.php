@extends('karir.layouts.app')

@section('content')
    <div class="karir">
        <div class="container mt-3">
            <div class="row mt-4">
                @include('karir.admin.sidebar')
                <div class="col-md">
                    <div class="card">
                        <div class="card-body mb-3">
                            <h3 class="card-title">Edit tugas</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.update_tugas', $tugasDiklat->id)}}" method="post">
                                @csrf @method('PUT')
                                <div class="mb-3">
                                    <label for="judul_tugas" class="form-label">Judul tugas</label>
                                    <input type="text" class="form-control" id="judul_tugas" name="judul_tugas" value="{{$tugasDiklat->judul_tugas}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi_tugas" class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" id="deskripsi_tugas" name="deskripsi_tugas" value="{{$tugasDiklat->deskripsi_tugas}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="file_tugas" class="form-label">File tugas</label>
                                    <input type="file" class="form-control" id="file_tugas" name="file_tugas" value="{{$tugasDiklat->file_tugas}}">
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