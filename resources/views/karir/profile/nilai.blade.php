@extends('karir.layouts.app')

@section('content')
    <div class="karir">
        <div class="container mt-3">
            <div class="row mt-4">
                @include('karir.profile.sidebar')
                <div class="col-md">
                    <div class="card">
                        <div class="card-body mb-3">
                            <div class="d-flex">
                                <h3 >Hasil Nilai</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection