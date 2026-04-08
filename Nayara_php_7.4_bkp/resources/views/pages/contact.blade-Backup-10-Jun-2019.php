@extends('layouts.static')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="Apply Online for petrol pump franchisee" class="innerBanner-img">
    </picture>
    <h2 class="innerBanner-title">{!! $page[0]->banner_title !!}</h2>
</section>
@if (collect(request()->segments())->last() === 'apply-online')
<input value="{{route('populate_states')}}" type="hidden" class="states_url" />
<input value="{{route('form_url')}}" type="hidden" class="apply_form_submit" />
@endif
@if (collect(request()->segments())->last() === 'retail-outlet-locator')
<input value="{{route('get.ro')}}" type="hidden" class="find-ro-url" />
<input value="{{route('get.code-ro')}}" type="hidden" class="ro-code-url" />
@endif
@endif
@include('includes.bread-crumbs')
@if(count($page) > 0)
{!! $page[0]->body !!}
@endif
@stop