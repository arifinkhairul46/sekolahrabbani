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
            <a href="{{route('seragam.history.detail', $item->no_pemesanan)}}" style="text-decoration: none">
                <div class="card card-history mt-3">
                    <div class="card-header d-flex" style="justify-content: space-between; font-size: 12px">
                        <span class=""> No Pesanan </span>
                        <span > {{$item->no_pemesanan}} </span>
                    </div>
                    <div class="card-body d-flex">
                        <div class="frame-bayar">
                            <img src="{{asset('assets/images/'.$item->image)}}" width="100%" style="height: 100%; object-fit:cover; border-radius:1rem">
                        </div>
                        <div class="d-flex mx-2">
                            <div class="" style="width: 200px">
                                <p class="mb-0" style="font-size: 14px;"> {{$item->nama_produk}} </p>
                                <p class="mb-0 price-diskon"> <b> Rp. {{number_format((($item->total_harga))) }} </b> </p>
                                <p class="mb-0" style="font-size: 10px">Waktu Pesan: {{$item->created_at}} </p>
        
                            </div>
                        </div>
                        <div class="status" style="margin-left: auto">
                            @if ($item->status == 'success')
                                <span class="badge bg-success" style="font-size: 12px"> {{$item->status}} </span>

                            @elseif($item->status == 'pending')
                                <span class="badge bg-warning" style="font-size: 12px"> Menunggu </span>

                            @elseif($item->status == 'cancel' || $item->status == 'failed' || $item->status == 'expired' )
                                <span class="badge bg-danger" style="font-size: 12px"> Gagal </span>
                                
                            @endif

                            {{-- <span class="badge bg-danger" style="font-size: 12px"> {{$item->status}} </span> --}}

                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    @include('ortu.footer.index')
    
@endsection
{{-- @include('ortu.footer.index') --}}