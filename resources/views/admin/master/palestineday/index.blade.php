@extends('admin.layouts.app')

@section('content')
    <div class="iq-navbar-header">
        <div style="position: absolute; z-index:-1; top:0; height: 263px">
            <img src="{{asset('assets/images/top-header.png')}} " alt="header" class="theme-color-default-img img-fluid w-100 h-100">
        </div>
        <div class="title my-3">
            <h1 class="text-white" style="margin-left: 1rem">List Materi Palestine Day </h1>
        </div>
    </div>
    <div class="container iq-container px-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex" style="justify-content: flex-end">
                    <button class="btn btn-success btn-sm mx-2" data-bs-toggle="modal" data-bs-target="#add_materi"> Add Materi </button>
                </div>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-tksd-tab" data-bs-toggle="tab" data-bs-target="#nav-tksd" type="button" role="tab" aria-controls="nav-tksd" aria-selected="true">TK SD</button>
                        <button class="nav-link" id="nav-smp-tab" data-bs-toggle="tab" data-bs-target="#nav-smp" type="button" role="tab" aria-controls="nav-smp" aria-selected="false">SMP</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-tksd" role="tabpanel" aria-labelledby="nav-tksd-tab" tabindex="0">
                        <div class="table-responsive mt-3">
                            <table id="data_tksd" class="table table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>File </th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Penulis</th>
                                        <th>Created at</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($materi_tksd as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->judul}}</td>
                                            <td>{{$item->file}}</td>
                                            <td>{{$item->image}} </td>
                                            @if ($item->status = 0) 
                                                <td>Tidak Aktif</td>
                                            @else
                                                <td>Aktif</td>
                                            @endif
                                            <td>{{$item->created_by}}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td class="d-flex">
                                                <button class="btn btn-sm btn-warning" title="Edit" onclick="edit_data('{{$item->id}}')" data-bs-toggle="modal" data-bs-target="#edit_seragam">
                                                    <i class="fa-solid fa-pencil"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-smp" role="tabpanel" aria-labelledby="nav-smp-tab" tabindex="0">
                        <div class="table-responsive mt-3">
                            <table id="data_smp" class="table table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Deskripsi </th>
                                        <th>Status</th>
                                        <th>Terbit</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($materi_smp as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->judul}}</td>
                                            <td>{{$item->deskripsi}}</td>
                                            @if ($item->status = 0) 
                                                <td>Tidak Aktif</td>
                                            @else
                                                <td>Aktif</td>
                                            @endif
                                            <td>{{$item->terbit}}</td>
                                            <td class="d-flex">
                                                <button class="btn btn-sm btn-warning" title="Edit" onclick="edit_data('{{$item->id}}')" data-bs-toggle="modal" data-bs-target="#edit_seragam">
                                                    <i class="fa-solid fa-pencil"></i>
                                                </button>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- create materi --}}
    <div class="modal fade" id="add_materi" tabindex="-1" role="dialog" aria-labelledby="create_materi" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('materi.store')}}" enctype="multipart/form-data" method="post" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="create_materi">Tambah materi</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="jenjang" class="form-control-label">Jenjang</label>
                            <select name="jenjang" id="jenjang" onchange="getMateri()" class="form-control form-control-sm" required>
                                <option value="" disabled selected> </option>
                                <option value="1" >Kober - TK - SD </option>
                                <option value="2" >SMP </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="judul" class="form-control-label">Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul" required>
                        </div>

                        <div class="form-group" id="deskripsi_group">
                            <label for="deskripsi" class="form-control-label">Deskripsi</label>
                            <textarea type="text" class="form-control" name="deskripsi" id="deskripsi" rows="5"> </textarea>
                        </div>

                        <div class="form-group">
                            <label for="warna" class="form-control-label">Warna</label>
                            <input type="warna" class="form-control" name="warna" id="warna">
                        </div>

                        <div class="form-group" id="penulis_group">
                            <label for="penulis" class="form-control-label">Penulis</label>
                            <input type="text" class="form-control" name="penulis" id="penulis">
                        </div>

                        <div class="form-group" id="terbit_group">
                            <label for="terbit" class="form-control-label">Terbit</label>
                            <input type="date" class="form-control" name="terbit" id="terbit">
                        </div>

                        <div class="form-group">
                            <label for="gambar" class="form-control-label">Gambar</label>
                            <input type="file" class="form-control" name="gambar" id="gambar" required>
                        </div>

                        <div class="form-group" id="file_group">
                            <label for="file" class="form-control-label">File</label>
                            <input type="file" class="form-control" name="file" id="file">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm" >Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script> 
        
        function getMateri() {
            var jenjang = document.getElementById("jenjang").value

            if (jenjang == 2) {
                $('#file_group').hide();
                $('#deskripsi_group').show();
                $('#penulis_group').hide();
            } else {
                $('#file_group').show();
                $('#deskripsi_group').hide();
                $('#penulis_group').show();

            }
        }

    </script>
@endsection

<style>
    table.dataTable th:nth-child(3) {
        width: 300px;
        max-width: 300px;
        word-break: break-all;
        white-space: pre-line;
    }

    table.dataTable td:nth-child(3) {
        width: 300px;
        max-width: 300px;
        word-break: break-all;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    table.dataTable th:nth-child(4) {
        width: 300px;
        max-width: 300px;
        word-break: break-all;
        white-space: pre-line;
    }

    table.dataTable td:nth-child(4) {
        width: 300px;
        max-width: 300px;
        word-break: break-all;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
