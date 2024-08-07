@extends ('ortu.layouts.app')

@section('content')
    <div class="container">
        <div class="top-navigate">
            <div class="d-flex" style="justify-content: space-between">
                <a onclick="window.history.go(-1); return false;" style="text-decoration: none; color: black">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <a href="#" style="text-decoration: none; color: black">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
        </div>
    </div>
    <div id="image-carousel" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#image-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#image-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#image-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#image-carousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#image-carousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="img-detail-card" src="{{ asset('assets/images/'.$produk->image) }}" alt="{{$produk->image}}">
            </div>
            <div class="carousel-item">
                <img class="img-detail-card" src="{{ asset('assets/images/'.$produk->image_2) }}" alt="{{$produk->image_2}}">
            </div>
            <div class="carousel-item">
                <img class="img-detail-card" src="{{ asset('assets/images/'.$produk->image_3) }}" alt="{{$produk->image_3}}">
            </div>
            <div class="carousel-item">
                <img class="img-detail-card" src="{{ asset('assets/images/'.$produk->image_4) }}" alt="{{$produk->image_4}}">
            </div>
            <div class="carousel-item">
                <img class="img-detail-card" src="{{ asset('assets/images/'.$produk->image_5) }}" alt="{{$produk->image_5}}">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#image-carousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#image-carousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container">
        <div class="produk-detail">
            <div class="produk-title mt-3">
                <h5 class="card-title mb-0">{{$produk->nama_produk}}</h5>
                <p class="mb-1 price-diskon-detail" ><b> Rp. {{number_format($produk->harga_awal * 80/100)}}/set </b> </p>
                <p class="mb-0" style="font-size: 16px"> Discount 
                    <span class="bg-danger py-1 px-2"> {{($produk->diskon_persen)}}% </span>
                    <span class="mx-2" style="color: gray"> <s> Rp. {{number_format($produk->harga_awal)}} </s> </span>
                </p>
            </div>

            <div class="produk-deskripsi mt-4">
                <h6 style="color:  #8755AF"><b> Deskripsi Produk </b> </h6>
                <p style="font-size: 14px"> {{$produk->deskripsi}} </p>
            </div>

            <div class="produk-deskripsi mt-3">
                <h6 style="color: #3152A4"><b> Material </b> </h6>
                <p style="font-size: 14px"> {{$produk->material}} </p>
            </div>

            <div class="bottom-navigate">
                <div class="d-flex" style="justify-content: end">
                    <button type="button" class="btn btn-primary px-3 pb-2"> <i class="fa-solid fa-plus"></i> Keranjang </button>
                    <button type="button" class="btn btn-blue mx-2 px-3 pb-2"> Beli Sekarang </button>
                </div>
            </div>
        </div>
    </div>
@endsection