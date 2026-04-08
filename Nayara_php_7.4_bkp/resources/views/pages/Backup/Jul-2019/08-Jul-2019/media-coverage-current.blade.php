@extends('layouts.static')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="{{$page[0]->img_alt}}" title="{{$page[0]->img_title}}" class="innerBanner-img">
    </picture>
    <h2 class="innerBanner-title">{!! $page[0]->banner_title !!}</h2>
</section>
@endif
<section class="innerPage-content investorPages-container page-investors-notices">
    <h4 class="investor-pagesTitle theme-gradient-alpha gradient-text">Media Coverage</h4>

    <div class="notices-container">
        
        <div class="notices-wrapper active">
            <h5 class="notices-heading">{{$current[0]->year}}<div class="arrow-title"></div>
            </h5>
            <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear" style="display: flex;">
            	@if(isset($current) && count($current) > 0)
	        	@foreach($current as $current)
	        	@php $file = json_decode($current->file); @endphp
            	<div class="pdfDownload-data">
                    <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon">
                    <div class="pdfdata-block">
                        <div class="pdf-name-title">
                            <span>{{$current->title}}</span> {{$current->subtitle}}</div>
                        <a href="{{url(Storage::url($file[0]->download_link))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                            <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                        </a>
                    </div>
                </div>
                @endforeach
            	@endif
            </div>
        </div>
    </div>
</section>
@stop