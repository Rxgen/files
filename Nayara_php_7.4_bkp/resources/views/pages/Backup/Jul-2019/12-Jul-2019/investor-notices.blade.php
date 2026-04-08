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
@include('includes.bread-crumbs')
@if(count($page) > 0)
{!! $page[0]->body !!}
@endif
<section class="innerPage-content investorPages-container page-investors-notices">
    
    @if(count($notices) > 0)
    @foreach($notices as $heading => $notice_items)
    <div class="notices-block-wrap">
        <h4 class="investor-pagesTitle theme-gradient-alpha gradient-text">{{$heading}}</h4>

        <div class="notices-container">
            @php $i = 0; @endphp
            @foreach($notice_items as $key => $notice_item)
            @foreach($notice_item as $sub_heading => $notice_items1)
            <div class="notices-wrapper @php echo $i === 1 ? 'active' : ''; @endphp">
                <h5 class="notices-heading">{{ $sub_heading }}<div class="arrow-title"></div></h5>

                <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear">
                    @foreach($notice_items1 as $notice)
                        @php
                            $file = json_decode($notice->file);
                        @endphp
                        <div class="pdfDownload-data">
                            <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon">
                            <div class="pdfdata-block">
                                <div class="pdf-name-title">
                                    <span>{!! $notice->title !!}</span> {!! $notice->sub_title !!}
                                </div>
                                @if(!empty($file))
                                <a href="{{URL::to(Storage::url($file[0]->download_link))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta" target="blank">
                                    <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                                </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            @endforeach
            @endforeach
        </div>
    </div>
    @php $i++; @endphp
    @endforeach
    @endif
@stop