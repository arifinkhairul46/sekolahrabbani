@extends ('ortu.layouts.app')

@section('content')    
    @include('ortu.seragam.top-navigate')
    <div class="container">
        <div class="row mx-auto">       
            <div class="col-md">
                <div class="center mb-3">
                    <img src="{{ asset('assets/images/katalog_produk_tk.png') }}" alt="katalog" width="100%">
                </div>

                <div class="d-grid-card">
                    @foreach ($produk_seragam as $item)
                        @if($item->jenjang_id == 2)
                        <a href="{{route('seragam.detail', $item->id)}}" style="text-decoration: none">
                            <div class="card catalog mb-1">
                                <img src="{{ asset('assets/images/'.$item->image) }}" class="card-img-top" alt="{{$item->image}}">
                                <div class="card-body pt-1" style="padding-left: 0.8rem; padding-right: 0">
                                    <h6 class="card-title mb-0">{{$item->nama_produk}}</h6>
                                    <p class="mb-0 price-diskon" ><b> Rp. {{number_format($item->harga_awal * 80/100)}}/set </b> </p>
                                    <p class="mb-1 price-normal"><s> Rp. {{number_format($item->harga_awal)}} </s> </p>
                                    <p class="mb-0" style="font-size: 10px"> Disc. 
                                        <span class="bg-danger p-1"> {{($item->diskon_persen)}}% </span> 
                                        <span class="mx-2"> <i class="fa-solid fa-paper-plane fa-sm"></i> Sekolah Rabbani </span> 
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endif
                    @endforeach
                </div>

                <div class="center my-4">
                    <img src="{{ asset('assets/images/katalog_produk_sd.png') }}" alt="discount" width="100%">
                </div>

                <div class="d-grid-card" >
                    @foreach ($produk_seragam as $item)
                        @if($item->jenjang_id == 3)
                        <a href="{{route('seragam.detail', $item->id)}}" style="text-decoration: none">
                            <div class="card catalog mb-1">
                                <img src="{{ asset('assets/images/'.$item->image) }}" class="card-img-top" alt="{{$item->image}}">
                                <div class="card-body pt-1 px-2">
                                    <h6 class="card-title mb-0">{{$item->nama_produk}}</h6>
                                    <p class="mb-0 price-diskon" ><b> Rp. {{number_format($item->harga_awal * 80/100)}}/set </b> </p>
                                    <p class="mb-1 price-normal"><s> Rp. {{number_format($item->harga_awal)}} </s> </p>
                                    <p class="mb-0" style="font-size: 9px"> Disc. 
                                        <span class="bg-danger p-1"> {{($item->diskon_persen)}}% </span> 
                                        <span class="mx-1"> <i class="fa-solid fa-paper-plane fa-sm"></i> Sekolah Rabbani </span> 
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endif
                    @endforeach
                </div>

                <div class="center my-4">
                    <img src="{{ asset('assets/images/katalog_produk_smp.png') }}" alt="katalog" width="100%">
                </div>

                <div class="d-grid-card" >
                    @foreach ($produk_seragam as $item)
                        @if($item->jenjang_id == 4)
                        <a href="{{route('seragam.detail', $item->id)}}" style="text-decoration: none">
                            <div class="card catalog mb-1">
                                <img src="{{ asset('assets/images/'.$item->image) }}" class="card-img-top" alt="{{$item->image}}">
                                <div class="card-body pt-1 px-2">
                                    <h6 class="card-title mb-0">{{$item->nama_produk}}</h6>
                                    <p class="mb-0 price-diskon" ><b> Rp. {{number_format($item->harga_awal * 80/100)}}/set </b> </p>
                                    <p class="mb-1 price-normal"><s> Rp. {{number_format($item->harga_awal)}} </s> </p>
                                    <p class="mb-0" style="font-size: 9px"> Disc. 
                                        <span class="bg-danger p-1"> {{($item->diskon_persen)}}% </span> 
                                        <span class="mx-1"> <i class="fa-solid fa-paper-plane fa-sm"></i> Sekolah Rabbani </span> 
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endif
                    @endforeach
                </div>

                <div class="center my-4">
                    <img src="{{ asset('assets/images/katalog_produk_bani.png') }}" alt="katalog" width="75%">
                </div>

                <div class="d-grid-card" >
                    @foreach ($produk_seragam as $item)
                        @if($item->jenjang_id == 5)
                        <a href="{{route('seragam.detail', $item->id)}}" style="text-decoration: none">
                            <div class="card catalog mb-1">
                                <img src="{{ asset('assets/images/'.$item->image) }}" class="card-img-top" alt="{{$item->image}}">
                                <div class="card-body pt-1 px-2">
                                    <h6 class="card-title mb-0">{{$item->nama_produk}}</h6>
                                    <p class="mb-0 price-diskon" ><b> Rp. {{number_format(($item->harga_awal) - ($item->diskon_persen/100 * $item->harga_awal))}}/set </b> </p>
                                    <p class="mb-1 price-normal"><s> Rp. {{number_format($item->harga_awal)}} </s> </p>
                                    <p class="mb-0" style="font-size: 9px"> Disc. 
                                        <span class="bg-danger p-1"> {{($item->diskon_persen)}}% </span> 
                                        <span class="mx-1"> <i class="fa-solid fa-paper-plane fa-sm"></i> Sekolah Rabbani </span> 
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function submit_cart() {
            $('#cart_submit').submit();
        }

    </script>
@endsection