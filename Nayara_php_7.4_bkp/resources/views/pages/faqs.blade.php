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
@if(!empty($faqs))
<section class="innerPage-content investorPages-container faqPage page-investors-notices">
    <div class="investor-pagesTitle theme-gradient-alpha gradient-text">FAQ'S</div>
    @foreach($faqs as $faq)
    <div class="notices-wrapper ">
        <h2 class="notices-heading">{{$faq->question}}<div class="arrow-title"></div></h2>

        <div class="all-reports-listingBlock faq-listing-blk notice-lisitingBlock wrap-clear">
            <div>
            	{{$faq->answer}}
            </div>
        </div>

    </div>
    @endforeach
</section>
@endif
@stop