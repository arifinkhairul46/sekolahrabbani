@extends('admin.layouts.app')

@section('content')
    <div class="iq-navbar-header">
        <div style="position: absolute; z-index:-1; top:0; height: 263px">
            <img src="{{asset('assets/images/top-header.png')}} " alt="header" class="theme-color-default-img img-fluid w-100 h-100">
        </div>
        <div class="title my-3">
            <h1 class="text-white" style="margin-left: 1rem">List Seragam </h1>
        </div>
    </div>
    <div class="container iq-container px-3">
        <div class="card">
            <div class="card-body">
                <form action="{{route('list-seragam')}}" method="GET" role="form" >                                                    
                    <div class="form-group mt-3">
                        <div class="d-flex" style="justify-content: space-between">
                            <select name="nama_produk" id="nama_produk" class="select2 form-control form-control-sm" aria-label=".form-select-sm" >
                                <option value="" disabled selected> Nama Produk </option>
                                    @foreach ($list_produk as $item)
                                        <option value="{{ $item->id }}" {{($item->id == $nama_produk) ? 'selected' : ''}} >{{ $item->nama_produk }}</option>
                                    @endforeach
                            </select>
                            <select name="ukuran" id="ukuran" class="form-control form-control-sm mx-1">
                                <option value="" disabled selected> Ukuran</option>
                                @foreach ($list_ukuran as $item)
                                    <option value="{{ $item->id }}" {{($item->id == $ukuran) ? 'selected' : ''}} >{{ $item->ukuran_seragam }}</option>
                                @endforeach
                            </select>
                            <select name="jenis_produk" id="jenis_produk" class="form-control form-control-sm" aria-label=".form-select-sm" >
                                <option value="" disabled selected> Jenis Produk </option>
                                    @foreach ($list_jenis as $item)
                                        <option value="{{ $item->id }}" {{($item->id == $jenis_produk) ? 'selected' : ''}}>{{ $item->jenis_produk }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success btn-sm">Tampilkan</button>
                            <a href="{{route('list-seragam')}}" class="btn btn-dim btn-outline-danger btn-sm mx-1">Reset</a>   
                        </div>                       
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex" style="justify-content: flex-end">
                    <form action="#" method="GET" class="mx-2">
                        <button class="btn btn-primary btn-sm"> Add Seragam </button>
                    </form>
                </div>
                <div class="table-responsive mt-3">
                    <table id="list_user" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Jenis Produk </th>
                                <th>Ukuran</th>
                                <th>Kode Produk</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_seragam as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama_produk}}</td>
                                    <td>{{$item->jenis_produk}}</td>
                                    <td>{{$item->ukuran_seragam}} </td>
                                    <td>{{$item->kode_produk}}</td>
                                    <td>Rp {{number_format($item->harga)}}</td>
                                    <td>{{$item->diskon}}</td>
                                    <td class="d-flex">
                                        <a href="{{$item->id}}" class="btn btn-sm btn-warning" title="Edit"><i class="fa-solid fa-pencil"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <script>

        $(document).ready(function() {
            $('#nama_produk').select2();
            $('#ukuran').select2();
            $('#jenis_produk').select2();
        });
    </script>

@endsection