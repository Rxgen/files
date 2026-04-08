@extends('layouts.static')
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

<section class="investorPages-container">
            <div class="innerPage-content innerMargin innerBottom">
                <h4 class="innerPageTitle theme-gradient-alpha gradient-text">{{$post->title}}</h4>
                {!! $post->body !!}
                </div>
</section>
<section class="gridBg">
            <section class="investorPages-container">
                <div class="innerPage-content innerMargin">
                    <div class="innerText company-name-title">Related Article</div>
                    <div class="innerGrid innerGrid2">
                    @foreach($blogrelatedposts as $blogrelatedpost)
                        <div class="innerGrid__sect innerGrid2__sect">
                        <a href="{{ url(route('blog.detail',['slug' => $blogrelatedpost->slug])) }}">
                        <div class="gridImage"><img src="{{Voyager::image($blogrelatedpost->Image)}}" alt="" class=""></div>
                                <div class="innerGrid__sect--text innerGrid2__sect--text">
                                    <div class="company-name-title">{{$blogrelatedpost->title}}</div>
                                    <div class="like"><span><svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path fill="#9ad2ee" d="M449.28 121.43a115.2 115.2 0 0 0-137.89-35.75c-21.18 9.14-40.07 24.55-55.39 45-15.32-20.5-34.21-35.91-55.39-45a115.2 115.2 0 0 0-137.89 35.75c-16.5 21.62-25.22 48.64-25.22 78.13 0 42.44 25.31 89 75.22 138.44 40.67 40.27 88.73 73.25 113.75 89.32a54.78 54.78 0 0 0 59.06 0c25-16.07 73.08-49.05 113.75-89.32 49.91-49.42 75.22-96 75.22-138.44 0-29.49-8.72-56.51-25.22-78.13z" data-original="#f9595f" class=""></path></g></svg></span></div>
                                    <span class="text" data-index="{{ $blogrelatedpost->id }}" id="post_{{ $blogrelatedpost->id }}">{{$blogrelatedpost->likes}}</span>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
</section>
@stop
