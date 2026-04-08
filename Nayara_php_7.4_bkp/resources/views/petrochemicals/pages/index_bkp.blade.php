@extends('layouts.welcome')
@section('content')
<section class="innerPage-banner-container innerPage-background">
   <picture>
        <source srcset="{{ Voyager::image($page->mobile_banner) }}" media="(max-width: 767px)" />
        <img class="innerBanner-img" src="{{ Voyager::image($page->desktop_banner) }}" alt="banner" 
        class="innerBanner-img"/>
    </picture>
    <h1 class="innerBanner-title innerBanner-font">{!! $page->banner_title !!}</h1>
</section>
@include('includes.bread-crumbs')
{!! $page->body !!}

@if(!empty($additionalHtml))
    {!! $additionalHtml !!}

@endif
@endsection
