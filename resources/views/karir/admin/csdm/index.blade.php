@extends('karir.layouts.app')

@section('content')
    <div class="karir">
        <div class="container mt-3">
            <div class="row mt-4">
                @include('karir.admin.sidebar')
                <div class="col-md">
                    <div class="card">
                        <div class="card-body mb-3">
                            <h3 class="card-title">Calon SDM</h3>
                            <div class="mb-2" style="text-align: right">
                                <a href="{{route('admin.create_csdm')}}" class="btn btn-secondary"><i class="fa-solid fa-plus"></i> Tambah CSDM</a>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importExcel"><i class="fa-solid fa-file-excel"></i>
                                    IMPORT CSDM
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="csdm_diklat" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Lengkap</th>
                                            <th scope="col">Jenis Kelamin</th>
                                            <th scope="col">Tempat, Tanggal Lahir</th>
                                            <th scope="col">Domisili saat ini</th>
                                            <th scope="col">Posisi lamaran</th>
                                            <th scope="col">Foto Profile</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($csdm as $item)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$item->nama_lengkap}}</td>
                                                <td>{{$item->jenis_kelamin == 1 ? 'Ikhwan' : 'Akhwat'}}</td>
                                                <td>{{$item->tempat_lahir}}, {{$item->tgl_lahir}} </td>
                                                <td>{{$item->domisili_sekarang}}</td>
                                                <td>{{$item->posisi_lamaran}}</td>
                                                <td>{{$item->foto_profile}}</td>
                                                <td class="d-flex">
                                                    <a href="{{route('admin.edit_csdm', $item->id)}}" class="btn btn-warning" title="edit"><i class="fa-solid fa-pencil"></i></a>
                                                    <form action="{{route('admin.delete_csdm', $item->id)}}" method="post">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mx-2" title="delete"><i class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#csdm_diklat').DataTable( {
                responsive: true,
            });
        });
    </script>

    {{-- Modal --}}
    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('admin.import_csdm')}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file" required="required">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection