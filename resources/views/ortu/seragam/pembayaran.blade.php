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
                        <p class="mb-0 price-diskon"> <b> Rp. {{number_format((($item['harga_awal']) - ($item['diskon_persen']/100 * $item['harga_awal'])) * $item['quantity']) }} </b> </p>
                        <p class="mb-0" style="color: gray; font-size: 10px"> <s> Rp. {{number_format($item->harga_awal * $item['quantity'])}} </s> </p>     
                        <p class="mb-0" style="font-size: 10px">Quantity: {{$item['quantity']}}, Size: {{$item['ukuran']}} </p>
                        <p class="mb-1" style="font-size: 10px">Sekolah: {{$item['sekolah']}}, Kelas: {{$item['nama_kelas']}} </p>

                    </div>
                </div>
            </div>
        <?php $total_awal += (($item['harga_awal'] * $item['quantity']) ); ?>
        <?php $total_diskon += ($item['diskon_persen']/100 * $item['harga_awal'] * $item['quantity']); ?>
        <?php $total_akhir = $total_awal - $total_diskon; ?>
        @endforeach
    </div>

    <div class="d-flex p-2 mb-3" style="justify-content: space-between; background-color:#f5f5f5; font-size: 12px">
        <span > <i class="fa-solid fa-wallet" style="color: #624F8F"></i> &nbsp; <b> Metode Pembayaran </b> </span>
        <a href="#" style="text-decoration: none; color:#FF419C"> Pilih Metode Pembayaran </a>
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

    <div class="bottom-navigate mt-3 p-3 d-flex" style="justify-content: space-between; background-color: #f5f5f5">
        <h6> Total Pembayaran <br> <b> Rp. {{number_format($total_akhir)}} </b> </h6>
        <button class="btn btn-purple btn-sm px-4" style="letter-spacing: 2px"> <b>Bayar</b> </button>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

        $('.btn-number').click(function(e){
            e.preventDefault();
            
            fieldName = $(this).attr('data-field');
            type      = $(this).attr('data-type');
            var input = $("input[name='"+fieldName+"']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if(type == 'minus') {
                    
                    if(currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    } 
                    if(parseInt(input.val()) == 1) {
                        $(this).attr('disabled', true);
                    }

                } else if(type == 'plus') {

                    if(currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(1);
            }
        });
        $('.input-number').focusin(function(){
        $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {
            
            minValue =  parseInt($(this).attr('min'));
            maxValue =  parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());
            
            name = $(this).attr('name');
            if(valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if(valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            
            
        });
        $(".input-number").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) || 
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                        // let it happen, don't do anything
                        return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
        });
    </script>

@endsection