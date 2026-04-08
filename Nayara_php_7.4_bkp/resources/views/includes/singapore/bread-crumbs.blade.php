<ul class="breadcrumbs-block wrap-clear">
    <li><a href="{{url('/singapore')}}">Home</a></li>
    @foreach($breadcrumbs as $crumb => $value)
    @if($value['active'])
        <li class="active" >
            <a href="{{url($value['url'])}}">{{$value['title']}}</a>   
        </li>
    @else
        <li>
            <a href="javascript:;">{{$value['title']}}</a>   
        </li>
    @endif
    @endforeach
</ul>