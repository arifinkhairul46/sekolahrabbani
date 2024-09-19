
    <div class="top-navigate sticky-top mb-2">
        <div class="d-flex" style="justify-content: stretch; width: 100%;">
            <a onclick="window.history.go(-1); return false;" class="mt-1" style="text-decoration: none; color: black">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h4 class="mx-2"> Belanja </h4>
            <div class="input-group mx-2" style="width: 100% !important; max-height: 30px">
                <span class="input-group-text" style="max-height: 26px"><i class="fa fa-search fa-xs"></i></span>
                <input class="form-control form-control-sm shadow-none" id="search" style="border: none; font-size: 0.675rem" placeholder="Cari" type="text" name="search" >
            </div>
            <form action="{{route('seragam.cart')}}" method="GET" class="mt-1 mb-0" id="cart_submit">
                <a href="#"  onclick="submit_cart()" style="text-decoration: none; color: black">
                    @if ($cart_detail->count() > 0)
                        <i class="fa-solid fa-cart-shopping fa-lg"> <span id="count_cart" class="count-cart py-1" >{{$cart_detail->count()}}</span> </i>
                    @else 
                        <i class="fa-solid fa-cart-shopping fa-lg"> <span id="count_cart" class="count-cart py-1" style="display:none;" > {{$cart_detail->count()}} </span> </i>
                    @endif
                </a>
            </form>
        </div>
    </div>