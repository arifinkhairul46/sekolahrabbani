@extends ('ortu.layouts.app')

@section('content')    
    <div class="top-navigate sticky-top">
        <div class="d-flex" style="justify-content: stretch; width: 100%;">
            <a onclick="window.history.go(-1); return false;" class="mt-1" style="text-decoration: none; color: black">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h4 class="mx-2"> Materi Palestine Day SMP </h4>
        </div>
    </div>

    <div class="d-grid-card">
        @foreach ($materi as $item)
            <a href="{{route('materi-smp-by-id', $item->id)}}" target="_blank" style="text-decoration: none">
                <div class="card catalog mb-1">
                    @if ($item->image == null || $item->image == "")
                    <img src="{{ asset('assets/images/img-palestine-1.png') }}" class="card-img-top cover-img-smp" alt="palestine" style="max-height: 180px">
                @else
                    <img src="{{ asset('storage/'.$item->image) }}" class="card-img-top cover-img-smp" alt="palestine" style="max-height: 180px">
                @endif
                    <div class="card-body pt-1">
                        <h6 class="card-title mb-0" style="color: #{{$item->style}}">{{$item->judul}}</h6>
                        <p class="mb-1" style="font-size: 12px"><i>Terbit : {{date('d-F-Y', strtotime($item->terbit))}} </i> </p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
