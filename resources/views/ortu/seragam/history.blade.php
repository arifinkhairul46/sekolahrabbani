@extends ('ortu.layouts.app')

@section('content')
    <div class="top-navigate sticky-top">
        <div class="d-flex" style="justify-content: stretch; width: 100%;">
            <a onclick="window.history.go(-1); return false;" class="mt-1" style="text-decoration: none; color: black">
                <i class="fa-solid fa-arrow-left fa-lg"></i>
            </a>
            <h4 class="mx-3"> Riwayat Transaksi </h4>
        </div>

        @foreach ($order as $item)
            <div class="card card-history mb-3">
                <div class="card-header d-flex" style="justify-content: space-between; font-size: 12px">
                    <span class=""> No Pesanan </span>
                    <span > {{$item->no_pemesanan}} </span>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        @endforeach
    </div>
@endsection