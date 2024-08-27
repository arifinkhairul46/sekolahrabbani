<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link href="{{ asset('assets/images/logo_rsu.png') }}" rel="icon" type="image/jpg">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css?v=').time() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"  type='text/css'> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    {{-- <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'> --}}


</head>
<body>
    <div class="d-flex">
        <div class="w-half">
            <img src="{{ asset('assets/images/logo-yayasan_1.png') }}" alt="logo" width="150" />
        </div>
        <div class="bg-tk text-white p-2">
            <h5 class="mb-0"> Yayasan Rabbani Asysa </h5>
            <p class="mb-1" style="font-size: 12px"> Jl. Jati No.5, Cisaranten Kulon, Kec. Arcamanik, Kota Bandung, Jawa Barat 40293 </p>
            <h4>Bukti Pembayaran</h4>
        </div>
    </div>
 
    <div class="mt-5 px-3">
        <table class="w-full">
            <tr>
                <td>
                    <h6>Kepada :</h6>
                    <div> {{$order->nama_pemesan}} </div>
                    <div> {{$order->no_hp}} </div>
                </td>

                <td style="width: 35%">
                </td>

                <td >
                    <p class="mb-0" style="font-size: 14px">Invoice No: {{$order->no_pemesanan}} </p>
                    <div style="font-size: 14px">Tanggal : {{date('d-m-Y', strtotime($order->created_at))}} </div>
                    {{-- <div> <p>&nbsp;</p> </div> --}}
                </td>
            </tr>
        </table>
    </div>
 
    <div class="my-4 px-3">
        <table class="table table-stripped">
            <thead >
                <tr>
                    <th class="bg-thead">No</th>
                    <th class="bg-thead">Deskripsi Item</th>
                    <th class="bg-thead">Harga</th>
                    <th class="bg-thead" style="width: 8%">Jumlah</th>
                    <th class="bg-thead" style="width: 25%">Total</th>
                </tr>
            </thead>
            <tbody style="font-size: 13px">
                <?php $total_harga = 0; ?>
                @foreach($order_detail as $item)
                
                <tr class="items">
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{ $item->nama_produk }} {{$item->jenis_produk}} ({{$item->ukuran}})
                    </td>
                    <td>
                        {{ number_format($item->harga) }}
                    </td>
                    <td style="text-align: center">
                        {{ $item->quantity }}
                    </td>
                    <td>
                        Rp {{ number_format($item->harga *  $item->quantity)}}
                    </td>
                </tr>
                <?php $total_harga += $item->harga * $item->quantity; ?>

                
                @endforeach
                <input type="text" style="display: none" value="{{ 80/100 * $total_harga}}" id="harga_akhir">
                <tr>
                    <td colspan="3"></td>
                    <td><span style="font-size: 13px">Sub Total</span></td>
                    <td id="total_harga" colspan="2"><span style="font-size: 13px">Rp {{number_format($total_harga)}} </span></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td><span style="font-size: 13px">Diskon 20%</span></td>
                    <td id="diskon" colspan="2"><span style="font-size: 13px">Rp {{number_format(20/100 * $total_harga)}}</span></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td><span style="font-size: 13px">Total Harga</span></td>
                    <td colspan="2"><span style="font-size: 13px"><b>Rp {{number_format(80/100 * $total_harga)}} </b> <button style="border: none" id="copy_harga"> </button> </span></td>
                </tr>
            </tbody>
        </table>
    </div>
 

    <div class="my-4 px-3">Terimakasih</div>
 
    <div class="footer-invoice bg-thead">
        <div class="d-flex p-2" style="justify-content: space-between; background-color:#3FA2F6">
            <div class="web">
                <i style="color: white" class="fa-solid fa-globe"></i>
                <span class="text-white" style="font-size: 10px"> www.sekolahrabbani.sch.id</span>
            </div>
            <div class="ig">
                <i style="color: white" class="fa-brands fa-instagram"></i>
                <span class="text-white" style="font-size: 10px">sekolahrabbani</span>
            </div>
            <div class="wa">
                <i style="color: white" class="fa-brands fa-whatsapp"></i>
                <span class="text-white" style="font-size: 10px">+62 851-7327-3274</span>
            </div>
        </div>
    </div>
</body>
</html>