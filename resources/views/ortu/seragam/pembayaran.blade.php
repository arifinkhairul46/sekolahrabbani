@extends ('ortu.layouts.app')

@section('content')
    <div class="top-navigate sticky-top">
        <div class="d-flex" style="justify-content: stretch; width: 100%;">
            <a onclick="window.history.go(-1); return false;" class="mt-1" style="text-decoration: none; color: black">
                <i class="fa-solid fa-arrow-left fa-lg"></i>
            </a>
            <h4 class="mx-3"> Pembayaran </h4>
        </div>
    </div>
    
    <?php $total_awal = 0; ?>
    <?php $total_diskon = 0; ?>
    <?php $total_akhir = 0; ?>
    <div class="container">
        @foreach ($cart_detail as $item)
            <div class="row-card mx-1">
                <div class="frame-bayar">
                    <img src="{{asset('assets/images/'.$item->image)}}" width="100%" style="height: 100%; object-fit:cover; border-radius:1rem">
                </div>

                <div class="d-flex mx-2">
                    <div class="" style="width: 200px">
                        <p class="mb-0" style="font-size: 14px;"> {{$item->nama_produk}} </p>
                        <p class="mb-0 price-diskon"> <b> Rp. {{number_format((($item['harga']) - ($item['diskon']/100 * $item['harga'])) * $item['quantity']) }} </b> </p>
                        <p class="mb-0" style="color: gray; font-size: 10px"> <s> Rp. {{number_format($item->harga * $item['quantity'])}} </s> </p>     
                        <p class="mb-0" style="font-size: 10px">Quantity: {{$item['quantity']}}, Size: {{$item['ukuran']}} </p>
                        <p class="mb-1" style="font-size: 10px">Sekolah: {{$item['sekolah']}}, Kelas: {{$item['nama_kelas']}} </p>

                    </div>
                </div>
            </div>
        <?php $total_awal += (($item['harga'] * $item['quantity']) ); ?>
        <?php $total_diskon += ($item['diskon']/100 * $item['harga'] * $item['quantity']); ?>
        <?php $total_akhir = $total_awal - $total_diskon; ?>
        @endforeach
    </div>

    {{-- <div class="d-flex p-2 mb-3" style="justify-content: space-between; background-color:#f5f5f5; font-size: 12px">
        <span > <i class="fa-solid fa-wallet" style="color: #624F8F"></i> &nbsp; <b> Metode Pembayaran </b> </span>
        <a href="#" style="text-decoration: none; color:#FF419C"> Pilih Metode Pembayaran </a>
    </div> --}}

    <div class="">
        <p class="px-2 mb-0" style="background-color:#f5f5f5; font-size: 12px" > 
            <i class="fa-solid fa-money-bill" style="color: #624F8F"></i> 
            &nbsp; <b> Rincian Bayar </b> 
        </p>
        <div class="rincian-bayar px-2" style="color: gray">
            <span > Subtotal Produk </span>
            <span > Rp. {{number_format($total_awal)}} </span>
        </div>
        <div class="rincian-bayar px-2" style="color: gray">
            <span > Total Diskon </span>
            <span >- Rp. {{number_format($total_diskon)}} </span>
        </div>
        <div class="rincian-bayar px-2">
            <span >  <b> Total Pembayaran </b> </span>
            <span style="color: #FF419C"> <b> Rp. {{number_format($total_akhir)}} </b> </span>
        </div>
    </div>

    <div class="bottom-navigate mt-3 p-3 d-flex" style="justify-content: space-between; background-color: #f5f5f5">
        <h6> Total Pembayaran <br> <b> Rp. <span id="total_bayar"> {{number_format($total_akhir)}} </span> </b> </h6>
        {{-- <form action="{{route('seragam.store')}}" method="POST" enctype="multipart/form-data">
            @csrf --}}
            <button id="pay-button" type="submit" class="btn btn-purple btn-sm px-4" onclick="bayar_seragam()" style="letter-spacing: 1px"> <b>Bayar</b> </button>
        {{-- </form> --}}
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- <script src="https://app.sandbox.midtrans.com/snap/snap.js"  data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>  --}}
    <script src="https://app.midtrans.com/snap/snap.js"  data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>
    <script type="text/javascript">
    // var clientKey = "{{env('MIDTRANS_CLIENT_KEY')}}"
    // console.log('tes', clientKey);
        function bayar_seragam() {
            $(this).prop("disabled", true);
                // add spinner to button
                $(this).html(
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
            );
            
            $.ajax({
                url: "{{route('seragam.store')}}",
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}'
                },
                success: function (res) {
                    console.log(res.snap_token);
                    // SnapToken acquired from previous step
                    snap.pay(res.snap_token, {
                    // Optional
                    onSuccess: function(result){
                        window.location.href = '{{route('checkout.success')}}'
                        /* You may add your own js here, this is just example */ /*document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);*/
                    },
                    // Optional
                    onPending: function(result){
                        window.location.href = '{{route('seragam.history')}}'
                        /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    // Optional
                    onError: function(result){
                        window.location.href = '{{route('seragam.history')}}'
                        /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    }
                    });
                }
            });
        }
    </script>

@endsection