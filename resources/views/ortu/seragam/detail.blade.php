@extends ('ortu.layouts.app')

@section('content')
    @include('ortu.seragam.top-navigate')
    <div id="image-carousel" class="carousel slide px-0">
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
            <input type="hidden" id="produk_id" value="{{$produk->id}}">
            <div class="produk-title mt-3">
                <h5 class="card-title mb-0">{{$produk->nama_produk}}</h5>
                <p class="mb-1 price-diskon-detail" ><b> Rp. {{number_format($produk->harga * 80/100)}}/set </b> </p>
                <p class="mb-0" style="font-size: 16px"> Discount 
                    <span class="bg-danger py-1 px-2"> {{($produk->diskon)}}% </span>
                    <span class="mx-2" style="color: gray"> <s> Rp. {{number_format($produk->harga)}} </s> </span>
                </p>
            </div>

            <div class="produk-deskripsi mt-4">
                <h6 style="color:  #3152A4"><b> Deskripsi Produk </b> </h6>
                <p style="font-size: 14px"> {{$produk->deskripsi}} </p>
            </div>
    
            <div class="produk-material mt-3">
                <h6 style="color: #3152A4"><b> Material </b> </h6>
                <p style="font-size: 14px"> {{$produk->material}} </p>
            </div>          
        </div>

        
    </div>
    <div class="bottom-navigate sticky-bottom">
        <div class="d-flex" style="justify-content: end">
            <a href="#" class="btn btn-primary px-3" data-bs-toggle="modal" data-bs-target="#buy_now" > <i class="fa-solid fa-plus"></i> Keranjang </a>
            <a href="#" class="btn btn-purple mx-2 px-3" data-bs-toggle="modal" data-bs-target="#buy_now" > Beli Sekarang </a>
        </div>
    </div>

    <div class="modal fade" id="buy_now" tabindex="-1" role="dialog" aria-labelledby="beli_sekarang" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="align-items: flex-end">
            <div class="modal-content animate-bottom ">
                <div class="modal-body">
                    <div class="d-flex mx-1" style="justify-content: space-between">
                        <div class="frame">
                            <img src="{{asset('assets/images/'.$produk->image)}}" width="100%" style="height: 100%; object-fit:cover; border-radius:1rem">
                        </div>
                        <div class="mx-2 mt-2" style="width: 255px">
                            <div class="titel">
                                <p class="card-title mb-0"> <b> {{$produk->nama_produk}} </b> </p>
                                <p class="mb-1 price-diskon" style="font-size: 24px"> <b> Rp. <span id="harga_diskon"> {{number_format(($produk['harga']) - ($produk['diskon']/100 * $produk['harga'])) }} </span> </b> </p>
                                <p class="mb-0" style="font-size: 13px"> Discount 
                                    <span class="bg-danger py-1 px-2" id="diskon_persen"> {{($produk->diskon)}}% </span>
                                    <span class="mx-2" style="color: gray"> <s> Rp. <span id="harga_awal"> {{number_format($produk->harga)}} </span> </s> </span>
                                </p>
                            </div>
                        </div>
                        <div class="close">
                            <a style="color:gray; text-decoration:none" data-bs-dismiss="modal" ><i class="fa-solid fa-chevron-down"></i></a>
                        </div>
                    </div>
    
                    <div class="produk-detail d-flex">
                        <div class="frame-detail">
                            <img src="{{asset('assets/images/'.$produk->image_2)}}" width="100%" style="height: 100%; object-fit:cover; border-radius:1rem">
                        </div>
                        <div class="frame-detail">
                            <img src="{{asset('assets/images/'.$produk->image_3)}}" width="100%" style="height: 100%; object-fit:cover; border-radius:1rem">
                        </div>
                        <div class="frame-detail">
                            <img src="{{asset('assets/images/'.$produk->image_4)}}" width="100%" style="height: 100%; object-fit:cover; border-radius:1rem">
                        </div>
                    </div>

                    <div class="produk-jenis mt-3">
                        <div class="d-flex">
                            @foreach ($jenis_produk as $item)
                                <div class="button-jenis">
                                    <input class="form-check-input" type="radio" name="jenis_{{$produk->id}}" id="jenis_{{$produk->id}}_{{$item->id}}" value="{{$item->id}}" {{$item->id == 1 ? 'checked' : ''}}>
                                    <label class="form-check-label" for="jenis_{{$produk->id}}_{{$item->id}}">
                                    <span> {{$item->jenis_produk}} </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <span class="mb-0 text-danger" style="font-size: 10px; display: none" id="valid_jenis_{{$produk->id}}" > Pilih jenis seragam terlebih dahulu! </span>

                    </div>
                    
                    <div class="produk-ukuran mt-3">
                        <h6 style="color: #3152A4"><b> Ukuran </b> </h6>
                        <div class="d-flex">
                            <div class="button-ukuran">
                                <input class="form-check-input" type="radio" name="ukuran_{{$produk->id}}"  id="uk_s_{{$produk->id}}" value="S">
                                <label class="form-check-label" for="uk_s_{{$produk->id}}">
                                <span>S </span>
                                </label>
                            </div>
                            <div class="button-ukuran">
                                <input class="form-check-input" type="radio" name="ukuran_{{$produk->id}}" id="uk_m_{{$produk->id}}" value="M">
                                <label class="form-check-label" for="uk_m_{{$produk->id}}">
                                <span>M </span>
                                </label>
                            </div>
                            <div class="button-ukuran">
                                <input class="form-check-input" type="radio" name="ukuran_{{$produk->id}}" id="uk_l_{{$produk->id}}" value="L">
                                <label class="form-check-label" for="uk_l_{{$produk->id}}">
                                <span>L </span>
                                </label>
                            </div>
                            <div class="button-ukuran">
                                <input class="form-check-input" type="radio" name="ukuran_{{$produk->id}}" id="uk_xl_{{$produk->id}}" value="XL">
                                <label class="form-check-label" for="uk_xl_{{$produk->id}}">
                                    <span>XL</span>
                                </label>
                            </div>
                        </div>
                        <span class="mb-0 text-danger" style="font-size: 10px; display: none" id="valid_ukuran_{{$produk->id}}" > Pilih ukuran terlebih dahulu! </span>
                    </div>
                    
                    <div class="produk-jumlah my-4">
                        <h6 class="mt-1" style="color: #3152A4"><b> Jumlah </b> </h6>
                        <div class="input-group mx-3" style="border: none;">
                            <div class="button minus">
                                <button type="button" class="btn btn-outline-plus-minus btn-number" disabled="disabled" data-type="minus" data-field="quant[{{$produk->id}}]">
                                    <i class="fas fa-minus-circle"></i>
                                </button>
                            </div>
                            <input type="text" name="quant[{{$produk->id}}]" id="quant_{{$produk->id}}" class="input-number" value="1" min="1" max="10">
                            <div class="button plus">
                                <button type="button" class="btn btn-outline-plus-minus btn-number" data-type="plus" data-field="quant[{{$produk->id}}]">
                                    <i class="fas fa-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="produk-siswa d-flex">
                        <h6 class="mt-1" style="color: #3152A4; width: 150px;"><b> Nama Siswa </b> </h6>
                        <select id="nama_siswa" name="nama_siswa" class="select form-control form-control-sm px-3" required>
                            @foreach ($profile as $item)
                                <option value="{{ $item->nis }}" >{{ $item->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex mt-3" style="justify-content: end">
                        <button type="button" class="btn btn-primary px-3 " onclick="addToCart('{{$produk->id}}', '{{auth()->user()->name}}')" > <i class="fa-solid fa-plus"></i> Keranjang </button>
                        <form action="{{route('seragam.bayar')}}">
                            <input type="hidden" name="data" id="data" value="">
                            <button type="submit" class="btn btn-purple mx-2 px-3" > Beli Sekarang </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                    if(parseInt(input.val()) == input.attr('min')) {
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

        var item_id = $('#produk_id').val();
        // console.log(item_id);

        $('input[name="jenis_'+item_id+'"]').change(function(){
            // Do something interesting here
          
            var jenis_id = $('input[name="jenis_'+item_id+'"]:checked').val();

            $.ajax({
                url: "{{route('harga_per_jenis')}}",
                type: 'POST',
                data: {
                    jenis_id: jenis_id,
                    produk_id : item_id,
                    _token: '{{csrf_token()}}'

                },
                success: function (result) {
                    $.each(result, function (key, item) {
                        var harga = parseInt(item.harga);
                        var diskon = parseInt(item.diskon);
                        var harga_diskon = (harga - diskon/100*harga);
                        var formatter = new Intl.NumberFormat("en-US");
                        var format_harga = formatter.format(harga);
                        var format_harga_diskon = formatter.format(harga_diskon);
                        $("#harga_awal").html(format_harga);
                        $("#harga_diskon").html(format_harga_diskon)
                    });
                }
            })
        });
        

        var cart_now = $('#count_cart').html();
        var cart_num = parseInt(cart_now);

        function addToCart(id, nama_anak) {
            var item_id = id;
            var ukuran = $('input[name="ukuran_'+item_id+'"]:checked').val();
            var jenis = $('input[name="jenis_'+item_id+'"]:checked').val();
            var quantity = $('.input-number').val();
            var nama_siswa = $('#nama_siswa').val();
            

            if (ukuran == '' || ukuran == null || ukuran == undefined) {
                $('#valid_ukuran_'+item_id).show();
            } else if (jenis == '' || jenis == null || jenis == undefined)  {
                $('#valid_jenis_'+item_id).show();
            } else {
                $('#valid_ukuran_'+item_id).hide(); 
                $('#valid_jenis_'+item_id).hide();

                $.ajax({
                    url: "{{route('cart_post')}}",
                    type: 'POST',
                    data: {
                        produk_id : item_id,
                        ukuran : ukuran,
                        quantity : quantity,
                        jenis: jenis,
                        nama_siswa: nama_siswa,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (result) {
                        var qty_now = cart_num + 1
                        $('#count_cart').html(qty_now)
                    }
                })

                $('#buy_now').modal('hide')
                
            }
            
        }

        var pesanan = []
        function buy_now(id) {
            var new_pesanan = {};
            var item_id = id;
            var ukuran = $('input[name="ukuran_'+item_id+'"]:checked').val();
            var jenis = $('input[name="jenis_'+item_id+'"]:checked').val();
            var quantity = $('.input-number').val();
            var nama_siswa = $('#nama_siswa').val();

            if (ukuran == '' || ukuran == null || ukuran == undefined) {
                $('#valid_ukuran_'+item_id).show();
            } else if (jenis == '' || jenis == null || jenis == undefined)  {
                $('#valid_jenis_'+item_id).show();
            } else {
                $('#valid_ukuran_'+item_id).hide(); 
                $('#valid_jenis_'+item_id).hide();

                new_pesanan['produk_id'] = item_id;
                new_pesanan['ukuran'] = ukuran;
                new_pesanan['jenis'] = jenis;
                new_pesanan['quantity'] = quantity;
                new_pesanan['nama_siswa'] = nama_siswa;

                pesanan.push(new_pesanan);
                console.log(pesanan);
                $('#data').val(JSON.stringify(pesanan));

            }
        }

        function submit_cart() {
            $('#cart_submit').submit();
        }

    </script>

@endsection