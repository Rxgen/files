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

<section class="only-container search-page-cont">
    <style>
        .resultDetailsx{
            margin-bottom: 25px;
        }
        
        .resultDetailsx .resultTitle{
            font-size: 18px;
            display: block;
            margin-bottom: 5px;
            color: #054289;
        }
        .resultDetailsx .resultUrl{
            font-size: 16px;
            color: rgb(0, 153, 51);
        }

        .resultDescrption{
            font-size: 14px;
            margin-top: 5PX;
        }
    </style>
	<div class="srch_rslt_form_blk">
        <br><br><br><br><br><br><br>
       <div class="resultDetailsx">
       <a class="resultTitle"href="{{$pageUrl}}">{!! $users[0]->banner_title !!}</a> 
       <a class="resultUrl" href="{{$pageUrl}}">{{$pageUrl}}</a> 
       <p class="resultDescrption">{{ $users[0]->meta_description }}</p>  
       </div>
    </div>
</section>
@stop