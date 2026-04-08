@extends('layouts.newstatic')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="Petrochemicals" title="Petrochemicals image" class="innerBanner-img">
    </picture>
    <h1 class="innerBanner-title">{!! $page[0]->banner_title !!}</h1>
</section>
@endif
@include('includes.bread-crumbs')
{!! $page[0]->body !!}

<!---Below Section is Comment As per the client requirement -->
{{--<section class="ip-apply whoWe-are-container wrap-clear">
            <h4 class="bm_network_join_sub_heading gradient-text theme-gradient-alpha">DCA Application</h4>
            <a href="{{url('retail/petrol-pump-dealership-apply')}} " class="retail-network-join__cta apply ip-shadow">
                <img src="{{asset('images/mouse.png')}}" alt="Mouse" class="retail-network-join__cta_img">
                <div class="retail-network-join__cta_text">click to <span
                    class="retail-network-join__cta_highlight">Apply
            Online</span></div>
            </a>
</section>--}}
@stop