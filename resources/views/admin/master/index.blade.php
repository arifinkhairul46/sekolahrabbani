@extends('admin.layouts.app')

@section('content')
    <div class="iq-navbar-header">
        <div style="position: absolute; z-index:-1; top:0; height: 263px">
            <img src="{{asset('assets/images/top-header.png')}} " alt="header" class="theme-color-default-img img-fluid w-100 h-100">
        </div>
        <div class="title my-3">
            <h1 class="text-white" style="margin-left: 1rem">List User </h1>
        </div>
    </div>
    <div class="container iq-container px-3">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table id="list_user" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                {{-- <th>NIS</th> --}}
                                <th>No Hp </th>
                                <th>No Hp Kedua</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_user as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    {{-- <td>{{$item->nis}}</td> --}}
                                    <td>{{$item->no_hp}} </td>
                                    <td>{{$item->no_hp_2}}</td>
                                    @if ($item->id_role == 1) 
                                        <td> Super Admin </td>
                                    @elseif ($item->id_role == 2)
                                        <td> Admin </td>
                                    @elseif ($item->id_role == 3)
                                        <td> CSDM </td>
                                    @elseif ($item->id_role == 4)
                                        <td> Karywan </td>
                                    @elseif ($item->id_role == 5)
                                        <td> Orang Tua </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection