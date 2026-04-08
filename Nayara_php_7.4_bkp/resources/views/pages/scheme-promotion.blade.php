@extends('layouts.welcome')
@section('content')

@if(count($page) > 0)
<section class="innerPage-banner-container scheme_banner">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="{{$page[0]->img_alt}}" class="innerBanner-img">
    </picture>
    <h1 class="Mahabachat Utsav">{{$page[0]->banner_title}}</h1>
</section>
@endif
@include('includes.bread-crumbs')
@if(count($page) > 0)
<section class="jeet_section">
<div class="jeet_container">
<a href=" {{ asset('images/Select-Retail-Outlets.pdf') }}" class="cta gradient-cta theme-gradient" download target="_blank">
                        <span class="gradient-cta-overlay gradient-text theme-gradient">Participation List</span>
                    </a>
                    <a href=" {{ asset('images/Maha-Bachat-Utsav-FAQs.pdf') }}" class="cta gradient-cta theme-gradient" target="_blank" download>>
                        <span class="gradient-cta-overlay gradient-text theme-gradient">FAQ</span>
                    </a>
                    <a href=" {{ route('static.contact', ['slug' =>'condition']) }}" class="cta gradient-cta theme-gradient" target="_blank">
                        <span class="gradient-cta-overlay gradient-text theme-gradient">T & C</span>
                    </a>                    
                      
</div>
</section>


@endif
@stop
