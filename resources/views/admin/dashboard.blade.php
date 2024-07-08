@extends('admin.layouts.app')

@section('content')
    <div class="iq-navbar-header">
        <div style="position: absolute; z-index:-1; top:0; height: 263px">
            <img src="{{asset('assets/images/top-header.png')}} " alt="header" class="theme-color-default-img img-fluid w-100 h-100">
        </div>
        <div class="title mt-3">
            <h1 class="text-white" style="margin-left: 1rem">Dashboard </h1>
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
                        <?php $sum_tot_tagihan = 0 ?>
                        @foreach ($tagihan_bdu as $item)
                            <div class="d-flex" style="justify-content: space-between">
                                <p style="font-size: 14px"> {{$item->nama_lengkap}} </p>
                                <h6 style="text-align: right"> Rp. {{($tagihan_bdu->count() > 0) ? number_format($item->nilai_tagihan) : '-'}} </h6>
                            </div>
                            <?php $sum_tot_tagihan += $item->nilai_tagihan ?>
                        @endforeach
                        <hr>
                        <div class="d-flex mb-3" style="justify-content: space-between">
                            <h6> Total </h6>
                            <h6 style="text-align: right"> Rp. {{number_format($sum_tot_tagihan)}} </h6>
                        </div>
                        <button type="button" class="btn btn-info btn-sm" style="border-radius: 1rem" data-bs-toggle="modal" data-bs-target="#detail_bpn">Detail</button>
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
                        <h3 style="text-align: right"> Rp. {{($spp_last_month != null ) ? number_format($spp_last_month->nilai_tagihan) : '-'}} </h3>
                        <button type="button" class="btn btn-info btn-sm" style="border-radius: 1rem" data-bs-toggle="modal" data-bs-target="#detail_spp">Detail</button>
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
                        <?php $sum_tot_tunggakan = 0 ?>
                        @foreach ($tunggakan_spp as $item)
                            <div class="d-flex" style="justify-content: space-between">
                                <p style="font-size: 14px"> {{$item->nama_lengkap}} </p>
                                <h6 style="text-align: right"> Rp. {{($tunggakan_spp->count() > 0) ? number_format($item->total_tunggakan_spp) : '-'}} </h6>
                            </div>
                            <?php $sum_tot_tunggakan += $item->total_tunggakan_spp ?>
                        @endforeach
                        <hr>
                        <div class="d-flex mb-3" style="justify-content: space-between">
                            <h6> Total </h6>
                            <h6 style="text-align: right"> Rp. {{number_format($sum_tot_tunggakan)}} </h6>
                        </div>
                        <button type="button" class="btn btn-info btn-sm" style="border-radius: 1rem" data-bs-toggle="modal" data-bs-target="#detail_tunggakan">Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="detail_bpn" tabindex="-1" role="dialog" aria-labelledby="biaya_pendidikan" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="#" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="biaya_pendidikan">Detail Biaya Pendidikan</h5>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div> --}}

    
    <div class="modal fade" id="detail_tunggakan" tabindex="-1" role="dialog" aria-labelledby="biaya_tunggakan" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="biaya_tunggakan">Detail Biaya Tunggakan</h5>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table  table-striped dt-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Tagihan</th>
                                    <th>NIS</th>
                                    <th>Bulan</th>
                                    <th>Jenis</th>
                                    <th>Nilai Tagihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tagihan_spp as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->no_tagihan}}</td>
                                        <td>{{$item->nis}}</td>
                                        <td>{{$item->bulan_pendapatan}} </td>
                                        <td>{{$item->jenis_penerimaan}}</td>
                                        <td>{{number_format($item->nilai_tagihan)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detail_spp" tabindex="-1" role="dialog" aria-labelledby="biaya_spp" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="biaya_spp">Detail Biaya SPP Lunas</h5>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table  table-striped dt-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Tagihan</th>
                                    <th>Bulan</th>
                                    <th>Jenis</th>
                                    <th>Nilai Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($spp_lunas as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->no_tagihan}}</td>
                                        <td>{{$item->bulan_pendapatan}} </td>
                                        <td>{{$item->jenis_penerimaan}}</td>
                                        <td>{{number_format($item->nilai_tagihan)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
