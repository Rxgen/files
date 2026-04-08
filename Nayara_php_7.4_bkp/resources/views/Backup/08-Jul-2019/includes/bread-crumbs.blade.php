<ul class="breadcrumbs-block wrap-clear">
    <li><a href="{{url('/')}}">Home</a></li>
    @foreach($bread_crumbs as $crumb => $value)
    @if(array_key_exists('active', $value) == FALSE)
    <li>
        <a href="{{url($value['parent'][0]['url'])}}">{{$value['parent'][0]['title']}}</a>
        <ul class="dropDown-breadcrumbs-menu">
            @foreach($value['child'] as $child)
            <li><a href="{{url($child['url'])}}">{{$child['title']}}</a></li>
            @endforeach
        </ul>    
    </li>
    @else
    <li class="active"><a href="{{url($value['active'][0]['url'])}}">{{$value['active'][0]['title']}}</a></li>
    @endif
    @endforeach
</ul>