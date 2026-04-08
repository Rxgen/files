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
<section class="innerPage-content investorPages-container page-investors-notices">
    <h4 class="investor-pagesTitle theme-gradient-alpha gradient-text">Press Release</h4>

    <div class="notices-container">
        
        <div class="all-reports-listingBlock mediaPage-container  wrap-clear">
        	@if(isset($releases) && count($releases) > 0)
        	@foreach($releases as $release)
        	@php $file = json_decode($release->file); @endphp
            <div class="pdfDownload-data">
                <!-- <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon"> -->
                <div class="pdfdata-block">
                    <div class="pdf-name-title">
                    <img src="{{ Voyager::image($release->image)}}" alt="{{ $release->img_alt}}" title="{{ $release-> imge_title }}" class="news-image">
                    <span>{{$release->title}}</span> {{$release->sub_title}}
                    </div>
                    <a href="{{Storage::url($file[0]->download_link)}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta" target="_blank">
                        <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                    </a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <div class="query_content">
        <!-- In case of any query write to us on <a href="mailto:communications@nayaraenergy.com" class="note-blue">communications@nayaraenergy.com</a> -->
		{!! $page[0]->body !!}
    </div>
</section>
@stop