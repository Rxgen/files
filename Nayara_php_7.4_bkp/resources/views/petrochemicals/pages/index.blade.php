@extends('layouts.welcome')
@section('content')
<section class="innerPage-banner-container innerPage-background">
    <picture>
        <source srcset="{{ Voyager::image($page->mobile_banner) }}" media="(max-width: 767px)" />
        <img class="innerBanner-img" src="{{ Voyager::image($page->desktop_banner) }}" alt="banner" class="innerBanner-img" />
    </picture>
    <h1 class="innerBanner-title innerBanner-font">{!! $page->banner_title !!}</h1>
</section>
@if($page->primary_slug == 'petrochemicals')
@include('includes.bread-crumbs')
@endif

@if($page->primary_slug == 'institutional-business')
<ul class="breadcrumbs-block wrap-clear">
    <li><a href="{{url('/')}}">Home</a></li>
    @foreach($breadcrumbs as $value)
    <li>
        @if($value['title'] === 'institutional business')
        <a href="{{ route('static.contact', ['slug' => 'institutional-business']) }}">{{$value['title']}}</a>
        @else
        {{$value['title']}}
        @endif
    </li>
    @endforeach
</ul>
@endif
{!! $page->body !!}

@if(!empty($additionalHtml))
{!! $additionalHtml !!}
@endif
@endsection