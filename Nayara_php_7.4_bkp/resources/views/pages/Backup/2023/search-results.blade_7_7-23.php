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
<section class="only-container search-page-cont">
	<div class="srch_rslt_form_blk">
        <form class="srch_rslt_blk" action="{{url(route('search_result'))}}">
            <input type="search" name="txt" placeholder="Enter your keywords" class="srch_rslt_input">
            <input type="submit" value="search" class="srch_rslt_btn">
        </form>
    </div>
	<script async src="https://cse.google.com/cse.js?cx=015322309963132319884:9xyb8zp48cc"></script>
	<div class="gcse-searchresults-only"></div>
	<!-- <script async src="https://cse.google.com/cse.js?cx=006668303133136004969:8izn1zhsqqw"></script>
	<div class="gcse-searchresults-only" data-personalizedAds="false"></div> -->
</section>
@stop