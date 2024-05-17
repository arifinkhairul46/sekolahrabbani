@extends('karir.layouts.app')

@section('content')
    <div class="karir">
        <div class="container mt-3">
            <div class="row mt-4">
                @include('karir.admin.sidebar')
                <div class="col-md">
                    <div class="card">
                        <div class="card-body mb-3">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Pertemuan</th>
                                            <th scope="col">Link</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kelasDiklat as $item)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>Pertemuan ke-{{$item->pertemuan}}</td>
                                                <td><a href="{{$item->forum_link}}" target="_blank"> {{$item->forum_link}} </a></td>
                                                <td>
                                                    <a href="{{route('karir.admin.kelas_pertemuan', $item->pertemuan)}}" class="btn btn-primary">Detail</a>
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
@endsection