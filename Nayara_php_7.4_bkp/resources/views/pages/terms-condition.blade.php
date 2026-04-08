@extends('layouts.newstatic')
@section('content')
{{--<section class="innerPage-banner-container scheme_banner">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="$page[0]->img_alt" class="innerBanner-img">
    </picture>
    <h1 class="innerBanner-title">{{$page[0]->banner_title}}</h1>
</section>--}}
@include('includes.bread-crumbs')
{!! $page[0]->body !!}
@stop