@extends('admin.layouts.app')

@section('content')
    <div class="container iq-container">
        <div class="title mt-3">
            <h1>Tagihan </h1>
        </div>
        <div class="row mt-3">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Biaya Pendidikan</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">SPP</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tagihan Lainnya</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $( document ).ready(function() {
            getTagihan();
  // Handler for .ready() called.
        });
        function getTagihan() {
            $.ajax({
                url: "http://103.135.214.11:81/qlp_system/api_siswa/api_tagihan_siswa.php",
                type: 'POST',
                data: {
                    nis: '2324402001'
                },
                // dataType: "jsonp",
                crossDomain: true,
                success: function (result) {
                    console.log(result);
                }
            });
        }
    
    </script> --}}
