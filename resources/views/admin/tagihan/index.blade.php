@extends('admin.layouts.app')

@section('content')
    <div class="iq-navbar-header">
        <div style="position: absolute; z-index:-1; top:0; height: 263px">
            <img src="{{asset('assets/images/top-header.png')}} " alt="header" class="theme-color-default-img img-fluid w-100 h-100">
        </div>
        <div class="title mt-3">
            <h1 class="text-white" style="margin-left: 1rem">Tagihan </h1>
        </div>
    </div>
    <div class="container iq-container px-3">
        <div class="row mt-3">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Biaya Pendidikan</h5>
                            <span class="badge bg-success">Annual</span>
                        </div>
                        <br>
                        <br>
                        <h3 style="text-align: right"> Rp. {{$tagihan_bdu != null ? number_format($tagihan_bdu[0]->nilai_tagihan) : '-'}} </h3>
                        <a  href="#" class="btn btn-info">Detail</a>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">SPP</h5>
                            <span class="badge bg-primary">Monthly</span>
                        </div>
                        <br>
                        <br>
                        <h3 style="text-align: right"> Rp. {{$tagihan_spp != null ? number_format($tagihan_spp[0]->nilai_tagihan ) : '-'}} </h3>
                        <a  href="#" class="btn btn-info">Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Total Tunggakan</h5>
                            <span class="badge bg-danger">Until This Month</span>
                        </div>
                        <br>
                        <br>
                        <h3 style="text-align: right"> Rp. {{$tunggakan_spp != null ? number_format($tunggakan_spp[0]->total_tunggakan_spp) : '-'}} </h3>
                        <a href="#" class="btn btn-info">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection