<div  class="menu-bottom">
  <div class="row" style="justify-content: center;">
    @foreach($menubar as $item)
      <a href="home" class="col text-center">
        <i class="{{$item->icon}}"></i>
        <br />
        <span style="font-size: 10px;"> {{$item->name}}</span>
      </a>
    @endforeach
  </div>
</div>