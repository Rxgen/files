@extends('layouts.newstatic')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="{{$page[0]->img_alt}}" title="{{$page[0]->img_title}}" class="innerBanner-img">
    </picture>
    <h1 class="innerBanner-title">{!! $page[0]->banner_title !!}</h1>
</section>
@endif
@include('includes.bread-crumbs')
<input type="hidden" id="post" value="{{ route('ajax') }}">
<section class="investorPages-container innerTop">
    <div class="innerPage-content innerMargin">
        <h4 class="innerPageTitle theme-gradient-alpha gradient-text">Voice of Nayara</h4>
        <!-- <div class="innerGrid">
            @foreach($latestblogs as $latestblog)
            <div class="innerGrid__sect">
                <a href="{{ url(route('blog.detail',['slug' => $latestblog->slug])) }}">
                    <input type="hidden" id="postid" value="{{ $latestblog->id }}">
                    <img src="{{Voyager::image($latestblog->Image)}}" alt="" class="">
                    <div class="innerGrid__sect--text">
                        <div class="company-name-title">{{$latestblog->title}}</div>
                        <div class="like" data-id="{{ $latestblog->id }}"><span><svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                    <g>
                                        <path fill="#9ad2ee" d="M449.28 121.43a115.2 115.2 0 0 0-137.89-35.75c-21.18 9.14-40.07 24.55-55.39 45-15.32-20.5-34.21-35.91-55.39-45a115.2 115.2 0 0 0-137.89 35.75c-16.5 21.62-25.22 48.64-25.22 78.13 0 42.44 25.31 89 75.22 138.44 40.67 40.27 88.73 73.25 113.75 89.32a54.78 54.78 0 0 0 59.06 0c25-16.07 73.08-49.05 113.75-89.32 49.91-49.42 75.22-96 75.22-138.44 0-29.49-8.72-56.51-25.22-78.13z" data-original="#f9595f" class=""></path>
                                    </g>
                                </svg></span></div>
                        <span class="text" data-index="{{ $latestblog->id }}" id="post_{{ $latestblog->id }}">{{$latestblog->likes}}</span>

                    </div>
                </a>
                <a href="{{ route('blog.detail', ['slug' => $latestblog->slug])}}">Read More </a>
            </div>
            @endforeach
        </div> -->

        <div class="innerGrid innerGrid2">
            @foreach($blogposts as $blogpost)
            <div class="innerGrid__sect innerGrid2__sect">
                <a href="{{ url(route('blog.detail',['slug' => $blogpost->slug])) }}">
                <input type="hidden" id="postid" value="{{ $blogpost->id }}">
                    <div class="gridImage"><img src="{{Voyager::image($blogpost->Image)}}" alt="{{ $blogpost->title }} " class=" "></div>
                    <div class="innerGrid__sect--text innerGrid2__sect--text">
                        <div class="company-name-title">{{$blogpost->title}}</div>
                        <div class="like" data-id="{{ $blogpost->id }}"><span><svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                    <g>
                                        <path fill="#9ad2ee" d="M449.28 121.43a115.2 115.2 0 0 0-137.89-35.75c-21.18 9.14-40.07 24.55-55.39 45-15.32-20.5-34.21-35.91-55.39-45a115.2 115.2 0 0 0-137.89 35.75c-16.5 21.62-25.22 48.64-25.22 78.13 0 42.44 25.31 89 75.22 138.44 40.67 40.27 88.73 73.25 113.75 89.32a54.78 54.78 0 0 0 59.06 0c25-16.07 73.08-49.05 113.75-89.32 49.91-49.42 75.22-96 75.22-138.44 0-29.49-8.72-56.51-25.22-78.13z" data-original="#f9595f" class=""></path>
                                    </g>
                                </svg></span>
                                <span class="text" data-index="{{ $blogpost->id }}" id="post_{{ $blogpost->id }}">{{$blogpost->likes}}</span>
                            </div>
                            
                    </div>
                </a>
            </div>
            @endforeach
        </div>
</section>
@stop

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.like').click(function(e) {
            e.preventDefault();
            //alert('Press the button');
            let id = $(this).attr("data-id");
            $.ajax({
                url: $('#post').val(),
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    postid: id,
                },
                success: function(responce) {
                    let dynamic = document.getElementById('post_' + id);
                    let dynamic_id = dynamic.id;
                    $("#" + dynamic_id).text(responce.like);
                },
                error: function(response) {
                    /* $('#nameErrorMsg').text(response.responseJSON.errors.name);*/
                },
            })

        });
    });
</script>