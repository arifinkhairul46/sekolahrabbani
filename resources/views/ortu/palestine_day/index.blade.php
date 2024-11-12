@extends ('ortu.layouts.app')

@section('content')    
    <div class="top-navigate sticky-top">
        <div class="d-flex" style="justify-content: stretch; width: 100%;">
            <a onclick="window.history.go(-1); return false;" class="mt-1" style="text-decoration: none; color: black">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h4 class="mx-2"> Pendidikan Palestine Day </h4>
        </div>
    </div>

    <div class="container mt-0 pt-0">
        <div class="center">
            <a style="text-decoration: none" href="{{route('palestine.tksd')}}"> 
                <img src="{{ asset('assets/images/palestine_day_tk_sd.png') }}" alt="pd_tk_sd" style="border-radius: 0.4rem" width="100%">
            </a>
        </div>

        @foreach ($get_jenjang as $item)
            @if ($item->sekolah_id == 'UBRSMP' || $item->user_id == 2)
                <div class="center mb-3">
                    <a style="text-decoration: none" href="{{route('palestine.smp')}}"> 
                        <img src="{{ asset('assets/images/palestine_day_smp.png') }}" alt="pd_smp" style="border-radius: 0.4rem" width="100%">
                    </a>
                </div>
            @endif
        @endforeach
    </div>
@endsection
