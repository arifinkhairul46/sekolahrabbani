@extends ('ortu.layouts.app')

@section('content')
    <div class="top-navigate sticky-top">
        <div class="d-flex" style="justify-content: stretch; width: 100%;">
            <a onclick="window.history.go(-1); return false;" class="mt-1" style="text-decoration: none; color: black">
                <i class="fa-solid fa-arrow-left fa-lg"></i>
            </a>
            <h4 class="mx-3"> Rincian Pesanan </h4>
        </div>

        
        <div class="container">
            <?php $total_awal = 0; ?>
            <?php $total_diskon = 0; ?>
            <?php $total_akhir = 0; ?>
            @foreach ($order_detail as $item)
                <div class="row-card ">
                    <div class="frame-bayar">
                        <img src="{{asset('assets/images/'.$item->image)}}" width="100%" style="height: 100%; object-fit:cover; border-radius:1rem">
                    </div>
                    <div class="d-flex mx-2">
                        <div class="" style="width: 200px">
                            <p class="mb-0" style="font-size: 14px;"> {{$item->nama_produk}}, Size: {{$item->ukuran}} </p>
                            <p class="mb-0 price-diskon"> <b> Rp. {{number_format($item->harga * $item['quantity']  - ($item->diskon * $item['quantity']))}} </b> </p>
                            <p class="mb-0" style="color: gray; font-size: 10px"> <s> Rp. {{number_format($item->harga * $item['quantity'])}} </s> </p>     
                            <p class="mb-0" style="font-size: 10px">Nama: {{$item['nama_siswa']}} </p>
                            <p class="mb-0" style="font-size: 10px">Qty: {{$item['quantity']}}</p>
                        </div>
                    </div>
                </div>
                <?php $total_awal += (($item->harga * $item['quantity']) ); ?>
                <?php $total_diskon += ($item->diskon * $item['quantity']);?>
                <?php $total_akhir = number_format($total_awal - $total_diskon); ?>
            @endforeach

            <div class="d-flex mt-3" style="justify-content: space-between; font-size: 14px">
                <span> Total Pesanan </span>
                <span> Rp. {{$total_akhir}} </span>
            </div>
            <hr>

            <div class="d-flex mt-3" style="justify-content: space-between; font-size: 14px">
                <span> Metode Pembayaran </span>
                <span> Mandiri Virtual Account </span>
            </div>

            @if($order->status == 'pending')
                <div class="d-flex" style="justify-content: space-between; font-size: 14px">
                    <span> No Pembayaran </span>
                    <span> Mandiri Virtual Account </span>
                </div>
            @endif
            <hr>

            <div class="d-flex mt-3" style="justify-content: space-between; font-size: 14px">
                <span> No Pesanan </span>
                <span> {{$order->no_pemesanan}} </span>
            </div>
            <div class="d-flex" style="justify-content: space-between; font-size: 14px">
                <span> Waktu Pembayaran </span>
                <span> {{$order->updated_at}} </span>
            </div>

        </div>
    </div>
    <div class="d-grid gap-2 mt-3 bottom-navigate">
        <button class="btn btn-purple btn-block py-2" > Download Invoice </button>
    </div>
@endsection