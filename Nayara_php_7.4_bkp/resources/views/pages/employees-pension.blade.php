@extends('layouts.newstatic')
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
            <div class="notices-block-wrap">
                <h4 class="investor-pagesTitle theme-gradient-alpha gradient-text">CIRCULAR: Employees Pension Secheme-95 (EPS-95)

</h4>
                <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear" style="display: flex;">
                @foreach($notices as $heading => $notice_items)
                @foreach($notice_items as $value)
                         @php
                            $file = json_decode($value->file);
                        @endphp
                    <div class="pdfDownload-data">
                        <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon">
                        <div class="pdfdata-block">
                            <div class="pdf-name-title">
                                {{$value->sub_title}}
                            </div>
                            <a href="{{URL::to(Storage::url($file[0]->download_link))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                                <span class="gradient-cta-overlay gradient-text theme-gradient" target="_blank" download="{{$file[0]->original_name}}"
                                >Download</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>
</section> 
@stop