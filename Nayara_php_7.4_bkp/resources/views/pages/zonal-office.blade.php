@extends('layouts.newstatic')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="{{$page[0]->img_alt}}" title="{{$page[0]->img_title}}" class="innerBanner-img">
    </picture>
    @if(collect(request()->segments())->last() === 'bulk-business')
    <h1 class="innerBanner-title innerBanner-sm-title">{!! $page[0]->banner_title !!}</h1>
    @else
    <h1 class="innerBanner-title">{!! $page[0]->banner_title !!}</h1>
    @endif
</section>
@endif
@include('includes.bread-crumbs')
<section class="contact-content-container zonal-offices-container"> 
    <div class="contact-contactDetail-container zonal-offices-row">
    	@if(count($offices) > 0)
    	@foreach($offices as $office)
        <div class="contact-address-block">
            <div class="contact-address-title">
                {{$office->zone}}
            </div>
            <div class="company-name-title">
                Nayara Energy Limited
            </div>

            <address>
                {!! $office->address !!}
                <div class="phone-contact zonal-phone-contact">
                    <span>
                        Telephone: 
                    </span>
                    <span>
                    	@if(!empty($office->tel_line_1))
                        <a href="tel:{{str_replace(' ', '',$office->tel_line_1)}}">{{$office->tel_line_1}}</a>
                        @endif
                        @if(!empty($office->tel_line_2))
                        <a href="tel:{{str_replace(' ','',$office->tel_line_2)}}">{{$office->tel_line_2}}</a>
                        @endif
                    </span>
                </div>
            </address>

            <a class="zonal_location" href="{{$office->location_url}}" target="_blank"> 
                <span>View Location</span> 
            </a>
        </div>
        @endforeach
        @endif
    </div>
</section>
@stop