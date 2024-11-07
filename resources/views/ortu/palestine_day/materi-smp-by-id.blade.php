@extends ('ortu.layouts.app')

@section('content')
    <div class="top-navigate sticky-top">
        <div class="d-flex" style="justify-content: stretch; width: 100%;">
            <a onclick="window.history.go(-1); return false;" class="mt-1" style="text-decoration: none; color: black">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h4 class="mx-2"> {{$materi->judul}} </h4>
        </div>
    </div>    
    
    <div class="container">
        <h6> Ikuti Langkah ini :</h6>
        <p> <span class="number-background center text-white"> 1 </span>  Lihat dan baca konten yang ada dibawah ini :  </p>
        <div class="container" style="background-color: #EFEFEF; border-radius: 1rem">
            <p class="deskripsi-konten"> {{$materi->deskripsi}} </p>
        </div>
        <p> <span class="number-background center text-white mt-3"> 2 </span>  Download asset pada link di bawah ini :  </p>
        <div class="center">
            <a href="#" class="btn btn-primary px-5" style="border-radius: 1rem">
                <h6 class="mt-1"> Link Asset Palestine Day </h6 class="mt-1">
            </a>
        </div>
        <p> <span class="number-background center text-white mt-3"> 3 </span>  Kreasikan oleh kalian dengan desain yang menarik. Jika sudah selesai, kirim kepada guru kelas masing-masing. Guru akan menilai hasil kreatifitas kalian.  </p>
    </div>
@endsection