
@if(!empty($brand))
<nav aria-label="breadcrumb" class="-intro-x h-[45px] mr-auto">
    <ol class="breadcrumb breadcrumb-light">
        @foreach ( $brand as $row => $value )
         <li class="breadcrumb-item {{ $value['class'] }}"><a href="{!! $value['route'] !!}">{!! $value['name'] !!}</a></li>
        @endforeach
    </ol>
 </nav>
 @endif
