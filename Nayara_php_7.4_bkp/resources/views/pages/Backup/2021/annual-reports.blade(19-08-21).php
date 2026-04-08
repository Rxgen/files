@extends('layouts.static')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="{{$page[0]->img_alt}}" title="{{$page[0]->img_title}}" class="innerBanner-img">
    </picture>
    <h1 class="innerBanner-title">{!! $page[0]->banner_title !!}</h1>
</section>
@endif
@include('includes.bread-crumbs')
<section class="annual-reportPage-container investorPages-container">
@if(count($page) > 0)
{!! $page[0]->body !!}
@endif
<div class="search-block">
    <img src="{{asset('images/search-icon.png')}}" alt="search">
    <select id="year-change" class="yearSelection-annualReport">
        <option value="">Select Year</option>
        @if(!empty($report_years[0]->max_year) && !empty($report_years[0]->min_year))
        @for($i=$report_years[0]->max_year; $i>=$report_years[0]->min_year; $i--)
        <option value="{{$i}}">{{$i}}-{{(int)$i+1}}</option>
        @endfor
        @endif
    </select>
    <input type="hidden" class="ajax-url" value="{{route('ajax.report')}}">
</div>
<div id="report-div" class="all-reports-listingBlock annual-report-listing wrap-clear">
    @if($reports->isNotEmpty())
	@foreach($reports as $report)
	@if($report->is_subsidiaries == 0)
	@php
		$file = json_decode($report->file);
	@endphp
    <div class="pdfDownload-data">
        <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon">
        <div class="pdfdata-block">
            <div class="pdf-name-title">
               Annual Report ( {{ $report->year }} - {{ $report->year+1 }} )
            </div>
            <a href="{{URL::to(Storage::url($file[0]->download_link))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
            </a>
        </div>
    </div>
    @endif
    @endforeach  
    @endif 
</div>
{{-- <h2 class="annual-reportSubsidiaries-title">Annual Reports of Vadinar Oil Terminal Limited</h2>
<div class="search-block">
    <img src="{{asset('images/search-icon.png')}}" alt="search">
    <select id="year-select" class="yearSelection-annualReport">
        <option value="">Select Year</option>
        @for($i=$report_years[0]->max_year; $i>=$report_years[0]->min_year; $i--)
        <option value="{{$i}}">{{$i}}-{{(int)$i+1}}</option>
        @endfor
    </select>
    <input type="hidden" class="ajax-subsidiaryurl" value="{{route('ajax.subsidiary')}}">
</div>
<div id="subsidiary-div" class="all-reports-listingBlock annual-report-listing wrap-clear">
    @if(count($reports) > 0)
	@foreach($reports as $sub_report)
	@if($sub_report->is_subsidiaries == 1)
	@php
		$file = json_decode($sub_report->file);
	@endphp
    <div class="pdfDownload-data">
        <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon">
        <div class="pdfdata-block">
            <div class="pdf-name-title">
                <span>{{$sub_report->title}}</span>
               financial year {{ $sub_report->year }} - {{ $sub_report->year+1 }}
            </div>
            <a href="{{URL::to(Storage::url($file[0]->download_link))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
            </a>
        </div>
    </div>
    @endif
    @endforeach
    @endif
</div> --}} 
</section>
@stop