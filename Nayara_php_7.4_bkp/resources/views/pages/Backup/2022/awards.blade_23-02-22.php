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
    <div style="clear:both;width:100%">
        <h4 id="news_year" class="investor-pagesTitle theme-gradient-alpha gradient-text" style="float:left;">{{ $current_year }}</h4>
        <div class="search-block" style="float:right">
            @if(count($dates) > 0)
            <select id="year-change" class="yearSelection-annualReport">
                <option value="">Select Year</option>
                @foreach($dates as $date)
                <option value="{{ $date->date }}">{{ $date->date }}</option>
                @endforeach
            </select>
            @endif
            <input type="hidden" data-page="awards" id="ajax-url" value="{{ route('news.ajax') }}"> 
        </div>
    
    </div>
    @if(count($awards) > 0)
    <div class="notices-container" style="clear: both">
        <div id="news_section" class="all-reports-listingBlock notice-lisitingBlock media_cover_cur_year_listingblk wrap-clear" style="display: flex;">
            @foreach($awards as $award)
            @php $file = json_decode($award->file); @endphp
            <div class="pdfDownload-data">
                <!--<img src="assets/images/pdf-img.png" alt="pdf" class="pdfIcon">-->
                <div class="pdfdata-block">
                    <img src="{{ Voyager::image($award->image) }}" alt="{{ $award->img_alt }}" title="{{ $award->img_title }}" class="news-image">
                    <div class="pdf-name-title">
                        <span>{{ $award->title }}</span> {{$award->sub_title}} </div>
                    {{-- <a href="{{Storage::url($file[0]->download_link)}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                        <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                    </a> --}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</section>
@stop