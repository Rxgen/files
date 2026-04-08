@extends('layouts.newstatic')
@section('content')
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="Events Banner" class="innerBanner-img">
    </picture>
    <h2 class="innerBanner-title">{{$page[0]->banner_title}}</h2>
</section>
@include('includes.bread-crumbs')

<section class="innerPage-content investorPages-container page-investors-notices event_section">
            <h1 class="investor-pagesTitle theme-gradient-alpha gradient-text">Events</h1>
        
            <div class="event_container"> 
                @foreach($events as $event)
                <div class="event_box">
                    <img src="{{Voyager::image($event->thumbnail_image)}}" alt="Event " width="377" height="190">
                    <div class="event_text">
                        <div class="event_title">
                        {{$event->event_title}}</div>
                        {!! $event->short_description !!}
                        @php
                         $date = \Carbon\Carbon::createFromFormat('Y-m-d', $event->date);
                         @endphp
                         <div class="event_date">{{ strtoupper($date->format('F d, Y')) }}</div>
                    </div>
                    <a href="{{ route('event.contact', ['slug' => str_slug($event->event_title , '-')]) }}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                        <span class="gradient-cta-overlay gradient-text theme-gradient">View More</span>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="brocher-text">
        <span class="note-blue">In case of any query write to us on <a href="mailto:brand.communications@nayaraenergy.com"> brand.communications@nayaraenergy.com
        </a></strong></span>
    </div>
            
    </div>
    
    
        </section>
        
@stop