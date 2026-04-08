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
@endif
@include('includes.bread-crumbs')
@if(isset($reports) && !empty($reports))
<section class="investorPages-container">
    <h3 class="impact-policyTitle">Sustainability</h3>
    <div class="sustainability-container">
        <div class="sustainbility-title">Environment Clearance (EC) Compliance</div>
        <div class="governance-pdf-container all-reports-listingBlock wrap-clear">
        	@if(count($reports) > 0)
        	@foreach($reports as $report)
        	@php 
        	$file = json_decode($report->file);
        	@endphp
            <div class="pdfDownload-data">
                <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon">
                <div class="pdfdata-block">
                    <div class="pdf-name-title">
                    <span>Nayara Energy Limited </span>
                    {{$report->title}}</div>
                    <a href="{{Storage::url($file[0]->download_link)}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                        <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                    </a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
@endif
@stop