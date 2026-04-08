@extends('layouts.newstatic')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="Apply Online for petrol pump franchisee" class="innerBanner-img">
    </picture>
    <h1 class="innerBanner-title">{!! $page[0]->banner_title !!}</h1>
</section>
@endif
@include('includes.bread-crumbs')
<section class="sustainableInner-container investorPages-container">
	@if(isset($content))
	@if(count($content) > 0)
	@foreach($content as $content)
    <div class="sustainableInner-content-block wrap-clear">
        <h3 class="sustainable-title">{{$content->title}}</h3>
        <div class="livelihood-img-block">
            <img src="{{Voyager::image($content->image)}}" alt="livelihood" >
        </div>
        {{-- @if(!empty($content->partner))
        <p><strong>Partners:</strong> {{$content->partner}}</p>
        @endif --}}
        {!! $content->description !!}
    </div>
    @endforeach
    @endif
    @endif
</section>
@stop