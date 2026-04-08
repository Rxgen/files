@extends('layouts.welcome')
@section('content')
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{ Voyager::image($page[0]->mobile_banner) }}" />
        <img src="{{ Voyager::image($page[0]->desktop_banner) }}" alt="Culture at Nayara" class="innerBanner-img">
    </picture>
    <h1 class="innerBanner-title">{!! $page[0]->banner_title !!}</h1>
</section>
@include('includes.bread-crumbs')
<section class="innerPage-content career-openings-container institute_career  page-career-culture">
    <figure class="at-nayara-container container-padding">
        <div class="video-container">
            <video id="nayaraVideo" onclick="control()" poster="{{asset('images/v2/poster.webp')}}" controls="">
                <source src="{{ asset('videos/home/IB.mp4') }}" type="video/mp4">

                Your browser does not support the video tag.
            </video>
            <div class="video-poster">
                        <img src="{{asset('images/v2/poster.webp')}}" alt="Indias Energy Landscape" width="933" height="559">
                    </div>
        </div>
        <figcaption class="at-nayara-text"><h2 class="at-nayara-text__title institute_title_text">Transforming <span class="theme-gradient-bg-text">India's Energy</span> Landscape</h2>
            Through lasting business relationships, we collaborate closely <br>
            with our customers by providing products that are produced at scale and are high in quality. We are nimble and decisive - a core
            value when operating in dynamic market conditions.
            Nayara Energy has more than 50 supply locations pan-India, catering to the needs
            of industrial customers. <br>
             <a href="" class="readMore gradient-text theme-gradient-alpha">Read <span class="more">More</span> <span class="less">Less</span></a></figcaption>
    </figure>

    <div class="institute_content">
    <figcaption class="at-nayara-text institute_para">
              Our products are versatile and are used in various applications, from constructing roads
               to generating power. <br> At Nayara Energy, we manufacture quality products in line with BIS standard such
                as HSD, HFHSD, LDO, MTO,Bitumen, PMB, Petcoke, Sulphur and Fly Ash
                for the domestic market, spanning various verticals such as mining, infrastructure
                & logistics, power, cement, fertiliser, chemical, shipping, agriculture and paint. </figcaption>
                
            </div>

    {!! $page[0]->body !!}
</section>
<section class="b2bpage b2b_institute  investorPages-container ">
    <div>
        <div class="brocher-text">
        <span class="note-blue">For any enquiry please mails us at - <strong class="retail-note-call"><a href="mailto:Ibenquiry@nayaraenergy.com">Ibenquiry@nayaraenergy.com</a></strong></span>
    </div>
</section>
<section class="b2bpage b2b_institute  investorPages-container ">
    <div class="brocher-background">
        <div class="brocher-text">
            <h3 class="impactPage-heading impactPage-heading-margin pdf-hover"><a class="cta gradient-cta theme-gradient form-cta steps-form-cta pdf-hover-color" href="https://www.nayaraenergy.com/storage/InstitutionalBusiness/Nayara_Brochure-Digital_Version.pdf" download=" "> <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span> </a></h3>
        </div>
    </div>
</section>

@if(!empty($additionalHtml))
{!! $additionalHtml !!}

@endif
@endsection