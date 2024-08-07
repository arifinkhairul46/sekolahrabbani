@extends ('ortu.layouts.app')

@section('content')    
    <div class="container">
        <div class="top-navigate mb-2">
            <div class="d-flex" style="justify-content: stretch; width: 100%">
                <a href="#" class="mt-3" style="text-decoration: none; color: black">
                    <i class="fa-solid fa-arrow-left fa-lg"></i>
                </a>
                <h4 class="mx-2"> Belanja </h4>
                <div class="input-group mx-2" style="width: 100% !important;">
                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                    <input class="form-control form-control-sm" style="border: none" placeholder="Cari" type="text" name="search" >
                </div>
                <a href="#" class="mt-3" style="text-decoration: none; color: black">
                    <i class="fa-solid fa-cart-shopping fa-lg"></i>
                </a>
            </div>
        </div>
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

                <input type="hidden" name="data" id="data" value="">
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
                input.val(0);
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

        var pesanan = [];

        function openModal(item_id) {
            var ukuran = $('input[name="ukuran_'+item_id+'"]:checked').val();
            if (ukuran == '' || ukuran == null || ukuran == undefined) {
                $('#valid_ukuran_'+item_id).show();
            } else {
                $("#produk_id_terpilih").val(item_id);
                $('#valid_ukuran_'+item_id).hide();
                $('#form_detail').modal('show');
            }
        }

        function addToCart() {
            var new_pesanan = {};
            var item_id = $("#produk_id_terpilih").val();
            var ukuran = $('input[name="ukuran_'+item_id+'"]:checked').val();
            var nama = $("#nama_siswa").val();
            var lokasi = $("#lokasi").val();
            var kelas = $("#kelas").val();
            if (nama == '') {
                $('#alert_nama').show()
            } else if (lokasi == null) {
                $('#alert_sekolah').show()
            } else if (kelas == '') {
                $('#alert_kelas').show()
            } else {
                new_pesanan['nama_siswa'] = $("#nama_siswa").val();
                new_pesanan['kelas'] = $("#kelas").val();
                new_pesanan['lokasi'] = $("#lokasi").val();
                new_pesanan['produk_id'] = item_id;
                new_pesanan['ukuran'] = ukuran;
                pesanan.push(new_pesanan);
                // console.log(pesanan);
                $('#alert_nama').hide()
                $('#alert_sekolah').hide()
                $('#alert_kelas').hide()

                $('#form_detail').modal('hide');
                $('#quantity_'+item_id).show();
                $('#quant_'+item_id).val(1);
    
                $('#data').val(JSON.stringify(pesanan));
                $('#btn-order-'+item_id).hide();
    
                $('#remove-btn-'+item_id).show();
                $('#remove-btn-'+item_id).attr('onclick', "remove_cart('"+item_id+"')");
            }
        }

        function remove_cart (item_id) {
            pesanan = pesanan.filter(data => data.produk_id !== item_id);
            $('#btn-order-'+item_id).show();
            $('#remove-btn-'+item_id).hide();
            $('#quantity_'+item_id).hide();


            $('#data').val(JSON.stringify(pesanan));
            // console.log(pesanan);

        }


        $(document).ready(function() {
            $("#btn-submit").click(function() {
                // disable button
                $(this).prop("disabled", true);
                // add spinner to button
                $(this).html(
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
                );
                $("#simpan_seragam").submit();
            });
        });
      
    </script>
@endsection

<div class="modal fade" id="form_detail" tabindex="-1" role="dialog" aria-labelledby="member_rbn" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="member_rbn">Untuk Siapa Seragam Ini</h5>
            </div>
            <div class="modal-body">
                <div class="form-floating mt-3">
                        <input class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Masukkan Nama Siswa" required>
                        <label for="nama_siswa" class="form-label">Nama Siswa</label>
                        <span id="alert_nama" class="text-danger" style="font-size: 10px; display:none;">Isi nama terlebih dahulu </span>
                </div>

                <div class="form-floating mt-3">
                    <select name="lokasi" id="lokasi" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Sekolah --</option>
                        @foreach ($lokasi as $item)
                            <option value="{{ $item->kode_lokasi }}"> {{ $item->sublokasi }}</option>
                        @endforeach
                    </select>
                    <label for="lokasi" class="form-label">Sekolah</label>
                    <span id="alert_sekolah" class="text-danger" style="font-size: 10px; display:none;">Isi Sekolah terlebih dahulu </span>
                </div>

                <div class="form-floating mt-3">
                    <input class="form-control" id="kelas" name="kelas" placeholder="Kelas" required>
                    <label for="kelas" class="form-label">Nama Kelas (contoh: 2 Badar)</label>
                    <span id="alert_kelas" class="text-danger" style="font-size: 10px; display:none;">Isi Kelas terlebih dahulu </span>
                </div>

                <input type="hidden" id="produk_id_terpilih">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" onclick="addToCart()">Simpan</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>