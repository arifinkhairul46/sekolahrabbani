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
    
    @if ($order)
        <div class="container">
            @if ($merch_id == 1)
                <div class="row-card mx-1">
                    <div class="frame-bayar">
                        <img src="{{asset('storage/'.$design->image_file)}}" width="100%" style="height: 100%; object-fit:cover; border-radius:1rem">
                    </div>

                    <div class="d-flex mx-2">
                        <div class="" style="width: 250px">
                            <p class="mb-0" style="font-size: 14px"><b> {{$merchandise->nama_produk}} Design by {{$design->nama_siswa}}, {{$warna}}, {{$jenis_lengan}}, {{$ukuran}} </b> 
                            </p>
                            @if ($merchandise->diskon == 0 || $merchandise->diskon == null)
                                <p class="mb-0 price-diskon"> <b> Rp. {{number_format($merchandise['harga_awal']) }} </b> </p>
                            @else
                                <p class="mb-0 price-diskon"> <b> Rp. {{number_format((($merchandise['harga_awal']) - ($merchandise['diskon']/100 * $merchandise['harga_awal'])) * $merchandise['quantity']) }} </b> 
                                    <span class="bg-danger py-1 px-2" style="font-size: 10px"> {{$merchandise['diskon']}}% </span> 
                                </p>
                                <p class="mb-0" style="color: gray; font-size: 12px"> <s> Rp. {{number_format($merchandise['harga_awal'] * $merchandise['quantity']) }} </s> </p>
                            @endif
                            {{-- <p class="mb-0" style="font-size: 10px"> Nama: {{$merchandise['nama_siswa']}} </p>
                            <p class="mb-1" style="font-size: 10px"> Sekolah: {{$merchandise['sekolah_id']}}, Kelas: {{$merchandise['nama_kelas']}} </p> --}}
                        </div>
                    </div>
                </div>
            @else
                <div class="row-card mx-1">
                    <div class="frame-bayar">
                        <img src="{{asset('storage/'.$merchandise->image_1)}}" width="100%" style="height: 100%; object-fit:cover; border-radius:1rem">
                    </div>

                    <div class="d-flex mx-2">
                        <div class="" style="width: 250px">
                            <p class="mb-0" style="font-size: 14px"><b> {{$merchandise->nama_produk}} </b> 
                            </p>
                            @if ($merchandise->diskon == 0 || $merchandise->diskon == null)
                                <p class="mb-0 price-diskon"> <b> Rp. {{number_format($merchandise['harga_awal']) }} </b> </p>
                            @else
                                <p class="mb-0 price-diskon"> <b> Rp. {{number_format((($merchandise['harga_awal']) - ($merchandise['diskon']/100 * $merchandise['harga_awal'])) * $merchandise['quantity']) }} </b> 
                                    <span class="bg-danger py-1 px-2" style="font-size: 10px"> {{$merchandise['diskon']}}% </span> 
                                </p>
                                <p class="mb-0" style="color: gray; font-size: 12px"> <s> Rp. {{number_format($merchandise['harga_awal'] * $merchandise['quantity']) }} </s> </p>
                            @endif
                            {{-- <p class="mb-0" style="font-size: 10px"> Nama: {{$merchandise['nama_siswa']}} </p>
                            <p class="mb-1" style="font-size: 10px"> Sekolah: {{$merchandise['sekolah_id']}}, Kelas: {{$merchandise['nama_kelas']}} </p> --}}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @else 
        <?php $total_awal = 0; ?>
        <?php $total_diskon = 0; ?>
        <?php $total_akhir = 0; ?>
        <div class="container">
            @foreach ($cart_detail as $item)
                @if ($item->merchandise_id == '1')
                    @if ($item->lengan_id == 1)
                        <?php $lengan = 'Pendek' ?>
                    @else
                        <?php $lengan = 'Panjang' ?>
                    @endif
                    <div class="row-card mx-1">
                        <div class="frame-bayar">
                            <img src="{{asset('storage/'.$item->image_file)}}" width="100%" style="height: 100%; object-fit:cover; border-radius:1rem">
                        </div>

                        <div class="d-flex mx-2">
                            <div class="" style="width: 250px">
                                {{-- <input type="hidden" class="kode_produk_fc" name="kode_produk[]" id="kode_produk_fc" value="{{$item->kode_produk}}"> --}}
                                <p class="mb-0" style="font-size: 14px"><b> {{$item->nama_produk}} Design by {{$item->nama_siswa}}, 
                                    {{$item->ukuran_seragam}}, {{$item->warna}}, {{$lengan}} </b> 
                                </p>
                                @if ($item->diskon == 0 || $item->diskon == null)
                                    <p class="mb-0 price-diskon"> <b> Rp. {{number_format($item['harga_awal']) }} </b> </p>
                                @else
                                    <p class="mb-0 price-diskon"> <b> Rp. {{number_format((($item['harga_awal']) - ($item['diskon']/100 * $item['harga_awal'])) * $item['quantity']) }} </b> 
                                        <span class="bg-danger py-1 px-2" style="font-size: 10px"> {{$item['diskon']}}% </span> 
                                    </p>
                                    <p class="mb-0" style="color: gray; font-size: 12px"> <s> Rp. {{number_format($item['harga_awal'] * $item['quantity']) }} </s> </p>
                                @endif
                                <p class="mb-0" style="font-size: 10px"> Nama: {{$item['nama_siswa']}} </p>
                                <p class="mb-1" style="font-size: 10px"> Sekolah: {{$item['sekolah_id']}}, Kelas: {{$item['nama_kelas']}} </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row-card mx-1">
                        <div class="frame-bayar">
                            <img src="{{asset('storage/'.$item->image_1)}}" width="100%" style="height: 100%; object-fit:cover; border-radius:1rem">
                        </div>

                        <div class="d-flex mx-2">
                            <div class="" style="width: 250px">
                                {{-- <input type="hidden" class="kode_produk_fc" name="kode_produk[]" id="kode_produk_fc" value="{{$item->kode_produk}}"> --}}
                                <p class="mb-0" style="font-size: 14px"><b> {{$item->nama_produk}} </b> 
                                </p>
                                @if ($item->diskon == 0 || $item->diskon == null)
                                    <p class="mb-0 price-diskon"> <b> Rp. {{number_format($item['harga_awal']) }} </b> </p>
                                @else
                                    <p class="mb-0 price-diskon"> <b> Rp. {{number_format((($item['harga_awal']) - ($item['diskon']/100 * $item['harga_awal'])) * $item['quantity']) }} </b> 
                                        <span class="bg-danger py-1 px-2" style="font-size: 10px"> {{$item['diskon']}}% </span> 
                                    </p>
                                    <p class="mb-0" style="color: gray; font-size: 12px"> <s> Rp. {{number_format($item['harga_awal'] * $item['quantity']) }} </s> </p>
                                @endif
                                <p class="mb-0" style="font-size: 10px"> Nama: {{$item['nama_siswa']}} </p>
                                <p class="mb-1" style="font-size: 10px"> Sekolah: {{$item['sekolah_id']}}, Kelas: {{$item['nama_kelas']}} </p>
                            </div>
                        </div>
                    </div>
                @endif
            <?php $total_awal += (($item['harga_awal'] * $item['quantity']) ); ?>
            <?php $total_diskon += ($item['diskon']/100 * $item['harga_awal'] * $item['quantity']); ?>
            <?php $total_akhir = $total_awal - $total_diskon; ?>
            @endforeach
        </div>

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

        <div class="bottom-navigate mt-3" style="background-color: #f5f5f5">
            <a href="#" style="font-size: 10px; text-decoration: none; color: #624F8F" data-bs-toggle="modal" data-bs-target="#privacy_policy"><i class="fa-solid fa-circle-info"></i> Privacy Policy </a>
            <div class="p-2 d-flex" style="justify-content: space-between">
                <h6> Total Pembayaran <br> <b> Rp. <span id="total_bayar"> {{number_format($total_akhir)}} </span> </b> </h6>
                <input type="hidden" value="{{$total_akhir}}" id="total_akhir" >
                @if ($total_akhir != 0)
                    <button id="pay-button" type="submit" class="btn btn-purple btn-sm px-4" onclick="bayar_merchandise()" style="letter-spacing: 1px"> <b>Bayar</b> </button>
                @else 
                    <button id="pay-button" type="submit" class="btn btn-purple btn-sm px-4" onclick="bayar_merchandise()" style="letter-spacing: 1px" disabled> <b>Bayar</b> </button>
                @endif
            </div>
        </div>
    @endif


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- <script src="https://app.sandbox.midtrans.com/snap/snap.js"  data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script> --}}
    <script src="https://app.midtrans.com/snap/snap.js"  data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>
    <script type="text/javascript">
        var harga_awal = $('#harga_awal').val();
        var diskon = $('#diskon').val();
        var total_harga = $('#harga').val();
        var nama_siswa = $('#nama_siswa').val();
        var nama_kelas = $('#nama_kelas').val();
        var sekolah_id = $('#sekolah_id').val();
        var quantity = $('#quantity').val();
        var ukuran = $('#ukuran').val();

        function bayar_merchandise() {
            $(this).prop("disabled", true);
                // add spinner to button
                $(this).html(
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
            );

                // from cart url:pembayaran
                
            $.ajax({
                url: "{{route('merchandise.store')}}",
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}'
                },
                success: function (res) {
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

    <div class="modal fade" id="privacy_policy" tabindex="-1" role="dialog" aria-labelledby="stok" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3> Privacy Policy </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ol type="1"> 
                        <li> Jika ada salah pembelian, tidak ada kebijakan refund atau pengembalian uang</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

@endsection