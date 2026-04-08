@extends('layouts.static')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="{{$page[0]->img_alt}}" title="{{$page[0]->img_title}}" class="innerBanner-img">
    </picture>
    @if(collect(request()->segments())->last() === 'bulk-business')
    <h2 class="innerBanner-title innerBanner-sm-title">{!! $page[0]->banner_title !!}</h2>
    @else
    <h2 class="innerBanner-title">{!! $page[0]->banner_title !!}</h2>
    @endif
</section>
@endif
@include('includes.bread-crumbs')
<section class="divisional-office-page"> 
    <div class="divisional_office_row">
        <div class="diviOffice_dropDown_col">
            <h3 class="heading_ttl_big">Marketing Divisional Office</h3>
            <h4 class="heading_ttl divi_heading_ttl">Divisional Offices</h4>
            <div class="divi_dropDownBlk">
                <div class="label_select_city">
                    Select Your City
                </div>
                <input type="hidden" id="ajax_office_route" value="{{route('ajax_divisional_office')}}">
                <label class="diviOffic_select_city" for="select-city"> 
                    <select id="select-city" class="input-container select_city_dropdown">
                        <option value="">Select City</option>
                       	@if(count($cities) > 0)
                       	@foreach($cities as $city)
                       	<option value="{{$city->id}}">{{$city->district}}</option>
                       	@endforeach
                       	@endif   
                    </select>
                </label>
            </div>
        </div>
        <div class="diviOffice_adress_col">
            
        </div>
    </div>
</section>
@stop